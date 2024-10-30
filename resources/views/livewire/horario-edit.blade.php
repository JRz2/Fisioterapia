<div class="container my-5">
    

    <!-- Lista de sesiones programadas -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sesiones Programadas</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($horarios as $horario)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>{{ ucfirst($horario->dia) }}</strong>: {{ \Carbon\Carbon::parse($horario->fecha_inicio)->format('d/m/Y') }}
                            </span>
                            <button wire:click="edit({{ $horario->id }})" class="btn btn-sm btn-warning">Modificar</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Formulario de modificación de la fecha de la sesión -->
    @if ($selectedHorario)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Modificar Fecha para {{ ucfirst($selectedHorario->dia) }}</h5>
                        <button wire:click="cancelEdit" class="btn btn-sm btn-danger">Cancelar</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nuevaFecha">Nueva Fecha</label>
                            <input type="date" wire:model="nuevaFecha" class="form-control" required>
                        </div>

                        <!-- Casilla de verificación -->
                        <div class="form-check mb-3">
                            <input type="checkbox" wire:model="aplicarATodas" class="form-check-input" id="aplicarATodas">
                            <label class="form-check-label" for="aplicarATodas">Aplicar a todas las sesiones de {{ ucfirst($selectedHorario->dia) }}</label>
                        </div>

                        <!-- Selector para seleccionar días específicos -->
                        <div class="form-group mb-3">
                            <label for="diasSeleccionados">Selecciona los días específicos (si no deseas aplicar a todos)</label>
                            <select wire:model="diasSeleccionados" multiple class="form-control" id="diasSeleccionados">
                                @foreach ($diasSimilares as $dia)
                                    <option value="{{ $dia['id'] }}">
                                        {{ \Carbon\Carbon::parse($dia['fecha_inicio'])->format('d/m/Y') }} ({{ ucfirst($dia['dia']) }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Usa Ctrl (Cmd en Mac) para seleccionar múltiples días.</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button wire:click="update" class="btn btn-primary">Actualizar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>