@extends('layouts.app')
@section('titulo','Discapacidad')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>REGISTRO DISCAPACIDADES</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('discapacidades_empleados.index') }}">Registro Discapacidades</a></li>
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
            <h5 class="card-title">Empleados Registrados que indicaron discapacidad</h5>
            <p>Para adjuntar el documento de discapacidad solo debe presionar el bot&oacute;n <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span> asociado a cada registro de la tabla de empleados.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nro Item</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">&aacute;rea</th>
                            <th class="text-center">Empleado</th>
                            <th class="text-center">Opci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $e)
                            @if($e->discapacitado==null)
                                <tr>
                                    <td class="text-center">{{ $e->cargo[0]->nro_item }}</td>
                                    <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                    <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                    <td class="text-center">@foreach ($e->cargo as $c )
                                        <strong>{{$c->nombre}}</strong>
                                        @endforeach </td>
                                    <td>{{ $e->cargo[0]->area->nombre }}</td>
                                    <td class="text-center">
                                        @if($e->discapacidad==1)
                                        <h6><span class="badge bg-secondary">CON DISCAPACIDAD</span></h6>
                                        @else
                                        <h6><span class="badge bg-danger">ES TUTOR</span></h6>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('discapacidades.create')
                                            <a href="{{route('discapacidades.create',$e->id)}}" class="btn btn-warning" title="Adjuntar documento de discapacidad"><i class="bi-paperclip"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
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
