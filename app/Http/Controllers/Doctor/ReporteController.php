<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Reporte;
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
        return view('doctor.reporte.index');
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

        Reporte::create([
            'consulta_id' => $request->consulta_id,
            'fecha' => $request->fecha,
            'diagnostico' => $request->diagnostico,
            'informe' => $request->informe,
            'rehabilitacion' => $request->rehabilitacion,
            'recomendacion' => $request->recomendacion,
            'nota' => $request->nota,
        ]);
        $id = Consulta::find($request->consulta_id);
        /*$this->dispatch('swal:success', [
            'title' => 'Informe',
            'text' => 'Creado Correctamente',
        ]);*/
        return redirect()->route('doctor.consulta.show', ['consulta' => $id]);
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

    public function pdf($id)
    {   

        App::setLocale('es');
        $reporte = Reporte::find($id);
        $data = [
            'nombre' => $reporte->consulta->paciente->nombre,
            'paterno' => $reporte->consulta->paciente->paterno,
            'materno' => $reporte->consulta->paciente->materno,
            'ci' => $reporte->consulta->paciente->ci,
            'edad' => $reporte->consulta->paciente->edad,
            'genero' => $reporte->consulta->paciente->genero,
            'diagnostico' => $reporte->consulta->diagnostico->diagnostico ?? 'Sin diagnostico',
            'dx' => $reporte->diagnostico ?? 'Sin diagnostico',
            'informe' => $reporte->informe ?? 'Sin analisis',
            'rehabilitacion' => $reporte->rehabilitacion ?? 'Sin rehabilitacion',
            'recomendacion' => $reporte->recomendacion ?? 'Sin recomendaciones',
            'nota' => $reporte->nota ?? 'Sin nota',
            'fecha' => Carbon::parse($reporte->reporte->fecha ?? '')
                ->locale('es')
                ->translatedFormat('d \d\e F \d\e Y'),
        ];
        $pdf = Pdf::loadView('doctor.reporte.pdf', $data);
        return $pdf->stream(); 
        //return $pdf->download('reporte.pdf');
    }
}
