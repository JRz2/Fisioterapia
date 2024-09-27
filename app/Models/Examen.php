<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = ['prueba', 'examen', 'consulta_id'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function imgexamen()
        {
            return $this->hasMany(Imgexamen::class);
        }
}
