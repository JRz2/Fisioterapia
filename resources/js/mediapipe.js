import { Camera } from '@mediapipe/camera_utils';
import { Hands } from '@mediapipe/hands';

// Definir los puntos correctos (estos son solo ejemplos, deberías definir los tuyos)
const correctPositions = [{"x": 0.924799621105194, "y": 0.5940743684768677, "z": 0.0000006684322784167307}, {"x": 0.8520556688308716, "y": 0.43375521898269653, "z": -0.04451765865087509}, {"x": 0.736497700214386, "y": 0.33082395792007446, "z": -0.05338771641254425}, {"x": 0.6316584348678589, "y": 0.27596089243888855, "z": -0.06045865640044212}, {"x": 0.5540947914123535, "y": 0.22899702191352844, "z": -0.06635808199644089}, {"x": 0.593185544013977, "y": 0.4756913483142853, "z": -0.004479484632611275}, {"x": 0.47386837005615234, "y": 0.4565132260322571, "z": -0.025919819250702855}, {"x": 0.39981675148010254, "y": 0.4538232982158661, "z": -0.049831323325634}, {"x": 0.33420664072036743, "y": 0.4543107748031616, "z": -0.06945423781871796}, {"x": 0.5825312733650208, "y": 0.5696244239807129, "z": -0.005023403093218803}, {"x": 0.4464357793331146, "y": 0.5716409087181091, "z": -0.024560023099184036}, {"x": 0.35697224736213684, "y": 0.5716555714607239, "z": -0.04945476353168487}, {"x": 0.28193992376327515, "y": 0.5713911056518555, "z": -0.06874296069145203}, {"x": 0.5981247425079346, "y": 0.6584985256195068, "z": -0.014539365656673908}, {"x": 0.46540552377700806, "y": 0.6868945360183716, "z": -0.042216457426548}, {"x": 0.3780334293842316, "y": 0.6970908641815186, "z": -0.06978896260261536}, {"x": 0.3037635087966919, "y": 0.7022523880004883, "z": -0.08861691504716873}, {"x": 0.6358125805854797, "y": 0.7452012300491333, "z": -0.028995051980018616}, {"x": 0.539941132068634, "y": 0.8072973489761353, "z": -0.06217409670352936}, {"x": 0.4725176990032196, "y": 0.8451956510543823, "z": -0.08313588798046112}, {"x": 0.40749895572662354, "y": 0.874343991279602, "z": -0.09631545841693878}];



// Elementos del DOM
const videoElement = document.getElementById('webcam');
const canvasElement = document.getElementById('output_canvas');
const canvasCtx = canvasElement.getContext('2d');

// Inicializar las posiciones correctas (todas marcadas como incorrectas al principio)
const landmarksStatus = Array(21).fill('incorrecto'); // 'incorrecto' o 'correcto'

// Configura el modelo de MediaPipe Hands
const hands = new Hands({
    locateFile: (file) => {
        return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
    }
});

hands.setOptions({
    maxNumHands: 2,
    modelComplexity: 1,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5
});

// Función para comparar las posiciones
function isPositionCorrect(landmarkIndex, landmarkPosition) {
    const correctPosition = correctPositions[landmarkIndex];
    if (!correctPosition) return false;

    // Comparar las posiciones (puedes ajustar el margen de error)
    const tolerance = 0.05; // Tolerancia para el margen de error (ajústalo según lo que consideres adecuado)
    const distance = Math.sqrt(
        Math.pow(correctPosition.x - landmarkPosition.x, 2) +
        Math.pow(correctPosition.y - landmarkPosition.y, 2)
    );
    return distance <= tolerance; // Retorna verdadero si la distancia es menor que la tolerancia
}

// Función para actualizar el estado de los landmarks
function updateLandmarksStatus(landmarks) {
    landmarks.forEach((landmark, index) => {
        if (isPositionCorrect(index, landmark)) {
            if (landmarksStatus[index] !== 'correcto') {
                landmarksStatus[index] = 'correcto'; // Cambiar el estado a 'correcto'
            }
        } else {
            if (landmarksStatus[index] !== 'incorrecto') {
                landmarksStatus[index] = 'incorrecto'; // Cambiar el estado a 'incorrecto'
            }
        }
    });
}

// Función para dibujar los puntos
function drawLandmarks(ctx, landmarks) {
    ctx.strokeStyle = '#00BFFF'; // Color de las líneas
    ctx.lineWidth = 1;

    // Dibujar los puntos estáticos (correctPositions) en azul al inicio
    for (let i = 0; i < correctPositions.length; i++) {
        const position = correctPositions[i];
        const x = position.x * canvasElement.width;
        const y = position.y * canvasElement.height;

        // Dibuja los puntos estáticos en azul
        ctx.fillStyle = '#0000FF'; // Azul para los puntos estáticos
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
    }

    // Dibujar los puntos de la mano
    for (let i = 0; i < landmarks.length; i++) {
        const landmark = landmarks[i];
        const x = landmark.x * canvasElement.width;
        const y = landmark.y * canvasElement.height;

        // Establecer el color dependiendo del estado del punto
        let pointColor;
        if (landmarksStatus[i] === 'correcto') {
            pointColor = '#00FF00'; // Verde cuando es correcto
        } else if (landmarksStatus[i] === 'incorrecto') {
            pointColor = '#FF0000'; // Rojo cuando es incorrecto
        }

        ctx.fillStyle = pointColor;

        // Dibuja un círculo en cada landmark
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
    }
}

// Función para manejar los resultados de MediaPipe Hands
hands.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

    // Dibuja la imagen de la cámara en el canvas
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

    // Dibuja los landmarks de las manos
    if (results.multiHandLandmarks) {
        for (const landmarks of results.multiHandLandmarks) {
            // Actualiza el estado de los puntos
            updateLandmarksStatus(landmarks);
            // Dibuja los puntos de referencia en el canvas
            drawLandmarks(canvasCtx, landmarks);
        }
    }

    canvasCtx.restore();
});

// Inicializa la cámara
const camera = new Camera(videoElement, {
    onFrame: async () => {
        await hands.send({ image: videoElement });
    },
    width: 640,
    height: 480
});
camera.start();