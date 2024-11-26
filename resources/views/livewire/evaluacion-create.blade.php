<div>
    <div>
        <div style="margin: 10px 0 0 20px">
            <x-label>
                EVALUACIÓN KINÉSICA ESPECÍFICA
            </x-label>
        </div>

        <form wire:submit="save">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Localidad</x-label></label>
                        <x-input wire:model="localidad" class="w-75"></x-input>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Aparición</x-label></label>
                        <x-input wire:model="aparicion" class="w-75"></x-input>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Duración</x-label></label>
                        <x-input wire:model="duracion" class="w-75"></x-input>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Intensidad</x-label></label>
                        <x-select wire:model="intensidad" class="w-75">
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

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Caracter</x-label></label>
                        <x-input wire:model="caracter" class="w-75"></x-input>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Irradiación</x-label></label>
                        <x-input wire:model="irradiacion" class="w-75"></x-input>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <label class="me-3"><x-label>Atenuantes</x-label></label>
                        <x-input wire:model="atenuantes" class="w-75"></x-input>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <p>Localizacion de la zona del dolor</p>
                    <img src="{{ asset('image/cuerpo.jpg') }}" class="img-fluid" style="height: auto; max-height: 300px;">
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
