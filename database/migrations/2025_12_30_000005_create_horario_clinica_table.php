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
        Schema::create('horario_clinica', function (Blueprint $table) {
            $table->id();
            $table->integer('dia'); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado
            $table->time('hora_apertura');
            $table->time('hora_cierre');
            $table->boolean('es_dia_laboral')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_clinica');
    }
};
