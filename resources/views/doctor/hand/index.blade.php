@extends('adminlte::page')

@section('title', 'Visualización 3D de Mano con Modelo')

@section('content_header')
    <h1>Visualizar Mano: Postura Inicial y Final</h1>
@stop

@section('content')
    <p>Selecciona una mano para ver su postura inicial y final en 3D, con modelo glTF y superposición de marcadores.</p>

    <div class="form-group">
        <label for="handSelector">Elige una instancia de Hand:</label>
        <select id="handSelector" class="form-control" style="max-width:300px;">
            <option value="">-- Seleccionar mano --</option>
            @foreach($hands as $hand)
                <option value="{{ $hand->id }}">Mano #{{ $hand->id }} (Sesión {{ $hand->sesion_id }})</option>
            @endforeach
        </select>
    </div>

    <div id="viewer-container" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;">
        <div class="card" style="flex:1 1 400px; min-width:300px;">
            <div class="card-header"><h3 class="card-title">Postura Inicial</h3></div>
            <div class="card-body" style="padding:0; position: relative;">
                <div id="canvas-inicial" style="width:100%; height:400px; background:#f0f0f0;"></div>
                <div id="spinner-inicial" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); display:none;">
                    <i class="fas fa-spinner fa-pulse fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="card" style="flex:1 1 400px; min-width:300px;">
            <div class="card-header"><h3 class="card-title">Postura Final</h3></div>
            <div class="card-body" style="padding:0; position: relative;">
                <div id="canvas-final" style="width:100%; height:400px; background:#f0f0f0;"></div>
                <div id="spinner-final" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); display:none;">
                    <i class="fas fa-spinner fa-pulse fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <small>Modelo de mano riggeado por Elena FF (Sketchfab), licencia CC-BY-SA-4.0. Fuente: <a href="https://sketchfab.com/3d-models/rigged-hand-eae97cc2a742413cb5338ab942b12c1e" target="_blank">Sketchfab</a>.</small>
    </div>
@stop

