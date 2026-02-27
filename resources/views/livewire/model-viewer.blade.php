<div>
    {{-- Contenedor: viewer arriba, lista abajo (ajusta layout si quieres) --}}
    <div class="mb-3">
        @if($modelSrc)
            <div style="width:100%; max-width:900px; height:520px; border:1px solid #e6e6e6; padding:8px; background:#fafafa;">
                <model-viewer
                    id="mv-{{ $current?->id ?? 'none' }}"
                    src="{{ $modelSrc }}"
                    poster="{{ $thumbnail ?? '' }}"
                    alt="modelo 3D"
                    style="width:100%; height:100%; display:block;"
                    camera-controls
                    auto-rotate
                    crossorigin="anonymous"
                    reveal="auto">
                </model-viewer>
            </div>
        @else
            <div style="width:100%; max-width:900px; height:520px; border:1px dashed #ddd; display:flex; align-items:center; justify-content:center; color:#777;">
                <div>
                    <p><strong>No hay modelo seleccionado</strong></p>
                    <p>Selecciona una imagen 3D de la lista para verla aquí.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Lista de thumbnails y botón "Mostrar" en el mismo componente --}}
    <div class="card" style="max-width:900px;">
        <div class="card-body">
            <h5 class="mb-3">Modelos 3D disponibles</h5>

            @if(count($imagenes) === 0)
                <p class="text-muted">Aún no hay modelos para esta consulta.</p>
            @else
                <div class="d-flex flex-wrap" style="gap:12px;">
                    @foreach($imagenes as $img)
                        @php
                            $res = $img->meshy_result ?? null;
                            $status = $res['status'] ?? $img->meshy_status ?? 'PENDING';
                            $thumb = $res['thumbnail_url'] ?? null;
                        @endphp

                        <div style="width:180px; border:1px solid #eee; padding:8px; border-radius:6px; background:#fff;">
                            <div style="height:110px; display:flex; align-items:center; justify-content:center; overflow:hidden; margin-bottom:8px;">
                                @if($thumb)
                                    <img src="{{ $thumb }}" alt="thumb" style="max-width:100%; max-height:100%; display:block;">
                                @else
                                    <img src="{{ Storage::url($img->ruta) }}" alt="original" style="max-width:100%; max-height:100%; display:block; opacity:0.9;">
                                @endif
                            </div>

                            <div style="font-size:13px; margin-bottom:6px;">
                                <strong>ID:</strong> {{ $img->id }}<br>
                                <strong>Estado:</strong> {{ $status }}<br>
                            </div>

                            <div class="d-flex" style="gap:6px;">
                                {{-- Botón Mostrar (carga el modelo en este componente) --}}
                                <button wire:click="showModel({{ $img->id }})" class="btn btn-sm btn-primary" @if(($res['status'] ?? '') !== 'SUCCEEDED') disabled @endif>
                                    Mostrar
                                </button>

                                {{-- Link descargar GLB directo --}}
                                @if(!empty($res['model_urls']['glb']))
                                    <a href="{{ $res['model_urls']['glb'] }}" target="_blank" class="btn btn-sm btn-outline-secondary">Descargar</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Listeners / reattach (solo para debug y estabilidad con Livewire) --}}
    <script>
    document.addEventListener('livewire:load', function () {
        function attach() {
            document.querySelectorAll('model-viewer').forEach(mv => {
                if (mv._attached) return;
                mv._attached = true;
                mv.addEventListener('load', () => console.log('ModelViewer: loaded', mv.src));
                mv.addEventListener('error', (e) => console.error('ModelViewer: error', mv.src, e));
                mv.addEventListener('progress', (p) => console.log('ModelViewer: progress', p));
            });
        }

        attach();
        Livewire.hook('message.processed', () => {
            setTimeout(attach, 20);
        });
    });
    </script>
</div>
