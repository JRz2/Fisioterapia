<div class="form-group">
    <label for="exampleFormControlInput1">Nombre del rol</label>
    <input type="text" class="form-control" name="name" value="{{ isset($role->name)? $role->name:old('name') }}" id="name" required>
</div>

<table class="table table-striped" id="empleado">

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
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$id}}">
                </div>
            </td>
            <td>
                {{$permission}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script>
    $('#empleado').DataTable({
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar " +
                `<select class="custom-selec custom-select-sm form-control form-control-sm">
                                        <option value = '5'>5</option>                        
                                        <option value = '10'>10</option>
                                        <option value = '25'>25</option>
                                        <option value = '50'>50</option>
                                        <option value = '100'>100</option>
                                        <option value = '-1'>Todos</option>
                                    </select>` +
                " registros por pagina",
            "zeroRecords": "Nada encontrado - Disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
</script>
@endsection