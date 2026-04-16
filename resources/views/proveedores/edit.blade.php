@extends('layouts.app')
@section('titulo','Editar Paciente')
@section('content')

<div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del proveedor</h5>
           <!--CONTENIDO -->
           {!! Form::model($proveedor,['route'=>['proveedores.update',$proveedor->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('proveedores._form',['texto' => 'Actualizar','color'=>'success'])
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
<script src="{{ asset('assets/js/jquery-ui.js') }} " type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaCiudad.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection

