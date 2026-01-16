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
        Schema::table('reservas', function (Blueprint $table) {
            // Add new columns
            $table->string('codigo_confirmacion', 20)->unique()->nullable()->after('id');
            $table->integer('duracion_minutos')->nullable()->after('tratamiento_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['codigo_confirmacion', 'duracion_minutos']);
        });
    }
};
