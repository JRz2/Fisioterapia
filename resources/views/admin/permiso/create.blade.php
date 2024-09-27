<a class="btn btn-success" data-toggle="modal" data-target="#editModal" href="{{route('admin.permiso.create')}}"> <i class="fa fa-clipboard"></i> AGREGAR PERMISO</a> 
  <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Permiso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route'=> 'admin.permiso.store']) !!}    
            <div class="form-group">
                {!! Form::label('name', 'Nombre del Permiso')!!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'required']) !!} 
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Guardar Permiso', ['class'=> 'btn btn-primary', 'id'=>'agregar']) !!} 
        </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>