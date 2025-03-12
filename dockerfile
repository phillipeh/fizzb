# Use the official PHP 8.1 image with Apache
FROM php:8.1-apache

RUN apt-get install -f


# Enable required PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev libicu-dev libpng-dev  libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql intl zip gd opcache mbstring \
    && apt-get clean \
	&& rm -rf /var/lib/apt/lists/*


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy Symfony application files into the container
COPY . .

# Ensure correct permissions
#RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/var

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache server when the container runs
CMD ["apache2-foreground"]