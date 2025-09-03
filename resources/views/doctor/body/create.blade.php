@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div>
        <h1>Captura de postura</h1>
        <video id="video" width="640" height="480" autoplay muted style="border:1px solid #ccc; position: absolute; z-index: 1;"></video>
        <canvas id="canvas" width="640" height="480" style="position: absolute; z-index: 2; pointer-events: none;"></canvas>
    </div>
    <div>
        <button id="btnInicial">Capturar postura inicial</button>
        <button id="btnFinal">Capturar postura final</button>
    </div>
@stop


@section('css')
    <style>
        video, canvas {
        display: block;
        margin: 10px auto;
        max-width: 100%;
        }
        #capture-buttons {
        text-align: center;
        margin-top: 20px;
        }
    </style>
@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>

<script>
   document.addEventListener('DOMContentLoaded', async () => {
    const video = document.getElementById('video');
    const btnInicial = document.getElementById('btnInicial');
    const btnFinal = document.getElementById('btnFinal');
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    // Validar elementos
    if (!video || !btnInicial || !btnFinal || !canvas) {
        console.error("❌ Elementos HTML no encontrados. Verifica los IDs.");
        return;
    }

    let detector;
    let posturaInicial = null;
    let posturaFinal = null;

    // Inicializar backend y detector
    await tf.setBackend('webgl');
    detector = await poseDetection.createDetector(
        poseDetection.SupportedModels.BlazePose,
        { runtime: 'tfjs', modelType: 'full' }
    );
    console.log("✅ Detector inicializado correctamente");

    // Obtener el stream y esperar a que el video se haya cargado
    navigator.mediaDevices.getUserMedia({ video: { width: 640, height: 480 } })
        .then(stream => {
            video.srcObject = stream;
            video.play();
            video.addEventListener('loadeddata', () => {
                console.log("El stream de video se ha cargado correctamente.");

                // Ahora que el video está listo, comienza a dibujar los puntos
                dibujarPuntos();
            });
        })
        .catch(error => {
            console.error("Error al acceder a la cámara:", error);
        });

    // Función para dibujar los puntos sobre el canvas
    async function dibujarPuntos() {
        // Se verifica que el detector esté definido y que el video tenga dimensiones válidas
        if (!detector || video.videoWidth === 0 || video.videoHeight === 0) {
            requestAnimationFrame(dibujarPuntos);
            return;
        }
        const poses = await detector.estimatePoses(video);
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if (poses.length > 0) {
            const keypoints = poses[0].keypoints;
            keypoints.forEach(kp => {
                if (kp.score > 0.5) {
                    ctx.beginPath();
                    ctx.arc(kp.x, kp.y, 5, 0, 2 * Math.PI);
                    ctx.fillStyle = "red";
                    ctx.fill();
                }
            });
        }
        requestAnimationFrame(dibujarPuntos);
    }

    // Función para capturar la postura
    async function capturarPostura(tipo) {
        // Se puede esperar al stream para asegurar que las dimensiones sean válidas
        if (video.videoWidth === 0 || video.videoHeight === 0) {
            alert("El video aún no está listo.");
            return;
        }

        const poses = await detector.estimatePoses(video);
        if (poses.length > 0) {
            const pose = poses[0];
            if (tipo === 'inicial') {
                posturaInicial = pose;
                alert("✅ Postura inicial capturada");
            } else {
                posturaFinal = pose;
                alert("✅ Postura final capturada");

                await fetch("{{ route('doctor.body.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        post_inicial: posturaInicial,
                        post_final: posturaFinal
                    })
                });

                alert("🧠 Datos guardados correctamente");
            }
        } else {
            alert("⚠️ No se detectó ninguna postura.");
        }
    }

    btnInicial.addEventListener('click', () => capturarPostura('inicial'));
    btnFinal.addEventListener('click', () => capturarPostura('final'));
});

</script>
@endsection
