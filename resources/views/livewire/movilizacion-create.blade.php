<div>
    <div>
        <x-label class="text-lg">
            Palpacion - Movilizacion
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
                        Retraccion - Acortamiento
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
                        Perimetros
                    </x-label>
                    <x-textarea wire:model="perimetros" class="form-control" rows="3"></x-textarea>
                </div>
            </div>
            

            <div class="mt-4">
                <x-danger-button wire:click="validateNavBar('examen')">
                    Saltar
                </x-danger-button>
                <x-button wire:click="$parent.prueba">
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
</div>
