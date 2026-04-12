@extends('layouts.app')

@section('titulo','Planilla de Refrigerios')

@section('content')

<div class="pagetitle">
    <h1>Planilla de Refrigerios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Planillas de Refrigerios</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Generar Planilla de Refrigerios</h5>
           <!--CONTENIDO -->
           <p>Debe seleccionar el mes y el tipo de cargo para generar la planilla correspondiente.</p>
           <p>La generación de la planilla demora al recolectar toda la información correspondiente.</p>
            {!! Form::open(['route'=>'planilla_refrigerios.calcular','class'=>'form-horizontal']) !!}
                <div class="row mb-2">
                    <label for="gestion" class="col-sm-4 text-right">Gestión <span class="text-danger">(*)</span></label>
                    <div class="col-sm-4">
                        <select name="gestion" id="gestion" class="form-control">
                            <option value="">--SELECCIONE--</option>
                            <option value="2024" selected>2024</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="mes" class="col-sm-4 text-right">Mes <span class="text-danger">(*)</span></label>
                    <div class="col-sm-4">
                        <select name="mes" id="mes" class="form-control">
                            <option value="">--SELECCIONE--</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="tipo_cargo" class="col-sm-4 text-right">Tipo Cargo <span class="text-danger">(*)</span></label>
                    <div class="col-sm-4">
                        <select name="tipo_cargo" id="tipo_cargo" class="form-control">
                            <option value="">--SELECCIONE--</option>
                            @foreach($tipos_cargos as $ho)
                                <option value="{{ $ho->tipo_cargo }}" {{ old('tipo_cargo')==$ho->tipo_cargo ? 'selected' :'' }}>{{ $ho->tipo_cargo }}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>
            {!! Form::close() !!}
            
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>

   
</section>
@if($generados != null)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Planillas Generadas por Gestión, mes y tipo de cargo</h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm" id="datos">
                    <thead>
                        <tr>
                            <th class="text-center">Gestión</th>
                            <th class="text-center">Mes</th>
                            <th class="text-center">Tipo de Cargo</th>
                            <th class="text-center">Fecha de Generación</th>
                            <th class="text-center">Exportar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($generados as $g)
                            <tr>
                                <td class="text-center">{{ $g->gestion }}</td>
                                <td class="text-center">{{ mes_texto($g->mes) }}</td>
                                <td class="text-center">{{ $g->tipo_cargo }}</td>
                                <td class="text-center">{{ date('d/m/Y',strtotime($g->creacion)) }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <form id="exportar_excel" action="{{ route('planilla_refrigerios.excel') }}" method="POST">
                                            @csrf
                                            {{ Form::hidden('gestion', $g->gestion) }}
                                            {{ Form::hidden('mes', $g->mes) }}
                                            {{ Form::hidden('tipo_cargo', $g->tipo_cargo) }}
                                            <button type="submit" class="btn btn-success" >Excel</button>
                                        </form>
                                        <form id="exportar_pdf" action="{{ route('planilla_refrigerios.pdf') }}" method="POST" target="_blank">
                                            @csrf
                                            {{ Form::hidden('gestion', $g->gestion) }}
                                            {{ Form::hidden('mes', $g->mes) }}
                                            {{ Form::hidden('tipo_cargo', $g->tipo_cargo) }}
                                            <button type="submit" class="btn btn-danger" >Imprimir PDF</button>
                                        </form>
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
@endif
@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection