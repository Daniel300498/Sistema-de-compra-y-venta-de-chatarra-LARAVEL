@extends('layouts.app')
@section('titulo','Editar cliente')
@section('content')

<div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del Cliente</h5>
           <!--CONTENIDO -->
           {!! Form::model($cliente,['route'=>['clientes.update',$cliente->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('clientes._form',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('clientes.modals._modal_instituto')
@include('clientes.modals._modal_profesion')
@include('clientes.modals._modal_formacion')
@include('clientes.modals._modal_ciudad')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/clientesControlCampos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaCiudad.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection

