@extends('adminlte::page')

@section('title', 'Consultas')

@section('content_header')
@stop

@section('content')
<x-app-layout>
    <div class="modern-card-header px-4 py-4">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white p-3 me-3 shadow" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-notes-medical fa-2x" style="color: #667eea;"></i>
                            </div>
                            <div>
                                <h1 class="text-white mb-1" style="font-weight: 600;">Consultas Médicas</h1>
                                <p class="text-white-50 mb-0">Gestiona todas las consultas de tus pacientes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('create-consulta')
    <br>
    <div class="card card-body">
        <div class="border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 15px;">
            <div class="rounded-circle bg-white p-3 me-3 shadow-sm">
                <i class="fas fa-calendar-check fa-2x text-success"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-1 text-success fw-bold">Consultas de Hoy</h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar-alt me-2 text-success"></i>{{ now()->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-12">
                <span wire:loading.table class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                @livewire('Consultahoy-datatable')
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 15px;">
            <div class="rounded-circle bg-white p-3 me-3 shadow-sm">
                <i class="fas fa-calendar-check fa-2x text-success"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-1 text-success fw-bold">Todas las Consultas</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-12">
                <span wire:loading.table class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                @livewire('Consultall-datatable')
            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')

@stop