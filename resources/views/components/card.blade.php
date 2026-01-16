@props([
    'title' => '',
    'description' => '',
    'footer' => null,
    'headerClass' => 'bg-gradient-to-r from-indigo-500 to-blue-500',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300']) }}>
    <!-- Card Header -->
    @if($title)
    <div class="{{ $headerClass }} px-6 py-4">
        <h3 class="text-xl font-bold text-white">
            {{ $title }}
        </h3>
    </div>
    @endif
    
    <!-- Card Body -->
    <div class="px-6 py-4">
        @if($description)
        <p class="text-gray-600 text-sm leading-relaxed mb-4">
            {{ $description }}
        </p>
        @endif
        
        {{ $slot }}
    </div>
    
    <!-- Card Footer -->
    @if($footer)
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $footer }}
    </div>
    @endif
</div>
