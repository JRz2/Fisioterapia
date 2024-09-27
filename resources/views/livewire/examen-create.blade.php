<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                PRUEBAS
            </x-label>
        </div>

        <form wire:submit="save">
            <div style="display: flex;  gap:5%; margin:30px; height: 350px">
                <div style="width: 30%">
                    <x-label>
                        EXAMENES LABORATORIALES
                    </x-label>
                    
                    <x-textarea wire:model="examen" style="height: 80%; width: 100%"></x-textarea>
                </div>
    
                <div style="width: 30%">
                    <x-label>
                        PRUEBAS KINESICAS
                    </x-label>
                    <x-textarea wire:model="prueba" style="height: 80%; width: 100%"></x-textarea>
                </div>
    
                <div style="width: 30%">
                    <x-label>
                        ANEXOS
                    </x-label>
                    <div>
                        <input type="file" wire:model="ruta" multiple>
                        @error('ruta.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
    
            <div style="margin: 0 0 0 20px">
                <x-danger-button wire:click="$parent.diagnostico">
                    Saltar
                </x-danger-button>
                <x-button wire:click="$parent.diagnostico">
                    Guardar
                </x-button>
            </div>           
        </form>
    </div>
</div>
