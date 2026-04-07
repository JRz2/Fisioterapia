<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $fillable =['fecha','codigo','sintoma', 'observacion', 'recomendacion', 'tratamiento','postura_inicial','postura_final','rango','consulta_id', 'ruta', 'datos_biomecanicos'];

    protected $casts = [
        'datos_biomecanicos' => 'array',
        'fecha' => 'date',
        'posture_initial' => 'array',
        'posture_final' => 'array',
        'range_of_motion' => 'array',
    ];
    
public function getBiomecanicosFormateadosAttribute()
{
    $datos = $this->datos_biomecanicos;
    if (!$datos) return null;
    
    return [
        // ===== RODILLAS =====
        'rodilla_derecha_flexion' => isset($datos['rodilla']['derecha']['flexion']) ? floatval($datos['rodilla']['derecha']['flexion']) : null,
        'rodilla_derecha_extension' => isset($datos['rodilla']['derecha']['extension']) ? floatval($datos['rodilla']['derecha']['extension']) : null,
        'rodilla_izquierda_flexion' => isset($datos['rodilla']['izquierda']['flexion']) ? floatval($datos['rodilla']['izquierda']['flexion']) : null,
        'rodilla_izquierda_extension' => isset($datos['rodilla']['izquierda']['extension']) ? floatval($datos['rodilla']['izquierda']['extension']) : null,
        
        // ===== CADERAS =====
        'cadera_derecha_flexion' => isset($datos['cadera']['derecha']['flexion']) ? floatval($datos['cadera']['derecha']['flexion']) : null,
        'cadera_derecha_extension' => isset($datos['cadera']['derecha']['extension']) ? floatval($datos['cadera']['derecha']['extension']) : null,
        'cadera_izquierda_flexion' => isset($datos['cadera']['izquierda']['flexion']) ? floatval($datos['cadera']['izquierda']['flexion']) : null,
        'cadera_izquierda_extension' => isset($datos['cadera']['izquierda']['extension']) ? floatval($datos['cadera']['izquierda']['extension']) : null,
        
        // ===== HOMBROS =====
        'hombro_derecho_flexion' => isset($datos['hombro']['derecha']['flexion']) ? floatval($datos['hombro']['derecha']['flexion']) : null,
        'hombro_derecho_extension' => isset($datos['hombro']['derecha']['extension']) ? floatval($datos['hombro']['derecha']['extension']) : null,
        'hombro_izquierdo_flexion' => isset($datos['hombro']['izquierda']['flexion']) ? floatval($datos['hombro']['izquierda']['flexion']) : null,
        'hombro_izquierdo_extension' => isset($datos['hombro']['izquierda']['extension']) ? floatval($datos['hombro']['izquierda']['extension']) : null,
        
        // ===== CODOS =====
        'codo_derecho_flexion' => isset($datos['codo']['derecha']['flexion']) ? floatval($datos['codo']['derecha']['flexion']) : null,
        'codo_izquierdo_flexion' => isset($datos['codo']['izquierda']['flexion']) ? floatval($datos['codo']['izquierda']['flexion']) : null,
        
        // ===== RANGO NORMAL =====
        'rango_normal_rodilla' => 140,
        'rango_normal_cadera' => 120,
        'rango_normal_hombro' => 180,
    ];
}

// Obtener solo las mediciones de rodilla (para gráficas)
public function getEvolucionRodillaAttribute()
{
    $datos = $this->datos_biomecanicos;
    if (!$datos) return null;
    
    return [
        'derecha' => $datos['rodilla']['derecha']['flexion'] ?? null,
        'izquierda' => $datos['rodilla']['izquierda']['flexion'] ?? null,
    ];
}

// Obtener resumen para mostrar en tarjetas
public function getResumenBiomecanicoAttribute()
{
    $datos = $this->datos_biomecanicos;
    if (!$datos) return 'Sin mediciones';
    
    $mediciones = [];
    
    if (isset($datos['rodilla']['derecha']['flexion'])) {
        $mediciones[] = "Rodilla D: {$datos['rodilla']['derecha']['flexion']}°";
    }
    if (isset($datos['rodilla']['izquierda']['flexion'])) {
        $mediciones[] = "Rodilla I: {$datos['rodilla']['izquierda']['flexion']}°";
    }
    if (isset($datos['hombro']['derecha']['flexion'])) {
        $mediciones[] = "Hombro D: {$datos['hombro']['derecha']['flexion']}°";
    }
    
    return implode(' | ', $mediciones);
}

// Verificar si hay datos biomecánicos
public function getTieneBiomecanicosAttribute()
{
    $datos = $this->datos_biomecanicos;
    if (!$datos) return false;
    
    // Verificar si al menos hay una medición
    return isset($datos['rodilla']['derecha']['flexion']) ||
           isset($datos['rodilla']['izquierda']['flexion']) ||
           isset($datos['cadera']['derecha']['flexion']) ||
           isset($datos['hombro']['derecha']['flexion']);
}

    public function consulta(){
        return $this-> belongsTo(Consulta::class);
        }

    public function imgsesion()
        {
            return $this->hasMany(Imgsesion::class);
        }
}
