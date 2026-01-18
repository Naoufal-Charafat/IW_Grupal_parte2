<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use UnitEnum;
use BackedEnum;

class MiPerfil extends Page implements HasForms
{
    use InteractsWithForms;
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-circle';

    protected string $view = 'filament.pages.mi-perfil';
    
    protected static ?string $navigationLabel = 'Mi Perfil';
    
    protected static ?string $title = 'Mi Perfil';
    
    protected static string|UnitEnum|null $navigationGroup = 'Mi Cuenta';
    
    protected static ?int $navigationSort = 2;

    public ?array $profileData = [];
    public ?array $passwordData = [];

    /**
     * Only show this page to clients
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    /**
     * Only allow clients to access this page
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    public function mount(): void
    {
        $user = auth()->user();
        
        $this->profileForm->fill([
            'name' => $user->name,
            'email' => $user->email,
            'telefono' => $user->telefono,
            'line_1' => $user->line_1,
            'line_2' => $user->line_2,
            'postal_code' => $user->postal_code,
        ]);
        
        $this->passwordForm->fill([]);
    }
    
    protected function getForms(): array
    {
        return [
            'profileForm',
            'passwordForm',
        ];
    }

    public function profileForm(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Información Personal')
                    ->description('Actualiza tu información personal')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nombre Completo')
                                    ->required()
                                    ->maxLength(255),
                                    
                                TextInput::make('email')
                                    ->label('Correo Electrónico')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                    
                                TextInput::make('telefono')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->maxLength(20),
                            ]),
                    ]),
                    
                Section::make('Dirección')
                    ->description('Información de tu dirección')
                    ->schema([
                        TextInput::make('line_1')
                            ->label('Dirección Línea 1')
                            ->maxLength(255),
                            
                        TextInput::make('line_2')
                            ->label('Dirección Línea 2')
                            ->maxLength(255),
                            
                        TextInput::make('postal_code')
                            ->label('Código Postal')
                            ->maxLength(10),
                    ])
                    ->columns(1),
            ])
            ->statePath('profileData');
    }

    public function passwordForm(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Cambiar Contraseña')
                    ->description('Actualiza tu contraseña de acceso')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Contraseña Actual')
                            ->password()
                            ->required()
                            ->currentPassword(),
                            
                        TextInput::make('password')
                            ->label('Nueva Contraseña')
                            ->password()
                            ->required()
                            ->confirmed()
                            ->minLength(8)
                            ->maxLength(255),
                            
                        TextInput::make('password_confirmation')
                            ->label('Confirmar Nueva Contraseña')
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ]),
            ])
            ->statePath('passwordData');
    }

    public function updateProfile(): void
    {
        $data = $this->profileForm->getState();
        
        $user = auth()->user();
        $user->update($data);
        
        Notification::make()
            ->title('Perfil actualizado')
            ->success()
            ->body('Tu información personal ha sido actualizada correctamente.')
            ->send();
    }

    public function updatePassword(): void
    {
        $data = $this->passwordForm->getState();
        
        $user = auth()->user();
        $user->update([
            'password' => Hash::make($data['password']),
        ]);
        
        // Clear password data
        $this->passwordData = [];
        
        Notification::make()
            ->title('Contraseña actualizada')
            ->success()
            ->body('Tu contraseña ha sido cambiada correctamente.')
            ->send();
    }
}
