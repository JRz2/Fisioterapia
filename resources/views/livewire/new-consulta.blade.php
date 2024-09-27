<div>
    <x-button wire:click="create"> 
            <i class="fas fa-solid fa-stethoscope fa-2x"></i>
            Nueva
            Consulta
    </x-button> 

    <div>
        <form wire:submit="save">
            <x-dialog-modal wire:model="opencreate">
                <x-slot name="title">
                    <label style="margin-top: 15px"> NUEVA CONSULTA </label>
                </x-slot>

                <x-slot name="content">
                    <div class="bg-white shadow rounder">
                        <div style="display: flex; justify-content: space-around"  >
                            <div>
                                <x-label>
                                    Nombre
                                </x-label>
                                <x-input value="{{$paciente->nombre}}" disabled> </x-imput>

                                <x-label>
                                 Apellidos
                                </x-label>
                                <x-input value="{{$paciente->paterno}} {{$paciente->materno}}" disabled> </x-imput>
                            </div>

                            <div> 
                                <x-input wire:model="paciente_id" type="text" hidden></x-input>
                                <x-label>
                                    Fecha
                                </x-label>
                                <x-input wire:model="fecha" type="date" required></x-input>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <div style="display:flex; justify-content: flex-end; margin-right: 10%">
                        <div>
                            <x-danger-button x-on:click="show = false"> 
                                Cancelar 
                            </x-danger-button>

                            <x-button> 
                                Guardar
                            </x-button>
                        </div>
                    </div>
                </x-slot>
            </x-dialog-modal>  
        </form>      
    </div>
</div>
