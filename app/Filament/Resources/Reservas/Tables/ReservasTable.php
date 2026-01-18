<?php


namespace App\Filament\Resources\Reservas\Tables;

use App\Filament\Actions\ExportToPdfAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReservasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_confirmacion')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable(),
                IconColumn::make('es_para_otro')
                    ->boolean(),
                TextColumn::make('nombre_paciente')
                    ->searchable(),
                TextColumn::make('email_paciente')
                    ->searchable(),
                TextColumn::make('telefono_paciente')
                    ->searchable(),
                TextColumn::make('profesional.id')
                    ->searchable(),
                TextColumn::make('habitacion.id')
                    ->searchable(),
                TextColumn::make('tratamiento.id')
                    ->searchable(),
                TextColumn::make('duracion_minutos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('hora_inicio')
                    ->time()
                    ->sortable(),
                TextColumn::make('hora_fin')
                    ->time()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge(),
                TextColumn::make('estado_pago')
                    ->badge(),
                TextColumn::make('monto_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('expira_en')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('creado_por')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'confirmada' => 'Confirmada',
                        'cancelada' => 'Cancelada',
                        'completada' => 'Completada',
                    ])
                    ->multiple(),
                SelectFilter::make('estado_pago')
                    ->label('Estado de Pago')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                        'reembolsado' => 'Reembolsado',
                    ])
                    ->multiple(),
                Filter::make('fecha')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('fecha_desde')
                            ->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('fecha_hasta')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['fecha_desde'],
                                fn(Builder $query, $date): Builder => $query->whereDate('fecha', '>=', $date),
                            )
                            ->when(
                                $data['fecha_hasta'],
                                fn(Builder $query, $date): Builder => $query->whereDate('fecha', '<=', $date),
                            );
                    }),
            ])
            ->headerActions([
                ExportToPdfAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
