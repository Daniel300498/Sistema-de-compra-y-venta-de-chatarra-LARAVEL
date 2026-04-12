@extends('layouts.app')
@section('titulo','Portal Web - Noticias')
@section('content')
<div class="pagetitle">
    <h1>Portal Web</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Agregar Publicaciones</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de la Publicación</h5>
           <!--CONTENIDO -->
           {!! Form::model($publicacion,['route'=>['publicacion.update',$publicacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('publicaciones._form',['texto' => 'Guardar','color'=>'success'])
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
