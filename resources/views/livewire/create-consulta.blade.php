<div>
    <div>
        <x-button wire:click="create">
            <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
            &nbsp;&nbsp;<i class="fas fa-solid fa-stethoscope fa-2x"></i>
            &nbsp; Nueva
            Consulta
        </x-button>
    
        <div>
            <form wire:submit.prevent="save">
                <x-dialog-modal wire:model="opencreate">
                    <x-slot name="title">
                        <label style="margin-top: 15px"> NUEVA CONSULTA </label>
                    </x-slot>
                    <x-slot name="content">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-label>Paciente</x-label>
                                        <select class="form-control" wire:model="paciente_id" required>
                                            <option value="">Seleccione un nombre</option>
                                            @foreach($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->paterno }} {{ $paciente->materno }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="col-md-6">
                                        <x-label>Fecha</x-label>
                                        <x-input class="form-control" wire:model="fecha" type="date" required></x-input>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </x-slot>
    
                    <x-slot name="footer">
                        <div>
                            <x-danger-button class="pr-4" x-on:click="show = false">
                                Cancelar
                            </x-danger-button>
    
                            <x-button>
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                                &nbsp; Guardar
                            </x-button>
                        </div> 
                    </x-slot>
                </x-dialog-modal>
            </form>
        </div>
    </div>    
</div>
