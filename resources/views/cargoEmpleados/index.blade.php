@extends('layouts.app')
@section('titulo', 'Cargos Asignados')
@section('content')

<div class="pagetitle">
    <h1>Cargos asignados</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Cargos Asignados</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos asignados a los empleados</h5>
                    <p>En esta sección aparecerán los empleados con cargos asignados actualmente, es decir el personal <strong> ACTIVO</strong> de la institución.</p>
                    Desde <strong>Opciones</strong> puede declarar el item en acéfalo, es decir retirar al empleado de su cargo.
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="datos">
                            <thead>
                                <tr>
                                    <th class="text-center">NRO DE ITEM</th>
                                    <th class="text-center">EMPLEADO</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">FECHA INICIO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cargoEmpleado as $ce)
                                     <tr>    
                                            <td>{{ $ce->cargo->nro_item}}</td>    
                                            <td>{{ $ce->empleado->ap_paterno}} {{ $ce->empleado->ap_materno}} {{ $ce->empleado->nombres}}</td>
                                            <td>{{ $ce->cargo->nombre}}</td>
                                            <td>{{ date('d-m-y', strtotime($ce->fecha_inicio)) }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @can('cargoEmpleados.store_liberar')
                                                               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#liberarItemModal-{{ $ce->id }}">Liberar Item</a></li>                                                        
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('cargoEmpleados.modals._modal_acefalo')
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


