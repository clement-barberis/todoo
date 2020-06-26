FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -yq --no-install-recommends \
  apt-utils \
  curl \
  # Install git
  git \
  # Install apache
  apache2 \
  # Install php 7.4
  php7.4-cli \
  php7.4-json \
  php7.4-curl \
  php7.4-gd \
  php7.4-ldap \
  php7.4-mbstring \
  php7.4-mysql \
  php7.4-soap \
  php7.4-sqlite3 \
  php7.4-xml \
  php7.4-zip \
  php7.4-intl \
  # Install tools
  openssl \
  nano \
  ca-certificates \
  wget

# Symfony tool
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
  mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/html

COPY . .

RUN composer install


# CMD symfony serve --allow-http --no-tls --port=8000
CMD symfony server:start
#CMD php -S 127.0.0.1:8000 -t publicsyf
