@extends('layouts.app')
@section('titulo','Internaciones')
@section('content')

<div class="pagetitle">
    <h1>REGISTRO DE INTERNACIONES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('internaciones.edit',$internacion->uuid) }}">Internaciones</a></li>
        <li class="breadcrumb-item active">Editar</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Editar Registro de Internacion</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $paciente->nombres }} {{ $paciente->ap_paterno }} {{$paciente->ap_materno }}</span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           {!! Form::model($internacion,['route'=>['internaciones.update',$internacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
            {{ csrf_field()}}
             <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

                <div class="row">
                  <div class="col-lg-4">
                {{ Form::label('fecha_ocupacion', 'Fecha de Ocupación') }} <span class="text-danger">(*)</span>
                <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control {{ $errors->has('fecha_ocupacion') ? 'error' : '' }}" value="{{ old('fecha_ocupacion', optional($internacion->fecha_ocupacion)->format('Y-m-d')) }}">
                    @error('fecha_ocupacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>

              <div class="col-lg-4">
                  {{ Form::label('fecha_desocupacion', 'Fecha de Desocupación') }}
                  <input type="date" name="fecha_desocupacion" id="fecha_desocupacion" class="form-control {{ $errors->has('fecha_desocupacion') ? 'error' : '' }}"value="{{ old('fecha_desocupacion', optional($internacion->fecha_desocupacion)->format('Y-m-d')) }}">
                  @error('fecha_desocupacion')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>  

                <div class="col-lg-4">
                    {{ Form::label('motivo', 'Motivo de la Internación') }} <span class="text-danger">(*)</span>
                    <input type="text" name="motivo" id="motivo" class="form-control {{ $errors->has('motivo') ? 'error' : '' }}" value="{{ old('motivo', $internacion->motivo) }}" >
                    @error('motivo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12">
                    {{ Form::label('observaciones', 'Observaciones') }}
                    <textarea name="observaciones" id="observaciones" rows="4" class="form-control {{ $errors->has('observaciones') ? 'error' : '' }}">{{ old('observaciones', $internacion->observaciones) }}</textarea>
                    @error('observaciones')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6">
                    {{ Form::label('medico_id', 'Médico Responsable') }} <span class="text-danger">(*)</span>
                    <select name="medico_id" id="medico_id" class="form-control {{ $errors->has('medico_id') ? 'error' : '' }}" >
                        <option value="">-- SELECCIONE --</option>
                      @foreach ($medicos as $medico)
                      <option value="{{ $medico->id }}" {{ old('medico_id', $internacion->medico_id) == $medico->id ? 'selected' : '' }}> {{ $medico->nombres }} {{ $medico->ap_paterno }} {{ $medico->ap_materno }}</option>
                    @endforeach
                    </select>
                    @error('medico_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6">
                    {{ Form::label('cama_id', 'Sala y Cama') }} <span class="text-danger">(*)</span>
                    <select name="cama_id" id="cama_id" class="form-control {{ $errors->has('cama_id') ? 'error' : '' }}" >
                        <option value="">-- SELECCIONE --</option>
                      @foreach ($camas as $cama)
                      <option value="{{ $cama->id }}" {{ old('cama_id', $internacion->cama_id) == $cama->id ? 'selected' : '' }}>{{ $cama->salas->piso }} || {{ $cama->salas->nombre }} || CAMA {{ $cama->numero }}</option>
                    @endforeach
                    </select>
                    @error('cama_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-3">
                    {{ Form::label('nombre_cobertura', 'Nombre de Cobertura') }}
                    <select name="nombre_cobertura" id="nombre_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                       <option value="CAJA NACIONAL" {{ old('nombre_cobertura', $internacion->nombre_cobertura) == 'CAJA NACIONAL' ? 'selected' : '' }}>CAJA NACIONAL</option>
                        <option value="SOAT" {{ old('nombre_cobertura', $internacion->nombre_cobertura) == 'SOAT' ? 'selected' : '' }}>SOAT</option>
                        <option value="PARTICULAR" {{ old('nombre_cobertura', $internacion->nombre_cobertura) == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
                     </select>
                </div>

                <div class="col-lg-3">
                    {{ Form::label('tipo_cobertura', 'Tipo de Cobertura') }}
                    <select name="tipo_cobertura" id="tipo_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                       <option value="SEGURO PUBLICO" {{ old('tipo_cobertura', $internacion->tipo_cobertura) == 'SEGURO PUBLICO' ? 'selected' : '' }}>SEGURO PÚBLICO</option>
                        <option value="SEGURO PRIVADO" {{ old('tipo_cobertura', $internacion->tipo_cobertura) == 'SEGURO PRIVADO' ? 'selected' : '' }}>SEGURO PRIVADO</option>       </select>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('internaciones.index') }}" class="btn btn-danger">Salir</a>
            </div>
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>

@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
  mostrar();
  function mostrar() {
  var x = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
  if (x==3) {
       $("#fecha_retiro").show();
       $("#fecha_retiro").prop("", true);
       var el = document.getElementById("bloque");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:block");
      } else {
       $("#fecha_retiro").hide();
       $("#fecha_retiro").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
      } 
 
  }  
  </script>
@endsection