# Asignación de Permisos a Roles - FisioClinic

## Descripción General

Sistema automatizado de asignación de permisos a roles para la clínica. Proporciona dos métodos de ejecución:

1. **Script Bash** (`scripts/assign_permissions_to_roles.sh`) - Ejecuta queries SQL directas
2. **Comando Artisan** (`php artisan permissions:assign-to-roles`) - Usa Eloquent/Query Builder

Ambos métodos son **idempotentes** y producen el mismo resultado.

---

## 📊 Distribución de Permisos por Rol

| Rol | Permisos | % Total | Nivel de Acceso |
|-----|----------|---------|-----------------|
| `publico` | 0 | 0% | Sin acceso al dashboard |
| `cliente` | 10 | 8.6% | Ver reservas propias, gestionar reseñas |
| `profesional` | 15 | 12.9% | Gestionar bloqueos, actualizar reservas |
| `recepcionista` | 34 | 29.3% | Gestión operativa completa |
| `super_admin` | 116 | 100% | Acceso total al sistema |

**Total de permisos en el sistema:** 116

---

## 🚀 Métodos de Ejecución

### Método 1: Script Bash (Recomendado para Docker)

**Uso:**
```bash
./scripts/assign_permissions_to_roles.sh
```

**Características:**
- ✅ Ejecuta queries SQL directas a través de Docker
- ✅ No requiere que Laravel esté configurado
- ✅ Reportes detallados con colores
- ✅ Funciona incluso si hay problemas con el código Laravel

**Requisitos:**
- Docker debe estar ejecutándose
- Los contenedores deben estar activos: `docker-compose up -d`

---

### Método 2: Comando Artisan (Recomendado para Desarrollo)

**Uso:**
```bash
# Dentro del contenedor
php artisan permissions:assign-to-roles

# Desde el host con Docker
docker exec -i iw_grupal_parte2_app_1 php artisan permissions:assign-to-roles

# Modo silencioso (sin confirmación)
php artisan permissions:assign-to-roles --force
```

**Características:**
- ✅ Usa Eloquent/Query Builder de Laravel
- ✅ Integrado con el sistema de comandos Artisan
- ✅ Limpia automáticamente el caché de permisos
- ✅ Mejor integración con el ecosistema Laravel

**Requisitos:**
- Laravel debe estar configurado correctamente
- Base de datos debe estar accesible desde Laravel

---

## 📋 Workflow Completo de Desarrollo

### Después de `migrate:fresh --seed`

```bash
# 1. Resetear base de datos
php artisan migrate:fresh --seed

# 2. Generar permisos de Shield
php artisan shield:generate --all

# 3. Asignar permisos a roles (elige uno)
./scripts/assign_permissions_to_roles.sh
# O
php artisan permissions:assign-to-roles --force

# 4. Crear super admin si es necesario
php artisan shield:super-admin --user=1

# 5. Limpiar cachés
php artisan permission:cache-reset
php artisan icons:cache
php artisan filament:optimize
```

---

## 🔍 Detalles de Permisos por Rol

### 👤 Cliente (10 permisos)

**Reservas** - Solo lectura:
```
ViewAny:Reserva
View:Reserva
```
> ⚠️ El cliente NO puede crear, editar ni eliminar reservas desde el panel admin.  
> Las reservas se crean desde el sistema público de la web.

**Reseñas** - CRUD completo (solo propias):
```
ViewAny:Resena
View:Resena
Create:Resena
Update:Resena
Delete:Resena
```
> 🔒 Las Policies aseguran que solo gestione sus propias reseñas.

**Página y Widgets**:
```
View:MiPerfil
View:ClienteStatsWidget
View:ProximasCitasWidget
```

---

### 👨‍⚕️ Profesional (15 permisos)

**BloqueHorarios** - CRUD completo (solo propios):
```
ViewAny:BloqueHorario
View:BloqueHorario
Create:BloqueHorario
Update:BloqueHorario
Delete:BloqueHorario
```
> 🔒 Las Policies aseguran que solo gestione sus propios bloqueos.

**Reservas** - Ver y actualizar:
```
ViewAny:Reserva
View:Reserva
Update:Reserva
```
> 📝 Puede añadir notas a las citas, pero no crearlas ni eliminarlas.

**Tratamientos** - Solo lectura:
```
ViewAny:Tratamiento
View:Tratamiento
```

**Reseñas** - Solo lectura:
```
ViewAny:Resena
View:Resena
```
> 👁️ Puede ver las reseñas que le hacen los clientes.

**Página y Widgets**:
```
View:MiPerfil
View:ProfesionalStatsWidget
View:ProximasCitasWidget
```

---

### 🧑‍💼 Recepcionista (34 permisos)

**Reservas** - CRUD completo:
```
ViewAny:Reserva, View:Reserva, Create:Reserva, Update:Reserva, Delete:Reserva
```

