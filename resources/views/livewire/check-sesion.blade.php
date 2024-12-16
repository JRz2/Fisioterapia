<div>
    @if($sessionsToday->isNotEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
            <p class="font-bold">¡Recordatorio de Sesiones para hoy!</p>
            <ul class="list-disc pl-5">
                @foreach($sessionsToday as $horario)
                    <li>
                        Paciente: <strong>{{ $horario->consulta->paciente->nombre }} {{$horario->consulta->paciente->paterno}} {{$horario->consulta->paciente->materno}}</strong><br>
                        Día: {{ \Carbon\Carbon::parse($horario->fecha_inicio)->translatedFormat('l, d F Y') }}<br>
                        Hora: {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
