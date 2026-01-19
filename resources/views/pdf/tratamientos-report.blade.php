<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Tratamientos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
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
            font-size: 20px;
            color: #0066cc;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .summary {
            background-color: #f5f5f5;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .summary-label {
            font-weight: bold;
            color: #555;
        }

        .tratamiento-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            page-break-inside: avoid;
        }

        .tratamiento-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid #0066cc;
        }

        .tratamiento-nombre {
            font-size: 14px;
            font-weight: bold;
            color: #0066cc;
        }

        .tratamiento-precio {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
        }

        .tratamiento-body {
            margin-top: 10px;
        }

        .tratamiento-field {
            margin-bottom: 8px;
            display: flex;
        }

        .field-label {
            font-weight: bold;
            color: #555;
            min-width: 120px;
        }

        .field-value {
            color: #333;
            flex: 1;
        }

        .descripcion {
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 3px solid #0066cc;
            border-radius: 3px;
        }

        .descripcion-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .descripcion-text {
            color: #666;
            line-height: 1.4;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .stat-box {
            text-align: center;
            padding: 10px;
            background-color: #f0f8ff;
            border-radius: 4px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #0066cc;
        }

        .stat-label {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Catálogo de Tratamientos</h1>
        <p>Generado el: {{ $generatedAt->format('d/m/Y H:i') }}</p>
        @if ($onlyActive)
            <p style="color: #28a745; font-weight: bold;">Mostrando solo tratamientos activos</p>
        @endif
    </div>

    @if ($tratamientos->count() > 0)
        <div class="summary">
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-value">{{ $tratamientos->count() }}</div>
                    <div class="stat-label">Total Tratamientos</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ number_format($tratamientos->avg('precio'), 2) }} €</div>
                    <div class="stat-label">Precio Promedio</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ number_format($tratamientos->avg('duracion_minutos'), 0) }} min</div>
                    <div class="stat-label">Duración Promedio</div>
                </div>
            </div>
        </div>

        @foreach ($tratamientos as $tratamiento)
            <div class="tratamiento-card">
                <div class="tratamiento-header">
                    <div class="tratamiento-nombre">{{ $tratamiento->nombre }}</div>
                    <div class="tratamiento-precio">{{ number_format($tratamiento->precio, 2) }} €</div>
                </div>

                <div class="tratamiento-body">
                    <div class="tratamiento-field">
                        <div class="field-label">Duración:</div>
                        <div class="field-value">{{ $tratamiento->duracion_minutos }} minutos</div>
                    </div>

                    <div class="tratamiento-field">
                        <div class="field-label">Estado:</div>
                        <div class="field-value">
                            <span class="badge {{ $tratamiento->esta_activo ? 'badge-success' : 'badge-danger' }}">
                                {{ $tratamiento->esta_activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </div>

                    @if ($tratamiento->descripcion)
                        <div class="descripcion">
                            <div class="descripcion-label">Descripción:</div>
                            <div class="descripcion-text">{{ $tratamiento->descripcion }}</div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="no-data">
            <p>No se encontraron tratamientos para exportar.</p>
        </div>
    @endif

    <div class="footer">
        <p>Este catálogo fue generado automáticamente por el sistema de gestión de clínica.</p>
    </div>
</body>

</html>
