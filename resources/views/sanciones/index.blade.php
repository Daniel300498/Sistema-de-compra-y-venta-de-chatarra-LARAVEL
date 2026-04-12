@extends('layouts.app')

@section('titulo', 'PLANILLA DE SANCIONES DISCIPLINARIAS')

@section('content')

<div class="pagetitle">
    <h1>PLANILLA DE SANCIONES DISCIPLINARIAS</h1>
    <div class="d-flex align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Planilla de Sanciones Disciplinarias</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generar Planilla</h5>
                    <form action="{{ route('sanciones.consulta') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="gestion" class="col-sm-4 text-right">Gesti&oacute;n</label>
                            <div class="col-sm-4">
                                <select name="gestion" id="gestion" class="form-control" required>
                                    <option value="2024" selected>2024</option>
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
                            <label for="tipo_cargo" class="col-sm-4 text-right">Tipo de Cargo</label>
                            <div class="col-sm-4">
                                <select name="tipo_cargo" id="tipo_cargo" class="form-control">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach ($tipo_cargo as $tipo )
                                    <option value="{{$tipo->descripcion}}">{{$tipo->descripcion}}</option>    
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="exportType" id="exportType" value="consulta">
                            <button type="submit" class="btn btn-warning">Generar</button>
                            <button type="submit" class="btn btn-primary" onclick="setExportType('excel')">Generar Excel</button>
                            <button type="submit" class="btn btn-danger" onclick="setExportType('pdf')">Generar PDF</button>
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
@if (count($biometrico)>0)
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informaci&oacute;n Registrada para las Sanciones Disciplinarias</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th rowspan="2">CARGO</th>
                            <th colspan="3">NOMBRES Y APELLIDOS</th>
                            <th rowspan="2">CEDULA DE IDENTIDAD</th>
                            <th rowspan="2">Nro. Item</th>
                            <th rowspan="2">HABER BASICO</th>
                            <th rowspan="2">BONO DE ANTIGUEDAD</th>
                            <th rowspan="2">TOTAL GANADO POR DIA</th>
                            <th colspan="3">ATRASOS</th>
                            <th colspan="2">FALTAS</th>
                            <th colspan="3">LICENCIAS SIN GOCE DE HABERES</th> 
                            <th rowspan="2">TOTAL DESCUENTO</th>
                            </tr>
                            <tr>
                            <th>PATERNO</th>
                            <th>MATERNO</th>
                            <th>NOMBRES</th>
                            <th>MINUTOS</th>
                            <th>DIAS</th>
                            <th>BS</th>
                            <th>DIAS</th>
                            <th>BS</th>
                            <th>DIAS</th>
                            <th>DESCUENTO POR LOS DIAS DE PERMISO</th>
                            <th>BS</th>
                            </tr>
                            </thead>

                      <tbody>
                                @foreach($biometrico as $registro)
                                    <tr>      
                                    <td>{{ $registro->descripcion }}</td>             
                                    <td>{{ $registro->ap_paterno }}</td>
                                    <td>{{ $registro->ap_materno }}</td>
                                    <td>{{ $registro->nombres }}</td>
                                    <td>{{ $registro->ci }}</td>
                                    <td>{{ $registro->nro_item }}</td>
                                    <td>{{ number_format($registro->sueldo, 2) }}</td>

                                    <td>{{$registro->bono}}</td>
                                    <td>{{ number_format($registro->sueldoDia, 2) }}</td>
                                    <td>{{ $registro->minutos_atraso }} </td>
                                    <td>{{$registro->dias}}</td>
                                    <td>{{ number_format(($registro->sueldoDia * $registro->dias), 2) }}</td>
                                    <td>{{$registro->faltas}}</td> 
                                    <td>{{ number_format(($registro->faltas * $registro->sueldoDia), 2) }}</td>
                                    <td>{{$registro->LSH}}</td>
                                    <td>{{ number_format(($registro->LSH * $registro->sueldoDia), 2) }}</td>
                                    <td>{{ number_format((($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>                    
                                    <td>{{ number_format(($registro->faltas * $registro->sueldoDia) + ($registro->sueldoDia * $registro->dias)+ (($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>
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
