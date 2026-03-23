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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('restrict');
            $table->string('nombre');
            $table->string('slug')->unique()->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2);
            $table->decimal('precio_original', 8, 2)->nullable();
            $table->string('tipo_archivo');
            // PDF, Canva, PPT, PDF+Canva
            $table->enum('badge', ['nuevo', 'popular', 'oferta', 'editable', 'gratis'])
                ->nullable();
            $table->enum('estado', ['activo', 'borrador', 'pausado'])
                ->default('borrador');
            $table->boolean('descarga_inmediata')->default(true);
            $table->boolean('destacado')->default(false);
            $table->boolean('permite_resenas')->default(true);
            $table->json('tags')->nullable();
            // ['kawaii', 'cumpleaños', 'unicornio']
            $table->unsignedInteger('ventas_count')->default(0);
            $table->decimal('rating_promedio', 3, 2)->default(0);
            $table->unsignedInteger('resenas_count')->default(0);
            $table->string('archivo_path')->nullable();
            // ruta del archivo descargable en S3/Cloudinary
            $table->timestamps();
            $table->softDeletes();
            // permite recuperar productos eliminados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
