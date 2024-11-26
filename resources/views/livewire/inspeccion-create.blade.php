<div>
    <div>
        <div>
            <x-label  class="text-lg">
                INSPECCIÓN
            </x-label>
        </div>

        <form wire:submit="save">
            <div class="row mt-2">
                <div class="col-md-12">
                    <x-label>
                        Observación
                    </x-label>
                    <x-textarea class="form-control" wire:model="observacion" rows="3"></x-textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <x-label>
                        Plano Anterior
                    </x-label>
                    <x-textarea wire:model="plano_anterior" class="form-control" rows="10"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        Plano Lateral
                    </x-label>
                    <x-textarea wire:model="plano_lateral" class="form-control" rows="10"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        Plano Posterior
                    </x-label>
                    <x-textarea wire:model="plano_posterior" class="form-control" rows="10"></x-textarea>
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
