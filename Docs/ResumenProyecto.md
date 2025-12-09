# 🏥 FisioClinic - Resumen del Proyecto

## Descripción General

**FisioClinic** es una plataforma integral para la gestión de citas y servicios en clínicas de fisioterapia. El sistema permite a múltiples roles de usuario (administrador, recepcionista, profesionales y clientes) colaborar en un entorno centralizado para optimizar la gestión de citas, profesionales, pacientes y pagos.

El proyecto está en **fase de desarrollo inicial** y sigue la metodología **Git Flow** para su ciclo de vida.

---

## 📊 Stack Tecnológico

### Backend
- **Framework**: Laravel 12.42.0 (PHP 8.4.15)
- **Base de Datos**: MySQL
- **ORM**: Eloquent
- **Panel Administrativo**: Filament (gestión de roles y permisos con Shield)
- **Colas**: Laravel Queue (para procesamiento de emails)
- **API**: RESTful

### Frontend
- **Motor de plantillas**: Blade
- **Framework CSS**: Tailwind CSS 4.1.17
- **Componentes reactivos**: Livewire
- **Build tool**: Vite 7.0.7

### Testing & Quality
- **Testing**: PHPUnit 11.5.46
- **Code Style**: Laravel Pint 1.26.0
- **Code Standards**: Laravel Sail 1.51.0

---

## 🏗️ Arquitectura General

```
FisioClinic (Laravel 12)
├── Backend (MVC)
│   ├── Models (Eloquent ORM)
│   ├── Controllers (Lógica de aplicación)
│   ├── Routes (API RESTful + Web)
│   └── Database (MySQL)
│
├── Frontend (Blade + Tailwind)
│   ├── Views (Templates)
│   ├── CSS (Tailwind Utilities)
│   └── JS (Componentes Livewire)
│
└── Integraciones
    ├── TPV Virtual (API REST - Consumidor)
    ├── Nuestra API (Catálogo de servicios - Proveedor)
    └── Sistema de Emails (Queue Jobs)
```

---

## 🔑 Módulos Principales

### 1. Gestión de Usuarios
- Sistema de autenticación (login, registro, recuperación de contraseña)
- Gestión de roles: **Admin**, **Recepcionista**, **Profesional**, **Cliente**, **Público**
- Control de acceso basado en roles (RBAC)
- Perfiles de usuario con información personal

### 2. Gestión de Reservas
- Crear, modificar y cancelar citas
- Calendario interactivo para visualización de disponibilidad
- Asignación inteligente de salas
- Filtrado avanzado por fecha, profesional, cliente o sala
- Notificaciones automáticas por email (confirmación, cambios, cancelación)

### 3. Gestión de Profesionales
- Registro de especialidades y tratamientos
- Configuración de disponibilidad horaria
- Bloqueo de horas (para mantenimiento, descanso, etc.)
- Historial de citas con pacientes
- Notas y anotaciones sobre citas

### 4. Gestión de Salas/Instalaciones
- CRUD de salas de tratamiento
- Configuración de características (capacidad, equipamiento)
- Control de disponibilidad general
- Asignación automática a citas

### 5. Sistema de Pagos
- Integración con TPV Virtual (API REST de terceros)
- Procesamiento de transacciones para citas
- Pasarela de pago para tienda online
- Consulta de estado de pagos
- Procesamiento de reembolsos

### 6. Tienda Online
- Catálogo de productos integrado
- Carrito de compras para usuarios autenticados
- Compra de servicios y productos
- Historial de transacciones
- Solo visualización en modo público (sin capacidad de compra)

### 7. Dashboard y Reportes
- Panel administrativo con estadísticas
- Informes de reservas (diarias, semanales, mensuales)
- Análisis de ocupación por profesional y sala
- Reportes financieros con gráficos
- Exportación a CSV/PDF
- Logs de actividad del sistema
- Métricas de uso de la plataforma

