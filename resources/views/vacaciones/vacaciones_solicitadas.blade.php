@extends('layouts.app')
@section('titulo','Vacaciones Solicitadas')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Vacaciones Solicitadas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
             <li class="breadcrumb-item"><a href="">Vacaciones</a></li>
            <li class="breadcrumb-item active">Historial Vacaciones Solicitadas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if (auth()->user()->rol[0]->id==4)
            <h5 class="card-title">Mi Historial De Vacaciones</h5>
                
            @else
            <h5 class="card-title">Empleados Registrados Con Solicitud De Vacaci&oacute;n</h5>
                
            @endif
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Fecha Solicitada</th>
                            <th class="text-center">Fecha Desde</th>
                            <th class="text-center">Fecha Hasta</th>
                            <th class="text-center">Nro. D&iacute;as Solicitados</th>
                            <th class="text-center">Fecha Aprobaci&oacute;n</th>
                            <th class="text-center">Aprobado por</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></th>
                            {{-- <th class="text-center">Opciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacaciones as $e)
                      
                            <tr>
                                <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }} </td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($e->fecha_solicitud)) }}</td>
                                <td class="text-center"><strong>{{ date('d/m/Y', strtotime($e->fecha_inicio)) }}</strong></td>
                                <td class="text-center"><strong>{{ date('d/m/Y', strtotime($e->fecha_hasta)) }}</strong></td>
                                <td class="text-center"><strong>{{$e->nro_dias_solicitados}}</strong></td>
                                @if ($e->fecha_aprobacion==null)
                                <td class="text-center"><strong>
                                    @if($e->estado='pendiente')
                                    <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                    @endif
                                </td> 
                                    
                                @else
                                <td class="text-center"><strong>{{ date('d/m/Y', strtotime($e->fecha_aprobacion)) }}</strong></td>
                                @endif
                               
                                @if ($e->id_empleado_aprobacion==null)
                                <td class="text-center">
                                    @if($e->estado='pendiente')
                                        <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                    @endif
                                </td>
                                @else
                                <td class="text-center"><strong>{{$e->empleado_aprobacion->nombres}} {{ $e->empleado_aprobacion->ap_paterno }} {{ $e->empleado_aprobacion->ap_materno }}</strong></td>
                                    
                                @endif
                               
                                <td class="text-center">
                                @switch($e->estado)
                                    @case('pendiente')
                                        <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                        @break

                                    @case('aprobado')
                                        <h5><span class="badge bg-success">APROBADO</span></h5>
                                        @break

                                    @case('rechazado')
                                        <h5><span class="badge bg-danger">DENEGADO</span></h5>
                                        @break

                                @endswitch
                                    
                               </td>


                                <td class="d-flex justify-content-center" >
                                    
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('vacacion.edit')
                                            @if($e->estado == "pendiente")
                                                <li><a class="dropdown-item" href="{{route('vacacion.edit',$e->uuid)}}">Modificar Datos</a></li>
                                            @endif
                                        @endcan
                                        @if(auth()->user()->rol[0]->id !=4 && $e->estado == "pendiente")
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#rechazos-{{ $e->id }}">Rechazar Solicitud</a></li>
                                        @endif
                                        @if($e->estado=='aprobado')
                                            <li><a class="dropdown-item" href="{{route('vacacion.show',$e->empleado_id)}}"   target="_blank">Reporte de vacaci&oacute;n</a></li>
                                            <li><a class="dropdown-item" href="{{route('vacacion.solicitud_vacacion',$e->uuid)}}" target="_blank">Ver Documento de Solicitud</a></li>
                                      @endif
                                    </ul>
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
@foreach($vacaciones as $e)
<div class="modal fade" id="rechazos-{{ $e->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Rechazar Vacaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('vacacion.rechazo')}}" method="POST">
                {{ csrf_field()}}
                <input type="hidden" name="vacacion_id" id="vacacion_id" value="{{ $e->id }}">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="fecha_aprobacion" class="col-control-label">Observaci&oacute;n</label>
                        <input type="text" class="form-control" name="observacion" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Rechazado Por</label>
                        <select name="empleado_id" id="empleado_id" class="form-control {{ $errors->has('empleado_id') ? ' error' : '' }}">
                            <option value="">-- SELECCIONE --</option>
                            @foreach ($todosEmpleados as $templeado)
                                <option value="{{ $templeado->id }}" {{ old('empleado_id',$templeado->id) == $templeado->id ? 'selected' : '' }}>{{ $templeado->nombres  }} {{$templeado->ap_paterno}} {{$templeado->ap_materno}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn back-color-second">Guardar</button>
                    <button type="button" class="btn back-color-first" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection