FROM php:8.1-fpm

# Install dependency
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Copy konfigurasi Nginx dan Supervisor
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Copy source code Laravel ke /var/www
WORKDIR /var/www
COPY . /var/www

COPY composer.lock composer.json /var/www/
RUN composer install --no-interaction --prefer-dist --optimize-autoloader


# Expose port
EXPOSE 80

CMD ["/entrypoint.sh"]
