@extends('layouts.app')
@section('titulo','Documentacion')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Documentaci&oacute;n</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('historialcvs.index') }}">Documentaci&oacute;n</a></li>
            <li class="breadcrumb-item active">Historial Curriculum Vitae</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Actualizar Curriculum Vitae</h5>
            <p>Ingresar nombre, apellidos o carnet de identidad para buscar al empleado. Tambi&eacute;n puede obtener el listado de todos los empleados presionando el bot&oacute;n <strong>Buscar Empleado</strong>.</p>
            <form action="{{route('buscar_empleado_historial')}}" method="post">
                @csrf
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">Empleado</label>
                    <div class="col-lg-8">
                    <select name="ci" id="ci" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" required>
                        <option value="" selected>-- SELECCIONE --</option>
                        @foreach ($empleados as $e)
                            <option value="{{ $e->id }}">{{ $e->ci }} - {{ $e->nombres  }} {{$e->ap_paterno}} {{$e->ap_materno}}</option>
                        @endforeach
                    </select>
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
@if ($empleado != null)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleado(s) que coinciden con la busqueda</h5>
           <!--CONTENIDO -->
           <p class="mb-0">Presione sobre el botón <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span> para acceder al formulario de registro correpondiente.</p>
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
                    <tr>
                        @if ($cargo)
                        <td class="text-center">{{$cargo->nro_item}}</td>
                        @else
                        <td class="text-center">FUNCIONARIO INACTIVO</td>
                        @endif
                        <td>{{$empleado->nombres}} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</td>
                        <td class="text-center">{{$empleado->ci}} @if($empleado->ci_complemento != null) - {{ $empleado->ci_complemento }} @endif {{ $empleado->ci_lugar }}</td>
                        @if ($cargo)
                        <td>{{$cargo->nombre}}</td>
                        @else
                        <td>FUNCIONARIO INACTIVO</td>
                        @endif
                             <td class="d-flex justify-content-center" >
                                @can('declaraciones.create')
                                    <a href="{{route('historialcvs.create',$empleado->uuid)}}" class="btn btn-warning" title="Ver / Registrar un DDJJ"><i class="bi-paperclip"></i></a>
                                @endcan
                            </td>
                    </tr>
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
<script>
    $("#ci").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
@endsection