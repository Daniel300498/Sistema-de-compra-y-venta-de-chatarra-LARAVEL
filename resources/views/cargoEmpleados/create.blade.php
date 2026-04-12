
@extends('layouts.app')
@section('titulo','Nueva Asignación')
@section('content')

<div class="pagetitle">
    <h1>Asignación de Cargo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inio</a></li>
        <li class="breadcrumb-item active">Nueva asignación de cargo</li>
      </ol>
    </nav>
 </div>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Asignación de Cargo a Empleado</h5>
           {!! Form::open(['route'=>'cargoEmpleados.store','class'=>'form-horizontal']) !!}
                @include('cargoEmpleados._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

