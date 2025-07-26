#!/bin/bash

# Jalankan Composer Install jika vendor belum ada
if [ ! -d "vendor" ]; then
    echo "📦 Running composer install..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Jalankan migrasi opsional (hapus jika tidak perlu otomatis)
# php artisan migrate --force

# Jalankan supervisor
echo "🚀 Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
