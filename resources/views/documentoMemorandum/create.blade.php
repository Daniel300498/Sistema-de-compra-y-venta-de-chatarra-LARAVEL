@extends('layouts.app')

@section('titulo','Documento Complementario')

@section('content')

<div class="pagetitle mb-0">
    <h1>DOCUMENTOS MEMOR&Aacute;NDUMS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Memor&aacute;ndums</a></li>
        <li class="breadcrumb-item"><a href="{{route('documento_memorandum.index')}}">Otros Memor&aacute;ndums</a></li>
        <li class="breadcrumb-item active">Adjuntar Documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Adjuntar documento</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p>Todos los campos son de ingreso obligatorio. Para adjuntar un documento se debe seleccionar el archivo, agregar la descripci&oacute;n correspondiente y presionar el bot&oacute;n <strong>GUARDAR</strong>. Si no desea realizar ninguna acci&oacute;n presione el bot&oacute;n <strong>SALIR</strong>.</p>
           <div class="d-flex justify-content-center">
           <div class="col-md-10">
           <form action="{{route('documento_memorandum_store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
            <div class="col-md-12">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                      {{Form::label('fecha_registro','Fecha Registro' )}} <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                      <input id="fecha_registro" type="date" class="form-control text-center {{ $errors->has('fecha_registro') ? ' error' : '' }}" name="fecha_registro">
                      @if ($errors->has('fecha_registro'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_registro') }}
                          </span>
                      @endif
                    </div>
                </div>
            </div> 
            <br>
            <div class="row mb-3">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                        <label for="example-text-input" class="form-control-label">Documento Memor&aacute;ndum</label><span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="archivo" id="" class="form-control text-center {{ $errors->has('archivo') ? ' error' : '' }}"  accept="application/pdf">
                        @if ($errors->has('archivo'))
                            <span class="text-danger">
                                {{ $errors->first('archivo') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="row mb-3">
              <div class="form-group d-flex">
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Tipo Memor&aacute;ndum</label><span class="text-danger">(*)</span>
              </div>
             <div class="col-md-8">
           
              <select name="tipo" class="form-control {{ $errors->has('tipo') ? ' error' : '' }}" id="tipo">
                <option value="" selected>-- SELECCIONE --</option>
                @foreach ($tipos as $t )
                    <option value="{{ $t->id }}" {{ old('tipo', $documentos) == $t->descripcion ? 'selected' : '' }}> {{ $t->descripcion }}</option>
                @endforeach
              </select>
              @if ($errors->has('tipo'))
                      <span class="text-danger">
                          {{ $errors->first('tipo') }}
                      </span>
              @endif
          </div>
        </div>
      </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('documento_memorandum.index') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
        </div>
      </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@if(count($documentos)>0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Documentos Memor&aacute;ndums Registrados</h5>
          <p>Si necesita realizar una correcci&oacute;n del registro previamente ingresado puede utilizar la opci&oacute;n Eliminar y volver a ingresarlo.</p>
         <!--CONTENIDO -->
         <div class="d-flex align-items-center justify-content-between">
           @if(count($documentos)>1)
            <a href="{{ route('documento_memorandum_show', $empleado->id) }}" class="btn btn-info" target="_blank">Ver Todos los Adjuntos</a>
           @endif
         </div>
         <br>
         <div class="table-responsive">

         </div>
            <table class="table table-hover table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Tipo de Memor&aacute;ndum</th>
                  <th class="text-center">Fecha registro</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($documentos as  $key=>$document)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center"> {{$document->tipo_id->descripcion}} </td>
                    <td class="text-center">{{ date('d/m/Y',strtotime($document->fecha_registro)) }}</td>
                    <td class="d-flex align-items-center justify-content-center">
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                          </button>
                          <ul class="dropdown-menu">
                             @can('documento_memorandum.show')
                             <li><a class="dropdown-item" href="{{ asset('documentos_memorandums/'.$document->archivo)}}" target="_blank">Ver Adjunto</a></li>
                             @endcan
                             @can('documento_memorandum.destroy')
                             <li><a class="dropdown-item" href="{{ route('documento_memorandum_destroy',$document->id) }}" onclick="return confirm('¿Está seguro que desea eliminar documento memor&aacute;ndum?');">Eliminar Documento</a></li>
                             @endcan   </ul>
                        </div>
                      </div>
                   </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          <br><br>
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>


@endsection