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

        {{-- Account Information --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                Información de la Cuenta
            </h3>
            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Miembro desde
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ auth()->user()->created_at->format('d/m/Y') }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Última actualización
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ auth()->user()->updated_at->format('d/m/Y H:i') }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Estado de la cuenta
                    </dt>
                    <dd class="mt-1">
                        @if(auth()->user()->esta_activo)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Activa
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Inactiva
                            </span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Rol
                    </dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            Cliente
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-filament-panels::page>
