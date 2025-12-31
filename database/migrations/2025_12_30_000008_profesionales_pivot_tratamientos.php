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
        Schema::create('profesional_tratamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesional_id')->constrained('profesionales')->onDelete('cascade');
            $table->foreignId('tratamiento_id')->constrained('tratamientos')->onDelete('cascade');
            $table->decimal('precio_personalizado', 8, 2)->nullable();
            $table->integer('duracion_personalizada')->nullable();
            $table->boolean('esta_activo')->default(true);
            $table->timestamps();

            // Índice único para evitar duplicados
            $table->unique(['profesional_id', 'tratamiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesional_tratamiento');
    }
};
