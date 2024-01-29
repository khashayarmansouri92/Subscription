# Use the official PHP image as a base
FROM php:8.3-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        libonig-dev \
        libpng-dev \
        libxml2-dev \
        curl \
        git \
        && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files to the container
COPY . /var/www/html

# Install Laravel dependencies using Composer
RUN composer install --optimize-autoloader --no-dev

# Set folder permissions (adjust as needed)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
