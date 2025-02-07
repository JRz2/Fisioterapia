@extends('adminlte::page')

@section('title', 'Sesión en 3D')

@section('content_header')
    <h1>Visualización 3D de la Sesión</h1>
@stop

@section('content')
    <p>A continuación se muestran las posturas capturadas:</p>
    <!-- Contenedor para la escena 3D -->
    <div id="threeContainer" style="width: 100%; height: 600px;"></div>
@stop

@section('css')
    <style>
        /* Opcional: estilos para el contenedor 3D */
        #threeContainer {
            width: 100%;
            height: 600px;
            background-color: #f0f0f0;
        }
    </style>
@stop

@section('js')
    <!-- Cargar Three.js de la versión 0.128.0 desde unpkg -->
    <script src="https://unpkg.com/three@0.128.0/build/three.min.js"></script>
    <!-- Cargar OrbitControls de la misma versión desde unpkg -->
    <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>


    <script>
        /*****************************************
         * 1. Obtener los datos de la sesión
         *****************************************/
        // Se asume que el controlador pasa la variable $session
        const initialPostureString = @json($session->postura_inicial);
        const finalPostureString = @json($session->postura_final);
        const initialPosture = JSON.parse(initialPostureString);
        const finalPosture = JSON.parse(finalPostureString);
        

        // Factor de escalado para adaptar las coordenadas (ajusta según sea necesario)
        const scaleFactor = 100;

        /*****************************************
         * 2. Definir las conexiones de la mano
         *****************************************/
        // Estas conexiones corresponden a los índices de los puntos en MediaPipe Hands (21 puntos)
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

        /*****************************************
         * 3. Inicializar la escena 3D con three.js
         *****************************************/
        // Crear la escena y establecer un color de fondo
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf0f0f0);

        // Crear la cámara (ajusta el FOV, aspect ratio y planos cercano/lejos según sea necesario)
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
        camera.position.set(0, 0, 300);

        // Crear el renderizador y añadirlo al contenedor
        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, 600);
        document.getElementById('threeContainer').appendChild(renderer.domElement);

        // Agregar controles para poder orbitar la cámara
        const controls = new THREE.OrbitControls(camera, renderer.domElement);



        controls.enableDamping = true;
        controls.dampingFactor = 0.25;
        controls.enableZoom = true;

        /*****************************************
         * 4. Funciones para crear los elementos 3D
         *****************************************/
        // Crea una instancia del loader
        const loader = new THREE.GLTFLoader();
        /*loader.load('/models/hand.glb', function(gltf) {
        scene.add(gltf.scene);
        }, undefined, function(error) {
            console.error('Error al cargar el modelo', error);
        });*/

        // Ajusta la ruta al modelo (por ejemplo, si lo pusiste en public/models/hand.gltf)
        loader.load(
            '/models/hand/scene.gltf',
            function(gltf) {
                const handModel = gltf.scene;
                const model = gltf.scene;
                // Ajusta la escala y posición según lo necesites
                handModel.scale.set(100, 100, 100);
                handModel.position.set(0, -50, 0);
                scene.add(handModel);
                    
                // Si deseas animarlo, puedes guardar la referencia globalmente:
                window.handModel = handModel;
                model.traverse((object) => {
                    if (object.isBone) {
                        console.log("Hueso encontrado:", object.name);
                    }
                })
            },
            function(xhr) {
                // Callback de progreso (opcional)
                console.log( ( xhr.loaded / xhr.total * 100 ) + '% cargado' );
            },
            function(error) {
                console.error('Ocurrió un error al cargar el modelo:', error);
            }
        );

        const boneMapping = {
            "wrist": 0,
            "index1": 5, "index2": 6, "index3": 7, "indexTip": 8,
            "middle1": 9, "middle2": 10, "middle3": 11, "middleTip": 12,
            "ring1": 13, "ring2": 14, "ring3": 15, "ringTip": 16,
            "pinky1": 17, "pinky2": 18, "pinky3": 19, "pinkyTip": 20
        };


        // Función para crear una esfera que representa un landmark
        function createPoint(position, color = 0xff0000, radius = 3) {
            const geometry = new THREE.SphereGeometry(radius, 16, 16);
            const material = new THREE.MeshBasicMaterial({ color: color });
            const sphere = new THREE.Mesh(geometry, material);
            sphere.position.copy(position);
            return sphere;
        }

        // Función para crear una línea entre dos puntos
        function createLine(start, end, color = 0x000000) {
            const material = new THREE.LineBasicMaterial({ color: color });
            const points = [];
            points.push(start);
            points.push(end);
            const geometry = new THREE.BufferGeometry().setFromPoints(points);
            const line = new THREE.Line(geometry, material);
            return line;
        }

        // Función para construir un grupo de objetos que represente la mano
        function createHand(landmarks, colorPoints = 0xff0000, colorLines = 0x000000) {
            const handGroup = new THREE.Group();
            const points = [];

            // Convertir cada landmark en un Vector3 y crear su esfera
            landmarks.forEach(function(landmark) {
                // Convertir las coordenadas normalizadas a un sistema centrado y escalado
                const point = new THREE.Vector3(
                    (landmark.x - 0.5) * scaleFactor,    // Centrar en x
                    -(landmark.y - 0.5) * scaleFactor,   // Invertir y (ya que en pantalla y aumenta hacia abajo) y centrar
                    -landmark.z * scaleFactor            // Escalar z (ajusta si es necesario)
                );
                points.push(point);
                const sphere = createPoint(point, colorPoints);
                handGroup.add(sphere);
            });

            // Dibujar las conexiones entre puntos
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

        /*****************************************
         * 5. Crear los modelos 3D para ambas posturas
         *****************************************/
        // Crear la mano para la postura inicial (en rojo)
        const handInitial = createHand(initialPosture, 0xff0000, 0x880000);
        const handFinal = createHand(finalPosture, 0x00ff00, 0x008800);

        // Agregar ambas manos a la escena
        // Opcional: desplazar ligeramente para diferenciarlas en la vista
        handInitial.position.x = -20;
        handFinal.position.x = 20;
        scene.add(handInitial);
        scene.add(handFinal);

        // Agregar un GridHelper para dar referencia espacial
        const gridHelper = new THREE.GridHelper(400, 20);
        scene.add(gridHelper);


        function onResults(results) {
    if (!results.multiHandLandmarks || !window.handModel) return;

    let landmarks = results.multiHandLandmarks[0]; // Solo tomamos una mano por ahora
    updateHandModel(landmarks, window.handModel); // handModel es el modelo 3D
}

        /*****************************************
         * 6. Función de animación
         *****************************************/
        function animate() {
        requestAnimationFrame(animate);
        
        // Agrega una rotación a las manos para ver la animación
        handInitial.rotation.y += 0.01;
        handFinal.rotation.y += 0.01;
        
        controls.update();
        renderer.render(scene, camera);
    }
    animate();


        // Ajustar el tamaño de la escena al cambiar el tamaño de la ventana
        window.addEventListener('resize', onWindowResize, false);
        function onWindowResize() {
            camera.aspect = window.innerWidth / 600;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, 600);
        }

    </script>
@stop
