# Filament Shield - Sistema de Roles y Permisos

## 📋 Resumen

**Filament Shield** ha sido instalado y configurado exitosamente en el proyecto. Este paquete proporciona un sistema completo de gestión de roles y permisos para el panel de administración de Filament.

## 🎯 ¿Qué es Filament Shield?

Filament Shield es un paquete que integra el sistema de permisos de **Spatie Laravel Permission** con **Filament PHP**, proporcionando:

- ✅ Gestión de **Roles** y **Permisos**
- ✅ Interfaz gráfica para asignar permisos
- ✅ Generación automática de políticas (Policies)
- ✅ Control de acceso a Recursos, Páginas y Widgets
- ✅ Soporte para multi-tenancy (opcional)

---

## 🚀 Instalación Realizada

### 1. Paquetes Instalados

```bash
composer require bezhansalleh/filament-shield
```

**Dependencias instaladas:**
- `spatie/laravel-permission` - Sistema de roles y permisos
- `bezhansalleh/filament-shield` - Integración con Filament
- `bezhansalleh/filament-plugin-essentials` - Utilidades del plugin

### 2. Configuración del Modelo User

Se añadió el trait `HasRoles` al modelo `User`:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    // ...
}
```

### 3. Panel de Filament

Se creó el panel de administración:

```bash
php artisan filament:install --panels
```

- **Panel ID:** `admin`
- **Ruta:** `/admin`
- **Provider:** `app/Providers/Filament/AdminPanelProvider.php`

### 4. Instalación de Shield

```bash
php artisan shield:install admin
```

Shield se registró automáticamente en el `AdminPanelProvider`:

```php
->plugins([
    FilamentShieldPlugin::make(),
])
```

### 5. Migraciones

Se ejecutaron las migraciones que crean las siguientes tablas:

- `roles` - Almacena los roles
- `permissions` - Almacena los permisos
- `role_has_permissions` - Relación roles-permisos
- `model_has_roles` - Asignación de roles a usuarios
- `model_has_permissions` - Permisos directos a usuarios

### 6. Generación de Permisos

```bash
php artisan shield:generate --all --panel=admin
```

**Resultado:**
- ✅ 1 Política generada (`RolePolicy`)
- ✅ 11 Permisos creados
- ✅ 1 Recurso procesado (RoleResource)

---

## 📊 Estado Actual del Sistema

### Roles Creados

| ID | Nombre | Descripción |
|----|--------|-------------|
| 1  | `super_admin` | Rol con acceso completo al sistema |

### Permisos Generados (11)

Los permisos siguen el patrón: `Acción:Recurso`

| Permiso | Descripción |
|---------|-------------|
| `ViewAny:Role` | Ver listado de roles |
| `View:Role` | Ver detalle de un rol |
| `Create:Role` | Crear nuevos roles |
| `Update:Role` | Editar roles existentes |
| `Delete:Role` | Eliminar roles |
| `Restore:Role` | Restaurar roles eliminados |
| `ForceDelete:Role` | Eliminar permanentemente |
| `ForceDeleteAny:Role` | Eliminar cualquier rol permanentemente |
| `RestoreAny:Role` | Restaurar cualquier rol |
| `Replicate:Role` | Duplicar roles |
| `Reorder:Role` | Reordenar roles |

### Políticas Generadas

**Archivo:** `app/Policies/RolePolicy.php`

Esta política controla el acceso al recurso de gestión de roles usando los permisos generados.

---

## 🎮 Uso del Sistema

### Acceder al Panel de Administración

1. Inicia el servidor:
   ```bash
   php artisan serve
   ```

2. Accede a: `http://localhost:8000/admin`

3. El recurso de **Roles** estará disponible en el menú lateral

### Crear un Usuario Super Admin

Para asignar el rol de super admin a un usuario:

```bash
php artisan shield:super-admin --panel=admin
```

O mediante Tinker:

```php
php artisan tinker

use App\Models\User;
use Spatie\Permission\Models\Role;

$user = User::find(1); // ID del usuario
$role = Role::where('name', 'super_admin')->first();
$user->assignRole($role);
```

### Verificar Permisos de un Usuario

```php
// En tu código
if ($user->hasRole('super_admin')) {
    // El usuario es super admin
}

if ($user->can('Create:Role')) {
    // El usuario puede crear roles
}

// El super_admin tiene acceso a todo por defecto
```

---

## 🔧 Configuración

### Archivo de Configuración

**Ruta:** `config/filament-shield.php`

Configuraciones importantes:

```php
return [
    // Configuración del recurso de roles
    'shield_resource' => [
        'slug' => 'shield/roles',
        'show_model_path' => true,
        'cluster' => null,
        'tabs' => [
            'pages' => true,
            'widgets' => true,
            'resources' => true,
            'custom_permissions' => false,
        ],
    ],

    // Modelo de usuario
    'auth_provider_model' => 'App\\Models\\User',

    // Formato de permisos
    'permissions' => [
        'separator' => ':',
        'case' => 'pascal',
        'generate' => true,
    ],

    // Generación de políticas
    'policies' => [
        'path' => app_path('Policies'),
        'merge' => true,
        'generate' => true,
    ],
];
```

---

## 📝 Comandos Útiles

### Generar Permisos para Nuevos Recursos

Cuando crees nuevos recursos de Filament:

```bash
# Para todos los recursos
php artisan shield:generate --all --panel=admin

# Para recursos específicos
php artisan shield:generate --resource=UserResource,PostResource --panel=admin

# Solo permisos (sin políticas)
php artisan shield:generate --all --panel=admin --option=permissions

# Solo políticas (sin permisos)
php artisan shield:generate --all --panel=admin --option=policies
```

