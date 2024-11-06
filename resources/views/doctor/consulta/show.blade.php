@extends('adminlte::page')

@section('title', 'Expediente Clinico')

@section('content_header')
@endsection

@section('content')
    <x-app-layout>
        <div class="card card-dark">
            <div class="card-header">
                <table width=100%>
                    <tr>
                        <td align="left" width=5%>
                            <h1><a class="mr-5 " href="{{ route('doctor.paciente.show', $paciente->id) }}">
                                    <i class="fas fa-solid fa-reply-all fa-2x"></i>
                                </a></h1>
                        </td>
                        <td align="center">
                            <h1 style="font-size: 30px;"> CONSULTA {{ $consulta->codigo }} /  {{ $consulta->fecha }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="row">
                    <a href="{{ route('doctor.reporte.create', $consulta->id) }}">
                        <x-button>
                            <span wire:loading wire:target="doctor.reporte.create" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            <span class="ml-2"><i class="fas fa-file-pdf"></i>
                                &nbsp;&nbsp; Informe
                            </span>
                        </x-button>
                    </a>

                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Paciente</h3>
                            </div>
                            <div class="row card-body">
                                <div class="flex flex-col items-center">
                                    <x-label class="text-lg">
                                        Foto
                                    </x-label>
                                    <div>
                                        @if (strpos($paciente->imagen, 'image/') !== false)
                                            <img src="{{ asset($paciente->imagen) }}" class="rounded-full"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('storage/app/public/' . $paciente->imagen) }}" class="rounded-full"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                                <div class="w-2/4 flex flex-col items-center">
                                    <div>
                                        <x-label class="text-base">
                                            Nombre: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->nombre }}</span>
                                        </x-label>
                                    </div>

                                    <div>
                                        <x-label class="text-base">
                                            Paterno: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->paterno }}</span>
                                        </x-label>
                                    </div>

                                    <div>
                                        <x-label class="text-base">
                                            Materno: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->materno }}</span>
                                        </x-label>
                                    </div>

                                    <div>
                                        <x-label class="text-base">
                                            Edad: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->edad }}</span>
                                        </x-label>
                                    </div>

                                    <div>
                                        <x-label class="text-base">
                                            Celular: <span
                                                class="badge badge-pill font-normal text-base">{{ $paciente->celular }}</span>
                                        </x-label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>
                                    Informes
                                </p>
                                @livewire('ReporteConsulta-datatable', ['consultaId' => $consulta->id])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        @if ($diagnostico && $diagnostico->diagnostico)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Diagnostico</h3>
                                        </div>
                                        <div class="card-body">
                                            <x-textarea class="w-full resize-none" style="height: 150px" disabled>
                                                {{ $diagnostico->diagnostico }}
                                            </x-textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Diagnostico</h3>
                                </div>
                                <div class="row card-body">
                                    <p>No hay diagnóstico disponible para esta consulta.</p>
                                </div>
                            </div>
                        @endif 
                        
                        @if ($diagnostico && $diagnostico->plan)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Plan de tratamiento</h3>
                                        </div>
                                        <div class="card-body">
                                            <x-textarea class="w-full resize-none" style="height: 150px" disabled>
                                                {{ $diagnostico->plan }}
                                            </x-textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Plan de tratamiento</h3>
                                </div>
                                <div class="row card-body">
                                    <p>No hay plan de tratamiento disponible para esta consulta.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mt-6 text-center">
                    <div class="col-md-12">
                        <div class="card card-outline card-secondary">
                            <div class="card-header text-center">
                                <h3 class="card-title">Imágenes del Examen</h3>
                            </div>

                            @if($imgexamen)
                                <div id="gallery-{{ $examen->id }}" class="gallery flex flex-wrap justify-center gap-4 mt-4">
                                    @foreach ($imgexamen as $imgExamen)
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/app/public/' . $imgExamen->ruta) }}" alt="Imagen de la sesión" class="w-32 h-32 rounded-lg shadow-sm" data-original="{{ asset('storage/app/public/' . $imgExamen->ruta) }}">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No hay imágenes disponibles para esta sesión.</p>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row mt-6">
                    <div class="col-md-12">
                        <div class="card card-outline card-secondary">
                            <div class="card-header text-center">
                                <h3 class="card-title">Modificar Sesiones Programadas</h3>
                            </div>
                            @livewire('horario-edit', ['consultaId' => $consulta->id])
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div>
                            @livewire('sesion-create', ['consultaId' => $consulta->id])
                        </div>

                        <div style="width: 70%; margin-left: auto; margin-right:auto">
                            @livewire('index-sesion', ['consultaId' => $consulta->id])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection

@section('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.css">
@endsection

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.js"></script>

    <script>
        // Función para inicializar Viewer.js
        function initializeViewer() {
            console.log("Inicializando Viewer.js...");
            const galleries = document.querySelectorAll('.gallery');

            galleries.forEach(gallery => {
                // Destruir cualquier instancia previa de Viewer.js
                if (gallery.viewerInstance) {
                    gallery.viewerInstance.destroy();
                    console.log("Instancia de Viewer.js destruida");
                }

                // Crear una nueva instancia de Viewer.js
                gallery.viewerInstance = new Viewer(gallery, {
                    url: 'data-original',
                    toolbar: {
                        zoomIn: true,
                        zoomOut: true,
                        oneToOne: true,
                        reset: true,
                        prev: true,
                        next: true,
                    },
                });
                console.log("Nueva instancia de Viewer.js creada");
            });
        }

        // Configurar MutationObserver para detectar cambios en el DOM
        function setupMutationObserver() {
            console.log("Configurando MutationObserver...");
            const container = document.querySelector('.max-w-4xl');

            if (!container) return;

            const observer = new MutationObserver((mutations) => {
                console.log("MutationObserver detectó cambios...");
                setTimeout(() => {
                    initializeViewer();
                    console.log("Viewer.js inicializado después de cambios en el DOM");
                }, 500); // Ajusta el tiempo según sea necesario
            });

            observer.observe(container, {
                childList: true,
                subtree: true
            });
        }

        // Usa Livewire.on para manejar el evento personalizado
        Livewire.on('sesion-created', () => {
            console.log("Evento 'sesion-created' disparado");
            setupMutationObserver();
        });

        // Escuchar cuando la página se carga inicialmente
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Página cargada - inicializando Viewer.js");
            initializeViewer();
            setupMutationObserver();
        });
    </script>


@endsection
