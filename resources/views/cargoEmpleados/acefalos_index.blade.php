@extends('layouts.app')
@section('titulo', 'Cargos Acefalos')
@section('content')

<div class="pagetitle">
    <h1>Cargo de Empleados</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cargoEmpleados.acefalo_index') }}">Cargo de Empleados</a></li>
            <li class="breadcrumb-item active">Cargos Ac&eacute;falos</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos ac&eacute;falos (vacantes)</h5>
                    <p>En esta sección aparecerán los cargos que no están asignados a ningún empleado. Para asignarlo a uno presione en <strong>Opciones->Agregar a Empleado</strong>
                    de la fila correspondiente al cargo que desea asignar a algun usuario.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="datos">
                            <thead>
                                <tr>
                                    <th class="text-center">NÚMERO DE ITEM</th>
                                    <th class="text-center">DENOMINACI&Oacute;N DEL CARGO</th>
                                    <th class="text-center">&Aacute;REA</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">SUELDO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acefalos as $cargo)
                                    <tr>
                                        @if ($cargo->nro_item)                                       
                                        <td class="text-center">{{ $cargo->nro_item }}</td>
                                        @else
                                        <td class="text-center">{{ $cargo->tipo_cargo}}</td>
                                        @endif
                                        <td class="text-center">{{ $cargo->denominacion_cargo_nombre }}</td>
                                        <td class="text-center">{{ $cargo->area_nombre }}</td>
                                        <td class="text-center">{{ $cargo->nombre }}</td>
                                        <td class="text-center">{{ $cargo->sueldo }}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @can('cargoEmpleados.asignar')
                                                    <li><a class="dropdown-item" href="{{route('cargoEmpleados.asignar',$cargo->uuid)}}">Agregar a Empleado</a></li>
                                                    @endcan  
                                                </ul>
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