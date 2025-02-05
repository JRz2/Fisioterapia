import * as THREE from "three";
import { detectHand } from './hand-tracking.js';

document.addEventListener("DOMContentLoaded", function () {
    init();
});


function init() {
    /*const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    const geometry = new THREE.BoxGeometry();
    const material = new THREE.MeshBasicMaterial({ color: 0xFFFF00 });
    const cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    camera.position.z = 2;

    function animate() {
        requestAnimationFrame(animate);
        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;
        renderer.render(scene, camera);
    }
    animate();*/


    const scene = new THREE.Scene();
    
    //scene.background = new THREE.Color(0x000000); // Negro

    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({
        canvas: document.getElementById("threeprueba"),
        alpha: true
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Crear la malla de puntos de la mano
    const inicio = window.pointsData;
    const points = new Float32Array(inicio.flatMap(p => [p.x, p.y, p.z])); // 21 puntos clave de la mano
    const geometry = new THREE.BufferGeometry();
    geometry.setAttribute("position", new THREE.BufferAttribute(points, 3));

    const material = new THREE.PointsMaterial({
        color: 0xFFFF00,
        size: 0.02,
        vertexColors: false,
    });
    const handMesh = new THREE.Points(geometry, material);
    scene.add(handMesh);

    camera.position.z = 1;

    // Actualizar los puntos desde Livewire
    window.updateHandPoints = (landmarks) => {
        const flatLandmarks = landmarks.flat();
        handMesh.geometry.attributes.position.array.set(flatLandmarks);
        handMesh.geometry.attributes.position.needsUpdate = true;
    };

    // Animar la escena
    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }
    animate();
}


async function setupCameraBackground() {
    const video = document.createElement('video');
    video.setAttribute('autoplay', '');
    video.setAttribute('playsinline', '');
    
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;

        await new Promise((resolve) => {
            video.onloadedmetadata = () => {
                video.play();
                resolve();
            };
        });

        const texture = new THREE.VideoTexture(video);
        texture.minFilter = THREE.LinearFilter;
        texture.magFilter = THREE.LinearFilter;

        const backgroundGeometry = new THREE.PlaneGeometry(2, 2);
        const backgroundMaterial = new THREE.MeshBasicMaterial({ map: texture });

        const backgroundMesh = new THREE.Mesh(backgroundGeometry, backgroundMaterial);
        backgroundMesh.position.z = -1;

        scene.add(backgroundMesh);
    } catch (err) {
        console.log("Error al acceder a la cámara:", err);
    }
}

// 🟢 Crear puntos desde la base de datos
const storedPoints = window.storedPoints || [];
const geometry = new THREE.BufferGeometry();
const vertices = new Float32Array(storedPoints.flatMap(p => [p.x, p.y, p.z]));
geometry.setAttribute('position', new THREE.BufferAttribute(vertices, 3));

const colors = new Float32Array(storedPoints.length * 3);
storedPoints.forEach((_, i) => colors.set([1, 0, 0], i * 3)); // Inicialmente rojo
geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

const material = new THREE.PointsMaterial({ vertexColors: true, size: 0.05 });
const pointsMesh = new THREE.Points(geometry, material);
scene.add(pointsMesh);

camera.position.z = 1;

// 🟢 Actualizar puntos en tiempo real
function updatePoints(detectedPoints) {
    detectedPoints.forEach((point, index) => {
        const storedPoint = storedPoints[index];
        if (!storedPoint) return;

        const distance = Math.sqrt(
            Math.pow(point[0] - storedPoint.x, 2) +
            Math.pow(point[1] - storedPoint.y, 2) +
            Math.pow(point[2] - storedPoint.z, 2)
        );

        if (distance < 0.05) {
            geometry.attributes.color.setXYZ(index, 0, 1, 0); // Verde si coincide
        } else {
            geometry.attributes.color.setXYZ(index, 1, 0, 0); // Rojo si no coincide
        }
    });

    geometry.attributes.color.needsUpdate = true;
}

// Iniciar la animación
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

setupCameraBackground();
detectHand(updatePoints);
animate();

