#!/bin/bash

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

#===========================================
# PASO 1: VERIFICAR E INSTALAR COMPOSER
#===========================================
print_header "PASO 1: VERIFICANDO COMPOSER"

if command -v composer &> /dev/null; then
    COMPOSER_VERSION=$(composer --version 2>&1 | head -n 1)
    print_success "Composer ya está instalado: $COMPOSER_VERSION"
else
    print_warning "Composer no está instalado. Instalando..."
    
    # Descargar el instalador de Composer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    
    # Verificar el instalador (opcional pero recomendado)
    EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
    ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"
    
    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
        print_error "Firma del instalador de Composer inválida"
        rm composer-setup.php
        exit 1
    fi
    
    # Instalar Composer globalmente
    php composer-setup.php --quiet
    rm composer-setup.php
    sudo mv composer.phar /usr/local/bin/composer
    
    if command -v composer &> /dev/null; then
        print_success "Composer instalado correctamente"
    else
        print_error "Error al instalar Composer"
        exit 1
    fi
fi

# Instalar dependencias de PHP con Composer
print_info "Instalando dependencias de PHP con Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader

if [ $? -eq 0 ]; then
    print_success "Dependencias de PHP instaladas correctamente"
else
    print_error "Error al instalar dependencias de PHP"
    exit 1
fi

#===========================================
# PASO 2: VERIFICAR E INSTALAR NODE.JS/NPM
#===========================================
print_header "PASO 2: VERIFICANDO NODE.JS Y NPM"

if command -v node &> /dev/null; then
    NODE_VERSION=$(node --version)
    print_success "Node.js ya está instalado: $NODE_VERSION"
else
    print_warning "Node.js no está instalado. Instalando..."
    
    # Instalar Node.js usando NodeSource (versión LTS)
    curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
    sudo apt-get install -y nodejs
    
    if command -v node &> /dev/null; then
        print_success "Node.js instalado correctamente"
    else
        print_error "Error al instalar Node.js"
        exit 1
    fi
fi

if command -v npm &> /dev/null; then
    NPM_VERSION=$(npm --version)
    print_success "NPM ya está instalado: $NPM_VERSION"
else
    print_error "NPM no está instalado"
    exit 1
fi

# Instalar dependencias de Node.js
print_info "Instalando dependencias de Node.js con NPM..."
npm install

if [ $? -eq 0 ]; then
    print_success "Dependencias de Node.js instaladas correctamente"
else
    print_error "Error al instalar dependencias de Node.js"
    exit 1
fi

# Compilar assets con Vite
print_info "Compilando assets con Vite..."
npm run build

if [ $? -eq 0 ]; then
    print_success "Assets compilados correctamente"
else
    print_error "Error al compilar assets"
    exit 1
fi

#===========================================
# PASO 3: VERIFICAR E INSTALAR MYSQL
#===========================================
print_header "PASO 3: VERIFICANDO MYSQL"

if command -v mysql &> /dev/null; then
    MYSQL_VERSION=$(mysql --version)
    print_success "MySQL ya está instalado: $MYSQL_VERSION"
else
    print_warning "MySQL no está instalado. Instalando..."
    
    # Actualizar repositorios
    sudo apt-get update
    
    # Instalar MySQL Server
    sudo apt-get install -y mysql-server
    
    if command -v mysql &> /dev/null; then
        print_success "MySQL instalado correctamente"
    else
        print_error "Error al instalar MySQL"
        exit 1
    fi
    
    # Iniciar servicio MySQL
    sudo systemctl start mysql
    sudo systemctl enable mysql
fi

# Verificar si el servicio MySQL está corriendo
if sudo systemctl is-active --quiet mysql; then
    print_success "Servicio MySQL está activo"
else
    print_warning "Servicio MySQL no está activo. Iniciando..."
    sudo systemctl start mysql
    
    if sudo systemctl is-active --quiet mysql; then
        print_success "Servicio MySQL iniciado correctamente"
    else
        print_error "Error al iniciar servicio MySQL"
        exit 1
    fi
fi

#===========================================
# PASO 4: CREAR BASE DE DATOS Y USUARIO
#===========================================
print_header "PASO 4: CONFIGURANDO BASE DE DATOS"

