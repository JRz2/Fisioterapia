@extends('adminlte::page')

@section('title', 'Modelos 3D - Músculos del Antebrazo')

@section('content_header')
    <div class="d-md-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="mr-3 d-none d-md-block">
                <div class="bg-light p-3 rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-hand-paper fa-2x" style="color: #adb5bd;"></i>
                </div>
            </div>
            <div>
                <h1 class="m-0" style="font-weight: 600; letter-spacing: -0.5px;">
                    Músculos del Antebrazo
                </h1>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-cube mr-1"></i>
                    <span>Modelo 3D - Musculatura del antebrazo</span>
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
                    <i class="fas fa-hand-paper mr-1"></i> Antebrazo
                </span>
            </div>
        </div>

        <div class="sketchfab-embed-wrapper" 
            style="position: relative; width: 100%; overflow: hidden; padding-top: 56.25%; border-radius: 16px; box-shadow: 0 20px 35px -8px rgba(79, 195, 247, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08);">
            <iframe 
                title="musculos antebrazo" 
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
                src="https://sketchfab.com/models/da48e20b474d41efb8567e1454bbf67b/embed">
            </iframe>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="bg-white p-4 rounded-lg shadow-sm" style="border-left: 4px solid #4fc3f7;">
                    <h5 class="mb-3" style="color: #0288d1;"><i class="fas fa-info-circle mr-2"></i>Anatomía del antebrazo</h5>
                    <p class="text-secondary mb-3">El antebrazo contiene múltiples músculos divididos en compartimentos anterior (flexores) y posterior (extensores). Estos músculos controlan los movimientos de la muñeca, la mano y los dedos.</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #0288d1;">🤲 Compartimento anterior (Flexores)</h6>
                            <ul class="small text-secondary pl-3">
                                <li><span class="font-weight-bold">Capa superficial:</span></li>
                                <li>Pronador redondo</li>
                                <li>Flexor radial del carpo</li>
                                <li>Palmar largo</li>
                                <li>Flexor ulnar del carpo</li>
                                <li><span class="font-weight-bold">Capa intermedia:</span></li>
                                <li>Flexor superficial de los dedos</li>
                                <li><span class="font-weight-bold">Capa profunda:</span></li>
                                <li>Flexor profundo de los dedos</li>
                                <li>Flexor largo del pulgar</li>
                                <li>Pronador cuadrado</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #0288d1;">👆 Compartimento posterior (Extensores)</h6>
                            <ul class="small text-secondary pl-3">
                                <li><span class="font-weight-bold">Capa superficial:</span></li>
                                <li>Braqiorradial</li>
                                <li>Extensor radial largo del carpo</li>
                                <li>Extensor radial corto del carpo</li>
                                <li>Extensor de los dedos</li>
                                <li>Extensor del meñique</li>
                                <li>Extensor ulnar del carpo</li>
                                <li><span class="font-weight-bold">Capa profunda:</span></li>
                                <li>Supinador</li>
                                <li>Abductor largo del pulgar</li>
                                <li>Extensor corto del pulgar</li>
                                <li>Extensor largo del pulgar</li>
                                <li>Extensor del índice</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="bg-white p-3 rounded-lg shadow-sm h-50">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-cog mr-2" style="color: #4fc3f7;"></i>
                        <span class="font-weight-bold text-dark">Controles de navegación:</span>
                    </div>
                    <ul class="list-unstyled mt-2 small text-secondary">
                        <li class="mb-2"><i class="fas fa-mouse-pointer mr-2" style="color: #4fc3f7;"></i> Rotar: Click + Arrastrar</li>
                        <li class="mb-2"><i class="fas fa-search-plus mr-2" style="color: #4fc3f7;"></i> Zoom: Rueda del ratón</li>
                        <li class="mb-2"><i class="fas fa-hand-pointer mr-2" style="color: #4fc3f7;"></i> Mover: Click derecho + arrastrar</li>
                        <li><i class="fas fa-undo-alt mr-2" style="color: #4fc3f7;"></i> Restaurar vista: Doble click</li>
                    </ul>
                    
                    <div class="mt-2">
                        <span class="font-weight-bold text-dark small">Movimientos principales:</span>
                        <div class="d-flex flex-wrap mt-2">
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-hand-paper mr-1"></i> Flexión
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-hand-spock mr-1"></i> Extensión
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-undo-alt mr-1"></i> Pronación
                            </span>
                            <span class="badge badge-light mr-1 mb-1 px-3 py-1">
                                <i class="fas fa-redo-alt mr-1"></i> Supinación
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
            <span class="badge badge-light text-dark p-2 mr-2"><i class="far fa-clock mr-1"></i> Actualizado 2024</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-tag mr-1"></i> Anatomía</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-hand-paper mr-1"></i> Antebrazo</span>
            <span class="badge badge-light text-dark p-2"><i class="fas fa-cube mr-1"></i> 3D Model</span>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-undo-alt text-info mr-2"></i>
                        <span class="font-weight-bold">Pronación</span>
                    </div>
                    <p class="small text-secondary mb-0">Movimiento de rotación del antebrazo que coloca la palma de la mano hacia abajo. Realizado por el pronador redondo y pronador cuadrado.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-redo-alt text-info mr-2"></i>
                        <span class="font-weight-bold">Supinación</span>
                    </div>
                    <p class="small text-secondary mb-0">Movimiento que coloca la palma de la mano hacia arriba. El músculo supinador y el bíceps braquial son los principales responsables.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-hand-peace text-info mr-2"></i>
                        <span class="font-weight-bold">Músculos del pulgar</span>
                    </div>
                    <p class="small text-secondary mb-0">Tres músculos específicos controlan el pulgar: abductor largo, extensor corto y extensor largo del pulgar.</p>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #4fc3f7;">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-lightbulb fa-2x" style="color: #4fc3f7;"></i>
                </div>
                <div>
                    <span class="font-weight-bold" style="color: #0288d1;">¿Sabías que...?</span>
                    <p class="text-secondary mb-0 small">El antebrazo contiene 20 músculos que controlan los movimientos finos de la mano. ¡Más músculos que toda la pierna! Esto permite la destreza manual única de los humanos.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #e1f5fe 0%, #b3e5fc 100%) !important;
    }
    
    .main-header {
        background: white !important;
        border-bottom: 1px solid rgba(79, 195, 247, 0.1) !important;
    }
    
    .rounded-lg {
        border-radius: 12px !important;
    }
    
    .badge-light {
        background-color: white;
        border: 1px solid rgba(79, 195, 247, 0.2);
        color: #01579b;
    }
    
    .badge-primary {
        background: linear-gradient(45deg, #4fc3f7, #81d4fa);
        color: white;
        border: none;
    }
    
    .btn-outline-info {
        color: #4fc3f7;
        border-color: #b3e5fc;
        background: white;
    }
    
    .btn-outline-info:hover {
        background: linear-gradient(45deg, #4fc3f7, #81d4fa);
        border-color: #4fc3f7;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #4fc3f7, #81d4fa);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #29b6f6, #4fc3f7);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(79, 195, 247, 0.4);
    }
    
    .shadow-sm {
        box-shadow: 0 4px 12px rgba(79, 195, 247, 0.1) !important;
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
    
    .btn-outline-info {
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
        $('[data-toggle="tooltip"]').tooltip();
        
        $('.sketchfab-embed-wrapper').hover(
            function() {
                $(this).find('iframe').css('box-shadow', '0 25px 40px -10px rgba(79, 195, 247, 0.4)');
            },
            function() {
                $(this).find('iframe').css('box-shadow', '0 20px 35px -8px rgba(79, 195, 247, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08)');
            }
        );
        
        $('.btn-outline-info').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@stop