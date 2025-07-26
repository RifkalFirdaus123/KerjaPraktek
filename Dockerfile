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

# Copy Laravel project files (ubah sesuai struktur kamu)
COPY . /var/www

# Copy supervisor config (ini penting)
COPY php-fpm.conf /etc/supervisord.conf

# Buat log folder supervisor
RUN mkdir -p /var/log/supervisor

# Pastikan permission benar
RUN chown -R www-data:www-data /var/www

# Expose port FPM (jika pakai reverse proxy)
EXPOSE 9000

# Jalankan supervisor sebagai entrypoint utama
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
