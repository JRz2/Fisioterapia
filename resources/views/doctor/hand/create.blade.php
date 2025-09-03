@extends('adminlte::page')

@section('title', 'Modelo 3D')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="max-w-4xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">
                Captura de Postura de la Mano
            </h2>

            <p class="text-center text-gray-600 mb-6">
                Utiliza la cámara para capturar la postura inicial y final de la mano.
            </p>

            <div class="flex flex-col lg:flex-row items-center justify-center gap-6">
                <video id="video" width="640" height="480" autoplay class="hidden"></video>

                <canvas id="output_canvas" width="640" height="480" class="border border-gray-300 rounded shadow-md"></canvas>
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-6">
                <button id="captureInitial"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-300">
                    Capturar Postura Inicial
                </button>
                <button id="captureFinal"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-300">
                    Capturar Postura Final
                </button>
            </div>

            <form id="sessionForm" method="POST" action="{{ route('doctor.hand.store') }}"
                {{$sesion}}
                class="mt-8 flex flex-col items-center">
                @csrf
                <input type="hidden" id="postura_inicial" name="postura_inicial">
                <input type="hidden" id="postura_final" name="postura_final">

                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded shadow-md transition duration-300">
                    Guardar
                </button>
            </form>
        </div>
    </x-app-layout>
@stop

@section('css')
    <style>
        canvas {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script>
       
        let posturaInicial = null;
        let posturaFinal = null;
        let currentLandmarks = null;

        const videoElement = document.getElementById('video');
        const canvasElement = document.getElementById('output_canvas');
        const canvasCtx = canvasElement.getContext('2d');

        const hands = new Hands({
            locateFile: (file) => {
                return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
            }
        });
        hands.setOptions({
            maxNumHands: 1,
            modelComplexity: 1,
            minDetectionConfidence: 0.7,
            minTrackingConfidence: 0.5
        });

        hands.onResults(onResults);

        const camera = new Camera(videoElement, {
            onFrame: async () => {
                await hands.send({ image: videoElement });
            },
            width: 640,
            height: 480
        });
        camera.start();

        function onResults(results) {
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
            canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);
            
            if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0) {
                currentLandmarks = results.multiHandLandmarks[0];
                drawConnectors(canvasCtx, currentLandmarks, HAND_CONNECTIONS, { color: '#00FF00', lineWidth: 5 });
                drawLandmarks(canvasCtx, currentLandmarks, { color: '#FF0000', lineWidth: 2 });
            }
            canvasCtx.restore();
        }

        document.getElementById('captureInitial').addEventListener('click', () => {
            if (currentLandmarks) {
                posturaInicial = currentLandmarks;
                alert('¡Postura inicial capturada!');
            } else {
                alert('No se detectó la mano. Intenta de nuevo.');
            }
        });

        document.getElementById('captureFinal').addEventListener('click', () => {
            if (currentLandmarks) {
                posturaFinal = currentLandmarks;
                alert('¡Postura final capturada!');
            } else {
                alert('No se detectó la mano. Intenta de nuevo.');
            }
        });

        document.getElementById('sessionForm').addEventListener('submit', (e) => {
            if (!posturaInicial || !posturaFinal) {
                e.preventDefault();
                alert('Por favor, captura ambas posturas antes de guardar.');
                return false;
            }
            document.getElementById('postura_inicial').value = JSON.stringify(posturaInicial);
            document.getElementById('postura_final').value = JSON.stringify(posturaFinal);
        });
    </script>
@stop
