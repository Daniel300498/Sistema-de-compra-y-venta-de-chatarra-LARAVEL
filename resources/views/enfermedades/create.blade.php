@extends('layouts.app')

@section('titulo','Enfermedad Terminal')

@section('content')

<div class="pagetitle">
    <h1>Enfermedad Terminal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Agregar documento de Enfermedad Terminal</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
             <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>

              <!--CONTENIDO -->
              {!! Form::open(['route'=>'enfermedades.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                  @include('enfermedades._form',['texto' => 'Adjuntar','color'=>'primary'])
              {!! Form::close() !!}
              <!-- EndCONTENIDO Example -->


          </div>
        </div>
      </div>
    </div>
</section>

@endSection