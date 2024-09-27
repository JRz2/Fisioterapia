@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($user,['route'=> ['admin.user.update', $user], 'method'=>'put']) !!}
  
            <div class="form-group">
                {!! Form::label('name', 'Nombre del Usuario')!!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'required', 'disabled']) !!} 
            </div> 
            <div class="form-group">
              {!! Form::label('email', 'Email')!!}           
              {!! Form::text('email', null, ['class'=> 'form-control', 'required', 'disabled']) !!}  
            </div>  
            
            <h2>Listado de Roles</h2>
            @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => ',mr-1']) !!}
                    {{$role->name}}
                </label>
            </div>
            @endforeach
        </div>
        {!! Form::submit('Asignar Rol', ['class'=> 'btn btn-primary', 'id'=>'actualizar']) !!} 
        {!! Form::close() !!} 
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop