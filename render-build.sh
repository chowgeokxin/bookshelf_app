#!/bin/bash
apt-get update
apt-get install -y php php-cli php-mbstring php-xml php-pgsql unzip curl
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
