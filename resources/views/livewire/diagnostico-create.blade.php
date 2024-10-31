<div>
    <div>
        <div>
            <x-label class="text-lg">
                DIAGNOSTICO
            </x-label>
        </div>

        <form wire:submit="save">
            <div class="row mt-4">
                <div class="col-md-4">
                    <x-label>
                        DIAGNOSTICO SOBRE LA CONSULTA
                    </x-label>
                    
                    <x-textarea wire:model="diagnostico" class="form-control" rows="10"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        PLAN DE TRATAMIENTO
                    </x-label>
                    
                    <x-textarea wire:model="plan" class="form-control" rows="10"></x-textarea>
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
