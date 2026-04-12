@extends('layouts.app')

@section('titulo','Años de Servicio')

@section('content')

<div class="pagetitle mb-0">
    <h1>KARDEX</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('años_servicio.index') }}">Años de Servicio</a></li>
        <li class="breadcrumb-item active">Adjuntar Documentación</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Agregar Información</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p class="">Todos los campos son de ingreso obligatorio, para guardar la información en la base de datos debe presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción presione el botón <strong>SALIR</strong>.</p>
           <!--CONTENIDO -->
           <form action="{{route('años_servicio.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
            <div class="row">

                <div class="col-lg-4">
                    {{Form::label('años_servicio','Número de Años de Servicio' )}} <span class="text-danger">(*)</span>
                    <input type="number" name="nro_años" id="nro_años" class="form-control {{ $errors->has('nro_años') ? ' error' : '' }}" value="{{ old('nro_años') }}">
                    @if ($errors->has('nro_años'))
                        <span class="text-danger">
                            {{ $errors->first('nro_años') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('nro_meses','Número de Meses' )}} <span class="text-danger">(*)</span>
                  <input type="number" name="nro_meses" id="nro_meses" class="form-control {{ $errors->has('nro_meses') ? ' error' : '' }}" value="{{ old('nro_meses') }}">
                  @if ($errors->has('nro_meses'))
                      <span class="text-danger">
                          {{ $errors->first('nro_meses') }}
                      </span>
                  @endif
              </div>
              <div class="col-lg-4">
                {{Form::label('nro_dias','Número de Dias' )}} <span class="text-danger">(*)</span>
                <input type="number" name="nro_dias" id="nro_dias" class="form-control {{ $errors->has('nro_dias') ? ' error' : '' }}" value="{{ old('nro_dias') }}">
                @if ($errors->has('nro_dias'))
                    <span class="text-danger">
                        {{ $errors->first('nro_dias') }}
                    </span>
                @endif
            </div>
                <div class="col-lg-12 mt-4">
                    <div class=" d-flex align-items-center justify-content-center">
                        <label for="example-text-input">Documento de respaldo </label> <span class="text-danger">(*)</span> &nbsp;&nbsp;
                        <input type="file" name="archivo" class="{{ $errors->has('archivo') ? ' error' : '' }}"   accept="application/pdf">
                        @if ($errors->has('archivo'))
                            <span class="text-danger">
                                {{ $errors->first('archivo') }}
                            </span>
                        @endif
                    </div>
                </div>                  
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('años_servicio.index') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@if(count($años_servicio)>0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Documentación de Años de Servicio registrados</h5>
            @if(count($años_servicio)>1)
            <a href="{{ route('años_servicio.show', $empleado->uuid) }}" class="btn btn-info" target="_blank">Ver Todos los Adjuntos</a>
            @endif
          </div>
          <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción Eliminar y volver a ingresarlo.</p>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Nro Años</th>
                  <th class="text-center">Nro Meses</th>
                  <th class="text-center">Nro Dias</th>
                  <th class="text-center">Fecha registro</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($años_servicio as  $key=>$document)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center"> {{ $document->nro_años }}</td>
                    <td class="text-center"> {{ $document->nro_meses }}</td>
                    <td class="text-center"> {{ $document->nro_dias }}</td>
                    <td class="text-center">{{ date('d/m/Y',strtotime($document->created_at)) }}</td>
                    <td class="d-flex align-items-center justify-content-center">
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                          </button>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ asset('documentos_empleados/años_servicio/'.$document->archivo)}}" target="_blank">Ver Adjunto</a></li>
                              @can('servicio_años.destroy')
                              <li><a class="dropdown-item" href="{{ route('años_servicio.destroy',$document->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar el documento?');">Eliminar Registro</a></li>
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
          </div>
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