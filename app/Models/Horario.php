<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['consulta_id','dia','hora_inicio','hora_fin','fecha_inicio','fecha_fin','sesiones','estado'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function sesiones()
        {
            return $this->hasMany(Sesion::class, 'consulta_id', 'consulta_id');
        }
                
}
