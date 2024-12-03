<div>

    <x-button class="form-control mx-2" wire:click="create">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        <span class="ml-2">Nuevo Paciente</span>
    </x-button>

    <div>
        <form wire:submit="save">
            <x-dialog-modal wire:model="opencreate">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ $editMode ? 'EDITAR PACIENTE' : 'NUEVO PACIENTE' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="card">
                        <div class="card-body my-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-label>
                                        Foto
                                    </x-label>
                                    <div>
                                        @if ($imagen)
                                            @if ($editMode)
                                                @if ($valueImage && method_exists($imagen, 'temporaryUrl'))
                                                    <img src="{{ $imagen->temporaryUrl() }}" class="w-40 h-40 rounded-full">
                                                @else
                                                    @if (strpos($imagen, 'image/') !== false)
                                                        <img src="{{ asset($imagen) }}" alt="Imagen del paciente" class="w-40 h-40 rounded-full">
                                                    @else 
                                                        <img src="{{ asset('storage/app/public/' . $paciente->imagen) }}" class="w-40 h-40 rounded-full">
                                                    @endif
                                                @endif
                                            @else
                                                <img src="{{ $imagen->temporaryUrl() }}" class="w-40 h-40 rounded-full">
                                            @endif
                                        @else
                                            <img src="{{ asset('image/user.png') }}" class="w-40 h-40 rounded-full">
                                        @endif       
                                    </div>
                                    <input class="form-control" wire:model="imagen" wire:key="{{ $imagenkey }}" wire:click="clickImage"
                                        type="file" id="file" style="display: none;">
                                    <label for="file"
                                        style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">
                                        <span wire:loading wire:target="imagen" class="spinner-border spinner-border-sm"
                                            role="status" aria-hidden="true"></span> Seleccionar archivo
                                    </label>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <x-label for="validationCustom01">
                                        Nombre
                                    </x-label>
                                    <x-input class="form-control" type="text" id="validationCustom01" wire:model="nombre" required> </x-imput>
                                        <x-input-error for="nombre"></x-input-error>
                                        <x-label class="mt-2">
                                            Apellido Paterno
                                        </x-label>
                                        <x-input class="form-control" wire:model="paterno" required> </x-imput>
                                            <x-input-error for="paterno"></x-input-error>

                                            <x-label class="mt-2">
                                                Apellido Materno
                                            </x-label>
                                            <x-input class="form-control" wire:model="materno" required> </x-imput>
                                                <x-input-error for="materno"></x-input-error>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <x-label>
                                        Sexo
                                    </x-label>

                                    <x-select class="form-control" wire:model="genero" required>
                                        <option value=""> Selecione un genero</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                    </x-select>
                                    <x-input-error for="genero"></x-input-error>

                                    <x-label class="mt-2">
                                        Deporte
                                    </x-label>
                                    <x-input class="form-control" wire:model="deporte"></x-input>

                                    <x-label class="mt-2">
                                        Ocupacion
                                    </x-label>
                                    <x-input class="form-control" wire:model="ocupacion"></x-input>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <x-label class="form-label">
                                        C.I
                                    </x-label>
                                    <x-input class="form-control" type="number" min="1" wire:model.live="ci"
                                        oninput="if(this.value.length > 14) this.value = this.value.slice(0, 14);"
                                        max="9999999999" required> </x-imput>
                                        <x-input-error for="ci"></x-input-error>
                                </div>
                                <div class="col-md-4">
                                    <x-label>
                                        Edad
                                    </x-label>
                                    <x-input class="form-control" type="number" min="1" wire:model.live="edad"
                                        oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);"
                                        max="120"> </x-imput>
                                        <x-input-error for="edad"></x-input-error>
                                </div>
                                <div class="col-md-4">
                                    <x-label>
                                        Celular
                                    </x-label>
                                    <x-input class="form-control" type="number" wire:model.live="celular"
                                        oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8);"
                                        max="99999999"> </x-imput>
                                        <x-input-error for="celular"></x-input-error>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <x-label class="mt-2">
                                        Direccion
                                    </x-label>
                                    <x-textarea class="form-control" wire:model="direccion" class="w-full" style="resize: none; line-height: 1.2; margin: 0; padding: 0;" > </x-textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </x-slot>

                <x-slot name="footer">
                    <div>
                        <x-danger-button wire:click="keyrand" x-on:click="show = false">
                            Cancelar
                        </x-danger-button>

                        <x-button>
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            <span class="ml-2">{{ $editMode ? 'Actualizar' : 'Guardar' }} </span>
                        </x-button>
                    </div>
                </x-slot>

            </x-dialog-modal>
        </form>
    </div>
</div>
