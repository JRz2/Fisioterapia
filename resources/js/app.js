import './bootstrap';
<<<<<<< HEAD
import * as THREE from 'three';
=======
>>>>>>> 5fc47f13c3b2882d42f29eebf28c7d8775153cbe

import Swal from 'sweetalert2';
import { Hands, HAND_CONNECTIONS } from '@mediapipe/hands';
import { Camera } from '@mediapipe/camera_utils';
import { drawConnectors, drawLandmarks } from '@mediapipe/drawing_utils';
<<<<<<< HEAD
//import './mediapipe.js';
import './hand-tracking.js';
=======
import './mediapipe.js';
//import './hand-tracking.js';
//import './three.js';
>>>>>>> 5fc47f13c3b2882d42f29eebf28c7d8775153cbe
//import './mediapipeholistic.js';
//setupmediapipeholistic();
//import './mediapipe_hands.js';




<<<<<<< HEAD
// 1️⃣ Crear escena, cámara y renderizador de Three.js
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('container').appendChild(renderer.domElement);

// 2️⃣ Posición de la cámara
camera.position.z = 500;

// 3️⃣ Crear puntos de la mano
let handPoints = [];
function createHandPoints() {
    const material = new THREE.PointsMaterial({ color: 0x00ff00, size: 5 });

    for (let i = 0; i < 21; i++) { // 21 puntos de la mano
        const geometry = new THREE.BufferGeometry();
        geometry.setAttribute('position', new THREE.Float32BufferAttribute([0, 0, 0], 3));

        const point = new THREE.Points(geometry, material);
        scene.add(point);
        handPoints.push(point);
    }
}

// 4️⃣ Renderizar la escena
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}
createHandPoints();
animate();

// 5️⃣ Configurar MediaPipe Hands
const hands = new Hands({
    locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`
});

hands.setOptions({
    maxNumHands: 1,
    modelComplexity: 1,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5
});

hands.onResults((results) => {
    if (results.multiHandLandmarks.length > 0) {
        results.multiHandLandmarks.forEach((landmarks) => {
            landmarks.forEach((landmark, index) => {
                const point = handPoints[index];
                if (point) {
                    const position = point.geometry.attributes.position.array;
                    position[0] = (landmark.x - 0.5) * 600; // Escalar en X
                    position[1] = (landmark.y - 0.5) * -600; // Escalar en Y
                    position[2] = landmark.z * -500; // Escalar en Z
                    point.geometry.attributes.position.needsUpdate = true;
                }
            });
        });
    }
});

// 6️⃣ Obtener video de la cámara
const videoElement = document.getElementById("video");

navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
    videoElement.srcObject = stream;
    videoElement.play();
    const camera = new Camera(videoElement, {
        onFrame: async () => {
            await hands.send({ image: videoElement });
        },
        width: 640,
        height: 480
    });
    camera.start();
});
=======

>>>>>>> 5fc47f13c3b2882d42f29eebf28c7d8775153cbe
