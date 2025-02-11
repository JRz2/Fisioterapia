@extends('adminlte::page')

@section('title', 'Agregar Sesión')

@section('content_header')
    <h1>Capturar Posturas de la Mano</h1>
@stop

@section('content')
    <p>Utiliza la cámara para capturar la postura inicial y final de la mano.</p>

    <video id="video" width="640" height="480" autoplay style="display: none;"></video>
    
    <canvas id="output_canvas" width="640" height="480" style="border: 1px solid #ccc;"></canvas>
    <br><br>
    
    <button id="captureInitial" class="btn btn-primary">Capturar Postura Inicial</button>
    <button id="captureFinal" class="btn btn-success">Capturar Postura Final</button>
    <br><br>
    
    <form id="sessionForm" method="POST" action="{{ route('doctor.sesion.store') }}">
        @csrf
        <input type="hidden" id="postura_inicial" name="postura_inicial">
        <input type="hidden" id="postura_final" name="postura_final">
        <button type="submit" class="btn btn-warning">Guardar Sesión</button>
    </form>
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
