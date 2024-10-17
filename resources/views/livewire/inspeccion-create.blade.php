<div>
    <div>
        <div>
            <x-label  class="text-lg">
                INPECCION
            </x-label>
        </div>

        <form wire:submit="save">
            <div class="row mt-2">
                <div class="col-md-12">
                    <x-label>
                        Observacion
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
            
        
            <div class="mt-4">
                    <x-danger-button wire:click="validateNavBar('movilizacion')">
                        Saltar
                    </x-danger-button>
                    <x-button wire:click="$parent.movilizacion">
                        Guardar
                    </x-button>
            </div>   
        </form>
    </div>
</div>