# Leer credenciales del archivo .env
DB_DATABASE=$(grep "^DB_DATABASE=" .env | cut -d '=' -f2)
DB_USERNAME=$(grep "^DB_USERNAME=" .env | cut -d '=' -f2)
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d '=' -f2)
DB_HOST=$(grep "^DB_HOST=" .env | cut -d '=' -f2)

print_info "Base de datos: $DB_DATABASE"
print_info "Usuario: $DB_USERNAME"
print_info "Host: $DB_HOST"

# Solicitar contraseña de root de MySQL
echo -e "${YELLOW}Por favor, ingresa la contraseña de root de MySQL:${NC}"
read -s MYSQL_ROOT_PASSWORD

# Verificar si la base de datos existe
DB_EXISTS=$(mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "SHOW DATABASES LIKE '$DB_DATABASE';" 2>/dev/null | grep "$DB_DATABASE")

if [ -z "$DB_EXISTS" ]; then
    print_warning "La base de datos '$DB_DATABASE' no existe. Creando..."
    
    mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "CREATE DATABASE $DB_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        print_success "Base de datos '$DB_DATABASE' creada correctamente"
    else
        print_error "Error al crear la base de datos"
        exit 1
    fi
else
    print_success "La base de datos '$DB_DATABASE' ya existe"
fi

# Verificar si el usuario existe
USER_EXISTS=$(mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "SELECT User FROM mysql.user WHERE User='$DB_USERNAME' AND Host='$DB_HOST';" 2>/dev/null | grep "$DB_USERNAME")

if [ -z "$USER_EXISTS" ]; then
    print_warning "El usuario '$DB_USERNAME'@'$DB_HOST' no existe. Creando..."
    
    mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "CREATE USER '$DB_USERNAME'@'$DB_HOST' IDENTIFIED BY '$DB_PASSWORD';" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        print_success "Usuario '$DB_USERNAME'@'$DB_HOST' creado correctamente"
    else
        print_error "Error al crear el usuario"
        exit 1
    fi
else
    print_success "El usuario '$DB_USERNAME'@'$DB_HOST' ya existe"
fi

# Otorgar permisos al usuario
print_info "Otorgando permisos al usuario..."
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "GRANT ALL PRIVILEGES ON $DB_DATABASE.* TO '$DB_USERNAME'@'$DB_HOST';" 2>/dev/null
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "FLUSH PRIVILEGES;" 2>/dev/null

if [ $? -eq 0 ]; then
    print_success "Permisos otorgados correctamente"
else
    print_error "Error al otorgar permisos"
    exit 1
fi

#===========================================
# PASO 5: EJECUTAR MIGRACIONES
#===========================================
print_header "PASO 5: EJECUTANDO MIGRACIONES DE LARAVEL"

# Verificar conexión a la base de datos
print_info "Verificando conexión a la base de datos..."
php artisan migrate:status &>/dev/null

if [ $? -eq 0 ]; then
    print_success "Conexión a la base de datos verificada"
else
    print_warning "Posible problema de conexión. Intentando ejecutar migraciones de todos modos..."
fi

# Ejecutar migraciones
print_info "Ejecutando migraciones..."
php artisan migrate --force

if [ $? -eq 0 ]; then
    print_success "Migraciones ejecutadas correctamente"
else
    print_error "Error al ejecutar migraciones"
    exit 1
fi

#===========================================
# RESUMEN FINAL
#===========================================
print_header "✓ INSTALACIÓN COMPLETADA EXITOSAMENTE"

echo -e "${GREEN}Todos los pasos se completaron correctamente:${NC}"
echo -e "  ${GREEN}✓${NC} Composer instalado y dependencias de PHP instaladas"
echo -e "  ${GREEN}✓${NC} Node.js/NPM instalado y dependencias instaladas"
echo -e "  ${GREEN}✓${NC} Assets compilados con Vite"
echo -e "  ${GREEN}✓${NC} MySQL instalado y configurado"
echo -e "  ${GREEN}✓${NC} Base de datos '$DB_DATABASE' creada"
echo -e "  ${GREEN}✓${NC} Usuario '$DB_USERNAME' configurado"
echo -e "  ${GREEN}✓${NC} Migraciones ejecutadas"

echo -e "\n${BLUE}Puedes iniciar el servidor de desarrollo con:${NC}"
echo -e "  ${YELLOW}php artisan serve${NC}"

echo -e "\n${BLUE}El servidor estará disponible en:${NC}"
echo -e "  ${YELLOW}http://localhost:8000${NC}\n"
