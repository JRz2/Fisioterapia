@extends('adminlte::page')

@section('title', 'Modelos  - Visor 3D')

@section('content_header')
    <div class="d-md-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="mr-3 d-none d-md-block">
                <div class="bg-light p-3 rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-bone fa-2x" style="color: #adb5bd;"></i>
                </div>
            </div>
            <div>
                <h1 class="m-0" style="font-weight: 600; letter-spacing: -0.5px;">
                    Esqueleto Completo
                </h1>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-cube mr-1"></i>
                    <span>Modelo 3D - Anatomía humana</span>
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
            </div>
        </div>

        <div class="sketchfab-embed-wrapper" 
            style="position: relative; width: 100%; overflow: hidden; padding-top: 56.25%; border-radius: 16px; box-shadow: 0 20px 35px -8px rgba(0, 123, 255, 0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08);">
            <iframe 
                title="esqueleto" 
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
                src="https://sketchfab.com/models/02bde1815907400ca30b0b2b56b922d9/embed">
            </iframe>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="bg-white p-4 rounded-lg shadow-sm" style="border-left: 4px solid #007bff;">
                    <h5 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Acerca de este modelo</h5>
                    <p class="text-secondary mb-0">Modelo de esqueleto humano completo en alta resolución. Interactúa con él para explorar la anatomía ósea en 3D. Ideal para educación médica, arte y referencia profesional.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-3 rounded-lg shadow-sm h-100">
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

        <div class="mt-3 d-flex flex-wrap gap-2">
            <span class="badge badge-light text-dark p-2 mr-2"><i class="far fa-clock mr-1"></i> Actualizado 2024</span>
            <span class="badge badge-light text-dark p-2 mr-2"><i class="fas fa-tag mr-1"></i> Anatomía</span>
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
        border-bottom: 1px solid rgba(0,123,255,0.1) !important;
    }
    
    .rounded-lg {
        border-radius: 12px !important;
    }
    
    .badge-light {
        background-color: white;
        border: 1px solid rgba(0,123,255,0.2);
        color: #2c3e50;
    }
    
    .badge-primary {
        background: linear-gradient(45deg, #007bff, #00d2ff);
        color: white;
        border: none;
    }
    
    .btn-outline-primary:hover {
        background: linear-gradient(45deg, #007bff, #00d2ff);
        border-color: transparent;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00d2ff);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #0069d9, #00b8ff);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.4);
    }

    .shadow-sm {
        box-shadow: 0 4px 12px rgba(0,123,255,0.08) !important;
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
</style>
@stop

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        
        $('.sketchfab-embed-wrapper').hover(
            function() {
                $(this).find('iframe').css('box-shadow', '0 25px 40px -10px rgba(0,123,255,0.4)');
            },
            function() {
                $(this).find('iframe').css('box-shadow', '0 20px 35px -8px rgba(0,123,255,0.25), 0 0 0 1px rgba(255,255,255,1), 0 5px 15px rgba(0,0,0,0.08)');
            }
        );
    });
</script>
@stop