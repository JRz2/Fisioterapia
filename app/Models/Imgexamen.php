<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgexamen extends Model
{
    use HasFactory;

    protected $fillable =['ruta', 'examen_id'];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
