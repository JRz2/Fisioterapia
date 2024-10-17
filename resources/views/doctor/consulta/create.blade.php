@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
    </br>
        <div>
            @php
                $id = request()->query('id');
            @endphp
            @livewire('consulta-create', ['consultaId' => $id])
        </div>
    </x-app-layout>
@stop

@section('css')

@stop

@section('js')

@stop
