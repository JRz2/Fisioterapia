<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                ANAMNESIS
            </x-label>
        </div>

        <form wire:submit="save">
            <div style="display: flex;  gap:5%; margin:30px; height: 350px">
                <div style="width: 30%">
                    <x-label>
                        ANTECEDENTES PERSONALES
                    </x-label>
                    
                    <x-textarea wire:model="antecedentes" style="height: 80%; width: 100%"></x-textarea>
                </div>
    
                <div style="width: 30%">
                    <x-label>
                        MOTIVO DE LA CONSULTA
                    </x-label>
                    <x-textarea wire:model="motivo" style="height: 80%; width: 100%"></x-textarea>
                </div>
    
                <div style="width: 30%">
                    <x-label>
                        HISTORIA DE LA ENFERMEDAD ACTUAL
                    </x-label>
                    <x-textarea wire:model="historia_actual" style="height: 80%; width: 100%"></x-textarea>
                </div>
            </div>
    
            <div style="margin: 0 0 0 20px">
                <x-danger-button wire:click="$parent.antropometria">
                    Saltar
                </x-danger-button>
                <x-button wire:click="$parent.antropometria">
                    Guardar
                </x-button>
            </div>           
        </form>
    </div>
</div>
