#!/bin/bash
set -e # Exit on error

# Update package lists
apt-get update

# Install PHP and required extensions
apt-get install -y php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-pgsql php8.2-curl php8.2-zip unzip curl

# Ensure PHP is in PATH
export PATH=/usr/bin:$PATH

# Install Composer
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php

# Verify installations
php -v
composer --version

# Run Laravel build commands
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
