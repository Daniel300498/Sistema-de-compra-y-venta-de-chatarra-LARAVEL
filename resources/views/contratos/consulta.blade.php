@extends('layouts.app')
@section('titulo','Contratos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Contratos</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Buscar el Empleado</h5>
            <p>Busque al empleado por el <strong>NOMBRE</strong> o por el n&uacute;mero de <strong>C.I.</strong></p>
            <form action="{{ route('contratos.consulta') }}" method="post">     
                @csrf
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre Empleado</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                    <div class="col-lg-8">
                        <input type="text" name="ci" id="ci" class="form-control">
                    </div>
                </div>
                 <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar Empleado</button>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@if ($cargoEmpleado != null)
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos asignados a los empleados</h5>
                    <p>En esta secci&oacute;n aparecer&aacute;n los empleados con cargos asignados actualmente, es decir el personal <strong> ACTIVO</strong> de la instituci&oacute;n.</p>
                    Desde <strong>Opciones</strong> puede declarar el item en ac&eacute;falo, es decir retirar al empleado de su cargo.
                    <div class="table-responsive">
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm"> <thead>
                                <tr>
                                    <th class="text-center">NRO DE ITEM</th>
                                    <th class="text-center">NOMBRE COMPLETO</th>
                                    <th class="text-center">CI</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">FECHA INICIO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cargoEmpleado as $ce)
                                     <tr>    
                                        @if ($ce->cargo->nro_item)
                                        <td class="text-center">{{ $ce->cargo->nro_item}}</td>    
                                        @else
                                        <td class="text-center">{{ $ce->cargo->tipo_cargo}}</td>
                                        @endif
                                        <td class="text-center">{{$ce->empleado->nombres}} {{ $ce->empleado->ap_paterno }} {{ $ce->empleado->ap_materno }}</td>
                                        <td class="text-center">{{$ce->empleado->ci}} @if($ce->empleado->ci_complemento != null) - {{ $ce->empleado->ci_complemento }} @endif {{ $ce->empleado->ci_lugar }}</td>
                                        <td class="text-center">{{$ce->cargo->nombre}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($ce->fecha_inicio))}}</td>
                                        <td class="d-flex justify-content-center" >
                                            @can('contratos.create')
                                                <a href="{{route('contratos.create',$ce->empleado->uuid)}}" class="btn btn-warning" title="Adjuntar un contrato"><i class="bi-paperclip"></i></a>
                                            @endcan
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
@endif
@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection