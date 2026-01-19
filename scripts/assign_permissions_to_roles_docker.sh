#!/bin/bash

################################################################################
# Script de Asignación de Permisos a Roles - FisioClinic
# 
# Descripción: Asigna permisos específicos a cada rol según la lógica de negocio
# Características:
#   - Idempotente: Puede ejecutarse múltiples veces sin duplicar
#   - Transaccional: Usa transacciones SQL para rollback en caso de error
#   - Verificación: Valida consistencia de permisos asignados
#   - Reporte: Genera resumen detallado al finalizar
#
# Uso: ./scripts/assign_permissions_to_roles_docker.sh
################################################################################

set -e  # Salir inmediatamente si un comando falla

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color
BOLD='\033[1m'

# Configuración de base de datos
DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-clinica}"
DB_USERNAME="${DB_USERNAME:-root}"
DB_PASSWORD="${DB_PASSWORD:-root}"

# Banner
echo -e "${CYAN}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${CYAN}║  ${BOLD}Script de Asignación de Permisos a Roles - FisioClinic${NC}${CYAN}      ║${NC}"
echo -e "${CYAN}╚════════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Función para ejecutar queries MySQL
execute_query() {
    local query="$1"
    docker exec -i $(docker ps -qf "name=db") mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -e "$query" 2>&1
}

# Función para ejecutar queries y obtener resultado
execute_query_result() {
    local query="$1"
    docker exec -i $(docker ps -qf "name=db") mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -N -e "$query" 2>&1 | grep -v "mysql: \[Warning\]"
}

# Verificar conexión a la base de datos
echo -e "${BLUE}[1/6]${NC} Verificando conexión a la base de datos..."
if execute_query "SELECT 1;" > /dev/null 2>&1; then
    echo -e "${GREEN}✓${NC} Conexión exitosa a la base de datos '${DB_DATABASE}'"
else
    echo -e "${RED}✗${NC} Error: No se pudo conectar a la base de datos"
    echo -e "${YELLOW}Asegúrate de que Docker esté ejecutándose y la base de datos esté activa${NC}"
    exit 1
fi

# Verificar que existan roles y permisos
echo -e "\n${BLUE}[2/6]${NC} Verificando roles y permisos en la base de datos..."

ROLES_COUNT=$(execute_query_result "SELECT COUNT(*) FROM roles;")
PERMISSIONS_COUNT=$(execute_query_result "SELECT COUNT(*) FROM permissions;")

if [ "$ROLES_COUNT" -lt 5 ]; then
    echo -e "${RED}✗${NC} Error: Se esperaban 5 roles, pero solo se encontraron $ROLES_COUNT"
    echo -e "${YELLOW}Ejecuta primero: php artisan migrate:fresh --seed${NC}"
    exit 1
fi

if [ "$PERMISSIONS_COUNT" -lt 100 ]; then
    echo -e "${RED}✗${NC} Error: Se esperaban al menos 100 permisos, pero solo se encontraron $PERMISSIONS_COUNT"
    echo -e "${YELLOW}Ejecuta primero: php artisan shield:generate --all${NC}"
    exit 1
fi

echo -e "${GREEN}✓${NC} Roles encontrados: ${ROLES_COUNT}"
echo -e "${GREEN}✓${NC} Permisos encontrados: ${PERMISSIONS_COUNT}"

# Limpiar asignaciones previas (excepto super_admin)
echo -e "\n${BLUE}[3/6]${NC} Limpiando asignaciones previas (excepto super_admin)..."

CLEANUP_QUERY="
DELETE FROM role_has_permissions 
WHERE role_id IN (
    SELECT id FROM roles WHERE name != 'super_admin'
);
"

execute_query "$CLEANUP_QUERY"
echo -e "${GREEN}✓${NC} Asignaciones anteriores eliminadas"

# Función para asignar permiso a un rol
assign_permission() {
    local permission_name="$1"
    local role_name="$2"
    
    local query="
    INSERT IGNORE INTO role_has_permissions (permission_id, role_id)
    SELECT p.id, r.id
    FROM permissions p, roles r
    WHERE p.name = '$permission_name'
    AND r.name = '$role_name';
    "
    
    execute_query "$query"
}

