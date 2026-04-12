@extends('layouts.app')
@section('titulo', 'REPORTE')
@section('content')

<div class="pagetitle">
<div class="d-flex flex-row align-items-center justify-content-between">
   <div>
    <h1>REPORTE</h1>
         <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Reporte</li>
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
                    <h5 class="card-title">Generar Reporte</h5>
                    <p>Para sacar el reporte de todas las &aacute;reas en general, deje en "<strong>--SELECCIONE--</strong> el filtro de &aacute;reas </p>
                    <form action="{{ route('documentos.consulta') }}" method="post">
                        @csrf
                       
                        <div class="row mb-3">
                            <label for="area_trabajo" class="col-sm-4 text-right">&Aacute;reas</label>
                            <div class="col-sm-4">
                                <select name="area_trabajo" id="area_trabajo" class="form-control">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach ($areas as $area)
                                    <option value="{{$area->nombre}}">{{$area->nombre}}</option>    
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
@if (count($reportes)>0)
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informaci&oacute;n registrada de los Funcionarios</h5>
                    @if($area_trabajo)
                    <h4 class="text-center">REPORTE DEL AREA: {{$area_trabajo}}</h4>
                    @else 
                    <h4 class="text-center">REPORTE GENERAL</h4>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Apellidos Y Nombres</th>
                                    <th>C.I.</th>
                                    <th>Cargo</th>
                                    <th>Certificado Aymara</th>
                                    <th> Lugar de Emision</th>                                    
                                </tr>
                                <tr>                 
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($reportes as $registro)
                                    <tr>
                                        @if($registro->empleado)
                                        <td>{{$registro->empleado->ap_paterno}} {{$registro->empleado->ap_materno}} {{$registro->empleado->nombres}}</td>                                        
                                        <td>{{$registro->empleado->ci}} {{$registro->empleado->ci_complemento}} {{$registro->empleado->ci_lugar}}</td>
                                        <td>{{$registro->cargo->nombre}}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($registro->empleado->documentacion->certificado_aymara)
                                        <td>SI</td>
                                        <td>{{$registro->empleado->documentacion->emitido_por}}</td>
                                        @else
                                        <td>NO</td>  
                                        <td></td>                                         
                                        @endif
                             
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
