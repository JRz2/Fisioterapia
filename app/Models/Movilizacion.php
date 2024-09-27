<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movilizacion extends Model
{
    use HasFactory;

    protected $fillable =['contractura', 'retraccion', 'gatillo', 'goniometria', 'balance_muscular', 'mensuras', 'perimetros', 'consulta_id'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
