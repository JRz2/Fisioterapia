@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Musculos de la Cara</h1>
@stop

@section('content')
    <x-app-layout>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div>
                        <iframe title="musculos" frameborder="0" allowfullscreen mozallowfullscreen="true"
                            webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking"
                            xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share
                            class="w-100" height="500" 
                            src="https://sketchfab.com/models/8c1bcc3685cd40b3bd6b42e0445522a5/embed">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        
    </x-app-layout>
@stop

@section('css')
@stop

@section('js')
@stop