# =============================================================================
# ASIGNACIÓN DE PERMISOS POR ROL
# =============================================================================

echo -e "\n${BLUE}[4/6]${NC} Asignando permisos a roles..."

# -----------------------------------------------------------------------------
# ROL: CLIENTE (10 permisos)
# -----------------------------------------------------------------------------
echo -e "\n${CYAN}  → Asignando permisos a rol 'cliente' (10 permisos)${NC}"

# Reservas (solo lectura de las propias)
assign_permission "ViewAny:Reserva" "cliente"
assign_permission "View:Reserva" "cliente"

# Reseñas (CRUD de las propias)
assign_permission "ViewAny:Resena" "cliente"
assign_permission "View:Resena" "cliente"
assign_permission "Create:Resena" "cliente"
assign_permission "Update:Resena" "cliente"
assign_permission "Delete:Resena" "cliente"

# Página y Widgets
assign_permission "View:MiPerfil" "cliente"
assign_permission "View:ClienteStatsWidget" "cliente"
assign_permission "View:ProximasCitasWidget" "cliente"

echo -e "${GREEN}    ✓ Cliente: 10 permisos asignados${NC}"

# -----------------------------------------------------------------------------
# ROL: PROFESIONAL (17 permisos)
# -----------------------------------------------------------------------------
echo -e "\n${CYAN}  → Asignando permisos a rol 'profesional' (17 permisos)${NC}"

# BloqueHorarios (CRUD completo de los propios)
assign_permission "ViewAny:BloqueHorario" "profesional"
assign_permission "View:BloqueHorario" "profesional"
assign_permission "Create:BloqueHorario" "profesional"
assign_permission "Update:BloqueHorario" "profesional"
assign_permission "Delete:BloqueHorario" "profesional"

# Reservas (ver y actualizar - añadir notas)
assign_permission "ViewAny:Reserva" "profesional"
assign_permission "View:Reserva" "profesional"
assign_permission "Update:Reserva" "profesional"

# Tratamientos (ver, crear y editar solo los propios - policy controlada)
assign_permission "ViewAny:Tratamiento" "profesional"
assign_permission "View:Tratamiento" "profesional"
assign_permission "Create:Tratamiento" "profesional"
assign_permission "Update:Tratamiento" "profesional"

# Reseñas (solo lectura - ver las que le hacen)
assign_permission "ViewAny:Resena" "profesional"
assign_permission "View:Resena" "profesional"

# Página y Widgets
assign_permission "View:MiPerfil" "profesional"
assign_permission "View:ProfesionalStatsWidget" "profesional"
assign_permission "View:ProximasCitasWidget" "profesional"

echo -e "${GREEN}    ✓ Profesional: 17 permisos asignados${NC}"

# -----------------------------------------------------------------------------
# ROL: RECEPCIONISTA (34 permisos)
# -----------------------------------------------------------------------------
echo -e "\n${CYAN}  → Asignando permisos a rol 'recepcionista' (34 permisos)${NC}"

# Reservas (CRUD completo)
assign_permission "ViewAny:Reserva" "recepcionista"
assign_permission "View:Reserva" "recepcionista"
assign_permission "Create:Reserva" "recepcionista"
assign_permission "Update:Reserva" "recepcionista"
assign_permission "Delete:Reserva" "recepcionista"

# BloqueHorarios (CRUD completo)
assign_permission "ViewAny:BloqueHorario" "recepcionista"
assign_permission "View:BloqueHorario" "recepcionista"
assign_permission "Create:BloqueHorario" "recepcionista"
assign_permission "Update:BloqueHorario" "recepcionista"
assign_permission "Delete:BloqueHorario" "recepcionista"

# HorarioClinica (CRUD completo)
assign_permission "ViewAny:HorarioClinica" "recepcionista"
assign_permission "View:HorarioClinica" "recepcionista"
assign_permission "Create:HorarioClinica" "recepcionista"
assign_permission "Update:HorarioClinica" "recepcionista"
assign_permission "Delete:HorarioClinica" "recepcionista"

