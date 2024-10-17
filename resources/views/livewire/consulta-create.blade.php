<div class="card card-dark">
    <div class="card-header">
        <table width=100%>
            <tr>
                <td align="center">
                    <h1 style="font-size: 30px;"> CONSULTA EXPEDIENTE </h1>
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
            <div class="col-md-3">
                <div wire:model="btnterminar" class="float-end"
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
                    <x-label class="text-lg">Codigo de Consulta: <span
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
        </div>

        <div wire:model="panel" style="{{ $panel ? '' : 'display: none;' }}"
            class="p-4 bg-gray-100 rounded-lg">
            <!-- Botones de Navegación -->
            <div x-data="{ activeSection: @entangle('activeSection') }" class="flex flex-wrap gap-2">
                <button class="btn-nav" :class="{ 'active': activeSection == 'anamnesis' }"
                    @click="activeSection = 'anamnesis'; $wire.anamnesis()"><h1 class="text-md">Anamnesis</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'antropometria' }"
                    @click="activeSection = 'antropometria'; $wire.antropometria()"><h1 class="text-md">Antropometría</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'evaluacion' }"
                    @click="activeSection = 'evaluacion'; $wire.evaluacion()"><h1 class="text-md">Evaluación</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'inspeccion' }"
                    @click="activeSection = 'inspeccion'; $wire.inspeccion()"><h1 class="text-md">Inspección</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'movilizacion' }"
                    @click="activeSection = 'movilizacion'; $wire.movilizacion()"><h1 class="text-md">Palpación</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'examen' }"
                    @click="activeSection = 'examen'; $wire.examen()"><h1 class="text-md">Pruebas</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'diagnostico' }"
                    @click="activeSection = 'diagnostico'; $wire.diagnostico()"><h1 class="text-md">Diagnóstico</h1></button>
                <button class="btn-nav" :class="{ 'active': activeSection === 'horario' }"
                    @click="activeSection = 'horario'; $wire.horario()"><h1 class="text-md">Horarios</h1></button>
            </div>

            <!-- Paneles de contenido -->
            <div>
                <div wire:model="openan" style="{{ $openan ? 'active' : 'display: none;' }}" class="panel-content">
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


