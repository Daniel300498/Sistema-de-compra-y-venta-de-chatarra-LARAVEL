@extends('layouts.app')
@section('titulo','Cargo de Empleados')
@section('content')


<div class="pagetitle">
    <h1>Cargo de Empleados</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cargoEmpleados.buscar_cargo_empleado') }}">Cargo de Empleados</a></li>
            <li class="breadcrumb-item"><a href="#">Cargo de Empleados Activos</a></li>
            <li class="breadcrumb-item active">Agregar Interino</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Agregar al Empleado a un Cargo como interino</h5>
                        <h3><span class="badge bg-nombre-empleado">EMPLEADO: {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</span></h3>  
                    </div> 
                    @if($cargoempleados->where('tipo_alta', 'INTERINO')->isEmpty()) 
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. 
                    <form action="{{ route('cargoEmpleados.store_interino', $empleado->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id}}"> 
                        <div class="mb-3">
                                 {{ Form::label('cargo', 'Cargo') }} <span class="text-danger">(*)</span>
                                <select name="cargo" id="cargo" class="form-control {{ $errors->has('cargo') ? ' error' : '' }}">
                                    <option value="">-- SELECCIONE --</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" 
                                            {{ old('cargo') == $cargo->id ? 'selected' : '' }}> 
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cargo'))
                                    <span class="text-danger">{{ $errors->first('cargo') }}</span>
                                @endif
                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_ini" class="form-label">Fecha de Inicio</label><span class="text-danger">(*)</span>
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini">
                                    @if ($errors->has('fecha_ini'))
                                        <span class="text-danger">{{ $errors->first('fecha_ini') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="memorandum" class="form-label">Adjuntar Memorandum</label><span class="text-danger">(*)</span>
                                    <input type="file" class="form-control" id="memorandum" name="memorandum">
                                    @if ($errors->has('memorandum'))
                                        <span class="text-danger">{{ $errors->first('memorandum') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Agregar Interino</button>
                            <a href="{{ route('cargoEmpleados.buscar_cargo_empleado') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                @endif

                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cargos Registrados</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar unicamente el cargo de interinato.</p>
           <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
               <thead>
                   <tr>
                        <th class="text-center">ITEM</th>
                       <th class="text-center">Cargo</th>
                       <th class="text-center">Fecha Inicio</th>
                       <th class="text-center">Tipo Alta</th>
                       <th class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($cargoempleados as $a)
                   <tr>
                   <td class="text-center"><small>{{$a->cargo->nro_item}}</small></td>
                    <td class="text-center"><small>{{$a->cargo->nombre}}</small></td>
                   <td class="text-center"><small>{{ date('d/m/Y', strtotime($a->fecha_inicio)) }}</small></td>
                   <td class="text-center"><small>{{$a->tipo_alta}}</small></td>
                 
                   <td class="d-flex justify-content-center" >
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                        </button>
                        <ul class="dropdown-menu">
                        @if($a->tipo_alta ==="INTERINO")
                        <li><a class="dropdown-item" href="{{ asset('memorandums/' . $a->archivo_memorandum) }}" target="_blank">Ver Memorándum</a></li>     
                            @can('cargoEmpleados.destroy')
                                <li><a class="dropdown-item" href="{{ route('cargoEmpleados.destroy',$a->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar el Cargo de interino?');">Eliminar Cargo Interino</a></li>
                            @endcan
                        @endif    
                    </ul>
                      </div>
                   </td>
                 
                   </tr>
              @endforeach
               </tbody>
           </table>
           <!-- EndCONTENIDO Example -->
        </div>
    </div>
</div>
</div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>$("#depende_id").select2({placeholder: '--SELECCIONE--',width: 'resolve' }).on('select2-open', function () {$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();});</script>

@endsection
