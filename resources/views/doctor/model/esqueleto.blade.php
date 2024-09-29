@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Esqueleto Cuerpo Completo</h1>
@stop

@section('content')
    <div>
        <div class="sketchfab-embed-wrapper"> 
            <iframe title="esqueleto" frameborder="0" allowfullscreen mozallowfullscreen="true" 
                webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" 
                xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share width="900" height="500" 
                src="https://sketchfab.com/models/02bde1815907400ca30b0b2b56b922d9/embed"> 
            </iframe> 
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop