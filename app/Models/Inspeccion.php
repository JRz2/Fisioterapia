<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    use HasFactory;

    protected $fillable = ['observacion', 'plano_posterior', 'plano_lateral', 'plano_anterior', 'consulta_id'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
