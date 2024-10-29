<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['consulta_id','dia','hora_inicio','hora_fin','fecha_inicio','fecha_fin','sesiones'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
