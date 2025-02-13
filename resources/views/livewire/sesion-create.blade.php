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

                                <div>
                                    <h1>Evaluacion del movimiento</h1>
                                </div>

                                <div>
                                    <!-- Canvas para mostrar el resultado de MediaPipe -->
                                    <canvas id="output_canvas" width="640" height="480"></canvas>

                                    <!-- Inputs ocultos para almacenar las posiciones -->
                                    <input type="hidden" id="initialPosition" wire:model="postura_inicial">
                                    <input type="hidden" id="finalPosition" wire:model="postura_final">

                                    <!-- Botones para capturar posiciones -->
                                    <button type="button" id="captureInitialButton"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">
                                        Capturar Posición Inicial
                                    </button>
                                    <button type="button" id="captureFinalButton"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg">
                                        Capturar Posición Final
                                    </button>
                                </div>

                                <div class="flex flex-col items-center mt-4">
                                    <div class="flex flex-col items-center mt-4">
                                        <div>
                                            <video id="webcam" autoplay style="display: none"></video>
                                            <canvas id="output_canvas"></canvas>
                                        </div>

                                        <div>
                                            <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                                Coordenadas Capturadas
                                            </x-label>
                                            <input type="text" wire:model="coordenadas" readonly
                                                class="w-full p-2 border border-gray-300 rounded-lg shadow-sm">
                                        </div>


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



