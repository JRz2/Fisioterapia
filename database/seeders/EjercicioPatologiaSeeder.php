<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ejercicio;
use App\Models\Patologia;
use Illuminate\Support\Facades\DB;

class EjercicioPatologiaSeeder extends Seeder
{
    public function run(): void
    {
        // Relaciones: ejercicio_nombre => [patologias_nombres]
        $relaciones = [
            'Puente de glúteos' => ['Lumbalgia Aguda', 'Lumbalgia Crónica', 'Ciática'],
            'Gato-camello' => ['Lumbalgia Aguda', 'Lumbalgia Crónica', 'Cervicalgia'],
            'Plancha abdominal' => ['Lumbalgia Crónica'],
            'Estiramiento de isquiotibiales' => ['Lumbalgia Aguda', 'Lumbalgia Crónica', 'Ciática'],
            'Rotación externa con banda' => ['Tendinitis de Hombro', 'Síndrome del Manguito Rotador'],
            'Elevación frontal' => ['Tendinitis de Hombro'],
            'Péndulos de Codman' => ['Tendinitis de Hombro', 'Síndrome del Manguito Rotador'],
            'Sentadilla parcial' => ['Gonalgia', 'Artrosis de Rodilla'],
            'Elevación de pierna recta' => ['Gonalgia', 'Artrosis de Rodilla'],
            'Extensión de rodilla sentado' => ['Artrosis de Rodilla'],
            'Alfabeto con el pie' => ['Esguince de Tobillo', 'Tendinitis Aquilea'],
            'Elevación de talones' => ['Tendinitis Aquilea', 'Fascitis Plantar'],
        ];

        foreach ($relaciones as $ejercicioNombre => $patologiasNombres) {
            $ejercicio = Ejercicio::where('nombre', $ejercicioNombre)->first();
            if ($ejercicio) {
                foreach ($patologiasNombres as $patologiaNombre) {
                    $patologia = Patologia::where('nombre', $patologiaNombre)->first();
                    if ($patologia) {
                        DB::table('ejercicio_patologias')->insert([
                            'ejercicio_id' => $ejercicio->id,
                            'patologia_id' => $patologia->id,
                            'nivel_evidencia' => 0.8,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}