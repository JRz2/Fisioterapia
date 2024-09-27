<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                INPECCION
            </x-label>
        </div>

        <form wire:submit="save">
            <div style="height: 350px">
                    <div style="margin-left: 10%; margin-right: 10% ">
                    <x-label>
                        Observacion
                    </x-label>
                    <x-textarea wire:model="observacion" style="width: 100%"></x-textarea>
                    </div>
        
                    <div style="display: flex;  gap:5%; margin:10px; height: 300px">
                    <div style="width: 30%;">
                        <x-label>
                            Plano Anterior
                        </x-label>
                        <x-textarea wire:model="plano_anterior" style="height: 80%; width: 100%"></x-textarea>
                    </div>
        
                    <div style="width: 30%">
                        <x-label>
                            Plano Lateral
                        </x-label>
                        <x-textarea wire:model="plano_lateral" style="height: 80%; width: 100%"></x-textarea>
                    </div>
        
                    <div style="width: 30%">
                        <x-label>
                            Plano Posterior
                        </x-label>
                        <x-textarea wire:model="plano_posterior" style="height: 80%; width: 100%"></x-textarea>
                    </div>
                    </div>  
            </div>
        
            <div style="margin: 0 0 0 20px">
                    <x-danger-button wire:click="$parent.movilizacion">
                        Saltar
                    </x-danger-button>
                    <x-button wire:click="$parent.movilizacion">
                        Guardar
                    </x-button>
            </div>   
        </form>
    </div>
</div>
