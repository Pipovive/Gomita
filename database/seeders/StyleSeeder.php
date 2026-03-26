<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Style;

class StyleSeeder extends Seeder
{
    public function run(): void
    {
        $estilos = [
            ['nombre' => 'Kawaii',       'icono' => '✨', 'orden' => 1],
            ['nombre' => 'Dinosaurios',  'icono' => '🦕', 'orden' => 2],
            ['nombre' => 'Minimalista',  'icono' => '🤍', 'orden' => 3],
            ['nombre' => 'Floral',       'icono' => '🌸', 'orden' => 4],
            ['nombre' => 'Infantil',     'icono' => '🌈', 'orden' => 5],
            ['nombre' => 'Acuarela',     'icono' => '🎨', 'orden' => 6],
            ['nombre' => 'Espacial',     'icono' => '🚀', 'orden' => 7],
            ['nombre' => 'Vintage',      'icono' => '🕰️', 'orden' => 8],
        ];

        foreach ($estilos as $estilo) {
            if (!Style::where('nombre', $estilo['nombre'])->exists()) {
                Style::create($estilo);
            }
        }

        $this->command->info('✅ Estilos creados: ' . count($estilos));
    }
}
