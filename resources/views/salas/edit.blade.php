@extends('layouts.app')
@section('titulo','Editar Sala')
@section('content')

<div class="pagetitle">
    <h1>Salas y Camas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas y Camas</a></li>
        <li class="breadcrumb-item active">Modificar Sala</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de la Sala</h5>
           <!--CONTENIDO -->
           {!! Form::model($sala,['route'=>['salas.update',$sala->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('salas._form',['texto' => 'Guardar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
 