### Publicar el Recurso de Roles

Si necesitas personalizar el recurso de gestión de roles:

```bash
php artisan shield:publish --panel=admin
```

Esto creará: `app/Filament/Resources/RoleResource.php`

### Crear Seeder

Ya se generó un seeder que puedes usar en despliegues:

```bash
php artisan db:seed --class=ShieldSeeder
```

**Archivo:** `database/seeders/ShieldSeeder.php`

---

## 🛡️ Proteger Recursos, Páginas y Widgets

### Proteger un Recurso

Los recursos de Filament se protegen automáticamente con las políticas generadas. Ejemplo:

```php
namespace App\Filament\Resources;

use Filament\Resources\Resource;

class PostResource extends Resource
{
    // Shield protegerá automáticamente este recurso
    // usando la PostPolicy si existe
}
```

### Proteger una Página

Para páginas personalizadas, usa el trait `HasPageShield`:

```php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Settings extends Page
{
    use HasPageShield;
    
    // La página solo será visible para usuarios con el permiso correcto
}
```

### Proteger un Widget

Para widgets, usa el trait `HasWidgetShield`:

```php
namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class StatsWidget extends Widget
{
    use HasWidgetShield;
    
    // El widget solo será visible para usuarios autorizados
}
```

---

## 📚 Estructura de Roles Sugerida para FisioClinic

Basándonos en el proyecto, se recomienda crear los siguientes roles:

| Rol | Permisos Sugeridos |
|-----|-------------------|
| **Super Admin** | Acceso completo a todo |
| **Admin** | Gestión de usuarios, salas, horarios, reportes |
| **Recepcionista** | CRUD citas, asignar salas, ver profesionales |
| **Profesional** | Ver agenda, bloquear horarios, anotar citas |
| **Cliente** | Ver sus citas, realizar reservas |

### Crear Roles Personalizados

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Crear rol
$recepcionista = Role::create(['name' => 'recepcionista']);

// Asignar permisos
$recepcionista->givePermissionTo([
    'ViewAny:Appointment',
    'View:Appointment',
    'Create:Appointment',
    'Update:Appointment',
    'Delete:Appointment',
]);
```

---

## 🔍 Verificación de la Instalación

### Comprobar Roles y Permisos

```php
php artisan tinker

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Ver roles
Role::all()->pluck('name');

// Ver permisos
Permission::all()->pluck('name');

// Ver permisos de un rol
$role = Role::findByName('super_admin');
$role->permissions->pluck('name');
```

### Verificar Usuario con Rol

```php
$user = User::find(1);
$user->roles->pluck('name');
$user->getAllPermissions()->pluck('name');
```

---

## 🎨 Personalización del Recurso de Roles

Shield proporciona un recurso completo para gestionar roles con:

- **Tabs organizadas:** Recursos, Páginas, Widgets
- **Checkboxes** para asignar permisos
- **Select All/Deselect All** por categoría
- **Interfaz responsiva**

### Personalizar Apariencia

En `AdminPanelProvider.php` puedes configurar el plugin:

```php
FilamentShieldPlugin::make()
    ->gridColumns([
        'default' => 1,
        'sm' => 2,
        'lg' => 3
    ])
    ->sectionColumnSpan(1)
    ->checkboxListColumns([
        'default' => 1,
        'sm' => 2,
        'lg' => 4,
    ])
    ->resourceCheckboxListColumns([
        'default' => 1,
        'sm' => 2,
    ]);
```

---

## 📖 Recursos Adicionales

- **Documentación Oficial:** [Filament Shield GitHub](https://github.com/bezhansalleh/filament-shield)
- **Spatie Permission:** [Laravel Permission Docs](https://spatie.be/docs/laravel-permission)
- **Filament Docs:** [FilamentPHP.com](https://filamentphp.com)

---

## ✅ Checklist de Implementación

- [x] Instalar paquete `bezhansalleh/filament-shield`
- [x] Configurar modelo User con `HasRoles`
- [x] Crear panel de Filament
- [x] Instalar Shield en el panel
- [x] Ejecutar migraciones
- [x] Generar permisos y políticas
- [x] Crear seeder
- [ ] Asignar rol super_admin a un usuario
- [ ] Crear roles personalizados (Recepcionista, Profesional, Cliente)
- [ ] Generar permisos para futuros recursos
- [ ] Configurar permisos específicos por rol

---

## 🚨 Notas Importantes

1. **Super Admin Bypass:** El rol `super_admin` tiene acceso a todo por defecto sin necesidad de permisos específicos.

2. **Regenerar Permisos:** Cada vez que crees un nuevo Resource, Page o Widget en Filament, ejecuta:
   ```bash
   php artisan shield:generate --all --panel=admin
   ```

3. **Caché de Permisos:** Si los cambios no se reflejan, limpia la caché:
   ```bash
   php artisan permission:cache-reset
   ```

4. **Testing:** Al hacer tests, recuerda asignar roles/permisos a los usuarios de prueba:
   ```php
   $user = User::factory()->create();
   $user->assignRole('super_admin');
   ```

---

## 🎯 Próximos Pasos

1. **Crear usuarios de prueba** con diferentes roles
2. **Generar recursos** para las entidades del proyecto (Citas, Pacientes, etc.)
3. **Ejecutar `shield:generate`** para cada nuevo recurso
4. **Asignar permisos** específicos a cada rol según el diseño del proyecto
5. **Implementar middleware** personalizado si es necesario para rutas web

---

**Fecha de instalación:** 9 de diciembre de 2025
**Versión instalada:** Filament Shield 4.0.3
**Panel configurado:** admin
