import { Camera } from '@mediapipe/camera_utils';
import { Pose } from '@mediapipe/pose';

// Elementos del DOM
const videoElement = document.getElementById('webcam');
const canvasElement = document.getElementById('output_canvas');
const canvasCtx = canvasElement.getContext('2d');

// Configura el modelo de pose
const pose = new Pose({
    locateFile: (file) => {
        return `https://cdn.jsdelivr.net/npm/@mediapipe/pose/${file}`;
    }
});

pose.setOptions({
    modelComplexity: 1,
    smoothLandmarks: true,
    enableSegmentation: true,
    smoothSegmentation: true,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5
});

pose.onResults((results) => {
    canvasCtx.save();
    canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
    canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);
    canvasCtx.restore();
});

// Inicializa la cámara
const camera = new Camera(videoElement, {
    onFrame: async () => {
        await pose.send({ image: videoElement });
    },
    width: 640,
    height: 480
});
camera.start();


/*import { Pose } from "@mediapipe/pose";
import { Camera } from "@mediapipe/camera_utils";

document.addEventListener("DOMContentLoaded", function () {
    const videoElement = document.getElementById("webcam");
    const canvasElement = document.getElementById("output_canvas");
    const canvasCtx = canvasElement.getContext("2d");

    const pose = new Pose({
        locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/pose/${file}`,
    });

    pose.setOptions({
        modelComplexity: 1,
        smoothLandmarks: true,
        enableSegmentation: true,
        minDetectionConfidence: 0.5,
        minTrackingConfidence: 0.5,
    });

    pose.onResults((results) => {
        canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
        if (results.poseLandmarks) {
            drawLandmarks(canvasCtx, results.poseLandmarks);
        }
    });

    const camera = new Camera(videoElement, {
        onFrame: async () => {
            await pose.send({ image: videoElement });
        },
        width: 640,
        height: 480,
    });
    camera.start();

    // Capturar posición inicial
    document.getElementById("captureInitialPosition").addEventListener("click", () => {
        if (pose.results?.poseLandmarks) {
            let initialPosition = JSON.stringify(pose.results.poseLandmarks);
            Livewire.emit("setInitialPosition", initialPosition);
        }
    });

    // Capturar posición final
    document.getElementById("captureFinalPosition").addEventListener("click", () => {
        if (pose.results?.poseLandmarks) {
            let finalPosition = JSON.stringify(pose.results.poseLandmarks);
            Livewire.emit("setFinalPosition", finalPosition);
        }
    });
});*/
