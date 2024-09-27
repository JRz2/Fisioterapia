@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content')
    <div class="card">
        <div class="card-secondary mb-3" style="max-width: 25rem;" >
            <div class="card-header">
                <table width=100%>
                    <tr>
                        <td align="left" width=5%>
                            <h2><i class="fas fa-user"></i></h2>
                        </td>
                        <td align="center">
                            <h2> NUEVO USUARIO</h2>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
<div class="card-body">
    {!! Form::open(['route'=> 'admin.user.store']) !!}
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="formGroupExampleInput">Nombre Completo</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="name" required>
                @error('name')
                <span class="text-danger">{{$message}} </span>     
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Correo electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                <small id="emailHelp" class="form-text text-muted">El correo debe contener @, numeros y caracteres</small>
                @error('email')
                <span class="text-danger">{{$message}} </span>     
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                @if($errors->has('password'))
                <span class="error texr-danger" for="input-password">{{$errors->first('password')}}</span>
                @endif
            </div>
            
            <div class="form-group">
                <table class="table table-striped">
                    <tbody>
                        @foreach($roles as $id=>$role)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{$id}}">
                                </div>
                            </td>
                            <td>
                                {{$role}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::submit('Guardar Nota', ['class'=> 'btn btn-primary', 'id'=>'agregar']) !!}
    {!! Form::close() !!}

</div>
@stop