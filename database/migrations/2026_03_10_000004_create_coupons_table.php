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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('descripcion')->nullable();
            $table->enum('tipo', ['porcentaje', 'monto_fijo']);
            $table->decimal('valor', 8, 2);
            // si tipo=porcentaje → 10.00 = 10%
            // si tipo=monto_fijo → 5.00 = $5
            $table->decimal('minimo_compra', 8, 2)->default(0);
            $table->unsignedInteger('limite_usos')->nullable();
            // null = sin límite
            $table->unsignedInteger('usos_por_cliente')->default(1);
            $table->unsignedInteger('usos_actuales')->default(0);
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            // null = aplica a toda la tienda
            $table->boolean('activo')->default(true);
            $table->boolean('solo_primera_compra')->default(false);
            $table->boolean('no_acumulable')->default(true);
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_vencimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
