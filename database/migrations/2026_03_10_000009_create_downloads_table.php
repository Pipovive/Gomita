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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('token')->unique();
            // token único para el link de descarga
            $table->unsignedInteger('descargas_realizadas')->default(0);
            $table->unsignedInteger('max_descargas')->default(5);
            $table->timestamp('expira_en')->nullable();
            // null = no expira
            $table->timestamp('primera_descarga_en')->nullable();
            $table->timestamp('ultima_descarga_en')->nullable();
            $table->string('ip_ultima_descarga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
