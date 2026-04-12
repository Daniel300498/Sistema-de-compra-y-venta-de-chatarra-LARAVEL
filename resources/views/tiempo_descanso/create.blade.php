@extends('layouts.app')

@section('titulo','Tiempo De Descanso')

@section('content')

<div class="pagetitle">
    <h1>TIEMPO DESCANSO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tiempo_descanso.create') }}">Tiempo Descanso</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Crear Tiempo de Descanso</h5>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
           <!--CONTENIDO -->
           <form id="tiempoDescansoForm" action="{{ route('tiempo_descanso.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}


            <div class="row">
              <input id="empresa" type="hidden" class="form-control {{ $errors->has('empresa') ? ' error' : '' }}" name="empresa" value="company.default" readonly >
              <div class="col-lg-2">
              </div>
              <div class="col-lg-4">
                {{Form::label('nombre','Nombre' )}} <span class="text-danger">(*)</span>
                <input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre') }}" >
                @if ($errors->has('nombre'))
                    <span class="text-danger">
                        {{ $errors->first('nombre') }}
                    </span>
                @endif
              </div>
              <div class="col-lg-4">
                {{Form::label('tipo_calculo','Tipo de C&aacute;lculo' )}} <span class="text-danger">(*)</span>
                <select name="tipo_calculo" class="form-control {{ $errors->has('tipo_calculo') ? ' error' : '' }}" id="tipo_calculo">
                  
                  <option value="1" {{ old('tipo_calculo')==1 ? 'selected' : '' }} selected>Auto Descontar</option>
                  <option value="2" {{ old('tipo_calculo')==2 ? 'selected' : '' }}>Requiere Marcaci&oacute;n</option>
                </select>
                @if ($errors->has('tipo_calculo'))
                    <span class="text-danger">
                        {{ $errors->first('tipo_calculo') }}
                    </span>
                @endif
              </div>
              <div class="col-lg-2">
              </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Configuraci&oacute;n B&aacute;sica</h5>
            </div>
        
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('hora_inicial','Hora Inicial' )}} <span class="text-danger">(*)</span>
                  <input id="hora_inicial" type="time" class="form-control {{ $errors->has('hora_inicial') ? ' error' : '' }}" name="hora_inicial" value="{{ old('hora_inicial') }}" >
                  @if ($errors->has('hora_inicial'))
                      <span class="text-danger">
                          {{ $errors->first('hora_inicial') }}
                      </span>
                  @endif
              </div>
                <div class="col-lg-4">
                  {{Form::label('hora_final','Hora Final' )}} <span class="text-danger">(*)</span>
                  <input id="hora_final" type="time" class="form-control {{ $errors->has('hora_final') ? ' error' : '' }}" name="hora_final" value="{{ old('hora_final') }}" >
                  @if ($errors->has('hora_final'))
                      <span class="text-danger">
                          {{ $errors->first('hora_final') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('duracion_descanso','Duraci&oacute;n Descanso (MINUTOS)' )}} <span class="text-danger">(*)</span>
                  <input id="duracion_descanso" type="number" class="form-control{{ $errors->has('duracion_descanso') ? ' error' : '' }}" name="duracion_descanso" value="{{ old('duracion_descanso') }}" >
                  @if ($errors->has('duracion_descanso'))
                      <span class="text-danger">
                          {{ $errors->first('duracion_descanso') }}
                      </span>
                  @endif
                </div>
              </div>
              <br>
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuraci&oacute;n De Regla</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                  {{Form::label('estado_marcacion','Basado En Estado De Marcaci&oacute;n' )}} <span class="text-danger">(*)</span>
                  <select name="estado_marcacion" class="form-control {{ $errors->has('estado_marcacion') ? ' error' : '' }}" id="estado_marcacion">
                   
                    <option value="1" {{ old('estado_marcacion')==1 ? 'selected' : '' }} selected>No</option>
                    <option value="2" {{ old('estado_marcacion')==2 ? 'selected' : '' }}>Si</option>
                  </select>
                  @if ($errors->has('estado_marcacion'))
                      <span class="text-danger">
                          {{ $errors->first('estado_marcacion') }}
                      </span>
                  @endif
              </div>
              <div class="col-lg-4">
                </div>
              <br>
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('tiempo_descanso.index') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>

@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('tiempoDescansoForm').addEventListener('submit', function (event) {
          // Obtener los valores de las horas y minutos
          let horaInicial = document.getElementById('hora_inicial').value;
          let horaFinal = document.getElementById('hora_final').value;
          let duracionDescanso = parseInt(document.getElementById('duracion_descanso').value) || 0;

          // Convertir horas en minutos
          function convertirAHorasEnMinutos(hora) {
              let [horas, minutos] = hora.split(':').map(Number);
              return horas * 60 + minutos;
          }

          let minutosInicial = convertirAHorasEnMinutos(horaInicial);
          let minutosFinal = convertirAHorasEnMinutos(horaFinal);
          let diferenciaMinutos = minutosFinal - minutosInicial;

          // Validar la duración del descanso
          if (diferenciaMinutos < duracionDescanso) {
            Swal.fire({
              title: 'La duracion excede el período',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar'
            })
              event.preventDefault(); // Evitar el envío del formulario
          }else{
            var ruta=adminUrl+'/tiempo_descanso/store/';
            window.location.assign(ruta);

          }

      });
  });
</script>

@endsection