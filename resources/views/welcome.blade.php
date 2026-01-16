<x-app-layout>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                <main class="mt-6">
                    <!-- Treatments Link Card -->
                    <div class="mb-8">
                        <a href="{{ route('tratamientos.index') }}"
                            class="flex items-center gap-4 rounded-lg bg-gradient-to-r from-indigo-600 to-blue-500 p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:shadow-2xl focus:outline-none focus-visible:ring-[#FF2D20] lg:p-10">
                            <div
                                class="flex size-16 shrink-0 items-center justify-center rounded-full bg-white/20 backdrop-blur">
                                <svg class="size-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>

                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white">Nuestros Tratamientos</h2>
                                <p class="mt-2 text-white/90 text-lg">
                                    Descubre nuestros servicios de fisioterapia profesional. Masajes terapéuticos,
                                    rehabilitación deportiva y más.
                                </p>
                            </div>

                            <svg class="size-8 shrink-0 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
