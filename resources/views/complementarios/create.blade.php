@extends('layouts.app')

@section('titulo','Documento Complementario')

@section('content')

<div class="pagetitle mb-0">
    <h1>DOCUMENTOS COMPLEMENTARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Adjuntar Documento Complementario</li>
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
            <p>Todos los campos son de ingreso obligatorio. Para adjuntar un documento se debe seleccionar el archivo, agregar la descripcion correspondiente y presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción presione el botón <strong>SALIR</strong>.</p>
           <div class="d-flex justify-content-center">
           <div class="col-md-10">
           <form action="{{route('complementarios.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
            <div class="row mb-3">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                        <label for="example-text-input" class="form-control-label">Documento Complementario</label><span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="nombre" id="" class="form-control text-center {{ $errors->has('nombre') ? ' error' : '' }}"  accept="application/pdf">
                        @if ($errors->has('nombre'))
                            <span class="text-danger">
                                {{ $errors->first('nombre') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group d-flex">
                  <div class="col-md-4">
                    {{Form::label('descripcion','Descripcion' )}} <span class="text-danger">(*)</span>
                  </div>
                  <div class="col-md-8">
                    <input id="descripcion" type="text" class="form-control text-center {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    @if ($errors->has('descripcion'))
                        <span class="text-danger">
                            {{ $errors->first('descripcion') }}
                        </span>
                    @endif
                  </div>
              </div>
          </div>          
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('complementarios_empleados.index') }}" class="btn btn-danger">Salir</a>
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
@if(count($complementarios)>0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Documentos Complementarios Registrados</h5>
          <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción Eliminar y volver a ingresarlo.</p>
         <!--CONTENIDO -->
         <div class="d-flex align-items-center justify-content-between">
           @if(count($complementarios)>1)
            <a href="{{ route('complementarios.show', $empleado->uuid) }}" class="btn btn-info" target="_blank">Ver Todos los Adjuntos</a>
           @endif
         </div>
         <div class="table-responsive">

         </div>
            <table class="table table-hover table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Descripcion</th>
                  <th class="text-center">Fecha registro</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($complementarios as  $key=>$document)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $document->descripcion }}</td>
                    <td class="text-center">{{ date('d/m/Y',strtotime($document->created_at)) }}</td>
                    <td class="d-flex align-items-center justify-content-center">
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                          </button>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ asset('documentos_complementarios/'.$document->nombre)}}" target="_blank">Ver Adjunto</a></li>
                              @can('complementarios.destroy')
                              <li><a class="dropdown-item" href="{{ route('complementarios.destroy',$document->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar el Documento Complementario?');">Eliminar Adjunto</a></li>
                              @endcan
                          </ul>
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