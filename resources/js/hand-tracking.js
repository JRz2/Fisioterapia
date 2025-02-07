import { Camera } from '@mediapipe/camera_utils';
import { Hands } from '@mediapipe/hands';

// Elementos del DOM
const videoElement = document.getElementById('webcam');
const canvasElement = document.getElementById('output_canvas');
const canvasCtx = canvasElement.getContext('2d');

// Inputs para almacenar las coordenadas
const initialPositionInput = document.getElementById('initialPosition');
const finalPositionInput = document.getElementById('finalPosition');

// Configura el modelo de manos
const hands = new Hands({
    locateFile: (file) => {
        return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
    }
});

hands.setOptions({
    maxNumHands: 2, // Número máximo de manos a detectar
    modelComplexity: 1, // Complejidad del modelo (0 o 1)
    minDetectionConfidence: 0.5, // Confianza mínima de detección
    minTrackingConfidence: 0.5 // Confianza mínima de seguimiento
});

// Variable para almacenar las coordenadas
let initialPosition = null;
let finalPosition = null;
let inicio; 

hands.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

    // Dibuja la imagen de la cámara en el canvas
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

    // Dibuja los landmarks de las manos
    if (results.multiHandLandmarks) {
        for (const landmarks of results.multiHandLandmarks) {
            drawLandmarks(canvasCtx, landmarks);

            // Captura la posición del landmark de la muñeca (landmark 0)
            const wrist = landmarks[0];
            //getWristPosition();
            console.log( results.multiHandLandmarks);
            // Si se ha solicitado capturar la posición inicial
            if (captureInitial) {
                initialPosition = { x: wrist.x, y: wrist.y, z: wrist.z };
                initialPositionInput.value = JSON.stringify(initialPosition);
                captureInitial = false;
                console.log(initialPositionInput.value , results.multiHandLandmarks); 
                
                //Livewire.dispatch('updatePosturaInicial', { postura: JSON.stringify(initialPosition) });
                Livewire.dispatch('updatePosturaInicial', { postura: results.multiHandLandmarks });// Reiniciar la bandera
                alert('Posición inicial capturada');
            }

            // Si se ha solicitado capturar la posición final
            if (captureFinal) {
                finalPosition = { x: wrist.x, y: wrist.y, z: wrist.z };
                finalPositionInput.value = JSON.stringify(finalPosition);
                captureFinal = false;
                console.log(finalPositionInput.value);
                Livewire.dispatch('updatePosturaFinal', { postura: results.multiHandLandmarks  }); // Reiniciar la bandera
                alert('Posición final capturada');
            }
        }
    }

    canvasCtx.restore();
});

/*hands.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

    // Dibuja la imagen de la cámara en el canvas
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

    // Dibuja los landmarks de las manos
    if (results.multiHandLandmarks) {
        console.log('Manos detectadas:', results.multiHandLandmarks); // Log para verificar la detección
        for (const landmarks of results.multiHandLandmarks) {
            drawLandmarks(canvasCtx, landmarks);
        }
    } else {
        console.log('No se detectaron manos'); // Log si no se detectan manos
    }

    canvasCtx.restore();
});*/

// Función para obtener la posición de la muñeca
function getWristPosition() {
    const landmarks = hands.lastResults?.multiHandLandmarks?.[0];
    if (landmarks) {
        console.log('Landmarks de la mano:', landmarks); // Log para verificar los landmarks
        return landmarks[0]; // Landmark 0 es la muñeca
    }
    console.log('No se detectaron landmarks'); // Log si no se detectan landmarks
    return null;
}
// Función para dibujar los landmarks de las manos


// Función para dibujar los landmarks de las manos
function drawLandmarks(ctx, landmarks) {
    ctx.fillStyle = '#FF0000'; // Color de los puntos
    ctx.strokeStyle = '#FFFFFF'; // Color de las líneas
    ctx.lineWidth = 1;

    for (const landmark of landmarks) {
        const x = landmark.x * canvasElement.width;
        const y = landmark.y * canvasElement.height;

        // Dibuja un círculo en cada landmark
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
    }
}

// Inicializa la cámara
const camera = new Camera(videoElement, {
    onFrame: async () => {
        await hands.send({ image: videoElement });
    },
    width: 640,
    height: 480
});
camera.start();

// Variables para controlar la captura de posiciones
let captureInitial = false;
let captureFinal = false;

// Botones para capturar posiciones
document.getElementById('captureInitialButton').addEventListener('click', () => {
    captureInitial = true;
});

document.getElementById('captureFinalButton').addEventListener('click', () => {
    captureFinal = true;
});

// Escuchar eventos de Livewire para capturar posiciones
// Escuchar eventos de Livewire para capturar posiciones
Livewire.on('captureInitialPosition', () => {
    const wrist = getWristPosition();
    if (wrist) {
        const initialPosition = { x: wrist.x, y: wrist.y, z: wrist.z };
        console.log('Postura inicial capturada:', initialPosition); // Log para verificar la postura inicial
        document.getElementById('initialPosition').value = JSON.stringify(initialPosition);
        Livewire.dispatch('updatePosturaInicial', { postura: JSON.stringify(initialPosition) });
        console.log('Postura inicial capturada:', initialPosition); 
        alert('Posición inicial capturada');
    } else {
        console.log('No se pudo capturar la postura inicial'); // Log si no se captura la postura
    }
});

Livewire.on('captureFinalPosition', () => {
    const wrist = getWristPosition();
    if (wrist) {
        const finalPosition = { x: wrist.x, y: wrist.y, z: wrist.z };
        console.log('Postura final capturada:', finalPosition); // Log para verificar la postura final
        document.getElementById('finalPosition').value = JSON.stringify(finalPosition);

        Livewire.dispatch('updatePosturaFinal', { postura: JSON.stringify(finalPosition) });
        alert('Posición final capturada');
    } else {
        console.log('No se pudo capturar la postura final'); // Log si no se captura la postura
    }
});