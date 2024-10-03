@extends('adminlte::page')

@section('title', 'Dashboard')

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
                        <h1><i class="fas fa-folder"></i></h1>
                    </td>
                    <td align="center">
                        <h1 style="font-size: 30px;"> SESIONES </h1>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <h2 class="text-secondary" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Sesiones de Hoy</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Consulta</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($sesionesHoy->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No hay consultas para hoy.</td>
                </tr>
            @else
                @foreach ($sesionesHoy as $sesion)
                <tr>
                    <td>{{ $sesion->id }}</td>
                    <td>{{ $sesion->codigo }}</td>
                    <td>{{ $sesion->consulta->codigo }}</td>
                    <td>{{ $sesion->created_at }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" 
                        >
                            <i class="fa fa-eye"></i> Ver
                        </a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <h2 class="text-secondary" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Todas las Sesiones</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Consulta</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sesiones as $sesion)
            <tr>
                <td>{{ $sesion->id }}</td>
                <td>{{ $sesion->codigo }}</td>
                <td>{{ $sesion->consulta->codigo }}</td>
                <td>{{ $sesion->created_at }}</td>
                <td>
                    <a class="btn btn-info btn-sm" 
                    >
                        <i class="fa fa-eye"></i> Ver
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')
@stop