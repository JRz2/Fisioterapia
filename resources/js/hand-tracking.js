import { Camera } from '@mediapipe/camera_utils';
import { Hands } from '@mediapipe/hands';

// Elementos del DOM
const videoElement = document.getElementById('webcam');
const canvasElement = document.getElementById('output_canvas');
const canvasCtx = canvasElement.getContext('2d');

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

hands.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

    // Dibuja la imagen de la cámara en el canvas
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

    // Dibuja los landmarks de las manos
    if (results.multiHandLandmarks) {
        for (const landmarks of results.multiHandLandmarks) {
            drawLandmarks(canvasCtx, landmarks);
        }
    }

    canvasCtx.restore();
});

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