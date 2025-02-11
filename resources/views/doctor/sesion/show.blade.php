@extends('adminlte::page')

@section('title', 'Sesión en 3D')

@section('content_header')
    <h1>Visualización 3D de la Sesión</h1>
@stop

@section('content')
    <p>A continuación se muestran las posturas capturadas:</p>
    <div id="threeContainer" style="width: 100%; height: 600px;"></div>
@stop

@section('css')
    <style>
        #threeContainer {
            width: 100%;
            height: 600px;
            background-color: #f0f0f0;
        }
    </style>
@stop

@section('js')
    <script src="https://unpkg.com/three@0.128.0/build/three.min.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://unpkg.com/delaunator@5.0.0/delaunator.min.js"></script>
    <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/SVGLoader.js"></script>

    <script>
        let handMotion = null;
        const initialPostureString = @json($session->postura_inicial);
        const finalPostureString = @json($session->postura_final);
        const initialPosture = JSON.parse(initialPostureString);
        const finalPosture = JSON.parse(finalPostureString);
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

        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf0f0f0);

        
        const gridHelper = new THREE.GridHelper(400, 20);
        scene.add(gridHelper);
        //const axesHelper = new THREE.AxesHelper(200);
        //scene.add(axesHelper);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
        camera.position.set(0, 0, 300);

        const renderer = new THREE.WebGLRenderer({
            antialias: true
        });
        renderer.setSize(window.innerWidth, 600);
        document.getElementById('threeContainer').appendChild(renderer.domElement);

        const controls = new THREE.OrbitControls(camera, renderer.domElement);

        controls.enableDamping = true;
        controls.dampingFactor = 0.25;
        controls.enableZoom = true;

       

        console.log("Initial Posture:", initialPosture);
        console.log("Final Posture:", finalPosture);

        function createPoint(position, color = 0xff0000, radius = 3) {
            const geometry = new THREE.SphereGeometry(radius, 16, 16);
            const material = new THREE.MeshBasicMaterial({
                color: color
            });
            const sphere = new THREE.Mesh(geometry, material);
            sphere.position.copy(position);
            return sphere;
        }

        function createLine(start, end, color = 0x000000) {
            const material = new THREE.LineBasicMaterial({
                color: color
            });
            const points = [];
            points.push(start);
            points.push(end);
            const geometry = new THREE.BufferGeometry().setFromPoints(points);
            const line = new THREE.Line(geometry, material);
            return line;
        }

        function createHand(landmarks, colorPoints = 0xff0000, colorLines = 0x000000) {
            const handGroup = new THREE.Group();
            const points = [];

            landmarks.forEach(function(landmark) {
                let amplification = 2;
                const point = new THREE.Vector3(
                    (landmark.x - 0.5) * scaleFactor * amplification, 
                    -(landmark.y - 0.5) * scaleFactor *
                    amplification, 
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
    if (child.geometry) {
      child.geometry.dispose();
    }
    if (child.material) {
      // Si el material es un array, liberamos cada uno
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
        scene.add(handMotion);
      }

      function createGridTexture(width, height, divisions) {
        // Crear un canvas para dibujar la cuadrícula
        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');

        // Fondo blanco (o del color que prefieras)
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, width, height);

        ctx.strokeStyle = '#cccccc';
        ctx.lineWidth = 1;

        // Calcular los pasos en X y Y
        const stepX = width / divisions;
        const stepY = height / divisions;

        for (let i = 0; i <= divisions; i++) {
            // Dibujar líneas verticales
            ctx.beginPath();
            ctx.moveTo(i * stepX, 0);
            ctx.lineTo(i * stepX, height);
            ctx.stroke();

            // Dibujar líneas horizontales
            ctx.beginPath();
            ctx.moveTo(0, i * stepY);
            ctx.lineTo(width, i * stepY);
            ctx.stroke();

            // Escribir números para indicar las divisiones
            ctx.fillStyle = '#000000';
            ctx.font = '12px Arial';
            // Número en la parte superior (eje X)
            ctx.fillText(i, i * stepX + 2, 12);
            // Número en el lateral (eje Y)
            ctx.fillText(i, 2, i * stepY + 12);
        }

        // Crear la textura a partir del canvas
        const texture = new THREE.CanvasTexture(canvas);
        texture.wrapS = THREE.RepeatWrapping;
        texture.wrapT = THREE.RepeatWrapping;
        return texture;
    }

    // Generar la textura de la cuadrícula
    const gridTexture = createGridTexture(512, 512, 10);

    // Crear un material usando esa textura
    const gridMaterial = new THREE.MeshBasicMaterial({ map: gridTexture, side: THREE.DoubleSide });

    // Crear un plano que servirá de fondo (ajusta el tamaño según tu escena)
    const gridPlane = new THREE.Mesh(new THREE.PlaneGeometry(400, 400), gridMaterial);
    gridPlane.rotation.x = 0; // Alinear horizontalmente
    gridPlane.position.set(0, 0, -150);
    //gridPlane.position.y = -150; // Ubicarlo en un plano inferior o donde prefieras
    scene.add(gridPlane);


        const handInitial = createHand(initialPosture, 0xff0000, 0x880000);
        const handFinal = createHand(finalPosture, 0x00ff00, 0x008800);
        handInitial.position.x = -100;
        handFinal.position.x = 100;
       // scene.add(handInitial);
        //scene.add(handFinal);

        function onResults(results) {
            if (!results.multiHandLandmarks || !window.handModel) return;
            let landmarks = results.multiHandLandmarks[0]; 
        }

        function animate() {
            requestAnimationFrame(animate);
            updateMotionHand();
           // handInitial.rotation.y += 0.01;
           //handFinal.rotation.y += 0.01;
            controls.update();
            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', onWindowResize, false);

        function onWindowResize() {
            camera.aspect = window.innerWidth / 600;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, 600);
        }
    </script>
@stop