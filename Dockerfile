FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    supervisor \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel files
COPY . .

# Copy supervisor config (gabung dalam 1 file)
COPY supervisord.conf /etc/supervisord.conf

# Buat direktori log
RUN mkdir -p /var/log/supervisor

# Pastikan permission benar
RUN chown -R www-data:www-data /var/www

# Expose port PHP-FPM
EXPOSE 9000

# Jalankan supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
