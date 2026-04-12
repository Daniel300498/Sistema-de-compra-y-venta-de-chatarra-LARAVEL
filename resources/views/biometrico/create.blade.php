@extends('layouts.app')

@section('titulo','Biometricos')

@section('content')

<div class="pagetitle">
    <h1>BIOMETRICO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Biometricos</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Crear Biometricos</h5>
          </div>
          <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
            <!--CONTENIDO -->
            {!! Form::open(['route'=>'devices.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('biometrico._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
  
</section>
 

@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection