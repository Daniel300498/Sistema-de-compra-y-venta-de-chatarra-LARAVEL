@extends('layouts.app')

@section('titulo','TITULO')

@section('content')

<div class="pagetitle">
    <h1>TITULO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"></li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reporte de Asistencia Mensual - {{ \Carbon\Carbon::parse($mes)->format('F Y') }}</h5>

            @foreach($reporteMensual as $reporte)
                <h3>{{ $reporte['empleado'] }}</h3>

                <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Marcación Mañana</th>
                            <th>Marcación Tarde</th>
                            <th>Retraso (Minutos)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reporte['dias'] as $dia)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($dia['fecha'])->format('d/m/Y') }}</td>
                            <td>{{ $dia['marcacion_manana'] }}</td>
                            <td>{{ $dia['marcacion_tarde'] }}</td>
                            <td>{{ $dia['retraso'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</section>

@endSection
