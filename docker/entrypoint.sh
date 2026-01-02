#!/bin/bash

# Function to print colorful messages (From your original script)
print_info() {
    echo -e "\033[0;34mℹ $1\033[0m"
}
print_success() {
    echo -e "\033[0;32m✓ $1\033[0m"
}

# 1. Setup .env if it doesn't exist
if [ ! -f ".env" ]; then
    print_info "Creating .env file..."
    cp .env.example .env
fi
php artisan key:generate
# 2. Wait for MySQL to be ready
# Usamos un pequeño script PHP para verificar la conexión, más robusto que nc
wait_for_db() {
    php -r "
        \$maxTries = 30;
        \$connected = false;
        for (\$i = 0; \$i < \$maxTries; \$i++) {
            try {
                new PDO('mysql:host=db;port=3306', '${DB_USERNAME}', '${DB_PASSWORD}');
                \$connected = true;
                break;
            } catch (PDOException \$e) {
                echo '.';
                sleep(1);
            }
        }
        if (!\$connected) { exit(1); }
    "
}

if wait_for_db; then
    print_success "Conexión a MySQL establecida exitosamente"
else
    print_error "No se pudo conectar a la base de datos después de 30 segundos"
    exit 1
fi

# 3. Shield & Permission Setup (From your README)
print_info "Clearing caches..."
php artisan config:cache

# 4. Run Migrations (Step 5 of your script)
print_info "Running Migrations..."
php artisan migrate

# 5. Shield Generation (From your README)
print_info "Generating Shield Perms..."
php artisan shield:generate --all --panel=admin
php artisan permission:cache-reset

# 6. Run Seeders (From your README)
print_info "Running Seeders..."
php artisan db:seed

# 7. Fix permissions for storage and cache
print_info "Fixing permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 8. Start PHP-FPM
print_info "Starting Server..."
php-fpm