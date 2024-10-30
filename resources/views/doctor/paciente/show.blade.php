@extends('adminlte::page')

@section('title', 'Expediente Clinico')

@section('content_header')

@endsection

@section('content')
    <x-app-layout>
        </br>
        <div class="card card-dark">
            <div class="card-header">
                <table width=100%>
                    <tr>
                        <td align="left" width=5%>
                            <h1><a class="mr-5 " href="{{ route('doctor.paciente.index') }}">
                                    <i class="fas fa-solid fa-reply-all fa-2x"></i>
                                </a></h1>
                        </td>
                        <td align="center">
                            <h1 style="font-size: 30px;"> EXPEDIENTE CLINICO </h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Datos del Paciente</h3>
                            </div>
                            <div class="row card-body">
                                <div class="w-2/4 flex flex-col items-center">
                                    <x-label class="text-lg">
                                        Foto
                                    </x-label>
                                    <div>
                                        @if (strpos($paciente->imagen, 'image/') !== false)
                                            <img src="{{ asset($paciente->imagen) }}" class="rounded-full" style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('storage/' . $paciente->imagen) }}" class="rounded-full" style="width: 200px; height: 200px; object-fit: cover;">
                                        @endif
                                    </div>    
                                </div>
                                <div class="w-2/4 flex flex-col items-center">
                                    <div>
                                        <x-label class="text-base">
                                            Nombre: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->nombre }}</span>
                                        </x-label>
                                    </div>
            
                                    <div>
                                        <x-label class="text-base">
                                            Paterno: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->paterno }}</span>
                                        </x-label>
                                    </div>
            
                                    <div>
                                        <x-label class="text-base">
                                            Materno: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->materno }}</span>
                                        </x-label>
                                    </div>
            
                                    <div>
                                        <x-label class="text-base">
                                            Edad: <span class="badge badge-pill font-normal text-base">{{ $paciente->edad }}</span>
                                        </x-label>
                                    </div>
            
                                    <div>
                                        <x-label class="text-base">
                                            Celular: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->celular }}</span>
                                        </x-label>
                                    </div>
                                </div>
                            </div>  
                            <div class="card-footer">
                            </div>
                        </div>      
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div>
                                <x-label class="text-lg">
                                    Consultas del paciente
                                </x-label>
                            </div>
                            <div class="ml-auto">
                                @livewire('new-consulta', ['pacienteId' => $paciente->id])
                            </div>
                        </div>

                        <div class="mt-4">
                            @livewire('consulta-datatable', ['pacienteId' => $paciente->id])
                        </div>

                       
                    </div>   
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                              <h3 class="card-title">Signos Vitales</h3>
                            </div>
                            <div class="card-body">
                                <div class="w-full flex flex-col items-center">
                                    <div class="my-4 mt-4">
                                        <x-label class="text-lg">
                                            Ultimos Signos Vitales
                                        </x-label>
            
                                        @if ($ultimaConsulta)
                                            @if ($ultimaConsulta->antropometria)
                                                <div class="my-4">
                                                    <div class="row">
                                                        <div>
                                                            <img src="{{ asset('image/regla.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Altura
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" value="{{ $ultimaConsulta->antropometria->talla }}" disabled>
                                                            </x-input>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Cm
                                                            </x-label>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div>
                                                            <img src="{{ asset('image/balanza.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Peso
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" value="{{ $ultimaConsulta->antropometria->peso }}" disabled>
                                                            </x-input>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Kg
                                                            </x-label>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div>
                                                            <img src="{{ asset('image/imc.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                IMC
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" value="{{ $ultimaConsulta->antropometria->imc }}" disabled>
                                                            </x-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-lg my-4">No hay datos de antropometría para la última consulta.</p>
                                                <div class="my-4">
                                                    <div class="row">
                                                        <div>
                                                            <img src="{{ asset('image/regla.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Altura
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" disabled>
                                                            </x-input>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Cm
                                                            </x-label>
                                                        </div>
                                                    </div>
            
            
                                                    <div class="row my-4">
                                                        <div>
                                                            <img src="{{ asset('image/balanza.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Peso
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" disabled>
                                                            </x-input>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                Kg
                                                            </x-label>
                                                        </div>
                                                    </div>
            
                                                    <div class="row my-4">
                                                        <div>
                                                            <img src="{{ asset('image/imc.png') }}" class="w-30 h-30 rounded-full">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-label>
                                                                IMC
                                                            </x-label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-input class="form-control" disabled>
                                                            </x-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <p class="text-lg my-4">No hay consultas registradas para este paciente.</p>
                                            <div class="my-4">
                                                <div class="row">
                                                    <div>
                                                        <img src="{{ asset('image/regla.png') }}" class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Altura
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input class="form-control" disabled>
                                                        </x-input>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Cm
                                                        </x-label>
                                                    </div>
                                                </div>
            
            
                                                <div class="row my-4">
                                                    <div>
                                                        <img src="{{ asset('image/balanza.png') }}" class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Peso
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input class="form-control" disabled>
                                                        </x-input>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Kg
                                                        </x-label>
                                                    </div>
                                                </div>
            
                                                <div class="row my-4">
                                                    <div>
                                                        <img src="{{ asset('image/imc.png') }}" class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            IMC
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input class="form-control" disabled>
                                                        </x-input>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>       
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div>
                            <x-label class="text-lg">
                                Consultas Agendadas
                            </x-label>
                        </div> 
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
