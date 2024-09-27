<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $fillable = ['antecedentes', 'motivo', 'historia_actual', 'consulta_id'];

    //uno a uno

    public function consulta(){
        return $this-> belongsTo(Consulta::class);
    }
}
