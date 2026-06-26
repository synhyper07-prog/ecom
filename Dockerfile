# Stage 1: Node for frontend assets
FROM node:14 as frontend

WORKDIR /app
COPY package*.json ./
COPY webpack.mix.js ./
RUN npm install

COPY resources ./resources
COPY public ./public
RUN npm run production

# Stage 2: PHP Apache for backend
FROM php:7.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . /var/www/html

# Copy built frontend assets from the frontend stage
COPY --from=frontend /app/public /var/www/html/public

# Copy Apache vhost configuration
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]
