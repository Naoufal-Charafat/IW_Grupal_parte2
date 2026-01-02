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
        Schema::create('media', function (Blueprint $table) {
            // Identificador único
            $table->id();

            // Relación polimórfica (Laravel convention)
            $table->string('mediable_type', 191)->comment('Tipo de modelo relacionado');
            $table->unsignedBigInteger('mediable_id')->comment('ID del modelo relacionado');

            // Organización y tipo
            $table->string('collection_name', 64)->default('default')->comment('Colección de media: featured, avatar, logo, gallery');

            // Información del archivo
            $table->string('name')->comment('Nombre único generado (UUID + extensión)');
            $table->string('file_name')->comment('Nombre original del archivo');
            $table->string('mime_type', 191)->comment('Tipo MIME del archivo');
            $table->string('disk', 32)->default('public')->comment('Disco de almacenamiento');

            // Ubicación y metadatos técnicos
            $table->string('path', 500)->comment('Ruta completa del archivo');
            $table->unsignedBigInteger('size')->comment('Tamaño en bytes');
            $table->unsignedSmallInteger('width')->nullable()->comment('Ancho en píxeles');
            $table->unsignedSmallInteger('height')->nullable()->comment('Alto en píxeles');

            // Metadatos adicionales y ordenamiento
            $table->json('custom_properties')->nullable()->comment('Propiedades personalizadas');
            $table->unsignedInteger('order_column')->default(0)->comment('Orden dentro de la colección');

            // Auditoría y soft deletes
            $table->timestamps();
            $table->softDeletes();

            // Índices de performance
            $table->index(['mediable_type', 'mediable_id'], 'idx_mediable');
            $table->index('collection_name', 'idx_collection');
            $table->index('created_at', 'idx_created');
            $table->index('deleted_at', 'idx_media_deleted');

            // Restricción de unicidad para orden por colección (solo registros activos)
            $table->unique(
                ['mediable_type', 'mediable_id', 'collection_name', 'order_column'],
                'unique_order_per_collection'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
