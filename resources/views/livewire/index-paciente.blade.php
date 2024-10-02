<div>
    <div>
        <a class="px-3 py-2 text-xs font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:no-underline" 
        href="{{route('doctor.paciente.show', $row)}}">
            <i class="fa fa-eye"> </i>
        </a>

        <a class="px-3 py-2 ml-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 hover:no-underline" 
        wire:click="edit({{$row->id}})">
            <i class="fa fa-pen"></i>
        </a>

        <a class="px-3 py-2 ml-2 text-xs font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 hover:no-underline" 
        wire:click="destroy({{$row->id}})">
            <i class="fa fa-trash"></i>
        </a>

    </div>

    <div>
        <form wire:submit="update">
            <x-dialog-modal wire:model="open">   
                <x-slot name="title">
                    Actualizar Datos del Paciente
                </x-slot>

                <x-slot name="content">
                    <div class="bg-white shadow rounder">
                        <div style="display: flex; justify-content: space-around">
                            <div> 
                                <x-label for="imagen">
                                    Foto
                                </x-label>
                                <div style="height: 150px">
                                    <img src="{{ asset('image/user.png') }}" style="height: 150px">
                                </div>
                                <input wire:model="imagen" type="file" id="file" style="display: none;">
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
                                <x-input wire:model="nombre"> </x-input>
                                <x-input-error for="nombre"></x-input-error>
                                
                                <x-label>
                                 Apellido Paterno
                                </x-label>
                                <x-input wire:model="paterno"> </x-input>
                                <x-input-error for="paterno"></x-input-error>
                                
                                <x-label>
                                    Apellido Materno
                                </x-label>
                                <x-input wire:model="materno"> </x-input>
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
                                    Edad
                                </x-label>
                                <x-input wire:model="edad"> </x-imput>
                                <x-input-error for="edad"></x-input-error>
                            
                                <x-label>
                                    Celular
                             </x-label>
                                <x-input wire:model="celular"> </x-imput>
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
                                Actualizar
                            </x-button>
                        </div>
                    </div>
                </x-slot>
            </x-dialog-modal>
        </form>
    </div>

</div>
