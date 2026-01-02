FROM php:8.4-fpm

ARG user
ARG uid

# 1. Install System Dependencies
# Added: libicu-dev (REQUIRED for intl), libjpeg/freetype (for gd)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Configure GD Extension (Enable JPEG and Freetype support)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# 3. Install PHP Extensions
# I've split this into two Run commands. This reduces the memory load
# per step and makes debugging easier.
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip



RUN docker-php-ext-install gd intl

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Install Node.js & NPM
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 6. Set working directory
WORKDIR /var/www

# 7. Create system user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# 8. Copy existing application
COPY . /var/www
COPY .env .

# 9. Set permissions
RUN chown -R $user:$user /var/www

# Switch to user
USER $user

# 10. Install PHP Dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 11. Install Node Dependencies and Build
RUN npm install && npm run build

# Switch back to root
USER root

EXPOSE 9000