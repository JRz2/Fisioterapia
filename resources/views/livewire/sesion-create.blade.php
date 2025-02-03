<div>
    <div>
        <x-button 
            wire:click="create" 
            class="text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
            Agregar Sesion
        </x-button> 
        <div class="mt-4">
            <form wire:submit="save">
                <x-dialog-modal wire:model="opencreate" >
                    <x-slot name="title">
                        <div class="text-2xl font-bold text-gray-900 border-b pb-2">
                            NUEVA SESIÓN
                        </div>
                    </x-slot>
                
                    <x-slot name="content">
                        <div >
                            <div>
                                <div>
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Fecha:
                                    </x-label>
                                    <input wire:model="fecha" type="date" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                
                                <div >
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
                                    <input class="form-control" wire:model="ruta" multiple class="form-control"  type="file" id="file" style="display: none;">
                                    <label for="file" style="display: inline-block; padding: 8px 12px; cursor: pointer; background-color: #7a8da1; color: white; border-radius: 4px;">
                                        <span wire:loading wire:target="ruta" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Seleccionar archivos
                                    </label>
                                    <div class="flex gap-2 flex-wrap mt-4 overflow-auto max-h-80">
                                        @if($ruta && is_array($ruta))
                                            @foreach($ruta as $image)
                                                <img src="{{ $image->temporaryUrl() }}" class="w-24 h-24 rounded-lg" alt="Imagen cargada">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>                              

                                <div>
                                    <h1>Evaluacion del movimiento</h1>
                                </div>
                                
                                <div class="flex flex-col items-center mt-4">
                                    <video id="video" autoplay playsinline></video>
                                    <canvas id="outputCanvas"></canvas>
                                    
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


<script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands"></script>




<script>
    const videoElement = document.getElementById('video'); 
    const canvasElement = document.getElementById('outputCanvas');
    const ctx = canvasElement.getContext('2d');

    const hands = new Hands({
  locateFile: (file) => {
    return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
  }
});


    hands.setOptions({
        selfieMode: true,
        maxNumHands: 2,
        minDetectionConfidence: 0.5,
        minTrackingConfidence: 0.5
    });

    hands.onResults(onResults);

    function onResults(results) {
        if (!results.image) return; // Verifica si hay una imagen de entrada

        // Ajustar tamaño del canvas al del video
        canvasElement.width = videoElement.videoWidth;
        canvasElement.height = videoElement.videoHeight;

        ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);
        ctx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

        if (results.multiHandLandmarks) {
            for (const landmarks of results.multiHandLandmarks) {
                drawConnectors(ctx, landmarks, HAND_CONNECTIONS, {color: '#00FF00', lineWidth: 5});
                drawLandmarks(ctx, landmarks, {color: '#FF0000', lineWidth: 2});
            }
        }
    }

    async function startCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            videoElement.srcObject = stream;

            // Esperar a que el video esté listo antes de inicializar la cámara
            videoElement.onloadedmetadata = () => {
                const camera = new Camera(videoElement, {
                    onFrame: async () => {
                        await hands.send({image: videoElement});
                    },
                    width: 640,
                    height: 480
                });
                camera.start();
            };
        } catch (error) {
            console.error("Error al acceder a la cámara:", error);
        }
    }

    startCamera();
</script>
