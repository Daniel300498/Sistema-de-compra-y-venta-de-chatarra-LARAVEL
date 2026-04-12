@extends('layouts.app')

@section('titulo', 'Denominación del Cargo')

@section('content')

<div class="pagetitle">
    <h1>Denominación del cargo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Denominación del Cargo</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Agregar Denominación del Cargo</h5>
                    <!--CONTENIDO -->
                    {!! Form::model($cargoDenominacion,['route'=>['cargoDenominacion.update',$cargoDenominacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                    @include('cargoDenominacion._form',['texto' => 'Actualizar','color'=>'success'])
                    {!! Form::close() !!}
                    <!-- EndCONTENIDO Example -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
