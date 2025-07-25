FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Salin file project dengan hak akses root (sementara)
COPY . /var/www

# Ubah ownership direktori ke www-data
RUN chown -R www-data:www-data /var/www

# Ubah user jadi www-data untuk keamanan saat run
USER www-data

# Expose port 9000
EXPOSE 9000

# Jalankan PHP-FPM
CMD ["php-fpm"]
