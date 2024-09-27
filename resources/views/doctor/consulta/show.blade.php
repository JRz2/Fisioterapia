@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <x-app-layout>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div style="margin: 20px 20px 10px 20px; position: relative;">
                        <a class="mr-5" href="{{ route('doctor.paciente.show', $paciente->id) }}">
                            <i class="fas fa-solid fa-reply-all fa-2x"></i>
                        </a> 
                        Codigo de consulta {{$consulta->codigo}}
                    
                        <a href="{{ route('doctor.reporte.create', $consulta->id) }}" class="btn btn-secondary btn-lg" style="float: right;">
                            <i class="fas fa-file-pdf"></i> Informe
                        </a>                                            
                    </div>
                    
                    <div style="display: flex;  gap:4%; margin:30px; height: 25vh">
                        <div style="width: 30%">
                            <div style="display: flex">
                                <div>
                                    <x-label>
                                        Datos del paciente
                                    </x-label>
                                    <x-label>
                                        Foto
                                    </x-label>
                                    <div style="display: flex">
                                        <div style="width: 50%">
                                            @if ($paciente->imagen)
                                                <img src="{{ asset('storage/' .$paciente->imagen) }}">     
                                            @else
                                                <img src="{{ asset('image/user2.jpg') }}" width="100%">
                                            @endif
                                             
                                        </div>
    
                                        <div style="width: 50%; margin:5px 5px 5px 5px">
                                            <div>
                                                <x-label> Nombre: 
                                                    {{ $paciente->nombre }}
                                                </x-label>
                                            </div>
    
                                            <div>
                                                <x-label> Apellido
                                                    {{ $paciente->paterno }}
                                                </x-label>
                                            </div>
    
                                            <div>
                                                <x-label> Edad: 
                                                    {{ $paciente->edad }}
                                                </x-label>
                                            </div>

                                            <div>
                                                <x-label> Fecha: 
                                                    {{ $consulta->fecha }}
                                                </x-label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($diagnostico)
                        <div style="width: 30%">
                            Diagnóstico
                            <div>
                                <x-textarea class="w-full resize-none" style="height: 150px" disabled>
                                    {{ $diagnostico->diagnostico }}
                                </x-textarea>
                            </div>
                        </div>
                
                        <div style="width: 30%">
                            Plan de tratamiento
                            <div>
                                <x-textarea class="w-full resize-none" style="height: 150px" disabled>
                                    {{ $diagnostico->plan }}
                                </x-textarea>
                            </div>
                        </div>
                        @else
                            <p>No hay diagnóstico disponible para esta consulta.</p>
                        @endif
                    </div>

                    <div style="margin: 30px">
                        <x-label>
                            Imágenes del Examen
                        </x-label>

                        @if($imgexamen)
                            <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 10px">
                                @foreach($imgexamen as $imgExamen)
                                    <a href="{{ asset('storage/' . $imgExamen->ruta) }}" data-lightbox="imagen-1">
                                        <img src="{{ asset('storage/' .$imgExamen->ruta) }}" alt="Imagen de la sesión" style="width: 200px; height: 200px;">
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p>No hay imágenes disponibles para este examen.</p>
                        @endif
                        
                    </div>


                    <div>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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
    
            observer.observe(container, { childList: true, subtree: true });
        }
    
        // Usa Livewire.on para manejar el evento personalizado
        Livewire.on('sesion-created', () => {
            console.log("Evento 'sesion-created' disparado");
            setupMutationObserver();
        });
    
        // Escuchar cuando la página se carga inicialmente
        document.addEventListener('DOMContentLoaded', function () {
            console.log("Página cargada - inicializando Viewer.js");
            initializeViewer();
            setupMutationObserver();
        });
    </script>
    
    
@stop


