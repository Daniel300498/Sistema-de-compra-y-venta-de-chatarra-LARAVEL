@extends('layouts.app')
@section('titulo','Editar Paciente')
@section('content')

<div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del paciente</h5>
           <!--CONTENIDO -->
           {!! Form::model($paciente,['route'=>['pacientes.update',$paciente->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('pacientes._form',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('pacientes.modals._modal_instituto')
@include('pacientes.modals._modal_profesion')
@include('pacientes.modals._modal_formacion')
@include('pacientes.modals._modal_ciudad')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/pacientesControlCampos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaCiudad.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection

