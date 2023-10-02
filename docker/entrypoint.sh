#!/bin/sh

set -e

composer install | true
composer self-update | true

php-fpm