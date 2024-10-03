@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Musculos mienbro superior</h1>
@stop

@section('content')
<x-app-layout>
    <div>
        <div class="sketchfab-embed-wrapper"> 
            <iframe title="esqueleto" frameborder="0" allowfullscreen mozallowfullscreen="true" 
                webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" 
                xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share width="900" height="500" 
                src="https://sketchfab.com/models/eb8d791daff54a788673dc99edec377c/embed"> 
            </iframe> 
        </div>
    </div>

    <div>
        <div class="sketchfab-embed-wrapper"> 
            <iframe title="esqueleto" frameborder="0" allowfullscreen mozallowfullscreen="true" 
                webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" 
                xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share width="900" height="500" 
                src="https://sketchfab.com/models/da48e20b474d41efb8567e1454bbf67b/embed"> 
            </iframe> 
        </div>
    </div>

</x-app-layout>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')
@stop