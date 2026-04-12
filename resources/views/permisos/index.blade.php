@extends('layouts.app')
@section('titulo','Permisos')
@section('content')
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Permisos</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
            </nav>
        </div>
        @can('permisos.create')
            <a href="{{route('permisos.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        @endcan
    </div>
 </div>
        
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Permisos registrados</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead >
                            <tr>
                                <th class="text-center">Nombre del acceso o ruta</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $p )
                                <tr>
                                    <td class="fw-bold">{{ $p->name }}</td>
                                    <td class="text-center">{{ $p->descripcion }}</td>
                                    <td class="text-center">{{$p->grupo}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('permisos.edit',$p->id) }}" class="btn btn-success btn-round">Editar</a>
                                        <a href="{{ route('permisos.destroy',$p->id) }}" class="btn btn-danger btn-round">Eliminar</a>
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
<script src="{{ asset('js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection