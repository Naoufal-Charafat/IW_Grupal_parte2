<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .reminder-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border-radius: 8px;
        }

        .reminder-badge p {
            margin: 0 0 8px 0;
            font-size: 14px;
        }

        .reminder-badge h2 {
            margin: 0;
            font-size: 28px;
        }

        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .details-section {
            background: #fffbeb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
        }

        .detail-row {
            margin: 15px 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #fde68a;
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-label {
            font-size: 12px;
            color: #78716c;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            color: #111827;
            font-weight: 600;
        }

        .notes-section {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .notes-section h3 {
            color: #1e40af;
            margin-top: 0;
            font-size: 16px;
        }

        .notes-section p {
            color: #1e3a8a;
            margin-bottom: 0;
            white-space: pre-line;
        }

        .important-box {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .important-box h3 {
            margin-top: 0;
            color: #92400e;
            font-size: 18px;
        }

        .important-box ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .important-box li {
            margin: 10px 0;
            color: #78350f;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
        }

        .bell-icon {
            color: #f59e0b;
            font-size: 60px;
            margin-bottom: 10px;
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            .header h1 {
                font-size: 24px;
            }

            .reminder-badge h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="bell-icon">🔔</div>
        <h1>Recordatorio de Cita</h1>
        <p>Tu cita es mañana</p>
    </div>

    <div class="content">
        <p>Estimado/a
            @if ($reserva->es_para_otro)
                {{ $reserva->nombre_paciente }}
            @else
                {{ $reserva->user->name }}
            @endif,
        </p>

        <p>Este es un recordatorio de que tienes una cita programada para <strong>mañana,
                {{ $reserva->fecha->format('d/m/Y') }}</strong>.</p>

        <div class="reminder-badge">
            <p>Tu cita es</p>
            <h2>MAÑANA</h2>
            <p>{{ $reserva->fecha->format('l, d \d\e F \d\e Y') }}</p>
        </div>

        <div class="details-section">
            <h3 style="margin-top: 0; color: #92400e;">Detalles de tu Cita</h3>

            <div class="detail-row">
                <div class="detail-label">Código de Confirmación</div>
                <div class="detail-value">{{ $reserva->codigo_confirmacion }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tratamiento</div>
                <div class="detail-value">{{ $reserva->tratamiento->nombre }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Profesional</div>
                <div class="detail-value">{{ $reserva->profesional->user->name }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Fecha</div>
                <div class="detail-value">{{ $reserva->fecha->format('d/m/Y') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Hora</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Duración</div>
                <div class="detail-value">{{ $reserva->duracion_minutos }} minutos</div>
            </div>

            @if ($reserva->habitacion)
                <div class="detail-row">
                    <div class="detail-label">Sala Asignada</div>
                    <div class="detail-value">{{ $reserva->habitacion->nombre }}</div>
                </div>
            @endif
        </div>

        @if ($reserva->notas)
            <div class="notes-section">
                <h3>📝 Notas de tu Cita</h3>
                <p>{{ $reserva->notas }}</p>
            </div>
        @endif

        <div class="important-box">
            <h3>⚠️ Recordatorios Importantes</h3>
            <ul>
                <li><strong>Llega 10 minutos antes</strong> de tu cita</li>
                <li>Trae tu <strong>DNI o documento de identificación</strong></li>
                <li>Si necesitas cancelar, hazlo con <strong>24 horas de anticipación</strong></li>
                <li>Usa ropa cómoda apropiada para el tratamiento</li>
            </ul>
        </div>

        <p style="margin-top: 30px;">¡Nos vemos mañana! Si tienes alguna pregunta, no dudes en contactarnos.</p>

        <p style="margin-top: 20px;"><strong>Equipo de Fisioterapia</strong></p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responder directamente a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Clínica de Fisioterapia. Todos los derechos reservados.</p>
    </div>
</body>

</html>
