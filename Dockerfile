FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    supervisor \
    curl \
    unzip \
    git \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy config files
COPY supervisord.conf /etc/supervisord.conf
COPY php-fpm.conf /usr/local/etc/php-fpm.conf

# Set working directory
WORKDIR /var/www

# Expose PHP-FPM port
EXPOSE 9000

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
