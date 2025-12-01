<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ HERO SECTION ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

# 🏥 Sistema de Gestión de Clínica de Fisioterapia

<img src="https://img.shields.io/badge/Estado-En%20Desarrollo-00d4ff?style=for-the-badge&labelColor=0a0a0a" alt="Estado"/>

### 🌟 *Plataforma integral para la gestión de citas, profesionales y pacientes*

<br/>

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=1a1a2e)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a2e)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white&labelColor=1a1a2e)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white&labelColor=1a1a2e)
![Filament](https://img.shields.io/badge/Filament-FFAA00?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a2e)
![Blade](https://img.shields.io/badge/Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a2e)

<br/>

```
╔══════════════════════════════════════════════════════════════════╗
║  🔮  SISTEMA MODERNO DE GESTIÓN CLÍNICA  🔮                      ║
║──────────────────────────────────────────────────────────────────║
║  ⚡ Reservas inteligentes    │  🔐 Multi-rol seguro             ║
║  📊 Dashboard analítico      │  💳 Pagos integrados             ║
║  📧 Notificaciones auto      │  🏨 Integración hoteles          ║
╚══════════════════════════════════════════════════════════════════╝
```

</div>

---

<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░ TECNOLOGÍAS SECTION ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

## 🛠️ Stack Tecnológico

</div>

<br/>

<table align="center">
<tr>
<td align="center" width="50%">

### 🗄️ Base de Datos
```
╭─────────────────────────────────╮
│         ⚡ MySQL ⚡              │
├─────────────────────────────────┤
│  ✦ Motor relacional robusto    │
│  ✦ Alta disponibilidad         │
│  ✦ Integridad referencial      │
│  ✦ Transacciones ACID          │
│  ✦ Escalabilidad probada       │
╰─────────────────────────────────╯
```

**¿Por qué MySQL?**
> Base de datos relacional madura y confiable, perfecta para manejar las relaciones complejas entre pacientes, profesionales, citas y pagos. Su integración nativa con Laravel mediante Eloquent ORM facilita las operaciones CRUD.

</td>
<td align="center" width="50%">

### ⚙️ Backend
```
╭─────────────────────────────────╮
│    🔥 Laravel + Filament 🔥     │
├─────────────────────────────────┤
│  ✦ PHP 8.x con Laravel 11      │
│  ✦ Filament Admin Panel        │
│  ✦ Filament Shield (RBAC)      │
│  ✦ API RESTful                 │
│  ✦ Queue Jobs para emails      │
╰─────────────────────────────────╯
```

**¿Por qué Laravel + Filament?**
> Laravel ofrece una arquitectura MVC limpia, mientras que Filament proporciona un panel de administración moderno y Filament Shield gestiona roles y permisos de forma elegante.

</td>
</tr>
<tr>
<td align="center" colspan="2">

### 🎨 Frontend
```
╭───────────────────────────────────────────────────────────────────╮
│                    💎 Blade + Tailwind CSS 💎                      │
├───────────────────────────────────────────────────────────────────┤
│  ✦ Blade Templates       │  ✦ Tailwind CSS 3.x                   │
│  ✦ Componentes reutiliza │  ✦ Diseño responsive                  │
│  ✦ Livewire (reactivo)   │  ✦ UI/UX moderna                      │
╰───────────────────────────────────────────────────────────────────╯
```

**¿Por qué Blade + Tailwind?**
> Blade se integra perfectamente con Laravel manteniendo una sintaxis limpia. Tailwind CSS permite crear interfaces modernas con utility-first CSS, acelerando el desarrollo sin sacrificar personalización.

</td>
</tr>
</table>

<br/>

---

<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░ INTEGRACIONES API ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

## 🔌 Integraciones API REST

</div>

<br/>

> 💡 **Nota**: Un TPV Virtual (Terminal Punto de Venta) es esencialmente una **API REST** que expone endpoints para procesar pagos. Cuando nos conectamos al TPV de otro grupo, estamos consumiendo su API.

<table align="center">
<tr>
<td align="center" width="50%">

### 💳 TPV Virtual (Consumidor)
```
╭─────────────────────────────────╮
│   🏦 API REST del TPV 🏦        │
├─────────────────────────────────┤
│  ✦ Consumimos API de otro      │
│    grupo del curso             │
│  ✦ Iniciar transacciones       │
│  ✦ Consultar estado de pagos   │
│  ✦ Procesar reembolsos         │
│  ✦ Recibir webhooks            │
╰─────────────────────────────────╯
```

**Rol: CONSUMIDOR**
> Consumimos la API REST del TPV Virtual desarrollada por otro grupo. Todas las transacciones de citas y tienda online se procesan a través de este servicio. El TPV nos devuelve IDs de transacción y estados que almacenamos localmente.

</td>
<td align="center" width="50%">

### 🛍️ Catálogo de Servicios (Proveedor)
```
╭─────────────────────────────────╮
│  📡 Nuestra API REST 📡         │
├─────────────────────────────────┤
│  ✦ Exponemos tratamientos      │
│  ✦ Catálogo de productos       │
│  ✦ Disponibilidad profesional  │
│  ✦ Precios y tarifas           │
│  ✦ Endpoints RESTful           │
╰─────────────────────────────────╯
```

**Rol: PROVEEDOR**
> Exponemos nuestra propia API REST para que el TPV y otros sistemas externos puedan consultar nuestro catálogo de servicios y productos de la clínica.

</td>
</tr>
</table>

<div align="center">

```
┌────────────────────────────────────────────────────────────────────────────────┐
│                     🔄 FLUJO DE INTEGRACIÓN CON TPV 🔄                         │
├────────────────────────────────────────────────────────────────────────────────┤
│                                                                                │
│   ┌──────────────┐         ┌──────────────────┐         ┌──────────────┐      │
│   │   CLIENTE    │ ──────▶ │  NUESTRA APP     │ ──────▶ │  API TPV     │      │
│   │  (Browser)   │  Pago   │  (Laravel)       │  POST   │ (Otro Grupo) │      │
│   └──────────────┘         └──────────────────┘         └──────────────┘      │
│                                     │                          │               │
│                                     │ Almacena:                │ Responde:     │
│                                     │ - tpv_transaction_id     │ - ID trans.   │
│                                     │ - tpv_status             │ - Estado      │
│                                     ▼                          │               │
│                            ┌──────────────────┐                │               │
│                            │    MySQL DB      │ ◀──────────────┘               │
│                            │   (payments)     │     Webhook/Callback           │
│                            └──────────────────┘                                │
│                                     │                                          │
│                                     │ Expone API                               │
│                                     ▼                                          │
│                            ┌──────────────────┐                                │
│                            │  NUESTRA API     │ ◀────── TPV / Otros Grupos     │
│                            │  (Servicios)     │         (Consultan catálogo)   │
│                            └──────────────────┘                                │
│                                                                                │
└────────────────────────────────────────────────────────────────────────────────┘
```

</div>

---

<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ ROADMAP SECTION ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

## 🗺️ Roadmap de Funcionalidades

</div>

<br/>

```
                    ╔═══════════════════════════════════════════════════════════╗
                    ║           🚀 ROADMAP DE DESARROLLO 🚀                     ║
                    ╚═══════════════════════════════════════════════════════════╝

    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                                                                                 │
    │   ╭──────────────────────────────────────────────────────────────────────────╮  │
    │   │ ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ │  │
    │   │ ░░                    FASE 1: FUNDAMENTOS                            ░░ │  │
    │   │ ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ │  │
    │   ╰──────────────────────────────────────────────────────────────────────────╯  │
    │                                                                                 │
    │   ┌────────────────────────────────────────────────────────────────────────┐    │
    │   │  🔹 Configuración del entorno Laravel + Filament                       │    │
    │   │  🔹 Diseño e implementación del esquema de base de datos              │    │
    │   │  🔹 Sistema de autenticación y autorización (Filament Shield)         │    │
    │   │  🔹 Gestión de roles: Admin, Recepcionista, Profesional, Cliente      │    │
    │   │  🔹 CRUD de usuarios con asignación de roles                          │    │
    │   └────────────────────────────────────────────────────────────────────────┘    │
    │                                              │                                  │
    │                                              ▼                                  │
    │   ╭──────────────────────────────────────────────────────────────────────────╮  │
    │   │ ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓ │  │
    │   │ ▓▓                  FASE 2: NÚCLEO DEL SISTEMA                       ▓▓ │  │
    │   │ ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓ │  │
    │   ╰──────────────────────────────────────────────────────────────────────────╯  │
    │                                                                                 │
    │   ┌────────────────────────────────────────────────────────────────────────┐    │
    │   │  🔸 Gestión de salas/instalaciones                                     │    │
    │   │  🔸 Configuración de horarios de clínica                              │    │
    │   │  🔸 Gestión de profesionales y especialidades                         │    │
    │   │  🔸 Sistema de reservas con calendario interactivo                    │    │
    │   │  🔸 Asignación inteligente de salas                                   │    │
    │   │  🔸 Bloqueo de horarios por profesional                               │    │
    │   └────────────────────────────────────────────────────────────────────────┘    │
    │                                              │                                  │
    │                                              ▼                                  │
    │   ╭──────────────────────────────────────────────────────────────────────────╮  │
    │   │ ░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░ │  │
    │   │ ▓░                FASE 3: EXPERIENCIA DE USUARIO                     ░▓ │  │
    │   │ ░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░▓░ │  │
    │   ╰──────────────────────────────────────────────────────────────────────────╯  │
    │                                                                                 │
    │   ┌────────────────────────────────────────────────────────────────────────┐    │
    │   │  🔹 Portal público: Quiénes somos, contacto, horarios                  │    │
    │   │  🔹 Panel de cliente: historial, citas pendientes                     │    │
    │   │  🔹 Panel de profesional: agenda, historial de pacientes              │    │
    │   │  🔹 Panel de recepcionista: gestión integral de reservas              │    │
    │   │  🔹 Sistema de notificaciones por email (confirmación/recordatorio)   │    │
    │   │  🔹 Diseño responsive con Tailwind CSS                                │    │
    │   └────────────────────────────────────────────────────────────────────────┘    │
    │                                              │                                  │
    │                                              ▼                                  │
    │   ╭──────────────────────────────────────────────────────────────────────────╮  │
    │   │ ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒ │  │
    │   │ ▒▒               FASE 4: PAGOS Y TIENDA ONLINE                       ▒▒ │  │
    │   │ ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒ │  │
    │   ╰──────────────────────────────────────────────────────────────────────────╯  │
    │                                                                                 │
    │   ┌────────────────────────────────────────────────────────────────────────┐    │
    │   │  🔸 Integración con pasarela de pago (TPV Virtual)                     │    │
    │   │  🔸 Gestión de estados de pago                                        │    │
    │   │  🔸 Catálogo de productos (tienda online)                             │    │
    │   │  🔸 Carrito de compras para usuarios autenticados                     │    │
    │   │  🔸 Historial de transacciones                                        │    │
    │   └────────────────────────────────────────────────────────────────────────┘    │
    │                                              │                                  │
    │                                              ▼                                  │
    │   ╭──────────────────────────────────────────────────────────────────────────╮  │
    │   │ ████████████████████████████████████████████████████████████████████████ │  │
    │   │ ██             FASE 5: INTEGRACIONES Y ANALYTICS                     ██ │  │
    │   │ ████████████████████████████████████████████████████████████████████████ │  │
    │   ╰──────────────────────────────────────────────────────────────────────────╯  │
    │                                                                                 │
    │   ┌────────────────────────────────────────────────────────────────────────┐    │
    │   │  🔹 Integración con hoteles asociados                                  │    │
    │   │  🔹 Sistema de valoraciones post-cita                                 │    │
    │   │  🔹 Dashboard analítico para administradores                          │    │
    │   │  🔹 Informes de reservas y ocupación                                  │    │
    │   │  🔹 Informes financieros con gráficos                                 │    │
    │   │  🔹 Exportación de datos (CSV/PDF)                                    │    │
    │   │  🔹 Logs y monitorización del sistema                                 │    │
    │   └────────────────────────────────────────────────────────────────────────┘    │
    │                                                                                 │
    └─────────────────────────────────────────────────────────────────────────────────┘
```

<br/>

<div align="center">

### 📋 Resumen de Funcionalidades por Rol

</div>

<table align="center">
<tr>
<th>🌐 Público</th>
<th>👤 Cliente</th>
<th>🩺 Profesional</th>
<th>🖥️ Recepcionista</th>
<th>⚙️ Administrador</th>
</tr>
<tr>
<td valign="top">

```
┌──────────────┐
│ • Info legal │
│ • Contacto   │
│ • Horarios   │
│ • Quiénes    │
│   somos      │
│ • Ver tienda │
│   (sin       │
│   comprar)   │
└──────────────┘
```

</td>
<td valign="top">

```
┌────────────────┐
│ • Registro     │
│ • Login/Logout │
│ • Editar perfil│
│ • Crear citas  │
│ • Ver historial│
│ • Cancelar     │
│ • Pagar (TPV)  │
│ • Valorar      │
│ • Comprar      │
└────────────────┘
```

</td>
<td valign="top">

```
┌────────────────┐
│ • Ver agenda   │
│ • Bloquear     │
│   horarios     │
│ • Historial    │
│   pacientes    │
│ • Notas citas  │
│ • Crear citas  │
│   (opcional)   │
└────────────────┘
```

</td>
<td valign="top">

```
┌────────────────┐
│ • CRUD reservas│
│ • Asignar salas│
│ • Calendario   │
│ • Filtros      │
│   avanzados    │
│ • Config       │
│   horarios     │
│ • Notificar    │
└────────────────┘
```

</td>
<td valign="top">

```
┌────────────────┐
│ • CRUD usuarios│
│ • CRUD salas   │
│ • Config global│
│ • Reportes     │
│ • Analytics    │
│ • Logs sistema │
│ • Gestión      │
│   completa     │
└────────────────┘
```

</td>
</tr>
</table>

---

<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░░ METODOLOGÍA SECTION ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

## 🔄 Metodología de Desarrollo

</div>

<br/>

<div align="center">

```
╔════════════════════════════════════════════════════════════════════════════════════╗
║                              🌊 GIT FLOW 🌊                                         ║
╠════════════════════════════════════════════════════════════════════════════════════╣
║                                                                                    ║
║     main ─────●─────────────────────────────────────●─────────────────▶ 🏷️ v1.0   ║
║               │                                     ▲                              ║
║               │                                     │                              ║
║    develop ───┼────●────●────●────●────●────●───────┼────●────●────▶              ║
║               │    │    │    ▲    │    ▲    │       │                              ║
║               │    │    │    │    │    │    │       │                              ║
║   feature/  ──┼────┴────┤    │    ├────┘    │       │                              ║
║   auth        │         │    │    │         │       │                              ║
║               │         ▼    │    │         │       │                              ║
║   feature/  ──┼─────────┴────┘    │         │       │                              ║
║   reservas    │                   │         │       │                              ║
║               │                   │         │       │                              ║
║   feature/  ──┼───────────────────┴─────────┘       │                              ║
║   pagos       │                                     │                              ║
║               │                                     │                              ║
║   release/  ──┼─────────────────────────────────────┘                              ║
║   v1.0        │                                                                    ║
║               │                                                                    ║
║   hotfix/   ──┴── (correcciones urgentes en producción)                            ║
║                                                                                    ║
╚════════════════════════════════════════════════════════════════════════════════════╝
```

</div>

<br/>

<table align="center">
<tr>
<td align="center" width="20%">

### 🔵 `main`
Producción estable

</td>
<td align="center" width="20%">

### 🟢 `develop`
Integración continua

</td>
<td align="center" width="20%">

### 🟣 `feature/*`
Nuevas funcionalidades

</td>
<td align="center" width="20%">

### 🟡 `release/*`
Preparación de versiones

</td>
<td align="center" width="20%">

### 🔴 `hotfix/*` desde main
Correcciones urgentes

### 🔴 `bugfix/*` desde dev
Correcciones 

</td>
</tr>
</table>

<br/>

<div align="center">

```
┌─────────────────────────────────────────────────────────────────┐
│                     📝 CONVENCIÓN DE COMMITS                    │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│   feat:     ✨  Nueva funcionalidad                             │
│   fix:      🐛  Corrección de bugs                              │
│   docs:     📚  Documentación                                   │
│   style:    💎  Estilos (sin cambios de lógica)                 │
│   refactor: ♻️   Refactorización de código                       │
│   test:     🧪  Tests                                           │
│   chore:    🔧  Tareas de mantenimiento                         │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

</div>

---

<div align="center">

<!-- ═══════════════════════════════════════════════════════════════════════════════ -->
<!-- ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ EQUIPO SECTION ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ -->
<!-- ═══════════════════════════════════════════════════════════════════════════════ -->

## 👥 Equipo - Grupo G17

<br/>

```
╔══════════════════════════════════════════════════════════════════════════════════╗
║                                                                                  ║
║   ┌─────────────────────────────────────────────────────────────────────────┐    ║
║   │                        🚀 DREAM TEAM 🚀                                 │    ║
║   └─────────────────────────────────────────────────────────────────────────┘    ║
║                                                                                  ║
║         ╭──────────────────────────╮    ╭──────────────────────────╮            ║
║         │    👨‍💻 NAOUFAL           │    │    👩‍💻 MAHA              │            ║
║         │  Charafat Azaouiat      │    │    Essaoudi              │            ║
║         │  ───────────────────    │    │  ───────────────────     │            ║
║         │  💼 Desarrollador       │    │  💼 Desarrolladora       │            ║
║         ╰──────────────────────────╯    ╰──────────────────────────╯            ║
║                                                                                  ║
║         ╭──────────────────────────╮    ╭──────────────────────────╮            ║
║         │    👨‍💻 SERGIY            │    │    👩‍💻 SABRINE           │            ║
║         │    Kazantsev            │    │  Bentaleb Kheyar         │            ║
║         │  ───────────────────    │    │  ───────────────────     │            ║
║         │  💼 Desarrollador       │    │  💼 Desarrolladora       │            ║
║         ╰──────────────────────────╯    ╰──────────────────────────╯            ║
║                                                                                  ║
╚══════════════════════════════════════════════════════════════════════════════════╝
```

</br>

| Integrante | Rol | GitHub |
|:----------:|:---:|:------:|
| **Naoufal Charafat Azaouiat** | 👨‍💻 Desarrollador | [![GitHub](https://img.shields.io/badge/-Profile-181717?style=flat-square&logo=github)](https://github.com/) |
| **Maha Essaoudi** | 👩‍💻 Desarrolladora | [![GitHub](https://img.shields.io/badge/-Profile-181717?style=flat-square&logo=github)](https://github.com/) |
| **Sergiy Kazantsev** | 👨‍💻 Desarrollador | [![GitHub](https://img.shields.io/badge/-Profile-181717?style=flat-square&logo=github)](https://github.com/) |
| **Sabrine Bentaleb Kheyar** | 👩‍💻 Desarrolladora | [![GitHub](https://img.shields.io/badge/-Profile-181717?style=flat-square&logo=github)](https://github.com/) |

</div>

---

<div align="center">

```
╔══════════════════════════════════════════════════════════════════════════════════╗
║                                                                                  ║
║                    📚  Universidad de Alicante  📚                               ║
║                      Ingeniería Web - Curso 2024/25                              ║
║                                                                                  ║
╚══════════════════════════════════════════════════════════════════════════════════╝
```

<br/>

![Made with ❤️](https://img.shields.io/badge/Made%20with-❤️-ff0055?style=for-the-badge&labelColor=1a1a2e)
![Universidad de Alicante](https://img.shields.io/badge/UA-Ingeniería%20Web-00d4ff?style=for-the-badge&labelColor=1a1a2e)

</div>
