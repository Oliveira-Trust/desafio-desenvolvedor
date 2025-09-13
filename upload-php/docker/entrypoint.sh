#!/bin/bash
set -e

if [ ! -d "/var/www/vendor" ]; then
    composer install
fi

# Inicia o Supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf