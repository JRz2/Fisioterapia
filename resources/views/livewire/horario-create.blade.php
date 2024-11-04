<div x-data="{ diasSeleccionados: @entangle('dias') }" class="p-4 border rounded shadow-lg bg-light">
    <form wire:submit.prevent="save">
        @csrf

        <div class="form-group mb-4 row">
            <div class="col-md-6">
                <label for="numero_sesiones" class="font-weight-bold">Número de Sesiones</label>
                <input type="number" wire:model.defer="sesiones" id="numero_sesiones" class="form-control" required min="1" max="100">
            </div>
            <div class="col-md-6">
                <label for="fecha_inicio" class="font-weight-bold">Fecha de Inicio</label>
                <input type="date" wire:model.defer="fecha_inicio" required class="form-control">
            </div>
        </div>

        <!-- Días de la Semana -->
        <div class="form-group mb-4">
            <label for="dias" class="font-weight-bold">Días de la Semana</label>
            <div class="d-flex flex-wrap mb-2">
                @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $dia)
                    <div class="form-check mr-4 mb-2" style="position: relative;">
                        <input type="checkbox" value="{{ $dia }}" id="{{ $dia }}" wire:model="dias" class="form-check-input" style="cursor: pointer;">
                        <label for="{{ $dia }}" class="form-check-label" style="cursor: pointer; font-size: 1.1rem; padding-left: 30px;">
                            {{ ucfirst($dia) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Campos de horario para los días seleccionados -->
        @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $dia)
            <div x-show="diasSeleccionados.includes('{{ $dia }}')" x-cloak class="mb-4">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="hora_inicio_{{ $dia }}" class="font-weight-bold">Hora de Inicio para {{ ucfirst($dia) }}</label>
                        <input type="time" wire:model.defer="horarios.{{ $dia }}.hora_inicio" id="hora_inicio_{{ $dia }}" class="form-control" :required="diasSeleccionados.includes('{{ $dia }}')">
                    </div>
                    <div class="col-md-6">
                        <label for="hora_fin_{{ $dia }}" class="font-weight-bold">Hora de Fin para {{ ucfirst($dia) }}</label>
                        <input type="time" wire:model.defer="horarios.{{ $dia }}.hora_fin" id="hora_fin_{{ $dia }}" class="form-control" :required="diasSeleccionados.includes('{{ $dia }}')">
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4 text-center">
            <x-button type="submit" class="btn btn-primary">
                Programar Horarios
            </x-button>
        </div>
    </form>
</div>

