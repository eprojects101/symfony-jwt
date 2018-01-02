FROM 832266673134.dkr.ecr.us-east-1.amazonaws.com/socialbase/php7:latest

WORKDIR /usr/src/api

COPY composer.json /usr/src/api
COPY composer.lock /usr/src/api

RUN apk add --no-cache nginx \
    && mkdir /tmp/nginx \
    && chown nginx /tmp/nginx

COPY s6-overlay /

COPY app /usr/src/api/app
COPY src /usr/src/api/src
COPY web /usr/src/api/web
COPY bin /usr/src/api/bin
COPY tests /usr/src/api/tests
COPY var /usr/src/api/var

RUN composer install --ignore-platform-reqs

RUN apk del git \
&& rm /usr/local/bin/composer \
&& mkdir /usr/src/api/var/cache/prod \
&& mkdir /usr/src/api/var/sessions/prod \
&& chmod 777 /usr/src/api/var/cache/prod \
&& chmod 777 /usr/src/api/var/logs
