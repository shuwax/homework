FROM php:7.4-fpm
ARG TIMEZONE


RUN apt-get update && apt-get install -y \
  openssl \
  git \
  unzip \
  mariadb-client

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
  && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
  && "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN echo 'alias sf="php app/console"' >> ~/.bashrc \
  && echo 'alias sf3="php bin/console"' >> ~/.bashrc

RUN install -d -o root -g root -m u=rwx,go= /etc/ssl/private/ \
  && install -d -o root -g root -m u=rwx,go=rx /etc/ssl/certs/ \
  && install -d -o root -g root -m u=rwx,go=rx /usr/local/share/ca-certificates/


WORKDIR /app/backend

CMD cp ../config/docker-local/api/.env . \
&& cp ../config/docker-local/api/.env.test . \
&& composer install --prefer-dist && composer dump-autoload \
&& php bin/console doctrine:migrations:migrate -n && php bin/console doctrine:migrations:migrate -n --env=test \
&& php-fpm