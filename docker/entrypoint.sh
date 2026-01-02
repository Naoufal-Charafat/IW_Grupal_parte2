#!/bin/bash

# ==========================================
# CONFIGURACIÓN VISUAL (Desde tu setup.sh)
# ==========================================

# Colores para el output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Función para imprimir encabezados
print_header() {
    echo -e "\n${BLUE}================================${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}================================${NC}\n"
}

# Función para imprimir mensajes de éxito
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

# Función para imprimir mensajes de error
print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Función para imprimir mensajes de advertencia
print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

# Función para imprimir mensajes de información
print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

# ==========================================
# LÓGICA DE INICIO DE DOCKER
# ==========================================

print_header "INICIANDO CONTENEDOR LARAVEL"

# PASO 1: DEPENDENCIAS DE PHP
# ------------------------------------------
# En Docker, composer ya está instalado en la imagen, solo necesitamos instalar las librerías del proyecto.
if [ ! -d "vendor" ]; then
    print_warning "Carpeta 'vendor' no encontrada. Instalando dependencias..."
    composer install --no-interaction --prefer-dist --optimize-autoloader

    if [ $? -eq 0 ]; then
        print_success "Dependencias de Composer instaladas"
    else
        print_error "Falló la instalación de Composer"
        exit 1
    fi
else
    print_success "Dependencias de Composer ya presentes"
fi

# PASO 2: CONFIGURACIÓN DE ENTORNO
# ------------------------------------------
if [ ! -f ".env" ]; then
    print_warning "Archivo .env no encontrado. Creando desde .env.example..."
    cp .env.example .env
    php artisan key:generate
    print_success "Archivo .env generado"
else
    print_success "Archivo .env ya existe"
fi

# PASO 3: DEPENDENCIAS DE FRONTEND
# ------------------------------------------
if [ ! -d "node_modules" ]; then
    print_warning "Carpeta 'node_modules' no encontrada. Instalando..."
    npm install
    print_success "Dependencias de NPM instaladas"
else
    print_success "Dependencias de NPM ya presentes"
fi

print_info "Compilando assets con Vite..."
npm run build

# PASO 4: ESPERAR A LA BASE DE DATOS
# ------------------------------------------
# Reemplazamos la instalación de MySQL (tu script original) por la espera de conexión
print_info "Esperando a que el servicio MySQL (host: db) esté listo..."

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

# PASO 5: MIGRACIONES
# ------------------------------------------
print_info "Ejecutando migraciones de base de datos..."
php artisan migrate --force

if [ $? -eq 0 ]; then
    print_success "Migraciones ejecutadas correctamente"
else
    print_error "Error al ejecutar migraciones"
    # No salimos con exit 1 aquí para permitir que el contenedor arranque aunque falle la migración (útil en dev)
fi

# FINALIZAR
# ------------------------------------------
print_header "✓ LISTO PARA SERVIR"
print_info "Iniciando PHP-FPM..."

# Ejecutar el comando principal (php-fpm)
exec php-fpm