#!/bin/bash
sudo apt-get update
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update

sudo apt -y install php7.4
sudo apt-get install -y php7.4-{bcmath,bz2,intl,gd,mbstring,mysql,zip,common,curl,dom,xml}
sudo systemctl disable --now apache2

apt install -y php-mysql
apt install -y php-curl

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/bin/composer

cd /root/ecommerce_member
chmod 777 -R ./storage
composer install
cp .env.example .env
php artisan key:generate
