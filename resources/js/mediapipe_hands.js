
import { Hands } from "@mediapipe/hands";
import { Camera } from "@mediapipe/camera_utils";

const videoElement = document.createElement("video");
document.body.appendChild(videoElement);
videoElement.style.display = "none"; // Ocultar video

const hands = new Hands({
  locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`,
});

hands.setOptions({
  maxNumHands: 2,
  modelComplexity: 1,
  minDetectionConfidence: 0.5,
  minTrackingConfidence: 0.5,
});

// Callback cuando detecta manos
hands.onResults((results) => {
  if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0) {
    const coordenadas = results.multiHandLandmarks[0].map((landmark) => ({
      x: landmark.x,
      y: landmark.y,
      z: landmark.z,
    }));

    // Enviar coordenadas a Livewire en Laravel
    Livewire.emit("actualizarCoordenadasMano", JSON.stringify(coordenadas));
  }
});

// Iniciar la cámara
const camera = new Camera(videoElement, {
  onFrame: async () => {
    await hands.send({ image: videoElement });
  },
  width: 640,
  height: 480,
});
camera.start();
