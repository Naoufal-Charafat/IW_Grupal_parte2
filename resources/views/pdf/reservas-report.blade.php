<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Reservas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9px;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0066cc;
        }
        
        .header h1 {
            font-size: 18px;
            color: #0066cc;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 10px;
            color: #666;
        }
        
        .summary {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #555;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background-color: #0066cc;
            color: white;
        }
        
        table th {
            padding: 8px 4px;
            text-align: left;
            font-size: 8px;
            font-weight: bold;
        }
        
        table td {
            padding: 6px 4px;
            border-bottom: 1px solid #ddd;
            font-size: 8px;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        table tbody tr:hover {
            background-color: #f0f0f0;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 8px;
            color: #999;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Informe de Reservas</h1>
        <p>Período: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
        <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @if($reservas->count() > 0)
        <div class="summary">
            <div class="summary-row">
                <span class="summary-label">Total de Reservas:</span>
                <span>{{ $reservas->count() }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Monto Total:</span>
                <span>{{ number_format($reservas->sum('monto_total'), 2) }} €</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Confirmadas:</span>
                <span>{{ $reservas->where('estado', 'confirmada')->count() }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Pendientes:</span>
                <span>{{ $reservas->where('estado', 'pendiente')->count() }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Tratamiento</th>
                    <th>Profesional</th>
                    <th>Habitación</th>
                    <th>Estado</th>
                    <th>Pago</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->codigo_confirmacion }}</td>
                        <td>{{ $reserva->fecha->format('d/m/Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }} - {{ Carbon\Carbon::parse($reserva->hora_fin)->format('H:i') }}</td>
                        <td>
                            @if($reserva->es_para_otro)
                                {{ $reserva->nombre_paciente }}
                            @else
                                {{ $reserva->user->name ?? 'N/A' }}
                            @endif
                        </td>
                        <td>{{ $reserva->tratamiento->nombre ?? 'N/A' }}</td>
                        <td>{{ $reserva->profesional->nombre ?? 'N/A' }}</td>
                        <td>{{ $reserva->habitacion->nombre ?? 'N/A' }}</td>
                        <td>
                            <span class="badge 
                                @if($reserva->estado === 'confirmada') badge-success
                                @elseif($reserva->estado === 'pendiente') badge-warning
                                @elseif($reserva->estado === 'cancelada') badge-danger
                                @else badge-info
                                @endif">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge 
                                @if($reserva->estado_pago === 'pagado') badge-success
                                @elseif($reserva->estado_pago === 'pendiente') badge-warning
                                @else badge-danger
                                @endif">
                                {{ ucfirst($reserva->estado_pago) }}
                            </span>
                        </td>
                        <td>{{ number_format($reserva->monto_total, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>No se encontraron reservas para el período seleccionado.</p>
        </div>
    @endif

    <div class="footer">
        <p>Este informe fue generado automáticamente por el sistema de gestión de clínica.</p>
    </div>
</body>
</html>
