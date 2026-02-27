
<div>
    <x-button class="form-control mx-2" wire:click="create">
        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="ml-2">Imagen 3D</span>
    </x-button>

    <x-dialog-modal wire:model="openadd">
        <x-slot name="title">
            <label style="margin-top: 15px"> {{ 'Imagenes A 3D' }} </label>
        </x-slot>

        <x-slot name="content">
            <div class="card">
                <div class="card-body my-0">
                    <div class="row">
                        <div class="w-full">
                            <x-label>Imagenes</x-label>
                            <div class="row">
                                <input class="form-control" wire:model="imagen" multiple type="file" id="img" style="display: none;">
                                <label for="img"
                                    style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #c8dbf0; color: rgb(0, 0, 0); border-radius: 4px;">
                                    <span wire:loading wire:target="imagen" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Seleccionar archivos
                                </label>
                            </div>

                            <div class="mt-3">
                                @if ($imagen && is_array($imagen))
                                    <div class="d-flex flex-wrap" style="gap: 10px;">
                                        @foreach ($imagen as $file)
                                            @if (is_a($file, \Illuminate\Http\UploadedFile::class))
                                                <div style="width: 100px; height: 100px; overflow: hidden; border: 1px solid #ccc; border-radius: 5px;">
                                                    <img src="{{ $file->temporaryUrl() }}" alt="Imagen cargada" style="width: 100%; height: 100%; object-fit: cover;">
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
                <label wire:click="cancelar" style="cursor: pointer; background-color: #ff0000; color: white; padding: 8px 12px; border-radius: 4px;">
                    Cancelar
                </label>

                <label wire:click="saveadd" style="cursor: pointer; background-color: #0d0d0dc2; color: white; padding: 8px 12px; border-radius: 4px;">
                    <span wire:loading wire:target="saveadd" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="ml-2">{{ 'Convertir' }}</span>
                </label>
            </div>
        </x-slot>
    </x-dialog-modal>

    <div wire:poll.10s="checkMeshyTasks" class="mt-4">
        @forelse($imagenes as $img)
            <div class="card mb-3 p-2">
                <div class="d-flex gap-3 align-items-start">
                    <div>
                        <img src="{{ asset('storage/' . $img->ruta) }}" alt="original" style="max-width:120px; border:1px solid #ddd; padding:2px;">
                    </div>

                    <div style="flex:1;">
                        <p><strong>ID:</strong> {{ $img->id }}</p>
                        <p><strong>Task:</strong> {{ $img->meshy_task_id ?? '—' }}</p>

                        @php
                            $res = $img->meshy_result ?? null; // ya casteado a array por el modelo
                            $status = $res['status'] ?? $img->meshy_status ?? 'PENDING';
                            $progress = $res['progress'] ?? $img->meshy_progress ?? 0;
                        @endphp

                        <p><strong>Estado:</strong> {{ $status }} — <strong>Progreso:</strong> {{ $progress }}%</p>

                        @if($status === 'SUCCEEDED' && !empty($res['model_urls']['glb']))
                            {{-- Thumbnail --}}
                            @if(!empty($res['thumbnail_url']))
                                <div style="margin-bottom:8px;">
                                </div>
                            @endif

                            {{-- Links de descarga --}}
                            <div class="mb-2">
                                <a href="{{ $res['model_urls']['glb'] }}" target="_blank">Descargar GLB</a>
                                @if(!empty($res['model_urls']['fbx'])) | <a href="{{ $res['model_urls']['fbx'] }}" target="_blank">FBX</a> @endif
                                @if(!empty($res['model_urls']['obj'])) | <a href="{{ $res['model_urls']['obj'] }}" target="_blank">OBJ</a> @endif
                            </div>

                            {{-- model-viewer para visualizar GLB (si quieres integrarlo) --}}
@php
    $modelSrc = route('meshy.model', ['imgconsulta' => $img->id, 'format' => 'glb']);
    $thumbnail = $res['thumbnail_url'] ?? null;
@endphp

<div style="width:420px; height:320px; border:1px solid #eee; padding:6px;">
<model-viewer
    id="mv-{{ $img->id }}"
    src="{{ $modelSrc }}"
    poster="{{ $thumbnail }}"
    alt="modelo 3D"
    style="width:100%; height:100%;"
    camera-controls
    auto-rotate
    crossorigin="anonymous"
    reveal="auto"
></model-viewer>

</div>

        <script>
        document.addEventListener('livewire:load', function () {
            const mv = document.getElementById('mv-{{ $img->id }}');
            if (mv) {
                mv.addEventListener('error', (ev) => {
                    console.error('model-viewer error for img {{ $img->id }}:', ev);
                });
                mv.addEventListener('load', (ev) => {
                    console.log('model-viewer loaded model for img {{ $img->id }}');
                });
            }
        });
        </script>


                        @else
                            <div>
                                <small>Esperando resultado de Meshy...</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No hay imágenes aún.</p>
        @endforelse
    </div>
<script>
window.addEventListener('load', () => {
  document.querySelectorAll('model-viewer').forEach(mv => {
    mv.addEventListener('error', (ev) => {
      console.error('model-viewer error:', ev, mv.getAttribute('src'));
      // intentar recuperar la causa si existe shadowRoot
      try {
        const internals = mv.shadowRoot || null;
        console.log('model-viewer shadowRoot:', !!internals);
      } catch(e) {}
    });
    mv.addEventListener('load', () => {
      console.log('model-viewer loaded:', mv.getAttribute('src'));
    });
    mv.addEventListener('progress', (e) => {
      console.log('model-viewer progress:', e);
    });
  });
});
</script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</div>
