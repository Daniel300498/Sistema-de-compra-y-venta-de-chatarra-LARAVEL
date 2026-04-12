@extends('layouts.app')
@section('titulo', 'Camas')
@section('content')
<div class="pagetitle">
    <h1>Salas y Camas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Salas y Camas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Ver Salas</a></li>
            <li class="breadcrumb-item active">Nueva Cama</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Nueva Cama</h5>
            <h3><span class="badge bg-nombre-empleado">SALA: {{$sala->nombre}}</span></h3>  
            </div>
            <!--CONTENIDO -->
           {!! Form::open(['route'=>'camas.store', 'class'=>'row g-3', 'enctype'=>"multipart/form-data"]) !!}
                @include('camas._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@include('camas.secciones.camas_sala')

@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}"></script>
<script>$("#depende_id").select2({placeholder: '--SELECCIONE--',width: 'resolve' }).on('select2-open', function () {$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();});</script>
@endsection


