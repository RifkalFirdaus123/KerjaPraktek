FROM php:8.2-fpm

# Install supervisor & dependencies
RUN apt-get update && apt-get install -y \
    supervisor \
    curl \
    vim \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Copy supervisord configuration
COPY supervisord.conf /etc/supervisord.conf

# Copy php-fpm config
COPY php-fpm.conf /usr/local/etc/php-fpm.conf

# Create required directories
RUN mkdir -p /var/log/supervisor

# Set working directory
WORKDIR /var/www

# Start supervisord
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
