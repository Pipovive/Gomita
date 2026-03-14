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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('numero_orden')->unique();
            // ej: ORD-2025-00124
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('restrict');
            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('descuento', 8, 2)->default(0);
            $table->decimal('total', 8, 2);
            $table->enum('estado', [
                'pendiente',
                'procesando',
                'completado',
                'fallido',
                'reembolsado'
            ])->default('pendiente');
            $table->enum('metodo_pago', [
                'tarjeta',
                'pse',
                'nequi',
                'efecty',
                'mercadopago'
            ])->nullable();
            $table->string('mp_payment_id')->nullable();
            // ID de pago de MercadoPago
            $table->string('mp_status')->nullable();
            // approved, pending, rejected
            $table->timestamp('pagado_en')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
