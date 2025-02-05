<div>
    <div class="max-w-4xl mx-auto mt-6">
        @if ($sesiones->isNotEmpty())
            @foreach ($sesiones as $sesion)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4" x-data="{ expanded: false }">
                    <div class="border-b pb-2 mb-2 flex justify-between items-center">
                        <div>
                            <h1 class="font-bold text-xl">{{ $sesion->codigo }}</h1>
                            <span class="text-gray-500">{{ $sesion->fecha }}</span>
                        </div>
                        <!-- Botón para expandir o colapsar -->
                        <button class="text-blue-500 hover:underline focus:outline-none" @click="expanded = !expanded">
                            <span
                                class="px-3 py-2 text-xs font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:no-underline"
                                x-show="!expanded"> <i class="fa fa-eye"> </i></span>
                            <span
                                class="px-3 py-2 text-xs font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 hover:no-underline"
                                x-show="expanded"><i class="fa fa-eye"> </i></span>
                        </button>
                    </div>

                    <!-- Contenido que se expandirá o colapsará -->
                    <div x-show="expanded" class="space-y-2 mt-2">
                        <p><strong>Síntoma:</strong> {{ $sesion->sintoma }}</p>
                        <p><strong>Observación:</strong> {{ $sesion->observacion }}</p>
                        <p><strong>Recomendación:</strong> {{ $sesion->recomendacion }}</p>
                        <p><strong>Tratamiento:</strong> {{ $sesion->tratamiento }}</p>
                        <!--<p>Postura Inicial: {{ json_encode($sesion->postura_inicial) }}</p>
                        <p>Postura Final: {{ json_encode($sesion->postura_final) }}</p>-->
                        <button
                            onclick="visualizarPosturas({{ json_encode($sesion->postura_inicial) }}, {{ json_encode($sesion->postura_final) }})">
                            Visualizar Posturas
                        </button>



                        


                        <!-- Mostrar imágenes -->
                        @if ($sesion->imgsesion->isNotEmpty())
                            <div id="gallery-{{ $sesion->id }}"
                                class="gallery flex flex-wrap justify-center gap-4 mt-4">
                                @foreach ($sesion->imgsesion as $img)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/app/public/' . $img->ruta) }}"
                                            alt="Imagen de la sesión" class="w-32 h-32 rounded-lg shadow-sm"
                                            data-original="{{ asset('storage/app/public/' . $img->ruta) }}">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No hay imágenes disponibles para esta sesión.</p>
                        @endif
                    </div>
                </div>
            @endforeach

            <div>
                
                <div class="flex flex-col items-center mt-4">
                    <div class="flex flex-col items-center mt-4">
                        <div>
                            <video id="webcam" autoplay style="display: none"></video>
                            <canvas id="output_canvas" width="640" height="480"></canvas>
                        </div>
                    </div>
                </div>

                
                <input type="hidden" id="initialPosition" wire:model="postura_inicial">
                <input type="hidden" id="finalPosition" wire:model="postura_final">
            </div>
        @else
            <p class="text-gray-500">No hay sesiones disponibles.</p>
        @endif
    </div>
</div>



