@props([
    'items' => [],
])

<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                @foreach($items as $index => $item)
                    <li>
                        @if($index > 0)
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </li>
                    <li>
                        @if(isset($item['url']) && !$loop->last)
                            <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-gray-700">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span class="{{ $loop->last ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
                                {{ $item['label'] }}
                            </span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
