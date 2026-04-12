@extends('layouts.app')
@section('titulo','Comisión')
@section('content')
@section('content')
<div class="pagetitle">
    <h1>Comisiones</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Comisiones</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registrar Nueva Comisión</h5>
            <p class="mb-0">Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado al cual se quiere asignar una comision y presionar el botón <strong>Buscar Empleado</strong>. Tambien puede obtener el listado de todos los empleados presionando el mismo botón.</p >
                  <p></p> 
                    <form action="{{route('buscar_empleado_comisiones')}}" method="post">
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
           <h5 class="card-title">Empleado(s) encontrados según la b&uacute;squeda</h5>
           <p class="text-justify">Cada registro tiene la opci&oacute;n de adjuntar un documento, presionando el bot&oacute;n <span class="btn btn-warning"><i class="bi-plus-circle"></i></span> podr&aacute; acceder al formulario correspondiente.</p>
                <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
               <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $e)
                        <tr>
                            <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                            <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                            <td>
                                {{$e->cargo}}
                                 </tdclass=>
                                 <td class="d-flex justify-content-center" >
                                    @can('comisiones.create')
                                        <a href="{{route('comisiones.create',$e->uuid)}}" class="btn btn-warning" title="Ver / Registrar una comision"><i class="bi-plus-circle"></i></a>
                                    @endcan
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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