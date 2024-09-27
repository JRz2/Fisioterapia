<div>
    <div style="margin: 10px 0 0 20px">
        <x-label>
            ANTROPOMETRIA {{$consultaId}}
        </x-label>
    </div>
    <form wire:submit="save">
        <div style="display: flex;  gap:5%; margin:30px; height: 350px">
        <div style="width: 50%">  
            <div style="display: flex; height: 25%">
                <div style="width: 70px">
                    <img src="{{ asset('image/regla.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                        Altura
                    </x-label>
                </div>

                <div>   
                    <x-input wire:model="talla" wire:change="calcularIMC" style="width: 70px">
                    </x-input>Cm
                </div>
            </div>
    
            <div style="display: flex; height: 25%">
                <div style="width: 70px">
                    <img src="{{ asset('image/balanza.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px" >
                    <x-label>
                        Peso
                    </x-label>
                </div>
                
                <div>
                    <x-input wire:model="peso" wire:change="calcularIMC" style="width: 70px"> 
                    </x-input>Kg
                </div>
            </div>
    
            <div style="display: flex; height: 25%">
                <div style="width: 70px">
                    <img src="{{ asset('image/imc.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                        IMC
                    </x-label>
                </div>
    
                <div>
                    <x-input wire:model="imc" style="width: 70px" disabled>
                    </x-input>
                </div>

                <div style="margin-left: 10px">
                    @if($categoriaPeso)
                        <span class="badge badge-{{ $colorCategoriaPeso }}">{{ $categoriaPeso }}</span>
                    @endif
                </div>
            </div>

            <div style="display: flex; height: 25%">

                <div style="width: 70px">
                    <img src="{{ asset('image/pi.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                        PI
                    </x-label>
                </div>
                
                <div>
                    <x-input wire:model="pi" style="width: 70px">
                        
                    </x-input>
                </div>    
            </div>
        </div>
    
        <div style="width: 50%">
            <div style="display: flex; height: 25%">
                <div style="width: 70px">
                    <img src="{{ asset('image/pa.png') }}" style="height: 70px">
                </div>

                <div style="width: 40px">
                    <x-label>
                         PA
                     </x-label>
                </div>

                
                <div>
                    <x-input wire:model="pa" style="width: 70px"></x-input>mmHg
                </div>                     
            </div>
    
            <div style="display: flex; height: 25%">
                
                <div style="width: 70px">
                    <img src="{{ asset('image/corazon.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                        SpO2
                    </x-label>
                </div>
                
                <div>
                    <x-input wire:model="sp" style="width: 70px"></x-input>
                </div>    
            </div>
    
            <div style="display: flex; height: 25%">
                
                <div style="width: 70px">
                    <img src="{{ asset('image/fc.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                        F.C.
                    </x-label>
                </div>
                
                <div>
                    <x-input wire:model="fc" style="width: 70px">
    
                    </x-input>f.c
                </div>                   
            </div>

            <div style="display: flex; height: 25%">

                <div style="width: 70px">
                    <img src="{{ asset('image/temp.png') }}" style="height: 70px">
                </div>

                <div style="width: 50px">
                    <x-label>
                         Temp
                     </x-label>
                </div>
          
                <div>
                    <x-input style="width: 70px"></x-input> °C
                </div>                     
            </div>
        </div>
        </div>
    
        <div style="margin: 0 0 0 20px">
            <x-danger-button wire:click="$parent.evaluacion">
             Saltar
            </x-danger-button>
            <x-button wire:click="$parent.evaluacion">
             Guardar
            </x-button>
        </div>
    </form>
</div>

