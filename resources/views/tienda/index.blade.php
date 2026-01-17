<x-app-layout>
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">
                    Tienda de Fisioterapia
                </h1>
                <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                    Productos profesionales seleccionados para tu recuperación.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <form method="GET" action="{{ route('tienda.index', [], false) }}" class="space-y-4">

                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="buscar" class="block text-sm font-medium text-gray-700 mb-2">
                            Buscar Producto
                        </label>
                        <div class="relative">
                            <input type="text" name="buscar" id="buscar"
                                   value="{{ request('buscar') }}"
                                   placeholder="Ej: Kinesio, Crema..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="precio_min" class="block text-sm font-medium text-gray-700 mb-2">
                            Precio Mínimo (€)
                        </label>
                        <input type="number" name="precio_min" id="precio_min"
                               value="{{ request('precio_min') }}"
                               min="0" step="1" placeholder="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="precio_max" class="block text-sm font-medium text-gray-700 mb-2">
                            Precio Máximo (€)
                        </label>
                        <input type="number" name="precio_max" id="precio_max"
                               value="{{ request('precio_max') }}"
                               min="0" step="1" placeholder="Max"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-colors">
                        Aplicar Filtros
                    </button>

                    <a href="{{ route('tienda.index', [], false) }}"
                       class="inline-flex items-center justify-center px-6 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition-colors">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($productos->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron productos</h3>
                <p class="mt-1 text-sm text-gray-500">Prueba a ajustar los filtros de búsqueda.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($productos as $producto)
                    <div class="bg-white overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-gray-100">
                        <div class="relative h-48 bg-gray-200">
                            <img src="{{ $producto['imagen'] ?? 'https://placehold.co/400x300' }}" alt="{{ $producto['nombre'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">{{ $producto['nombre'] }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ $producto['descripcionCorta'] ?? '' }}</p>
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-2xl font-bold text-indigo-600">{{ number_format($producto['precio'], 2) }} €</span>
                                <a href="{{ $producto['url'] ?? '#' }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Ver Detalle</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $productos->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>