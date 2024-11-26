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
                        <h1><i class="fas fa-user-plus"></i></h1>
                    </td>
                    <td align="center">
                        <h1 style="font-size: 30px;"> USUARIOS </h1>
                    </td>
                </tr>
            </table>
        </div>
    
        <div class="card-body">
            @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                @livewire('user-create')
            </div>

            <div class="row pt-4">
                <div class="col-md-12">
                    <span wire:loading.table class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    @livewire('User-datatable')
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')

@stop