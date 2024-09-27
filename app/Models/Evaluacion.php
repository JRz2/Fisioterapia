<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    
    protected $fillable = ['localidad', 'consulta_id', 'aparicion', 'duracion', 'intensidad', 'caracter', 'irradiacion', 'atenuantess'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
