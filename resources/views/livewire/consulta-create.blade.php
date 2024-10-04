<div>
    <div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div style="display: flex; gap:5%; margin: 5px 2px 0 10px">
                        @php
                            $id = request()->query('id');
                        @endphp
                        @if ($paciente)
                        <div>
                            <x-label>nombre: {{$paciente->nombre}}</x-label>    
                            <x-label>paterno: {{$paciente->paterno}}</x-label>
                            <x-label>materno: {{$paciente->materno}}</x-label>
                        </div>

                            <div>
                                <x-label>Ocupacion: {{$paciente->ocupacion}}</x-label>    
                                <x-label>Deporte: {{$paciente->deporte}}</x-label>
                                <x-label>Celular: {{$paciente->celular}}</x-label>
                            </div>
                            
                            <div wire:model="btnterminar" style="{{ $btnterminar ? '' : 'display: none;' }}">
                                @if ($ultima_consulta->fecha)
                                    <x-label>Fecha: {{$ultima_consulta->fecha}}</x-label>
                                    <x-label>Codigo de Consulta: {{$ultima_consulta->codigo}}</x-label>
                                @endif
                            </div>
                            
                            <div wire:model="btnterminar" style="{{ $btnterminar ? '' : 'display: none;' }}; margin-left: auto">
                                <a class="px-4 py-2 text-xs font-bold text-white bg-green-600 rounded-lg 
                                hover:bg-green-700 hover:no-underline" 
                                href="{{route('doctor.paciente.show', $paciente->id)}}">
                                <i class="fas fa-solid fa-check fa-1x"></i>
                                Terminar Consulta
                                </a>
                            </div>
                        @else
                            <p>no hay</p>     
                        @endif
                    </div>
                </div>   
            </div>   
        </div>  

        <div wire:model="panel" style="{{ $panel ? '' : 'display: none;' }}" class="p-4 bg-gray-100 rounded-lg shadow-lg">
            <!-- Botones de Navegación -->
            <div x-data="{ activeSection: '' }" class="flex flex-wrap gap-2 mb-4">
                <button class="btn-nav" :class="{ 'active': activeSection === 'ananmesis' }" @click="activeSection = 'ananmesis'; $wire.ananmesis()">Anamnesis</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'antropometria' }" @click="activeSection = 'antropometria'; $wire.antropometria()">Antropometría</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'evaluacion' }" @click="activeSection = 'evaluacion'; $wire.evaluacion()">Evaluación</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'inspeccion' }" @click="activeSection = 'inspeccion'; $wire.inspeccion()">Inspección</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'movilizacion' }" @click="activeSection = 'movilizacion'; $wire.movilizacion()">Palpación</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'examen' }" @click="activeSection = 'examen'; $wire.examen()">Pruebas</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'diagnostico' }" @click="activeSection = 'diagnostico'; $wire.diagnostico()">Diagnóstico</button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'horario' }" @click="activeSection = 'horario'; $wire.horario()">Horarios</button>
            </div>            
        
            <!-- Paneles de contenido -->
            <div class="space-y-4">
                <div wire:model="openan" style="{{ $openan ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('Anamnesis-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="openantro" style="{{ $openantro ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('antropometria-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="openval" style="{{ $openval ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('evaluacion-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="openins" style="{{ $openins ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('inspeccion-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="openmov" style="{{ $openmov ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('movilizacion-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="openexa" style="{{ $openexa ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('examen-create', ['consultaId' => $id])
                </div>
        
                <div wire:model="opendiag" style="{{ $opendiag ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('diagnostico-create', ['consultaId' => $id])
                </div>

                <div wire:model="openhorario" style="{{ $openhorario ? '' : 'display: none;' }}" class="panel-content">
                    @livewire('horario-create', ['consultaId' => $id])
                </div>
            </div>
        </div>

        <style>
            .btn-nav {
                padding: 8px 16px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
                font-size: 14px;
                font-weight: bold;
                color: #333;
                transition: background-color 0.3s, color 0.3s;
                cursor: pointer;
                white-space: nowrap;
            }
            
            .btn-nav.active {
                background-color: #4f46e5;
                color: #fff;
            }
        
            .btn-nav:hover {
                background-color: #e2e8f0;
            }
        
            .panel-content {
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 16px;
            }
        </style>        
  
    </div>

</div>
