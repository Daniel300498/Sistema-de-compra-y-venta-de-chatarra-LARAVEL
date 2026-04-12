@extends('layouts.app')

@section('titulo','Documentacion')

@section('content')

<div class="pagetitle">
    <h1>Documentaci&oacute;n</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('historialcvs.index') }}">Documentaci&oacute;n</a></li>
        <li class="breadcrumb-item active">Historial Curriculum Vitae</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Actualizar Historial Curriculum Vitae</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
            <!--CONTENIDO -->
     
            <form action="{{route('historialcvs.store')}}" method="POST" enctype="multipart/form-data">
             {{ csrf_field()}}
             <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
               <div class="row">
                <div class="col-lg-4">
                    <label for="example-text-input" class="form-control-label">Documento De Grado</label><span class="text-danger">(*)</span>
                    <input   type="file" name="nombre" id="" class="form-control text-center {{ $errors->has('nombre') ? ' error' : '' }}"  accept="application/pdf">
                    @if ($errors->has('nombre'))
                        <span class="text-danger">
                            {{ $errors->first('nombre') }}
                        </span>
                    @endif
                </div>
                
                 <div class="col-lg-4">
                    {{Form::label('institucion_formacion','Universidad o Instituto' )}} <span class="text-danger">(*)</span>                
                        <select  name="institucion_formacion_id" id="institucion_formacion_id" class="form-control {{ $errors->has('institucion_formacion_id') ? ' error' : '' }}">
                            <option value="">-- SELECCIONE --</option>
                            @foreach ($instituciones_formacion as $institucion)
                                <option value="{{ $institucion->id }}" {{ old('institucion_formacion_id',$empleado->institucion_formacion_id) == $institucion->id ? 'selected' : '' }}>{{ $institucion->descripcion }}</option>
                            @endforeach
                        </select>
                       
                        @if ($errors->has('institucion_formacion_id'))
                            <span class="text-danger">
                                {{ $errors->first('institucion_formacion_id') }}
                            </span>
                        @endif
                  
                 </div>
                 <div class="col-lg-4">
                    {{Form::label('formacion','Formación' )}} <span class="text-danger">(*)</span>
                        <select  name="formacion_id" id="formacion_id" class="form-control {{ $errors->has('formacion_id') ? ' error' : '' }}">
                            <option value="">-- SELECCIONE --</option>
                            @foreach ($formaciones as $formacion)
                                <option value="{{ $formacion->id }}" {{ old('formacion_id',$empleado->formacion_id) == $formacion->id ? 'selected' : '' }}>{{ $formacion->descripcion }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('formacion_id'))
                            <span class="text-danger">
                                {{ $errors->first('formacion_id') }}
                            </span>
                        @endif
               </div>
               </div>
               <br>
               <div class="row">
                <div class="col-lg-4">
                    <label for="example-text-input" class="form-control-label">Hoja De Vida</label><span class="text-danger">(*)</span>
                    <input type="file" name="hoja_vida" id="" class="form-control text-center {{ $errors->has('hoja_vida') ? ' error' : '' }}"  accept="application/pdf"  >
                    @if ($errors->has('hoja_vida'))
                            <span class="text-danger">
                                {{ $errors->first('hoja_vida') }}
                            </span>
                        @endif
                  </div>
            </div>
             <div class="text-center mt-3">
                 <button type="submit" class="btn btn-primary">Guardar</button>
                 <a href="{{ route('historialcvs.index') }}" class="btn btn-warning">Salir</a>
             </div>
          </form>
          <br>
              <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div> 
</section>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title">Historial Curriculum Vitae</h5>
        </div>
        @if(count($historial)>0)
        <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción Modificar datos y volver a ingresarlo.</p>
        <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
             
              <th class="text-center">Nombre Empleado</th>
              <th class="text-center">Fecha Registro</th>
              <th class="text-center">Grado Obtenido</th>
              <th class="text-center">Lugar De Formacion</th>
            </tr>
            @foreach ($historial as  $key=>$document)
              <tr>
                <td><center>{{$empleado->nombres}} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</center></td>
                <td><center>{{ $document->fecha_registro }}</center></td>
                <td class="text-center">{{ $document->formacion_id->descripcion }}</td>
                <td class="text-center">{{ $document->lugar_formacion_id->descripcion }}</td>
              </tr>
            @endforeach
          </table>
        @endif
      
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
   
</section>
@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection