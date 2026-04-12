
@extends('layouts.app')
@section('titulo','Nuevo Cargo')
@section('content')

<div class="pagetitle">
    <h1>CARGOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Cargos</a></li>
        <li class="breadcrumb-item active">Nuevo Cargo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Cargo</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'cargos.store','class'=>'form-horizontal']) !!}
                @include('cargos._form',['texto' => 'Guardar','color'=>'primary'])
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
