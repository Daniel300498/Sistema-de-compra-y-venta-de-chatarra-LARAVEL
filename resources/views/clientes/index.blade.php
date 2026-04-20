@extends('layouts.app')
@section('titulo','Clientes')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO DE CLIENTES</h1>
        </div>
        @can('clientes.create')
            <a href="{{route('clientes.create')}}" class="btn btn-primary MB-3">+ Nuevo Cliente</a>
        @endcan
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clientes Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NOMBRE</th>
                                            <th class="text-center">NIT / RUC / CI</th>
                                            <th class="text-center">Pais</th>
                                            <th class="text-center">Tel&eacute;fono</th>
                                             <th class="text-center">Direcci&oacute;n</th>
                                            <th class="text-center">Correo Electr&oacute;nico</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $c)
                                        <tr>
                                            <td>{{ $c->nombre }}</td>
                                            <td>{{ $c->nit }}</td>
                                            <td>{{ $c->pais }}</td>  
                                            <td>
                                                @foreach($c->contacts->where('tipo','telefono') as  $index => $contacto)
                                                  Telefono {{$index+1}} :{{ $contacto->valor }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($c->contacts->where('tipo','direccion') as  $index => $contacto)
                                                  Direccion {{$index+1}} :{{ $contacto->valor }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $c->email }}</td>
                                        
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                            Opciones
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @can('clientes.edit')
                                                                <li><a class="dropdown-item" href="{{route('clientes.edit',$c->uuid)}}">Modificar Datos</a></li>
                                                            @endcan
                                                            @can('clientes.destroy')
                                                                <li>
                                                                    <a class="dropdown-item" 
                                                                    href="{{ route('clientes.destroy',$c->uuid) }}"
                                                                    onclick="return confirm('¿Está seguro que desea eliminar al cliente?');">
                                                                    Eliminar Cliente
                                                                    </a>
                                                                </li>
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
