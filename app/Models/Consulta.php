<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable =['codigo', 'fecha', 'paciente_id'];


    //relacion muchos a uno 
    
    public function paciente(){
        return $this-> belongsTo(Paciente::class);
        }
    
    //relacion uno a muchos
    
    public function sesion(){
        return $this->hasMany(Sesion::class);
    }  
    
    public function anammesis(){
        return $this->hasOne(Anamnesis::class);
    }  

    public function antropometria(){
        return $this->hasOne(Antropometria::class);
    }  
    public function evaluacion(){
        return $this->hasOne(Evaluacion::class);
    }  
    public function examen(){
        return $this->hasOne(Examen::class);
    }  
    public function inspecion(){
        return $this->hasOne(Inspeccion::class);
    }  
    public function movilizaOne(){
        return $this->hasMany(Movilizacion::class);
    }  
    public function signo(){
        return $this->hasOne(Signo::class);
    }  

    public function diagnostico()
    {
        return $this->hasOne(Diagnostico::class);
    }
    
    public function plan(){
        return $this->hasOne(Plan::class);
    }  

    public function reporte(){
        return $this->hasOne(Reporte::class);
    }  

}
