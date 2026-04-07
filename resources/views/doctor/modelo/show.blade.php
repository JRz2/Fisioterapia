@extends('adminlte::page')

@section('title', 'Análisis Biomecánico 3D')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>🦴 Análisis Biomecánico 3D</h1>
            <p class="mb-0">Paciente: <strong>{{ $paciente->name ?? $paciente->nombre ?? 'N/A' }}</strong> | Sesión: {{ $sesion->codigo ?? 'S001' }}</p>
        </div>
        <a href="{{ route('doctor.consulta.show', $sesion->consulta_id) }}" class="btn btn-secondary">← Volver</a>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>🦴 Modelo Anatómico</h4>
                    <div>
                        <button id="reset-view" class="btn btn-sm btn-secondary">Resetear Vista</button>
                        <button id="toggle-rotate" class="btn btn-sm btn-info">⏸ Pausar Rotación</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="skeleton-container" style="width:100%; height:550px; background:#0a0a1a; border-radius:8px;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>📊 Ángulos de esta sesión</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> <strong>Rodilla Derecha: {{ $angulos['rodilla_d_flexion'] ?? 0 }}°</strong>
                </div>
                
                <div class="mb-3">
                    <label class="fw-bold text-danger">🦵 RODILLA DERECHA</label>
                    <div class="progress" style="height:30px">
                        <div class="progress-bar bg-danger" style="width: {{ (floatval($angulos['rodilla_d_flexion'] ?? 0) / 140 * 100) }}%">
                            {{ $angulos['rodilla_d_flexion'] ?? 0 }}° / 140°
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="fw-bold text-success">🦵 RODILLA IZQUIERDA</label>
                    <div class="progress" style="height:30px">
                        <div class="progress-bar bg-success" style="width: {{ (floatval($angulos['rodilla_i_flexion'] ?? 0) / 140 * 100) }}%">
                            {{ $angulos['rodilla_i_flexion'] ?? 0 }}° / 140°
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <form id="save-measurement">
                    @csrf
                    <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">
                    <div class="mb-3">
                        <label>📋 Notas Clínicas</label>
                        <textarea id="notes" class="form-control" rows="3">{{ $sesion->observacion ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">💾 Guardar Cambios</button>
                </form>
            </div>
        </div>
        
        @if($historial && count($historial) > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h4>📈 Evolución del Paciente</h4>
            </div>
            <div class="card-body">
                <canvas id="evolution-chart" width="100%" height="200"></canvas>
            </div>
        </div>
        @endif
    </div>
</div>

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
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
    
    const angulos = @json($angulos);
    const rodillaDerecha = Number(angulos.rodilla_d_flexion) || 0;
    const rodillaIzquierda = Number(angulos.rodilla_i_flexion) || 0;
    
    console.log('Rodillas:', rodillaDerecha, rodillaIzquierda);
    
    const container = document.getElementById('skeleton-container');
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0x0a0a1a);
    
    // CÁMARA ALEJADA - El modelo mide ~65 unidades de alto
    // La cámara debe estar a unos 40-50 unidades
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(30, 20, 40);
    camera.lookAt(0, 30, 0);
    
    const renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    container.appendChild(renderer.domElement);
    
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 0.8;
    controls.target.set(0, 30, 0);
    controls.enableZoom = true;
    controls.zoomSpeed = 1.5;
    
    // Luces
    const ambientLight = new THREE.AmbientLight(0x404060);
    scene.add(ambientLight);
    
    const mainLight = new THREE.DirectionalLight(0xffffff, 1);
    mainLight.position.set(10, 20, 10);
    scene.add(mainLight);
    
    const fillLight = new THREE.PointLight(0x4466cc, 0.5);
    fillLight.position.set(0, 15, 10);
    scene.add(fillLight);
    
    // Grid de referencia
    const gridHelper = new THREE.GridHelper(60, 20, 0x88aaff, 0x335588);
    gridHelper.position.y = -5;
    scene.add(gridHelper);
    
    // Cargar modelo
    const loader = new GLTFLoader();
    let model = null;
    let bonesMap = {};
    
    const loadingDiv = document.createElement('div');
    loadingDiv.textContent = '🦴 Cargando modelo...';
    loadingDiv.style.cssText = 'position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:white; background:rgba(0,0,0,0.7); padding:10px 20px; border-radius:8px; z-index:100';
    container.appendChild(loadingDiv);
    
    const modelPath = '/models/skeleton_rigged.glb';
    
    loader.load(modelPath, 
        (gltf) => {
            loadingDiv.remove();
            model = gltf.scene;
            
            // ESCALA REDUCIDA - el modelo original es enorme
            // Alto original: 80 unidades, queremos que mida ~8 unidades
            const escala = 0.60;
            model.scale.set(escala, escala, escala);
            model.position.set(0, 8, 80);
            
            console.log('✅ Modelo cargado - Escala:', escala, 'Alto final:', 80 * escala);
            
            // Buscar huesos
            model.traverse((node) => {
                if (node.isMesh) node.castShadow = true;
                if (node.name === 'bone_Leg_R_calf_058_72') bonesMap.tibiaR = node;
                if (node.name === 'bone_Leg_L_calf_055_69') bonesMap.tibiaL = node;
            });
            
            scene.add(model);
            
            // Aplicar rotaciones
            if (bonesMap.tibiaR) {
                bonesMap.tibiaR.rotation.x = -rodillaDerecha * Math.PI / 180;
                console.log(`Rodilla Derecha: ${rodillaDerecha}°`);
            }
            if (bonesMap.tibiaL) {
                bonesMap.tibiaL.rotation.x = -rodillaIzquierda * Math.PI / 180;
                console.log(`Rodilla Izquierda: ${rodillaIzquierda}°`);
            }
            
            // Color rojo para rodilla lesionada
            if (rodillaDerecha < 60 && bonesMap.tibiaR) {
                bonesMap.tibiaR.traverse(child => {
                    if (child.isMesh && child.material) child.material.color.setHex(0xff4444);
                });
            }
            
            // Centrar cámara en el torso
            controls.target.set(0, 8 * escala, 0);
            controls.update();
            
            console.log('✅ Modelo listo - Cámara en:', camera.position);
        },
        (xhr) => {
            const percent = Math.round(xhr.loaded / xhr.total * 100);
            loadingDiv.textContent = `🦴 Cargando... ${percent}%`;
        },
        (error) => {
            console.error('Error:', error);
            loadingDiv.innerHTML = '❌ Error cargando modelo';
        }
    );
    
    // UI
    let autoRotate = true;
    document.getElementById('toggle-rotate').onclick = () => {
        autoRotate = !autoRotate;
        controls.autoRotate = autoRotate;
    };
    
    document.getElementById('reset-view').onclick = () => {
        camera.position.set(30, 20, 40);
        controls.target.set(0, 8, 0);
        controls.update();
    };
    
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }
    animate();
    
    window.addEventListener('resize', () => {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    });
    
    // Guardar
    document.getElementById('save-measurement').addEventListener('submit', async (e) => {
        e.preventDefault();
        const response = await fetch('{{ route("doctor.modelo.update") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ 
                sesion_id: document.querySelector('input[name="sesion_id"]').value, 
                notes: document.getElementById('notes').value 
            })
        });
        const result = await response.json();
        alert(result.success ? '✅ Guardado' : '❌ Error');
    });
</script>

@if($historial && count($historial) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('evolution-chart'), {
        type: 'line',
        data: {
            labels: @json($historial->pluck('fecha')),
            datasets: [
                { label: 'Rodilla Derecha', data: @json($historial->pluck('rodilla_d_flexion')), borderColor: '#ff4444', borderWidth: 3, tension: 0.3, fill: true },
                { label: 'Rodilla Izquierda', data: @json($historial->pluck('rodilla_izquierda')), borderColor: '#44ff44', borderWidth: 3, tension: 0.3, fill: true }
            ]
        },
        options: { responsive: true, scales: { y: { min: 0, max: 160 } } }
    });
</script>
@endif

@endsection