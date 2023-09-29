#!/bin/sh

set -e

composer self-update | true

php-fpm