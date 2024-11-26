@extends('adminlte::page')
@section('title', 'Roles')

@section('content_header')
    <h1>Actualizar Roles</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($role,['route'=> ['admin.rol.update', $role], 'method'=>'put', 'class'=>'editar']) !!}
  
            <div class="form-group">
                {!! Form::label('name', 'Nombre del Rol')!!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'required']) !!}
            </div>              
            <h3>Listado de Permisos</h3>
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Nombre</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($permissions as $id => $permission)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$id}}" {{$role->permissions->contains($id) ? 'checked' : ''}}>
                            </div>
                        </td>
                        <td>
                            {{$permission}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {!! Form::submit('Actualizar Rol', ['class'=> 'btn btn-primary', 'id'=>'actualizar']) !!} 
        {!! Form::close() !!} 
    </div>

@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop