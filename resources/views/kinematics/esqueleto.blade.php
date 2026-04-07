@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">🦴 Análisis Biomecánico 3D</h4>
                            <small>Paciente: <strong>{{ $patient->name }}</strong> | Sesión: {{ $session->date ?? date('Y-m-d') }}</small>
                        </div>
                        <div>
                            <button id="reset-view" class="btn btn-sm btn-secondary">Resetear Vista</button>
                            <button id="toggle-rotate" class="btn btn-sm btn-info">⏸ Pausar Rotación</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="skeleton-canvas" style="width:100%; height:600px; background:linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius:0 0 8px 8px;"></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">📝 Registro de Medición</div>
                <div class="card-body">
                    <form id="save-measurement">
                        @csrf
                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">🦵 Ángulo de Rodilla Derecha</label>
                            <div class="input-group">
                                <input type="number" id="knee-angle-right" class="form-control" step="5" value="0">
                                <span class="input-group-text">°</span>
                            </div>
                            <small class="text-muted">0° = extendida, 140° = flexionada máxima</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">🦵 Ángulo de Rodilla Izquierda</label>
                            <div class="input-group">
                                <input type="number" id="knee-angle-left" class="form-control" step="5" value="0">
                                <span class="input-group-text">°</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">🦴 Ángulo de Cadera</label>
                            <div class="input-group">
                                <input type="number" id="hip-angle" class="form-control" step="5" value="0">
                                <span class="input-group-text">°</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">📋 Notas Clínicas</label>
                            <textarea id="notes" class="form-control" rows="3" placeholder="Dolor, limitaciones, observaciones..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">📸 Estado del paciente</label>
                            <select id="status" class="form-select">
                                <option value="good">✅ Buen progreso</option>
                                <option value="moderate">⚠️ Progreso moderado</option>
                                <option value="poor">❌ Sin mejora significativa</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            💾 Guardar Análisis
                        </button>
                    </form>
                </div>
            </div>
            
            @if($historicalData && count($historicalData) > 0)
            <div class="card mt-3">
                <div class="card-header">📈 Evolución de Rodilla Derecha</div>
                <div class="card-body">
                    <canvas id="evolution-chart" width="100%" height="200"></canvas>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Three.js desde CDN -->
<script type="importmap">
    {
        "imports": {
            "three": "https://unpkg.com/three@0.128.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@0.128.0/examples/jsm/"
        }
    }
</script>

