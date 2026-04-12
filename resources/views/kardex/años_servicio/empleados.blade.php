@extends('layouts.app')
@section('titulo','Años de Servicio')
@section('content')

@section('content')

<div class="pagetitle mb-0">
    <h1>KARDEX</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Kardex</a></li>
            <li class="breadcrumb-item active">Años de Servicio</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados</h5>
            <p>Para adjuntar los documentos de años de servicio debe presionar en el botón <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span></p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
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
                                <td class="text-center">{{ $e->cargo->nro_item}}</td>
                                <td> {{ $e->empleado->nombres}} {{$e->empleado->ap_paterno}} {{$e->empleado->ap_materno}}</td>
                                <td class="text-center">{{$e->empleado->ci}}</td>
                                <td>{{$e->cargo->nombre}} </td>
                                <td>{{$e->cargo->area->nombre}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('servicio_años.create')
                                        <a href="{{route('años_servicio.create',$e->empleado->uuid)}}" class="btn btn-warning" title="Ver / Registrar Años de servicio"><i class="bi-paperclip"></i></a>
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
