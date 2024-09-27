@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Informe Kinesico</h1>
@stop

@section('content')
<div class="informe-container">
    <div class="informe-header">
        <label><strong>Paciente:</strong> Nombre del paciente</label>
        <label><strong>Edad:</strong> 30 años</label>
        <label><strong>Género:</strong> Masculino</label>
        <label><strong>Fecha:</strong> 18/09/2024</label>
    </div>

    <div class="informe-body">
        <div class="informe-section">
            <label><strong>Dx:</strong></label>
            <input type="text" class="input-text">
        </div>

        <div class="informe-section">
            <label><strong>Análisis Cinético Funcional:</strong></label>
            <textarea></textarea>
        </div>

        <div class="informe-section">
            <label><strong>Recomendaciones:</strong></label>
            <textarea></textarea>
        </div>
    </div>
    <a class="btn btn-info" href="{{url ('/doctor/reporte/pdf/' .$consulta->id)}}"><i class="fa fa-print"></i> IMPRIMIR PDF</a> 
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .informe-container {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .informe-header {
            margin-bottom: 20px;
        }

        .informe-header label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .informe-body {
            margin-top: 20px;
        }

        .informe-section {
            margin-bottom: 15px;
        }

        .informe-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .input-text, .input-textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
        }

        .input-text {
            height: 40px;
            margin-bottom: 10px;
        }

        .input-textarea {
            resize: vertical;
            font-size: 14px;
        }

        .informe-container strong {
            font-weight: bold;
            color: #333;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('textarea').forEach((textarea) => {
            ClassicEditor
                .create(textarea, {
                    toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList']
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@stop