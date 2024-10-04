<div>
    <form wire:submit="save">
        @csrf
        <div class="form-group">
            <label for="consulta_id">Consulta</label>
            <select name="consulta_id" class="form-control" required>
                @foreach($consultas as $consulta)
                    <option value="{{ $consulta->id }}">{{ $consulta->id }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="dias">Días de la Semana</label>
            <select name="dias[]" class="form-control" multiple required>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miércoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sábado">Sábado</option>
                <option value="domingo">Domingo</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="hora_inicio">Hora de Inicio</label>
            <input type="time" name="hora_inicio" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="hora_fin">Hora de Fin</label>
            <input type="time" name="hora_fin" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Programar Horarios</button>
    </form>
    

</div>