### 8. Notificaciones
- Sistema de emails automático vía Queue Jobs
- Confirmación de citas
- Recordatorios de citas pendientes
- Notificación de cambios o cancelaciones
- Alertas del sistema

---

## 👥 Funcionalidades por Rol

### 🌐 Usuario Público
- Ver información de la clínica (quiénes somos, contacto, ubicación)
- Consultar horarios
- Visualizar catálogo de productos (sin comprar)
- Acceder a información legal y aviso de privacidad
- Registrarse en el sistema

### 👤 Cliente Autenticado
- Gestionar perfil (editar datos personales)
- Crear citas seleccionando profesional, fecha y hora
- Ver historial de citas (pendientes y pasadas)
- Modificar citas no finalizadas
- Cancelar citas
- Recibir confirmación y recordatorios por email
- Realizar pagos vía TPV Virtual
- Comprar productos en la tienda online
- Valorar la experiencia con profesionales
- Integración con hoteles asociados

### 🩺 Profesional/Fisioterapeuta
- Ver agenda de citas (pendientes e historial)
- Bloquear horarios (mantenimiento, descanso)
- Acceder a información del paciente
- Añadir notas sobre citas
- Crear citas manualmente para clientes (opcional)
- Seleccionar sala disponible al crear/modificar citas

### 🖥️ Recepcionista
- CRUD completo de reservas
- Crear citas para clientes
- Modificar reservas existentes
- Cancelar reservas
- Ver calendario de reservas
- Filtrado avanzado de reservas
- Asignar salas disponibles
- Configurar horarios de la clínica
- Enviar notificaciones a clientes y profesionales
- Establecer horarios de profesionales

### ⚙️ Administrador
- **Gestión de Usuarios**: Crear, editar, eliminar, activar/desactivar, restablecer contraseñas
- **Gestión de Profesionales**: Alta de profesionales, asignar especialidades, configurar tarifas
- **Gestión de Salas**: CRUD de salas, configurar características, establecer disponibilidad
- **Configuración General**: Horarios globales, días festivos, duración estándar de citas
- **Informes de Ocupación**: Tasas de ocupación, cancelaciones, modificaciones
- **Informes Financieros**: Facturación, ingresos por profesional/sala, análisis de tendencias
- **Monitorización**: Logs de actividad, métricas de uso, alertas del sistema

---

## 🔌 Integraciones Externas

### TPV Virtual (API REST - Consumidor)
Consumimos una API REST de otro grupo para procesar pagos:
- Iniciar transacciones de pago
- Consultar estado de pagos
- Procesar reembolsos
- Recibir webhooks de confirmación

### Nuestra API REST (Proveedor)
Exponemos endpoints para que otros sistemas consulten nuestros datos:
- Tratamientos disponibles
- Catálogo de productos
- Disponibilidad de profesionales
- Precios y tarifas

---

## 📦 Estructura de Directorios

```
proyecto/
├── app/
│   ├── Http/Controllers/        # Controladores de aplicación
│   ├── Models/                  # Modelos Eloquent
│   └── Providers/               # Proveedores de servicios
├── bootstrap/                   # Archivos de inicio
├── config/                      # Archivos de configuración
├── database/
│   ├── factories/               # Factories para testing
│   ├── migrations/              # Migraciones
│   └── seeders/                 # Seeders para datos iniciales
├── public/                      # Archivos públicos (CSS, JS compilados)
├── resources/
│   ├── css/                     # Estilos
│   ├── js/                      # JavaScript
│   └── views/                   # Plantillas Blade
├── routes/                      # Definición de rutas
├── storage/                     # Archivos generados (logs, cache, sesiones)
├── tests/                       # Tests unitarios y de característica
├── Docs/                        # Documentación del proyecto
└── config files               # .env, composer.json, package.json, etc.
```

---

## 🗺️ Fases de Desarrollo

### Fase 1: Fundamentos
- ✅ Configuración del entorno Laravel + Filament
- ⬜ Diseño e implementación del esquema de Base de Datos
- ⬜ Sistema de autenticación y autorización
- ⬜ Gestión de roles (Admin, Recepcionista, Profesional, Cliente)
- ⬜ CRUD de usuarios con asignación de roles

