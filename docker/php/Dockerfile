FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    supervisor \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
       pdo_pgsql \
       intl \
       bcmath \
       gd \
       zip \
       opcache \
       pcntl

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY ./php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN usermod -u 1000 www-data

RUN usermod -d /home/www-data www-data \
    && mkdir -p /home/www-data \
    && chown -R www-data:www-data /home/www-data

ENV HOME=/home/www-data

RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*

COPY ./nginx/default.conf /etc/nginx/sites-available/default
COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
