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

                                <div class="flex flex-col items-center mt-4">
                                    <video id="video" class="border rounded-lg" width="640" height="480" autoplay playsinline></video>
                                    <canvas id="output_canvas" class="absolute top-0 left-0"></canvas>
                                </div>
                                
                                
                                <div>
                                    <h1>Evaluacion del movimiento</h1>
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

<script>
    document.addEventListener('livewire:load', function () {
        const video = document.getElementById('video');
        const canvas = document.getElementById('output_canvas');
        const ctx = canvas.getContext('2d');
    
        async function setupCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                video.play(); // Asegurar que el video se reproduzca
            } catch (err) {
                console.error("Error al acceder a la cámara: ", err);
                alert("Por favor, permite el acceso a la cámara.");
            }
        }
    
        async function detectPose() {
            const detector = await poseDetection.createDetector(poseDetection.SupportedModels.MoveNet);
            setInterval(async () => {
                const poses = await detector.estimatePoses(video);
                if (poses.length > 0) {
                    const landmarks = poses[0].keypoints.map(p => ({ x: p.x, y: p.y, score: p.score }));
                    
                    Livewire.emit('postureDetected', landmarks);
    
                    // Ajustar tamaño del canvas al tamaño del video
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    landmarks.forEach(point => {
                        ctx.beginPath();
                        ctx.arc(point.x, point.y, 5, 0, 2 * Math.PI);
                        ctx.fillStyle = 'red';
                        ctx.fill();
                    });
                }
            }, 1000);
        }
    
        setupCamera().then(() => {
            detectPose();
        });
    });
    </script>
    
    