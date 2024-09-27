<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
        $consulta = Consulta::findOrFail($consultaId);
        
        $data = [
            'paciente' => $consulta->paciente->nombre,
            'edad' => $consulta->paciente->edad,
            'genero' => $consulta->paciente->genero,
            'fecha' => now()->format('d/m/Y'),
            'diagnostico' => $consulta->diagnostico,
            'analisis' => 'Análisis cinético funcional del paciente...',
            'recomendaciones' => 'Recomendaciones específicas...'
        ];

        $pdf = Pdf::loadView('doctor.reporte.pdf', $data);
        return $pdf->stream(); 
        //return $pdf->download('reporte.pdf');
    }
}
