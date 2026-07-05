# Legacy TYPO3 webserver stack

Hosts legacy TYPO3 sites (TYPO3 4.5 on PHP 5.6, TYPO3 6/7 on PHP 7.2) behind
Traefik (TLS) → Apache (vhosts) → PHP-FPM containers + MySQL 5.7.

| Site | TYPO3 | PHP | Docroot |
|---|---|---|---|
| physiotherapie-huber.at | 4.5 | 5.6 | `wwwroot/p145775/public/` |
| ff-sicking.at | 7.6 | 7.2 | `wwwroot/p529191/public/` |
| hittmayr.at | 7.x | 7.2 | `wwwroot/p27705/public/` |

## Local development

Uses mkcert certificates (`certs/`) and `.test` hostnames, configured in
`traefik/dynamic-dev.yaml`. The dev override (`docker-compose.override.yaml`)
is applied automatically:

```
docker compose up            # add --build after config/Dockerfile changes
```

- Sites: https://ff-sicking.at.test, https://physiotherapie-huber.at.test, https://hittmayr.at.test
- phpMyAdmin: https://phpmyadmin.test (basic auth)
- MySQL from host: `127.0.0.1:3307`

First start on a fresh checkout: copy `.env.example` → `.env` and
`mysqld/initdb.d/01-create-databases.sql.example` → `...sql` (init scripts run
only when `db/` is empty).

## Deploy to Hetzner (production)

Target: Hetzner Cloud x86 VPS, 8 GB (e.g. CPX31). Prod uses
`docker-compose.prod.yaml`: Let's Encrypt instead of mkcert, real domains,
no public phpMyAdmin, basic auth in front of `/typo3`, 1G InnoDB buffer pool.

### 1. Server setup

- Install Docker CE + compose plugin (docs.docker.com/engine/install/debian or ubuntu).
- Hetzner Cloud Firewall: allow inbound 22, 80, 443 only. Note: ports
  published by Docker bypass ufw — use the Hetzner Cloud Firewall, not ufw,
  as the source of truth.
- `git clone` this repo to `/opt/webserver`.

### 2. Create the gitignored config files

```
cd /opt/webserver
cp .env.example .env                  # set MYSQL_ROOT_PASSWORD, uncomment COMPOSE_FILE=...prod
cp mysqld/initdb.d/01-create-databases.sql.example mysqld/initdb.d/01-create-databases.sql
                                      # set real DB passwords (must match each site's
                                      # localconf.php / LocalConfiguration.php)
cp traefik/typo3.htpasswd.example traefik/typo3.htpasswd
docker run --rm httpd:2.4 htpasswd -nbB editors 'STRONG-PASSWORD'   # paste output into typo3.htpasswd
mkdir -p traefik/acme
```

**Rotate the old credentials**: the DB passwords that used to live in git
history are burned — use new ones here and update the TYPO3 configs in
`wwwroot/` accordingly.

### 3. Content + database

- `rsync -az wwwroot/ root@<server>:/opt/webserver/wwwroot/`
- Start the stack (first start creates the DBs/users from initdb.d), then
  import dumps: `zcat dump.sql.gz | docker compose exec -T mysql-db mysql -uroot -p"$MYSQL_ROOT_PASSWORD" <dbname>`

### 4. DNS + TLS cutover

1. Lower the DNS TTL of all domains (e.g. 300s) a day before the switch.
2. Point A/AAAA records of `ff-sicking.at`, `www.ff-sicking.at`,
   `physiotherapie-huber.at`, `www...`, `hittmayr.at`, `www...` at the VPS.
3. First start with the Let's Encrypt **staging** CA (uncomment the
   `caserver` line in `docker-compose.prod.yaml`) and check certs are issued
   (`docker compose logs traefik`). Then re-comment it, delete
   `traefik/acme/acme.json`, and `docker compose up -d --force-recreate traefik`
   for real certificates.

```
docker compose up -d --build          # COMPOSE_FILE in .env selects prod files
```

### 5. After go-live

- phpMyAdmin: `ssh -L 8081:127.0.0.1:8081 <server>` → http://localhost:8081
- MySQL CLI: `ssh -L 3307:127.0.0.1:3307 <server>` → `mysql -h127.0.0.1 -P3307`
- `/typo3` on all sites prompts for the Traefik basic auth first (EOL
  TYPO3/PHP — keep this on), then the normal TYPO3 login.
- Delete the stray leftover directory `wwwroot/p1account/` (pre-rename copy of p145775) if still present.

### Backups

Nightly per-database dumps with 14-day retention:

```
crontab -e
0 3 * * * cd /opt/webserver && ./backup/backup-mysql.sh >> log/backup.log 2>&1
```

Dumps land in `backup/dumps/` (gitignored). Recommended follow-up: sync that
directory plus `wwwroot/` off-host to a Hetzner Storage Box (rclone/borg), and
enable Hetzner server snapshots.

Restore: `zcat backup/dumps/<db>-<date>.sql.gz | docker compose exec -T mysql-db mysql -uroot -p"$MYSQL_ROOT_PASSWORD" <db>`

## Architecture notes

- **Traefik** (`traefik/dynamic-{dev,prod}.yaml`): TLS termination and
  host-based routing to Apache. HTTP→HTTPS redirect is global on the `web`
  entrypoint. Prod adds `certResolver: le` (ACME HTTP-01), HSTS/security
  headers, and `typo3-auth` basic auth on `/typo3` paths (deliberately NOT on
  `/typo3temp` or `/typo3conf`, which serve frontend assets).
- **Apache** (`apache/apache.vhost.conf`): one vhost per site matching both
  `.test` and real domains; proxies `*.php` to the right PHP-FPM pool via
  fcgi. The default catch-all vhost denies everything. `mod_remoteip`
  restores real client IPs from `X-Forwarded-For`.
- **Site content** (`wwwroot/`, not in git): each site's `.htaccess` SSL
  redirect checks `X-Forwarded-Proto` (Traefik terminates TLS), and each
  site's TYPO3 env config (`AdditionalConfiguration.php` / `localconf.php`)
  applies the Docker DB + reverse-proxy settings for BOTH `.test` and real
  domains (old Mittwald branches removed). `rsync wwwroot/` carries these to
  prod.
- **PHP-FPM**: separate containers per PHP version, listening on 9056/9072.
  Config baked into images (`php-*/php.ini`, `php-*/php-fpm.conf`) — rebuild
  after changes.
- **MySQL 5.7** (last version compatible with TYPO3 4.5): relaxed
  `sql_mode`, utf8mb4 server default. Dev buffer pool 256M (`mysqld/etc/my.cnf`),
  prod overridden to 1G via compose `command`.

## References

- TYPO3 system requirements: https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/SystemRequirements/Index.html
- Original template: https://thriveread.com/docker-apache-httpd-with-php-fpm-and-mysql/
- PHP-FPM inspiration: https://github.com/soft-industry/docker-compose-php/blob/master/php-fpm-5.6.yml
- MySQL image: https://hub.docker.com/_/mysql

### Handy Docker commands

```
# rebuild after config changes
docker compose up --build

# build an amd64 image on Apple Silicon and drop into a shell
docker buildx build --platform linux/amd64 --file php-56-fpm/Dockerfile -t php56-fpm-local .
docker run --rm -it --platform linux/amd64 php56-fpm-local bash
```
