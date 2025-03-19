@extends('adminlte::page')

@section('title', 'Sesión en 3D')

@section('content_header')
    <h1>Visualización 3D de la Sesión</h1>
@stop

@section('content')
    <p>Se muestran dos manos: una con la postura inicial y otra con la postura final.</p>
    <div id="webgl-container"></div>
@stop

@section('css')
<style>
    body { margin: 0; overflow: hidden; }
    #webgl-container { width: 100vw; height: 100vh; }
</style>
@stop

@section('js')
    <!-- Incluir Three.js, OrbitControls, GLTFLoader y SkeletonUtils para clonar modelos con esqueletos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/utils/SkeletonUtils.js"></script>
    <script>
        console.log("Iniciando la escena de Three.js");

        // Crear la escena, cámara y renderizador
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xeeeeee);
        console.log("Escena creada");

        const camera = new THREE.PerspectiveCamera(
            75, 
            window.innerWidth / window.innerHeight, 
            0.1, 
            1000
        );
        camera.position.set(0, 1, 5);
        console.log("Cámara creada y posicionada");

        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('webgl-container').appendChild(renderer.domElement);
        console.log("Renderizador creado y añadido al contenedor");

        // Añadir iluminación
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.8);
        scene.add(ambientLight);
        console.log("Luz ambiental añadida");

        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.6);
        directionalLight.position.set(0, 5, 5);
        scene.add(directionalLight);
        console.log("Luz direccional añadida");

        // Controles de la cámara
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.enableZoom = true;
        console.log("Controles de la cámara inicializados");

        // Parsear datos de posturas recibidos desde el backend
        const initialPostureString = @json($session->postura_inicial);
        const finalPostureString = @json($session->postura_final);
        console.log("Postura inicial (raw):", initialPostureString);
        console.log("Postura final (raw):", finalPostureString);
        const initialPosture = JSON.parse(initialPostureString);
        const finalPosture = JSON.parse(finalPostureString);
        console.log("Posturas parseadas correctamente");

        // Bucle de renderizado
        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }

        // Función para crear el mapeo de huesos a landmarks usando los nombres del modelo
        function createMapping(model) {
            return {
                0: model.getObjectByName('pulseR_01'),
                1: model.getObjectByName('thumb_baseR_03'),
                2: model.getObjectByName('thumb_CtrlR_04'),
                3: model.getObjectByName('thumb_Ctrl_02R_06'),
                4: model.getObjectByName('thumb_tipR_048'),
                5: model.getObjectByName('index_baseR_012'),
                6: model.getObjectByName('index_CtrlR_013'),
                7: model.getObjectByName('index_Ctrl_02R_015'),
                8: model.getObjectByName('index_tipR_044'),
                9: model.getObjectByName('middle_baseR_020'),
                10: model.getObjectByName('middle_CtrlR_021'),
                11: model.getObjectByName('middle_Ctrl_02R_023'),
                12: model.getObjectByName('middle_tipR_045'),
                13: model.getObjectByName('ring_baseR_028'),
                14: model.getObjectByName('ring_CtrlR_029'),
                15: model.getObjectByName('ring_Ctrl_02R_031'),
                16: model.getObjectByName('ring_tipR_046'),
                17: model.getObjectByName('pinky_baseR_036'),
                18: model.getObjectByName('pinky_CtrlR_037'),
                19: model.getObjectByName('pinky_Ctrl_02R_039'),
                20: model.getObjectByName('pinky_tipR_047'),
            };
        }

        // Función para aplicar una postura a un modelo usando su mapeo,
        // con logs antes y después de aplicar los valores
        function applyPostureToModel(mapping, posture) {
            for (let i = 0; i < posture.length; i++) {
                const bone = mapping[i];
                if (bone && posture[i]) {
                    console.log(`Antes - Hueso ${i} (${bone.name}) rotation:`, bone.rotation.toArray());
                    bone.rotation.x = posture[i].x;
                    bone.rotation.y = posture[i].y;
                    bone.rotation.z = posture[i].z;
                    console.log(`Después - Hueso ${i} (${bone.name}) rotation:`, bone.rotation.toArray());
                    // Actualizar la matriz del hueso
                    bone.updateMatrixWorld(true);
                } else {
                    console.warn(`No se encontró el hueso para el landmark ${i} o la rotación no está definida`);
                }
            }
            // Actualizar la jerarquía completa (si se conoce un ancestro común)
            if (mapping[0] && mapping[0].parent && mapping[0].parent.parent) {
                mapping[0].parent.parent.updateMatrixWorld(true);
            }
        }

        function updateSkinnedMeshes(model) {
        model.traverse(child => {
            if (child.isSkinnedMesh) {
            // Rebind: actualiza la relación entre la malla y su esqueleto
            child.bind(child.skeleton, child.matrixWorld);
            child.skeleton.update();
            console.log('Actualizado skinned mesh:', child.name);
            }
        });
        }


        // Cargar el modelo 3D de la mano
        console.log("Iniciando carga del modelo 3D");
        const loader = new THREE.GLTFLoader();
        loader.load(
            '/models/test/rigged_hand.glb', // Asegúrate de que esta ruta sea correcta
            function (gltf) {
                console.log("Modelo 3D cargado correctamente");

                if (gltf.animations && gltf.animations.length > 0) {
                console.warn("El modelo tiene animaciones; se detendrán para mostrar la pose estática.");
                const mixer = new THREE.AnimationMixer(gltf.scene);
                gltf.animations.forEach((clip) => {
                const action = mixer.clipAction(clip);
                action.stop(); // Esto detiene la reproducción de la animación
                });
                // No llamamos a mixer.update() en el loop de renderizado, para que las animaciones no se actualicen.
                }
                // Crear la mano para la postura inicial
                const handModelInitial = gltf.scene;
                handModelInitial.scale.set(1, 1, 1);
                handModelInitial.position.x = -1.5; // Posición a la izquierda
                scene.add(handModelInitial);
                console.log("Mano con postura inicial añadida");

                // Clonar la mano para la postura final (con SkeletonUtils para clonar correctamente el esqueleto)
                const handModelFinal = THREE.SkeletonUtils.clone(handModelInitial);
                handModelFinal.position.x = 1.5; // Posición a la derecha
                scene.add(handModelFinal);
                console.log("Mano con postura final añadida");

                // Crear mapeo de huesos para cada modelo
                const mappingInitial = createMapping(handModelInitial);
                const mappingFinal = createMapping(handModelFinal);
                console.log("Mapeos de huesos creados");
                console.log("Mapping Inicial:", mappingInitial);
                console.log("Mapping Final:", mappingFinal);

                // Aplicar la postura inicial a la primera mano
                console.log("Aplicando postura inicial a la primera mano");
                applyPostureToModel(mappingInitial, initialPosture);
                updateSkinnedMeshes(handModelInitial);

                // Aplicar la postura final a la segunda mano
                console.log("Aplicando postura final a la segunda mano");
                applyPostureToModel(mappingFinal, finalPosture);
                updateSkinnedMeshes(handModelFinal);

                // Iniciar el bucle de renderizado
                console.log("Iniciando bucle de animación");
                animate();
            },
            undefined,
            function (error) {
                console.error("Error al cargar el modelo:", error);
            }
        );
    </script>
@stop
