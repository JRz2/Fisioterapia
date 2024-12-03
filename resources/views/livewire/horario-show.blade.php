<div>
    <div>
        <form wire:submit="save">
            <x-dialog-modal wire:model="openmodal">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ $openMode ? 'EDITAR SESION' : 'SESION' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Detalles del Horario</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fecha_inicio" class="form-label fw-bold">Fecha de Inicio</label>
                                    <input type="date" id="fecha_inicio" class="form-control" wire:model="fecha_inicio">
                                </div>
                                <div class="col-md-6">
                                    <label for="dia" class="form-label fw-bold">Día</label>
                                    <input type="text" id="dia" class="form-control" wire:model="dia" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="hora_inicio" class="form-label fw-bold">Hora de Inicio</label>
                                    <input type="time" id="hora_inicio" class="form-control" wire:model.defer="hora_inicio" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="hora_fin" class="form-label fw-bold">Hora de Fin</label>
                                    <input type="time" id="hora_fin" class="form-control" wire:model.defer="hora_fin" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot>
                
                <x-slot name="footer">
                    <div>
                        <x-danger-button x-on:click="show = false">
                            Cancelar
                        </x-danger-button>

                        <x-button>
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            <span class="ml-2">{{ $openMode ? 'Actualizar' : 'Cerrar' }} </span>
                        </x-button>
                    </div>
                </x-slot>

            </x-dialog-modal>
        </form>
    </div>
</div>
