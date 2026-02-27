@extends('adminlte::page')

@section('title', 'Modelos 3D - Cráneo')

@section('content_header')
    <div class="d-md-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="mr-3 d-none d-md-block">
                <div class="bg-light p-3 rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-skull fa-2x" style="color: #adb5bd;"></i>
                </div>
            </div>
            <div>
                <h1 class="m-0" style="font-weight: 600; letter-spacing: -0.5px;">
                    Huesos del Cráneo
                </h1>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-cube mr-1"></i>
                    <span>Modelo 3D - Anatomía craneal</span>
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
                    <i class="fas fa-skull mr-1"></i> 22 huesos
                </span>
            </div>
        </div>

        <div class="sketchfab-embed-wrapper" 
            style="position: relative; width: 100%; overflow: hidden; padding-top: 56.25%; border-radius: 16px; box-shadow: 0 20px 35px -8px rgba(0, 123, 255, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08);">
            <iframe 
                title="craneo" 
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
                src="https://sketchfab.com/models/0012902bb2e6453ab1dbd5013234f9f7/embed">
            </iframe>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="bg-white p-4 rounded-lg shadow-sm" style="border-left: 4px solid #6c757d;">
                    <h5 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Acerca de este modelo</h5>
                    <p class="text-secondary mb-3">El cráneo humano está compuesto por 22 huesos divididos en dos grupos: 8 huesos craneales que protegen el encéfalo y 14 huesos faciales que dan forma a la cara.</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #495057;">🧠 Neurocráneo (8)</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Frontal</li>
                                <li>Parietales (2)</li>
                                <li>Temporales (2)</li>
                                <li>Occipital</li>
                                <li>Esfenoides</li>
                                <li>Etmoides</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h6 class="font-weight-bold" style="color: #495057;">👤 Viscerocráneo (14)</h6>
                            <ul class="small text-secondary pl-3">
                                <li>Maxilares (2)</li>
                                <li>Cigomáticos (2)</li>
                                <li>Nasales (2)</li>
                                <li>Lagrimales (2)</li>
                                <li>Vómer</li>
                                <li>Palatinos (2)</li>
                                <li>Cornetes (2)</li>
                                <li>Mandíbula</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="bg-white p-3 rounded-lg shadow-sm h-50">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-cog text-primary fa-spin mr-2"></i>
                        <span class="font-weight-bold text-dark">Controles:</span>
                    </div>
                    <ul class="list-unstyled mt-2 small text-secondary">
                        <li class="mb-2"><i class="fas fa-mouse-pointer text-primary mr-2"></i> Rotar: Click + Arrastrar</li>
                        <li class="mb-2"><i class="fas fa-search-plus text-primary mr-2"></i> Zoom: Rueda del ratón</li>
                        <li class="mb-2"><i class="fas fa-expand text-primary mr-2"></i> Pantalla completa: Botón superior</li>
                        <li><i class="fas fa-undo-alt text-primary mr-2"></i> Vista inicial: Doble click</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
            <span class="badge badge-light text-dark p-2 mr-2"><i class="far fa-clock mr-1"></i> Actualizado 2024</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-tag mr-1"></i> Anatomía</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-skull mr-1"></i> Cráneo</span>
            <span class="badge badge-light text-dark p-2"><i class="fas fa-cube mr-1"></i> 3D Model</span>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8faff 0%, #f0f3fd 100%) !important;
    }
    
    .main-header {
        background: white !important;
        border-bottom: 1px solid rgba(108, 117, 125, 0.1) !important;
    }
    
    .rounded-lg {
        border-radius: 12px !important;
    }
    
    .badge-light {
        background-color: white;
        border: 1px solid rgba(108, 117, 125, 0.2);
        color: #2c3e50;
    }
    
    .badge-primary {
        background: linear-gradient(45deg, #4a5568, #718096);
        color: white;
        border: none;
    }
    
    .btn-outline-secondary {
        color: #4a5568;
        border-color: #cbd5e0;
    }
    
    .btn-outline-secondary:hover {
        background: #4a5568;
        border-color: #4a5568;
        color: white;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #4a5568, #718096);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #2d3748, #4a5568);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(74, 85, 104, 0.3);
    }
    
    .shadow-sm {
        box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important;
    }
    
    .btn, .badge, .card {
        transition: all 0.3s ease;
    }
    
    .text-secondary {
        color: #5a6a7e !important;
    }
    
    .gap-2 {
        gap: 0.5rem;
    }
    
    .bg-white {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.5);
    }
       .text-secondary {
        color: #5a6a7e !important;
    }
</style>

@stop

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        
        $('.sketchfab-embed-wrapper').hover(
            function() {
                $(this).find('iframe').css('box-shadow', '0 25px 40px -10px rgba(74, 85, 104, 0.4)');
            },
            function() {
                $(this).find('iframe').css('box-shadow', '0 20px 35px -8px rgba(74, 85, 104, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08)');
            }
        );
        
        $('.btn-outline-secondary').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@stop