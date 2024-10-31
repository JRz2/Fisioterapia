<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = ['consulta_id', 'fecha', 'diagnostico', 'informe', 'recomendacion', 'rehabilitacion', 'nota'];

    public function consulta(){
        return $this-> belongsTo(Consulta::class);
    }
}
