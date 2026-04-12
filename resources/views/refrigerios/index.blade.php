@extends('layouts.app')
@section('titulo', 'PLANILLA REFRIGERIO')
@section('content')

<div class="pagetitle">
<div class="d-flex flex-row align-items-center justify-content-between">
   <div>
    <h1>PLANILLA REFRIGERIO</h1>
         <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Planilla Refrigerio</li>
            </ol>
        </nav>
    </div>
  
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generar Planilla</h5>
                    <form action="{{ route('refrigerios.consulta') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="gestion" class="col-sm-4 text-right">Gesti&oacute;n</label>
                            <div class="col-sm-4">
                                <select name="gestion" id="gestion" class="form-control" required>
                                    <option value="">--SELECCIONE--</option>
                                    <option value="2024" selected>2024</option>
                                    <option value="2025" selected>2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mes" class="col-sm-4 text-right">Mes</label>
                            <div class="col-sm-4">
                                <select name="mes" id="mes" class="form-control" required>
                                    <option value="enero">Enero</option>
                                    <option value="febrero">Febrero</option>
                                    <option value="marzo">Marzo</option>
                                    <option value="abril">Abril</option>
                                    <option value="mayo">Mayo</option>
                                    <option value="junio">Junio</option>
                                    <option value="julio">Julio</option>
                                    <option value="agosto">Agosto</option>
                                    <option value="septiembre">Septiembre</option>
                                    <option value="octubre">Octubre</option>
                                    <option value="noviembre">Noviembre</option>
                                    <option value="diciembre">Diciembre</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tipo_cargo" class="col-sm-4 text-right">Tipo de Cargo <span class="text-danger">(*)</span></label>
                            <div class="col-sm-4">
                                <select name="tipo_cargo" id="tipo_cargo" class="form-control" required>
                                    <option value="">--SELECCIONE--</option>
                                    @foreach ($tipo_cargo as $tipo)
                                        @if ($tipo->descripcion !== 'PASANTE')
                                            <option value="{{ $tipo->descripcion }}">{{ $tipo->descripcion }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="hidden" name="exportType" id="exportType" value="consulta">
                            <button type="submit" class="btn btn-warning">Generar</button>
                            <button type="submit" class="btn btn-primary" onclick="setExportType('excel')">Generar Excel</button>
                        </div>
                    </form>

                    <script>
                        function setExportType(type) {
                            document.getElementById('exportType').value = type;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($empleados != null)
@if (count($biometricoMensual)>0)
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informaci&oacute;n registrada por d&iacute;a para el refrigerio</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Apellidos y Nombres</th>
                                    <th>Cargo</th>
                                    <th>C.I.</th>
                                    <th>Item</th>
                                    <th>Sueldo</th>
                                    @can('refrigerios.show')
                                    @foreach($diasArray as $dia)
                                    <th>{{ $dia }}</th>
                                    @endforeach
                                    @endcan
                                    <th> DIAS HABILES TRABAJADOS</th>
                                    <th> FALTAS</th>
                                    <th> ABANDONO</th>
                                    <th> VACACION</th>
                                    <th> LCGH</th>
                                    <th> LSGH</th>
                                    <th> ASUETO</th>
                                    <th> VIATICOS</th>
                                    <th> FERIADOS </th>
                                    <th> IMPORTE DIARIO</th>
                                    <th> TOTAL A PAGAR</th>
                                </tr>
                                <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                @can('refrigerios.show')
                                @for($i = 1; $i <= $diasEnElMes; $i++)
                                    <th>{{ $i }}</th>
                                    @endfor
                                    @endcan
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($biometricoMensual as $registro)
                                    <tr>
                                      
                                        <td>{{ $registro->ap_paterno }} {{ $registro->ap_materno }} {{ $registro->nombres }} </td>
                                        <td>{{ $registro->descripcion }}</td>
                                        <td>{{ $registro->ci }}</td>
                                        <td>{{ $registro->nro_item }}</td>
                                        <td>{{ $registro->sueldo }}</td>
                                        @can('refrigerios.show')
                                       @for($i = 1; $i <= $diasEnElMes; $i++)
                                            @php $valor = $registro->{'col_'.$i}; @endphp
                                            <td class="{{ 
                                                $valor == 'X' ? 'bg-success' : 
                                                ($valor == 'F' ? 'bg-danger' : 
                                                ($valor == 'AB' ? 'bg-warning' : ''))
                                            }}">
                                                {{ $valor }}
                                            </td>
                                        @endfor
                                        @endcan
                                        <td>{{$registro->dias_trabajados}}</td>
                                        <td>{{$registro->faltas}}</td>
                                        <td>{{$registro->abandono}}</td>
                                        <td>{{$registro->vacacion}}</td>
                                        <td>{{$registro->LCH}}</td>
                                        <td>{{$registro->LSH}}</td>
                                        <td>{{$registro->ASUETO}}</td>
                                        <td>{{$registro->VIATICOS}}</td>
                                        <td>{{$registro->feriado}}</td>
                                        <td>Bs. {{$monto_pago->valor}}</td>
                                         <td>Bs. {{ number_format($registro->dias_trabajados * $monto_pago->valor, 2) }}</td>
                
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
@else 
<h5 class="text-center">NO SE ENCONTR&Oacute; NING&Uacute;N REGISTRO CON LOS FILTROS SELECCIONADOS</h5>
@endif
@endif

@endsection