### Fase 2: Núcleo del Sistema
- ⬜ Gestión de salas/instalaciones
- ⬜ Configuración de horarios de clínica
- ⬜ Gestión de profesionales y especialidades
- ⬜ Sistema de reservas con calendario interactivo
- ⬜ Asignación inteligente de salas
- ⬜ Bloqueo de horarios por profesional

### Fase 3: Experiencia de Usuario
- ⬜ Portal público (Quiénes somos, contacto, horarios)
- ⬜ Panel de cliente (historial, citas pendientes)
- ⬜ Panel de profesional (agenda, historial de pacientes)
- ⬜ Panel de recepcionista (gestión integral de reservas)
- ⬜ Sistema de notificaciones por email
- ⬜ Diseño responsive con Tailwind CSS

### Fase 4: Pagos y Tienda Online
- ⬜ Integración con TPV Virtual
- ⬜ Gestión de estados de pago
- ⬜ Catálogo de productos
- ⬜ Carrito de compras
- ⬜ Historial de transacciones

### Fase 5: Integraciones y Analytics
- ⬜ Integración con hoteles asociados
- ⬜ Sistema de valoraciones post-cita
- ⬜ Dashboard analítico
- ⬜ Informes de reservas y ocupación
- ⬜ Informes financieros con gráficos
- ⬜ Exportación de datos (CSV/PDF)
- ⬜ Logs y monitorización

---

## 🔧 Configuración e Instalación

### Requisitos Previos
- PHP 8.2+
- Composer
- Node.js (npm)
- MySQL
- Git

### Instalación
```bash
# Clonar repositorio
git clone <repositorio>
cd proyecto

# Ejecutar script de configuración
./setup.sh

# O manualmente:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
npm install
npm run build
```

### Desarrollo
```bash
npm run dev
# O ejecutar todo en paralelo:
composer run dev
```

---

## 🧪 Testing

```bash
# Ejecutar tests
composer run test

# O directamente
php artisan test
```

---

## 📋 Metodología de Desarrollo

El proyecto utiliza **Git Flow** para el control de versiones:

- **main**: Rama de producción (estable)
- **develop**: Rama de integración (versión en desarrollo)
- **feature/\***: Nuevas funcionalidades
- **release/\***: Preparación de versiones
- **hotfix/\***: Correcciones urgentes
- **bugfix/\***: Correcciones generales

---

## 👥 Equipo del Proyecto (Grupo G17)

- **Naoufal Charafat Azaouiat** - Desarrollador
- **Maha Essaoudi** - Desarrolladora
- **Sergiy Kazantsev** - Desarrollador
- **Sabrine Bentaleb Kheyar** - Desarrolladora

**Universidad**: Universidad de Alicante  
**Asignatura**: Ingeniería Web  
**Curso**: 2024/25

---

## 📜 Licencia

MIT License

---

## 📝 Notas Importantes

1. **Estado del Proyecto**: En fase de desarrollo inicial. Muchas funcionalidades están pendientes de implementación.

2. **Base de Datos**: El esquema completo debe ser diseñado e implementado en la Fase 1.

3. **Seguridad**: 
   - Implementar autenticación segura (Laravel Sanctum para API)
   - Validar y sanitizar todas las entradas
   - Usar HTTPS en producción
   - Implementar rate limiting para APIs

4. **Escalabilidad**: 
   - Considerar caching para consultas frecuentes
   - Usar Base de Datos read replicas si es necesario
   - Implementar queue workers para tareas pesadas

5. **Testing**: 
   - Crear tests unitarios para lógica de negocio
   - Tests de característica para flujos críticos
   - Coverage mínimo recomendado: 80%

6. **Documentación**: 
   - Mantener actualizada la documentación de API
   - Usar Postman o Swagger para documentar endpoints
   - Documentar cambios en migraciones de base de datos

---

**Última actualización**: Diciembre 2024
