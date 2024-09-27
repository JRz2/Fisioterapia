@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div style="margin: 20px 0 10px 20px">
                        <a class="mr-5 "
                            href="{{route('doctor.paciente.index')}}">
                            <i class="fas fa-solid fa-reply-all fa-2x"></i>
                        </a>
                        Expediente Clinico
                    </div>
                    <div style="display: flex;  gap:4%; margin:30px; height: 500px">
                        <div style="width: 30%">
                            <div>
                                <x-label>
                                    Datos del paciente
                                </x-label>
                                <x-label>
                                    Foto
                                </x-label>
                                <div style="display: flex">
                                    <div style="width: 50%; margin:5px 25px 10px 10px">
                                        @if ($paciente->imagen)
                                            <img src="{{ asset('storage/' .$paciente->imagen) }}">     
                                        @else
                                            <img src="{{ asset('image/user2.jpg') }}" width="100%">
                                        @endif
                                         
                                    </div>

                                    <div style="width: 30%; margin:5px 5px 5px 5px">
                                        <div>
                                            <x-label>
                                                {{ $paciente->nombre }}
                                            </x-label>
                                        </div>

                                        <div>
                                            <x-label>
                                                {{ $paciente->paterno }}
                                            </x-label>
                                        </div>

                                        <div>
                                            <x-label>
                                                {{ $paciente->materno }}
                                            </x-label>
                                        </div>

                                        <div>
                                            <x-label> Edad: 
                                                {{ $paciente->edad }}
                                            </x-label>
                                        </div>

                                        <div>
                                            <x-label> Celular: 
                                                {{ $paciente->celular }}
                                            </x-label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-labeL>
                                    Ultimos Signos Vitales
                                </x-labeL>

                                @if ($ultimaConsulta)
                                    @if ($ultimaConsulta->antropometria)
                                    <div style="margin: 0 5% 0 5%">
                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/regla.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                Altura
                                            </x-label>
                                        </div>
                                        <div>
                                            <x-input style="width: 60px" value="{{$ultimaConsulta->antropometria->talla}}" disabled>
                                            </x-input>Cm
                                        </div>           
                                        </div>

                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/balanza.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                Peso
                                            </x-label>
                                        </div>
                                        <div>
                                            <x-input style="width: 60px" value="{{$ultimaConsulta->antropometria->peso}}" disabled>
                                            </x-input>Kg
                                        </div>   
                                        </div>

                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/imc.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                IMC
                                            </x-label>
                                        </div>    
                                        <div>
                                            <x-input style="width: 60px" value="{{$ultimaConsulta->antropometria->imc}}" disabled>
                                            </x-input>
                                        </div>
                                        </div>
                                    </div>
                                    @else
                                        <p>No hay datos de antropometría para la última consulta.</p>
                                        <div style="margin: 0 5% 0 5%">
                                            <div style="display: flex">
                                            <div style="width: 10%; margin-right: 10px">
                                                <img src="{{ asset('image/regla.png') }}" style="height: 50px">
                                            </div>
                                            <div style="width: 20%">
                                                <x-label>
                                                    Altura
                                                </x-label>
                                            </div>
                                            <div>
                                                <x-input style="width: 50px" disabled>
                                                </x-input>Cm
                                            </div>           
                                            </div>

                                            <div style="display: flex">
                                            <div style="width: 10%; margin-right: 10px">
                                                <img src="{{ asset('image/balanza.png') }}" style="height: 50px">
                                            </div>
                                            <div style="width: 20%">
                                                <x-label>
                                                    Peso
                                                </x-label>
                                            </div>
                                            <div>
                                                <x-input style="width: 50px" disabled>
                                                </x-input>Kg
                                            </div>   
                                            </div>

                                            <div style="display: flex">
                                            <div style="width: 10%; margin-right: 10px">
                                                <img src="{{ asset('image/imc.png') }}" style="height: 50px">
                                            </div>
                                            <div style="width: 20%">
                                                <x-label>
                                                    IMC
                                                </x-label>
                                            </div>    
                                            <div>
                                                <x-input style="width: 50px" disabled>
                                                </x-input>
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <p>No hay consultas registradas para este paciente.</p>
                                    <div style="margin: 0 5% 0 5%">
                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/regla.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                Altura
                                            </x-label>
                                        </div>
                                        <div>
                                            <x-input style="width: 50px" disabled>
                                            </x-input>Cm
                                        </div>           
                                        </div>

                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/balanza.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                Peso
                                            </x-label>
                                        </div>
                                        <div>
                                            <x-input style="width: 50px" disabled>
                                            </x-input>Kg
                                        </div>   
                                        </div>

                                        <div style="display: flex">
                                        <div style="width: 10%; margin-right: 10px">
                                            <img src="{{ asset('image/imc.png') }}" style="height: 50px">
                                        </div>
                                        <div style="width: 20%">
                                            <x-label>
                                                IMC
                                            </x-label>
                                        </div>    
                                        <div>
                                            <x-input style="width: 50px" disabled>
                                            </x-input>
                                        </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div style="width: 40%">
                            <div style="height: 300px">
                                <X-label>
                                    Consultas del paciente
                                </X-label>
                                <div>
                                    @livewire('consulta-datatable', ['pacienteId' => $paciente->id])
                                </div>
                            </div>
                        </div>

                        <div style="width: 20%">
                            <div style="height: 80px">
                                @livewire('new-consulta', ['pacienteId' => $paciente->id])
                            </div> 

                            <div>
                                <x-label>
                                    Consultas Agendadas
                                </x-label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
