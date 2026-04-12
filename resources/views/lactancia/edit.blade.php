@extends('layouts.app')
@section('titulo','Adjuntar Respaldos Lactancia')
@section('content')

<div class="pagetitle">
    <h1>REGISTRO LACTANCIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lactancias.index') }}">Ver Registrados</a></li>
        <li class="breadcrumb-item active">Adjuntar Documentación Complementaria</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Actualizar Documentación Lactancia</h5>
                <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
                <!--CONTENIDO -->
                <p>Puedes editar algún documento ya ingresado o ingresar alguna nueva documentación con su respectiva fecha.</p>      
                  {!! Form::model($lactancia,['route'=>['lactancias.update',$lactancia->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                      <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                      <input type="hidden" name="lactancia_tipo" id="lactancia_tipo" value="{{ $lactancia->inicio_lactancia }}">
                      <input type="hidden" name="lactancia_postnatal" id="lactancia_postnatal" value="{{ $lactancia->documento_certificado_nacimiento}}">
                      {{ csrf_field()}}
                      <!--TIPO DE LICENCIA-->  

                      @if($lactancia->documento_certificado_nacimiento==null)
                      <h5 class="card-title">Documentación Prenatal</h5>
                      <div id="prenatalDocumentacion" name="prenatalDocumentacion">
                        <div class="col-md-10">
                          <div class="form-group d-flex align-items-center mb-2">
                            <div class="col-md-5 text-right">
                              <label for="example-text-input" class="form-control-label">Certificado Medico </label>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-7 d-flex text-center">
                              <input type="file" name="documento_prenatal" class="form-control" id="" accept="application/pdf">
                              @if ($lactancia->documento_prenatal)
                                  <a href="{{ asset('documentos_lactancia/' . $lactancia->documento_prenatal) }}" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                              @endif
                            </div>
                          </div> 
                          <div class="form-group d-flex align-items-center mb-2">
                            <div class="col-md-5 text-right">
                              {{Form::label('fecha_inicio_prenatal','Fecha Certificado Medico' )}} &nbsp;&nbsp;
                            </div>
                            <div class="col-md-7 d-flex text-center  justify-content-center">
                              <span>{{ date('d / m / Y', strtotime($lactancia->fecha_inicio_prenatal))}}</span>
                            </div>
                          </div>         
                        </div>                        
                      </div>
                      @endif
          
                      <div id="postnatalDocumentacion" name="postnatalDocumentacion">
                        <h5 class="card-title">Documentación Postnatal</h5>
                          <div class="col-md-10">
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <label for="example-text-input" class="form-control-label">Certificado de Nacimiento  </label>&nbsp;&nbsp;
                              </div>
                              <div class="col-md-7 d-flex text-center">
                                <input type="file" name="documento_certificado_nacimiento" id="documento_certificado_nacimiento" class="form-control {{ $errors->has('documento_certificado_nacimiento') ? ' error' : '' }}"   accept="application/pdf">
                                @if ($lactancia->documento_certificado_nacimiento)
                                  <a href="{{ asset('documentos_lactancia/' . $lactancia->documento_certificado_nacimiento) }}" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                @endif
                                @if ($errors->has('documento_certificado_nacimiento'))
                                  <span class="text-danger"> 
                                      {{ $errors->first('documento_certificado_nacimiento') }}
                                  </span>
                                @endif
                              </div>
                            </div> 
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                {{Form::label('fecha_certificado_nacimiento','Fecha de Nacimiento' )}} &nbsp;&nbsp;
                                @if($lactancia->documento_certificado_nacimiento==null)
                                  <span class="text-danger">(*)</span> 
                                @endif
                              </div>
                              <div class="col-md-7 text-center">
                                <input type="date" name="fecha_certificado_nacimiento" id="fecha_certificado_nacimiento" class="form-control text-center {{ $errors->has('fecha_certificado_nacimiento') ? ' error' : '' }}" value="{{ old('fecha_certificado_nacimiento',$lactancia->fecha_certificado_nacimiento) }}" >
                                  @if ($errors->has('fecha_certificado_nacimiento'))
                                      <span class="text-danger">
                                          {{ $errors->first('fecha_certificado_nacimiento') }}
                                      </span>
                                  @endif
                              </div>
                            </div>
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <label for="example-text-input" class="form-control-label">Respaldo de la Caja de Salud </label>&nbsp;&nbsp;
                              </div>
                              <div class="col-md-7 d-flex text-center">
                                <input type="file" name="documento_caja_postnatal" id="documento_caja_postnatal" class="form-control {{ $errors->has('documento_caja_postnatal') ? ' error' : '' }}"  accept="application/pdf">
                                @if ($lactancia->documento_caja_postnatal)
                                      <a href="{{ asset('documentos_lactancia/' . $lactancia->documento_caja_postnatal) }}" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                @endif
                                @if ($errors->has('documento_caja_postnatal'))
                                <span class="text-danger">
                                    {{ $errors->first('documento_caja_postnatal') }}
                                </span>
                                @endif
                              </div>
                            </div> 
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                {{Form::label('fecha_registro_caja_postnatal','Fecha del Respaldo' )}}&nbsp;&nbsp;
                                @if($lactancia->documento_caja_postnatal==null)
                                  <span class="text-danger">(*)</span> 
                                @endif
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
                        </div>
                          
                      <div class="text-center mt-4">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                          <a href="{{ route('lactancias_empleados.index') }}" class="btn btn-danger">Salir</a>
                      </div>
                                      
                  {!! Form::close() !!}


              
                  <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection