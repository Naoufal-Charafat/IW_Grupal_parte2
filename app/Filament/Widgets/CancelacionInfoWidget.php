<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CancelacionInfoWidget extends Widget
{
    protected string $view = 'filament.widgets.cancelacion-info';
    
    protected static ?int $sort = 1;
    
    // Ocupar 2 columnas del grid (ancho completo en grid de 2 columnas)
    protected int | string | array $columnSpan = 2;
}
