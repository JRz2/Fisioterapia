<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patologia;

class PatologiaSeeder extends Seeder
{
    public function run(): void
    {
        $patologias = [
            ['nombre' => 'Lumbalgia Aguda', 'zona_corporal_afectada' => 'Columna lumbar'],
            ['nombre' => 'Lumbalgia Crónica', 'zona_corporal_afectada' => 'Columna lumbar'],
            ['nombre' => 'Cervicalgia', 'zona_corporal_afectada' => 'Columna cervical'],
            ['nombre' => 'Tendinitis de Hombro', 'zona_corporal_afectada' => 'Hombro'],
            ['nombre' => 'Síndrome del Manguito Rotador', 'zona_corporal_afectada' => 'Hombro'],
            ['nombre' => 'Epicondilitis (Codo de Tenista)', 'zona_corporal_afectada' => 'Codo'],
            ['nombre' => 'Síndrome del Túnel Carpiano', 'zona_corporal_afectada' => 'Muñeca/mano'],
            ['nombre' => 'Gonalgia (Dolor de Rodilla)', 'zona_corporal_afectada' => 'Rodilla'],
            ['nombre' => 'Esguince de Tobillo', 'zona_corporal_afectada' => 'Tobillo'],
            ['nombre' => 'Fascitis Plantar', 'zona_corporal_afectada' => 'Pie'],
            ['nombre' => 'Ciática', 'zona_corporal_afectada' => 'Miembro inferior'],
            ['nombre' => 'Artrosis de Rodilla', 'zona_corporal_afectada' => 'Rodilla'],
            ['nombre' => 'Bursitis de Cadera', 'zona_corporal_afectada' => 'Cadera'],
            ['nombre' => 'Tendinitis Aquilea', 'zona_corporal_afectada' => 'Tobillo/pie'],
        ];

        foreach ($patologias as $patologia) {
            Patologia::create($patologia);
        }
    }
}