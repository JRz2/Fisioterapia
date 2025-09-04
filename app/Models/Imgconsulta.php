<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgconsulta extends Model
{
    use HasFactory;

    protected $fillable =['ruta', 'consulta_id'];

    public function consulta()
    {
        return $this->belongsTo(consulta::class);
    }
}
