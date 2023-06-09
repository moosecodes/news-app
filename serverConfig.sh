#!/bin/bash

cd ~
mkdir ~/api
cd ~/api
tzselect
apt update -y && apt upgrade -y && apt install -y php-curl php-xml docker.io docker-compose composer php8.1-xdebug nodejs npm
git clone https://github.com/moosecodes/news-app.git .
composer update
composer install
vim .env
npm run build
./vendor/bin/sail up