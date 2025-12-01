
# Funcionalidades de los distintos perfiles:

## FUNCIONALIDADES PUBLICA

- Consultar información de la clínica:
    - Ver la página 'Quienes somos'
    - Consultar horarios de la clínica
    - Ver información de contacto y ubicación
    - Solo ver los productos en la tienda (pero no puede comprar tiene que ser authentificado)
    - información legal y aviso de privacidad


## FUNCIONALIDADES RECEPCIONISTA

- Crear una reserva para un cliente:
    - Filtrar por fecha, profesional, cliente o sala.
    - Elegir el profesional deseado.
    - Elegir la fecha y hora de la cita.
    - Asignar sala disponible.
    - Confirmar la reserva.
    - Enviar email de confirmación al cliente y al profesional (el sistema)
- Modificar reservas existentes:
    - Cambiar fecha, hora, profesional o sala de la reserva.
    - Notificar al cliente y al profesional sobre los cambios (el sistema)
- Cancelar reservas:
    - Cancelar reservas existentes.
    - Notificar al cliente y al profesional por email (el sistema)
- Consultar reservas:
    - Ver todas las reservas de la clínica en un calendario o listado.
    - Filtrar las reservas por cliente, profesional, etc.
    - Ver citas pendientes y pasadas.
- Establecer horarios de la clínica:
    - Configurar apertura y cierre de la clínica.
    - Configurar días laborables y festivos.
    - Establecer horarios de los profesionales:
    - Notificar a los profesionales afectados sobre los bloqueos (opcional)


## FUNCIONALIDADES Cliente:

- Registro y gestión de su cuenta:
    - Registrarse en la web
    - Iniciar y cerrar sesión
    - Editar información de su perfil
    - Recuperar contraseña mediante email
- Gestionar sus reservas:
    - Crear una reserva seleccionando el profesional, la fecha, la hora
    - Recibir un email de confirmación de la reserva
    - Ver el historial de sus reservas
    - Var las citas pendientes
    - Modificar su reserva si no está finalizada
    - Cancelar una reserva
- Pagos:
    - Realizar el pago de la consulta a través del TPVV
    - Consultar el estado de un pago
- Acceso a la tienda online: Ver los productos disponibles
- Recibir recordatorios por email
- integración con hoteles: el cliente puede solicitar servicio desde un hotel asociado
- Valorar la experiencia con un profesional después de su cita


## Funcionalidades del Perfil Profesional / Fisio

- Gestión de disponibilidad
    - Bloqueo de horas
        - El profesional podrá bloquear uno o varios intervalos horarios para que ningún cliente pueda reservar en esos periodos.
        - El sistema deberá impedir reservas durante esos bloques, incluso si el horario general de la clínica está abierto.
- Consulta de citas
    - Citas pendientes
        - El profesional podrá acceder a un listado donde se muestren todas las citas futuras, ordenadas por fecha y hora.
        - Cada cita mostrará:
            - Cliente
            - Sala asignada
            - Tipo de tratamiento (opcional, podrá añadirse en el momento de la cita o posteriormente)
    - Historial de citas
        - Puede consultar sus citas anteriores, con acceso a:
            - Fecha/hora
            - Cliente
            - Notas del profesional (Opcional)

3. Gestión de reservas (opcional)

3.1. Crear reservas para clientes (opcional)

- El profesional puede crear reservas manualmente para un cliente
- Cuando un fisio crea o modifica una reserva, podrá seleccionar una sala disponible.


## FUNCIONALIDADES DEL ADMINISTRADOR

1. Gestión de Usuarios

- Crear, editar y eliminar usuarios de cualquier perfil (Cliente, Recepcionista, Profesional)
- Asignar roles y permisos específicos
- Activar o desactivar cuentas de usuario
- Restablecer contraseñas de usuarios
- Ver listado completo de todos los usuarios registrados con filtros por perfil

2. Gestión de Profesionales

- Dar de alta nuevos profesionales en el sistema
- Asignar especialidades y tratamientos a cada profesional
- Configurar tarifas por profesional o tipo de servicio
- Visualizar la carga de trabajo y estadísticas de cada profesional

3. Gestión de Salas/Instalaciones

- Crear, editar y eliminar salas de tratamiento
- Configurar características de cada sala (capacidad, equipamiento, tipo de tratamiento)
- Establecer disponibilidad general de las salas

4. Configuración General de la Clínica

- Configurar horarios globales de apertura y cierre
- Establecer días festivos y cierres generales
- Configurar duración estándar de las citas por tipo de tratamiento (nota: evaluar complejidad para encontrar huecos en calendario)
- Gestionar información institucional (datos de contacto, ubicación, "Quiénes somos")

5. Informes de Reservas y Ocupación

- Generar informes de reservas por período (diarias, semanales, mensuales)
- Consultar tasas de ocupación por profesional y sala
- Ver estadísticas de cancelaciones y modificaciones
- Exportar datos de reservas en formatos CSV/PDF

6. Informes Financieros

- Generar reportes de facturación por período
- Consultar ingresos por profesional, sala o tipo de tratamiento
- Ver estado de pagos pendientes y completados
- Analizar tendencias de ingresos con gráficos

7. Monitorización del Sistema

- Consultar logs de actividad del sistema
- Ver métricas de uso de la plataforma
- Recibir alertas sobre problemas técnicos o de disponibilidad
- Gestionar notificaciones automáticas del sistema (emails de confirmación, recordatorios) 