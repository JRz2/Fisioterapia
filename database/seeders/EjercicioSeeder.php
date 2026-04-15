<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ejercicio;

class EjercicioSeeder extends Seeder
{
    public function run(): void
    {
        $ejercicios = [
            // Ejercicios para columna lumbar
            ['nombre' => 'Puente de glúteos', 'descripcion' => 'Acostado boca arriba, rodillas flexionadas, elevar la cadera', 'zona_corporal' => 'Columna lumbar', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 12],
            ['nombre' => 'Gato-camello', 'descripcion' => 'En 4 puntos, alternar arqueo y redondeo de columna', 'zona_corporal' => 'Columna lumbar', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 10],
            ['nombre' => 'Plancha abdominal', 'descripcion' => 'Mantener posición de plancha frontal', 'zona_corporal' => 'Columna lumbar', 'dificultad' => 'media', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 30],
            ['nombre' => 'Estiramiento de isquiotibiales', 'descripcion' => 'Sentado, pierna extendida, inclinar torso hacia adelante', 'zona_corporal' => 'Columna lumbar', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 30],
            
            // Ejercicios para hombro
            ['nombre' => 'Rotación externa con banda', 'descripcion' => 'Codo pegado al cuerpo, girar antebrazo hacia afuera', 'zona_corporal' => 'Hombro', 'dificultad' => 'media', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 15],
            ['nombre' => 'Elevación frontal', 'descripcion' => 'Con mancuerna ligera, elevar brazo al frente', 'zona_corporal' => 'Hombro', 'dificultad' => 'media', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 12],
            ['nombre' => 'Péndulos de Codman', 'descripcion' => 'Inclinado, dejar colgar brazo y hacer círculos suaves', 'zona_corporal' => 'Hombro', 'dificultad' => 'baja', 'series_recomendadas' => 2, 'repeticiones_recomendadas' => 20],
            
            // Ejercicios para rodilla
            ['nombre' => 'Sentadilla parcial', 'descripcion' => 'Espalda recta, bajar como si fueras a sentarte', 'zona_corporal' => 'Rodilla', 'dificultad' => 'media', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 12],
            ['nombre' => 'Elevación de pierna recta', 'descripcion' => 'Acostado, elevar pierna extendida', 'zona_corporal' => 'Rodilla', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 15],
            ['nombre' => 'Extensión de rodilla sentado', 'descripcion' => 'Sentado, extender y flexionar rodilla', 'zona_corporal' => 'Rodilla', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 15],
            
            // Ejercicios para tobillo
            ['nombre' => 'Alfabeto con el pie', 'descripcion' => 'Con el pie en el aire, dibujar el abecedario', 'zona_corporal' => 'Tobillo', 'dificultad' => 'baja', 'series_recomendadas' => 1, 'repeticiones_recomendadas' => 26],
            ['nombre' => 'Elevación de talones', 'descripcion' => 'Parado, subir y bajar talones', 'zona_corporal' => 'Tobillo', 'dificultad' => 'baja', 'series_recomendadas' => 3, 'repeticiones_recomendadas' => 15],
        ];

        foreach ($ejercicios as $ejercicio) {
            Ejercicio::create($ejercicio);
        }
    }
}