import { Camera } from '@mediapipe/camera_utils';
import { Hands } from '@mediapipe/hands';
import '@tensorflow/tfjs';
import * as handpose from '@tensorflow-models/handpose';
import * as THREE from "three";
import { detectHand } from './hand-tracking.js';

// Elementos del DOM
let parametro = [{"x": 0.924799621105194, "y": 0.5940743684768677, "z": 0.0000006684322784167307}, {"x": 0.8520556688308716, "y": 0.43375521898269653, "z": -0.04451765865087509}, {"x": 0.736497700214386, "y": 0.33082395792007446, "z": -0.05338771641254425}, {"x": 0.6316584348678589, "y": 0.27596089243888855, "z": -0.06045865640044212}, {"x": 0.5540947914123535, "y": 0.22899702191352844, "z": -0.06635808199644089}, {"x": 0.593185544013977, "y": 0.4756913483142853, "z": -0.004479484632611275}, {"x": 0.47386837005615234, "y": 0.4565132260322571, "z": -0.025919819250702855}, {"x": 0.39981675148010254, "y": 0.4538232982158661, "z": -0.049831323325634}, {"x": 0.33420664072036743, "y": 0.4543107748031616, "z": -0.06945423781871796}, {"x": 0.5825312733650208, "y": 0.5696244239807129, "z": -0.005023403093218803}, {"x": 0.4464357793331146, "y": 0.5716409087181091, "z": -0.024560023099184036}, {"x": 0.35697224736213684, "y": 0.5716555714607239, "z": -0.04945476353168487}, {"x": 0.28193992376327515, "y": 0.5713911056518555, "z": -0.06874296069145203}, {"x": 0.5981247425079346, "y": 0.6584985256195068, "z": -0.014539365656673908}, {"x": 0.46540552377700806, "y": 0.6868945360183716, "z": -0.042216457426548}, {"x": 0.3780334293842316, "y": 0.6970908641815186, "z": -0.06978896260261536}, {"x": 0.3037635087966919, "y": 0.7022523880004883, "z": -0.08861691504716873}, {"x": 0.6358125805854797, "y": 0.7452012300491333, "z": -0.028995051980018616}, {"x": 0.539941132068634, "y": 0.8072973489761353, "z": -0.06217409670352936}, {"x": 0.4725176990032196, "y": 0.8451956510543823, "z": -0.08313588798046112}, {"x": 0.40749895572662354, "y": 0.874343991279602, "z": -0.09631545841693878}];
const videoElement = document.getElementById('webcam');
const videoElement1 = document.getElementById('input_video');
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

const hands1 = new Hands({
    locateFile1: (file1) => {
        return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file1}`;
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
    ctx.strokeStyle = '#00BFFF'; // Color de las líneas
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






// Variables para controlar la captura de posiciones
let captureInitial = false;
let captureFinal = false;

// Botones para capturar posiciones
document.getElementById('captureInitialButton').addEventListener('click', () => {
    captureInitial = true;
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
