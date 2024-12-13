<div>
    <div>
        <div>
            <x-label class="text-lg">
                PRUEBAS
            </x-label>
        </div> 
        <form wire:submit="save">
            <div>
                <div>
                    <x-label>
                        EXAMENES LABORATORIALES 
                    </x-label>
                    <x-textarea wire:model="examen" class="w-full h-32"></x-textarea>
                </div>
                <div>
                    <x-label>
                        PRUEBAS KINÉSICAS
                    </x-label>
                    <x-textarea wire:model="prueba" class="w-full h-32"></x-textarea>
                </div>

                <div>
                    <div class="row">
                        <x-label class="col-md-2">
                            ANEXOS
                        </x-label>
                    </div>
                   
                    <div >
                    <div class="col-md-2">
                        @livewire('imgexamen-add', ['examenId' => $examenId])
                    </div>
                    <div class=" col-md-6">
                        @livewire('imgexamen-datatable', ['consultaId' => $consultaId])
                    </div>
                    </div>
                    
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
