<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre'     => 'Cumpleaños',
                'emoji'      => '🎂',
                'descripcion' => 'Kits completos, invitaciones y decoración para cumpleaños',
                'color'      => '#FF6B9D',
                'visible'    => true,
                'destacada'  => true,
                'orden'      => 1,
            ],
            [
                'nombre'     => 'Stickers',
                'emoji'      => '✨',
                'descripcion' => 'Packs de stickers kawaii imprimibles para toda ocasión',
                'color'      => '#FFD166',
                'visible'    => true,
                'destacada'  => true,
                'orden'      => 2,
            ],
            [
                'nombre'     => 'Baby Shower',
                'emoji'      => '🍼',
                'descripcion' => 'Decoración y papelería para recibir al bebé',
                'color'      => '#06D6A0',
                'visible'    => true,
                'destacada'  => true,
                'orden'      => 3,
            ],
            [
                'nombre'     => 'Bodas',
                'emoji'      => '💍',
                'descripcion' => 'Invitaciones y papelería nupcial elegante',
                'color'      => '#9B5DE5',
                'visible'    => true,
                'destacada'  => false,
                'orden'      => 4,
            ],
            [
                'nombre'     => 'Navidad',
                'emoji'      => '🎄',
                'descripcion' => 'Diseños navideños para decorar tus fiestas de fin de año',
                'color'      => '#FF5252',
                'visible'    => true,
                'destacada'  => false,
                'orden'      => 5,
            ],
            [
                'nombre'     => 'Floral',
                'emoji'      => '🌸',
                'descripcion' => 'Diseños delicados con flores y elementos naturales',
                'color'      => '#FF9B6B',
                'visible'    => true,
                'destacada'  => true,
                'orden'      => 6,
            ],
            [
                'nombre'     => 'Graduación',
                'emoji'      => '🎓',
                'descripcion' => 'Celebrá los logros académicos con estilo',
                'color'      => '#FFD166',
                'visible'    => true,
                'destacada'  => false,
                'orden'      => 7,
            ],
            [
                'nombre'     => 'Amor',
                'emoji'      => '💕',
                'descripcion' => 'San Valentín, aniversarios y todo lo romántico',
                'color'      => '#FF6B9D',
                'visible'    => true,
                'destacada'  => false,
                'orden'      => 8,
            ],
        ];

        foreach ($categorias as $cat) {
            Category::firstOrCreate(
                ['nombre' => $cat['nombre']],
                $cat
            );
        }

        $this->command->info('✅ Categorías creadas: ' . count($categorias));
    }
}
