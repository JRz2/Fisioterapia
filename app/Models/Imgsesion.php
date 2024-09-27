<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgsesion extends Model
{
    use HasFactory;

    protected $fillable =['ruta', 'sesion_id'];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }
}
