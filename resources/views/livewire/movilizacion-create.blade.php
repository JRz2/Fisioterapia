<div>
    <div>
        <form wire:submit="save">
            <x-label>
                Palpacion - Movilizacion
            </x-label>
            <div style="display: flex;  gap:5%; margin:20px; height: 150px">
            <div style="width: 30%">
                <x-label>
                    Contractura
                </x-label>
                <x-textarea wire:model="contractura" style="height: 80%; width: 100%"></x-textarea>
            </div>

            <div style="width: 30%">
                <x-label>
                    Retraccion - Acortamiento
                </x-label>
                <x-textarea wire:model="retraccion" style="height: 80%; width: 100%"></x-textarea>
            </div>

            <div style="width: 30%">
                <x-label>
                    Puntos Gatillo
                </x-label>
                <x-textarea wire:model="gatillo" style="height: 80%; width: 100%"></x-textarea>
            </div>
            </div>

            <div style="display: flex;  gap:5%; margin:25px; height: 200px">

            <div style="width: 50%"> 
                <div>
                    <x-label>
                        Articular
                    </x-label>
                    <x-textarea wire:model="goniometria" style="height: 80%; width: 100%" style="height: 80%; width: 100%"></x-textarea>
                </div>

                <div>
                    <x-label>
                        Mensuras
                    </x-label>
                    <x-textarea wire:model="mensuras" style="height: 80%; width: 100%" style="height: 80%; width: 100%"></x-textarea>
                </div>
            </div>

            <div style="width: 50%">
                <div>
                    <x-label>
                        Balance Muscular
                    </x-label>
                    <x-textarea wire:model="balance_muscular" style="height: 80%; width: 100%"></x-textarea>
                </div>

                <div>
                    <x-label>
                        Perimetros
                    </x-label>
                    <x-textarea wire:model="perimetros" style="height: 80%; width: 100%"></x-textarea>
                </div>
            </div>
            </div>

            <div>
            <x-danger-button wire:click="$parent.prueba">
                Saltar
            </x-danger-button>
            <x-button wire:click="$parent.prueba">
                Guardar
            </x-button>
            </div>
        </form>
    </div>
</div>
