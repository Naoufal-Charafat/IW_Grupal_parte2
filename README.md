<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:1a1a2e,50:16213e,100:0f3460&height=220&section=header&text=🏥%20FisioClinic&fontSize=70&fontColor=00d4ff&animation=fadeIn&fontAlignY=30&desc=Sistema%20de%20Gestión%20de%20Clínica%20de%20Fisioterapia&descSize=20&descAlignY=52&descAlign=50"/>

<br/>

<img src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=600&size=22&pause=1000&color=00D4FF&center=true&vCenter=true&width=600&lines=Gestión+de+Citas+Inteligente;Panel+Administrativo+Moderno;Integración+con+TPV+Virtual;Tienda+Online+Integrada" alt="Typing SVG" />

<br/><br/>

[![Estado](https://img.shields.io/badge/🚀_Estado-En_Desarrollo-00d4ff?style=for-the-badge&labelColor=1a1a2e)](https://github.com/Naoufal-Charafat/IW_Grupal_parte2)
[![Versión](https://img.shields.io/badge/📦_Versión-1.0.0-ff6b6b?style=for-the-badge&labelColor=1a1a2e)](https://github.com/Naoufal-Charafat/IW_Grupal_parte2)
[![Licencia](https://img.shields.io/badge/📄_Licencia-MIT-4ecdc4?style=for-the-badge&labelColor=1a1a2e)](LICENSE)

<br/><br/>

### 💡 Plataforma integral para la gestión de citas, profesionales y pacientes

<br/>

[![PHP](https://img.shields.io/badge/PHP_8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel_11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Filament](https://img.shields.io/badge/Filament-FFAA00?style=for-the-badge&logo=laravel&logoColor=white)](https://filamentphp.com)

</div>

<br/>

## 📑 Índice

<div align="center">

[🛠️ Stack Tecnológico](#-stack-tecnológico) •
[🔌 Integraciones API](#-integraciones-api-rest) •
[🗺️ Roadmap](#-roadmap-de-funcionalidades) •
[🔄 Metodología](#-metodología-de-desarrollo) •
[👥 Equipo](#-equipo---grupo-g17)

</div>

<br/>

---

<br/>

<div align="center">

## 🛠️ Stack Tecnológico

*Tecnologías cuidadosamente seleccionadas para un desarrollo robusto y escalable*

</div>

<br/>

<table align="center">
<tr>
<td align="center" width="33%">

<img src="https://img.shields.io/badge/🗄️_BASE_DE_DATOS-1a1a2e?style=for-the-badge" alt="BD"/>

<br/><br/>

<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" width="80"/>

<br/>

**MySQL**

Motor relacional robusto con integridad referencial, transacciones ACID y escalabilidad probada.

*Integración nativa con Laravel mediante Eloquent ORM*

</td>
<td align="center" width="33%">

<img src="https://img.shields.io/badge/⚙️_BACKEND-1a1a2e?style=for-the-badge" alt="Backend"/>

<br/><br/>

<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg" width="80"/>

<br/>

**Laravel 11 + Filament**

Arquitectura MVC limpia con panel de administración moderno. Filament Shield para gestión de roles y permisos (RBAC).

*API RESTful + Queue Jobs para emails*

</td>
<td align="center" width="33%">

<img src="https://img.shields.io/badge/🎨_FRONTEND-1a1a2e?style=for-the-badge" alt="Frontend"/>

<br/><br/>

<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/tailwindcss/tailwindcss-original.svg" width="80"/>

<br/>

**Blade + Tailwind CSS**

Templates integrados con Laravel y utility-first CSS para interfaces modernas y responsive.

*Livewire para componentes reactivos*

</td>
</tr>
</table>

<br/>

---

<br/>

<div align="center">

## 🔌 Integraciones API REST

*Arquitectura de servicios conectados*

</div>

<br/>

> 💡 **Nota**: Un TPV Virtual (Terminal Punto de Venta) es esencialmente una **API REST** que expone endpoints para procesar pagos. Cuando nos conectamos al TPV de otro grupo, estamos consumiendo su API.

<br/>

<table align="center">
<tr>
<td align="center" width="50%">

<img src="https://img.shields.io/badge/💳_TPV_VIRTUAL-Consumidor-00d4ff?style=for-the-badge&labelColor=1a1a2e" alt="TPV"/>

<br/><br/>

**🏦 API REST del TPV**

| Funcionalidad | Descripción |
|:-------------:|:------------|
| 🔄 | Consumimos API de otro grupo |
| 💰 | Iniciar transacciones |
| 📊 | Consultar estado de pagos |
| ↩️ | Procesar reembolsos |
| 🔔 | Recibir webhooks |

<br/>

> Todas las transacciones de citas y tienda online se procesan a través del TPV externo.

</td>
<td align="center" width="50%">

<img src="https://img.shields.io/badge/📡_CATÁLOGO-Proveedor-ff6b6b?style=for-the-badge&labelColor=1a1a2e" alt="API"/>

<br/><br/>

**🛍️ Nuestra API REST**

| Endpoint | Descripción |
|:--------:|:------------|
| 📋 | Tratamientos disponibles |
| 🛒 | Catálogo de productos |
| 👨‍⚕️ | Disponibilidad profesional |
| 💲 | Precios y tarifas |
| 🔗 | Endpoints RESTful |

<br/>

> Exponemos nuestra API para que el TPV y otros sistemas consulten nuestro catálogo.

</td>
</tr>
</table>

<br/>

<div align="center">

### Flujo de Integración

</div>

```
                    ┌─────────────────────────────────────────────────────────────┐
                    │                                                             │
    ┌─────────┐     │     ┌─────────────┐            ┌─────────────┐             │
    │ Cliente │────▶│────▶│  FisioClinic │───POST───▶│   API TPV   │             │
    │(Browser)│     │     │  (Laravel)   │◀──────────│(Otro Grupo) │             │
    └─────────┘     │     └──────┬───────┘  Response └─────────────┘             │
                    │            │                                                │
                    │            │ Almacena                                       │
                    │            ▼                                                │
                    │     ┌─────────────┐                                         │
                    │     │   MySQL DB  │                                         │
                    │     │  (payments) │◀─────── Webhook/Callback                │
                    │     └──────┬──────┘                                         │
                    │            │                                                │
                    │            │ Expone API                                     │
                    │            ▼                                                │
                    │     ┌─────────────┐                                         │
                    │     │ Nuestra API │◀─────── TPV / Otros Grupos              │
                    │     │ (Servicios) │                                         │
                    │     └─────────────┘                                         │
                    │                                                             │
                    └─────────────────────────────────────────────────────────────┘
```

<br/>

---

<br/>

<div align="center">

## 🗺️ Roadmap de Funcionalidades

*Desarrollo incremental organizado en fases*

</div>

<br/>

<table align="center">
<tr>
<td>

### 🔷 Fase 1: Fundamentos

> *Configuración base del proyecto*

- ✅ Configuración del entorno Laravel + Filament
- ⬜ Diseño e implementación del esquema de BD
- ⬜ Sistema de autenticación y autorización
- ⬜ Gestión de roles (Admin, Recepcionista, Profesional, Cliente)
- ⬜ CRUD de usuarios con asignación de roles

</td>
</tr>
<tr>
<td>

### 🔶 Fase 2: Núcleo del Sistema

> *Funcionalidades core de la clínica*

- ⬜ Gestión de salas/instalaciones
- ⬜ Configuración de horarios de clínica
- ⬜ Gestión de profesionales y especialidades
- ⬜ Sistema de reservas con calendario interactivo
- ⬜ Asignación inteligente de salas
- ⬜ Bloqueo de horarios por profesional

</td>
</tr>
<tr>
<td>

### 🔷 Fase 3: Experiencia de Usuario

> *Interfaces y notificaciones*

- ⬜ Portal público: Quiénes somos, contacto, horarios
- ⬜ Panel de cliente: historial, citas pendientes
- ⬜ Panel de profesional: agenda, historial de pacientes
- ⬜ Panel de recepcionista: gestión integral de reservas
- ⬜ Sistema de notificaciones por email
- ⬜ Diseño responsive con Tailwind CSS

</td>
</tr>
<tr>
<td>

### 🔶 Fase 4: Pagos y Tienda Online

> *Integración con TPV y e-commerce*

- ⬜ Integración con pasarela de pago (TPV Virtual)
- ⬜ Gestión de estados de pago
- ⬜ Catálogo de productos (tienda online)
- ⬜ Carrito de compras para usuarios autenticados
- ⬜ Historial de transacciones

</td>
</tr>
<tr>
<td>

### 🔷 Fase 5: Integraciones y Analytics

> *Funcionalidades avanzadas*

- ⬜ Integración con hoteles asociados
- ⬜ Sistema de valoraciones post-cita
- ⬜ Dashboard analítico para administradores
- ⬜ Informes de reservas y ocupación
- ⬜ Informes financieros con gráficos
- ⬜ Exportación de datos (CSV/PDF)
- ⬜ Logs y monitorización del sistema

</td>
</tr>
</table>

<br/>

<div align="center">

### 📋 Funcionalidades por Rol

</div>

<br/>

<table align="center">
<tr>
<th align="center">🌐 Público</th>
<th align="center">👤 Cliente</th>
<th align="center">🩺 Profesional</th>
<th align="center">🖥️ Recepcionista</th>
<th align="center">⚙️ Admin</th>
</tr>
<tr>
<td valign="top">

• Info legal<br/>
• Contacto<br/>
• Horarios<br/>
• Quiénes somos<br/>
• Ver tienda

</td>
<td valign="top">

• Registro<br/>
• Login/Logout<br/>
• Editar perfil<br/>
• Crear citas<br/>
• Ver historial<br/>
• Pagar (TPV)<br/>
• Valorar<br/>
• Comprar

</td>
<td valign="top">

• Ver agenda<br/>
• Bloquear horarios<br/>
• Historial pacientes<br/>
• Notas citas<br/>
• Crear citas

</td>
<td valign="top">

• CRUD reservas<br/>
• Asignar salas<br/>
• Calendario<br/>
• Filtros avanzados<br/>
• Config horarios<br/>
• Notificar

</td>
<td valign="top">

• CRUD usuarios<br/>
• CRUD salas<br/>
• Config global<br/>
• Reportes<br/>
• Analytics<br/>
• Logs sistema

</td>
</tr>
</table>

<br/>

---

<br/>

<div align="center">

## 🔄 Metodología de Desarrollo

> ⚠️ **Recordatorio**: Este proyecto sigue estrictamente la metodología **Git Flow**. Se asume que todos los miembros del equipo conocen y aplican esta metodología de trabajo.

<br/>

![main](https://img.shields.io/badge/main-🔵_Producción-2ea44f?style=for-the-badge&labelColor=1a1a2e)
![develop](https://img.shields.io/badge/develop-🟢_Integración-00d4ff?style=for-the-badge&labelColor=1a1a2e)
![feature](https://img.shields.io/badge/feature/*-🟣_Funcionalidades-a855f7?style=for-the-badge&labelColor=1a1a2e)
![release](https://img.shields.io/badge/release/*-🟡_Versiones-fbbf24?style=for-the-badge&labelColor=1a1a2e)
![hotfix](https://img.shields.io/badge/hotfix/*-🔴_Urgentes-ef4444?style=for-the-badge&labelColor=1a1a2e)
![bugfix](https://img.shields.io/badge/bugfix/*-🟠_Correcciones-f97316?style=for-the-badge&labelColor=1a1a2e)

</div>

<br/>

---

<br/>

<div align="center">

## 👥 Equipo - Grupo G17

*Dream Team de Desarrollo*

</div>

<br/>

<table align="center">
<tr>
<td align="center" width="25%">

<img src="https://img.shields.io/badge/👨‍💻-1a1a2e?style=for-the-badge" width="60"/>

**Naoufal Charafat Azaouiat**

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/Naoufal-Charafat)

`Desarrollador`

</td>
<td align="center" width="25%">

<img src="https://img.shields.io/badge/👩‍💻-1a1a2e?style=for-the-badge" width="60"/>

**Maha Essaoudi**

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/me58-ua)

`Desarrolladora`

</td>
<td align="center" width="25%">

<img src="https://img.shields.io/badge/👨‍💻-1a1a2e?style=for-the-badge" width="60"/>

**Sergiy Kazantsev**

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/)

`Desarrollador`

</td>
<td align="center" width="25%">

<img src="https://img.shields.io/badge/👩‍💻-1a1a2e?style=for-the-badge" width="60"/>

**Sabrine Bentaleb Kheyar**

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/)

`Desarrolladora`

</td>
</tr>
</table>

<br/>

---

<br/>

<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:0f3460,50:16213e,100:1a1a2e&height=120&section=footer"/>

<br/>

**Universidad de Alicante** · Ingeniería Web · Curso 2024/25
