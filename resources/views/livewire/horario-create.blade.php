<div>
    <div>
        <div x-data="{ diasSeleccionados: @entangle('dias') }">
            <form wire:submit.prevent="save">
                @csrf
        
                <!-- Checkboxes para los días de la semana -->
                <div class="form-group">
                    <label for="dias">Días de la Semana</label>
                    <div class="checkbox-group">
                        @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $dia)
                            <div class="form-check">
                                <input type="checkbox" value="{{ $dia }}" id="{{ $dia }}" wire:model="dias" class="form-check-input">
                                <label for="{{ $dia }}" class="form-check-label">{{ ucfirst($dia) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
        
                <!-- Campos de horario para los días seleccionados -->
                @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $dia)
                    <div x-show="diasSeleccionados.includes('{{ $dia }}')" x-cloak>
                        <div class="form-group">
                            <label for="hora_inicio_{{ $dia }}">Hora de Inicio para {{ ucfirst($dia) }}</label>
                            <input type="time" wire:model.defer="horarios.{{ $dia }}.hora_inicio" id="hora_inicio_{{ $dia }}" class="form-control" :required="diasSeleccionados.includes('{{ $dia }}')">
                        </div>
        
                        <div class="form-group">
                            <label for="hora_fin_{{ $dia }}">Hora de Fin para {{ ucfirst($dia) }}</label>
                            <input type="time" wire:model.defer="horarios.{{ $dia }}.hora_fin" id="hora_fin_{{ $dia }}" class="form-control" :required="diasSeleccionados.includes('{{ $dia }}')">
                        </div>
                    </div>
                @endforeach
        
                <!-- Otros campos (fechas) -->
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" wire:model.defer="fecha_inicio" class="form-control" required>
                </div>
        
                <button type="submit" class="btn btn-primary">Programar Horarios</button>
            </form>
        </div>
    </div>
    
</div>
