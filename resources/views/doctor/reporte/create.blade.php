@extends('adminlte::page')

@section('title', 'Reporte')

@section('content_header')
@endsection

@section('content')
    <x-app-layout>
        <div class="card card-dark">
            <div class="card-header">
                <table width=100%>
                    <tr>
                        <td align="left" width=5%>
                            <h1><a class="mr-5 ">
                                    <i class="fas fa-solid fa-reply-all fa-2x"></i>
                                </a></h1>
                        </td>
                        <td align="center">
                            <h1 style="font-size: 30px;"> INFORME KINESICO </h1>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="informe-date">
                    <strong>INFORME KINESICO</strong>
                    <div class="row">
                        <div>
                            <label><strong>Paciente:</strong> {{$consulta->paciente->nombre}}</label>
                            <label><strong>CI:</strong> {{$consulta->paciente->ci}}</label>
                        </div>
                        <div>
                            <label><strong>Edad del Paciente:</strong> {{$consulta->paciente->edad}}</label>
                            <label><strong>Género:</strong> {{$consulta->paciente->genero}}</label>
                        </div>
                    </div>             
                </div>
                @livewire('informe-create', ['consultaId' => $consulta->id])
            </div>
            
        </div>
    </x-app-layout>
@endsection

@section('css')

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

        .input-text,
        .input-textarea {
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
@endsection

@section('js')
    <script>
        console.log('Hi!');
    </script>
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
@endsection
