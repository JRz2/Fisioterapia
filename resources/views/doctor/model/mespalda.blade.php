@extends('adminlte::page')

@section('title', 'Modelos 3D - Músculos de la Espalda')

@section('content_header')
    <div class="d-md-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="mr-3 d-none d-md-block">
                <div class="bg-light p-3 rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-up fa-2x" style="color: #adb5bd;"></i>
                </div>
            </div>
            <div>
                <h1 class="m-0" style="font-weight: 600; letter-spacing: -0.5px;">
                    Músculos de la Espalda
                </h1>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-cube mr-1"></i>
                    <span>Modelo 3D - Musculatura dorsal</span>
                    <span class="mx-2">•</span>
                    <i class="far fa-star mr-1"></i>
                    <span>Alta resolución</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
<x-app-layout>
    <div class="p-3 p-md-4" style="background: linear-gradient(135deg, #f5f7fa 0%, #e9ecf3 100%); border-radius: 1rem; border: 1px solid rgba(0,0,0,0.05);">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <span class="badge badge-pill badge-primary p-2 shadow-sm">
                    <i class="fas fa-eye mr-1"></i> Vista previa en tiempo real
                </span>
                <span class="badge badge-pill badge-light p-2 ml-2 shadow-sm">
                    <i class="fas fa-sync-alt mr-1"></i> Interactivo
                </span>
                <span class="badge badge-pill badge-light p-2 ml-2 shadow-sm">
                    <i class="fas fa-arrow-up mr-1"></i> Músculos dorsales
                </span>
            </div>
        </div>

        <div class="sketchfab-embed-wrapper" 
            style="position: relative; width: 100%; overflow: hidden; padding-top: 56.25%; border-radius: 16px; box-shadow: 0 20px 35px -8px rgba(255, 159, 67, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08);">
            <iframe 
                title="musculos espalda" 
                frameborder="0" 
                allowfullscreen 
                mozallowfullscreen="true" 
                webkitallowfullscreen="true" 
                allow="autoplay; fullscreen; xr-spatial-tracking" 
                xr-spatial-tracking 
                execution-while-out-of-viewport 
                execution-while-not-rendered 
                web-share
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 16px;" 
                src="https://sketchfab.com/models/eb8d791daff54a788673dc99edec377c/embed">
            </iframe>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="bg-white p-4 rounded-lg shadow-sm" style="border-left: 4px solid #ff9f43;">
                    <h5 class="mb-3" style="color: #d97706;"><i class="fas fa-info-circle mr-2"></i>Anatomía de la espalda</h5>
                    <p class="text-secondary mb-3">Los músculos de la espalda se dividen en tres capas: superficial, intermedia y profunda. Son responsables de la postura, el movimiento de los brazos y la protección de la columna vertebral.</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #d97706;">🔰 Capa superficial</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Trapecio</li>
                                <li>Dorsal ancho</li>
                                <li>Elevador de la escápula</li>
                                <li>Romboides mayor</li>
                                <li>Romboides menor</li>
                            </ul>
                            
                            <h6 class="font-weight-bold mt-2" style="color: #d97706;">⚡ Capa intermedia</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Serrato posterior superior</li>
                                <li>Serrato posterior inferior</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #d97706;">🔬 Capa profunda</h6>
                            <ul class="small text-secondary pl-3">
                                <li><span class="font-weight-bold">Erector de la columna:</span> Iliocostal, Longuísimo, Espinal</li>
                                <li><span class="font-weight-bold">Transversoespinosos:</span> Semiespinoso, Multífido, Rotadores</li>
                                <li><span class="font-weight-bold">Interespinosos</span></li>
                                <li><span class="font-weight-bold">Intertransversarios</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-cog mr-2" style="color: #ff9f43;"></i>
                        <span class="font-weight-bold text-dark">Controles de navegación:</span>
                    </div>
                    <ul class="list-unstyled mt-2 small text-secondary">
                        <li class="mb-2"><i class="fas fa-mouse-pointer mr-2" style="color: #ff9f43;"></i> Rotar: Click + Arrastrar</li>
                        <li class="mb-2"><i class="fas fa-search-plus mr-2" style="color: #ff9f43;"></i> Zoom: Rueda del ratón</li>
                        <li class="mb-2"><i class="fas fa-hand-pointer mr-2" style="color: #ff9f43;"></i> Mover: Click derecho + arrastrar</li>
                        <li><i class="fas fa-undo-alt mr-2" style="color: #ff9f43;"></i> Restaurar vista: Doble click</li>
                    </ul>
                    
                    <hr class="my-2">
                    
                    <div class="mt-2">
                        <span class="font-weight-bold text-dark small">Funciones principales:</span>
                        <div class="d-flex flex-wrap mt-2">
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-arrow-up mr-1"></i> Elevación
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-arrow-down mr-1"></i> Depresión
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-redo-alt mr-1"></i> Rotación
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-arrows-alt-v mr-1"></i> Extensión
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
            <span class="badge badge-light text-dark p-2 mr-2"><i class="far fa-clock mr-1"></i> Actualizado 2024</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-tag mr-1"></i> Anatomía</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-arrow-up mr-1"></i> Espalda</span>
            <span class="badge badge-light text-dark p-2"><i class="fas fa-cube mr-1"></i> 3D Model</span>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-spine text-warning mr-2"></i>
                        <span class="font-weight-bold">Soporte postural</span>
                    </div>
                    <p class="small text-secondary mb-0">Los músculos profundos de la espalda mantienen la columna vertebral erguida y son esenciales para una buena postura.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-dumbbell text-warning mr-2"></i>
                        <span class="font-weight-bold">Movimiento de brazos</span>
                    </div>
                    <p class="small text-secondary mb-0">El dorsal ancho y el trapecio son responsables de mover los brazos hacia atrás y rotar las escápulas.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-shield-alt text-warning mr-2"></i>
                        <span class="font-weight-bold">Protección</span>
                    </div>
                    <p class="small text-secondary mb-0">La musculatura dorsal protege la columna vertebral y los órganos internos del tórax.</p>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #ff9f43;">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-lightbulb fa-2x" style="color: #ff9f43;"></i>
                </div>
                <div>
                    <span class="font-weight-bold" style="color: #d97706;">¿Sabías que...?</span>
                    <p class="text-secondary mb-0 small">El dorsal ancho es el músculo más ancho del cuerpo humano. También se le conoce como "las alas" por su forma cuando está bien desarrollado.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #fff8f0 0%, #ffefe0 100%) !important;
    }
    
    .main-header {
        background: white !important;
        border-bottom: 1px solid rgba(255, 159, 67, 0.1) !important;
    }
    
    .rounded-lg {
        border-radius: 12px !important;
    }
    
    .badge-light {
        background-color: white;
        border: 1px solid rgba(255, 159, 67, 0.2);
        color: #b45309;
    }
    
    .badge-primary {
        background: linear-gradient(45deg, #ff9f43, #ffb347);
        color: white;
        border: none;
    }
    
    .btn-outline-warning {
        color: #ff9f43;
        border-color: #ffd7a5;
        background: white;
    }
    
    .btn-outline-warning:hover {
        background: linear-gradient(45deg, #ff9f43, #ffb347);
        border-color: #ff9f43;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(255, 159, 67, 0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #ff9f43, #ffb347);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #f39023, #ff9f43);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(255, 159, 67, 0.4);
    }
    
    .shadow-sm {
        box-shadow: 0 4px 12px rgba(255, 159, 67, 0.1) !important;
    }
    
    .btn, .badge, .card {
        transition: all 0.3s ease;
    }
    
    .text-secondary {
        color: #4a5568 !important;
    }
    
    .gap-2 {
        gap: 0.5rem;
    }
    
    .bg-white {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.5);
    }
    
    .btn-outline-warning {
        border-radius: 20px;
        padding: 0.25rem 1rem;
        font-size: 0.8rem;
    }
    
    ul.small {
        line-height: 1.7;
    }
    
    .badge-light.badge {
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')
<script>
    $(function () {
        // Tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Efecto hover para el iframe
        $('.sketchfab-embed-wrapper').hover(
            function() {
                $(this).find('iframe').css('box-shadow', '0 25px 40px -10px rgba(255, 159, 67, 0.4)');
            },
            function() {
                $(this).find('iframe').css('box-shadow', '0 20px 35px -8px rgba(255, 159, 67, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08)');
            }
        );
        
        // Animación para los botones
        $('.btn-outline-warning').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@stop