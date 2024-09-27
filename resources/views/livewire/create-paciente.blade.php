<div>
    <x-button wire:click="create">
        Nuevo Paciente
    </x-button> 
    <div>
        <form wire:submit="save">
            <x-dialog-modal wire:model="opencreate">   
                <x-slot name="title">
                    <label style="margin-top: 15px"> NUEVO PACIENTE </label>
                </x-slot>
                <x-slot name="content" >
                    <div class="bg-white shadow rounder">
                        <div style="display: flex; justify-content: space-around"  >
                            <div> 
                                <x-label>
                                    Foto
                                </x-label> 
                                <div style="height: 150px">
                                    {{$imagen}}
                                    @if ($imagen)
                                        <img src="{{$imagen->temporaryUrl()}}" style="height: 150px">     
                                    @else
                                        <img src="{{ asset('image/user.png') }}" style="height: 150px">
                                    @endif
                                </div>

                                    <input wire:model="imagen" wire:key="{{$imagenkey}}" type="file" id="file" style="display: none;">
                                    <label for="file" style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">Seleccionar archivo</label>
                            
                                <x-label>
                                    Ocupacion
                                </x-label>
                                <x-input wire:model="ocupacion"></x-input>
            
                                <x-label>
                                    Deporte
                                </x-label>
                                <x-input wire:model="deporte"></x-input>
                            </div>
                
                            <div>
                                <x-label>
                                    Nombre
                                </x-label>
                                <x-input wire:model="nombre"> </x-imput>
                                <x-input-error for="nombre"></x-input-error>
                                
                                <x-label>
                                 Apellido Paterno
                                </x-label>
                                <x-input wire:model="paterno"> </x-imput>
                                <x-input-error for="paterno"></x-input-error>
                                
                                <x-label>
                                    Apellido Materno
                                </x-label>
                                <x-input wire:model="materno"> </x-imput>
                                    <x-input-error for="materno"></x-input-error>
                                
                                <x-label>
                                    Direccion
                                </x-label>
                                <x-input wire:model="direccion"> </x-imput>
            
                            </div>
                
                            <div>
                                <x-label>
                                    Sexo
                                </x-label>
            
                                <x-select class="w-full" wire:model="genero">
                                    <option value="" disabled> Selecione un genero</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </x-select>
                                <x-input-error for="genero"></x-input-error>
                                 
                                <x-label>
                                    C.I
                                </x-label>
                                <x-input type="number" wire:model.live="ci" style="-moz-appearance: textfield; -webkit-appearance: none"> </x-imput>
                                <x-input-error for="ci"></x-input-error>

                                <x-label>
                                    Edad
                                </x-label>
                                <x-input wire:model="edad"> </x-imput>
                                <x-input-error for="edad"></x-input-error>
                            
                                <x-label>
                                    Celular
                                </x-label>
                                <x-input type="number" wire:model.live="celular"> </x-imput>
                                <x-input-error for="celular"></x-input-error>


                        </div>
                        </div>
                    </div>
                </x-slot>


                <x-slot name="footer">
                    <div style="display:flex; justify-content: flex-end; margin-right: 10%">
                        <div>
                            <x-danger-button wire:click="keyrand" x-on:click="show = false"> 
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
