@extends('layouts.app')
@section('titulo','Medicos')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO DE M&Eacute;DICOS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro M&eacute;dicos</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        @can('medicos.create')
            <a href="{{route('medicos.create')}}" class="btn btn-primary MB-3">Registrar M&eacute;dico</a>
        @endcan
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">M&eacute;dicos Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Especialidad</th>
                                            <th class="text-center">Nombre Completo</th>
                                            <th class="text-center">Telefono</th>
                                            <th class="text-center">Correo Electr&oacute;nico</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($medicos as $e)
                                                <tr>
                                                    <td>{{$e->especialidad}}</td>
                                                    <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                                    <td>{{$e->telefono}}</td>
                                                    <td>{{$e->correo}}</td>  
                                                        <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @can('medicos.edit')
                                                                        <li><a class="dropdown-item" href="{{route('medicos.edit',$e->uuid)}}">Modificar Datos</a></li>
                                                                    @endcan
                                                                    @can('medicos.destroy')
                                                                        <li><a class="dropdown-item" href="{{ route('medicos.destroy',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar al medico?');">Eliminar medico</a></li>
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
