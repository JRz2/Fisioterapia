<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Hand;

class HandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hands = Hand::all();
        return view('doctor.hand.index', compact('hands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($sesion)
    {
        return view('doctor.hand.create', compact('sesion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sesion_id = 1;
        $data = $request->validate([
            'postura_inicial' => 'required|string',
            'postura_final' => 'required|string',
        ]);
    
        $data['postura_inicial'] = json_decode($data['postura_inicial'], true);
        $data['postura_final'] = json_decode($data['postura_final'], true);
    
        Hand::create([
            'sesion_id' => $sesion_id,
            'postura_inicial' => json_encode($data['postura_inicial']),
            'postura_final' => json_encode($data['postura_final']),
        ]);
            
        return redirect()->route('doctor.hand.create')->with('success', 'Sesión guardada exitosamente.');
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
