# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary extensions and packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run Composer install and Laravel commands
RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate \
    && php artisan config:cache \
    && php artisan storage:link

# Set file permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80
