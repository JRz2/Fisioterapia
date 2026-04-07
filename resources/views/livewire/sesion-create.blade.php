<div>
    <div>
        <x-button wire:click="create"
            class="text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
            Agregar Sesion
        </x-button>
        <div class="mt-4">
            <form wire:submit="save">
                <x-dialog-modal wire:model="opencreate">
                    <x-slot name="title">
                        <div class="text-2xl font-bold text-gray-900 border-b pb-2">
                            NUEVA SESIÓN
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <div>
                            <div>
                                <div>
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Fecha:
                                    </x-label>
                                    <input wire:model="fecha" type="date"
                                        class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Sintomatología
                                    </x-label>
                                    <x-textarea wire:model="sintoma" class="w-full resize-none"></x-textarea>

                                    <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                        Observación
                                    </x-label>
                                    <x-textarea wire:model="observacion" class="w-full resize-none"></x-textarea>
                                </div>

                                <div>
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Recomendaciones
                                    </x-label>
                                    <x-textarea wire:model="recomendacion" class="w-full resize-none"></x-textarea>
                                </div>
                                <div>
                                    <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                        Plan de tratamiento
                                    </x-label>
                                    <x-textarea wire:model="tratamiento" class="w-full resize-none"></x-textarea>
                                </div>

<!-- MEDICIONES BIOMECÁNICAS COMPLETAS -->
<div class="mt-4 pt-3 border-t border-gray-200">
    <div class="text-sm font-semibold text-gray-700 mb-3 bg-blue-50 p-2 rounded">
        📐 MEDICIONES BIOMECÁNICAS (grados)
    </div>
    
    <!-- Pestañas para organizar -->
    <div class="mb-3">
        <div class="flex border-b border-gray-200">
            <button type="button" id="tab-miembro-superior" class="tab-btn px-3 py-1 text-sm font-medium text-blue-600 border-b-2 border-blue-600">🦾 Miembro Superior</button>
            <button type="button" id="tab-miembro-inferior" class="tab-btn px-3 py-1 text-sm font-medium text-gray-500">🦵 Miembro Inferior</button>
            <button type="button" id="tab-columna" class="tab-btn px-3 py-1 text-sm font-medium text-gray-500">🇶 Columna</button>
        </div>
    </div>
    
    <!-- ========== MIEMBRO SUPERIOR ========== -->
    <div id="panel-miembro-superior" class="tab-panel">
        <div class="grid grid-cols-2 gap-4">
            <!-- HOMBRO DERECHO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">💪 HOMBRO DERECHO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="hombro_d_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="hombro_d_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Abducción</label><input type="number" wire:model="hombro_d_abduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación ext</label><input type="number" wire:model="hombro_d_rot_ext" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div colspan="2"><label class="text-xs">Rotación int</label><input type="number" wire:model="hombro_d_rot_int" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- HOMBRO IZQUIERDO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">💪 HOMBRO IZQUIERDO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="hombro_i_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="hombro_i_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Abducción</label><input type="number" wire:model="hombro_i_abduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación ext</label><input type="number" wire:model="hombro_i_rot_ext" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div colspan="2"><label class="text-xs">Rotación int</label><input type="number" wire:model="hombro_i_rot_int" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- CODO DERECHO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦾 CODO DERECHO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="codo_d_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="codo_d_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- CODO IZQUIERDO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦾 CODO IZQUIERDO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="codo_i_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="codo_i_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- MUÑECA DERECHA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">✋ MUÑECA DERECHA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="muneca_d_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="muneca_d_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Desv. radial</label><input type="number" wire:model="muneca_d_radial" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Desv. cubital</label><input type="number" wire:model="muneca_d_cubital" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- MUÑECA IZQUIERDA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">✋ MUÑECA IZQUIERDA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="muneca_i_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="muneca_i_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Desv. radial</label><input type="number" wire:model="muneca_i_radial" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Desv. cubital</label><input type="number" wire:model="muneca_i_cubital" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ========== MIEMBRO INFERIOR ========== -->
    <div id="panel-miembro-inferior" class="tab-panel hidden">
        <div class="grid grid-cols-2 gap-4">
            <!-- CADERA DERECHA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦴 CADERA DERECHA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="cadera_d_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="cadera_d_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Abducción</label><input type="number" wire:model="cadera_d_abduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Aducción</label><input type="number" wire:model="cadera_d_aduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación ext</label><input type="number" wire:model="cadera_d_rot_ext" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación int</label><input type="number" wire:model="cadera_d_rot_int" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- CADERA IZQUIERDA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦴 CADERA IZQUIERDA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="cadera_i_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="cadera_i_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Abducción</label><input type="number" wire:model="cadera_i_abduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Aducción</label><input type="number" wire:model="cadera_i_aduccion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación ext</label><input type="number" wire:model="cadera_i_rot_ext" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación int</label><input type="number" wire:model="cadera_i_rot_int" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- RODILLA DERECHA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦵 RODILLA DERECHA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="rodilla_d_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="rodilla_d_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- RODILLA IZQUIERDA -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦵 RODILLA IZQUIERDA</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="rodilla_i_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="rodilla_i_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- TOBILLO DERECHO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦶 TOBILLO DERECHO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Dorsiflexión</label><input type="number" wire:model="tobillo_d_dorsiflexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Flexión plantar</label><input type="number" wire:model="tobillo_d_flexion_plantar" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inversión</label><input type="number" wire:model="tobillo_d_inversion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Eversión</label><input type="number" wire:model="tobillo_d_eversion" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- TOBILLO IZQUIERDO -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🦶 TOBILLO IZQUIERDO</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Dorsiflexión</label><input type="number" wire:model="tobillo_i_dorsiflexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Flexión plantar</label><input type="number" wire:model="tobillo_i_flexion_plantar" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inversión</label><input type="number" wire:model="tobillo_i_inversion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Eversión</label><input type="number" wire:model="tobillo_i_eversion" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ========== COLUMNA VERTEBRAL ========== -->
    <div id="panel-columna" class="tab-panel hidden">
        <div class="grid grid-cols-2 gap-4">
            <!-- CERVICAL -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🇶 COLUMNA CERVICAL</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="cervical_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="cervical_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación izq</label><input type="number" wire:model="cervical_rotacion_izq" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación der</label><input type="number" wire:model="cervical_rotacion_der" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inclinación izq</label><input type="number" wire:model="cervical_inclinacion_izq" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inclinación der</label><input type="number" wire:model="cervical_inclinacion_der" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
            
            <!-- LUMBAR -->
            <div class="border rounded-lg p-2 bg-gray-50">
                <div class="font-semibold text-sm text-gray-700 mb-2">🇶 COLUMNA LUMBAR</div>
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs">Flexión</label><input type="number" wire:model="lumbar_flexion" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Extensión</label><input type="number" wire:model="lumbar_extension" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación izq</label><input type="number" wire:model="lumbar_rotacion_izq" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Rotación der</label><input type="number" wire:model="lumbar_rotacion_der" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inclinación izq</label><input type="number" wire:model="lumbar_inclinacion_izq" step="5" class="w-full p-1 border rounded text-sm"></div>
                    <div><label class="text-xs">Inclinación der</label><input type="number" wire:model="lumbar_inclinacion_der" step="5" class="w-full p-1 border rounded text-sm"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para las pestañas -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.id;
                let panelId = '';
                
                if (tabId === 'tab-miembro-superior') panelId = 'panel-miembro-superior';
                if (tabId === 'tab-miembro-inferior') panelId = 'panel-miembro-inferior';
                if (tabId === 'tab-columna') panelId = 'panel-columna';
                
                // Ocultar todos los paneles
                panels.forEach(panel => panel.classList.add('hidden'));
                
                // Mostrar el panel seleccionado
                document.getElementById(panelId).classList.remove('hidden');
                
                // Actualizar estilo de pestañas
                tabs.forEach(t => {
                    t.classList.remove('text-blue-600', 'border-blue-600');
                    t.classList.add('text-gray-500');
                });
                this.classList.remove('text-gray-500');
                this.classList.add('text-blue-600', 'border-blue-600');
            });
        });
    });
</script>

                                <div>
                                    <input class="form-control" wire:model="ruta" multiple class="form-control"
                                        type="file" id="file" style="display: none;">
                                    <label for="file"
                                        style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">
                                        <span wire:loading wire:target="ruta" class="spinner-border spinner-border-sm"
                                            role="status" aria-hidden="true"></span>
                                        Seleccionar archivos
                                    </label>
                                    <div class="flex gap-2 flex-wrap mt-4 overflow-auto max-h-80">
                                        @if ($ruta && is_array($ruta))
                                            @foreach ($ruta as $image)
                                                <img src="{{ $image->temporaryUrl() }}" class="w-24 h-24 rounded-lg"
                                                    alt="Imagen cargada">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <div class="w-full flex justify-end bg-gray-100">
                            <x-danger-button wire:click="keyrand" x-on:click="show = false">
                                Cancelar
                            </x-danger-button>

                            <x-button>
                                Guardar
                            </x-button>
                        </div>
                    </x-slot>
                </x-dialog-modal>
            </form>
        </div>
    </div>
</div>



