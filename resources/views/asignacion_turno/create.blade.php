@extends('layouts.app')

@section('titulo','Asignacion Turno')

@section('content')

<div class="pagetitle">
    <h1>Asignacion Turno</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Asignacion Turno</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 @can('memorandums.create')
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Asignar Turno A Empleado</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p>Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
            <form action="{{route('asignacion_turno.store',$empleado->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}" >

              <div class="row mb-3">
                <div class="col-lg-2">
                </div>
                  <div class="col-lg-4">
                    {{Form::label('fecha_inicial','Fecha Inicial')}} <span class="text-danger">(*)</span>
                        <input id="fecha_inicial" type="date" class="form-control {{ $errors->has('fecha_inicial') ? ' error' : '' }}" name="fecha_inicial" value="{{ old('fecha_inicial') }}"   >
                        @if ($errors->has('fecha_inicial'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_inicial') }}
                            </span>
                        @endif
                  </div>
                  <div class="col-lg-4">
                    {{Form::label('fecha_final','Fecha Final')}} <span class="text-danger">(*)</span>
                        <input id="fecha_final" type="date" class="form-control {{ $errors->has('fecha_final') ? ' error' : '' }}" name="fecha_final" value="{{ old('fecha_final') }}"   >
                        @if ($errors->has('fecha_final'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_final') }}
                            </span>
                        @endif
                  </div>
                  <div class="col-lg-2">
                </div>
              </div>  
              <div class="row mb-3">
              <div class="col-lg-2">
              </div>
                  <div class="col-lg-4">
                    {{Form::label('tipo','Tipo Turno' )}} <span class="text-danger">(*)</span>
                    <select name="turno_id" id="turno_id" class="form-control {{ $errors->has('turno_id') ? ' error' : '' }}">
                      <option value="">-- SELECCIONE --</option>
                      @foreach($turno as $ho)
                        <option value="{{ $ho->id }}" {{ old('turno_id')==$ho->id ? 'selected' :'' }}>{{ $ho->nombre }}</option> 
                      @endforeach
                    </select>
                    @if ($errors->has('turno_id'))
                        <span class="text-danger">
                            {{ $errors->first('turno_id') }}
                        </span>
                    @endif
                  </div>

                  <div class="col-lg-4">
                    {{Form::label('device_id','Biometrico' )}} <span class="text-danger">(*)</span>
                    <select name="device_id" id="device_id" class="form-control {{ $errors->has('device_id') ? ' error' : '' }}">
                      <option value="">-- SELECCIONE --</option>
                      @foreach($biometricos as $biometrico)
                        <option value="{{ $biometrico->id }}" {{ old('device_id')==$biometrico->id ? 'selected' :'' }}>{{ $biometrico->alias }}</option> 
                      @endforeach
                    </select>
                    @if ($errors->has('device_id'))
                        <span class="text-danger">
                            {{ $errors->first('device_id') }}
                        </span>
                    @endif
                  </div>




                  <div class="col-lg-2">
                </div>
              </div>     
              <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="{{ route('memorandums.index') }}" class="btn btn-danger">Salir</a>
              </div>
             
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endcan
@if(count($asignacion_horario)>0)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!--CONTENIDO -->
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Turnos registrados</h5>
             
            </div>
          
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
                <thead>
                  <tr>
                    <th class="text-center">Nro</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Fecha Inicial</th>
                    <th class="text-center">Fecha Final</th>
                    <th class="text-center">Turno</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($asignacion_horario as  $key=>$document)
                    <tr>
                      <td class="text-center">{{ $key+1 }}</td>
                     
                      <td class="text-center">
                        {{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}
                    
                    </td>
                      <td class="text-center">
                          {{ $document->fecha_inicial  }}
                      
                      </td>
                      <td class="text-center">
                        {{ $document->fecha_final  }}
                         
        
                      </td>
                     
                      <td class="text-center">
                        {{ $document->turno->nombre   }}
                      
                      </td>
                      
                      
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <br><br>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
  </section>
@else

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">NO TIENE TURNO ASIGNADO</h5>
        </div>
      </div>
    </div>
  </div>

</section>

@endif
@endSection
@section('scripts')

@endsection