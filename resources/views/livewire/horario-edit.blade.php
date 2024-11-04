<div class="container my-5">
    <h3 class="text-center mb-4">Modificar Sesiones Programadas</h3>

    @if (session()->has('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif

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
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Modificar Fecha para {{ ucfirst($selectedHorario->dia) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nuevaFecha">Nueva Fecha</label>
                            <input type="date" wire:model="nuevaFecha" class="form-control" required>
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
