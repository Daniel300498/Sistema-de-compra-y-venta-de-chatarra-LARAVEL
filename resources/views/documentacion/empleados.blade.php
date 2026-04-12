@extends('layouts.app')
@section('titulo','Documentación')
@section('content')

@section('content')

<div class="pagetitle mb-0">
    <h1>DOCUMENTACIÓN</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Documentación</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados sin documentación</h5>
            <p>La lista despliega a todos los empleados de los que no se ha registrado la documentación, cada registro de la tabla tiene la opción para ingresar al formulario de registro correpondiente.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nro. Item</th>
                            <th class="text-center col-md-4">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Área</th>
                            <th class="text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $e)
                                <tr>
                                    <td class="text-center">{{$e->cargo->nro_item}}</td>
                                    <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }}</td>
                                    <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                    <td>{{$e->cargo->nombre}} <strong><small>({{ $e->cargo->tipo_cargo }})</small></strong></td>
                                    <td>{{ $e->cargo->area->nombre }}</td>
                                    <td class="d-flex justify-content-center" >
                                        @can('documentos.create')
                                            <a href="{{route('documentos.create',$e->empleado->uuid)}}" class="btn btn-warning" title="Registrar Recepción Documentos"><i class="bi-clipboard-check"></i></a>
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

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
