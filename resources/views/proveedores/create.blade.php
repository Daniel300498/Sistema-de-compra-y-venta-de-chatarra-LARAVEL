
@extends('layouts.app')
@section('titulo','Nuevo Paciente')
@section('content')

<div class="pagetitle">
    <h1>REGISTRO PROVEEDORES
    </h1>
    <nav>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proveedores.create') }}">Registro Proveedores</a></li>
        <li class="breadcrumb-item active">Nuevo Proveedor</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Proveedor</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'proveedores.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('proveedores._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('proveedores.modals._modal_instituto')
@include('proveedores.modals._modal_profesion')
@include('proveedores.modals._modal_formacion')
@include('proveedores.modals._modal_ciudad')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/proveedoresControlCampos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaCiudad.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection
