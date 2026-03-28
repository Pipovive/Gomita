<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Style;

class StyleSeeder extends Seeder
{
    public function run(): void
    {
        $estilos = [
            ['nombre' => 'Kawaii',       'icono' => '✨', 'orden' => 1, 'slug' => 'kawuaii'],
            ['nombre' => 'Dinosaurios',  'icono' => '🦕', 'orden' => 2, 'slug' => 'dinosaurios'],
            ['nombre' => 'Minimalista',  'icono' => '🤍', 'orden' => 3,  'slug' => 'minimalista'],
            ['nombre' => 'Floral',       'icono' => '🌸', 'orden' => 4, 'slug' => 'floral'],
            ['nombre' => 'Infantil',     'icono' => '🌈', 'orden' => 5, 'slug' => 'infantil'],
            ['nombre' => 'Acuarela',     'icono' => '🎨', 'orden' => 6, 'slug' => 'acuarela'],
            ['nombre' => 'Espacial',     'icono' => '🚀', 'orden' => 7, 'slug' => 'espacial'],
            ['nombre' => 'Vintage',      'icono' => '🕰️', 'orden' => 8, 'slug' => 'vintage'],
        ];

        foreach ($estilos as $estilo) {
            if (!Style::where('nombre', $estilo['nombre'])->exists()) {
                Style::create($estilo);
            }
        }

        $this->command->info('✅ Estilos creados: ' . count($estilos));
    }
}
