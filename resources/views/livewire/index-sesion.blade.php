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
                        <button class="text-blue-500 hover:underline focus:outline-none" @click="expanded = !expanded">
                            <span
                                class="px-3 py-2 text-xs font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:no-underline"
                                x-show="!expanded"> <i class="fa fa-eye"> </i></span>
                            <span
                                class="px-3 py-2 text-xs font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 hover:no-underline"
                                x-show="expanded"><i class="fa fa-eye"> </i></span>
                        </button>
                    </div>
                    <div x-show="expanded" class="space-y-2 mt-2">
                        <p><strong>Síntoma:</strong> {{ $sesion->sintoma }}</p>
                        <p><strong>Observación:</strong> {{ $sesion->observacion }}</p>
                        <p><strong>Recomendación:</strong> {{ $sesion->recomendacion }}</p>
                        <p><strong>Tratamiento:</strong> {{ $sesion->tratamiento }}</p>

                        @foreach ($imagenes as $img)
                            <img src="{{ asset('storage/' . $img->ruta) }}" class="w-20 h-20 object-cover rounded">
                        @endforeach

                        <p> <strong>AGREGAR MODELOS 3D</strong></p>
                        <a class="btn btn-success" href="{{ route('doctor.hand.create', $sesion->id) }}">MODELO
                            MANO</a>
                        <a class="btn btn-success" href="{{ route('doctor.body.create', $sesion->id) }}">MODELO
                            CUERPO</a>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">No hay sesiones disponibles.</p>
        @endif
    </div>
</div>