<script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
    import { CSS2DRenderer, CSS2DObject } from 'three/addons/renderers/CSS2DRenderer.js';
    
    // ============ CONFIGURACIÓN INICIAL ============
    const container = document.getElementById('skeleton-canvas');
    const scene = new THREE.Scene();
    scene.background = null; // Transparente para mostrar el gradiente del CSS
    scene.fog = new THREE.FogExp2(0x1a1a2e, 0.008);
    
    // Cámara
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(2.5, 1.8, 3.5);
    camera.lookAt(0, 1, 0);
    
    // Renderers
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setClearColor(0x000000, 0); // Transparente
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);
    
    const labelRenderer = new CSS2DRenderer();
    labelRenderer.setSize(container.clientWidth, container.clientHeight);
    labelRenderer.domElement.style.position = 'absolute';
    labelRenderer.domElement.style.top = '0px';
    labelRenderer.domElement.style.left = '0px';
    labelRenderer.domElement.style.pointerEvents = 'none';
    container.appendChild(labelRenderer.domElement);
    
    // Controles
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 1.2;
    controls.enableZoom = true;
    controls.enablePan = true;
    controls.target.set(0, 1, 0);
    
    // ============ LUCES ============
    // Luz ambiental
    const ambientLight = new THREE.AmbientLight(0x404060);
    scene.add(ambientLight);
    
    // Luz principal direccional
    const mainLight = new THREE.DirectionalLight(0xffffff, 1);
    mainLight.position.set(3, 5, 2);
    mainLight.castShadow = true;
    mainLight.receiveShadow = false;
    scene.add(mainLight);
    
    // Luz de relleno desde abajo
    const fillLight = new THREE.PointLight(0x4466cc, 0.4);
    fillLight.position.set(0, -1, 0);
    scene.add(fillLight);
    
    // Luz cálida desde atrás
    const backLight = new THREE.PointLight(0xffaa66, 0.3);
    backLight.position.set(0, 1.5, -2);
    scene.add(backLight);
    
    // Luz lateral izquierda
    const leftLight = new THREE.PointLight(0x88aaff, 0.3);
    leftLight.position.set(-2, 1, 1);
    scene.add(leftLight);
    
    // Luz lateral derecha
    const rightLight = new THREE.PointLight(0xffaa88, 0.3);
    rightLight.position.set(2, 1, 1);
    scene.add(rightLight);
    
    // ============ ELEMENTOS DE APOYO ============
    // Grid de piso
    const gridHelper = new THREE.GridHelper(6, 20, 0x88aaff, 0x335588);
    gridHelper.position.y = -0.85;
    gridHelper.material.transparent = true;
    gridHelper.material.opacity = 0.4;
    scene.add(gridHelper);
    
    // Círculo base
    const circleGeometry = new THREE.RingGeometry(0.6, 0.9, 32);
    const circleMaterial = new THREE.MeshStandardMaterial({ color: 0x335588, side: THREE.DoubleSide, transparent: true, opacity: 0.3 });
    const circle = new THREE.Mesh(circleGeometry, circleMaterial);
    circle.rotation.x = -Math.PI / 2;
    circle.position.y = -0.84;
    scene.add(circle);
    
    // ============ CONSTRUCCIÓN DEL ESQUELETO ============
    const skeletonGroup = new THREE.Group();
    
    // Materiales
    const boneMaterial = new THREE.MeshStandardMaterial({ color: 0xdd9955, roughness: 0.4, metalness: 0.2 });
    const jointMaterial = new THREE.MeshStandardMaterial({ color: 0xff6666, roughness: 0.3, emissive: 0x331100 });
    const spineMaterial = new THREE.MeshStandardMaterial({ color: 0x88aaff, roughness: 0.5 });
    const cartilageMaterial = new THREE.MeshStandardMaterial({ color: 0xaa8866, roughness: 0.6 });
    
    // Función para crear un hueso cilíndrico
    function createBone(p1, p2, radius = 0.07, material = boneMaterial) {
        const start = new THREE.Vector3(p1.x, p1.y, p1.z);
        const end = new THREE.Vector3(p2.x, p2.y, p2.z);
        const direction = new THREE.Vector3().subVectors(end, start);
        const length = direction.length();
        
        const cylinder = new THREE.Mesh(
            new THREE.CylinderGeometry(radius, radius, length, 12),
            material
        );
        cylinder.position.copy(start.clone().add(end).multiplyScalar(0.5));
        cylinder.quaternion.setFromUnitVectors(
            new THREE.Vector3(0, 1, 0),
            direction.clone().normalize()
        );
        cylinder.castShadow = true;
        return cylinder;
    }
    
    // Función para crear articulación
    function createJoint(position, radius = 0.09, color = 0xff6666) {
        const sphere = new THREE.Mesh(
            new THREE.SphereGeometry(radius, 32, 32),
            new THREE.MeshStandardMaterial({ color: color, roughness: 0.2, emissive: 0x221100 })
        );
        sphere.position.set(position.x, position.y, position.z);
        sphere.castShadow = true;
        return sphere;
    }
    
    // Función para crear etiqueta
    function createLabel(text, position, color = '#ffffff', bgColor = 'rgba(0,0,0,0.7)') {
        const div = document.createElement('div');
        div.textContent = text;
        div.style.color = color;
        div.style.fontSize = '12px';
        div.style.fontWeight = 'bold';
        div.style.textShadow = '1px 1px 0px black';
        div.style.backgroundColor = bgColor;
        div.style.padding = '2px 8px';
        div.style.borderRadius = '20px';
        div.style.border = `1px solid ${color}`;
        div.style.fontFamily = 'sans-serif';
        div.style.backdropFilter = 'blur(4px)';
        
        const label = new CSS2DObject(div);
        label.position.copy(position);
        return label;
    }
    
    // Puntos del esqueleto (coordenadas ajustadas para postura natural)
    const joints = {
        head: new THREE.Vector3(0, 1.75, 0),
        neck: new THREE.Vector3(0, 1.45, 0),
        chest: new THREE.Vector3(0, 1.15, 0),
        hips: new THREE.Vector3(0, 0.85, 0),
        
        leftShoulder: new THREE.Vector3(-0.45, 1.35, -0.05),
        rightShoulder: new THREE.Vector3(0.45, 1.35, -0.05),
        
        leftElbow: new THREE.Vector3(-0.55, 0.95, 0.1),
        rightElbow: new THREE.Vector3(0.55, 0.95, 0.1),
        
        leftWrist: new THREE.Vector3(-0.55, 0.55, 0.15),
        rightWrist: new THREE.Vector3(0.55, 0.55, 0.15),
        
        leftHip: new THREE.Vector3(-0.28, 0.8, 0),
        rightHip: new THREE.Vector3(0.28, 0.8, 0),
        
        leftKnee: new THREE.Vector3(-0.28, 0.25, 0.05),
        rightKnee: new THREE.Vector3(0.28, 0.25, 0.05),
        
        leftAnkle: new THREE.Vector3(-0.22, -0.35, 0.05),
        rightAnkle: new THREE.Vector3(0.22, -0.35, 0.05),
        
        leftFoot: new THREE.Vector3(-0.22, -0.45, 0.2),
        rightFoot: new THREE.Vector3(0.22, -0.45, 0.2)
    };
    
    // Agregar articulaciones
    for (const [name, pos] of Object.entries(joints)) {
        skeletonGroup.add(createJoint(pos, 0.07, 0xff7777));
    }
    
    // Articulaciones principales más grandes
    skeletonGroup.add(createJoint(joints.hips, 0.11, 0xffaa66));
    skeletonGroup.add(createJoint(joints.chest, 0.1, 0xffaa66));
    skeletonGroup.add(createJoint(joints.neck, 0.08, 0xffaa66));
    
    // Columna vertebral
    skeletonGroup.add(createBone(joints.hips, joints.chest, 0.1, spineMaterial));
    skeletonGroup.add(createBone(joints.chest, joints.neck, 0.08, spineMaterial));
    skeletonGroup.add(createBone(joints.neck, joints.head, 0.07, spineMaterial));
    
    // Brazos izquierdos
    skeletonGroup.add(createBone(joints.leftShoulder, joints.leftElbow, 0.07));
    skeletonGroup.add(createBone(joints.leftElbow, joints.leftWrist, 0.06));
    
    // Brazos derechos
    skeletonGroup.add(createBone(joints.rightShoulder, joints.rightElbow, 0.07));
    skeletonGroup.add(createBone(joints.rightElbow, joints.rightWrist, 0.06));
    
    // Cintura escapular
    skeletonGroup.add(createBone(joints.leftShoulder, joints.rightShoulder, 0.06));
    
    // Piernas izquierdas
    skeletonGroup.add(createBone(joints.leftHip, joints.leftKnee, 0.09));
    skeletonGroup.add(createBone(joints.leftKnee, joints.leftAnkle, 0.07));
    skeletonGroup.add(createBone(joints.leftAnkle, joints.leftFoot, 0.05, cartilageMaterial));
    
    // Piernas derechas
    skeletonGroup.add(createBone(joints.rightHip, joints.rightKnee, 0.09));
    skeletonGroup.add(createBone(joints.rightKnee, joints.rightAnkle, 0.07));
    skeletonGroup.add(createBone(joints.rightAnkle, joints.rightFoot, 0.05, cartilageMaterial));
    
    // Cintura pélvica
    skeletonGroup.add(createBone(joints.leftHip, joints.rightHip, 0.08));
    
    scene.add(skeletonGroup);
    
    // ============ ETIQUETAS ============
    scene.add(createLabel('Cabeza', joints.head, '#ff8888'));
    scene.add(createLabel('Hombro I', joints.leftShoulder, '#88ff88'));
    scene.add(createLabel('Hombro D', joints.rightShoulder, '#88ff88'));
    scene.add(createLabel('Codo I', joints.leftElbow, '#88ff88'));
    scene.add(createLabel('Codo D', joints.rightElbow, '#88ff88'));
    scene.add(createLabel('Muñeca I', joints.leftWrist, '#88ff88'));
    scene.add(createLabel('Muñeca D', joints.rightWrist, '#88ff88'));
    scene.add(createLabel('Cadera I', joints.leftHip, '#ffaa44'));
    scene.add(createLabel('Cadera D', joints.rightHip, '#ffaa44'));
    scene.add(createLabel('Rodilla I', joints.leftKnee, '#ffaa44'));
    scene.add(createLabel('Rodilla D', joints.rightKnee, '#ffaa44'));
    scene.add(createLabel('Tobillo I', joints.leftAnkle, '#ffaa44'));
    scene.add(createLabel('Tobillo D', joints.rightAnkle, '#ffaa44'));
    
    // ============ CONTROLES UI ============
    let autoRotate = true;
    document.getElementById('toggle-rotate').addEventListener('click', () => {
        autoRotate = !autoRotate;
        controls.autoRotate = autoRotate;
        document.getElementById('toggle-rotate').textContent = autoRotate ? '⏸ Pausar Rotación' : '▶ Reanudar Rotación';
    });
    
    document.getElementById('reset-view').addEventListener('click', () => {
        camera.position.set(2.5, 1.8, 3.5);
        controls.target.set(0, 1, 0);
        controls.update();
    });
    
    // ============ ANIMACIÓN ============
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
        labelRenderer.render(scene, camera);
    }
    animate();
    
    // ============ RESPONSIVE ============
    window.addEventListener('resize', () => {
        const width = container.clientWidth;
        const height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
        labelRenderer.setSize(width, height);
    });
    
    console.log('✅ Esqueleto 3D cargado exitosamente');