**BloqueHorarios** - CRUD completo:
```
ViewAny:BloqueHorario, View:BloqueHorario, Create:BloqueHorario, 
Update:BloqueHorario, Delete:BloqueHorario
```

**HorarioClinica** - CRUD completo:
```
ViewAny:HorarioClinica, View:HorarioClinica, Create:HorarioClinica, 
Update:HorarioClinica, Delete:HorarioClinica
```

**Usuarios** - CRUD sin eliminar:
```
ViewAny:User, View:User, Create:User, Update:User
```
> ⚠️ No puede eliminar usuarios (solo super_admin).

**ContactMessages** - CRUD completo:
```
ViewAny:ContactMessage, View:ContactMessage, Create:ContactMessage, 
Update:ContactMessage, Delete:ContactMessage
```

**Solo Lectura** (Habitaciones, Profesionales, Tratamientos):
```
ViewAny:Habitacion, View:Habitacion
ViewAny:Profesional, View:Profesional
ViewAny:Tratamiento, View:Tratamiento
```

**Página y Widgets**:
```
View:MiPerfil
View:ProximasCitasWidget
View:TratamientoStatsWidget
View:CancelacionInfoWidget
```

---

### 🔐 Super Admin (116 permisos)

El super_admin tiene **todos** los permisos del sistema, incluyendo los exclusivos:

**Permisos Destructivos** (solo super_admin):
```
ForceDelete:*
ForceDeleteAny:*
```

**Permisos de Restauración** (solo super_admin):
```
Restore:*
RestoreAny:*
```

**Permisos Especiales** (solo super_admin):
```
Replicate:*
Reorder:*
```

**Gestión de Roles** (solo super_admin):
```
ViewAny:Role
View:Role
Create:Role
Update:Role
Delete:Role
```

---

## 🔒 Restricciones de Seguridad

### Permisos Exclusivos del Super Admin

Los siguientes tipos de permisos **NUNCA** se asignan a otros roles:

1. **Eliminación Permanente**
   - `ForceDelete:*` - Eliminar un registro permanentemente
   - `ForceDeleteAny:*` - Eliminar múltiples registros permanentemente

2. **Restauración**
   - `Restore:*` - Restaurar un registro eliminado (soft delete)
   - `RestoreAny:*` - Restaurar múltiples registros

3. **Operaciones Especiales**
   - `Replicate:*` - Duplicar registros
   - `Reorder:*` - Reordenar registros

4. **Gestión de Roles**
   - Cualquier permiso sobre el recurso `Role`

---

## 🧪 Verificación Manual

### Verificar permisos de un rol específico:

```bash
# Cliente
docker exec -i $(docker ps -qf "name=db") mysql -uroot -proot clinica -e \
  "SELECT p.name FROM permissions p 
   JOIN role_has_permissions rhp ON p.id = rhp.permission_id 
   JOIN roles r ON rhp.role_id = r.id 
   WHERE r.name = 'cliente' 
   ORDER BY p.name;" | grep -v "mysql:"

# Profesional
docker exec -i $(docker ps -qf "name=db") mysql -uroot -proot clinica -e \
  "SELECT p.name FROM permissions p 
   JOIN role_has_permissions rhp ON p.id = rhp.permission_id 
   JOIN roles r ON rhp.role_id = r.id 
   WHERE r.name = 'profesional' 
   ORDER BY p.name;" | grep -v "mysql:"

# Recepcionista
docker exec -i $(docker ps -qf "name=db") mysql -uroot -proot clinica -e \
  "SELECT p.name FROM permissions p 
   JOIN role_has_permissions rhp ON p.id = rhp.permission_id 
   JOIN roles r ON rhp.role_id = r.id 
   WHERE r.name = 'recepcionista' 
   ORDER BY p.name;" | grep -v "mysql:"
```

### Contar permisos por rol:

```bash
docker exec -i $(docker ps -qf "name=db") mysql -uroot -proot clinica -e \
  "SELECT r.name as role_name, COUNT(rhp.permission_id) as total_permissions 
   FROM roles r 
   LEFT JOIN role_has_permissions rhp ON r.id = rhp.role_id 
   GROUP BY r.id, r.name 
   ORDER BY r.name;" | grep -v "mysql:"
```

---

## 🐛 Solución de Problemas

### Error: No se pudo conectar a la base de datos

**Causa:** Docker no está ejecutándose o los contenedores están detenidos.

**Solución:**
```bash
# Verificar contenedores
docker ps

# Iniciar contenedores
docker-compose up -d

# Esperar 10 segundos y reintentar
sleep 10
./scripts/assign_permissions_to_roles.sh
```

---

### Error: Se esperaban 5 roles, pero solo se encontraron X

**Causa:** Las migraciones no se han ejecutado o faltan roles.

**Solución:**
```bash
php artisan migrate:fresh --seed
```

---

### Error: Se esperaban al menos 100 permisos, pero solo se encontraron X

**Causa:** Los permisos de Filament Shield no se han generado.

**Solución:**
```bash
php artisan shield:generate --all
php artisan permission:cache-reset
```

---

### Los permisos no se reflejan en Filament

**Causa:** Caché de permisos desactualizado.

**Solución:**
```bash
php artisan permission:cache-reset
php artisan icons:cache
php artisan filament:optimize

# Limpiar caché del navegador
# O usar modo incógnito para probar
```

---

### El script se ejecuta pero los permisos no coinciden

**Causa:** Posible corrupción de datos o ejecución incompleta.

**Solución:**
```bash
# 1. Resetear completamente
php artisan migrate:fresh --seed

# 2. Regenerar permisos
php artisan shield:generate --all

# 3. Ejecutar el script nuevamente
./scripts/assign_permissions_to_roles.sh

# 4. Limpiar cachés
php artisan permission:cache-reset
```

---

## 📚 Recursos Adicionales

### Documentación Relacionada

- [Plan de Asignación de Permisos](../plans/script-asignacion-permisos.md)
- [README del Script](./README_PERMISOS.md)
- [Filament Shield Documentation](../Docs/FilamentShield.md)
- [Roles y Permisos del Proyecto](../Docs/ResumenProyecto.md)

### Archivos del Sistema

```
scripts/
├── assign_permissions_to_roles.sh     # Script Bash
├── README_PERMISOS.md                 # Guía detallada
└── PERMISOS_GUIA_COMPLETA.md         # Este archivo

app/Console/Commands/
└── AssignRolePermissions.php          # Comando Artisan

plans/
└── script-asignacion-permisos.md      # Plan de implementación
```

---

## 🔄 Mantenimiento

### Cuando se añade un nuevo Resource

1. Ejecuta `php artisan shield:generate --all` para generar los nuevos permisos
2. Actualiza el archivo `AssignRolePermissions.php` con los nuevos permisos
3. Actualiza el script bash `assign_permissions_to_roles.sh`
4. Ejecuta el script para asignar los nuevos permisos
5. Actualiza esta documentación

### Cuando se modifica la lógica de permisos

1. Actualiza ambos archivos: comando Artisan y script Bash
2. Actualiza la documentación en `README_PERMISOS.md`
3. Actualiza el plan en `plans/script-asignacion-permisos.md`
4. Prueba la asignación en un entorno de desarrollo
5. Documenta los cambios en el control de versiones

---

## ✅ Checklist de Verificación

Después de ejecutar el script, verifica:

- [ ] Cliente tiene 10 permisos
- [ ] Profesional tiene 15 permisos
- [ ] Recepcionista tiene 34 permisos
- [ ] Publico tiene 0 permisos
- [ ] Super_admin tiene 116 permisos
- [ ] El caché de permisos se limpió
- [ ] Los usuarios pueden acceder a sus recursos correspondientes
- [ ] Los usuarios NO pueden acceder a recursos no autorizados

---

## 📝 Notas de Implementación

### Características Técnicas

- **Idempotencia:** Usa `INSERT IGNORE` (SQL) o `insertOrIgnore` (Eloquent)
- **Transaccional:** Ambos métodos usan transacciones implícitas
- **Limpieza selectiva:** Nunca elimina permisos del super_admin
- **Verificación automática:** Valida conteos antes y después de la asignación
- **Reporte detallado:** Muestra resumen completo con estadísticas

### Diferencias entre Métodos

| Aspecto | Script Bash | Comando Artisan |
|---------|-------------|-----------------|
| Velocidad | Más rápido | Más lento |
| Dependencias | Solo Docker | Laravel completo |
| Integración | Independiente | Nativa Laravel |
| Caché | Manual | Automática |
| Debugging | Más difícil | Más fácil |

---

## 🎯 Jerarquía Final de Permisos

```
super_admin (116 permisos - 100%)
    └── Control total del sistema
        └── Permisos destructivos exclusivos
        
recepcionista (34 permisos - 29.3%)
    └── Gestión operativa diaria
        └── CRUD reservas, horarios, usuarios
        
profesional (15 permisos - 12.9%)
    └── Gestión de agenda y citas
        └── CRUD bloqueos propios, actualizar reservas
        
cliente (10 permisos - 8.6%)
    └── Gestión personal
        └── Ver reservas, CRUD reseñas propias
        
publico (0 permisos - 0%)
    └── Sin acceso al dashboard
        └── Solo acceso a la web pública
```

---

## 📧 Soporte

Para problemas o preguntas sobre la asignación de permisos:

1. Revisa esta documentación completa
2. Verifica los logs del script
3. Consulta el plan de implementación
4. Revisa la documentación de Filament Shield

---

**Versión:** 1.0.0  
**Fecha:** Enero 2026  
**Proyecto:** FisioClinic - Sistema de Gestión de Clínica
