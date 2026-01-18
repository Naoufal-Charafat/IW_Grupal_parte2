<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .confirmation-code {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border-radius: 8px;
        }

        .confirmation-code p {
            margin: 0 0 8px 0;
            font-size: 14px;
        }

        .confirmation-code h2 {
            margin: 0;
            font-size: 32px;
            letter-spacing: 2px;
        }

        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .details-section {
            background: #f9fafb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #10b981;
        }

        .detail-row {
            margin: 15px 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-label {
            font-size: 12px;
            color: #6b7280;
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

        .info-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .info-box h3 {
            margin-top: 0;
            color: #111827;
            font-size: 18px;
        }

        .info-box ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .info-box li {
            margin: 10px 0;
            color: #374151;
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

        .checkmark {
            color: #10b981;
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

            .confirmation-code h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="checkmark">✓</div>
        <h1>¡Cita Confirmada!</h1>
        <p>Gracias por reservar con nosotros</p>
    </div>

    <div class="content">
        <p>Estimado/a
            @if ($reserva->es_para_otro)
                {{ $reserva->nombre_paciente }}
            @else
                {{ $reserva->user->name }}
            @endif,
        </p>

        <p>Gracias por confiar en nosotros. Tu cita ha sido confirmada exitosamente. A continuación encontrarás los
            datos de tu cita confirmada:</p>

        <div class="confirmation-code">
            <p>Número de Confirmación</p>
            <h2>{{ $reserva->codigo_confirmacion }}</h2>
        </div>

        <div class="details-section">
            <h3 style="margin-top: 0; color: #111827;">Datos de la Cita</h3>

            <div class="detail-row">
                <div class="detail-label">Paciente</div>
                <div class="detail-value">
                    @if ($reserva->es_para_otro)
                        {{ $reserva->nombre_paciente }}
                        <br>
                        <span style="font-size: 14px; color: #6b7280; font-weight: 400;">{{ $reserva->email_paciente }}</span>
                        @if ($reserva->telefono_paciente)
                            <br>
                            <span style="font-size: 14px; color: #6b7280; font-weight: 400;">{{ $reserva->telefono_paciente }}</span>
                        @endif
                        <div class="badge">Reserva para otra persona</div>
                    @else
                        {{ $reserva->user->name }}
                        <br>
                        <span style="font-size: 14px; color: #6b7280; font-weight: 400;">{{ $reserva->user->email }}</span>
                    @endif
                </div>
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
                <h3>📝 Notas Adicionales</h3>
                <p>{{ $reserva->notas }}</p>
            </div>
        @endif

        <div class="info-box">
            <h3>Información Importante</h3>
            <ul>
                <li>✓ Por favor, llega 10 minutos antes de tu cita</li>
                <li>✓ Trae tu DNI o documento de identificación</li>
                <li>✓ Si necesitas cancelar, hazlo con 24 horas de anticipación</li>
                <li>✓ Guarda este correo como comprobante de tu reserva</li>
            </ul>
        </div>

        <p style="margin-top: 30px;">Si tienes alguna pregunta o necesitas realizar cambios en tu cita, no dudes en
            contactarnos.</p>

        <p>¡Esperamos verte pronto!</p>

        <p style="margin-top: 20px;"><strong>Equipo de Fisioterapia</strong></p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responder directamente a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Clínica de Fisioterapia. Todos los derechos reservados.</p>
    </div>
</body>

</html>
