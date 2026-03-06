@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')

@section('content')
<x-app-layout>
    <div class="modern-card-header px-4 py-4">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #38a169 0%, #2f855a 100%); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white p-3 me-3 shadow" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-users fa-2x" style="color: #38a169;"></i>
                            </div>
                            <div>
                                <h1 class="text-white mb-1" style="font-weight: 600;">Gestión de Pacientes</h1>
                                <p class="text-white-50 mb-0">Administra la información de todos tus pacientes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="card card-dark">
        <div class="card-body">
             @if (Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('mensaje') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                </div>
            @endif

            <div class="row">
                @livewire('create-paciente')
            </div>
            <div class="row pt-4">
                <div class="col-md-12">
                    <span wire:loading.table class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    @livewire('Paciente-datatable')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">       
@endsection

@section('js')
@endsection
