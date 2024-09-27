<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                DIAGNOSTICO
            </x-label>
        </div>

        <form wire:submit="save">
            <div style="display: flex;  gap:5%; margin:30px; height: 350px">
                <div style="width: 30%">
                    <x-label>
                        DIAGNOSTICO SOBRE LA CONSULTA
                    </x-label>
                    
                    <x-textarea wire:model="diagnostico" style="height: 80%; width: 100%"></x-textarea>
                </div>

                <div style="width: 30%">
                    <x-label>
                        PLAN DE TRATAMIENTO
                    </x-label>
                    
                    <x-textarea wire:model="plan" style="height: 80%; width: 100%"></x-textarea>
                </div>
            </div>
    
            <div style="margin: 0 0 0 20px">
                <x-danger-button wire:click="$parent.ananmesis">
                    Saltar
                </x-danger-button>
                <x-button wire:click="$parent.ananmesis">
                    Guardar
                </x-button>
            </div>           
        </form>
    </div>
</div>
