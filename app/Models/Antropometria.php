<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antropometria extends Model
{
    use HasFactory;

    protected $fillable = ['peso', 'talla', 'imc', 'pi', 'pa', 'sp', 'fc', 'consulta_id'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
