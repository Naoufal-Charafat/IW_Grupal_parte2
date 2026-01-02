#!/bin/bash

# Colores para mensajes
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}🧹 Iniciando limpieza de entorno Laravel...${NC}"

# 1. Limpiar cachés de Laravel
echo -e "${GREEN}📦 Limpiando cachés de la aplicación...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 2. Eliminar archivos de caché de bootstrap si existen (creados por Docker)
echo -e "${GREEN}🗑️  Eliminando archivos pre-compilados...${NC}"
rm -f bootstrap/cache/*.php

# 3. Ajustar permisos
echo -e "${GREEN}🔒 Ajustando permisos de carpetas...${NC}"
chmod -R 775 storage bootstrap/cache

# 4. Asegurar que el usuario actual es el dueño
echo -e "${GREEN}👤 Ajustando propietario de archivos...${NC}"
# Solo ejecutamos chown si no somos dueños
if [ ! -O storage ]; then
    sudo chown -R $USER:$USER .
fi

echo -e "${GREEN}✅ ¡Entorno limpio y listo!${NC}"
echo -e "${YELLOW}👉 Ahora puedes ejecutar: ${GREEN}php artisan serve${NC}"
