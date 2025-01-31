<div>
    <div>
        <div>
            <x-label class="text-lg">
                DIAGNÓSTICO
            </x-label>
        </div>

        <form wire:submit="save">
            <div>
                <div>
                    <x-label>
                        DIAGNÓSTICO SOBRE LA CONSULTA
                    </x-label>
                    
                    <x-textarea wire:model="diagnostico" class="w-full h-32"></x-textarea>
                </div>
                <div>
                    <x-label>
                        PLAN DE TRATAMIENTO
                    </x-label>
                    
                    <x-textarea wire:model="plan" class="w-full h-32"></x-textarea>
                </div>
                <div>
                    <x-label>
                        IMAGEN 3D DE LA ZONA AFECTADA
                    </x-label>
                    <x-select class="form-control" wire:model="img">
                        <option value=""> Selecione una zona</option>
                        <option value="cara">Cara</option>
                        <option value="torso">torso</option>
                        <option value="brazo">Brazo</option>
                        <option value="antebrazo">Ante Brazo</option>
                        <option value="mano">Mano</option>
                        <option value="pierna">Pierna</option>
                        <option value="pie">Pie</option>
                    </x-select>
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
