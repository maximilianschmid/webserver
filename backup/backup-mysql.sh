#!/usr/bin/env bash
# Nightly per-database MySQL dumps with 14-day retention.
# Run from cron on the host (see README):
#   0 3 * * * cd /opt/webserver && ./backup/backup-mysql.sh >> log/backup.log 2>&1
set -euo pipefail

cd "$(dirname "$0")/.."
DUMP_DIR="backup/dumps"
RETENTION_DAYS=14
DATE="$(date +%F)"

mkdir -p "$DUMP_DIR"

# List all non-system databases (password comes from the container env)
databases="$(docker compose exec -T mysql-db sh -c \
  'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -N -e "SHOW DATABASES"' \
  | tr -d '\r' | grep -Ev '^(information_schema|performance_schema|mysql|sys)$')"

for db in $databases; do
  echo "[$(date '+%F %T')] dumping $db"
  docker compose exec -T mysql-db sh -c \
    'exec mysqldump --single-transaction --routines --triggers -uroot -p"$MYSQL_ROOT_PASSWORD" "$1"' -- "$db" \
    | gzip > "$DUMP_DIR/$db-$DATE.sql.gz.tmp"
  mv "$DUMP_DIR/$db-$DATE.sql.gz.tmp" "$DUMP_DIR/$db-$DATE.sql.gz"
done

find "$DUMP_DIR" -name '*.sql.gz' -mtime "+$RETENTION_DAYS" -delete
find "$DUMP_DIR" -name '*.sql.gz.tmp' -mtime +1 -delete

echo "[$(date '+%F %T')] done"
