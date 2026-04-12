@extends('layouts.app')

@section('titulo','Nueva Lactancia')

@section('content')

<div class="pagetitle">
    <h1>Lactancia</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Lactancia</a></li>
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
              <h5 class="card-title">Solicitar Nueva Lactancia</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
              <form action="{{route('lactancias.store')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                <input type="hidden" name="sexo" id="sexo" value="{{ $empleado->sexo }}">
                {{ csrf_field()}}

                <!--TIPO DE LICENCIA-->
                <p id="texto">Selecciona el tipo de lactancia</p>
      
                <p>Debe completar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>

                <div class="col-md-10">
                  <div class="form-group d-flex align-items-center mb-2">
                    <div class="col-md-5 text-right">
                      <label for="example-text-input" class="form-control-label">Matricula Seguro Empleado <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
                    </div>
                    <div class="col-md-7 text-center">
                      @if($verificar_codigo_empleado == null)
                        <input type="text" name="matricula" id="matricula" class="form-control text-center {{ $errors->has('matricula') ? ' error' : '' }}">
                        @if ($errors->has('matricula'))
                          <span class="text-danger">
                              {{ $errors->first('matricula') }}
                          </span>
                        @endif
                      @else
                        <input type="text" name="matricula" id="matricula" value="{{$verificar_codigo_empleado->codigo}}" class="form-control text-center {{ $errors->has('matricula') ? ' error' : '' }}" readonly>
                      @endif
                    </div>
                  </div> 
                  <div class="form-group d-flex align-items-center mb-2">
                    <div class="col-md-5 text-right"
                      {{Form::label('tipo_id','Tipo Lactancia')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                    </div>
                    <div class="col-md-7 text-center">
                        <select name="tipo_id" class="form-control text-center" id="tipo_id" onchange="changeType()" required value>
                            <option value="">--   SELECCIONE   --</option>
                            @foreach ($tipoLactancia as $t)
                              @if($t->descripcion=="POSTNATAL")
                                @if($flag_postnatal==true)
                                  <option value="{{$t->id}}" {{ old('tipo_id',$lactancia->tipo_id) == $t->id ? 'selected' : '' }} >
                                    {{$t->descripcion}} 
                                  </option>
                                @endif
                              @else
                                <option value="{{$t->id}}" {{ old('tipo_id',$lactancia->tipo_id) == $t->id ? 'selected' : '' }} >
                                  {{$t->descripcion}} 
                                </option>
                              @endif                        
                            @endforeach
                        </select>
                    </div>
                  </div>


                  <div id="prenatalDocumentacion" name="prenatalDocumentacion" style="display: none">
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        <label for="example-text-input" class="form-control-label">Certificado Medico<span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="file" name="documento_prenatal" id="documento_prenatal" class="form-control {{ $errors->has('documento_prenatal') ? ' error' : '' }}" id="" accept="application/pdf"  value="{{ old('documento_prenatal') }}">
                        @if ($errors->has('documento_prenatal'))
                        <span class="text-danger">
                            {{ $errors->first('documento_prenatal') }}
                        </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('fecha_inicio_prenatal','Fecha Certificado Medico' )}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="date" name="fecha_inicio_prenatal" id="fecha_inicio_prenatal"  class="form-control text-center {{ $errors->has('fecha_inicio_prenatal') ? ' error' : '' }}" value="{{ old('fecha_inicio_prenatal',$lactancia->fecha_inicio_prenatal) }}">
                        @if ($errors->has('fecha_inicio_prenatal'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_inicio_prenatal') }}
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div id="postnatalDocumentacion" name="postnatalDocumentacion" style="display: none">
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        <label for="example-text-input" class="form-control-label">Certificado de Nacimiento <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="file" name="documento_certificado_nacimiento" id="documento_certificado_nacimiento" class="form-control {{ $errors->has('documento_certificado_nacimiento') ? ' error' : '' }}"   accept="application/pdf">
                        @if ($errors->has('documento_certificado_nacimiento'))
                        <span class="text-danger">
                            {{ $errors->first('documento_certificado_nacimiento') }}
                        </span>
                        @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('fecha_certificado_nacimiento','Fecha de Nacimiento' )}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="date" name="fecha_certificado_nacimiento"  id="fecha_certificado_nacimiento" class="form-control text-center {{ $errors->has('fecha_certificado_nacimiento') ? ' error' : '' }}" value="{{ old('fecha_certificado_nacimiento',$lactancia->fecha_certificado_nacimiento) }}" >
                          @if ($errors->has('fecha_certificado_nacimiento'))
                              <span class="text-danger">
                                  {{ $errors->first('fecha_certificado_nacimiento') }}
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        <label for="example-text-input" class="form-control-label">Respaldo de la Caja de Salud Postnatal  <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="file" name="documento_caja_postnatal" id="documento_caja_postnatal" class="form-control {{ $errors->has('documento_caja_postnatal') ? ' error' : '' }}"  accept="application/pdf">
                        @if ($errors->has('documento_caja_postanatal'))
                        <span class="text-danger">
                            {{ $errors->first('documento_caja_postnatal') }}
                        </span>
                        @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('fecha_registro_caja','Fecha del Respaldo Postnatal' )}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                      </div>
                      <div class="col-md-7 text-center">
                        <input type="date" name="fecha_registro_caja_postnatal" id="fecha_registro_caja_postnatal" class="form-control text-center {{ $errors->has('fecha_registro_caja_postnatal') ? ' error' : '' }}" value="{{ old('fecha_registro_caja_postnatal',$lactancia->fecha_registro_caja_postnatal) }}" >
                          @if ($errors->has('fecha_registro_caja_postnatal'))
                              <span class="text-danger">
                                  {{ $errors->first('fecha_registro_caja_postnatal') }}
                              </span>
                          @endif
                      </div>
                    </div>
                  </div>



                  @if($empleado->sexo == 0)
                    <div class="col-md-5"><h5 class="card-title">Datos Beneficiaria</h5></div>
                    
                    @if($obtener_beneficiarias != null)
                      <div class="form-group d-flex align-items-center mb-2">
                        <div class="col-md-5 text-right">
                            {{Form::label('beneficiaria','Beneficiaria')}} <span class="text-danger">(*)</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-7 text-center">
                            <select name="beneficiaria" class="form-control text-center" id="beneficiaria" onchange="changeBeneficiaria({{$obtener_beneficiarias}})" >
                                <option value="">--   OTRO   --</option>
                                @foreach ($obtener_beneficiarias as $b)
                                    <option value="{{$b->id}}">
                                      {{$b->nombres}} 
                                    </option>         
                                @endforeach
                            </select>
                        </div>
                      </div>
                    @endif

                  
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('nombres','Nombres')}} <span class="text-danger">(*)</span>&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <input id="nombres" type="text" class="form-control text-center {{ $errors->has('nombres') ? ' error' : '' }}" name="nombres" value="{{ old('nombres',$lactanciaBeneficiaria->nombres) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                        @if ($errors->has('nombres'))
                            <span class="text-danger">
                                {{ $errors->first('nombres') }}
                            </span>
                        @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('ap_paterno','Apellido Paterno')}} <span class="text-danger">(*)</span>&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <input id="ap_paterno" type="text" class="form-control text-center {{ $errors->has('ap_paterno') ? ' error' : '' }}" name="ap_paterno" value="{{ old('ap_paterno',$lactanciaBeneficiaria->ap_paterno) }}"   autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                          @if ($errors->has('ap_paterno'))
                              <span class="text-danger">
                                  {{ $errors->first('ap_paterno') }}
                              </span>
                          @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('ap_materno','Apellido Materno')}} <span class="text-danger">(*)</span>&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <input id="ap_materno" type="text" class="form-control text-center {{ $errors->has('ap_materno') ? ' error' : '' }}" name="ap_materno" value="{{ old('ap_materno',$lactanciaBeneficiaria->ap_materno) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                          @if ($errors->has('ap_materno'))
                              <span class="text-danger">
                                  {{ $errors->first('ap_materno') }}
                              </span>
                          @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('ci','C.I.')}} <span class="text-danger">(*)</span>&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <input type="text" class="form-control text-center {{ $errors->has('ci') ? ' error' : '' }}" name="ci" id="ci" value="{{ old('ci',$lactanciaBeneficiaria->ci) }}"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
                          event.keyCode === 46 ? true : !isNaN(Number(event.key))" required>
                          @if ($errors->has('ci'))
                              <span class="text-danger">
                                  {{ $errors->first('ci') }}
                              </span>
                          @endif
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('ci_complemento','C.I. Complemento')}}&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <input type="text" class="form-control text-center" name="ci_complemento" id="ci_complemento" value="{{ old('ci_complemento',$lactanciaBeneficiaria->ci_complemento) }}">
                      </div>
                    </div> 
                    <div class="form-group d-flex align-items-center mb-2">
                      <div class="col-md-5 text-right">
                        {{Form::label('ci_lugar','C.I. Lugar')}}<span class="text-danger">(*)</span>&nbsp;&nbsp;</div>
                      <div class="col-md-7 text-center">
                        <select name="ci_lugar" id="ci_lugar" class="form-control text-center {{ $errors->has('ci_lugar') ? ' error' : '' }}" required >
                          <option value="">-- SELECCIONE --</option>
                          @foreach ($lugares_ci as $lugar)
                              <option value="{{ $lugar->descripcion }}" {{ old('ci_lugar',$lactanciaBeneficiaria->ci_lugar) ==$lugar->descripcion ? 'selected' :'' }} >{{ $lugar->descripcion }}</option>
                          @endforeach
                      </select>
                    </div>
                    </div> 
                  
                  @endif
                </div>
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="{{ route('lactancias_empleados.index') }}" class="btn btn-danger">Salir</a>
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
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/lactanciaConsultaAndCreate.js') }}" type="text/javascript"></script>
@endsection
