@extends('adminlte::page')

@section('title', 'Modelos 3D - Miembro Inferior')

@section('content_header')
    <div class="d-md-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="mr-3 d-none d-md-block">
                <div class="bg-light p-3 rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-person-walking fa-2x" style="color: #adb5bd;"></i>                </div>
            </div>
            <div>
                <h1 class="m-0" style="font-weight: 600; letter-spacing: -0.5px;">
                    Miembro Inferior
                </h1>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-cube mr-1"></i>
                    <span>Modelo 3D - Pierna y tibia</span>
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
                    <i class="fas fa-running mr-1"></i> Extremidad inferior
                </span>
            </div>
        </div>

        <div class="sketchfab-embed-wrapper" 
            style="position: relative; width: 100%; overflow: hidden; padding-top: 56.25%; border-radius: 16px; box-shadow: 0 20px 35px -8px rgba(56, 161, 105, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08);">
            <iframe 
                title="miembro inferior" 
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
                src="https://sketchfab.com/models/e774663bffee40049b1d7a2ec5f1eb82/embed">
            </iframe>
        </div>

        {{-- Sección de información anatómica --}}
        <div class="row mt-4">
            <div class="col-md-7">
                <div class="bg-white p-4 rounded-lg shadow-sm" style="border-left: 4px solid #38a169;">
                    <h5 class="mb-3" style="color: #276749;"><i class="fas fa-info-circle mr-2"></i>Anatomía de la pierna y tibia</h5>
                    <p class="text-secondary mb-3">La pierna está compuesta por dos huesos principales: la tibia (medial) y el peroné (lateral). Los músculos de esta región se dividen en compartimentos anterior, lateral y posterior, responsables de la locomoción y el soporte del peso corporal.</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #276749;">🦵 Compartimento anterior</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Tibial anterior</li>
                                <li>Extensor largo de los dedos</li>
                                <li>Extensor largo del dedo gordo</li>
                                <li>Peroneo anterior</li>
                            </ul>
                            
                            <h6 class="font-weight-bold mt-2" style="color: #276749;">🦵 Compartimento lateral</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Peroneo largo</li>
                                <li>Peroneo corto</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #276749;">💪 Compartimento posterior</h6>
                            <ul class="small text-secondary pl-3">
                                <li><span class="font-weight-bold">Superficial:</span> Gastrocnemio, Sóleo, Plantar</li>
                                <li><span class="font-weight-bold">Profundo:</span> Poplíteo, Flexor largo de los dedos, Flexor largo del dedo gordo, Tibial posterior</li>
                            </ul>
                            
                            <h6 class="font-weight-bold mt-2" style="color: #276749;">🦴 Huesos</h6>
                            <ul class="small text-secondary pl-3">
                                <li><span class="font-weight-bold">Tibia:</span> Hueso medial y principal</li>
                                <li><span class="font-weight-bold">Peroné:</span> Hueso lateral</li>
                                <li><span class="font-weight-bold">Rótula:</span> Hueso sesamoideo</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="bg-white p-3 rounded-lg shadow-sm h-50">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-cog mr-2" style="color: #38a169;"></i>
                        <span class="font-weight-bold text-dark">Controles de navegación:</span>
                    </div>
                    <ul class="list-unstyled mt-2 small text-secondary">
                        <li class="mb-2"><i class="fas fa-mouse-pointer mr-2" style="color: #38a169;"></i> Rotar: Click + Arrastrar</li>
                        <li class="mb-2"><i class="fas fa-search-plus mr-2" style="color: #38a169;"></i> Zoom: Rueda del ratón</li>
                        <li class="mb-2"><i class="fas fa-hand-pointer mr-2" style="color: #38a169;"></i> Mover: Click derecho + arrastrar</li>
                        <li><i class="fas fa-undo-alt mr-2" style="color: #38a169;"></i> Restaurar vista: Doble click</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
            <span class="badge badge-light text-dark p-2 mr-2"><i class="far fa-clock mr-1"></i> Actualizado 2024</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-tag mr-1"></i> Anatomía</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-leg mr-1"></i> Miembro inferior</span>
            <span class="badge badge-light text-dark p-2"><i class="fas fa-cube mr-1"></i> 3D Model</span>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-weight-hanging text-success mr-2"></i>
                        <span class="font-weight-bold">Soporte de peso</span>
                    </div>
                    <p class="small text-secondary mb-0">La tibia soporta aproximadamente el 85% del peso corporal, mientras que el peroné actúa principalmente como punto de inserción muscular.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-heartbeat text-success mr-2"></i>
                        <span class="font-weight-bold">"Segundo corazón"</span>
                    </div>
                    <p class="small text-secondary mb-0">Los músculos de la pantorrilla actúan como bomba venosa, ayudando al retorno de la sangre al corazón.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-running text-success mr-2"></i>
                        <span class="font-weight-bold">Movimiento</span>
                    </div>
                    <p class="small text-secondary mb-0">La pierna permite flexión plantar (señalar), dorsiflexión (flexión), inversión y eversión del pie.</p>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #38a169;">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas fa-lightbulb fa-2x" style="color: #38a169;"></i>
                </div>
                <div>
                    <span class="font-weight-bold" style="color: #276749;">¿Sabías que...?</span>
                    <p class="text-secondary mb-0 small">El tendón de Aquiles es el tendón más fuerte y grande del cuerpo humano. Puede soportar cargas de hasta 3-4 veces el peso corporal al correr.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f0f9f0 0%, #e3f0e3 100%) !important;
    }
    
    .main-header {
        background: white !important;
        border-bottom: 1px solid rgba(56, 161, 105, 0.1) !important;
    }
    
    .rounded-lg {
        border-radius: 12px !important;
    }
    
    .badge-light {
        background-color: white;
        border: 1px solid rgba(56, 161, 105, 0.2);
        color: #22543d;
    }
    
    .badge-primary {
        background: linear-gradient(45deg, #38a169, #48bb78);
        color: white;
        border: none;
    }
    
    .btn-outline-success {
        color: #38a169;
        border-color: #9ae6b4;
        background: white;
    }
    
    .btn-outline-success:hover {
        background: linear-gradient(45deg, #38a169, #48bb78);
        border-color: #38a169;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(56, 161, 105, 0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #38a169, #48bb78);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #2f855a, #38a169);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(56, 161, 105, 0.4);
    }
    
    .shadow-sm {
        box-shadow: 0 4px 12px rgba(56, 161, 105, 0.1) !important;
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
    
    .btn-outline-success {
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
                $(this).find('iframe').css('box-shadow', '0 25px 40px -10px rgba(56, 161, 105, 0.4)');
            },
            function() {
                $(this).find('iframe').css('box-shadow', '0 20px 35px -8px rgba(56, 161, 105, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08)');
            }
        );
        
        $('.btn-outline-success').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@stop