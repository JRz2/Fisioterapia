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

                            <div class="flex items-center mt-3">
                                <label for="estado" class="mr-2 font-semibold">Estado:</label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="estado" class="sr-only peer" wire:model="estado">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-2 text-sm font-medium">
                                        {{ $estado ? 'Completado' : 'Pendiente' }}
                                    </span>
                                </label>
                            </div>
                            
                            <label class="inline-flex items-center cursor-pointer">
                                <!-- Switch -->
                                <input type="checkbox" class="sr-only peer" wire:model="estado">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full
                                            peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                                            peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px]
                                            after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
                                            dark:border-gray-600"
                                    :class="{'peer-checked:bg-green-500': @entangle('estado'), 'peer-checked:bg-orange-500': !@entangle('estado')}">
                                </div>
                                <!-- Label -->
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $estado ? 'Completado' : 'Pendiente' }}
                                </span>
                            </label>
                            
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
