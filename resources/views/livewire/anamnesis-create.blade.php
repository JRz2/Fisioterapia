<div>
    <div>
        <x-label class="text-lg">ANAMNESIS</x-label>
    </div>
    <br />
    <form wire:submit="save">
        <div>
            <div>
                <x-label>ANTECEDENTES PERSONALES</x-label>
                <x-textarea class="w-full h-32" wire:model="antecedentes"></x-textarea>
            </div>
            <div>
                <x-label>MOTIVO DE LA CONSULTA</x-label>
                <x-textarea class="w-full h-32" wire:model="motivo"></x-textarea>
            </div>
            <div>
                <x-label>HISTORIA DE LA ENFERMEDAD ACTUAL</x-label>
                <x-textarea class="w-full h-32" wire:model="historia_actual"></x-textarea>
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
