<div>
    <div>
        <x-label class="text-lg">
            ANTROPOMETRIA {{ $consultaId }}
        </x-label>
    </div>
    <form wire:submit="save">
        <br />
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/regla.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            Altura
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="talla" wire:change="calcularIMC">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            Cm
                        </x-label>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/pa.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            PA
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="pa">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            mmHg
                        </x-label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/balanza.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            Peso
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="peso" wire:change="calcularIMC">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            Kg
                        </x-label>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/corazon.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            SpO2
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="sp">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>

                        </x-label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/imc.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            IMC
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="imc">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            <div style="margin-left: 10px">
                                @if ($categoriaPeso)
                                    <span class="badge badge-{{ $colorCategoriaPeso }}">{{ $categoriaPeso }}</span>
                                @endif
                            </div>
                        </x-label>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/fc.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            F.C.
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="fc">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            f.c
                        </x-label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-1"></div>
           
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/pi.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            PI
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="pi">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            
                        </x-label>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('image/temp.png') }}" class="w-30 h-30 rounded-full">
                    </div>
                    <div class="col-md-2">
                        <x-label>
                            Temp
                        </x-label>
                    </div>
                    <div class="col-md-2">
                        <x-input class="form-control" wire:model="fc">
                        </x-input>
                    </div>
                    <div class="col-md-3">
                        <x-label>
                            °C
                        </x-label>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="mt-4">
            <x-button wire:click="$parent.evaluacion">
                Guardar
            </x-button>
        </div>
    </form>
</div>
