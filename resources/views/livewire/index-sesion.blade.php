<!-- Asegúrate de cargar las librerías de Three.js antes -->
<script src="https://unpkg.com/three@0.128.0/build/three.min.js"></script>
<script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
<script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://unpkg.com/delaunator@5.0.0/delaunator.min.js"></script>
<script src="https://unpkg.com/three@0.128.0/examples/js/loaders/SVGLoader.js"></script>

<div>
    <div class="max-w-4xl mx-auto mt-6">
        @if ($sesiones->isNotEmpty())
            @foreach ($sesiones as $sesion)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4" x-data="{ expanded: false }">
                    <div class="border-b pb-2 mb-2 flex justify-between items-center">
                        <div>
                            <h1 class="font-bold text-xl">{{ $sesion->codigo }}</h1>
                            <span class="text-gray-500">{{ $sesion->fecha }}</span>
                        </div>
                        <!-- Botón para expandir o colapsar -->
                        <button class="text-blue-500 hover:underline focus:outline-none" @click="expanded = !expanded">
                            <span class="px-3 py-2 text-xs font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:no-underline"
                                x-show="!expanded"> <i class="fa fa-eye"> </i></span>
                            <span class="px-3 py-2 text-xs font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 hover:no-underline"
                                x-show="expanded"><i class="fa fa-eye"> </i></span>
                        </button>
                    </div>

                    <!-- Contenido expandible -->
                    <div x-show="expanded" class="space-y-2 mt-2">
                        <p><strong>Síntoma:</strong> {{ $sesion->sintoma }}</p>
                        <p><strong>Observación:</strong> {{ $sesion->observacion }}</p>
                        <p><strong>Recomendación:</strong> {{ $sesion->recomendacion }}</p>
                        <p><strong>Tratamiento:</strong> {{ $sesion->tratamiento }}</p>

                        <!-- Contenedor Three.js con id único -->
                        <div id="threeContainer-{{ $sesion->id }}" style="width: 340px; height: 280px;"></div>

                        
                        <!-- Script para la sesión actual, encapsulado en un IIFE -->
                        <script>
                        (function() {
                            let handMotion = null;
                            const initialPosture = @json($sesion->postura_inicial);
                            const finalPosture = @json($sesion->postura_final);
                            const scaleFactor = 100;
                            
                            const HAND_CONNECTIONS = [
                                [0, 1],
                                [1, 2],
                                [2, 3],
                                [3, 4],
                                [0, 5],
                                [5, 6],
                                [6, 7],
                                [7, 8],
                                [5, 9],
                                [9, 10],
                                [10, 11],
                                [11, 12],
                                [9, 13],
                                [13, 14],
                                [14, 15],
                                [15, 16],
                                [13, 17],
                                [17, 18],
                                [18, 19],
                                [19, 20],
                                [0, 17]
                            ];
                            
                            // Verifica que THREE esté cargado
                            if (typeof THREE === 'undefined') {
                                console.error("THREE is not defined");
                                return;
                            }
                            
                            const scene = new THREE.Scene();
                            scene.background = new THREE.Color(0xf0f0f0);
                            
                            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
                            camera.position.set(0, 0, 300);
                            
                            const renderer = new THREE.WebGLRenderer({ antialias: true });
                            renderer.setSize(window.innerWidth, 600);
                            
                            // Usa el contenedor único
                            const container = document.getElementById('threeContainer-{{ $sesion->id }}');
                            if (!container) {
                                console.error("Contenedor no encontrado para la sesión id: {{ $sesion->id }}");
                                return;
                            }
                            container.appendChild(renderer.domElement);
                            
                            const controls = new THREE.OrbitControls(camera, renderer.domElement);
                            controls.enableDamping = true;
                            controls.dampingFactor = 0.25;
                            controls.enableZoom = true;
                            
                            function createPoint(position, color = 0xff0000, radius = 3) {
                                const geometry = new THREE.SphereGeometry(radius, 16, 16);
                                const material = new THREE.MeshBasicMaterial({ color: color });
                                const sphere = new THREE.Mesh(geometry, material);
                                sphere.position.copy(position);
                                return sphere;
                            }
                            
                            function createLine(start, end, color = 0x000000) {
                                const material = new THREE.LineBasicMaterial({ color: color });
                                const points = [start, end];
                                const geometry = new THREE.BufferGeometry().setFromPoints(points);
                                return new THREE.Line(geometry, material);
                            }
                            
                            function createHand(landmarks, colorPoints = 0xff0000, colorLines = 0x000000) {
                                const handGroup = new THREE.Group();
                                const points = [];
                                landmarks.forEach(function(landmark) {
                                    let amplification = 2;
                                    const point = new THREE.Vector3(
                                        (landmark.x - 0.5) * scaleFactor * amplification,
                                        -(landmark.y - 0.5) * scaleFactor * amplification,
                                        -landmark.z * scaleFactor * amplification
                                    );
                                    points.push(point);
                                    const sphere = createPoint(point, colorPoints);
                                    handGroup.add(sphere);
                                });
                                HAND_CONNECTIONS.forEach(function(connection) {
                                    const startIdx = connection[0];
                                    const endIdx = connection[1];
                                    if (points[startIdx] && points[endIdx]) {
                                        const line = createLine(points[startIdx], points[endIdx], colorLines);
                                        handGroup.add(line);
                                    }
                                });
                                return handGroup;
                            }
                            
                            function interpolateLandmarks(initial, final, t) {
                                let result = [];
                                for (let i = 0; i < initial.length; i++) {
                                    result.push({
                                        x: initial[i].x * (1 - t) + final[i].x * t,
                                        y: initial[i].y * (1 - t) + final[i].y * t,
                                        z: initial[i].z * (1 - t) + final[i].z * t
                                    });
                                }
                                return result;
                            }
                            
                            function disposeHierarchy(node) {
                                node.traverse((child) => {
                                    if (child.geometry) child.geometry.dispose();
                                    if (child.material) {
                                        if (Array.isArray(child.material)) {
                                            child.material.forEach(material => material.dispose());
                                        } else {
                                            child.material.dispose();
                                        }
                                    }
                                });
                            }
                            
                            function updateMotionHand() {
                                const t = (Math.sin(Date.now() * 0.001) + 1) / 2;
                                const intermediateLandmarks = interpolateLandmarks(initialPosture, finalPosture, t);
                                const newHandMotion = createHand(intermediateLandmarks, 0x0000ff, 0x000088);
                                newHandMotion.position.x = 0;
                                if (handMotion) {
                                    disposeHierarchy(handMotion);
                                    scene.remove(handMotion);
                                }
                                handMotion = newHandMotion;
                            }
                            
                            function createGridTexture(width, height, divisions) {
                                const canvas = document.createElement('canvas');
                                canvas.width = width;
                                canvas.height = height;
                                const ctx = canvas.getContext('2d');
                                ctx.fillStyle = '#ffffff';
                                ctx.fillRect(0, 0, width, height);
                                ctx.strokeStyle = '#cccccc';
                                ctx.lineWidth = 1;
                                const stepX = width / divisions;
                                const stepY = height / divisions;
                                for (let i = 0; i <= divisions; i++) {
                                    ctx.beginPath();
                                    ctx.moveTo(i * stepX, 0);
                                    ctx.lineTo(i * stepX, height);
                                    ctx.stroke();
                                    ctx.beginPath();
                                    ctx.moveTo(0, i * stepY);
                                    ctx.lineTo(width, i * stepY);
                                    ctx.stroke();
                                    ctx.fillStyle = '#000000';
                                    ctx.font = '12px Arial';
                                    ctx.fillText(i, i * stepX + 2, 12);
                                    ctx.fillText(i, 2, i * stepY + 12);
                                }
                                const texture = new THREE.CanvasTexture(canvas);
                                texture.wrapS = THREE.RepeatWrapping;
                                texture.wrapT = THREE.RepeatWrapping;
                                return texture;
                            }
                            
                            const gridTexture = createGridTexture(512, 512, 10);
                            const gridMaterial = new THREE.MeshBasicMaterial({ map: gridTexture, side: THREE.DoubleSide });
                            const gridPlane = new THREE.Mesh(new THREE.PlaneGeometry(400, 400), gridMaterial);
                            gridPlane.rotation.x = 0;
                            gridPlane.position.set(0, 0, -150);
                            scene.add(gridPlane);
                            
                            const handInitial = createHand(initialPosture, 0xff0000, 0x880000);
                            const handFinal = createHand(finalPosture, 0x00ff00, 0x008800);
                            handInitial.position.x = -100;
                            handFinal.position.x = 100;
                            scene.add(handInitial);
                            
                            function animate() {
                                requestAnimationFrame(animate);
                                updateMotionHand();
                                controls.update();
                                renderer.render(scene, camera);
                            }
                            
                            animate();
                            
                            window.addEventListener('resize', function onWindowResize() {
                                //camera.aspect = window.innerWidth / 600;
                                camera.updateProjectionMatrix();
                                renderer.setSize(340, 280);

                            }, false);
                        })();
                        </script>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">No hay sesiones disponibles.</p>
        @endif
    </div>
</div>




