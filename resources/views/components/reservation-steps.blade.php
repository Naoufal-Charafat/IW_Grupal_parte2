@props([
    'currentStep' => 1,
])

<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-center space-x-4">
            <!-- Step 1: Elegir Profesional -->
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $currentStep > 1 ? 'bg-green-500 text-white' : ($currentStep == 1 ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-300 text-gray-600 font-semibold') }}">
                    @if($currentStep > 1)
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        1
                    @endif
                </div>
                <span class="ml-2 text-sm font-medium {{ $currentStep >= 1 ? 'text-gray-900' : 'text-gray-500' }}">Elegir Profesional</span>
            </div>
            
            <div class="w-16 h-0.5 {{ $currentStep > 1 ? 'bg-green-500' : ($currentStep == 1 ? 'bg-indigo-600' : 'bg-gray-300') }}"></div>
            
            <!-- Step 2: Fecha y Hora -->
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $currentStep > 2 ? 'bg-green-500 text-white' : ($currentStep == 2 ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-300 text-gray-600 font-semibold') }}">
                    @if($currentStep > 2)
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        2
                    @endif
                </div>
                <span class="ml-2 text-sm font-medium {{ $currentStep >= 2 ? 'text-gray-900' : 'text-gray-500' }}">Fecha y Hora</span>
            </div>
            
            <div class="w-16 h-0.5 {{ $currentStep > 2 ? 'bg-green-500' : ($currentStep == 2 ? 'bg-indigo-600' : 'bg-gray-300') }}"></div>
            
            <!-- Step 3: Confirmar -->
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $currentStep > 3 ? 'bg-green-500 text-white' : ($currentStep == 3 ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-300 text-gray-600 font-semibold') }}">
                    @if($currentStep > 3)
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        3
                    @endif
                </div>
                <span class="ml-2 text-sm font-medium {{ $currentStep >= 3 ? 'text-gray-900' : 'text-gray-500' }}">Confirmar</span>
            </div>
        </div>
    </div>
</div>
