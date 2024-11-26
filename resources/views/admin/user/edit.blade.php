@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
@stop

@section('content')
<x-app-layout>
    </br>
    <div class="card card-dark">
        <div class="card-header">
            <table width=100%>
                <tr>
                    <td align="left" width=5%>
                        <h1><a class="mr-5 " href="{{ route('admin.user.index') }}">
                                <i class="fas fa-solid fa-reply-all fa-2x"></i>
                            </a></h1>
                    </td>
                    <td align="center">
                        <h1 style="font-size: 30px;"> ASIGNAR ROL</h1>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body p-6 bg-white rounded-lg shadow-md">
            {!! Form::model($user, ['route' => ['admin.user.update', $user], 'method' => 'put']) !!}
            
            <!-- Nombre del Usuario -->
            <div class="mb-4">
                {!! Form::label('name', 'Nombre del Usuario', ['class' => 'block text-gray-700 font-semibold mb-2']) !!}
                {!! Form::text('name', null, [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white', 
                    'required', 
                    'disabled'
                ]) !!}
            </div>
        
            <!-- Email del Usuario -->
            <div class="mb-6">
                {!! Form::label('email', 'Email', ['class' => 'block text-gray-700 font-semibold mb-2']) !!}
                {!! Form::text('email', null, [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white', 
                    'required', 
                    'disabled'
                ]) !!}
            </div>
        
            <!-- Listado de Roles -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Listado de Roles</h2>
            <div class="space-y-3">
                @foreach ($roles as $role)
                    <div class="flex items-center bg-gray-50 border border-gray-200 p-3 rounded-md">
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'form-checkbox text-blue-500 mr-2']) !!}
                        <label class="text-gray-600">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
        
            <!-- Botón de Asignar Rol -->
            <div class="mt-6 text-center">
                {!! Form::submit('Asignar Rol', [
                    'class' => 'bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow-md hover:shadow-lg transition duration-150 ease-in-out', 
                    'id' => 'actualizar'
                ]) !!}
            </div>
        
            {!! Form::close() !!}
        </div>
        
    </div>
</x-app-layout>
@stop

@section('css')
@stop

@section('js')
@stop