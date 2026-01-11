<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seleccionar Fecha y Hora - FisioClinic</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .time-slot:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
        .time-slot.selected {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }
        .date-btn.selected {
            background-color: #4f46e5;
            color: white;
        }
    </style>
</head>
<body class="antialiased font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">
                        🏥 FisioClinic
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8">
                    <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                        Inicio
                    </a>
                    <a href="{{ route('tratamientos.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                        Tratamientos
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <span class="text-gray-600 px-3 py-2 text-sm font-medium">
                            {{ auth()->user()->name }}
                        </span>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Progress Steps -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-center space-x-4">
                <!-- Step 1 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-900">Elegir Profesional</span>
                </div>
                
                <div class="w-16 h-0.5 bg-indigo-600"></div>
                
                <!-- Step 2 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 text-white font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-900">Fecha y Hora</span>
                </div>
                
                <div class="w-16 h-0.5 bg-gray-300"></div>
                
                <!-- Step 3 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-semibold">
                        3
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Confirmar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="{{ route('reservas.select-profesional', $tratamiento) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a profesionales
        </a>

        <!-- Professional Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-full">
                        <span class="text-2xl font-bold text-white">{{ substr($profesional->user->name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-xl font-bold text-gray-900">{{ $profesional->user->name }}</h3>
                    <p class="text-gray-600">{{ $tratamiento->nombre }}</p>
                    <div class="mt-2 flex items-center space-x-4 text-sm">
                        <span class="flex items-center text-gray-700">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $duracion }} minutos
                        </span>
                        <span class="flex items-center text-indigo-600 font-semibold">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ number_format($precio, 2) }}€
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date and Time Selection -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Calendar - Left Side -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Fecha</h2>
                </div>
                
                <p class="text-gray-600 mb-6">Selecciona una fecha disponible</p>

                <div id="calendar" class="space-y-4">
                    <!-- Calendar will be generated here -->
                </div>
            </div>

            <!-- Time Slots - Right Side -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Hora</h2>
                </div>

                <div id="time-slots-container">
                    <p class="text-gray-500 text-center py-8">
                        Selecciona primero una fecha para ver las horas disponibles
                    </p>
                </div>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="mt-8 flex justify-end">
            <button id="continue-btn" 
                    disabled
                    class="px-8 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed font-semibold text-lg">
                Continuar a Confirmación →
            </button>
        </div>
    </div>

    <script>
        const profesionalId = {{ $profesional->id }};
        const tratamientoId = {{ $tratamiento->id }};
        const duracionMinutos = {{ $duracion }};
        
        let selectedDate = null;
        let selectedTime = null;

        // Generate calendar for next 2 weeks
        function generateCalendar() {
            const calendar = document.getElementById('calendar');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            let currentWeek = [];
            const weeks = [];
            
            // Generate dates for next 14 days
            for (let i = 0; i < 14; i++) {
                const date = new Date(today);
                date.setDate(today.getDate() + i);
                
                currentWeek.push(date);
                
                if (currentWeek.length === 7 || i === 13) {
                    weeks.push([...currentWeek]);
                    currentWeek = [];
                }
            }
            
            // Render weeks
            weeks.forEach((week, weekIndex) => {
                const weekDiv = document.createElement('div');
                weekDiv.className = 'grid grid-cols-7 gap-2';
                
                week.forEach(date => {
                    const dayName = date.toLocaleDateString('es-ES', { weekday: 'short' });
                    const dayNumber = date.getDate();
                    const monthName = date.toLocaleDateString('es-ES', { month: 'short' });
                    
                    const isToday = date.toDateString() === today.toDateString();
                    const isPast = date < today;
                    
                    const button = document.createElement('button');
                    button.className = `date-btn flex flex-col items-center justify-center p-3 rounded-lg border-2 transition-colors ${
                        isPast ? 'opacity-40 cursor-not-allowed border-gray-200 bg-gray-50' : 
                        'border-gray-300 hover:border-indigo-500 hover:bg-indigo-50'
                    }`;
                    button.disabled = isPast;
                    button.innerHTML = `
                        <span class="text-xs text-gray-500 capitalize">${dayName}</span>
                        <span class="text-2xl font-bold mt-1">${dayNumber}</span>
                        <span class="text-xs text-gray-500 capitalize">${monthName}</span>
                    `;
                    
                    if (!isPast) {
                        button.onclick = () => selectDate(date, button);
                    }
                    
                    weekDiv.appendChild(button);
                });
                
                calendar.appendChild(weekDiv);
            });
        }

        function selectDate(date, button) {
            // Remove previous selection
            document.querySelectorAll('.date-btn').forEach(btn => {
                btn.classList.remove('selected');
            });
            
            // Add selection
            button.classList.add('selected');
            selectedDate = date;
            selectedTime = null;
            
            // Load time slots for this date
            loadTimeSlots(date);
            
            // Disable continue button until time is selected
            document.getElementById('continue-btn').disabled = true;
        }

        function loadTimeSlots(date) {
            const container = document.getElementById('time-slots-container');
            container.innerHTML = '<p class="text-gray-500 text-center py-4">Cargando horarios disponibles...</p>';
            
            // Format date without timezone conversion
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const fechaFormatted = `${year}-${month}-${day}`;
            
            const url = `{{ route('api.profesional.disponibilidad', $profesional) }}?fecha=${fechaFormatted}`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    generateTimeSlots(date, data.horas_ocupadas);
                })
                .catch(error => {
                    console.error('Error fetching availability:', error);
                    container.innerHTML = '<p class="text-red-500 text-center py-4">Error al cargar horarios. Por favor intenta de nuevo.</p>';
                });
        }

        function generateTimeSlots(date, horasOcupadas = []) {
            const container = document.getElementById('time-slots-container');
            const slots = [];
            
            // generar citas entre 9:00 a 19:00
            for (let hour = 9; hour < 19; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    
                    // Check if this time slot is booked
                    const isBooked = isTimeSlotOccupied(timeString, horasOcupadas);
                    
                    slots.push({ time: timeString, available: !isBooked });
                }
            }
            
            container.innerHTML = '<div class="grid grid-cols-3 gap-3"></div>';
            const grid = container.querySelector('div');
            
            slots.forEach(slot => {
                const button = document.createElement('button');
                button.className = `time-slot px-4 py-3 border-2 rounded-lg font-medium transition-colors ${
                    slot.available ? 
                    'border-gray-300 hover:border-indigo-500 hover:bg-indigo-50' : 
                    'border-gray-200 bg-gray-100 text-gray-400'
                }`;
                button.textContent = slot.time;
                button.disabled = !slot.available;
                
                if (slot.available) {
                    button.onclick = () => selectTime(slot.time, button);
                }
                
                grid.appendChild(button);
            });
        }

        function isTimeSlotOccupied(timeSlot, horasOcupadas) {
            // Check if the time slot overlaps with any occupied time range
            const [hours, minutes] = timeSlot.split(':').map(Number);
            const slotTime = hours * 60 + minutes;
            
            for (const ocupada of horasOcupadas) {
                const [inicioHours, inicioMinutes] = ocupada.inicio.split(':').map(Number);
                const [finHours, finMinutes] = ocupada.fin.split(':').map(Number);
                
                const inicioTime = inicioHours * 60 + inicioMinutes;
                const finTime = finHours * 60 + finMinutes;
                
                // Check if slot overlaps with occupied range
                if (slotTime >= inicioTime && slotTime < finTime) {
                    return true;
                }
            }
            
            return false;
        }

        function selectTime(time, button) {
            // Remove previous selection
            document.querySelectorAll('.time-slot').forEach(btn => {
                btn.classList.remove('selected');
            });
            
            // Add selection
            button.classList.add('selected');
            selectedTime = time;
            
            // Enable continue button
            document.getElementById('continue-btn').disabled = false;
        }

        // Continue to confirmation
        document.getElementById('continue-btn').onclick = () => {
            if (selectedDate && selectedTime) {
                // Format date without timezone conversion
                const year = selectedDate.getFullYear();
                const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
                const day = String(selectedDate.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;
                
                // Navigate to confirmation page with query parameters
                const params = new URLSearchParams({
                    tratamiento_id: tratamientoId,
                    profesional_id: profesionalId,
                    fecha: formattedDate,
                    hora: selectedTime
                });
                
                window.location.href = `{{ route('reservas.confirmar') }}?${params.toString()}`;
            }
        };

        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', () => {
            generateCalendar();
        });
    </script>
</body>
</html>
