<div>
    <x-button class="form-control mx-2" wire:click="create">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        <span class="ml-2">Radiografia</span>
    </x-button>
    <div>
        <x-dialog-modal wire:model="openadd">
            <x-slot name="title">
                <label style="margin-top: 15px"> {{ 'RADIOGRAFIA A 3D' }} </label>
            </x-slot>
            <x-slot name="content">
                <div class="card">
                    <div class="card-body my-0">
                        <div class="row">
                            <div class="w-full">
                                <x-label>
                                    Imagenes
                                </x-label>

                                <div class="row">
                                    <input class="form-control" wire:model="imagen" multiple type="file"
                                        id="img" style="display: none;">
                                    <label for="img"
                                        style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #c8dbf0; color: rgb(0, 0, 0); border-radius: 4px;">
                                        <span wire:loading wire:target="imagen" class="spinner-border spinner-border-sm"
                                            role="status" aria-hidden="true"></span>
                                        Seleccionar archivos
                                    </label>
                                </div>
                                <div>
                                    @if ($imagen && is_array($imagen))
                                        <div class="d-flex flex-wrap" style="gap: 10px;">
                                            @foreach ($imagen as $file)
                                                @if (is_a($file, \Illuminate\Http\UploadedFile::class))
                                                    <div
                                                        style="width: 100px; height: 100px; overflow: hidden; border: 1px solid #ccc; border-radius: 5px;">
                                                        <img src="{{ $file->temporaryUrl() }}" alt="Imagen cargada"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                <div>
                    <label wire:click="cancelar" style="cursor: pointer; background-color: #ff0000; color: white; padding: 8px 12px; border-radius: 4px;" x-on:click="show = false">
                        Cancelar
                    </label>

                    <label wire:click="saveadd" style="cursor: pointer; background-color: #0d0d0dc2; color: white; padding: 8px 12px; border-radius: 4px;">
                        <span wire:loading wire:target="saveadd" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="ml-2">{{ 'Convertir' }}</span>
                    </label>
                </div>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
