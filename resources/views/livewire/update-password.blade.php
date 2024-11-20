<div>

    <x-button class="form-control mx-2" wire:click="edit">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        <span class="ml-2">Cambiar Contraseña</span>
    </x-button>

    <div>
        <form wire:submit="update">
            <x-dialog-modal wire:model="openupdate">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ 'Cambiar Contraseña' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="card">
                        <div class="card-body my-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-label>Foto</x-label>
                                    <div style="height: 170px">
                                        @if ($imagen)
                                                @if (method_exists($imagen, 'temporaryUrl'))
                                                    <img src="{{ $imagen->temporaryUrl() }}" class="w-40 h-40 rounded-full">
                                                @else
                                                    @if (strpos($imagen, 'image/') !== false)
                                                        <img src="{{ asset($imagen) }}" alt="Imagen del usuario" class="w-40 h-40 rounded-full">
                                                    @else
                                                        <img src="{{ asset('storage/app/public/' . $imagen) }}" class="w-40 h-40 rounded-full">
                                                    @endif
                                                @endif
                                        @else
                                            <img src="{{ asset('image/user.png') }}" class="w-40 h-40 rounded-full">
                                        @endif       

                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                    <x-label>Contraseña Actual</x-label>
                                    <x-input class="form-control" wire:model="password_actual" type="password" required />
                                    <x-input-error for="password_actual"></x-input-error>
                                </div>  
    
                                <div class="col-md-12 mb-4">
                                    <x-label>Nueva Contraseña</x-label>
                                    <x-input class="form-control" wire:model="password" type="password" required />
                                    <x-input-error for="password"></x-input-error>
                                </div>                              

                                <div class="col-md-12 mb-4">
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
