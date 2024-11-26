<div>
    <div>
        <div>
            <x-label class="text-lg">
                DIAGNÓSTICO
            </x-label>
        </div>

        <form wire:submit="save">
            <div>
                <div>
                    <x-label>
                        DIAGNÓSTICO SOBRE LA CONSULTA
                    </x-label>
                    
                    <x-textarea wire:model="diagnostico" class="w-full h-32"></x-textarea>
                </div>
                <div>
                    <x-label>
                        PLAN DE TRATAMIENTO
                    </x-label>
                    
                    <x-textarea wire:model="plan" class="w-full h-32"></x-textarea>
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
