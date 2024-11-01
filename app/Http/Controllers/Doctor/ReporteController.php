<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ReporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:doctor.reporte.index')->only('index');
        $this->middleware('can:doctor.reporte.create')->only('create','store');
        $this->middleware('can:doctor.reporte.edit')->only('edit','update');
        $this->middleware('can:doctor.reporte.destroy')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($consultaId)
    {
        $consulta = Consulta::findOrFail($consultaId);
        return view('doctor.reporte.create', compact('consulta'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pdf($consultaId)
    {   
        App::setLocale('es');
        $consulta = Consulta::findOrFail($consultaId);
        
        $data = [
            'nombre' => $consulta->paciente->nombre,
            'paterno' => $consulta->paciente->paterno,
            'materno' => $consulta->paciente->materno,
            'ci' => $consulta->paciente->ci,
            'edad' => $consulta->paciente->edad,
            'genero' => $consulta->paciente->genero,
            'diagnostico' => $consulta->diagnostico->diagnostico ?? 'Sin diagnostico',
            'informe' => $consulta->reporte->informe ?? 'Sin analisis',
            'rehabilitacion' => $consulta->reporte->rehabilitacion ?? 'Sin rehabilitacion',
            'recomendacion' => $consulta->reporte->recomendacion ?? 'Sin recomendaciones',
            'nota' => $consulta->reporte->nota ?? 'Sin nota',
            'fecha' => Carbon::parse($consulta->reporte->fecha ?? '')
                ->locale('es')
                ->translatedFormat('d \d\e F \d\e Y'),
        ];
        $pdf = Pdf::loadView('doctor.reporte.pdf', $data);
        return $pdf->stream(); 

        
        //return $pdf->download('reporte.pdf');
    }
}
