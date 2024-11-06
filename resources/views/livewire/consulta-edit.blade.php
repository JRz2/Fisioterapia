<div class="card card-dark">
    <div class="card-header">
        <table width=100%>
            <tr>
                <td align="center">
                    <h1 style="font-size: 30px;"> NUEVA CONSULTA </h1>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="card-body">
        @php
            $id = request()->query('id');
        @endphp
        <div class="row">
            <div class="col-md-3">
                <x-label class="text-lg">Nombre: <span
                        class="badge badge-pill font-normal text-lg">{{ $paciente->nombre }}</span></x-label>
            </div>
            <div class="col-md-3">
                <x-label class="text-lg">Ocupacion: <span
                        class="badge badge-pill font-normal text-lg">{{ $paciente->ocupacion }}</span></x-label>
            </div>
            <div class="col-md-3">
                @if ($ultima_consulta->fecha)
                    <x-label class="text-lg">Fecha: <span
                            class="badge badge-pill font-normal text-lg">{{ $ultima_consulta->fecha }}</span></x-label>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <x-label class="text-lg">Paterno: <span
                        class="badge badge-pill font-normal text-lg">{{ $paciente->paterno }}</span></x-label>
            </div>
            <div class="col-md-3">
                <x-label class="text-lg">Deporte: <span
                        class="badge rounded-pill font-normal text-lg">{{ $paciente->deporte }}</span></x-label>
            </div>
            <div class="col-md-3">
                @if ($ultima_consulta->fecha)
                    <x-label class="text-lg">Codigo: <span
                            class="badge badge-pill font-normal text-lg">{{ $ultima_consulta->codigo }}</span></x-label>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <x-label class="text-lg">Materno: <span
                        class="badge badge-pill font-normal text-lg">{{ $paciente->materno }}</span></x-label>
            </div>
            <div class="col-md-3">
                <x-label class="text-lg">Celular: <span
                        class="badge badge-pill font-normal text-lg">{{ $paciente->celular }}</span></x-label>
            </div>
            <div class="col-md-3">
                <div wire:model="btnterminar" 
                    style="{{ $btnterminar ? '' : 'display: none;' }}; margin-left: auto">
                    <a class="px-4 py-2 text-md font-bold text-white bg-green-600 rounded-lg 
                hover:bg-green-700 hover:no-underline"
                        href="{{ route('doctor.paciente.show', $paciente->id) }}">
                        <i class="fas fa-solid fa-check fa-1x mr-2"></i>
                        Terminar Consulta
                    </a>
                </div>
            </div>
        </div>
        
        <div class="w-full">
            <!-- Custom Tabs -->
            <div x-data="{ activeTab: 'anamnesis' }"  class="border border-gray-300 rounded-lg shadow">
                <ul class="flex flex-wrap border-b border-gray-300 bg-gray-100">
                    <li class="mr-2">
                        <a href="#anamnesis" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'anamnesis' }"
                            @click.prevent="activeTab = 'anamnesis'">Anamnesis</a>
                    </li>
                    <li class="mr-2">
                        <a href="#antropometria" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'antropometria' }"
                            @click.prevent="activeTab = 'antropometria'">Antropometría</a>
                    </li>
                    <li class="mr-2">
                        <a href="#evaluacion" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'evaluacion' }"
                            @click.prevent="activeTab = 'evaluacion'">Evaluación</a>
                    </li>
                    <li class="mr-2">
                        <a href="#inspeccion" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'inspeccion' }"
                            @click.prevent="activeTab = 'inspeccion'">Inspección</a>
                    </li>
                    <li class="mr-2">
                        <a href="#movilizacion" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'movilizacion' }"
                            @click.prevent="activeTab = 'movilizacion'">Palpación</a>
                    </li>
                    <li class="mr-2">
                        <a href="#examen" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'examen' }"
                            @click.prevent="activeTab = 'examen'">Pruebas</a>
                    </li>
                    <li class="mr-2">
                        <a href="#diagnostico" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'diagnostico' }"
                            @click.prevent="activeTab = 'diagnostico'">Diagnóstico</a>
                    </li>
                    <li class="mr-2">
                        <a href="#horario" class="inline-block px-4 py-2 text-gray-600 hover:text-blue-600 focus:text-blue-600"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'horario' }"
                            @click.prevent="activeTab = 'horario'">Horarios</a>
                    </li>
                </ul>
        
                <div class="p-4">
                    <div x-show="activeTab === 'anamnesis'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'antropometria'" class="tab-content">
                       
                    </div>
                    <div x-show="activeTab === 'evaluacion'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'inspeccion'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'movilizacion'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'examen'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'diagnostico'" class="tab-content">
                        
                    </div>
                    <div x-show="activeTab === 'horario'" class="tab-content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


