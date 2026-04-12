@extends('layouts.app')
@section('titulo','Pacientes')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO PACIENTES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro Pacientes</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        @can('pacientes.create')
            <a href="{{route('pacientes.create')}}" class="btn btn-primary MB-3">Registrar Paciente</a>
        @endcan
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacientes Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">CI</th>
                                            <th class="text-center">Nombre Completo</th>
                                            <th class="text-center">Fecha de Nacimiento</th>
                                            <th class="text-center">Numero de Celular</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pacientes as $e)
                                                <tr>
                                                     <td class="text-center">{{$e->ci}} @if(!$e->ci_complemento) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                                    <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                                    <td>{{$e->fecha_nacimiento}}</td>
                                                    <td>{{$e->nro_celular}}</td>
                                                       <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @can('pacientes.edit')
                                                                        <li><a class="dropdown-item" href="{{route('pacientes.edit',$e->uuid)}}">Modificar Datos</a></li>
                                                                    @endcan

                                                                    @can('pacientes.destroy')
                                                                        <li><a class="dropdown-item" href="{{ route('pacientes.destroy',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar al paciente?');">Eliminar Paciente</a></li>
                                                                    @endcan
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
