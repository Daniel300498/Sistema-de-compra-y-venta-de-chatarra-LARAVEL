
@extends('layouts.app')
@section('titulo','Nueva Sala')
@section('content')

<div class="pagetitle">
    <h1>Salas y Camas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas y Camas</a></li>
        <li class="breadcrumb-item active">Nueva Sala</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Sala</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'salas.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('salas._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

