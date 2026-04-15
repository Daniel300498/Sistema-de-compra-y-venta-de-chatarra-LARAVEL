@extends('layouts.app')
@section('titulo','proveedores')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO proveedores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro proveedores</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        @can('proveedores.create')
            <a href="{{route('proveedores.create')}}" class="btn btn-primary MB-3">+ Nuevo Proveedor</a>
        @endcan
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-left">Nombre</th>
                                            <th class="text-left">CI /NIT / RUC</th>
                                            <th class="text-left">Pais</th>
                                            <th class="text-left">Teléfono</th>
                                            <th class="text-left">Email</th>
                                            <th class="text-left">Dirección</th>
                                            <th class="text-left">Tipo de Producto</th>
                                            <th class="text-left">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proveedores as $e)
                                                <tr>
                                                     <td class="text-left">{{$e->nombre}}</td>
                                                    <td class="text-left">{{$e->nit}}</td>
                                                    <td class="text-left">{{$e->pais}}</td>
                                                    <td class="text-left">{{$e->telefono}}</td>
                                                    <td class="text-left">{{$e->email}}</td>
                                                    <td class="text-left">{{$e->direccion}}</td>
                                                    <td class="text-left">{{$e->tipo_producto}}</td>
                                                       <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @can('proveedores.edit')
                                                                        <li><a class="dropdown-item" href="{{route('proveedores.edit',$e->uuid)}}">Modificar Datos</a></li>
                                                                    @endcan

                                                                    @can('proveedores.destroy')
                                                                        <li><a class="dropdown-item" href="{{ route('proveedores.destroy',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar al proveedor?');">Eliminar Proveedor</a></li>
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
