@extends('layouts.app')
@section('titulo','Publicaciones - Noticias')
@section('content')
<div class="pagetitle">
    <h1>Publicaciones</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Publicaciones</a></li>
            <li class="breadcrumb-item active">Agregar Publicaciones</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Publicación</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'publicacion.store', 'class'=>'row g-3', 'enctype'=>"multipart/form-data"]) !!}
                @include('publicaciones._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('publicaciones.modal._modal_tipo')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/agregaTipo.js') }}" type="text/javascript"></script>
@endsection

