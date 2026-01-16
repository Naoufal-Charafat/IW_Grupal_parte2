<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">
                    Contáctanos
                </h1>
                <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                    Estamos aquí para ayudarte. Completa el formulario y nos pondremos en contacto contigo lo antes posible.
                </p>
            </div>
        </div>
    </div>

    {{-- Información de Contacto --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Teléfono --}}
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-phone-alt text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Teléfono</h3>
                    <p class="text-gray-600 text-center text-sm mb-4">Llama a nuestro equipo de atención al paciente</p>
                    <p class="text-center">
                        <a href="tel:+34965123456" class="text-indigo-600 hover:text-indigo-700 font-semibold text-lg">
                            +34 965 123 456
                        </a>
                    </p>
                    <p class="text-center text-sm text-gray-500 mt-3">
                        <i class="fas fa-clock mr-1"></i>
                        Lunes a Viernes: 9:00-21:00
                    </p>
                </div>

                {{-- Email --}}
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-envelope text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Email</h3>
                    <p class="text-gray-600 text-center text-sm mb-4">Escríbenos directamente a nuestro correo</p>
                    <p class="text-center">
                        <a href="mailto:info@fisioclinic.com" class="text-indigo-600 hover:text-indigo-700 font-semibold text-lg">
                            info@fisioclinic.com
                        </a>
                    </p>
                    <p class="text-center text-sm text-gray-500 mt-3">
                        <i class="fas fa-reply mr-1"></i>
                        Respondemos en menos de 24 horas
                    </p>
                </div>

                {{-- Dirección --}}
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Visítanos en Alicante</h3>
                    <p class="text-gray-600 text-center text-sm mb-2">
                        <strong class="text-gray-900">FisioClinic Alicante</strong>
                    </p>
                    <p class="text-gray-600 text-center text-sm">
                        Avenida Dr. Gadea, 123<br>
                        03015 Alicante
                    </p>
                    <p class="text-center text-sm text-indigo-600 font-semibold mt-3">
                        <i class="fas fa-subway mr-1"></i>
                        Cercanías: Estación Alicante
                    </p>
                    <p class="text-center text-sm text-gray-500 mt-2">
                        <i class="fas fa-car mr-1"></i>
                        Parking disponible
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulario de Contacto --}}
    <div class="bg-gray-50 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Envíanos un Mensaje</h2>
                    <p class="mt-2 text-gray-600">Completa el formulario y te responderemos lo antes posible</p>
                </div>

                <form 
                    id="contactForm" 
                    x-data="{ 
                        submitting: false, 
                        showSuccess: false,
                        async submitForm(event) {
                            event.preventDefault();
                            if (this.submitting) return;
                            
                            this.submitting = true;
                            this.showSuccess = false;
                            
                            const formData = new FormData(event.target);
                            
                            try {
                                const response = await fetch('{{ route('contacto.store') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json',
                                    },
                                    body: formData
                                });
                                
                                const data = await response.json();
                                
                                if (response.ok) {
                                    this.showSuccess = true;
                                    event.target.reset();
                                    
                                    // Ocultar mensaje de éxito después de 5 segundos
                                    setTimeout(() => {
                                        this.showSuccess = false;
                                    }, 5000);
                                } else {
                                    // Manejar errores de validación
                                    if (data.errors) {
                                        let errorMessages = Object.values(data.errors).flat().join('\\n');
                                        alert('Por favor, corrige los siguientes errores:\\n' + errorMessages);
                                    } else {
                                        alert('Hubo un error al enviar el mensaje. Por favor, intenta nuevamente.');
                                    }
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('Hubo un error al enviar el mensaje. Por favor, intenta nuevamente.');
                            } finally {
                                this.submitting = false;
                            }
                        }
                    }"
                    @submit="submitForm"
                >
                    @csrf

                    <div class="space-y-6">
                        {{-- Nombre --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre completo <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nombre" 
                                id="nombre"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Tu nombre completo"
                            >
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="tu@email.com"
                            >
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                                Teléfono <span class="text-gray-400 text-xs">(opcional)</span>
                            </label>
                            <input 
                                type="tel" 
                                name="telefono" 
                                id="telefono"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="+34 600 000 000"
                            >
                        </div>

                        {{-- Servicio de Interés --}}
                        <div>
                            <label for="servicio_interes" class="block text-sm font-medium text-gray-700 mb-2">
                                Servicio de interés <span class="text-gray-400 text-xs">(opcional)</span>
                            </label>
                            <select 
                                name="servicio_interes" 
                                id="servicio_interes"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="">Selecciona un servicio...</option>
                                @foreach($tratamientos as $tratamiento)
                                    <option value="{{ $tratamiento->nombre }}">{{ $tratamiento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Mensaje --}}
                        <div>
                            <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-2">
                                Mensaje <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="mensaje" 
                                id="mensaje"
                                rows="5"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Cuéntanos cómo podemos ayudarte..."
                            ></textarea>
                            <p class="mt-1 text-xs text-gray-500">Mínimo 10 caracteres</p>
                        </div>

                        {{-- Botón de Envío --}}
                        <div>
                            <button 
                                type="submit"
                                :disabled="submitting"
                                class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-semibold rounded-md hover:from-indigo-700 hover:to-blue-600 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span x-show="!submitting">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Enviar Mensaje
                                </span>
                                <span x-show="submitting">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Enviando...
                                </span>
                            </button>
                        </div>

                        {{-- Mensaje de Éxito --}}
                        <div 
                            x-show="showSuccess"
                            x-transition
                            class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md"
                            role="alert"
                        >
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <div>
                                    <p class="font-semibold">¡Mensaje enviado con éxito!</p>
                                    <p class="text-sm">Responderemos tu consulta en menos de 24 horas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Preguntas Frecuentes (FAQ) --}}
    <div class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Preguntas Frecuentes</h2>
                <p class="mt-2 text-gray-600">Encuentra respuestas rápidas a las consultas más comunes</p>
            </div>

            <div 
                x-data="{ openFaq: 1 }"
                class="space-y-4"
            >
                {{-- FAQ 1 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 1 ? null : 1"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Cómo puedo reservar una cita?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 1 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 1"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Puedes reservar una cita de tres formas: llamando al +34 965 123 456, enviándonos un email a info@fisioclinic.com, o directamente a través de nuestra plataforma web en la sección de tratamientos. Solo necesitas estar registrado para realizar reservas online.
                        </p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 2 ? null : 2"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Cuál es el horario de atención?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 2 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 2"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Nuestro centro está abierto de lunes a viernes de 9:00 a 21:00 horas. Esta amplitud horaria nos permite adaptarnos a tus necesidades y ofrecerte la mejor atención en el horario que más te convenga.
                        </p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 3 ? null : 3"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Necesito receta médica para los tratamientos?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 3 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 3"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            No es necesario presentar receta médica para la mayoría de nuestros tratamientos de fisioterapia. Sin embargo, si dispones de prescripción médica o informe médico, te recomendamos traerlo a tu primera consulta para que nuestros profesionales puedan conocer mejor tu situación.
                        </p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 4 ? null : 4"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Qué métodos de pago aceptan?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 4 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 4"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Aceptamos efectivo, tarjetas de crédito/débito (Visa, Mastercard), y transferencias bancarias. El pago se realiza al finalizar cada sesión, aunque también ofrecemos bonos de sesiones con descuento para tratamientos continuos.
                        </p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 5 ? null : 5"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Puedo cancelar o modificar mi cita?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 5 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 5"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Sí, puedes cancelar o modificar tu cita con al menos 24 horas de antelación sin ningún coste. Para ello, contacta con nosotros por teléfono o email. Te pedimos que nos avises con tiempo para poder ofrecer ese hueco a otros pacientes.
                        </p>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 6 ? null : 6"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Tienen parking disponible?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 6 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 6"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Sí, disponemos de parking en el mismo edificio del centro. Además, estamos muy bien comunicados por transporte público: la estación de cercanías de Alicante está a pocos minutos a pie.
                        </p>
                    </div>
                </div>

                {{-- FAQ 7 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 7 ? null : 7"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Cuánto dura una sesión de fisioterapia?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 7 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 7"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            La duración de cada sesión varía según el tratamiento específico, pero generalmente oscila entre 30 y 60 minutos. En la primera consulta, el fisioterapeuta evaluará tu caso y te informará sobre la duración estimada de las sesiones.
                        </p>
                    </div>
                </div>

                {{-- FAQ 8 --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 8 ? null : 8"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors duration-200 flex items-center justify-between"
                    >
                        <span class="font-semibold text-gray-900">¿Trabajan con aseguradoras?</span>
                        <i 
                            class="fas fa-chevron-down text-indigo-600 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 8 }"
                        ></i>
                    </button>
                    <div 
                        x-show="openFaq === 8"
                        x-transition
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                    >
                        <p class="text-gray-600">
                            Trabajamos con las principales compañías aseguradoras. Te proporcionamos toda la documentación necesaria para que puedas solicitar el reembolso a tu aseguradora. Consulta con nosotros para verificar si estamos en tu cuadro médico.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white mb-4">¿Listo para comenzar tu recuperación?</h2>
                <p class="text-xl text-indigo-100 mb-8">
                    Reserva tu cita hoy mismo y da el primer paso hacia una mejor salud
                </p>
                <a 
                    href="{{ route('tratamientos.index') }}" 
                    class="inline-block bg-white text-indigo-700 px-8 py-3 rounded-md hover:bg-gray-100 transition-colors duration-200 font-semibold"
                >
                    <i class="fas fa-calendar-check mr-2"></i>
                    Ver Tratamientos y Reservar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
