
@extends('layouts.app')
@section('titulo','Nuevo permiso')
@section('content')

<div class="pagetitle">
    <h1>PERMISOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permisos.index') }}">Permisos</a></li>
        <li class="breadcrumb-item active">Nuevo Permiso</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Permiso</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'permisos.store','class'=>'form-horizontal']) !!}
                @include('permisos._form',['texto' => 'Registrar','tipo'=>'1','texto_pass'=>'Contraseña','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/users.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/verContrasenia.js') }}" type="text/javascript"></script>
@endsection
