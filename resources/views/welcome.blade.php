<x-app-layout>
    {{-- 1. Hero Carousel Section --}}
    <x-hero-carousel />

    {{-- 2. Treatments Section --}}
    <x-treatments-section :limit="4" />

    {{-- 3. Por qué elegirnos Section --}}
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-20">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">¿Por Qué Elegirnos?</h2>
                <p class="text-xl text-indigo-100 max-w-3xl mx-auto">
                    Somos tu mejor opción para cuidar de tu salud y bienestar
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Benefit 1 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-user-md text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Profesionales Certificados</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Nuestro equipo cuenta con más de 10 años de experiencia y certificaciones internacionales en fisioterapia.
                    </p>
                </div>

                {{-- Benefit 2 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-heartbeat text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Tratamientos Personalizados</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Cada paciente es único. Diseñamos planes de tratamiento adaptados a tus necesidades específicas.
                    </p>
                </div>

                {{-- Benefit 3 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-hospital text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Instalaciones Modernas</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Equipamiento de última generación y espacios diseñados para tu comodidad y recuperación.
                    </p>
                </div>

                {{-- Benefit 4 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-calendar-check text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Reservas 24/7</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Sistema de reservas online disponible las 24 horas. Agenda tu cita cuando más te convenga.
                    </p>
                </div>

                {{-- Benefit 5 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-clock text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Horario Flexible</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Horarios adaptados a tu rutina diaria, con sesiones matutinas, vespertinas y fines de semana.
                    </p>
                </div>

                {{-- Benefit 6 --}}
                <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg p-8 hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full mb-6 mx-auto">
                        <i class="fas fa-star text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-4">Resultados Comprobados</h3>
                    <p class="text-indigo-100 text-center leading-relaxed">
                        Miles de pacientes satisfechos. Nuestros tratamientos tienen un alto índice de éxito demostrado.
                    </p>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="text-center mt-16">
                <a href="{{ route('tratamientos.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg hover:shadow-xl">
                    Descubre Nuestros Tratamientos
                    <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 4. Team Carousel Section --}}
    <x-team-carousel />
</x-app-layout>

