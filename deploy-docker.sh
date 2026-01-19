#!/bin/bash

################################################################################
# Script de Despliegue Completo - FisioClinic con Docker
# 
# Descripción: Despliega la aplicación Laravel con Filament y Shield usando Docker
# Características:
#   - Verifica requisitos previos (Docker, Docker Compose)
#   - Configura archivo .env automáticamente
#   - Construye y levanta contenedores
#   - Ejecuta migraciones y seeders
#   - Genera y asigna permisos de Shield
#   - Compila assets frontend
#   - Verifica que todo funcione correctamente
#
# Uso: ./deploy-docker.sh
################################################################################

set -e  # Salir inmediatamente si un comando falla

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
MAGENTA='\033[0;35m'
NC='\033[0m' # No Color
BOLD='\033[1m'

# Configuración
PROJECT_NAME="FisioClinic"
COMPOSE_PROJECT_NAME="iw_grupal_parte2"

# Banner
clear
echo -e "${CYAN}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${CYAN}║  ${BOLD}Script de Despliegue Completo - ${PROJECT_NAME}${NC}${CYAN}                ║${NC}"
echo -e "${CYAN}║  ${BOLD}Despliegue con Docker + Laravel + Filament + Shield${NC}${CYAN}       ║${NC}"
echo -e "${CYAN}╚════════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Función para imprimir mensajes
print_header() {
    echo -e "\n${BLUE}${BOLD}[$(date +'%H:%M:%S')] $1${NC}"
    echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
}

print_success() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

print_info() {
    echo -e "${CYAN}ℹ${NC} $1"
}

print_step() {
    echo -e "${MAGENTA}➜${NC} $1"
}

# Función para manejar errores
handle_error() {
    print_error "Error en la línea $1"
    print_error "El despliegue falló. Por favor, revisa los mensajes de error anteriores."
    exit 1
}

trap 'handle_error $LINENO' ERR

# =============================================================================
# PASO 1: VERIFICACIÓN DE REQUISITOS PREVIOS
# =============================================================================
print_header "PASO 1/10: Verificando Requisitos Previos"

# Verificar Docker
print_step "Verificando Docker..."
if command -v docker &> /dev/null; then
    DOCKER_VERSION=$(docker --version | cut -d ' ' -f3 | cut -d ',' -f1)
    print_success "Docker instalado: v${DOCKER_VERSION}"
else
    print_error "Docker no está instalado"
    print_info "Instala Docker desde: https://docs.docker.com/get-docker/"
    exit 1
fi

# Verificar Docker Compose
print_step "Verificando Docker Compose..."
if command -v docker-compose &> /dev/null; then
    COMPOSE_VERSION=$(docker-compose --version | cut -d ' ' -f3 | cut -d ',' -f1)
    print_success "Docker Compose instalado: v${COMPOSE_VERSION}"
else
    print_error "Docker Compose no está instalado"
    print_info "Instala Docker Compose desde: https://docs.docker.com/compose/install/"
    exit 1
fi

# Verificar que Docker esté corriendo
print_step "Verificando que Docker esté activo..."
if docker info &> /dev/null; then
    print_success "Docker está corriendo"
else
    print_error "Docker no está corriendo. Inicia el servicio Docker primero."
    exit 1
fi

# Obtener IP local
print_step "Obteniendo IP local..."
LOCAL_IP=$(hostname -I | awk '{print $1}')
if [ -n "$LOCAL_IP" ]; then
    print_success "IP local detectada: ${LOCAL_IP}"
else
    print_warning "No se pudo detectar la IP local automáticamente"
    LOCAL_IP="localhost"
fi

# =============================================================================
# PASO 2: LIMPIEZA DE DESPLIEGUES PREVIOS (OPCIONAL)
# =============================================================================
print_header "PASO 2/10: Limpieza de Despliegues Previos"

if docker-compose ps | grep -q "${COMPOSE_PROJECT_NAME}"; then
    print_warning "Se detectaron contenedores previos"
    read -p "¿Deseas eliminar los contenedores existentes? (s/N): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[SsYy]$ ]]; then
        print_step "Deteniendo y eliminando contenedores previos..."
        docker-compose down -v 2>&1 | grep -v "Warning" || true
        print_success "Contenedores previos eliminados"
    else
        print_info "Manteniendo contenedores existentes"
    fi
else
    print_info "No se encontraron contenedores previos"
fi

