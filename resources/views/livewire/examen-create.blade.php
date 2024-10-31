<div>
    <div>
        <div>
            <x-label class="text-lg">
                PRUEBAS
            </x-label>
        </div> 
        <form wire:submit="save">
            <div class="row mt-4">
                <div class="col-md-4">
                    <x-label>
                        EXAMENES LABORATORIALES
                    </x-label>
                    <x-textarea wire:model="examen" class="form-control" rows="10"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        PRUEBAS KINESICAS
                    </x-label>
                    <x-textarea wire:model="prueba" class="form-control" rows="10"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        ANEXOS
                    </x-label>
                    <div>
                        <input type="file" wire:model="ruta" multiple class="form-control">
                        @error('ruta.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
               
            <div class="mt-4">
                <x-button wire:click="$parent.diagnostico">
                    Guardar
                </x-button>
            </div>           
        </form>
    </div>
</div>
