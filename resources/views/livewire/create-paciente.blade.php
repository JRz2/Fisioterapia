<div>

    <x-button wire:click="create">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="ml-2">Nuevo Paciente</span>
    </x-button>

    <div>
        <form wire:submit="save">
            <x-dialog-modal wire:model="opencreate">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ $editMode ? 'EDITAR PACIENTE' : 'NUEVO PACIENTE' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="bg-white shadow rounder">
                        <div class=" row p-4">
                            <div class=" col-md-4">
                                <x-label>
                                    Foto
                                </x-label>
                                <div style="height: 150px">
                                    @if ($editMode){
                                        @if ($imagen)
                                        <img src="{{asset('storage/' . $imagen)}}" style="height: 150px">
                                        @else
                                        <img src="{{ asset('image/user.png') }}" style="height: 150px">   
                                    }
                                    @elseif($imagen)
                                    <img src="{{$imagen->temporaryUrl()}}" style="height: 150px">
                                    @else 
                                    <img src="{{ asset('image/user.png') }}" style="height: 150px">
                                    @endif
                                </div>
                                <input wire:model="imagen" wire:key="{{$imagenkey}}" wire:click="clickImage" type="file" id="file" style="display: none;">
                                <label for="file" style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">Seleccionar archivo</label>
                            </div>
                            <div class=" col-md-4">
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

                            </div>
                            <div class=" col-md-4">
                                <x-label>
                                    Sexo
                                </x-label>

                                <x-select class="w-full" wire:model="genero">
                                    <option value=""> Selecione un genero</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </x-select>
                                <x-input-error for="genero"></x-input-error>

                                <x-label>
                                    Deporte
                                </x-label>
                                <x-input wire:model="deporte"></x-input>

                                <x-label>
                                    Ocupacion
                                </x-label>
                                <x-input wire:model="ocupacion"></x-input>

                            </div>
                        </div>

                        <div class="row p-2">
                            <div class=" col-md-4">
                                <x-label>
                                    C.I
                                </x-label>
                                <x-input type="number" min="1" wire:model.live="ci" style="-moz-appearance: textfield; -webkit-appearance: none" oninput="if(this.value.length > 14) this.value = this.value.slice(0, 14);" max="9999999999"> </x-imput>
                                    <x-input-error for="ci"></x-input-error>
                            </div>
                            <div class=" col-md-4">
                                <x-label>
                                    Edad
                                </x-label>
                                <x-input type="number" min="1" wire:model.live="edad" style="-moz-appearance: textfield; -webkit-appearance: none" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" max="120"> </x-imput>
                                    <x-input-error for="edad"></x-input-error>
                            </div>
                            <div class=" col-md-4">
                                <x-label>
                                    Celular
                                </x-label>
                                <x-input type="number" wire:model.live="celular" oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8);" max="99999999"> </x-imput>
                                    <x-input-error for="celular"></x-input-error>
                            </div>
                        </div>

                        <div class="row p-4">
                            <div class="w-full">
                                <x-label>
                                    Direccion
                                </x-label>
                                <x-input wire:model="direccion" class="w-full"> </x-input>
                            </div>
                        </div>
                    </div>
                </x-slot>



                <x-slot name="footer">
                    <div class="flex justify-end mr-5"> <!-- Aquí se usa 'mr-10' para margen derecho -->
                        <div>
                            <x-danger-button wire:click="keyrand" x-on:click="show = false">
                                Cancelar
                            </x-danger-button>

                            <x-button>
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="ml-2">{{ $editMode ? 'Actualizar' : 'Guardar' }} </span>
                            </x-button>
                        </div>
                    </div>
                </x-slot>

            </x-dialog-modal>
        </form>
    </div>
</div>