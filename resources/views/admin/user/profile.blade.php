@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="row flex justify-center space-x-8">
            <div class="w-1/4">
                <div class="card card-outline card-primary shadow-lg rounded-lg">
                    <div class="card-body flex flex-col items-center text-center p-4">
                        @if (strpos($user->imagen, 'image/') !== false)
                            <img src="{{ asset($user->imagen) }}" class="rounded-full w-40 h-40 object-cover mb-4">
                        @else
                            <img src="{{ asset('storage/' . $user->imagen) }}"
                                class="rounded-full w-40 h-40 object-cover mb-4">
                        @endif
                        <div>
                            <label class="text-lg font-semibold text-gray-800">{{ $user->name }}</label>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">{{ $user->email }}</label>
                        </div>
                    </div>
                    <div class="card-footer flex justify-center">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Editar</button>
                    </div>
                </div>
            </div>

        </div>

        <div>

        </div>

    </x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')
@stop   
