@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    @php
                        $id = request()->query('id');
                    @endphp
                    @livewire('consulta-create', ['consultaId' => $id])
                </div>
            </div>
        </div>
    </x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop

