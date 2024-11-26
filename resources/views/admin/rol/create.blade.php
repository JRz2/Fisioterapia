@extends('adminlte::page')
@section('title', 'Roles')

@section('content')
    <div class="card">
        <div class="card-secondary mb-3" style="max-width: 25rem;" >
            <div class="card-header">
                <table width=100%>
                    <tr>
                        <td align="left" width=5%>
                            <h2><i class="fas fa-clipboard"></i></h2>
                        </td>
                        <td align="center">
                            <h2> NUEVO ROL </h2>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
<div class="card-body">
    {!! Form::open(['route'=> 'admin.rol.store']) !!}
    @csrf
    @include('admin.rol.form')
    {!! Form::submit('Guardar Rol', ['class'=> 'btn btn-primary', 'id'=>'agrega']) !!}
    {!! Form::close() !!}

</div>
@stop