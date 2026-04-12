@extends('layouts.app')
@section('titulo','Informe De Actividades Desarrolladas')
@section('content')
<div class="pagetitle">
    <h1>Comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Comisiones</a></li>
        <li class="breadcrumb-item active">Agregar Informe De Actividades Desarrolladas</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Adjuntar documento</h5>
            <p>Se debe adjuntar el archivo correspondiente y luego presionar el botón <strong>Guardar</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           <form action="{{route('comisiones_ficha_firmada.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="comision_id" id="comision_id" value="{{ $comision->id }}">
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <label for="example-text-input" class="form-control-label">Seleccionar documento <span class="text-danger">(*)</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="documento" id=""   accept="application/pdf" required>
                        @if ($errors->has('informe'))
                           <span class="text-danger">
                               {{ $errors->first('informe') }}
                           </span>
                       @endif
                    </div>
                </div>
            
            </div>                  
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('comisiones.create',$empleado->uuid) }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
         <br>
            @if($comision->informe != null)
            <hr>
            <div class="text-center">
              <h6>Archivo Adjunto Informe De Actividades Desarrolladas</h6>
                <embed src="{{ asset('comisiones_actividades_desarrolladas/'.$comision->informe) }}" type="application/pdf" width="420px" height="630px">
            </div>
            @endif
        
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endSection