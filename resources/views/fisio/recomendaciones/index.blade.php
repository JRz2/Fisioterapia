@extends('adminlte::page')

@section('title', 'Recomendaciones de Ejercicios')

@section('content_header')
    <h1>Recomendaciones de Ejercicios para {{ $paciente->nombre }} {{ $paciente->paterno }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    📋 Ejercicios Recomendados
                    @if($metodoUsado == 'machine_learning')
                        <span class="badge badge-success ml-2">🤖 ML: Basado en pacientes similares</span>
                    @elseif($metodoUsado == 'patologia')
                        <span class="badge badge-info ml-2">📚 Basado en patología</span>
                    @else
                        <span class="badge badge-warning ml-2">⚠️ Sin datos suficientes</span>
                    @endif
                </h3>
            </div>
            <div class="card-body">
                @if($recomendaciones->isEmpty())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        No hay suficientes datos para recomendar ejercicios. 
                        Comienza asignando ejercicios manualmente y el sistema aprenderá.
                    </div>
                    
                    <!-- Ejercicios por defecto para empezar -->
                    <h5>Ejercicios sugeridos para empezar:</h5>
                    <div class="row">
                        @foreach(\App\Models\Ejercicio::limit(6)->get() as $ejercicio)
                            <div class="col-md-6 mb-3">
                                <div class="card card-outline card-primary">
                                    <div class="card-body">
                                        <h6>{{ $ejercicio->nombre }}</h6>
                                        <small>{{ $ejercicio->descripcion }}</small>
                                        <br>
                                        <span class="badge badge-secondary">{{ $ejercicio->zona_corporal }}</span>
                                        <span class="badge badge-info">{{ $ejercicio->dificultad }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <form action="{{ route('fisio.recomendaciones.asignar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sesion_id" value="{{ $sesionesPendientes->first()->id ?? '' }}">
                        
                        @if($sesionesPendientes->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                No hay sesiones pendientes. Crea una nueva sesión para asignar ejercicios.
                            </div>
                        @endif
                        
                        <div class="row">
                            @foreach($recomendaciones as $ejercicio)
                            <div class="col-md-6 mb-3">
                                <div class="card {{ $loop->index < 3 ? 'border-success' : 'card-outline' }}">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   name="ejercicios[]" 
                                                   value="{{ $ejercicio->id }}" 
                                                   id="ejercicio_{{ $ejercicio->id }}"
                                                   class="form-check-input"
                                                   {{ $loop->index < 3 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ejercicio_{{ $ejercicio->id }}">
                                                <strong>{{ $ejercicio->nombre }}</strong>
                                                @if(isset($ejercicio->score_ml))
                                                    <span class="badge badge-success ml-1" title="Basado en {{ $ejercicio->score_ml }} casos exitosos">
                                                        🔥 +{{ $ejercicio->score_ml }}
                                                    </span>
                                                @endif
                                            </label>
                                        </div>
                                        <p class="mt-2 mb-1 small text-muted">{{ $ejercicio->descripcion }}</p>
                                        <div class="mt-1">
                                            <span class="badge badge-secondary">{{ $ejercicio->zona_corporal }}</span>
                                            <span class="badge badge-info">{{ $ejercicio->dificultad }}</span>
                                            <span class="badge badge-primary">{{ $ejercicio->series_recomendadas }} series</span>
                                            <span class="badge badge-primary">{{ $ejercicio->repeticiones_recomendadas }} reps</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @if(!$sesionesPendientes->isEmpty())
                        <div class="form-group mt-3">
                            <label for="sesion_id">Asignar a sesión:</label>
                            <select name="sesion_id" class="form-control" required>
                                @foreach($sesionesPendientes as $sesion)
                                    <option value="{{ $sesion->id }}">
                                        Sesión #{{ $sesion->codigo }} - {{ $sesion->fecha }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-check-circle"></i> Asignar Ejercicios Seleccionados
                        </button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Info del paciente -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">👤 Información del Paciente</h3>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->paterno }} {{ $paciente->materno }}</p>
                <p><strong>Edad:</strong> {{ $paciente->edad }} años</p>
                <p><strong>Género:</strong> {{ $paciente->genero }}</p>
                <p><strong>Deporte:</strong> {{ $paciente->deporte ?? 'No especificado' }}</p>
                <p><strong>Ocupación:</strong> {{ $paciente->ocupacion ?? 'No especificada' }}</p>
            </div>
        </div>
        
        <!-- Cómo funciona el ML -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">🤖 ¿Cómo funciona la recomendación?</h3>
            </div>
            <div class="card-body">
                <p>El sistema busca <strong>pacientes similares</strong> (misma edad y género) y recomienda los ejercicios que mejor resultado les dieron.</p>
                
                @if($metodoUsado == 'machine_learning')
                    <div class="alert alert-success">
                        <i class="fas fa-chart-line"></i>
                        <strong>ML Activo</strong><br>
                        Las recomendaciones se basan en {{ $recomendaciones->sum('score_ml') }} casos de éxito.
                    </div>
                @elseif($metodoUsado == 'patologia')
                    <div class="alert alert-info">
                        <i class="fas fa-book"></i>
                        <strong>Modo: Por Patología</strong><br>
                        El sistema está recomendando basado en la patología. A medida que registres resultados, el ML se activará.
                    </div>
                @endif
                
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         role="progressbar" 
                         style="width: {{ min(100, \App\Models\Sesion::count() * 5) }}%">
                        {{ \App\Models\Sesion::count() }} sesiones registradas
                    </div>
                </div>
                <p class="small text-muted mt-2">
                    * Necesitas al menos 10 sesiones con ejercicios completados para que el ML sea preciso.
                </p>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    console.log('Página de recomendaciones cargada');
</script>
@stop