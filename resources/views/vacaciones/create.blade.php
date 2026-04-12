@extends('layouts.app')

@section('titulo','Vacaciones')

@section('content')

<div class="pagetitle mb-0">
    <h1>VACACIONES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('vacaciones.index') }}">Ver Dias Disponibles</a></li>
        <li class="breadcrumb-item active">Registrar Solicitud de Vacaciones</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Registrar Solicitud de Vacaciones</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
           <h4 class="text-center">Dias disponibles para solicitar: {{ optional($dias_disponibles)->nro_dias_disponibles ?? 0}}</h4>
            <p>Todos los campos son de ingreso obligatorio, para guardar la solicitud de vacaci&oacute;n debe presionar el bot&oacute;n <strong>GUARDAR</strong>. Si no desea realizar ninguna solicitud presione el bot&oacute;n <strong>SALIR</strong>.</p>
           <!--CONTENIDO -->
           @if($mensaje=="Vacaciones Disponibles")
           <form action="{{route('vacaciones.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
              <div class="row mb-2">
                <div class="col-lg-4">
                  {{Form::label('fecha_solicitud','Fecha Solicitud')}} <span class="text-danger">(*)</span>
                      <input id="fecha_solicitud" type="date" class="form-control {{ $errors->has('fecha_solicitud') ? ' error' : '' }}" name="fecha_solicitud"  value="{{ old('fecha_solicitud') }}"  >
                      @if ($errors->has('fecha_solicitud'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_solicitud') }}
                          </span>
                      @endif
                </div>
              </div>
              <div class="row">
                  <div class="col-lg-4">
                  {{Form::label('jornada_laboral','Jornada Laboral' )}} <span class="text-danger">(*)</span>
                  <select name="jornada_laboral" class="form-control {{ $errors->has('jornada_laboral') ? ' error' : '' }}" id="jornada_laboral" Onchange = "mostrar('num')">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Jornada Completa</option>
                    <option value="2" >Media Jornada</option>
                  </select>
                  @if ($errors->has('jornada_laboral'))
                          <span class="text-danger">
                              {{ $errors->first('jornada_laboral') }}
                          </span>
                      @endif
              </div>
                <div class="col-lg-4">
                    {{Form::label('fecha_inicio','Fecha Inicio')}} <span class="text-danger">(*)</span>
                        <input id="fecha_inicio" type="date" class="form-control {{ $errors->has('fecha_inicio') ? ' error' : '' }}" name="fecha_inicio" value="{{ old('fecha_inicio') }}"  >
                        @if ($errors->has('fecha_inicio'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </span>
                        @endif
                  </div>
                <div class="col-lg-4">
                  {{Form::label('fecha_hasta','Fecha Hasta')}} <span class="text-danger">(*)</span>
                      <input id="fecha_hasta" type="date" class="form-control {{ $errors->has('fecha_hasta') ? ' error' : '' }}" name="fecha_hasta" value="{{ old('fecha_hasta') }}"  >
                      @if ($errors->has('fecha_hasta'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_hasta') }}
                          </span>
                      @endif
                </div>
                
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                @if(auth()->user()->rol[0]->id==4)
                <a href="{{ route('vacaciones.create',auth()->user()->empleado_id) }}" class="btn btn-danger">Salir</a>
                @else
                <a href="{{ route('vacaciones.index') }}" class="btn btn-danger">Salir</a>
                @endif
            </div>
         </form>
         @else
         @php
         $dias_disponibles=\App\Models\DiasDisponibles::where('empleado_id',$empleado->id)->first();
         @endphp
         <h6  class="card-title text-center">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</h6>
          <h5 class="text-center">{{$mensaje}}</h5>
         @endif
         <br>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection