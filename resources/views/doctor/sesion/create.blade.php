@extends('adminlte::page')

@section('title', 'Agregar Sesión')

@section('content_header')
    <h1>Capturar Posturas de la Mano</h1>
@stop

@section('content')
    <p>Utiliza la cámara para capturar la postura inicial y final de la mano.</p>

    <!-- Video de la cámara (se oculta, solo se usa para la entrada de imagen) -->
    <video id="video" width="640" height="480" autoplay style="display: none;"></video>
    
    <!-- Canvas para mostrar el video y los landmarks -->
    <canvas id="output_canvas" width="640" height="480" style="border: 1px solid #ccc;"></canvas>
    <br><br>
    
    <!-- Botones para capturar las posturas -->
    <button id="captureInitial" class="btn btn-primary">Capturar Postura Inicial</button>
    <button id="captureFinal" class="btn btn-success">Capturar Postura Final</button>
    <br><br>
    
    <!-- Formulario para enviar la información -->
    <form id="sessionForm" method="POST" action="{{ route('doctor.sesion.store') }}">
        @csrf
        <input type="hidden" id="postura_inicial" name="postura_inicial">
        <input type="hidden" id="postura_final" name="postura_final">
        <button type="submit" class="btn btn-warning">Guardar Sesión</button>
    </form>
@stop

@section('css')
    <style>
        /* Opcional: estilos para el canvas o botones */
        canvas {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <!-- Carga de librerías de MediaPipe desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    
    <script>
        // Variables globales para almacenar las posturas y los landmarks actuales
        let posturaInicial = null;
        let posturaFinal = null;
        let currentLandmarks = null;

        // Elementos del DOM
        const videoElement = document.getElementById('video');
        const canvasElement = document.getElementById('output_canvas');
        const canvasCtx = canvasElement.getContext('2d');

        // Inicializar MediaPipe Hands
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

        // Función que se llama cada vez que se obtienen resultados de la detección
        hands.onResults(onResults);

        // Configurar la cámara con la utilidad de MediaPipe
        const camera = new Camera(videoElement, {
            onFrame: async () => {
                await hands.send({ image: videoElement });
            },
            width: 640,
            height: 480
        });
        camera.start();

        // Función de callback para procesar los resultados de MediaPipe
        function onResults(results) {
            // Dibujar la imagen de la cámara en el canvas
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
            canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);
            
            // Si se detecta al menos una mano, almacenar y dibujar los landmarks
            if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0) {
                // Almacenamos la primera mano detectada
                currentLandmarks = results.multiHandLandmarks[0];
                // Dibujar conexiones y puntos usando los métodos de Drawing Utils
                drawConnectors(canvasCtx, currentLandmarks, HAND_CONNECTIONS, { color: '#00FF00', lineWidth: 5 });
                drawLandmarks(canvasCtx, currentLandmarks, { color: '#FF0000', lineWidth: 2 });
            }
            canvasCtx.restore();
        }

        // Eventos para capturar las posturas
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

        // Al enviar el formulario, verificar que ambas posturas hayan sido capturadas y asignarlas a los campos ocultos
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
