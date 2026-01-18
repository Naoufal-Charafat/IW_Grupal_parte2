<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Profile Information Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <form wire:submit="updateProfile">
                {{ $this->profileForm }}
                
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 rounded-b-lg">
                    <x-filament::button type="submit" color="primary">
                        <x-filament::icon icon="heroicon-o-check" class="w-5 h-5 mr-1" />
                        Guardar Cambios
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Change Password Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <form wire:submit="updatePassword">
                {{ $this->passwordForm }}
                
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 rounded-b-lg">
                    <x-filament::button type="submit" color="warning">
                        <x-filament::icon icon="heroicon-o-lock-closed" class="w-5 h-5 mr-1" />
                        Cambiar Contraseña
                    </x-filament::button>
                </div>
            </form>
        </div>
    </div>
</x-filament-panels::page>
