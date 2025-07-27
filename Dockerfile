FROM php:8.2-fpm

WORKDIR /var/www

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    sync && install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    unzip \
    mariadb-client \
    nginx \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel project files
COPY . .
COPY composer.json composer.lock ./

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

RUN mkdir -p /run/php && chown www-data:www-data /run/php

RUN mkdir -p /var/log/nginx /var/log/php-fpm

# Copy Supervisor config
COPY docker/supervisord/supervisord.conf /etc/supervisor/supervisord.conf

# Copy Nginx config
COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

COPY docker/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf


EXPOSE 80

HEALTHCHECK --interval=60s --timeout=5s --retries=3 \
  CMD curl --fail http://localhost || exit 1

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