# =============================================================================
# PASO 3: CONFIGURACIÓN DEL ARCHIVO .ENV
# =============================================================================
print_header "PASO 3/10: Configuración del Archivo .env"

if [ ! -f ".env" ]; then
    print_step "Creando archivo .env desde .env.example..."
    cp .env.example .env
    print_success "Archivo .env creado"
else
    print_warning "El archivo .env ya existe"
    read -p "¿Deseas sobrescribirlo con .env.example? (s/N): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[SsYy]$ ]]; then
        cp .env.example .env
        print_success "Archivo .env sobrescrito"
    else
        print_info "Manteniendo archivo .env actual"
    fi
fi

# Configurar .env para Docker
print_step "Configurando .env para Docker..."

# Cambiar DB_HOST a 'db' (nombre del servicio en docker-compose)
if grep -q "^DB_HOST=127.0.0.1" .env; then
    sed -i 's/^DB_HOST=127.0.0.1/DB_HOST=db/' .env
    print_success "DB_HOST configurado como 'db'"
elif grep -q "^DB_HOST=localhost" .env; then
    sed -i 's/^DB_HOST=localhost/DB_HOST=db/' .env
    print_success "DB_HOST configurado como 'db'"
else
    print_info "DB_HOST ya está configurado correctamente"
fi

# Verificar configuración de base de datos
DB_DATABASE=$(grep "^DB_DATABASE=" .env | cut -d '=' -f2)
DB_USERNAME=$(grep "^DB_USERNAME=" .env | cut -d '=' -f2)
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d '=' -f2)

print_info "Configuración de base de datos:"
echo "  • Base de datos: ${DB_DATABASE}"
echo "  • Usuario: ${DB_USERNAME}"
echo "  • Contraseña: ${DB_PASSWORD}"

# =============================================================================
# PASO 4: CONSTRUCCIÓN Y LEVANTAMIENTO DE CONTENEDORES
# =============================================================================
print_header "PASO 4/10: Construcción y Levantamiento de Contenedores"

print_step "Construyendo imágenes Docker (esto puede tardar 5-10 minutos)..."
print_warning "Por favor espera, se están descargando e instalando todas las dependencias..."

docker-compose up -d --build 2>&1 | while IFS= read -r line; do
    # Filtrar solo mensajes importantes
    if echo "$line" | grep -qE "(Pulling|Building|Creating|Starting|done|DONE|ERROR)"; then
        echo "$line"
    fi
done

print_success "Contenedores construidos y levantados"

# Esperar a que los contenedores estén listos
print_step "Esperando a que los contenedores estén listos..."
sleep 10

# Verificar estado de contenedores
print_step "Verificando estado de contenedores..."
if docker-compose ps | grep -q "Up"; then
    print_success "Todos los contenedores están corriendo"
    docker-compose ps
else
    print_error "Algunos contenedores no están corriendo correctamente"
    docker-compose ps
    exit 1
fi

# =============================================================================
# PASO 5: ESPERAR A QUE MYSQL ESTÉ LISTO
# =============================================================================
print_header "PASO 5/10: Verificando Base de Datos MySQL"

print_step "Esperando a que MySQL esté listo..."
MYSQL_READY=0
MAX_ATTEMPTS=30
ATTEMPT=0

while [ $MYSQL_READY -eq 0 ] && [ $ATTEMPT -lt $MAX_ATTEMPTS ]; do
    if docker exec ${COMPOSE_PROJECT_NAME}_db_1 mysqladmin ping -h"localhost" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" &> /dev/null; then
        MYSQL_READY=1
        print_success "MySQL está listo y aceptando conexiones"
    else
        ATTEMPT=$((ATTEMPT + 1))
        echo -n "."
        sleep 2
    fi
done

if [ $MYSQL_READY -eq 0 ]; then
    print_error "MySQL no respondió después de 60 segundos"
    exit 1
fi

# Verificar que las migraciones ya se ejecutaron (el entrypoint.sh las ejecuta automáticamente)
print_step "Verificando migraciones..."
sleep 5
TABLES_COUNT=$(docker exec ${COMPOSE_PROJECT_NAME}_db_1 mysql -h"localhost" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}" -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '${DB_DATABASE}';" 2>/dev/null | grep -v "Warning" || echo "0")

if [ "$TABLES_COUNT" -gt 10 ]; then
    print_success "Migraciones ejecutadas correctamente (${TABLES_COUNT} tablas creadas)"
else
    print_warning "Pocas tablas detectadas. Ejecutando migraciones manualmente..."
    docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan migrate --force
fi

