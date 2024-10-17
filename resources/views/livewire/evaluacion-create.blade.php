<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                EVALUACION KINESICA ESPECIFICA
            </x-label>
        </div>

        <form wire:submit="save">
            <div style="display: flex;  gap:5%; margin:30px; height: 350px"> 
            <div>
                <div style="display: flex; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label>Localidad</x-label>
                    </div>
                    <div>
                        <x-input wire:model="localidad" style="align-self: flex-start; width: 250px;"></x-input>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">   
                        <x-label style="align-self: flex-start;">Aparicion</x-label>
                    </div>
                    <div>
                        <x-input wire:model="aparicion" style="width: 250px"></x-input>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label style="align-self: flex-start;">Duracion</x-label>
                    </div>
                    <div>
                        <x-input wire:model="duracion" style="width: 250px"></x-input>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label style="align-self: flex-start;">Intensidad</x-label>
                    </div>
                    <div>
                        <x-select wire:model="intensidad" style="align-self: flex-start; width: 250px">
                            <option value="0 - Sin Dolor">0 - Sin Dolor</option>
                            <option value="1 - Dolor Leve">1 - Dolor Leve</option>
                            <option value="2 - Dolor Leve/Moderado">2 - Dolor Leve/Moderado</option>
                            <option value="3 - Dolor Moderado">3 - Dolor Moderado</option>
                            <option value="4 - Dolor Moderado/Intenso">4 - Dolor Moderado/Intenso</option>
                            <option value="5 - Dolor Intenso">5 - Dolor Intenso</option>
                            <option value="6 - Dolor Intenso/Insoportable">6 - Dolor Intenso/Insoportable</option>
                            <option value="7 - Dolor Insoportable">7 - Dolor Insoportable</option>
                            <option value="8 - Dolor Insoportable/Agonizante">8 - Dolor Insoportable/Agonizante</option>
                            <option value="9 - Dolor Agonizante">9 - Dolor Agonizante</option>
                            <option value="10 - Dolor Insoportable">10 - Dolor Insoportable</option>
                        </x-select>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label>Caracter</x-label>
                    </div>
                    <div>
                        <x-input wire:model="caracter" style="align-self: flex-start; width: 250px"></x-input>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label>Irradiacion</x-label>
                    </div>
                    <div>
                        <x-input wire:model="irradiacion" style="align-self: flex-start; width: 250px"></x-input>
                    </div>
                </div>

                <div style="display: flex; margin-top: 10px; justify-content: flex-end">
                    <div style="margin-right: 25px">
                        <x-label>Atenuantes</x-label>
                    </div>
                    <div>
                        <x-input wire:model="atenuantes" style="align-self: flex-start; width: 250px"></x-input>
                    </div>
                </div>
            </div>  

                <div>
                    Localizacion de la zona del dolor
                    <img src="{{ asset('image/cuerpo.jpg') }}" style="height: 300px">
                </div>
            
            </div>

            <div class="mt-4">
                <x-danger-button wire:click="validateNavBar('inspeccion')">
                    Saltar
                </x-danger-button>
                <x-button wire:click="$parent.inspeccion">
                    Guardar
                </x-button>
            </div>    
        </form>
    </div>

</div>
