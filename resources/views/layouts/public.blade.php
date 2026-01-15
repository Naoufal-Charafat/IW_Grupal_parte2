<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'FisioClinic') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased font-sans bg-gray-50">
    {{-- TODO: TEMPORAL - Aquí tu compañero pondrá su header component --}}
    {{-- Por ahora una navegación simple temporal para evitar errores --}}
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-indigo-600">
                        🏥 FisioClinic
                    </a>
                </div>
                <div class="hidden sm:flex sm:space-x-8">
                    <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Inicio</a>
                    <a href="{{ route('tratamientos.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Tratamientos</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    
    {{-- TODO: TEMPORAL - Aquí tu compañero pondrá su footer component --}}
    
    @stack('scripts')
</body>
</html>
