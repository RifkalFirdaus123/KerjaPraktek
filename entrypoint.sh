#!/bin/bash

# Start Supervisor which will manage php-fpm and nginx
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
