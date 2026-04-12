@extends('layouts.app')

@section('titulo','Adjuntar Licencia Firmada')

@section('content')

<div class="pagetitle">
    <h1>LACTANCIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Registro Lactancia</a></li>
        <li class="breadcrumb-item"><a href="#">Ver Firmas Prenatal</a></li>
        <li class="breadcrumb-item active">Agregar Documentos de Firmas</li>
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
           <p>Adjuntar el archivo correspondiente con las firmas prenatales.</p>
           @if($lactancia->documento_firmas == null)
           <form action="{{route('ficha_firmas.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="lactancia_id" id="lactancia_id" value="{{ $lactancia->id }}">
            <div class="col-md-12">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                        <label for="example-text-input" class="form-control-label">Documento</label> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="documento" id="" class="form-control"   accept="application/pdf">
                    </div>
                </div>
            
            </div>   
            <br>  
            <div class="col-md-12">
              <div class="form-group d-flex">
                  <div class="col-md-4">
                    {{Form::label('observacion','Observacion' )}}
                  </div>
                  <div class="col-md-8">
                    <input id="observacion" type="text" class="form-control text-center {{ $errors->has('observacion') ? ' error' : '' }}" name="observacion" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    @if ($errors->has('observacion'))
                        <span class="text-danger">
                            {{ $errors->first('observacion') }}
                        </span>
                    @endif
                  </div>
              </div>
          </div>              
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('lactancias.indexFirmas') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
         <br>
         @endif
            @if($lactancia->documento_firmas!= null)
            <hr>
            <div class="text-center">
              <h6>Archivo Adjunto de respaldo</h6>
                <embed src="{{ asset('documentos_lactancia/'.$lactancia->documento_firmas) }}" type="application/pdf" width="420px" height="630px">

            </div>
            @endif

        
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection