// 1️⃣ Crear escena, cámara y renderizador
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('container').appendChild(renderer.domElement);

// 2️⃣ Ajustar cámara
camera.position.z = 300;

// 3️⃣ Crear puntos de las manos
let handPoints = [];  // Guardará los puntos de las manos

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
