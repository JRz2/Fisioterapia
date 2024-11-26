<div>
    <div>
        <x-label class="text-lg">
            PALPACIÓN - MOVILIZACIÓN
        </x-label>
    </div>
    <div>
        <form wire:submit="save">
            <div class="row mt-4">
                <div class="col-md-4">
                    <x-label>
                        Contractura
                    </x-label>
                    <x-textarea wire:model="contractura" class="form-control" rows="5"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        Retracción - Acortamiento
                    </x-label>
                    <x-textarea wire:model="retraccion" class="form-control" rows="5"></x-textarea>
                </div>
                <div class="col-md-4">
                    <x-label>
                        Puntos Gatillo
                    </x-label>
                    <x-textarea wire:model="gatillo" class="form-control" rows="5"></x-textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <x-label>
                        Articular
                    </x-label>
                    <x-textarea wire:model="goniometria" class="form-control" rows="3"></x-textarea>
                </div>
                <div class="col-md-6">
                    <x-label>
                        Mensuras
                    </x-label>
                    <x-textarea wire:model="mensuras" class="form-control" rows="3"></x-textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <x-label>
                        Balance Muscular
                    </x-label>
                    <x-textarea wire:model="balance_muscular" class="form-control" rows="3"></x-textarea>
                </div>
                <div class="col-md-6">
                    <x-label>
                        Perímetros
                    </x-label>
                    <x-textarea wire:model="perimetros" class="form-control" rows="3"></x-textarea>
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