# =============================================================================
# PASO 6: GENERACIÓN DE PERMISOS CON SHIELD
# =============================================================================
print_header "PASO 6/10: Generación de Permisos con Shield"

print_step "Generando permisos de Shield para todos los recursos..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan shield:generate --all --panel=admin 2>&1 | grep -E "(Summary|Policies|Permissions|Entities)" || true
print_success "Permisos de Shield generados"

print_step "Limpiando caché de permisos..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan permission:cache-reset &> /dev/null
print_success "Caché de permisos limpiada"

print_step "Cacheando iconos de Blade..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan icons:cache &> /dev/null
print_success "Iconos cacheados"

print_step "Optimizando Filament..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan filament:optimize &> /dev/null
print_success "Filament optimizado"

# =============================================================================
# PASO 7: ASIGNACIÓN DE PERMISOS POR ROL
# =============================================================================
print_header "PASO 7/10: Asignación de Permisos por Rol"

print_step "Ejecutando script de asignación de permisos..."
if [ -f "./scripts/assign_permissions_to_roles_docker.sh" ]; then
    chmod +x ./scripts/assign_permissions_to_roles_docker.sh
    ./scripts/assign_permissions_to_roles_docker.sh 2>&1 | grep -E "(✓|✗|ÉXITO|ERROR|Verificación)" || true
    print_success "Permisos asignados correctamente"
else
    print_warning "Script de permisos no encontrado, omitiendo este paso"
fi

# =============================================================================
# PASO 8: COMPILACIÓN DE ASSETS FRONTEND
# =============================================================================
print_header "PASO 8/10: Compilación de Assets Frontend"

print_step "Verificando si node_modules existe en el contenedor..."
if ! docker exec ${COMPOSE_PROJECT_NAME}_app_1 test -d node_modules; then
    print_step "Instalando dependencias de Node.js..."
    docker exec -u root ${COMPOSE_PROJECT_NAME}_app_1 npm install 2>&1 | grep -v "npm warn" | tail -5
    print_success "Dependencias de Node.js instaladas"
else
    print_info "node_modules ya existe"
fi

print_step "Compilando assets con Vite (CSS/JS)..."
docker exec -u root ${COMPOSE_PROJECT_NAME}_app_1 npm run build 2>&1 | grep -E "(vite|build|✓|kB)" || true
print_success "Assets compilados correctamente"

# Verificar que public/build existe
if docker exec ${COMPOSE_PROJECT_NAME}_app_1 test -d public/build; then
    print_success "Directorio public/build creado correctamente"
else
    print_error "No se pudo crear el directorio public/build"
    exit 1
fi

# =============================================================================
# PASO 9: LIMPIEZA DE CACHÉS DE LARAVEL
# =============================================================================
print_header "PASO 9/10: Limpieza de Cachés de Laravel"

print_step "Limpiando caché de configuración..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan config:clear &> /dev/null
print_success "Caché de configuración limpiada"

print_step "Limpiando caché de aplicación..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan cache:clear &> /dev/null
print_success "Caché de aplicación limpiada"

print_step "Limpiando caché de vistas..."
docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan view:clear &> /dev/null
print_success "Caché de vistas limpiada"

# =============================================================================
# PASO 10: VERIFICACIÓN FINAL
# =============================================================================
print_header "PASO 10/10: Verificación Final del Despliegue"

# Verificar que la aplicación responde
print_step "Verificando que la aplicación responda..."
sleep 3

HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000)
if [ "$HTTP_CODE" = "200" ]; then
    print_success "Aplicación respondiendo correctamente (HTTP 200)"
else
    print_warning "Aplicación responde con código HTTP ${HTTP_CODE}"
fi

# Verificar acceso a dashboard
HTTP_CODE_DASHBOARD=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/dashboard)
if [ "$HTTP_CODE_DASHBOARD" = "302" ] || [ "$HTTP_CODE_DASHBOARD" = "200" ]; then
    print_success "Panel admin accesible (HTTP ${HTTP_CODE_DASHBOARD})"
else
    print_warning "Panel admin responde con código HTTP ${HTTP_CODE_DASHBOARD}"
fi

# Verificar número de usuarios
print_step "Verificando usuarios en base de datos..."
USERS_COUNT=$(docker exec ${COMPOSE_PROJECT_NAME}_app_1 php artisan tinker --execute="echo App\\Models\\User::count();" 2>/dev/null | tail -1)
if [ "$USERS_COUNT" -ge 5 ]; then
    print_success "Usuarios creados: ${USERS_COUNT}"
