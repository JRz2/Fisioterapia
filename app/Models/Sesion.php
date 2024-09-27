<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $fillable =['fecha','codigo','sintoma', 'observacion', 'recomendacion', 'tratamiento','consulta_id'];

    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function imgsesion()
        {
            return $this->hasMany(Imgsesion::class);
        }
}
