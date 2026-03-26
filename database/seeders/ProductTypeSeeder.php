<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Cajas',            'icono' => '🎁', 'slug' => 'cajas'],
            ['nombre' => 'Papelería creativa', 'icono' => '✏️', 'slug' => 'papeleria'],
            ['nombre' => 'Etiquetas',        'icono' => '🏷️', 'slug' => 'etiquetas'],
            ['nombre' => 'Piñatas',          'icono' => '🎉', 'slug' => 'pinatas'],
            ['nombre' => 'Invitaciones',     'icono' => '💌', 'slug' => 'invitaciones'],
            ['nombre' => 'Kits de fiesta',   'icono' => '🎊', 'slug' => 'fiesta'],
        ];

        foreach ($tipos as $tipo) {
            ProductType::create($tipo); // el slug se genera automático
        }
    }
}
