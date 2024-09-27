<a class="btn btn-outline-info" data-toggle="modal" data-target="#editModal{{$permiso->id}}" href="{{route('admin.permiso.edit', $permiso)}}"><i class="fa fa-pen"></i></a> 

  <div class="modal fade" id="editModal{{$permiso->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::model($permiso,['route'=> ['admin.permiso.update', $permiso], 'method'=>'put', 'class'=>'editar']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre de Permiso')!!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'required']) !!} 
            </div>                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Actualizar Permiso', ['class'=> 'btn btn-primary', 'id'=>'actualizar']) !!} 
        </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>