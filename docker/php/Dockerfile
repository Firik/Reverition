FROM ubuntu:18.04

ENV TZ Europe/Moscow
ENV TERM linux
ENV DEBIAN_FRONTEND noninteractive
ENV PHP_INI_SCAN_DIR "/usr/local/etc/php/conf.d/:${PHP_INI_SCAN_DIR}"

RUN apt-get update \
    && apt-get install -y \
    php7.2 \
    php-imagick \
    php-json \
    php-mbstring \
    && rm -rf /var/lib/apt/lists/*
    
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
