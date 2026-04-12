@extends('layouts.app')

@section('titulo','Adjuntar Licencia Firmada')

@section('content')

<div class="pagetitle">
    <h1>LICENCIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Licencias</a></li>
        <li class="breadcrumb-item"><a href="#">Ver Registrados</a></li>
        <li class="breadcrumb-item active">Agregar Comprobante</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Agregar documento</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
           <!--CONTENIDO -->
           <p>Adjuntar el archivo correspondiente a la licencia firmada.</p>
           @if($licencia->ficha_firmada == null)
           <form action="{{route('ficha_comprobante.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="licencia_id" id="licencia_id" value="{{ $licencia->id }}">
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <label for="example-text-input" class="form-control-label">Comprobante</label> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="documento" id=""   accept="application/pdf">
                    </div>
                </div>
            
            </div>                  
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('licencias.index') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
         <br>
         @endif
            @if($licencia->documento_respaldo!= null)
            <hr>
            <div class="text-center">
              <h6>Archivo Adjunto de respaldo</h6>
                <embed src="{{ asset('licencias/'.$licencia->documento_respaldo) }}" type="application/pdf" width="420px" height="630px">

            </div>
            @endif

        
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection