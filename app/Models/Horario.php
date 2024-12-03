<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['consulta_id','dia','hora_inicio','hora_fin','fecha_inicio','fecha_fin','sesiones'];
    
    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function sesiones()
        {
            return $this->hasMany(Sesion::class, 'consulta_id', 'consulta_id');
        }
     
        public function calcularEstado()
        {
            // Traducción de los días al formato esperado por DAYNAME
            $dias = [
                'Lunes' => 'Monday',
                'Martes' => 'Tuesday',
                'Miércoles' => 'Wednesday',
                'Jueves' => 'Thursday',
                'Viernes' => 'Friday',
                'Sábado' => 'Saturday',
                'Domingo' => 'Sunday',
            ];
            $diaSemana = $dias[$this->dia] ?? null;
        
            // Si el día no es válido, devolver un estado predeterminado
            if (!$diaSemana) {
                return 'Error: Día no válido';
            }
        
            // Contar las sesiones realizadas
            $sesionesRealizadas = $this->sesiones()
                ->where('fecha', '>=', $this->fecha_inicio)
                ->when($this->fecha_fin, function ($query) {
                    $query->where('fecha', '<=', $this->fecha_fin);
                })
                ->whereRaw("DAYNAME(fecha) = ?", [$diaSemana])
                ->count(); // Este debe devolver un número entero
        
            // Asegurar que $this->sesiones sea un entero
            $sesionesEsperadas = is_numeric($this->sesiones) ? (int) $this->sesiones : 0;
        
            // Realizar la comparación
            return $sesionesRealizadas < $sesionesEsperadas ? 'Pendiente' : 'Completo';
        }
            
}
