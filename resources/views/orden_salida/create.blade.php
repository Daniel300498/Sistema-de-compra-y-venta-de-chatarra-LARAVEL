@extends('layouts.app')
@section('titulo','Orden de Salida')
@section('content')
<div class="pagetitle">
    <h1>ORDEN DE SALIDA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('licencias_empleados.index') }}">Orden de Salida</a></li>
        <li class="breadcrumb-item active">Nueva Orden de Salida</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
                <!-- TITLE -->
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="card-title">Registrar Nueva Orden de Salida</h5>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                  <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</span></h3>
                </div>
                <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
                <!--CONTENIDO -->
                {!! Form::open(['route'=>'orden_salida.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                    @include('orden_salida._form',['texto' => 'Registrar','color'=>'primary'])
                {!! Form::close() !!}
                <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<link href="http://t4t5.github.io/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
<script src="http://t4t5.github.io/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>


@endsection