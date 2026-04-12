@extends('layouts.app')

@section('titulo','Discapacidad')

@section('content')

<div class="pagetitle">
    <h1>REGISTRO DISCAPACIDAD</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discapacidades_empleados.index') }}">Registro Discapacidades</a></li>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Nuevo</a></li>
        <li class="breadcrumb-item active">Adjuntar documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Adjuntar Documento</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
           <!--CONTENIDO -->
           
           {!! Form::open(['route'=>['discapacidades.store',$empleado->id],'class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('discapacidad._form',['texto' => 'Guardar','tipo'=>'1'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection