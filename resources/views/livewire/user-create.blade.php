<div>
    <x-button class="form-control mx-2" wire:click="create">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="ml-2">Nuevo Usuario</span>
    </x-button>
    
    <div>
        <form wire:submit.prevent="save">
            <x-dialog-modal wire:model="opencreate">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ 'NUEVO USUARIO' }} </label>
                </x-slot>
                <x-slot name="content">
                    <div class="card">
                        <div class="card-body my-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-label>Foto</x-label>
                                    <div style="height: 170px">
                                        @if($imagen)
                                            <img src="{{ $imagen->temporaryUrl() }}" class="w-40 h-40 rounded-full">
                                        @else
                                            <img src="{{ asset('image/user.png') }}" class="w-40 h-40 rounded-full">
                                        @endif
                                    </div>
                                    <input class="form-control" wire:model="imagen" wire:key="{{ $imagenkey }}" wire:click="clickImage" type="file" id="file" style="display: none;">
                                    <label for="file" style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">
                                        <span wire:loading wire:target="imagen" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Seleccionar archivo
                                    </label>
                                </div>
    
                                <div class="col-md-4 mb-4">
                                    <x-label for="validationCustom01">Nombre Completo</x-label>
                                    <x-input class="form-control" type="text" id="validationCustom01" wire:model="name" required />
                                    <x-input-error for="name"></x-input-error>
                                </div>
    
                                <div class="col-md-4 mb-4">
                                    <x-label>Correo</x-label>
                                    <x-input class="form-control" wire:model="email" type="email" required />
                                    <x-input-error for="email"></x-input-error>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <x-label>Password</x-label>
                                    <x-input class="form-control" wire:model="password" type="password" required />
                                    <x-input-error for="password"></x-input-error>
                                </div>
                            </div>   

                            <div class="col-md-12 mb-4">
                                <x-label>Confirmar Password</x-label>
                                <x-input class="form-control" wire:model="password_confirmation" type="password" required />
                                <x-input-error for="password_confirmation"></x-input-error>
                            </div>
                        </div>
                    </div>
                </x-slot>
    
                <x-slot name="footer">
                    <div>
                        <x-danger-button wire:click="keyrand" x-on:click="show = false">Cancelar</x-danger-button>
                        <x-button type="submit">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="ml-2">{{'Guardar' }} </span>
                        </x-button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        </form>
    </div>
</div>
