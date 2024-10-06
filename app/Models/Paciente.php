<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre' ,'paterno', 'materno', 'direccion', 'celular', 'ocupacion', 'deporte', 'genero', 'edad','ci','imagen'];

    //relacion uno a muchos
    public function consulta(){
        return $this->hasMany(Consulta::class);
    }  
     
}