@section('js')
    <script src="https://unpkg.com/three@0.128.0/build/three.min.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

    <script>
    (function(){
        // DEBUG: activa o desactiva depuración visual y logs
        const DEBUG = true;
        function debugLog(...args) {
            if (DEBUG) console.log(...args);
        }

        // Datos de Laravel
        const handsData = {
            @foreach($hands as $hand)
            "{{ $hand->id }}": {
                postura_inicial: @json(json_decode($hand->postura_inicial, true)),
                postura_final:  @json(json_decode($hand->postura_final, true)),
            },
            @endforeach
        };

        // Ajusta nombres de huesos según tu rig
        const LANDMARK_TO_BONE = {
            0: 'pulseR_01',
            1: 'thumb_baseR_03',   2: 'thumb_01R_08',   3: 'thumb_02R_09',   4: 'thumb_03R_010',
            5: 'index_baseR_012',  6: 'index_01R_017',  7: 'index_02R_018',  8: 'index_03R_019',
            9: 'middle_baseR_020', 10: 'middle_01R_025', 11: 'middle_02R_026', 12: 'middle_03R_027',
            13: 'ring_baseR_028',  14: 'ring_01R_033',  15: 'ring_02R_034',  16: 'ring_03R_035',
            17: 'pinky_baseR_036', 18: 'pinky_01R_041', 19: 'pinky_02R_042', 20: 'pinky_03R_043',
        };

        const LANDMARK_PARENT = {
            1:0, 2:1, 3:2, 4:3,
            5:0, 6:5, 7:6, 8:7,
            9:0, 10:9, 11:10, 12:11,
            13:0, 14:13, 15:14, 16:15,
            17:0, 18:17, 19:18, 20:19
        };

        /**
         * Convierte raw points a Vector3, ajusta ejes según convención.
         * Aquí centramos permutación/inversión de ejes en función de tu fuente.
         */
        function processPosturePoints(posturePointsRaw) {
            const arr = posturePointsRaw.map(pt => {
                let v;
                if (Array.isArray(pt)) {
                    v = new THREE.Vector3(pt[0], pt[1], pt[2]);
                } else {
                    // Ejemplo permutación; ajusta según tu fuente:
                    v = new THREE.Vector3(pt.z, pt.y, pt.x);
                }
                // Ajustes de ejes (ejemplo):
                v.y = -v.y;
                v.z = -v.z;
                return v;
            });
            debugLog('processPosturePoints:', arr);
            return arr;
        }

        /**
         * Centrar la nube en landmark 0 (muñeca). NO normalizamos globalmente.
         */
        function centerCloud(posturePoints) {
            if (!posturePoints.length) return posturePoints;
            const center = posturePoints[0].clone();
            posturePoints.forEach(v => v.sub(center));
            debugLog('centerCloud centrado en muñeca:', posturePoints);
            return posturePoints;
        }

        /**
         * Prepara el modelo:
         * - Centra según rootBone
         * - Escala global a desiredSize
         * - Recentra via bounding box
         * - Añade helpers si DEBUG
         */
        function prepareModel(scene, skeleton, model, desiredSize=2) {
            // Centrar según rootBone
            const rootBoneName = LANDMARK_TO_BONE[0];
            const rootBone = skeleton.getBoneByName(rootBoneName);
            if (rootBone) {
                if (DEBUG) {
                    debugLog('Jerarquía desde rootBone:', rootBoneName);
                    (function printHierarchy(bone, depth=0){
                        debugLog(' '.repeat(depth*2) + bone.name);
                        bone.children.forEach(ch => { if (ch.isBone) printHierarchy(ch, depth+1); });
                    })(rootBone, 0);
                }
                model.updateMatrixWorld(true);
                rootBone.updateMatrixWorld(true);
                const rootWorldPos = new THREE.Vector3();
                rootBone.getWorldPosition(rootWorldPos);
                debugLog('rootWorldPos antes centrar:', rootWorldPos);
                model.position.sub(rootWorldPos);
                model.updateMatrixWorld(true);
                rootBone.getWorldPosition(rootWorldPos);
                debugLog('rootWorldPos tras centrar:', rootWorldPos);
            } else {
                console.warn('prepareModel: rootBone no encontrado:', rootBoneName);
            }

            // Escalar global
            model.updateMatrixWorld(true);
            let box = new THREE.Box3().setFromObject(model);
            const size = new THREE.Vector3();
            box.getSize(size);
            const maxDim = Math.max(size.x, size.y, size.z);
            if (maxDim > 0) {
                const scale = desiredSize / maxDim;
                model.scale.setScalar(scale);
                debugLog('prepareModel: escala aplicada:', scale);
            }
            model.updateMatrixWorld(true);

            // Recentrar via bounding box
            model.updateMatrixWorld(true);
            box = new THREE.Box3().setFromObject(model);
            const centerBox = box.getCenter(new THREE.Vector3());
            debugLog('prepareModel: bounding box center antes recenter:', centerBox);
            if (DEBUG) {
                scene.add(new THREE.Box3Helper(box, 0xffff00));
            }
            model.position.sub(centerBox);
            model.updateMatrixWorld(true);
            if (DEBUG) {
                box = new THREE.Box3().setFromObject(model);
                debugLog('prepareModel: bounding box tras recenter:', box.min, box.max);
                scene.add(new THREE.Box3Helper(box, 0x00ffff));
                model.add(new THREE.AxesHelper(0.5));
            }
            return model;
        }

        /**
         * Calcula defaultBoneVectors en bind pose: dirección padre→hijo en espacio local.
         */
        function computeDefaultBoneVectors(skeleton) {
            const defaultBoneVectors = {};
            skeleton.bones.forEach(bone => {
                const childBones = bone.children.filter(n => n.isBone && skeleton.bones.includes(n));
                if (childBones.length === 1) {
                    const childBone = childBones[0];
                    bone.updateMatrixWorld(true);
                    childBone.updateMatrixWorld(true);
                    const pWorld = new THREE.Vector3(), cWorld = new THREE.Vector3();
                    bone.getWorldPosition(pWorld);
                    childBone.getWorldPosition(cWorld);
                    const childLocal = bone.worldToLocal(cWorld.clone());
                    const parentLocal = bone.worldToLocal(pWorld.clone());
                    const dirLocal = childLocal.clone().sub(parentLocal).normalize();
                    defaultBoneVectors[bone.name] = dirLocal;
                }
            });
            debugLog('defaultBoneVectors:', defaultBoneVectors);
            return defaultBoneVectors;
        }

        /**
         * Aplica pose al rig usando únicamente direcciones unitarias desiredDirLocal
         * Calculadas de posturePointsScaled (aquí posturePoints centrados).
         */
                function applyPoseToRig(skeleton, defaultBoneVectors, posturePointsCentered) {
            const bindQuaternions = {};
            skeleton.bones.forEach(bone => {
                bindQuaternions[bone.name] = bone.quaternion.clone();
            });
            for (const [childIdxStr, parentIdx] of Object.entries(LANDMARK_PARENT)) {
                const childIdx = parseInt(childIdxStr, 10);
                const boneName = LANDMARK_TO_BONE[childIdx];
                const parentName = LANDMARK_TO_BONE[parentIdx];
                if (!boneName || !parentName) {
                    console.warn('applyPoseToRig: falta mapping', childIdx, parentIdx);
                    continue;
                }
                const bone = skeleton.getBoneByName(boneName);
                const parentBone = skeleton.getBoneByName(parentName);
                if (!bone || !parentBone) {
                    console.warn('applyPoseToRig: bone no encontrado', boneName, parentName);
                    continue;
                }
                const targetWorldParent = posturePointsCentered[parentIdx].clone();
                const targetWorldChild = posturePointsCentered[childIdx].clone();
                parentBone.updateMatrixWorld(true);
                const targetLocalParent = parentBone.worldToLocal(targetWorldParent.clone());
                const targetLocalChild  = parentBone.worldToLocal(targetWorldChild.clone());
                const desiredDirLocal = targetLocalChild.clone().sub(targetLocalParent).normalize();
                const defaultDirLocal = defaultBoneVectors[boneName];
                if (!defaultDirLocal || desiredDirLocal.length() < 1e-6) {
                    if (DEBUG) debugLog('applyPoseToRig: saltando', boneName);
                    continue;
                }
                const quatDir = new THREE.Quaternion().setFromUnitVectors(defaultDirLocal, desiredDirLocal);
                bone.quaternion.copy(quatDir);
                // bone.quaternion.copy(bindQuaternions[boneName].clone().multiply(quatDir));
                if (DEBUG) debugLog(`applyPoseToRig ${boneName}:`, { defaultDirLocal, desiredDirLocal, quatDir });
            }
            if (DEBUG) debugLog('applyPoseToRig: terminado');
        }

        /**
         * Dibuja nubes de depuración (esferas y líneas) si DEBUG=true.
         */
        function drawDebugCloud(scene, posturePoints, sphereColor, lineColor) {
            if (!DEBUG) return null;
            const group = new THREE.Group();
            const mat = new THREE.MeshBasicMaterial({ color: sphereColor });
            posturePoints.forEach(v => {
                const s = new THREE.Mesh(new THREE.SphereGeometry(0.02,16,16), mat);
                s.position.copy(v);
                group.add(s);
            });
            const HAND_CONNECTIONS = [
                [0,1],[1,2],[2,3],[3,4],
                [0,5],[5,6],[6,7],[7,8],
                [0,9],[9,10],[10,11],[11,12],
                [0,13],[13,14],[14,15],[15,16],
                [0,17],[17,18],[18,19],[19,20]
            ];
            HAND_CONNECTIONS.forEach(([i,j]) => {
                if (i < posturePoints.length && j < posturePoints.length) {
                    const geom = new THREE.BufferGeometry().setFromPoints([posturePoints[i], posturePoints[j]]);
                    const line = new THREE.Line(geom, new THREE.LineBasicMaterial({ color: lineColor }));
                    group.add(line);
                }
            });
            scene.add(group);
            debugLog('drawDebugCloud color', sphereColor);
            return group;
        }

        /**
         * Crea el viewer en containerId, sin normalizar globalmente la nube.
         */
        function createHandPoseViewer(containerId, posturePointsRaw) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';

            // Escena, renderer, cámara, controles
            const scene = new THREE.Scene();
            const renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setClearColor(0x333333);
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);

            const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.01, 100);
            camera.position.set(0, 0, 5);
            camera.lookAt(0, 0, 0);
            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.target.set(0, 0, 0);
            controls.update();

            // Iluminación y helpers base
            scene.add(new THREE.AmbientLight(0xffffff, 1.0));
            const dirLight = new THREE.DirectionalLight(0xffffff, 0.8);
            dirLight.position.set(1, 2, 3);
            scene.add(dirLight);
            if (DEBUG) {
                scene.add(new THREE.AxesHelper(1.5));
                scene.add(new THREE.GridHelper(5, 10));
                const originSphere = new THREE.Mesh(
                    new THREE.SphereGeometry(0.05, 16, 16),
                    new THREE.MeshBasicMaterial({ color: 0x00ff00 })
                );
                originSphere.position.set(0, 0, 0);
                scene.add(originSphere);
            }

            // 1) Procesar y centrar nube (sin normalizar escala)
            let posturePoints = processPosturePoints(posturePointsRaw);
            posturePoints = centerCloud(posturePoints);

            // 2) Cargar modelo glTF
            const loader = new THREE.GLTFLoader();
            loader.load('/models/Mano/scene.gltf',
                (gltf) => {
                    debugLog('Modelo cargado');
                    const model = gltf.scene;
                    scene.add(model);

                    // Encontrar SkinnedMesh
                    let skinnedMesh = null;
                    model.traverse(n => { if (n.isSkinnedMesh) skinnedMesh = n; });
                    if (!skinnedMesh) {
                        console.warn('No se encontró SkinnedMesh');
                        return;
                    }
                    const skeleton = skinnedMesh.skeleton;

                    // 2.1) Preparar modelo: centrar por bone, escalar, recenter bounding box
                    prepareModel(scene, skeleton, model);

                    // 2.2) Dibujar nube bind pose (rojo/verde)
                    const debugBind = drawDebugCloud(scene, posturePoints, 0xff0000, 0x00ff00);

                    // 2.3) Calcular defaultBoneVectors
                    const defaultBoneVectors = computeDefaultBoneVectors(skeleton);
                    // 2.4) Aplicar pose usando posturePoints centrados
                    applyPoseToRig(skeleton, defaultBoneVectors, posturePoints);

                    // 2.5) Ajuste final offset nube-modelo si DEBUG
                    if (DEBUG) {
                        let centroNube = new THREE.Vector3();
                        posturePoints.forEach(v => centroNube.add(v));
                        centroNube.multiplyScalar(1.0 / posturePoints.length);
                        debugLog('centroNube:', centroNube);

                        let box2 = new THREE.Box3().setFromObject(model);
                        let centroMalla = box2.getCenter(new THREE.Vector3());
                        debugLog('centroMalla tras pose:', centroMalla);

                        const diff = centroNube.clone().sub(centroMalla);
                        debugLog('Offset nube vs malla:', diff);
                        if (diff.length() > 1e-3) {
                            model.position.add(diff);
                            model.updateMatrixWorld(true);
                            debugLog('Se aplicó ajuste final de posición');
                        }
                    }

                    // 2.6) Dibujar nube post-pose (magenta)
                    const debugPost = drawDebugCloud(scene, posturePoints, 0xff00ff, 0xff00ff);

                    // Opcional: si tras validar quieres ocultar nubes:
                    // scene.remove(debugBind); scene.remove(debugPost);
                },
                undefined,
                (err) => {
                    console.error('Error cargando glTF:', err);
                }
            );

            // Render loop
            function animate() {
                requestAnimationFrame(animate);
                renderer.render(scene, camera);
            }
            animate();

            // Resize
            window.addEventListener('resize', () => {
                const w = container.clientWidth, h = container.clientHeight;
                if (w && h) {
                    camera.aspect = w / h;
                    camera.updateProjectionMatrix();
                    renderer.setSize(w, h);
                }
            });
        }

        // Listener selector
        document.addEventListener('DOMContentLoaded', () => {
            const selector = document.getElementById('handSelector');
            if (!selector) return;
            selector.addEventListener('change', () => {
                const id = selector.value;
                debugLog('Mano seleccionada', id);
                document.getElementById('canvas-inicial').innerHTML = '';
                document.getElementById('canvas-final').innerHTML = '';
                if (!id || !handsData[id]) return;
                createHandPoseViewer('canvas-inicial', handsData[id].postura_inicial || []);
                createHandPoseViewer('canvas-final',  handsData[id].postura_final  || []);
            });
            if (selector.options.length > 1) {
                selector.selectedIndex = 1;
                selector.dispatchEvent(new Event('change'));
            }
        });
    })();
    </script>
@stop
