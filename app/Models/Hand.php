<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hand extends Model
{
    use HasFactory;

    protected $fillable =['postura_inicial','postura_final','sesion_id'];

    protected $casts = [
        'posture_initial' => 'array',
        'posture_final' => 'array',
    ];
}
