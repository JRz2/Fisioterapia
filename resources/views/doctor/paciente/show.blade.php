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
                <div class="row">
                    <div class="row col-md-5 w-2/4">
                        <div class="w-2/4 flex flex-col items-center">
                            <x-label class="start-0">
                                <h1 class="text-lg">Datos del paciente</h1>
                            </x-label>
                            <x-label class="text-lg">
                                Foto
                            </x-label>
                            <div>
                                @if (strpos($paciente->imagen, 'image/') !== false)
                                    <img src="{{ asset($paciente->imagen) }}" alt="Imagen del paciente" class="w-55 h-55 rounded-full">
                                @else
                                    <img src="{{ asset('storage/' . $paciente->imagen) }}" class="w-55 h-55 rounded-full">
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
                    <div class="col-md-6 mx-3 w-2/4">
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

                        <div class="my-4">
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
@endsection

@section('js')
@endsection
