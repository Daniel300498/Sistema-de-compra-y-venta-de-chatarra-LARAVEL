@extends('layouts.app')
@section('titulo','Editar Cargo')
@section('content')

<div class="pagetitle">
    <h1>Cargos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Cargos</a></li>
        <li class="breadcrumb-item active">Modificar Datosos del Cargo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del cargo</h5>
           <!--CONTENIDO -->
           {!! Form::model($cargo,['route'=>['cargos.update',$cargo->id],'method'=>'PUT']) !!}
                @include('cargos._form',['texto' => 'Guardar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/cargo.js') }}" type="text/javascript"></script>
@endsection

