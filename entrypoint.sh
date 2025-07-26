#!/bin/bash
set -e

# Buat direktori log jika belum ada
mkdir -p /var/log/supervisor
mkdir -p /run/php

# Jalankan Supervisor
exec /usr/bin/supervisord -c /etc/supervisord.conf
