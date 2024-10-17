@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Hola Jhon que haciendo ya estoy en tu proyecto</h1>
@stop

@section('content')
<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div>
               <div class="sketchfab-embed-wrapper"> <iframe title="esqueleto" frameborder="0" allowfullscreen mozallowfullscreen="false" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/02bde1815907400ca30b0b2b56b922d9/embed"> </iframe> </div>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop