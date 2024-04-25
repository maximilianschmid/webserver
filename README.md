### Basic template taken from
https://thriveread.com/docker-apache-httpd-with-php-fpm-and-mysql/

### PHP FPM 
Inspiration taken from
https://github.com/soft-industry/docker-compose-php/blob/master/php-fpm-5.6.yml
    
### MySQL
Official MySQL Docker image guide:
https://hub.docker.com/_/mysql

Alternative Infos
https://hub.docker.com/r/cytopia/mysql-5.6
                            

### Docker commands:
Run docker compose
```
docker compose up
```

Rebuild docker compose due to changes
```
docker compose up --build
```

build docker image -> amd64 on m1
```
docker buildx build --platform linux/amd64 --file Dockerfile.php56 -t image-name .
```

#### run docker image and drop in bash
```
docker run --rm -it --platform linux/amd64 image-name bash
```
That will drop you into a bash shell in an amd64 container.
In container:
```
uname -a
```

Testing

build php-fpm on localhost
```
docker buildx build --platform linux/amd64 --file Dockerfile -t php56-fpm-local .
docker run --rm -it -p 8888:80 --platform linux/amd64 php56-fpm-local bash
docker run --rm -it --platform linux/amd64 mysql-db bash
```

