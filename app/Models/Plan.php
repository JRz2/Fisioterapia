<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['plan', 'consulta_id'];

    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }
}
