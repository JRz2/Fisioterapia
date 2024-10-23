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
                          <h3>{{$npacientes}}</h3>
                          <p>Pacientes</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  
                    <div class="col-lg-3 col-md-6">
                      <div class="small-box bg-gradient-primary">
                        <div class="inner">
                          <h3>{{$nconsultas}}</h3>
                          <p>Consultas</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-folder"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  
                    <div class="col-lg-3 col-md-6">
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{$nsesiones}}</h3>
                          <p>Sesiones</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-heart-pulse"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  
                    <div class="col-lg-3 col-md-6">
                      <div class="small-box bg-secondary">
                        <div class="inner">
                          <h3>150</h3>
                          <p>Calendario</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-calendar"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  

                <div >
                    <div>
                        <div class="card card-outline card-success">
                            <div class="card-header">
                              <h3 class="card-title">Ultimas consultas</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <a href="">ver todos</a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Equipo</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <a href="">ver todos</a>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop

@section('js')

@stop