FROM php:8.2-fpm

# Argumentos definidos en docker-compose.yml
ARG user
ARG uid

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libgbm-dev \
    libnss3 \
    libasound2

# 2. Limpiar caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Instalar Composer (Paso 1 de tu script original)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Instalar Node.js y NPM (Paso 2 de tu script original)
# Instalamos la versión LTS directamente
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 6. Crear usuario del sistema para ejecutar comandos de Composer y Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# 7. Configurar directorio de trabajo
WORKDIR /var/www

# Copiar el script de entrada personalizado
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

USER $user

ENTRYPOINT ["entrypoint"]