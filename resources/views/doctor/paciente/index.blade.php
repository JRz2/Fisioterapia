@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

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
                        <h1 style="font-size: 30px;"> PACIENTES </h1>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body card-dark">
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            @livewire('create-paciente')
        </div>
        <div class="row pt-4">
            
            <div class="col-md-12">
            <span wire:loading.table class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                @livewire('Paciente-datatable')
            </div>
        </div>
    </div>

</x-app-layout>
@endsection
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.j"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@endsection