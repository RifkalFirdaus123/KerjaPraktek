FROM php:8.2-fpm

WORKDIR /var/www

# Install PHP extensions menggunakan mlocati/docker-php-extension-installer
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
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . /var/www

# Instal Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# HAPUS BARIS INI:
# RUN php artisan migrate --force
# HAPUS BARIS INI:
# RUN php artisan db:seed --force

# Setel izin direktori Laravel
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Optimalkan Laravel untuk produksi
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 9000

CMD ["php-fpm"]