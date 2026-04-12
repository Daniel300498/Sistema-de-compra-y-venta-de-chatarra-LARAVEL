@extends('layouts.app')
@section('titulo','Vacaciones Pendientes')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Vacaciones Pendientes</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Vacaciones</a></li>
            <li class="breadcrumb-item active">Ver Vacaciones Pendientes</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados Con Vacaciones Pendientes</h5>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">C.I.</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacaciones as $e)
                            <tr>
                                <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }} </td>
                                <td class="text-center">{{$e->empleado->ci}} @if($e->empleado->ci_complemento != null) - {{$e->empleado->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                <td class="text-center"><strong>{{$e->empleado->cargo[0]->pivot['cargos.nombre']}}</strong></td>
                                <td class="text-center"><strong><h5><span class="badge bg-secondary">{{$e->estado}}</span></h5></strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendientes-{{ $e->id }}" title="Agregar Instituci&oacute;n">
                                        Aprobar
                                      </button>
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
<div class="modal fade" id="pendientes-{{ $e->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Aprobar Vacaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('vacacion.aprobada')}}" method="POST" onclick="validar()">
                {{ csrf_field()}}
                <input type="hidden" name="vacacion_id" id="vacacion_id" value="{{ $e->id }}">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="fecha_aprobacion" class="col-control-label">Fecha Aprobaci&oacute;n </label>
                        <input type="date" class="form-control" id="fechaReserva" name="fecha_aprobacion" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Aprobado Por</label>
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