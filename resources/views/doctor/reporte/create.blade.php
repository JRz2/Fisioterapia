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
                            <h1><a href="{{route('doctor.consulta.show', $consulta->id)}}"  class="mr-5 ">
                                    <i class="fas fa-solid fa-reply-all fa-2x"></i>
 
                                </a>
                            </h1>
                        </td>
                        <td align="center">
                            <h1 style="font-size: 30px;"> INFORME KINESICO </h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="informe-date">
                    <div class="p-4 bg-white shadow rounded-lg mb-4">
                        <h2 class="text-lg font-bold mb-2">Información del Paciente</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold"><strong>Paciente:</strong></label>
                                <span class="block text-gray-700">{{$consulta->paciente->nombre}}</span>
                            </div>
                            <div>
                                <label class="font-semibold"><strong>CI:</strong></label>
                                <span class="block text-gray-700">{{$consulta->paciente->ci}}</span>
                            </div>
                            <div>
                                <label class="font-semibold"><strong>Edad del Paciente:</strong></label>
                                <span class="block text-gray-700">{{$consulta->paciente->edad}}</span>
                            </div>
                            <div>
                                <label class="font-semibold"><strong>Género:</strong></label>
                                <span class="block text-gray-700">{{$consulta->paciente->genero}}</span>
                            </div>
                        </div>
                    </div>
                     
                    <div>
                        {!! Form::open(['route'=> 'doctor.reporte.store']) !!}
                            <div class="max-w-3xl mx-auto p-6 bg-sky-50 rounded-lg shadow-md">
                                <h2 class="text-2xl font-bold text-center mb-4">Informe de Rehabilitación</h2>
                                
                                <input name="consulta_id" type="text" value="{{ $consulta->id }}" hidden>
                        
                                <div class="mb-4">
                                    <label class="block text-lg font-semibold mb-2"><strong>Fecha:</strong></label>
                                    <input name="fecha" type="date" class="input-text w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                </div>
                        
                                <div class="mb-4">
                                    <label class="block text-lg font-semibold mb-2"><strong>Dx:</strong></label>
                                    <input name="diagnostico" type="text" class="input-text w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                </div>
                        
                                <label class="block text-lg font-semibold mb-2"><strong>Informe:</strong></label>
                                <div id="editor-container-informe" class="border rounded-lg mb-4" style="height: 150px;"></div>
                                <input type="hidden" name="informe" id="contenido-informe">
                        
                                <label class="block text-lg font-semibold mb-2"><strong>Rehabilitación fisioterapéutica y kinesiología:</strong></label>
                                <div id="editor-container-rehabilitacion" class="border rounded-lg mb-4" style="height: 150px;"></div>
                                <input type="hidden" name="rehabilitacion" id="contenido-rehabilitacion">
                        
                                <label class="block text-lg font-semibold mb-2"><strong>Recomendaciones:</strong></label>
                                <div id="editor-container-recomendacion" class="border rounded-lg mb-4" style="height: 150px;"></div>
                                <input type="hidden" name="recomendacion" id="contenido-recomendacion">
                        
                                <label class="block text-lg font-semibold mb-2"><strong>Nota:</strong></label>
                                <div id="editor-container-nota" class="border rounded-lg mb-4" style="height: 150px;"></div>
                                <input type="hidden" name="nota" id="contenido-nota">
                        
                                {!! Form::submit('Guardar Informe', ['class'=> 'w-full py-2 mt-4 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300']) !!}
                            </div>
                        {!! Form::close() !!}
                    
                    </div>           
                </div>
            </div>
        </div>  
    </x-app-layout>
@endsection

@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar Quill para cada editor
            const editors = [
                { container: '#editor-container-informe', hiddenInput: '#contenido-informe' },
                { container: '#editor-container-rehabilitacion', hiddenInput: '#contenido-rehabilitacion' },
                { container: '#editor-container-recomendacion', hiddenInput: '#contenido-recomendacion' },
                { container: '#editor-container-nota', hiddenInput: '#contenido-nota' },
            ];

            editors.forEach(editor => {
                const quill = new Quill(editor.container, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'], // botones conmutables
                            [{ list: 'ordered' }, { list: 'bullet' }], // lista
                        ]
                    },
                    placeholder: 'Escribe aquí...',
                    height: 150
                });

                // Almacenar el contenido del editor en el input oculto
                quill.on('text-change', function() {
                    document.querySelector(editor.hiddenInput).value = quill.root.innerHTML;
                    const content = quill.root.innerHTML;
                    document.querySelector(editor.hiddenInput).value = content;
                    console.log(`Contenido en ${editor.hiddenInput}:`, content);
                });
            });
        });
    </script>
@endsection
