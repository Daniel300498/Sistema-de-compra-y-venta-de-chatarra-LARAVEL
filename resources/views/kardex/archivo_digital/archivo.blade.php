@extends('layouts.app')

@section('titulo','Kardex')

@section('content')

<div class="pagetitle mb-0">
    <h1>KARDEX</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Archivo digital</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kardex del Empleado</h5>
            <form class="row g-3">
                <h5>I. DATOS PERSONALES</h5>
                <div class="col-lg-4">
                    {{Form::label('ap_paterno','Apellido Paterno')}} 
                    <input id="ap_paterno" type="text" class="form-control" name="ap_paterno" value="{{ old('ap_paterno',$empleado->ap_paterno) }}"  readonly>
                </div>
                <div class="col-lg-4">
                    {{Form::label('ap_materno','Apellido Materno')}} 
                    <input id="ap_materno" type="text" class="form-control {{ $errors->has('ap_materno') ? ' error' : '' }}" name="ap_materno" value="{{ old('ap_materno',$empleado->ap_materno) }}"   readonly>
                </div>           
                <div class="col-lg-4">
                    {{Form::label('nombres','Nombres')}} 
                    <input id="nombres" type="text" class="form-control {{ $errors->has('nombres') ? ' error' : '' }}" name="nombres" value="{{ old('nombres',$empleado->nombres) }}"   readonly>
                </div>
                <div class="col-lg-3">
                    {{Form::label('fecha_nacimiento','Fecha Nacimiento')}} 
                    <input type="date" class="form-control {{ $errors->has('fecha_nacimiento') ? ' error' : '' }}" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento',$empleado->fecha_nacimiento) }}" readonly>
                </div>
                <div class="col-lg-1">
                    {{Form::label('edad','Edad' )}} 
                    <input type="number" name="edad" id="campo_edad" class="form-control" value="{{ old('edad',$empleado->edad) }}" readonly>
                </div>
                <div class="col-lg-3">
                    {{Form::label('sexo','Genero' )}} 
                    <input type="text" value="{{ old('sexo',$empleado->sexo) =='1' ? 'FEMENINO' :'MASCULINO' }}" class="form-control" readonly>
                </div>
                <div class="col-lg-3">
                    {{Form::label('estado_civil','Estado Civil' )}} 
                    
                    <input type="text" value="{{ $empleado->estado_civil}}" class="form-control" readonly>
                </div>
                <div class="col-lg-2">
                    {{Form::label('nro_hijos','Número hij@(s)' )}}
                    <input type="number" name="nro_hijos" id="nro_hijos" class="form-control" value="{{ old('nro_hijos',$empleado->nro_hijos) }}" readonly>
                </div>
                <div class="col-lg-3">
                    {{Form::label('ciudad_id','Lugar Nacimiento')}} 
                    <select name="ciudad_id" id="ciudad_id" class="form-control" readonly>
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($ciudades as  $c)
                            <option value="{{ $c->id }}" {{ old('ciudad_id',$empleado->ciudad_id) ==$c->id ? 'selected' :'' }}>{{ $c->ciudad }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    {{Form::label('provincia','Provincia')}}
                    <input type="text" name="provincia" id="provincia" class="form-control" readonly>
                </div>
                <div class="col-lg-2">
                    {{Form::label('ci','C.I.' )}} 
                    <input type="text" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" name="ci" id="ci" value="{{ old('ci',$empleado->ci) }}" >
                    @if ($errors->has('ci'))
                        <span class="text-danger">
                            {{ $errors->first('ci') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-2">
                    {{Form::label('ci_complemento','C.I. Complemento' )}}
                    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="{{ old('ci_complemento',$empleado->ci_complemento) }}" >
                </div>
                <div class="col-lg-2">
                    {{Form::label('ci_lugar','C.I. Lugar' )}} 
                    <select name="ci_lugar" id="ci_lugar" class="form-control {{ $errors->has('ci_lugar') ? ' error' : '' }}">
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($lugares_ci as $lugar)
                            <option value="{{ $lugar->descripcion }}" {{ old('ci_lugar',$empleado->ci_lugar) ==$lugar->descripcion ? 'selected' :'' }}>{{ $lugar->descripcion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('ci_lugar'))
                        <span class="text-danger">
                            {{ $errors->first('ci_lugar') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-8">
                    {{Form::label('domicilio','Domicilio')}} 
                    <input type="text" name="domicilio" id="domicilio" class="form-control {{ $errors->has('domicilio') ? ' error' : '' }}" value="{{ old('domicilio',$empleado->domicilio) }}" readonly>
                    @if ($errors->has('domicilio'))
                        <span class="text-danger">
                            {{ $errors->first('domicilio') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                    {{Form::label('nro_libreta_militar','Nro. Libreta Militar' )}}
                    <input type="text" name="nro_libreta_militar" id="nro_libreta_militar" class="form-control" value="{{ old('nro_libreta_militar',$empleado->nro_libreta_militar) }}" readonly disabled>
                </div>
                <div class="col-md-4">
                    {{Form::label('email','Correo' )}} 
                    <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email',$empleado->email) }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-2">
                    {{Form::label('nro_celular','N°Celular' )}} 
                    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="{{ old('nro_celular',$empleado->nro_celular) }}">
                    @if ($errors->has('nro_celular'))
                        <span class="text-danger">
                            {{ $errors->first('nro_celular') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-2">
                    {{Form::label('nro_telefono','N° Telefono' )}}
                    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="{{ old('nro_telefono',$empleado->telefono) }}">
                </div>
                <div class="col-md-4">
                    {{Form::label('redes_sociales','Cuenta Facebook/Instagram' )}}
                    <input type="text" name="redes_sociales" id="redes_sociales" class="form-control" value="{{ old('redes_sociales',$empleado->redes_sociales) }}">
                </div>
                <h5>PERSONA DE CONTACTO EN CASO DE EMERGENCIA</h5>
                <div class="col-lg-4">
                    {{Form::label('contacto_nombre','Nombre completo' )}} 
                    <input type="text" name="contacto_nombre" id="contacto_nombre" class="form-control {{ $errors->has('contacto_nombre') ? ' error' : '' }}" value="{{ old('contacto_nombre',$empleado->contacto_nombre) }}" readonly>
                    @if ($errors->has('contacto_nombre'))
                        <span class="text-danger">
                            {{ $errors->first('contacto_nombre') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                    {{Form::label('contacto_telefono','N° Telefono / Celular' )}} 
                    <input type="text" name="contacto_telefono" id="contacto_telefono" class="form-control {{ $errors->has('contacto_telefono') ? ' error' : '' }}" value="{{ old('contacto_telefono',$empleado->contacto_telefono) }}">
                    @if ($errors->has('contacto_telefono'))
                        <span class="text-danger">
                            {{ $errors->first('contacto_telefono') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-4">
                    {{Form::label('contacto_parentesco','Parentesco' )}} 
                    <input type="text" name="contacto_parentesco" id="contacto_parentesco" class="form-control {{ $errors->has('contacto_parentesco') ? ' error' : '' }}" value="{{ old('contacto_parentesco',$empleado->contacto_parentesco) }}" readonly>
                    @if ($errors->has('contacto_parentesco'))
                        <span class="text-danger">
                            {{ $errors->first('contacto_parentesco') }}
                        </span>
                    @endif
                </div>
                <h5>II. OCUPACIÓN</h5>
                <div class="col-lg-6">
                    {{Form::label('formacion','Formación' )}} 
                    <select name="formacion_id" id="formacion_id" class="form-control {{ $errors->has('formacion_id') ? ' error' : '' }}">
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
                <div class="col-lg-6">
                    {{Form::label('institucion_formacion','Universidad o Instituto' )}} 
                    <select name="institucion_formacion_id" id="institucion_formacion_id" class="form-control {{ $errors->has('institucion_formacion_id') ? ' error' : '' }}">
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
                <div class="col-12">
                    {{Form::label('ultimo_empleo','Ultimo Empleo' )}} 
                    <input type="text" name="ultimo_empleo" id="ultimo_empleo" class="form-control {{ $errors->has('ultimo_empleo') ? ' error' : '' }}" value="{{ old('ultimo_empleo',$empleado->ultimo_empleo) }}" readonly>
                    @if ($errors->has('ultimo_empledo'))
                        <span class="text-danger">
                            {{ $errors->first('ultimo_empledo') }}
                        </span>
                    @endif
                </div>
                
                <h5>III. INSTITUCIONAL</h5>
                <div class="col-lg-3">
                    {{Form::label('fecha_ingreso','Fecha Ingreso' )}} 
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control {{ $errors->has('fecha_ingreso') ? ' error' : '' }}" value="{{ old('fecha_ingreso',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_inicio : '') }}">
                    @if ($errors->has('fecha_ingreso'))
                        <span class="text-danger">
                            {{ $errors->first('fecha_ingreso') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('fecha_conclusion','Fecha conclusion' )}} 
                    <input type="date" name="fecha_conclusion" id="fecha_conclusion" class="form-control {{ $errors->has('fecha_conclusion') ? ' error' : '' }}" value="{{ old('fecha_conclusion',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_conclusion : '') }}">
                    @if ($errors->has('fecha_conclusion'))
                        <span class="text-danger">
                            {{ $errors->first('fecha_conclusion') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('cargo_id','Puesto' )}} 
                    <select name="cargo_id" id="cargo_id" class="form-control {{ $errors->has('cargo_id') ? ' error' : '' }}" data-ruta="{{ route('tipo_cargo') }}">
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($cargos as $c)
                            <option value="{{ $c->id }}" {{ old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->id : '') == $c->id ? 'selected' : '' }}>{{ $c->nombre }} ({{ $c->tipo_cargo }})</option>
                        @endforeach
                    </select>
                    @if ($errors->has('cargo_id'))
                        <span class="text-danger">
                            {{ $errors->first('cargo_id') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('nit','NIT consultor' )}} 
                    <input type="text" name="nit" id="nit" class="form-control {{ $errors->has('nit') ? ' error' : '' }}" value="{{ old('nit',$empleado->nit) }}" disabled>
                    @if ($errors->has('nit'))
                        <span class="text-danger">
                            {{ $errors->first('nit') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('nro_cuenta','Número Cuenta' )}} 
                    <input type="text" name="nro_cuenta" id="nro_cuenta" class="form-control {{ $errors->has('nro_cuenta') ? ' error' : '' }}" value="{{ old('nro_cuenta',$empleado->nro_cuenta) }}">
                    @if ($errors->has('nro_cuenta'))
                        <span class="text-danger">
                            {{ $errors->first('nro_cuenta') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('banco_id','Banco' )}} 
                    <select name="banco_id" id="banco_id" class="form-control {{ $errors->has('banco_id') ? ' error' : '' }}">
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($bancos as $d)
                            <option value="{{ $d->id }}" {{ old('banco_id',$empleado->banco_id) == $d->id ? 'selected' : '' }}>{{ $d->descripcion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('banco_id'))
                        <span class="text-danger">
                            {{ $errors->first('banco_id') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('afp_id','Seguro Largo Plazo AFP' )}} 
                    <select name="afp_id" id="afp_id" class="form-control {{ $errors->has('afp_id') ? ' error' : '' }}">
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($afps as $a)
                            <option value="{{ $a->id }}" {{ old('afp_id',$empleado->afp_id) == $a->id ? 'selected' : '' }}>{{ $a->descripcion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('afp_id'))
                        <span class="text-danger">
                            {{ $errors->first('afp_id') }}
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    {{Form::label('seguro_salud_id','Seguro de Salud' )}} 
                    <select name="seguro_salud_id" id="seguro_salud_id" class="form-control {{ $errors->has('seguro_salud_id') ? ' error' : '' }}">
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($seguros as $e)
                            <option value="{{ $e->id }}" {{ old('seguro_salud_id',$empleado->seguro_salud_id) == $e->id ? 'selected' : '' }}>{{ $e->descripcion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('seguro_salud_id'))
                        <span class="text-danger">
                            {{ $errors->first('seguro_salud_id') }}
                        </span>
                    @endif
                </div>
               
                <hr class="mb-1">
                <div class="row mt-3">
                    <div class="col-sm-10 d-flex align-items-center justify-content-left">
                        <label for="" class="col-control-label">Empleado con discapacidad o es tutor?</label> &nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="1" {{ old('discapacidad',$empleado->discapacidad) ==1 ? 'checked' : ''  }}>
                          <label class="form-check-label" for="gridRadios1">
                            Con Discapacidad
                          </label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="2" {{ old('discapacidad',$empleado->discapacidad) ==2 ? 'checked' : ''  }}>
                            <label class="form-check-label" for="gridRadios1">
                              Es Tutor
                            </label>
                          </div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios2" value="0" {{ old('discapacidad',$empleado->discapacidad) ==0 ? 'checked' : ''  }}>
                          <label class="form-check-label" for="gridRadios2">
                            Ninguno
                          </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @if(count($discapacidad)>0)
                            <a href="{{ asset('discapacidad/'.$discapacidad[0]->adjunto) }}" class="btn btn-primary btn-sm" target="_blank">Ver documento adjunto de discapacidad</a>
                        @endif
                    </div>
                </div>
                <hr class="mb-1">
                <div class="row mt-2">
                    <div class="col-lg-4">
                        {{Form::label('fecha_registro','Fecha Registro' )}} 
                        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control {{ $errors->has('fecha_registro') ? ' error' : '' }}" value="{{ old('fecha_registro',$empleado->fecha_registro) }}" readonly>
                        
                    </div>
                </div>
            </form>
            <hr class="mb-1">
            <h5 class="text-primary">DECLARACIONES JURADAS</h5>
            @if(count($declaraciones)>0)
            <table class="table table-hover table-bordered table-sm" width="50%">
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Ver Archivo</th>
                    </tr>
                    @foreach ($declaraciones as  $key=>$document)
                    <tr>
                      <td class="text-center">{{ date('d-m-Y',strtotime($document->created_at)) }}</td>
                      <td>
                        <a href="{{ asset('declaraciones_juradas/'.$document->nombre)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a>

                        </td>
                    </tr>
                  @endforeach
                </thead>
            </table>
            @else
            <p>No existen documentos adjuntos..</p>
            @endif
            <hr class="mb-1">
            <h5 class="text-primary">LACTANCIA</h5>
            @if(count($lactancias)>0)
            <table class="table table-bordered">
                <tr>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                </tr>
                @foreach ($lactancias as $lactancia )
                    <tr>
                        <td class="text-center">@if($lactancia->fecha_inicio_prenatal != null) PRENATAL @else POSTNATAL @endif</td>
                        <td>@if($lactancia->fecha_inicio_prenatal != null) <a href="{{ asset('documentos_lactancia/'.$lactancia->documento_prenatal)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a> @else <a href="{{ asset('documentos_lactancia/'.$lactancia->documento_postnatal)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a> @endif</td>
                    </tr>
                @endforeach
            </table>
            @else
                <p>No tiene archivo adjunto..</p>
            @endif
            
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE ENFERMEDAD TERMINAL</h5>
            @if(count($enfermedad)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Fecha Documento</th>
                    <th class="text-center">Enfermedad</th>
                    <th class="text-center">Documento</th>
                </tr>
                @foreach($enfermedad as $e)
                    <tr>
                        <td class="text-center">{{ date('d-m-Y',strtotime($e->fecha_inicio_enfermedad)) }}</td>
                        <td>{{ $e->descripcion }}</td>
                        <td>
                            <a href="{{ asset('documento_enfermedad_terminal_/'.$e->documento)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
                @else
                <p>No tiene archivo adjunto..</p>
            @endif

            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE AÑOS DE SERVICIO</h5>
            @if(count($cash)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Fecha Documento</th>
                    <th class="text-center">Documento</th>
                </tr>
                @foreach($cash as $c)
                    <tr>
                        <td class="text-center">{{ date('d-m-Y',strtotime($c->created_at)) }}</td>
                        <td>
                            <a href="{{ asset('documentos_empleados/años_servicio/'.$c->archivo)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
                @else
                <p>No tiene archivo adjunto..</p>
            @endif
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE VACACIONES</h5>
            @if(count($vacaciones)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Fecha solicitud</th>
                    <th class="text-center">Fecha Inicio</th>
                    <th class="text-center">Fecha Fin</th>
                </tr>
                @foreach($vacaciones as $v)
                    <tr>
                        <td class="text-center">{{ date('d/m/Y',strtotime($v->fecha_solicitud)) }}</td>
                        <td class="text-center">{{ date('d/m/Y',strtotime($v->fecha_inicio)) }}</td>
                        <td class="text-center">{{ date('d/m/Y',strtotime($v->fecha_fin)) }}</td>
                        <td class="text-center">{{ $v->estado }}</td>
                      
                    </tr>
                @endforeach
            </table>
                @else
                <p>No tiene archivo adjunto..</p>
            @endif
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE OTROS DOCUMENTOS</h5>
            @if(count($otrosDocumentos)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center"></th>
                </tr>
                @foreach($otrosDocumentos as $v)
                    <tr>
                        <td class="text-center">{{ $v->descripcion }}</td>
                        <td class="text-center"><a href="{{ asset('documentos_complementarios/'.$v->nombre)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a></td>
                      
                    </tr>
                @endforeach
            </table>
            @else
                <p>No tiene archivo adjunto..</p>
            @endif
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE LICENCIAS</h5>
            @if(count($licencias)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center"></th>
                </tr>
                @foreach($licencias as $l)
                    <tr>
                        <td class="text-center">{{ $v->descripcion }}</td>
                        <td class="text-center"><a href="{{ asset('documentos_complementarios/'.$v->nombre)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a></td>
                      
                    </tr>
                @endforeach
            </table>
            @else
                <p>No tiene archivo adjunto..</p>
            @endif
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE COMISIONES</h5>
            @if(count($comisiones)>0)
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Fecha inicio</th>
                    <th class="text-center">Fecha fin</th>
                    <th class="text-center">Informe de Actividades</th>
                </tr>
                @foreach($comisiones as $co)
                    <tr>
                        <td class="text-center">{{ date('d/m/Y',strtotime($co->fecha_inicio)) }}</td>
                        <td class="text-center">{{ date('d/m/Y',strtotime($co->fecha_fin)) }}</td>
                        <td class="text-center">@if($co->informe!=null)<a href="{{ asset('comisiones_actividades_desarrolladas/'.$co->informe)}}" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a>@endif</td>
                      
                    </tr>
                @endforeach
            </table>
            @else
                <p>No tiene archivo adjunto..</p>
            @endif
          </div>
        </div>
      </div>
    </div>
</section>

@endSection