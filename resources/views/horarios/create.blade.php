@extends('layouts.app')
@section('titulo','Horarios')
@section('content')
<div class="pagetitle">
    <h1>HORARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('horarios.create') }}">Horarios</a></li>
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
              <h5 class="card-title">Adjuntar Horarios</h5>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el boton <strong>GUARDAR</strong>. Presione el boton <strong>Salir</strong> si no desea realizar ninguna accion.</p>
           <!--CONTENIDO -->
           <form action="{{route('horarios.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Configuración Básica</h5>
            </div>
            <div class="row">
              <input id="empresa" type="hidden" class="form-control {{ $errors->has('empresa') ? ' error' : '' }}" name="empresa" value="company.default">
              <div class="col-lg-4">
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
                </div>
              </div>
              <br>
              

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                      {{Form::label('entrada_turno','Entrada Turno' )}} <span class="text-danger">(*)</span>
                      <input id="entrada_turno" type="time" class="form-control {{ $errors->has('entrada_turno') ? ' error' : '' }}" name="entrada_turno" value="{{ old('entrada_turno') }}" >
                      @if ($errors->has('entrada_turno'))
                          <span class="text-danger">
                              {{ $errors->first('entrada_turno') }}
                          </span>
                      @endif
                </div>
                <div class="col-lg-6">
                </div>

             </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                  <div class="col-lg-4">
                    {{Form::label('inicio_entrada_turno','Inicio Entrada Turno' )}} <span class="text-danger">(*)</span>
                    <input id="inicio_entrada_turno" type="time" class="form-control {{ $errors->has('inicio_entrada_turno') ? ' error' : '' }}" name="inicio_entrada_turno" value="{{ old('inicio_entrada_turno') }}" >
                    @if ($errors->has('inicio_entrada_turno'))
                        <span class="text-danger">
                            {{ $errors->first('inicio_entrada_turno') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('inicio_entrada_turno_crusado_dias','Cruzado Días' )}} 
                  <select name="inicio_entrada_turno_crusado_dias" class="form-control {{ $errors->has('inicio_entrada_turno_crusado_dias') ? ' error' : '' }}" id="inicio_entrada_turno_crusado_dias">
                    <option value="0" {{ old('inicio_entrada_turno_crusado_dias')==0 ? 'selected' : '' }} selected>0</option>
                    <option value="-1" {{ old('inicio_entrada_turno_crusado_dias')==-1 ? 'selected' : '' }}>-1</option>
                    <option value="-2" {{ old('inicio_entrada_turno_crusado_dias')==-2 ? 'selected' : '' }}>-2</option>
                    <option value="-3" {{ old('inicio_entrada_turno_crusado_dias')==-3 ? 'selected' : '' }}>-3</option>
                  </select>
                
                </div>
                <div class="col-lg-2">
                </div>
             </div>
            
             <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  {{Form::label('final_entrada_turno','Final Entrada Turno' )}} <span class="text-danger">(*)</span>
                  <input id="final_entrada_turno" type="time" class="form-control {{ $errors->has('final_entrada_turno') ? ' error' : '' }}" name="final_entrada_turno" value="{{ old('final_entrada_turno') }}" >
                  @if ($errors->has('final_entrada_turno'))
                      <span class="text-danger">
                          {{ $errors->first('final_entrada_turno') }}
                      </span>
                  @endif
              </div>
              <div class="col-lg-4">
                {{Form::label('final_entrada_turno_crusado_dias','Cruzado Días' )}}
                <select name="final_entrada_turno_crusado_dias" class="form-control {{ $errors->has('final_entrada_turno_crusado_dias') ? ' error' : '' }}" id="final_entrada_turno_crusado_dias">
                  <option value="0" {{ old('final_entrada_turno_crusado_dias')==0 ? 'selected' : '' }} selected>0</option>
                  <option value="1" {{ old('final_entrada_turno_crusado_dias')==1 ? 'selected' : '' }}>1</option>
                  <option value="2" {{ old('final_entrada_turno_crusado_dias')==2 ? 'selected' : '' }}>2</option>
                  <option value="3" {{ old('final_entrada_turno_crusado_dias')==3 ? 'selected' : '' }}>3</option>
                </select>
              </div>
              <div class="col-lg-2">
                </div>
                
            </div>
            <br>
              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    {{Form::label('dia_pagado','Día Pagado (Días)' )}} <span class="text-danger">(*)</span>
                    <input id="dia_pagado" type="number" class="form-control {{ $errors->has('dia_pagado') ? ' error' : '' }}" name="dia_pagado" value="{{ old('dia_pagado') }}" >
                    @if ($errors->has('dia_pagado'))
                        <span class="text-danger">
                            {{ $errors->first('dia_pagado') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  {{Form::label('salida_turno','Salida Turno' )}} <span class="text-danger">(*)</span>
                  <input id="salida_turno" type="time" class="form-control {{ $errors->has('salida_turno') ? ' error' : '' }}" name="salida_turno" value="{{ old('salida_turno') }}" >
                  @if ($errors->has('salida_turno'))
                      <span class="text-danger">
                          {{ $errors->first('salida_turno') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('salida_turno_crusado_dias','Cruzado Días' )}} 
                  <select name="salida_turno_crusado_dias" class="form-control {{ $errors->has('salida_turno_crusado_dias') ? ' error' : '' }}" id="salida_turno_crusado_dias">
                    <option value="0" {{ old('salida_turno_crusado_dias')==0 ? 'selected' : '' }} selected>0</option>
                    <option value="1" {{ old('salida_turno_crusado_dias')==1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('salida_turno_crusado_dias')==2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('salida_turno_crusado_dias')==3 ? 'selected' : '' }}>3</option>
                  </select>
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                    {{Form::label('inicio_salida_turno','Inicio Salida Turno' )}} <span class="text-danger">(*)</span>
                    <input id="inicio_salida_turno" type="time" class="form-control {{ $errors->has('inicio_salida_turno') ? ' error' : '' }}" name="inicio_salida_turno" value="{{ old('inicio_salida_turno') }}" >
                    @if ($errors->has('inicio_salida_turno'))
                        <span class="text-danger">
                            {{ $errors->first('inicio_salida_turno') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('inicio_salida_turno_crusado_dias','Cruzado Días' )}} 
                  <select name="inicio_salida_turno_crusado_dias" class="form-control {{ $errors->has('inicio_salida_turno_crusado_dias') ? ' error' : '' }}" id="inicio_salida_turno_crusado_dias">
                    <option value="0" {{ old('inicio_salida_turno_crusado_dias')==0 ? 'selected' : '' }} selected>0</option>
                    <option value="1" {{ old('inicio_salida_turno_crusado_dias')==1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('inicio_salida_turno_crusado_dias')==2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('inicio_salida_turno_crusado_dias')==3 ? 'selected' : '' }}>3</option>
                  </select>
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                    {{Form::label('final_salida_turno','Final Salida Turno' )}} <span class="text-danger">(*)</span>
                    <input id="final_salida_turno" type="time" class="form-control {{ $errors->has('final_salida_turno') ? ' error' : '' }}" name="final_salida_turno" value="{{ old('final_salida_turno') }}" >
                    @if ($errors->has('final_salida_turno'))
                        <span class="text-danger">
                            {{ $errors->first('final_salida_turno') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('final_salida_turno_crusado_dias','Cruzado Dias' )}} 
                  <select name="final_salida_turno_crusado_dias" class="form-control {{ $errors->has('final_salida_turno_crusado_dias') ? ' error' : '' }}" id="final_salida_turno_crusado_dias">
                    <option value="0" {{ old('final_salida_turno_crusado_dias')==0 ? 'selected' : '' }} selected>0</option>
                    <option value="1" {{ old('final_salida_turno_crusado_dias')==1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('final_salida_turno_crusado_dias')==2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('final_salida_turno_crusado_dias')==3 ? 'selected' : '' }}>3</option>
                  </select> 
                </div>
                <div class="col-lg-2">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    {{Form::label('ajuste_color','Ajuste Color' )}} <span class="text-danger">(*)</span>
                    <input id="ajuste_color" type="color" class="form-control {{ $errors->has('ajuste_color') ? ' error' : '' }}" name="ajuste_color" value="{{ old('ajuste_color') }}" >
                    @if ($errors->has('ajuste_color'))
                        <span class="text-danger">
                            {{ $errors->first('ajuste_color') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuracion De Descanso</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                  {{Form::label('id_tiempo_descanso','Tiempo Descanso' )}} 
                  <select name="id_tiempo_descanso"  class="form-control form-control {{ $errors->has('id_tiempo_descanso') ? ' error' : '' }}" id="id_tiempo_descanso" data-old="{{ old('id_tiempo_descanso') }}" >
                    <option value="">--SELECCIONE--</option>
                    @foreach($tiempo_descanso as $tiempo)
                        <option value="{{$tiempo->id}}" {{ old('id_tiempo_descanso') == $tiempo->id ? 'selected' :'' }} >{{$tiempo->nombre}}   , horas:   {{$tiempo->hora_inicial}} - {{$tiempo->hora_final}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuracion De Regla</h5>
              </div>
              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  {{Form::label('necesario_marcar_entrada','Necesario Marcar Entrada' )}} <span class="text-danger">(*)</span>
                  <select name="necesario_marcar_entrada" class="form-control {{ $errors->has('necesario_marcar_entrada') ? ' error' : '' }}" id="necesario_marcar_entrada">
                    <option value="0" {{ old('necesario_marcar_entrada')==0 ? 'selected' : '' }} selected>Si</option>
                    <option value="1" {{ old('necesario_marcar_entrada')==1 ? 'selected' : '' }}>No</option>
                  </select>
                  @if ($errors->has('necesario_marcar_entrada'))
                      <span class="text-danger">
                          {{ $errors->first('necesario_marcar_entrada') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('necesario_marcar_salida','Necesario Marcar Salida' )}} <span class="text-danger">(*)</span>
                  <select name="necesario_marcar_salida" class="form-control {{ $errors->has('necesario_marcar_salida') ? ' error' : '' }}" id="necesario_marcar_salida">
                    <option value="0" {{ old('necesario_marcar_salida')==0 ? 'selected' : '' }} selected>Si</option>
                    <option value="1" {{ old('necesario_marcar_salida')==1 ? 'selected' : '' }}>No</option>
                  </select>
                  @if ($errors->has('necesario_marcar_salida'))
                      <span class="text-danger">
                          {{ $errors->first('necesario_marcar_salida') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-2">
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  {{Form::label('permite_llegar_tarde','Permite Llegar Tarde (Minutos)' )}} <span class="text-danger">(*)</span>
                  <input id="permite_llegar_tarde" type="number" min="0" class="form-control {{ $errors->has('permite_llegar_tarde') ? ' error' : '' }}" name="permite_llegar_tarde" value="0" >
                  @if ($errors->has('permite_llegar_tarde'))
                      <span class="text-danger">
                          {{ $errors->first('permite_llegar_tarde') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('permite_salida_tarde','Permite Salida Temprana (Minutos)' )}} <span class="text-danger">(*)</span>
                  <input id="permite_salida_tarde" type="number" min="0" class="form-control {{ $errors->has('permite_salida_tarde') ? ' error' : '' }}" name="permite_salida_tarde" value="0" >
                  @if ($errors->has('permite_salida_tarde'))
                      <span class="text-danger">
                          {{ $errors->first('permite_salida_tarde') }}
                      </span>
                  @endif
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
              <div class="col-lg-2">
              </div>
              <div class="col-lg-4">
                {{Form::label('acordes_marcacion','Acorde Al Estado Marcación' )}} <span class="text-danger">(*)</span>
                <select name="acordes_marcacion" class="form-control {{ $errors->has('acordes_marcacion') ? ' error' : '' }}" id="acordes_marcacion">
                  <option value="0" {{ old('acordes_marcacion')==0 ? 'selected' : '' }} selected>No</option>
                    <option value="1" {{ old('acordes_marcacion')==1 ? 'selected' : '' }}>Si</option>
                </select>
                @if ($errors->has('acordes_marcacion'))
                    <span class="text-danger">
                        {{ $errors->first('acordes_marcacion') }}
                    </span>
                @endif
              </div>
              <div class="col-lg-4">
                {{Form::label('hora_cambio_dia','Hora De Cambio Día' )}} <span class="text-danger">(*)</span>
                <input id="hora_cambio_dia" type="time" class="form-control {{ $errors->has('hora_cambio_dia') ? ' error' : '' }}" name="hora_cambio_dia">
                @if ($errors->has('hora_cambio_dia'))
                    <span class="text-danger">
                        {{ $errors->first('hora_cambio_dia') }}
                    </span>
                @endif
              </div>
                <div class="col-lg-2">
                </div>
              </div>



              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('horarios.index') }}" class="btn btn-danger">Salir</a>
              </div>
         
         </form>
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