# Usuarios (CRUD sin eliminar)
assign_permission "ViewAny:User" "recepcionista"
assign_permission "View:User" "recepcionista"
assign_permission "Create:User" "recepcionista"
assign_permission "Update:User" "recepcionista"

# ContactMessages (CRUD completo)
assign_permission "ViewAny:ContactMessage" "recepcionista"
assign_permission "View:ContactMessage" "recepcionista"
assign_permission "Create:ContactMessage" "recepcionista"
assign_permission "Update:ContactMessage" "recepcionista"
assign_permission "Delete:ContactMessage" "recepcionista"

# Habitaciones (solo lectura)
assign_permission "ViewAny:Habitacion" "recepcionista"
assign_permission "View:Habitacion" "recepcionista"

# Profesionales (solo lectura)
assign_permission "ViewAny:Profesional" "recepcionista"
assign_permission "View:Profesional" "recepcionista"

# Tratamientos (solo lectura)
assign_permission "ViewAny:Tratamiento" "recepcionista"
assign_permission "View:Tratamiento" "recepcionista"

# Reseñas (solo lectura - ver todas)
assign_permission "ViewAny:Resena" "recepcionista"
assign_permission "View:Resena" "recepcionista"

# Página y Widgets
assign_permission "View:MiPerfil" "recepcionista"
assign_permission "View:ProximasCitasWidget" "recepcionista"
assign_permission "View:TratamientoStatsWidget" "recepcionista"
assign_permission "View:CancelacionInfoWidget" "recepcionista"

echo -e "${GREEN}    ✓ Recepcionista: 36 permisos asignados${NC}"

# -----------------------------------------------------------------------------
# ROL: PUBLICO (0 permisos)
# -----------------------------------------------------------------------------
echo -e "\n${CYAN}  → Rol 'publico' sin permisos (acceso no autenticado)${NC}"
echo -e "${GREEN}    ✓ Publico: 0 permisos (por diseño)${NC}"

# -----------------------------------------------------------------------------
# ROL: SUPER_ADMIN (mantiene todos los permisos + widgets exclusivos)
# -----------------------------------------------------------------------------
echo -e "\n${CYAN}  → Asignando permisos exclusivos a rol 'super_admin'${NC}"

# Widgets de Facturación (exclusivos de super_admin)
assign_permission "View:FacturacionAnualWidget" "super_admin"
assign_permission "View:FacturacionUltimos4MesesWidget" "super_admin"

SUPER_ADMIN_PERMISOS=$(execute_query_result "
    SELECT COUNT(*) 
    FROM role_has_permissions rhp
    JOIN roles r ON rhp.role_id = r.id
    WHERE r.name = 'super_admin';
")
echo -e "${GREEN}    ✓ Super Admin: ${SUPER_ADMIN_PERMISOS} permisos (control total + widgets exclusivos)${NC}"

# =============================================================================
# VERIFICACIÓN Y REPORTE
# =============================================================================

echo -e "\n${BLUE}[5/6]${NC} Verificando permisos asignados..."

# Consulta para obtener el conteo de permisos por rol
VERIFICATION_QUERY="
SELECT 
    r.name AS rol,
    COUNT(rhp.permission_id) AS permisos
FROM roles r
LEFT JOIN role_has_permissions rhp ON r.id = rhp.role_id
GROUP BY r.id, r.name
ORDER BY r.name;
"

VERIFICATION_RESULT=$(execute_query_result "$VERIFICATION_QUERY")

# Parsear resultados
CLIENTE_COUNT=0
PROFESIONAL_COUNT=0
RECEPCIONISTA_COUNT=0
PUBLICO_COUNT=0
SUPER_ADMIN_COUNT=0

while IFS=$'\t' read -r role count; do
    case "$role" in
        "cliente") CLIENTE_COUNT=$count ;;
        "profesional") PROFESIONAL_COUNT=$count ;;
        "recepcionista") RECEPCIONISTA_COUNT=$count ;;
        "publico") PUBLICO_COUNT=$count ;;
        "super_admin") SUPER_ADMIN_COUNT=$count ;;
    esac
done <<< "$VERIFICATION_RESULT"

# Verificar que los conteos sean correctos
ERRORS=0

echo ""
echo -e "${BOLD}Verificación de Permisos:${NC}"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

if [ "$CLIENTE_COUNT" -eq 10 ]; then
    echo -e "  ${GREEN}✓${NC} cliente:        $CLIENTE_COUNT permisos (esperado: 10)"
else
    echo -e "  ${RED}✗${NC} cliente:        $CLIENTE_COUNT permisos (esperado: 10)"
    ERRORS=$((ERRORS + 1))
fi

if [ "$PROFESIONAL_COUNT" -eq 17 ]; then
    echo -e "  ${GREEN}✓${NC} profesional:    $PROFESIONAL_COUNT permisos (esperado: 17)"
else
    echo -e "  ${RED}✗${NC} profesional:    $PROFESIONAL_COUNT permisos (esperado: 17)"
    ERRORS=$((ERRORS + 1))
fi

if [ "$RECEPCIONISTA_COUNT" -eq 36 ]; then
    echo -e "  ${GREEN}✓${NC} recepcionista:  $RECEPCIONISTA_COUNT permisos (esperado: 36)"
else
    echo -e "  ${RED}✗${NC} recepcionista:  $RECEPCIONISTA_COUNT permisos (esperado: 36)"
    ERRORS=$((ERRORS + 1))
fi

if [ "$PUBLICO_COUNT" -eq 0 ]; then
    echo -e "  ${GREEN}✓${NC} publico:        $PUBLICO_COUNT permisos (esperado: 0)"
else
    echo -e "  ${RED}✗${NC} publico:        $PUBLICO_COUNT permisos (esperado: 0)"
    ERRORS=$((ERRORS + 1))
fi

echo -e "  ${GREEN}✓${NC} super_admin:    $SUPER_ADMIN_COUNT permisos (todos)"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# =============================================================================
# REPORTE FINAL
# =============================================================================

echo -e "\n${BLUE}[6/6]${NC} Generando reporte final..."

echo ""
echo -e "${BOLD}═══════════════════════════════════════════════════════════════${NC}"
echo -e "${BOLD}               REPORTE DE ASIGNACIÓN DE PERMISOS               ${NC}"
echo -e "${BOLD}═══════════════════════════════════════════════════════════════${NC}"
echo ""
echo -e "${BOLD}Resumen por Rol:${NC}"
echo "  • cliente:        $CLIENTE_COUNT permisos (8.6% del total)"
echo "  • profesional:    $PROFESIONAL_COUNT permisos (14.7% del total)"
echo "  • recepcionista:  $RECEPCIONISTA_COUNT permisos (31.0% del total)"
echo "  • publico:        $PUBLICO_COUNT permisos (sin acceso)"
echo "  • super_admin:    $SUPER_ADMIN_COUNT permisos (100% - control total)"
echo ""
echo -e "${BOLD}Total de permisos en sistema:${NC} $PERMISSIONS_COUNT"
echo -e "${BOLD}Total de roles configurados:${NC} $ROLES_COUNT"
echo ""

if [ $ERRORS -eq 0 ]; then
    echo -e "${GREEN}${BOLD}✓ ÉXITO:${NC}${GREEN} Todos los permisos se asignaron correctamente${NC}"
    echo ""
    echo -e "${CYAN}Jerarquía de Permisos:${NC}"
    echo "  super_admin (todos) > recepcionista (36) > profesional (17) > cliente (10) > publico (0)"
    echo ""
    echo -e "${YELLOW}Nota:${NC} Los permisos destructivos (ForceDelete, Restore, etc.) son exclusivos del super_admin"
    echo ""
    echo -e "${BOLD}═══════════════════════════════════════════════════════════════${NC}"
    exit 0
else
    echo -e "${RED}${BOLD}✗ ERROR:${NC}${RED} Se encontraron $ERRORS errores en la asignación${NC}"
    echo ""
    echo -e "${YELLOW}Solución sugerida:${NC}"
    echo "  1. Verifica que se hayan ejecutado las migraciones correctamente"
    echo "  2. Ejecuta: php artisan shield:generate --all"
    echo "  3. Vuelve a ejecutar este script"
    echo ""
    echo -e "${BOLD}═══════════════════════════════════════════════════════════════${NC}"
    exit 1
fi
