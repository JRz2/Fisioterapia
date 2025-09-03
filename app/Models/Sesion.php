<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $fillable =['fecha','codigo','sintoma', 'observacion', 'recomendacion', 'tratamiento','postura_inicial','postura_final','rango','consulta_id', 'ruta'];

    protected $casts = [
        'posture_initial' => 'array',
        'posture_final' => 'array',
        'range_of_motion' => 'array',
    ];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function imgsesion()
        {
            return $this->hasMany(Imgsesion::class);
        }
}
