<div>
    <div>
        <div>
            <x-label class="text-lg">
                PRUEBAS
            </x-label>
        </div> 
        <form wire:submit="save">
            <div>
                <div>
                    <x-label>
                        EXAMENES LABORATORIALES
                    </x-label>
                    <x-textarea wire:model="examen" class="w-full h-32"></x-textarea>
                </div>
                <div>
                    <x-label>
                        PRUEBAS KINÉSICAS
                    </x-label>
                    <x-textarea wire:model="prueba" class="w-full h-32"></x-textarea>
                </div>

                <div>
                    <div class="row">
                        <x-label class="col-md-2">
                            ANEXOS
                        </x-label>
                        <input class="form-control" wire:model="ruta" multiple class="form-control"  type="file" id="file" style="display: none;">
                        <label for="file" style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #c8dbf0; color: rgb(0, 0, 0); border-radius: 4px;">
                            <span wire:loading wire:target="ruta" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Seleccionar archivos
                        </label>
                    </div>

                    <div class="d-flex flex-wrap mt-3">
                        @if($ruta && is_array($ruta))
                            @foreach($ruta as $image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-40 h-40" alt="Imagen cargada">
                            @endforeach
                        @else
                            
                        @endif
                    </div>
                </div>
            </div>
               
            <div class="mt-4 text-center">
                <x-button>
                    <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                        role="status" aria-hidden="true"></span>
                    <span class="ml-2">{{ $editMode ? 'Actualizar' : 'Guardar' }} </span>
                </x-button>
            </div>           
        </form>
    </div>
</div>
