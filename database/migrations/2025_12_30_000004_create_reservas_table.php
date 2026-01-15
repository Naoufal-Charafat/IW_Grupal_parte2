<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('profesional_id')->constrained('profesionales')->onDelete('cascade');
            $table->foreignId('habitacion_id')->nullable()->constrained('habitaciones')->onDelete('set null');
            $table->foreignId('tratamiento_id')->constrained('tratamientos')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('estado', ['borrador', 'bloqueado', 'confirmado', 'completado', 'cancelado', 'no_asistio'])->default('borrador');
            $table->enum('estado_pago', ['no_pagado', 'pendiente', 'pagado', 'reembolsado', 'fallido'])->default('no_pagado');
            $table->decimal('monto_total', 8, 2)->nullable();
            $table->timestamp('expira_en')->nullable();
            $table->text('notas')->nullable();
            $table->foreignId('creado_por')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->string('payment_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
