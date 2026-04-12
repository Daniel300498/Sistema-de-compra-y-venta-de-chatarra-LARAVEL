@extends('layouts.app')
@section('titulo','Asignacion Turno')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Asignacion Turno</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Asignacion Turno</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Asignacion Turno A Empleado</h5>
            <p>Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado para asignar el horario correspondiente y presione el botón <strong>Buscar Empleado</strong>. Tambien puede obtener el listado de todos los empleados presionando el botón <strong>Buscar Empleado</strong>.</p>
            <form action="{{route('asignacion_turno_buscar_empleado')}}" method="post">
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
            </form>
          
          </div>
        </div>
      </div>
    </div>
</section>
@if ($empleados != null)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleado(s) que coinciden con la busqueda</h5>
           <!--CONTENIDO -->
           <p class="mb-0">Presione sobre el botón <span class="btn btn-warning "><i class="bi bi-clock"></i></span> para asignar un turno al empleado.</p>
           <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
               <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nro Item</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $e)
                        <tr>
                            <td class="text-center">{{ $e->nro_item }}</td>
                            <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                            <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                            <td>
                               {{$e->cargo}}
                                 </td>
                                 <td class="d-flex justify-content-center" >
                                    @can('declaraciones.create')
                                        <a href="{{route('asignacion_turno.create',$e->id)}}" class="btn btn-warning" title="Ver / Registrar un DDJJ"><i class="bi bi-clock"></i></a>
                                    @endcan
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- EndCONTENIDO Example -->
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