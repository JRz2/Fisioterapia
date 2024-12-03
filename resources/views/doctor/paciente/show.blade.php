@extends('adminlte::page')

@section('title', 'Historia Clínica')

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
                            <h1 style="font-size: 30px;"> HISTORIA CLÍNICA </h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-md-5">
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
                                            <img src="{{ asset($paciente->imagen) }}" class="rounded-full"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('storage/app/public/' . $paciente->imagen) }}" class="rounded-full"
                                                style="width: 200px; height: 200px; object-fit: cover;">
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
                                            Edad: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->edad }}</span>
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

                    <div class="col-md-7">
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
                    <div class="col-md-5">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Signos Vitales</h3>
                            </div>
                            <div class="card-body">
                                <div class="w-full flex flex-col items-center">
                                    <div class="my-4 mt-4">
                                        <x-label class="text-lg">
                                            últimos Signos Vitales
                                        </x-label>

                                        @if ($ultimaAntropometria)
                                            <div class="my-4">
                                                <div class="row">
                                                    <div>
                                                        <img src="{{ asset('image/regla.png') }}"
                                                            class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Altura
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input class="form-control"
                                                            value="{{ $ultimaAntropometria->talla }}" disabled>
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
                                                        <img src="{{ asset('image/balanza.png') }}"
                                                            class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            Peso
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input class="form-control"
                                                            value="{{ $ultimaAntropometria->peso }}" disabled>
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
                                                        <img src="{{ asset('image/imc.png') }}"
                                                            class="w-30 h-30 rounded-full">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-label>
                                                            IMC
                                                        </x-label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        @php
                                                            $imc = $ultimaAntropometria->imc ?? null;
                                                            $categoriaPeso = null;
                                                            $colorCategoriaPeso = 'secondary';

                                                            if ($imc !== null) {
                                                                if ($imc < 18.5) {
                                                                    $categoriaPeso = 'Bajo';
                                                                    $colorCategoriaPeso = 'warning';
                                                                } elseif ($imc >= 18.5 && $imc <= 24.9) {
                                                                    $categoriaPeso = 'Normal';
                                                                    $colorCategoriaPeso = 'success';
                                                                } elseif ($imc >= 25 && $imc <= 29.9) {
                                                                    $categoriaPeso = 'Sobrepeso';
                                                                    $colorCategoriaPeso = 'primary';
                                                                } else {
                                                                    $categoriaPeso = 'Obeso';
                                                                    $colorCategoriaPeso = 'danger';
                                                                }
                                                            }
                                                        @endphp
                                                        <x-input class="form-control" value="{{ $imc }}" disabled />
                                                    </div>
                                                    <div>
                                                        @if($categoriaPeso)
                                                            <span class="badge bg-{{ $colorCategoriaPeso }}">
                                                                    {{ $categoriaPeso }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">Sin datos de IMC</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-lg my-4">No hay datos de antropometría.
                                            </p>
                                            <div class="my-4">
                                                <div class="row">
                                                    <div>
                                                        <img src="{{ asset('image/regla.png') }}"
                                                            class="w-30 h-30 rounded-full">
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
                                                        <img src="{{ asset('image/balanza.png') }}"
                                                            class="w-30 h-30 rounded-full">
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
                                                        <img src="{{ asset('image/imc.png') }}"
                                                            class="w-30 h-30 rounded-full">
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <x-label class="text-lg">
                                Sesiones Agendadas
                            </x-label>
                        </div>
                        <div>
                            @livewire('horario-show')
                            @livewire('horario-datatable', ['pacienteId' => $paciente->id])
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
