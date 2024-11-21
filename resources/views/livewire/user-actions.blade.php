<div>
    <div class="flex flex-wrap justify-center space-x-2 space-y-2 sm:space-y-0 sm:flex-row">
        @php
        $rowData = json_encode($row);
        $rowData1 = json_encode($row);
        @endphp
        <a class="px-2 py-2 text-xs font-bold text-white bg-orange-600 rounded-lg hover:bg-orange-700 hover:no-underline"
            href="{{route('admin.user.edit', $row)}}">
            <i class="fa fa-user-secret"> </i>
        </a>
        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 hover:no-underline"
            wire:click="UserEdit({{$rowData1}})">
            <i class="fa fa-pen"></i>
        </a>
        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 hover:no-underline"
            wire:click="confirm({{ $rowData }})">
            <i class="fa fa-trash"></i>
        </a>
    </div>

    <form wire:submit="update">
        <x-dialog-modal wire:model="openedit">
            <x-slot name="title">
                <label style="margin-top: 15px"> {{ 'Cambiar Contraseña' }} </label>
            </x-slot>
            <x-slot name="content">
                <div class="card">
                    <div class="card-body my-0">
                        <div class="row">
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