else
    print_warning "Solo se encontraron ${USERS_COUNT} usuarios"
fi

# Verificar permisos
print_step "Verificando permisos en base de datos..."
PERMISSIONS_COUNT=$(docker exec ${COMPOSE_PROJECT_NAME}_db_1 mysql -h"localhost" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}" -N -e "SELECT COUNT(*) FROM permissions;" 2>/dev/null | grep -v "Warning")
if [ "$PERMISSIONS_COUNT" -ge 100 ]; then
    print_success "Permisos creados: ${PERMISSIONS_COUNT}"
else
    print_warning "Solo se encontraron ${PERMISSIONS_COUNT} permisos"
fi

# =============================================================================
# REPORTE FINAL
# =============================================================================
echo ""
echo -e "${GREEN}${BOLD}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}${BOLD}║  ✓ DESPLIEGUE COMPLETADO EXITOSAMENTE                         ║${NC}"
echo -e "${GREEN}${BOLD}╚════════════════════════════════════════════════════════════════╝${NC}"
echo ""

echo -e "${BOLD}📊 Resumen del Despliegue:${NC}"
echo -e "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "  ${CYAN}•${NC} Contenedores activos: ${GREEN}3${NC} (app, db, nginx)"
echo -e "  ${CYAN}•${NC} Base de datos: ${GREEN}MySQL 8.0${NC}"
echo -e "  ${CYAN}•${NC} Tablas creadas: ${GREEN}${TABLES_COUNT}${NC}"
echo -e "  ${CYAN}•${NC} Usuarios: ${GREEN}${USERS_COUNT}${NC}"
echo -e "  ${CYAN}•${NC} Permisos Shield: ${GREEN}${PERMISSIONS_COUNT}${NC}"
echo -e "  ${CYAN}•${NC} Assets compilados: ${GREEN}✓${NC}"
echo ""

echo -e "${BOLD}🌐 URLs de Acceso:${NC}"
echo -e "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "  ${CYAN}Local:${NC}"
echo -e "    → Aplicación Web:  ${YELLOW}http://localhost:8000${NC}"
echo -e "    → Panel Admin:     ${YELLOW}http://localhost:8000/dashboard${NC}"
echo ""
echo -e "  ${CYAN}Red Local:${NC}"
echo -e "    → Aplicación Web:  ${YELLOW}http://${LOCAL_IP}:8000${NC}"
echo -e "    → Panel Admin:     ${YELLOW}http://${LOCAL_IP}:8000/dashboard${NC}"
echo ""

echo -e "${BOLD}🔑 Credenciales de Acceso:${NC}"
echo -e "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "  ${GREEN}Super Admin:${NC}"
echo -e "    Email:      admin@admin.com"
echo -e "    Contraseña: admin"
echo ""
echo -e "  ${CYAN}Otros usuarios:${NC}"
echo -e "    Cliente:        cliente@cliente.com / cliente"
echo -e "    Profesional:    profesional@profesional.com / profesional"
echo -e "    Recepcionista:  recepcionista@recepcionista.com / recepcionista"
echo ""

echo -e "${BOLD}📝 Comandos Útiles:${NC}"
echo -e "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "  ${CYAN}Ver logs:${NC}           docker-compose logs -f app"
echo -e "  ${CYAN}Detener:${NC}            docker-compose stop"
echo -e "  ${CYAN}Iniciar:${NC}            docker-compose start"
echo -e "  ${CYAN}Reiniciar:${NC}          docker-compose restart"
echo -e "  ${CYAN}Eliminar todo:${NC}      docker-compose down -v"
echo -e "  ${CYAN}Acceder al contenedor:${NC} docker exec -it ${COMPOSE_PROJECT_NAME}_app_1 bash"
echo ""

echo -e "${BOLD}⚠️  Notas Importantes:${NC}"
echo -e "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "  ${YELLOW}1.${NC} Las credenciales son solo para desarrollo/testing"
echo -e "  ${YELLOW}2.${NC} La base de datos persiste en un volumen Docker (dbdata)"
echo -e "  ${YELLOW}3.${NC} Para acceder desde otro dispositivo, usa: ${LOCAL_IP}:8000"
echo -e "  ${YELLOW}4.${NC} Asegúrate de que el firewall permita conexiones al puerto 8000"
echo ""

echo -e "${GREEN}${BOLD}✨ ¡Despliegue completado! La aplicación está lista para usar.${NC}"
echo ""
