@extends('layouts.app')
@section('titulo','Comisión')
@section('content')
<div class="pagetitle">
    <h1>comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Comisiones</a></li>
        <li class="breadcrumb-item active">Editar Comisión</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Modificar Datos Comisión</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p class="mb-3">Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
            <br>
           {!! Form::model($comision,['route'=>['comisiones.update',$comision->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('fecha_inicio','Fecha Inicio')}} <span class="text-danger">(*)</span>
                      <input id="fecha_inicio" type="date" class="form-control {{ $errors->has('fecha_inicio') ? ' error' : '' }}" name="fecha_inicio" maxlength="8" value="{{ $comision->fecha_inicio }}"  required>
                      @if ($errors->has('fecha_inicio'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_inicio') }}
                          </span>
                      @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('fecha_fin','Fecha Fin')}} <span class="text-danger">(*)</span>
                      <input id="fecha_fin" type="date" class="form-control {{ $errors->has('fecha_fin') ? ' error' : '' }}" name="fecha_fin" maxlength="8" value="{{ $comision->fecha_fin }}"  required >
                      @if ($errors->has('fecha_fin'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_fin') }}
                          </span>
                      @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('tipo','Tipo Jornada' )}} <span class="text-danger">(*)</span>
                  <select name="tipo_jornada" class="form-control" id="tipo_jornada">
                    <option value="">-- SELECCIONE --</option>
                    <option value="1" {{ old('tipo_jornada',$comision->tipo_jornada) =='1' ? 'selected' :'' }}>Jornada Laboral</option>
                    <option value="2" {{ old('tipo_jornada',$comision->tipo_jornada) =='2' ? 'selected' :'' }}>Jornada No Laboral</option>
                  </select>
              </div>
              </div>
              <br>
              <br>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('','Tipo Comision' )}} <span class="text-danger">(*)</span>
                  <select name="tipo_comision" class="form-control"  id="tipo_comision">
                    <option value="">-- SELECCIONE --</option>
                    <option value="1" {{ old('tipo_comision',$comision->tipo_comision) =='1' ? 'selected' :'' }}>Misma Cede</option>
                    <option value="2" {{ old('tipo_comision',$comision->tipo_comision) =='2' ? 'selected' :'' }}>Distinta Cede</option>
                    <option value="3" {{ old('tipo_comision',$comision->tipo_comision) =='3' ? 'selected' :'' }}>Exterior</option>
                  </select>
              </div>
                @if ($comision->tipo_jornada==2)
                <div class="col-lg-4">
                    <label for="hora_entrada">Hora Entrada<span class="text-danger">(*)</span></label>
                    <input id="hora_entrada" type="time" class="form-control {{ $errors->has('hora_entrada') ? ' error' : '' }}" name="hora_entrada" value="{{$comision->hora_entrada}}"  required >
                    @if ($errors->has('hora_entrada'))
                        <span class="text-danger">
                            {{ $errors->first('hora_entrada') }}
                        </span>
                    @endif
                  </div>
                  <div class="col-lg-4">
                    <label for="hora_salida" >Hora Salida<span class="text-danger">(*)</span></label>
                    <input id="hora_salida" type="time" class="form-control {{ $errors->has('hora_salida') ? ' error' : '' }}" name="hora_salida" value="{{ $comision->hora_salida }}"  required >
                    @if ($errors->has('hora_salida'))
                        <span class="text-danger">
                            {{ $errors->first('hora_salida') }}
                        </span>
                    @endif
                  </div>   
                @endif
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('comisiones.create',$empleado->uuid) }}" class="btn btn-danger">Salir</a>
            </div>
            {!! Form::close() !!}
         <br>
          </div>
        </div>
      </div>
    </div>
</section>
@endSection