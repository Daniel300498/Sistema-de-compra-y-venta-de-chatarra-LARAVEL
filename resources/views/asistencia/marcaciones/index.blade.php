@extends('layouts.app')

@section('titulo','Asistencia Empleado')

@section('content')

<div class="pagetitle">
    <h1>Asistencia Empleado</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Asistencia Empleados</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Seleccione al empleado y rango de fechas para obtener sus marcaciones</h5>
                    </div>
                    <!-- CONTENIDO -->
                    
                    
                    <form action="{{ route('asistencias.show') }}" method="POST">
                        @csrf
                        <div class="row mb-1">
                            <label for="empleado" class="col-md-4 col-form-label text-right">Empleado: <span class="text-danger">(*)</span></label>
                            <div class="col-md-8">
                                <select name="empleado_id" id="empleado_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($empleados as $e)
                                        <option value="{{ $e->id }}">{{ $e->ci }} - {{ $e->nombres }} {{ $e->ap_paterno }} {{ $e->ap_materno }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="fecha_inicio" class="col-md-4 col-form-label text-right">Fecha Desde: <span class="text-danger">(*)</span></label>
                            <div class="col-md-4">
                                <input type="date" name="fecha_inicio" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="fecha_fin" class="col-md-4 col-form-label text-right">Fecha Hasta: <span class="text-danger">(*)</span></label>
                            <div class="col-md-4">
                                <input type="date" name="fecha_fin" class="form-control" id="">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ver Marcaciones</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@if($reporteEmpleado != null)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Reporte de Asistencia Desde {{ date('d/m/Y',strtotime($fecha_inicio)) }} Hasta {{ date('d/m/Y',strtotime($fecha_fin)) }} </h5>
                <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <h6 class="text-danger">Total Minutos de Retraso {{ $totalMinutosRetraso }}</h6>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Marcaciones</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Resúmen Por Día</a>
                </li>
              </ul>
              <div class="tab-content pt-5" id="tab-content">
                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Dia</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Hora <br>Registrada</th>
                                    <th class="text-center">Horario</th>
                                    <th class="text-center">Entrada <br> Turno</th>
                                    <th class="text-center">Salida <br>Turno</th>
                                    <th class="text-center">Minutos <br> Retraso</th>
                                    <th class="text-center">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marcaciones as $item)
                                    <tr >
                                        <td class="text-center">{{ $item->dia_semana }}</td>
                                        @if($item->es_feriado==true)
                                            <td class="text-center" style="background-color: #FCD5B4;">{{ date('d/m/Y',strtotime($item->checkTime)) }}</td>
                                            <td class="text-center" style="background-color: #FCD5B4;" colspan="6">FERIADO</td>
                                        @else
                                            <td class="text-center">{{ date('d/m/Y',strtotime($item->checkTime)) }}</td>
                                            <td class="text-center">{{ date('H:i:s',strtotime($item->checkTime)) }}</td>
                                            <td class="text-center">{{ $item->estado }}</td>
                                            <td class="text-center">{{ $item->startTime}}</td>
                                            <td class="text-center">{{ $item->endTime}}</td>
                                            <td class="text-center">@if($item->retrasoMinutos> 0) <strong class="text-danger">{{ $item->retrasoMinutos}} min.</stro> @else -- @endif </td>
                                            <td class="text-ce">{{ $item->tipo_falta }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Dia</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">OS</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">V</th>
                                    <th class="text-center">C</th>
                                    <th class="text-center">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reporteEmpleado as $item)
                                    <tr>
                                        @if($item['feriado']==true)
                                            <td class="text-center" style="background-color: #FCD5B4;">{{ $item['dia'] }}</td>
                                            <td class="text-center" style="background-color: #FCD5B4;">{{ date('d/m/Y',strtotime($item['fecha'])) }}</td>
                                            <td class="text-center" style="background-color: #FCD5B4;" colspan="5">FERIADO</td>
                                        @else
                                            @if($item['dia']=='D' || $item['dia']=='S')
                                                <td class="text-center" style="background-color: #C4D79B;">{{ $item['dia'] }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;">{{ date('d/m/Y',strtotime($item['fecha'])) }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;">{{ $item['ordenSalidaOficial']!='' ? $item['ordenSalidaOficial'] : ($item['ordenSalidaParticular'] != '' ? $item['ordenSalidaParticular'] : '')  }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;">{{ $item['licencias'] }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;">{{ $item['vacaciones'] }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;">{{ $item['comisiones'] }}</td>
                                                <td class="text-center" style="background-color: #C4D79B;"></td>
                                            @else
                                            <td class="text-center">{{ $item['dia'] }}</td>
                                                <td class="text-center">{{ date('d/m/Y',strtotime($item['fecha'])) }}</td>
                                                <td class="text-center">{{ $item['ordenSalidaOficial']!='' ? $item['ordenSalidaOficial'] : ($item['ordenSalidaParticular'] != '' ? $item['ordenSalidaParticular'] : '')  }}</td>
                                                <td class="text-center">{{ $item['licencias'] }}</td>
                                                <td class="text-center">{{ $item['vacaciones'] }}</td>
                                                <td class="text-center">{{ $item['comisiones'] }}</td>
                                                <td class="text-center">{{ $item['inasistencia'] }}</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><strong>Aclaraciones:</strong></p>
                        <p>INASISTENCIA SIMPLE : No marco en una entrada</p>
                        <p>ABANDONO SIMPLE : No marco en una salida</p>
                        <p>INASISTENCIA PARCIAL : No marco la ultima salida</p>
                        <p>ABANDONO DOBLE : No marco en ambas salidas</p>
                        <p>INASISTENCIA ABANDONO : En el primer turno Marco entrada, No marco salida; En el segundo Marco solo salida</p>
                        <p>INASISTENCIA TURNO ABANDONO : No marco un turno, y tiene una salida</p>
                        <p>INASISTENCIA TURNO: No marco un turno</p>
                    </div>
                </div>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endif
@endsection
@section('scripts')
<script>
    $("#empleado_id").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
    
@endsection