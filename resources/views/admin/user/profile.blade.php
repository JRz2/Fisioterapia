@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="row flex justify-center space-x-8">
            @livewire('user-profile', ['userId' => $user->id])
        </div>
    </x-app-layout>
@stop

@section('css')
@stop

@section('js')
@stop   
