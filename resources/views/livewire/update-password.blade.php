<div>

    <x-button class="form-control mx-2" wire:click="edit">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        <span class="ml-2">Cambiar Contraseña</span>
    </x-button>

    <div>
        <form wire:submit="update">
            <x-dialog-modal wire:model="openupdate" max-width="lg">
                <x-slot name="title">
                    <label> {{ 'Cambiar Contraseña' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex flex-col items-center space-y-4">
                                <div class="col-md-8">
                                    <div>
                                        @if ($imagen)
                                                @if (method_exists($imagen, 'temporaryUrl'))
                                                    <img src="{{ $imagen->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-full mb-2 mx-auto">
                                                @else
                                                    @if (strpos($imagen, 'image/') !== false)
                                                        <img src="{{ asset($imagen) }}" alt="Imagen del usuario" class="w-20 h-20 object-cover rounded-full mb-2 mx-auto">
                                                    @else
                                                        <!--Imagen para local -->
                                                            <img src="{{ asset('storage/' . $imagen) }}" class="w-20 h-20 object-cover rounded-full mb-2 mx-auto">
                                                        <!--Imagen para la web  
                                                            <img src="{{ asset('storage/app/public/' . $imagen) }}" class="w-40 h-40 rounded-full">
                                                         -->
                                                    @endif
                                                @endif
                                        @else
                                            <img src="{{ asset('image/user.png') }}" class="w-40 h-40 rounded-full">
                                        @endif       

                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-center space-y-4">
                                    <x-label>Contraseña Actual</x-label>
                                    <x-input class="form-control" wire:model="password_actual" type="password" required />
                                    <x-input-error for="password_actual"></x-input-error>
                                </div>  
    
                                <div class="flex flex-col items-center space-y-4">
                                    <x-label>Nueva Contraseña</x-label>
                                    <x-input class="form-control" wire:model="password" type="password" required />
                                    <x-input-error for="password"></x-input-error>
                                </div>                              

                                <div class="flex flex-col items-center space-y-4">
                                    <x-label>Confirmar Contraseña</x-label>
                                    <x-input class="form-control" wire:model="password_confirmation" type="password" required />
                                    <x-input-error for="password_confirmation"></x-input-error>
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div>
                        <x-danger-button x-on:click="show = false">
                            Cancelar
                        </x-danger-button>

                        <x-button>
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            <span class="ml-2">{{'Actualizar'}} </span>
                        </x-button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        </form>
    </div>
</div>
