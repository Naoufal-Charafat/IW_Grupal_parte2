<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $telefono = '';
    public string $line_1 = '';
    public string $line_2 = '';
    public string $postal_code = '';
    public $redirect = '';

    public function mount()
    {
        $this->redirect = request()->query('redirect', '');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'telefono' => ['nullable', 'string', 'max:30'],
                'line_1' => ['required', 'string', 'max:255'],
                'line_2' => ['nullable', 'string', 'max:255'],
                'postal_code' => ['required', 'regex:/^\\d{5}$/'],
            ],
            [
                'postal_code.regex' => 'El código postal debe tener exactamente 5 números.',
                'email.email' => 'El email debe tener un formato válido (ejemplo@dominio.com).',
                'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            ],
        );

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        $user->assignRole('cliente');

        Auth::login($user);

        // Check for redirect parameter, then default to dashboard
        if (!empty($this->redirect)) {
            $this->redirect($this->redirect);
        } else {
            $this->redirect('/dashboard');
        }
    }
}; ?>

<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div
        class="w-full max-w-2xl lg:w-3/5 p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800">
        <a href="http://localhost:8000" class="logo flex flex-col items-center justify-center">
            <div class="logo-icon"><i class="fas fa-heartbeat"></i></div>
            FisioClinic
        </a>
        <h2 class="text-3xl font-bold text-center text-indigo-700 dark:text-indigo-400 mb-2">Crear cuenta</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-8">Regístrate para acceder</p>
        <form wire:submit="register" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre
                        <span class="text-red-500">*</span></label>
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text"
                        name="name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email <span
                            class="text-red-500">*</span></label>
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                        name="email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Contraseña
                        <span class="text-red-500">*</span></label>
                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirmar Contraseña <span
                            class="text-red-500">*</span></label>
                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="line_1" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Dirección
                        (línea 1) <span class="text-red-500">*</span></label>
                    <x-text-input wire:model="line_1" id="line_1" class="block mt-1 w-full" type="text"
                        name="line_1" required autocomplete="address-line1" />
                    <x-input-error :messages="$errors->get('line_1')" class="mt-2" />
                </div>
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Código
                        Postal <span class="text-red-500">*</span></label>
                    <x-text-input wire:model="postal_code" id="postal_code" class="block mt-1 w-full" type="text"
                        name="postal_code" required autocomplete="postal-code" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>
            </div>
            <div>
                <x-input-label for="line_2" :value="__('Dirección (línea 2, opcional)')" />
                <x-text-input wire:model="line_2" id="line_2" class="block mt-1 w-full" type="text" name="line_2"
                    autocomplete="address-line2" />
                <x-input-error :messages="$errors->get('line_2')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="telefono" :value="__('Teléfono (opcional)')" />
                <x-text-input wire:model="telefono" id="telefono" class="block mt-1 w-full" type="text"
                    name="telefono" autocomplete="tel" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">Crear
                cuenta</button>
        </form>
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline dark:text-indigo-400"
                wire:navigate>¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</div>
