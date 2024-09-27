<a class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal{{$user->id}}" href="{{route('admin.user.edit', $user)}}"><i class="fa fa-pen"> </i></a> 
  <div class="modal fade" id="editModal{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::model($user,['route'=> ['admin.user.update', $user], 'method'=>'put', 'class'=>'editar']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre del Usuario')!!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'required']) !!} 
            </div> 
            <div class="form-group">
              {!! Form::label('email', 'Email')!!}           
              {!! Form::text('email', null, ['class'=> 'form-control', 'required']) !!} 
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          {!! Form::submit('Actualizar Usuario', ['class'=> 'btn btn-primary', 'id'=>'actualizar']) !!} 
        </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>