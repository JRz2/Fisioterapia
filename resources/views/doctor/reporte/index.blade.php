@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Informes</h1>
@stop

@section('content')
    <x-app-layout>
        @livewire('reporte-datatable')
    </x-app-layout>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop