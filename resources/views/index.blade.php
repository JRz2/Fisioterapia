@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
  <x-app-layout>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="small-box bg-gradient-success">
                <div class="inner">
                  <h3>{{ $npacientes }}</h3>
                  <p>Pacientes</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('doctor.paciente.index') }}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="small-box bg-gradient-primary">
                <div class="inner">
                  <h3>{{ $nconsultas }}</h3>
                  <p>Consultas</p>
                </div>
                <div class="icon">
                  <i class="fas fa-folder"></i>
                </div>
                <a href="{{ route('doctor.consulta.index') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $nsesiones }}</h3>
                  <p>Sesiones</p>
                </div>
                <div class="icon">
                  <i class="fas fa-heart-pulse"></i>
                </div>
                <a href="{{ route('doctor.sesion.index') }}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>{{$nhorarios}}</h3>
                  <p>Calendario</p>
                </div>
                <div class="icon">
                  <i class="fas fa-calendar"></i>
                </div>
                <a href="{{ route('doctor.horario.index') }}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="card card-outline card-success">
                <div class="card-header">
                  <h3 class="card-title">Últimas consultas</h3>
                </div>
                <div class="card-body">
                  <table class="table ">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ultimasConsultas as $consulta)
                        <tr>
                          <td>{{ $consulta->codigo }}</td>
                          <td>{{ $consulta->paciente->nombre }} {{ $consulta->paciente->paterno }}</td>
                          <td>{{ $consulta->fecha }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>                
                </div>
                <div class="card-footer">
                  <a href="{{ route('doctor.consulta.index') }}">ver todos</a>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h3 class="card-title">Equipo</h3>
                </div>
                <div class="card-body">
                  <ul class="d-flex flex-wrap list-unstyled">
                    @foreach ($users as $user)
                      <li class="text-center m-3 d-flex flex-column align-items-center" style="width: 150px;">
                        @if (strpos($user->imagen, 'image/') !== false)
                            <img src="{{ asset($user->imagen) }}" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="{{ asset('storage/app/public/' . $user->imagen) }}" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                        @endif                      
                        <div>
                          @forelse ($user->roles as $rol)
                            <span class="badge badge-info">{{$rol->name}}</span><br>
                          @empty
                            <span class="badge badge-danger">No asignado</span><br>
                          @endforelse
                          <strong>{{ $user->name }}</strong><br>
                          <small>{{ $user->email }}</small>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="row flex justify-center space-x-8">
            <div class="w-2/5">
              <div class="card card-outline card-info shadow-lg rounded-lg">
                <div class="card-header">
                  <h3 class="card-title">Consulta en el Mes</h3>
                </div>  
                <div class="card-body flex flex-col items-center text-center p-4">
                  <canvas id="consultasChart" class="chartjs-render-monitor w-full sm:w-2/3 md:w-1/2 lg:w-2/5 xl:w-1/3 h-64 md:h-80 lg:h-96"></canvas>
                </div>
              </div>
            </div>

            <div class="w-2/5">
              <div class="card card-outline card-danger shadow-lg rounded-lg">
                <div class="card-header">
                  <h3 class="card-title">Sesiones en el Mes</h3>
                </div> 
                <div class="card-body flex flex-col items-center text-center p-4">
                  <canvas id="sesionesChart" class="chartjs-render-monitor w-full sm:w-2/3 md:w-1/2 lg:w-2/5 xl:w-1/3 h-64 md:h-80 lg:h-96"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </x-app-layout>
@stop

@section('css')
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      const dias = @json($dias);
      const consultasCount = @json($consultasCount);
      const sesionesCount = @json($sesionesCount);

      // Configuración del gráfico de Consultas
      const ctxConsultas = document.getElementById('consultasChart').getContext('2d');
      const consultasChart = new Chart(ctxConsultas, {
          type: 'bar',
          data: {
              labels: dias,
              datasets: [{
                  label: 'Consultas',
                  data: consultasCount,
                  backgroundColor: 'rgba(75, 192, 192, 0.6)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                  y: {
                      beginAtZero: true,
                      title: {
                          display: true,
                          text: 'Número de Consultas'
                      },
                      ticks: {
                          stepSize: 1, // Solo números enteros
                          callback: function(value) {
                              return Number.isInteger(value) ? value : ''; // Ocultar valores decimales
                          }
                      }
                  },
                  x: {
                      title: {
                          display: true,
                          text: 'Días'
                      }
                  }
              },
              plugins: {
                  legend: {
                      position: 'top'
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return ` ${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                          }
                      }
                  }
              }
          }
      });

      // Configuración del gráfico de Sesiones
      const ctxSesiones = document.getElementById('sesionesChart').getContext('2d');
      const sesionesChart = new Chart(ctxSesiones, {
          type: 'bar',
          data: {
              labels: dias,
              datasets: [{
                  label: 'Sesiones',
                  data: sesionesCount,
                  backgroundColor: 'rgba(153, 102, 255, 0.6)',
                  borderColor: 'rgba(153, 102, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                  y: {
                      beginAtZero: true,
                      title: {
                          display: true,
                          text: 'Número de Sesiones'
                      },
                      ticks: {
                          stepSize: 1, // Solo números enteros
                          callback: function(value) {
                              return Number.isInteger(value) ? value : ''; // Ocultar valores decimales
                          }
                      }
                  },
                  x: {
                      title: {
                          display: true,
                          text: 'Días'
                      }
                  }
              },
              plugins: {
                  legend: {
                      position: 'top'
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return ` ${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                          }
                      }
                  }
              }
          }
      });
  </script>
@stop
