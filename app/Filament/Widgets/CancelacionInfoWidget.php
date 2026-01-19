<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CancelacionInfoWidget extends Widget
{
    protected string $view = 'filament.widgets.cancelacion-info';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';
}
