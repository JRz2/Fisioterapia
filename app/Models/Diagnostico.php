<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $fillable = ['diagnostico','plan', 'consulta_id'];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
