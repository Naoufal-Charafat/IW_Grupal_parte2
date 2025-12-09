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

**Herramientas**

![Vite](https://img.shields.io/badge/Vite-7.0.7-646CFF?style=flat-square&logo=vite)
![Filament](https://img.shields.io/badge/Filament-Admin-FFAA00?style=flat-square)
![PHPUnit](https://img.shields.io/badge/PHPUnit-11.5-367A51?style=flat-square)

</td>
</tr>
</table>

---

## 🎯 Características Principales

### 🔐 Autenticación y Roles
- Sistema de login/registro seguro
- 5 roles diferenciados: Público, Cliente, Profesional, Recepcionista, Admin
- Control de acceso basado en roles (RBAC)

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
- Gestión de usuarios y salas
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
│   ├── Http/Controllers/        # Controladores
│   ├── Models/                  # Modelos Eloquent
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
├── config/                      # Configuración
├── storage/                     # Logs y cache
├── tests/                       # Tests
└── Docs/                        # Documentación
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
> - Instalación de Composer y dependencias PHP
> - Instalación de Node.js/NPM y dependencias de frontend
> - Instalación y configuración de MySQL
> - Creación de la base de datos
> - Ejecución de migraciones
> - Compilación de assets

**2. Instalación automática (recomendado para nuevos usuarios)**
```bash
chmod +x setup.sh
./setup.sh
```

El script te guiará interactivamente a través de toda la configuración necesaria. **Es la forma más rápida y segura de preparar tu entorno de desarrollo.**

**3. O instalación manual (solo si el setup.sh falla)**
```bash
# Instalar dependencias PHP
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Base de datos
# Edita .env con tus credenciales MySQL
php artisan migrate --force

# Instalar dependencias frontend
npm install
npm run build
```

---

## 💻 Uso

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
- 🌐 Aplicación: `http://localhost:8000`
- 📊 Panel Admin: `http://localhost:8000/admin`

### Testing
```bash
composer run test
# o
php artisan test
```

---

## 👥 Roles y Funcionalidades

| Rol | Funciones Principales |
|-----|----------------------|
| **Público** | Ver información, consultar horarios, registrarse |
| **Cliente** | Crear citas, ver historial, realizar pagos, comprar |
| **Profesional** | Ver agenda, bloquear horarios, anotar citas |
| **Recepcionista** | CRUD completo de citas, asignar salas, notificar |
| **Administrador** | Gestión completa: usuarios, salas, reportes, config |

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
- **[Laravel Docs](https://laravel.com/docs)** - Documentación oficial

---

## 🗺️ Roadmap

- **Fase 1** ✅ Configuración entorno
- **Fase 2** ⬜ Núcleo del sistema (BD, usuarios, roles)
- **Fase 3** ⬜ Paneles de usuario (reservas, citas)
- **Fase 4** ⬜ Pagos y tienda online
- **Fase 5** ⬜ Analytics e integraciones

---

## 🔒 Seguridad

- ✅ Autenticación segura con Laravel Sanctum
- ✅ Validación de entradas
- ✅ Protección CSRF
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
- ⬜ Base de datos relacional
- ⬜ Sistema de autenticación
- ⬜ Gestión de roles y permisos
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

**Grupo G17 - Universidad de Alicante (2024/25)**

- Naoufal Charafat Azaouiat
- Maha Essaoudi
- Sergiy Kazantsev
- Sabrine Bentaleb Kheyar

**Asignatura**: Ingeniería Web

---
