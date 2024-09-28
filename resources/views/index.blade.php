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
               <div class="sketchfab-embed-wrapper"> <iframe title="esqueleto" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/02bde1815907400ca30b0b2b56b922d9/embed"> </iframe> <p style="font-size: 50px; font-weight: normal; margin: 5px; color: #4A4A4A;"> <a href="https://sketchfab.com/3d-models/esqueleto-02bde1815907400ca30b0b2b56b922d9?utm_medium=embed&utm_campaign=share-popup&utm_content=02bde1815907400ca30b0b2b56b922d9" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> esqueleto </a> by <a href="https://sketchfab.com/Model3dh?utm_medium=embed&utm_campaign=share-popup&utm_content=02bde1815907400ca30b0b2b56b922d9" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> Model3dh </a> on <a href="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=02bde1815907400ca30b0b2b56b922d9" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a></p></div>
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
    <script> console.log('Hi!'); </script>
@stop