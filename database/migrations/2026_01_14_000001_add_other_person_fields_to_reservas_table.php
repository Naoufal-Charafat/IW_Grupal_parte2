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
            // Add fields for reservations made for another person
            $table->boolean('es_para_otro')->default(false)->after('user_id');
            $table->string('nombre_paciente')->nullable()->after('es_para_otro');
            $table->string('email_paciente')->nullable()->after('nombre_paciente');
            $table->string('telefono_paciente')->nullable()->after('email_paciente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['es_para_otro', 'nombre_paciente', 'email_paciente', 'telefono_paciente']);
        });
    }
};
