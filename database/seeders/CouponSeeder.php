<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $cupones = [
            [
                'codigo'              => 'BIENVENIDA',
                'descripcion'         => 'Descuento de bienvenida para primera compra',
                'tipo'                => 'porcentaje',
                'valor'               => 10,
                'minimo_compra'       => 0,
                'limite_usos'         => 100,
                'usos_por_cliente'    => 1,
                'activo'              => true,
                'solo_primera_compra' => true,
                'no_acumulable'       => true,
                'fecha_vencimiento'   => now()->addMonths(6),
            ],
            [
                'codigo'              => 'GOMITA10',
                'descripcion'         => '$5 de descuento en compras mayores a $20',
                'tipo'                => 'monto_fijo',
                'valor'               => 5,
                'minimo_compra'       => 20,
                'limite_usos'         => 50,
                'usos_por_cliente'    => 2,
                'activo'              => true,
                'solo_primera_compra' => false,
                'no_acumulable'       => true,
                'fecha_vencimiento'   => now()->addMonths(3),
            ],
            [
                'codigo'              => 'FIESTA20',
                'descripcion'         => '20% en kits de cumpleaños',
                'tipo'                => 'porcentaje',
                'valor'               => 20,
                'minimo_compra'       => 10,
                'limite_usos'         => 30,
                'usos_por_cliente'    => 1,
                'activo'              => true,
                'solo_primera_compra' => false,
                'no_acumulable'       => true,
                'fecha_vencimiento'   => now()->addMonth(),
            ],
            [
                'codigo'              => 'ADMIN100',
                'descripcion'         => 'Cupón de prueba para testing — 100% descuento',
                'tipo'                => 'porcentaje',
                'valor'               => 100,
                'minimo_compra'       => 0,
                'limite_usos'         => null,
                'usos_por_cliente'    => 99,
                'activo'              => true,
                'solo_primera_compra' => false,
                'no_acumulable'       => false,
                'fecha_vencimiento'   => null,
            ],
        ];

        foreach ($cupones as $cup) {
            Coupon::firstOrCreate(
                ['codigo' => $cup['codigo']],
                $cup
            );
        }

        $this->command->info('✅ Cupones creados: ' . count($cupones));
    }
}
