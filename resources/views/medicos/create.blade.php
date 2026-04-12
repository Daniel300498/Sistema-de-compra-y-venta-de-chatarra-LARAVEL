
@extends('layouts.app')
@section('titulo','Nuevo Medico')
@section('content')

<div class="pagetitle">
    <h1>REGISTRO DE M&eacute;DICOS
    </h1>
    <nav>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('medicos.create') }}">Registro M&eacute;dicos</a></li>
        <li class="breadcrumb-item active">Nuevo M&eacute;dico</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo M&eacute;dico</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'medicos.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('medicos._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('medicos.modals._modal_instituto')
@include('medicos.modals._modal_profesion')
@include('medicos.modals._modal_formacion')
@include('medicos.modals._modal_ciudad')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/medicosControlCampos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaCiudad.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection
