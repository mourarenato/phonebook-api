FROM php:8.1-fpm-buster

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libpq-dev libldap2-dev zip git wget \
    g++ cpp sudo python \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pcntl sockets

COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www/html/

WORKDIR /var/www/html/

COPY . /var/www/html/

ENV USER=app USER_ID=1234 USER_GID=1234

RUN groupadd --gid "${USER_GID}" "${USER}" && \
    useradd \
        --uid ${USER_ID} \
        --gid ${USER_GID} \
        --create-home \
        --shell /bin/bash \
    ${USER}

# Set user permissions
RUN chmod -R 777 /var/www/html/storage && \
    chown -R ${USER}:${USER_GID} /var/www/html/storage/

RUN sed -i "s/www-data/$USER/" /usr/local/etc/php-fpm.d/www.conf

USER ${USER}

EXPOSE 9000
