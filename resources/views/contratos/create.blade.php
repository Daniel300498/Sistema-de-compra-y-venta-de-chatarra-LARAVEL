@extends('layouts.app')
@section('titulo','Contratos')
@section('content')

<div class="pagetitle">
    <h1>Contratos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contratos.index') }}">Contratos</a></li>
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
              <h5 class="card-title">Nuevo Contrato</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
             <!--CONTENIDO -->
              {!! Form::open(['route'=>'contratos.store', 'class'=>'row g-3', 'enctype'=>"multipart/form-data"]) !!}
              @include('contratos._form',['texto' => 'Guardar','color'=>'primary'])
              {!! Form::close() !!}
              <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div> 
</section>
@include('contratos.secciones.contratos')
@endSection
