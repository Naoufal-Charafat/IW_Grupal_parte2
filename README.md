<div align="center">

# 🏥 FisioClinic

**Sistema de Gestión de Clínica de Fisioterapia**

[![Estado](https://img.shields.io/badge/Estado-En%20Desarrollo-blue?style=flat-square)](#)
[![Versión](https://img.shields.io/badge/Versión-1.0.0-green?style=flat-square)](#)
[![Licencia](https://img.shields.io/badge/Licencia-MIT-orange?style=flat-square)](#-licencia)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat-square&logo=php)](#)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)](#)

Plataforma integral para la gestión de citas, profesionales y pacientes en clínicas de fisioterapia.

[Documentación](#-documentación) • [Instalación](#-instalación) • [Uso](#-uso) • [Contribuir](#-contribuir)

</div>

---

## 📖 Descripción

**FisioClinic** es una solución completa para clínicas de fisioterapia que facilita:

- 📅 **Gestión de Citas** - Sistema inteligente de reservas con calendario interactivo
- 👥 **Múltiples Roles** - Diferenciación de permisos por tipo de usuario
- 💳 **Procesamiento de Pagos** - Integración con TPV Virtual
- 🛒 **Tienda Online** - Catálogo de productos y servicios
- 📊 **Reportes** - Dashboard con estadísticas y análisis
- 📧 **Notificaciones** - Sistema automático de emails

El proyecto sigue la metodología **Git Flow** y se encuentra en fase de desarrollo inicial.

---

## 🛠️ Tecnologías

<table>
<tr>
<td align="center" width="33%">

**Backend**

![Laravel](https://img.shields.io/badge/Laravel-12.42.0-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4.15-777BB4?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql)

</td>
<td align="center" width="33%">

**Frontend**

![Tailwind](https://img.shields.io/badge/Tailwind-4.1.17-38B2AC?style=flat-square&logo=tailwindcss)
![Blade](https://img.shields.io/badge/Blade-Templates-FF2D20?style=flat-square)
![Livewire](https://img.shields.io/badge/Livewire-Components-4F46E5?style=flat-square)

</td>
<td align="center" width="33%">

**Admin & Seguridad**

![Filament](https://img.shields.io/badge/Filament-Admin-FFAA00?style=flat-square)
![Shield](https://img.shields.io/badge/Shield-Roles%2FPermisos-4F46E5?style=flat-square)
![Vite](https://img.shields.io/badge/Vite-7.0.7-646CFF?style=flat-square&logo=vite)

</td>
</tr>
</table>

---

## 🎯 Características Principales

### 🔐 Autenticación y Roles
- Sistema de login/registro seguro
- 5 roles diferenciados: Público, Cliente, Profesional, Recepcionista, Admin
- Control de acceso basado en roles (RBAC) con **Filament Shield**

### 📅 Gestión de Reservas
- Calendario interactivo
- Crear, modificar y cancelar citas
- Asignación automática de salas
- Filtrados avanzados

### 👨‍⚕️ Gestión de Profesionales
- Registro de especialidades
- Control de disponibilidad
- Bloqueo de horarios
- Historial de pacientes

### 🏥 Administración
- Panel administrativo con Filament
- Gestión de usuarios, salas y roles
- Configuración de horarios
- Generación de reportes
- Logs y monitorización

### 💳 Integraciones
- API TPV Virtual para pagos
- API REST propia para servicios
- Sistema de notificaciones por email

---

## 📦 Estructura del Proyecto

```
proyecto/
├── app/
│   ├── Filament/                # Recursos y páginas del admin
│   ├── Http/Controllers/        # Controladores
│   ├── Models/                  # Modelos Eloquent
│   ├── Policies/                # Políticas de autorización
│   └── Providers/               # Servicios
├── database/
│   ├── migrations/              # Migraciones
│   ├── factories/               # Factories
│   └── seeders/                 # Seeders
├── resources/
│   ├── views/                   # Plantillas Blade
│   ├── css/                     # Estilos
│   └── js/                      # Scripts
├── routes/                      # Rutas web y API
├── config/
│   ├── filament-shield.php      # Configuración de Shield
│   └── permission.php           # Configuración de permisos
├── storage/                     # Logs y cache
├── tests/                       # Tests
├── Docs/                        # Documentación
└── .env.example                 # Variables de entorno
```

---

## 🚀 Instalación

### Requisitos Previos
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+
- Git

### Pasos

**1. Clonar el repositorio**
```bash
git clone https://github.com/Naoufal-Charafat/IW_Grupal_parte2.git
cd IW_Grupal_parte2
```

**⚠️ IMPORTANTE - Leer primero para nuevos usuarios**

> **TODOS los nuevos usuarios DEBEN ejecutar el archivo `setup.sh` antes de trabajar en el proyecto**. Este script automatiza la instalación completa del proyecto, incluyendo:
> - Instalación de Composer y dependencias PHP (**Filament y Shield ya vienen incluidos**)
> - Instalación de Node.js/NPM y dependencias de frontend
> - Instalación y configuración de MySQL
> - Creación de la base de datos
> - Ejecución de migraciones y seeders
> - Compilación de assets
> 
> ℹ️ **Nota**: No necesitas instalar Filament ni Shield por separado. Ambos ya están configurados en el proyecto.

**2. Instalación automática (recomendado para nuevos usuarios)**
```bash
chmod +x setup.sh
./setup.sh
```

El script te guiará interactivamente a través de toda la configuración necesaria. **Es la forma más rápida y segura de preparar tu entorno de desarrollo.**

**3. O instalación manual (solo si el setup.sh falla)**

#### 3.1. Dependencias PHP y Configuración Laravel
```bash
# Instalar dependencias PHP (incluidas Filament y Shield)
# ⚠️ Esto es TODO lo que necesitas para instalar Filament y Shield
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Generar configuración de caché
php artisan config:cache
```

#### 3.2. Configurar la Base de Datos

Edita el archivo `.env` con tus credenciales MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinica
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

Luego ejecuta las migraciones:
```bash
php artisan migrate --force
```

#### 3.3. Dependencias Frontend
```bash
npm install
npm run build
```

#### 3.4. Configuración de Shield (Roles y Permisos)

Shield ya está configurado automáticamente, pero si necesitas regenerar los permisos para nuevos recursos:

```bash
# Generar permisos y políticas para todos los recursos
php artisan shield:generate --all --panel=admin

# Limpiar caché de permisos si es necesario
php artisan permission:cache-reset
```

#### 3.5. Ejecutar los Seeders

Los seeders crean los roles base y el usuario admin automáticamente:

```bash
php artisan db:seed
```

---

## � Docker

### Requisitos Previos
- Docker Engine 20.10+
- Docker Compose 1.29+

### Instalación de Docker

Si no tienes Docker instalado, ejecuta:

```bash
# Actualizar repositorios
sudo apt update

# Instalar Docker Compose
sudo apt install -y docker-compose

# Verificar instalación
docker-compose --version
```

### Lanzar el Proyecto con Docker

**1. Iniciar los contenedores**

```bash
# Construir y levantar todos los servicios en segundo plano
sudo docker-compose up -d --build
```

Este comando:
- 🏗️ Construye la imagen de Docker para la aplicación Laravel (puede tardar 15-20 minutos la primera vez)
- 📦 Descarga las imágenes de MySQL y Nginx
- 🚀 Levanta 3 contenedores: `app` (Laravel), `db` (MySQL), `nginx` (servidor web)
- ✅ Ejecuta automáticamente las migraciones y seeders
- 🔧 Configura los permisos necesarios

**2. Verificar que los contenedores están corriendo**

```bash
sudo docker-compose ps
```

Deberías ver algo como:
```
          Name                        Command               State                          Ports                       
-----------------------------------------------------------------------------------------------------------------------
iw_grupal_parte2_app_1     docker-php-entrypoint bash ...   Up      9000/tcp                                           
iw_grupal_parte2_db_1      docker-entrypoint.sh mysqld      Up      0.0.0.0:3307->3306/tcp,:::3307->3306/tcp, 33060/tcp
iw_grupal_parte2_nginx_1   /docker-entrypoint.sh ngin ...   Up      0.0.0.0:8000->80/tcp,:::8000->80/tcp
```

**3. Acceder a la aplicación**

- 🌐 **Aplicación Web**: `http://localhost:8000`
- 👤 **Panel Admin**: `http://localhost:8000/admin`
- 🗄️ **Base de Datos MySQL**: `localhost:3307` (puerto modificado para evitar conflictos)

### Comandos Útiles de Docker

```bash
# Ver logs de todos los servicios
sudo docker-compose logs

# Ver logs de un servicio específico
sudo docker-compose logs app
sudo docker-compose logs db
sudo docker-compose logs nginx

# Ver logs en tiempo real
sudo docker-compose logs -f app

# Detener los contenedores (sin eliminarlos)
sudo docker-compose stop

# Iniciar los contenedores detenidos
sudo docker-compose start

# Reiniciar un servicio específico
sudo docker-compose restart app

# Detener y eliminar todos los contenedores
sudo docker-compose down

# Detener, eliminar contenedores Y borrar volúmenes (⚠️ BORRA LA BASE DE DATOS)
sudo docker-compose down -v

# Ejecutar comandos dentro del contenedor de la aplicación
sudo docker exec -it iw_grupal_parte2_app_1 bash

# Ejecutar comandos de Artisan
sudo docker exec -it iw_grupal_parte2_app_1 php artisan migrate
sudo docker exec -it iw_grupal_parte2_app_1 php artisan tinker
```

### Conexión a la Base de Datos

Si necesitas conectarte a MySQL desde tu máquina local (con herramientas como MySQL Workbench, DBeaver, etc.):

```
Host: localhost
Puerto: 3307
Usuario: root
Contraseña: root (definida en el archivo .env)
Base de datos: clinica
```

> ⚠️ **Nota**: El puerto es `3307` en el host para evitar conflictos con instalaciones locales de MySQL que usan el puerto `3306`.


### 🔄 Alternar entre Docker y Local (IMPORTANTE)

Si trabajas con Docker y luego quieres volver a ejecutar `php artisan serve` localmente, es posible que encuentres errores de permisos o rutas incorrectas debido a la caché.

Para solucionar esto automáticamente, hemos creado un script:

```bash
# Ejecutar siempre que cambies de Docker a local
./scripts/clean_env.sh
```

Este script se encarga de:
1. Limpiar todas las cachés de Laravel
2. Eliminar archivos de configuración generados por Docker
3. Restaurar los permisos de escritura para tu usuario local

---

### Solución de Problemas

#### Error: "port is already allocated" (puerto ya en uso)

Si obtienes un error de puerto ocupado:

```bash
# Para el puerto 3306 (MySQL):
# - El docker-compose.yaml ya usa el puerto 3307 por defecto
# - Si aún hay conflicto, modifica el archivo docker-compose.yaml línea 49

# Para el puerto 8000 (Nginx):
sudo lsof -i :8000  # Ver qué proceso usa el puerto
sudo kill -9 <PID>  # Matar el proceso
```

#### Error: "permission denied" al ejecutar docker-compose

```bash
# Opción 1: Usar sudo
sudo docker-compose up -d

# Opción 2: Agregar tu usuario al grupo docker (recomendado)
sudo usermod -aG docker $USER
newgrp docker
docker-compose up -d  # Ya no necesita sudo
```

#### Error 500 al acceder a la aplicación

Si la aplicación responde con error 500, probablemente sea un problema de permisos. Ejecuta:

```bash
sudo docker exec iw_grupal_parte2_app_1 chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
sudo docker exec iw_grupal_parte2_app_1 chmod -R 775 /var/www/storage /var/www/bootstrap/cache
```

#### Los cambios en el código no se reflejan

```bash
# Reconstruir la imagen después de cambios importantes
sudo docker-compose up -d --build

# O reconstruir sin caché
sudo docker-compose build --no-cache
sudo docker-compose up -d
```

### Notas Importantes

- 📦 **Volúmenes**: La base de datos se guarda en un volumen de Docker llamado `iw_grupal_parte2_dbdata`. Los datos persisten aunque detengas los contenedores.
- 🔄 **Código sincronizado**: Los cambios que hagas en los archivos PHP se reflejan automáticamente (el código está montado como volumen).
- 🛠️ **Assets**: Para recompilar assets (CSS/JS), ejecuta: `sudo docker exec iw_grupal_parte2_app_1 npm run build`
- 🗑️ **Limpiar todo**: Para empezar de cero: `sudo docker-compose down -v && sudo docker-compose up -d --build`

### Estructura de Docker

El proyecto incluye:
- **`Dockerfile`**: Definición de la imagen PHP con todas las extensiones necesarias
- **`docker-compose.yaml`**: Orquestación de los 3 servicios (app, db, nginx)
- **`docker/entrypoint.sh`**: Script que se ejecuta al iniciar el contenedor (migraciones, seeders, permisos)
- **`docker/nginx/conf.d/app.conf`**: Configuración de Nginx para servir Laravel

---

## �💻 Uso

### Desarrollo

**Opción 1: Ejecución paralela (recomendado)**
```bash
composer run dev
```

**Opción 2: Manualmente**
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

### URLs de Acceso
- 🌐 Aplicación Web: `http://localhost:8000`
- 📊 Panel Admin Filament: `http://localhost:8000/admin`

### 🔑 Credenciales por Defecto

Tras ejecutar los seeders, se crean automáticamente los siguientes usuarios de prueba:

| Rol | Email | Contraseña | ID |
|-----|-------|------------|-----|
| **Super Admin** | `admin@admin.com` | `admin` | 1 |
| Cliente | `cliente@cliente.com` | `cliente` | 2 |
| Profesional | `profesional@profesional.com` | `profesional` | 3 |
| Recepcionista | `recepcionista@recepcionista.com` | `recepcionista` | 4 |
| Público | `publico@publico.com` | `publico` | 5 |

> ⚠️ **¡IMPORTANTE!** Estas son credenciales de desarrollo. En producción, cambia estas credenciales y elimina los usuarios de prueba.

### Primeros Pasos en el Panel Admin

1. Accede a `http://localhost:8000/admin`
2. Inicia sesión con las credenciales anteriores
3. En el menú lateral, verás:
   - **Dashboard** - Panel de inicio
   - **Shield → Roles** - Gestión de roles y permisos
   - Otros recursos según se desarrollen

### Gestión de Roles y Permisos (Shield)

#### Ver roles y permisos:
```bash
php artisan tinker

# Ver todos los roles
use Spatie\Permission\Models\Role;
Role::all()->pluck('name');

# Ver permisos de un rol
$role = Role::findByName('super_admin');
$role->permissions->pluck('name');
```

#### Crear un usuario con rol específico:
```bash
php artisan tinker

use App\Models\User;
use Spatie\Permission\Models\Role;

$user = User::create([
    'name' => 'Juan Pérez',
    'email' => 'juan@example.com',
    'password' => bcrypt('password123'),
]);

$user->assignRole('recepcionista'); # o 'profesional', 'cliente', etc.
```

### Testing
```bash
composer run test
# o
php artisan test
```

---

## 📋 Archivos Importantes para el Despliegue

### Variables de Entorno (`.env`)

El archivo `.env.example` ya contiene la mayoría de configuraciones. Los archivos críticos para editar son:

| Archivo | Descripción | Qué Editar |
|---------|-------------|-----------|
| `.env` | Variables de entorno | `DB_*`, `APP_*`, `MAIL_*` |
| `config/app.php` | Configuración de la aplicación | Timezone, locale (opcional) |
| `config/database.php` | Conexión a BD | Generalmente NO necesita cambios |
| `config/filament-shield.php` | Configuración de Shield | Generalmente NO necesita cambios |
| `config/permission.php` | Configuración de permisos | Generalmente NO necesita cambios |
| `database/seeders/DatabaseSeeder.php` | Datos iniciales | Modificar si necesitas otros roles base |
| `database/seeders/RoleSeeder.php` | Creación de roles | Añadir nuevos roles si lo necesitas |

### Comandos Esenciales para el Despliegue

```bash
# 1. Instalar dependencias
composer install
npm install

# 2. Preparar entorno
cp .env.example .env
php artisan key:generate
php artisan config:cache

# 3. Base de datos
# ⚠️ EDITA .env CON TUS CREDENCIALES MYSQL PRIMERO
php artisan migrate --force
php artisan db:seed

# 4. Compilar assets
npm run build
```

### 🔄 Comandos para Resetear la Base de Datos en Desarrollo

Cuando necesites recrear completamente la base de datos con datos de prueba, ejecuta **esta secuencia completa** de comandos:

```bash
# 1. Recrear base de datos y ejecutar seeders (crea usuarios y roles)
php artisan migrate:fresh --seed

# 2. Generar permisos y políticas de Shield
php artisan shield:generate --all

# 3. Limpiar caché de permisos
php artisan permission:cache-reset

# 4. Cachear iconos de Blade
php artisan icons:cache

# 5. Optimizar Filament
php artisan filament:optimize

# 6. Limpiar todas las cachés
php artisan optimize:clear

# 7. Asignar permisos de super admin al usuario admin (ID=1)
php artisan shield:super-admin --user=1

# 5. (Opcional) Regenerar permisos si has añadido nuevos recursos
php artisan shield:generate --all --panel=admin
php artisan permission:cache-reset

# 6. Iniciar servidor
php artisan serve  # Terminal 1
npm run dev        # Terminal 2
```

---

## 👥 Roles y Funcionalidades

| Rol | Funciones Principales |
|-----|----------------------|
| **Público** | Ver información, consultar horarios, registrarse |
| **Cliente** | Crear citas, ver historial, realizar pagos, comprar |
| **Profesional** | Ver agenda, bloquear horarios, anotar citas |
| **Recepcionista** | CRUD completo de citas, asignar salas, notificar |
| **Administrador** | Gestión completa: usuarios, salas, reportes, config, roles |

---

## 🔌 Integraciones

### TPV Virtual (Consumidor)
```
Cliente → FisioClinic → API Terceros (Pago)
```
- Procesamiento de transacciones
- Consulta de estado de pagos
- Webhooks de confirmación

### API REST (Proveedor)
```
GET /api/treatments     # Tratamientos
GET /api/products       # Productos
GET /api/professionals  # Profesionales
GET /api/pricing        # Precios
```

---

## 📚 Documentación

- **[ResumenProyecto.md](./Docs/ResumenProyecto.md)** - Análisis completo del proyecto
- **[RutaFuncionalidades.md](./Docs/RutaFuncionalidades.md)** - Detalles de funcionalidades
- **[FilamentShield.md](./Docs/FilamentShield.md)** - Guía completa de Filament Shield
- **[Laravel Docs](https://laravel.com/docs)** - Documentación oficial
- **[Filament Docs](https://filamentphp.com/docs)** - Documentación de Filament

---

## 🗺️ Roadmap

- **Fase 1** ✅ Configuración entorno (Filament + Shield)
- **Fase 2** ⬜ Núcleo del sistema (BD, usuarios, roles)
- **Fase 3** ⬜ Paneles de usuario (reservas, citas)
- **Fase 4** ⬜ Pagos y tienda online
- **Fase 5** ⬜ Analytics e integraciones

---

## 🔒 Seguridad

- ✅ Autenticación segura con Laravel Sanctum
- ✅ Control de roles y permisos con Filament Shield
- ✅ Validación de entradas
- ✅ Protección CSRF
- ✅ Políticas de autorización (Policies)
- ✅ HTTPS en producción
- ✅ Rate limiting en APIs

---

## 🤝 Contribuir

### Git Flow

```bash
# Crear rama de feature
git checkout develop
git checkout -b feature/mi-funcionalidad

# Realizar cambios
git add .
git commit -m "feat: descripción"
git push origin feature/mi-funcionalidad

# Crear Pull Request
```

### Convenciones de Commits
```
feat:     Nueva funcionalidad
fix:      Corrección de bug
refactor: Cambio sin nuevas features
test:     Añadir/actualizar tests
docs:     Cambios en documentación
style:    Formateo de código
chore:    Cambios de dependencias o config
```

### Ramas del Proyecto
- `main` - Producción (estable)
- `develop` - Integración (desarrollo)
- `feature/*` - Nuevas funcionalidades
- `bugfix/*` - Correcciones
- `hotfix/*` - Urgentes

---

## 📋 Requisitos del Proyecto

### Funcionalidades Implementadas
- ✅ Configuración de entorno (Laravel + Filament)
- ✅ Sistema de autenticación
- ✅ Gestión de roles y permisos (Shield)
- ✅ Panel administrativo (Filament)
- ⬜ Base de datos relacional completa
- ⬜ CRUD de usuarios
- ⬜ Gestión de citas
- ⬜ Procesamiento de pagos
- ⬜ Tienda online
- ⬜ Reportes y analytics

### Estándares de Calidad
- Cobertura de tests: 80%+
- Code style: PSR-12
- Documentación: Inline + Docs/
- Commits: Convenciones Git Flow

---

## 📜 Licencia

Distribuido bajo la licencia **MIT**. Ver [LICENSE](LICENSE) para más información.

---

## 👥 Autores

**Grupo G17 - Universidad de Alicante**

- Naoufal Charafat Azaouiat
- Maha Essaoudi
- Sergiy Kazantsev
- Sabrine Bentaleb Kheyar

**Asignatura**: Ingeniería Web 