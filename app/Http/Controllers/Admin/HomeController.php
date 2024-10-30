<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\Sesion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $npacientes = Paciente::count();
        $nconsultas = Consulta::count();
        $nsesiones = Sesion::count();
        $nhorarios = Horario::count();
        $users = User::all();
        $ultimasConsultas = Consulta::latest()->take(5)->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $consultas = Consulta::whereMonth('fecha', $currentMonth)
                          ->whereYear('fecha', $currentYear)
                          ->select(DB::raw('DATE(fecha) as date'), DB::raw('count(*) as count'))
                          ->groupBy('date')
                          ->orderBy('date')
                          ->get();

        $sesiones = Sesion::whereMonth('fecha', $currentMonth)
                          ->whereYear('fecha', $currentYear)
                          ->select(DB::raw('DATE(fecha) as date'), DB::raw('count(*) as count'))
                          ->groupBy('date')
                          ->orderBy('date')
                          ->get();

        $dias = [];
        $consultasCount = [];
        $sesionesCount = [];

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        foreach (new \DatePeriod($startOfMonth, new \DateInterval('P1D'), $endOfMonth->addDay()) as $date) {
            $dateStr = $date->format('Y-m-d'); 
            $dias[] = $dateStr;
            $consultasCount[] = $consultas->where('date', $dateStr)->pluck('count')->first() ?? 0;
            $sesionesCount[] = $sesiones->where('date', $dateStr)->pluck('count')->first() ?? 0;
        }
        
        $user = Auth::user();
        return view('index', compact('npacientes','nconsultas','nsesiones','dias', 'consultasCount', 'sesionesCount', 'user','users', 'ultimasConsultas', 'nhorarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
}
