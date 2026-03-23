<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // traer categorías por nombre para asignar IDs
        $cats = Category::pluck('id', 'nombre');

        $productos = [
            // ═══ CUMPLEAÑOS ═══
            [
                'category_id'      => $cats['Cumpleaños'],
                'nombre'           => 'Kit Cumpleaños Unicornio Completo',
                'descripcion'      => 'Kit completo con invitaciones, toppers, etiquetas y más. Editable en Canva.',
                'precio'           => 12.99,
                'precio_original'  => 25.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['unicornio', 'cumpleaños', 'kawaii', 'niña'],
                'ventas_count'     => 94,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 38,
            ],
            [
                'category_id'      => $cats['Cumpleaños'],
                'nombre'           => 'Kit Dinosaurios Fiesta',
                'descripcion'      => 'Diseño divertido con dinosaurios para los más pequeños.',
                'precio'           => 9.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['dinosaurios', 'cumpleaños', 'niño', 'dino'],
                'ventas_count'     => 59,
                'rating_promedio'  => 4.6,
                'resenas_count'    => 24,
            ],
            [
                'category_id'      => $cats['Cumpleaños'],
                'nombre'           => 'Toppers Princesas Acuarela',
                'descripcion'      => 'Set de 12 toppers con diseño de princesas en acuarela.',
                'precio'           => 4.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => null,
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['princesas', 'toppers', 'acuarela', 'niña'],
                'ventas_count'     => 41,
                'rating_promedio'  => 5.0,
                'resenas_count'    => 18,
            ],
            [
                'category_id'      => $cats['Cumpleaños'],
                'nombre'           => 'Kit Espacial Astronautas',
                'descripcion'      => 'Kit temático espacial con planetas, cohetes y astronautas.',
                'precio'           => 11.99,
                'precio_original'  => 18.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'oferta',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['espacio', 'astronautas', 'ciencia', 'niño'],
                'ventas_count'     => 30,
                'rating_promedio'  => 4.4,
                'resenas_count'    => 12,
            ],

            // ═══ STICKERS ═══
            [
                'category_id'      => $cats['Stickers'],
                'nombre'           => 'Pack 50 Stickers Kawaii',
                'descripcion'      => '50 stickers kawaii variados, perfectos para imprimir y decorar.',
                'precio'           => 2.49,
                'precio_original'  => 4.99,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['stickers', 'kawaii', 'decoración'],
                'ventas_count'     => 76,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 31,
            ],
            [
                'category_id'      => $cats['Stickers'],
                'nombre'           => 'Stickers Planificador Pastel',
                'descripcion'      => 'Pack de stickers para agenda y planificador en tonos pastel.',
                'precio'           => 1.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['stickers', 'planificador', 'agenda', 'pastel'],
                'ventas_count'     => 22,
                'rating_promedio'  => 4.7,
                'resenas_count'    => 9,
            ],

            // ═══ BABY SHOWER ═══
            [
                'category_id'      => $cats['Baby Shower'],
                'nombre'           => 'Kit Baby Shower Safari',
                'descripcion'      => 'Kit completo con animales de safari para recibir al bebé.',
                'precio'           => 6.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => null,
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['baby shower', 'safari', 'animales', 'bebé'],
                'ventas_count'     => 28,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 11,
            ],

            // ═══ FLORAL ═══
            [
                'category_id'      => $cats['Floral'],
                'nombre'           => 'Invitación Floral Editable',
                'descripcion'      => 'Invitación con diseño floral delicado, editable en Canva.',
                'precio'           => 3.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'Canva editable',
                'badge'            => 'editable',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['floral', 'invitación', 'canva', 'editable'],
                'ventas_count'     => 18,
                'rating_promedio'  => 4.3,
                'resenas_count'    => 7,
            ],

            // ═══ GRATIS ═══
            [
                'category_id'      => $cats['Stickers'],
                'nombre'           => 'Pack Stickers Gratuito Bienvenida',
                'descripcion'      => 'Pack de 10 stickers gratis para que conozcas la calidad Gomita.',
                'precio'           => 0,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => 'gratis',
                'estado'           => 'activo',
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['gratis', 'stickers', 'kawaii', 'muestra'],
                'ventas_count'     => 142,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 56,
            ],
        ];

        foreach ($productos as $prod) {
            Product::firstOrCreate(
                ['nombre' => $prod['nombre']],
                $prod
            );
        }

        $this->command->info('✅ Productos creados: ' . count($productos));
    }
}
