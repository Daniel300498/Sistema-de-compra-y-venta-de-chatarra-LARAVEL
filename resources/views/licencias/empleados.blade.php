@extends('layouts.app')
@section('titulo','Licencias')
@section('content')
<div class="pagetitle">
    <h1>Licencias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Nueva Licencia</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Crear una nueva solicitud de licencia</h5>
            <p class="mb-0">Para comenzar con el registro de licencia se debe presionar el botón <button class="btn btn-warning btn-sm"><i class="bi bi-journal-plus"></i></button> para acceder al formulario de registro.
            </p >
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
            @if ($empleados != null)
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nro Item</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $e)
                        <tr>
                            <td class="text-center">{{ $e->cargo[0]->nro_item  }}</td>
                            <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                            <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                            <td>{{ $e->cargo[0]->nombre  }}</td>
                            <td>{{ $e->cargo[0]->area->nombre  }}</td>
                            <td class="d-flex justify-content-center" >
                                @can('licencias.create')
                                    <a href="{{route('licencias.create',$e->id)}}" class="btn btn-warning" title="Registrar una Nueva licencia"><i class="bi bi-journal-plus"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
           @endif
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
