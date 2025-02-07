import { Holistic } from '@mediapipe/holistic';
import { Camera } from '@mediapipe/camera_utils';

// Elementos del DOM
const videoElement = document.getElementById('webcam');
const canvasElement = document.getElementById('output_canvas');
const canvasCtx = canvasElement.getContext('2d');
// Supongamos que las posturas están disponibles como variables globales


// Configura el modelo de Holistic
const holistic = new Holistic({
    locateFile: (file) => {
        return `https://cdn.jsdelivr.net/npm/@mediapipe/holistic/${file}`;
    }
});

holistic.setOptions({
    modelComplexity: 1,
    smoothLandmarks: true,
    enableSegmentation: false,
    smoothSegmentation: true,
    refineFaceLandmarks: true,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5
});

// Función para manejar los resultados
holistic.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

    // Dibuja la imagen de la cámara en el canvas
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

    // Dibuja los landmarks de las manos en 3D
    if (results.leftHandLandmarks) {
        drawLandmarks3D(results.leftHandLandmarks, '#00FF00');
    }
    if (results.rightHandLandmarks) {
        drawLandmarks3D(results.rightHandLandmarks, '#FF0000');
    }

    canvasCtx.restore();
});

// Función para dibujar los landmarks en 3D
function drawLandmarks3D(landmarks, color) {
    const radius = 5; // Tamaño de los puntos
    const scale = 100; // Escala para ajustar el tamaño de los puntos en 3D

    landmarks.forEach((landmark) => {
        const x = landmark.x * canvasElement.width;
        const y = landmark.y * canvasElement.height;
        const z = landmark.z * scale;

        // Dibuja un círculo en cada landmark (simulación 3D)
        canvasCtx.beginPath();
        canvasCtx.arc(x, y, radius, 0, 2 * Math.PI);
        canvasCtx.fillStyle = color;
        canvasCtx.fill();
        canvasCtx.strokeStyle = '#FFFFFF';
        canvasCtx.stroke();
    });
}

// Inicializa la cámara
const camera = new Camera(videoElement, {
    onFrame: async () => {
        await holistic.send({ image: videoElement });
    },
    width: 640,
    height: 480
});
camera.start();
