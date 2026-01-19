<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public LoginForm $form;
    public $redirect = '';

    public function mount()
    {
        $this->redirect = request()->query('redirect', '');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // Check for redirect parameter, then session intended, then default dashboard
        if (!empty($this->redirect)) {
            $this->redirect($this->redirect);
        } else {
            $this->redirectIntended(default: '/dashboard');
        }
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800">
        <h2 class="text-3xl font-bold text-center text-indigo-700 dark:text-indigo-400 mb-2">Iniciar sesión</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 mb-8">Accede a tu cuenta</p>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form wire:submit="login" class="space-y-6">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
            <div class="flex items-center justify-between">
                <label for="remember" class="flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">Iniciar sesión</button>
        </form>
        <div class="mt-6 text-center">
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400" wire:navigate>¿No tienes cuenta? Regístrate</a>
        </div>
    </div>
</div>