</script>

@if($historicalData && count($historicalData) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const historicalData = @json($historicalData);
    // Filtrar mediciones de rodilla derecha
    const measurements = historicalData.filter(m => m.knee_angle_right || m.knee_angle);
    const dates = measurements.map(m => new Date(m.date).toLocaleDateString());
    const kneeAngles = measurements.map(m => m.knee_angle_right || m.knee_angle);
    
    if (kneeAngles.length > 0) {
        const ctx = document.getElementById('evolution-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Ángulo de Rodilla Derecha (°)',
                    data: kneeAngles,
                    borderColor: '#4caf50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true,
                    pointRadius: 6,
                    pointBackgroundColor: '#4caf50',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { callbacks: { label: (ctx) => `${ctx.raw}°` } }
                },
                scales: { 
                    y: { 
                        min: 0, 
                        max: 160, 
                        title: { display: true, text: 'Grados', font: { weight: 'bold' } },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    },
                    x: { 
                        title: { display: true, text: 'Fecha', font: { weight: 'bold' } },
                        grid: { display: false }
                    }
                }
            }
        });
    }
</script>
@endif

<script>
    document.getElementById('save-measurement').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            session_id: document.querySelector('input[name="session_id"]').value,
            knee_angle_right: document.getElementById('knee-angle-right').value,
            knee_angle_left: document.getElementById('knee-angle-left').value,
            hip_angle: document.getElementById('hip-angle').value,
            notes: document.getElementById('notes').value,
            status: document.getElementById('status').value,
            _token: document.querySelector('input[name="_token"]').value
        };
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Guardando...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('{{ route("kinematics.store") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('✅ Análisis guardado correctamente');
                location.reload();
            } else {
                alert('❌ Error: ' + (result.message || 'No se pudo guardar'));
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Error de conexión con el servidor');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
</script>

<style>
    #skeleton-canvas {
        position: relative;
        overflow: hidden;
    }
    #skeleton-canvas canvas {
        display: block;
    }
    .card {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    input:focus, textarea:focus, select:focus {
        box-shadow: none !important;
        border-color: #4caf50 !important;
    }
</style>

@endsection