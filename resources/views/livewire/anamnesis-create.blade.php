<div>
    <div>
        <x-label class="text-lg">
            ANAMNESIS
        </x-label>
    </div>
    <br/>
    <form wire:submit="save">
        <div class="row">
            <div class="col-md-4">
                <x-label>
                    ANTECEDENTES PERSONALES
                </x-label>    
                <x-textarea class="form-control" wire:model="antecedentes" style="height: 80%; width: 100%"></x-textarea>
            </div>
            <div class="col-md-4">
                <x-label>
                    MOTIVO DE LA CONSULTA
                </x-label>
                <x-textarea wire:model="motivo" style="height: 80%; width: 100%"></x-textarea>
            </div>
            <div class="col-md-4">
                <x-label>
                    HISTORIA DE LA ENFERMEDAD ACTUAL
                </x-label>
                <x-textarea wire:model="historia_actual" style="height: 80%; width: 100%" rows="10"></x-textarea>
            </div>
        </div>
            
        <div>
            <x-danger-button wire:click="validateNavBar('antropometria')">
                Saltar
            </x-danger-button>
            <x-button wire:click="$parent.antropometria">
                Guardar
            </x-button>
        </div>           
    </form>
</div>
