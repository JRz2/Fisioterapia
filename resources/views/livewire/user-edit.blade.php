<div>

    <x-button class="form-control mx-2" wire:click="edit">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        <span class="ml-2">Editar</span>
    </x-button>

    <div>
        <form wire:submit="update">
            <x-dialog-modal wire:model="openedit">
                <x-slot name="title">
                    <label style="margin-top: 15px"> {{ 'EDITAR USUARIO' }} </label>
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
                                    <input class="form-control" wire:model="imagen" wire:key="{{ $imagenkey }}" type="file" id="file" style="display: none;">
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
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div>
                        <x-danger-button wire:click="keyrand" x-on:click="show = false">
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
