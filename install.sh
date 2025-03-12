 #!/bin/bash

# Load environment variables from .env file
export $(grep -v '^#' .env | xargs)

# Update and install required dependencies
sudo yum update -y
sudo yum install -y git unzip php-cli php-mbstring php-xml php-curl php-zip php-tokenizer php-json php-sodium docker

# Start and enable Docker
sudo systemctl start docker
sudo systemctl enable docker
sudo usermod -aG docker ec2-user

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Symfony CLI
curl -sS https://get.symfony.com/cli/installer | bash
sudo mv ~/.symfony5/bin/symfony /usr/local/bin/symfony

# Create the Symfony project in the specified directory
cd ~
symfony new $PROJECT_DIR --version=7.2 --webapp

# Change directory to the project
cd $PROJECT_DIR

# Install required Symfony dependencies
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require api-platform/core
composer require symfony/validator
composer require lexik/jwt-authentication-bundle --with-all-dependencies

# # # Run migrations
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate



# Restart Docker (Ensures correct permissions)
sudo systemctl restart docker

cd ~/fbuzz-api

#generate jwt credentials  ()
mkdir -p config/jwt
openssl genpkey -algorithm RSA -out config/jwt/private.pem -aes256 -pass pass:123qweASD###123qweASD###
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout -passin pass:123qweASD###123qweASD###

docker-compose up --build -d
