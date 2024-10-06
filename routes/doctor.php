<?php

use App\Http\Controllers\Doctor\ConsultaController;
use App\Http\Controllers\Doctor\HorarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\PacienteController;
use App\Http\Controllers\Doctor\ReporteController;
use App\Http\Controllers\Doctor\PruebaController;
use App\Http\Controllers\Doctor\SesionController;

Route::resource('pacientes', PacienteController::class)->names('doctor.paciente'); 
Route::resource('consultas', ConsultaController::class)->names('doctor.consulta'); 
Route::resource('sesions', SesionController::class)->names('doctor.sesion'); 
Route::resource('pruebas', PruebaController::class)->names('doctor.prueba'); 
Route::resource('horarios', HorarioController::class)->names('doctor.horario'); 
Route::resource('models', PruebaController::class)->names('doctor.model'); 
Route::resource('reportes', ReporteController::class)
    ->except(['create'])
    ->names('doctor.reporte');
Route::get('reportes/create/{consulta}', [ReporteController::class, 'create'])->name('doctor.reporte.create');
Route::get('/reporte/pdf/{id}', [ReporteController::class, 'pdf']);
