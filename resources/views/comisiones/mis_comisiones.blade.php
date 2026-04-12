@extends('layouts.app')
@section('titulo','Comision')
@section('content')

<div class="pagetitle">
    <h1>Comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Mis Comisiones</li>
      </ol>
    </nav>

</div><!-- End Page Title -->
@if(count($comisiones)>0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title">Mis Comisiones Asignadas</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-sm table-responsive">
          <tr>
            <th class="text-center">Desde</th>
            <th class="text-center">Hasta</th>
            <th class="text-center">Tipo Jornada</th>
            <th class="text-center">Tipo Comision</th>
            <th class="text-center"></th>
          </tr>
          @foreach ($comisiones as  $key=>$document)
            <tr>
              <td class="text-center">{{ date('d/m/Y',strtotime($document->fecha_inicio)) }}</td>
              <td class="text-center">{{ date('d/m/Y',strtotime($document->fecha_fin)) }}</td>
              @php
              switch ($document->tipo_jornada) {
                      case "1":
                      $tipo="Jornada Laboral";
                      break;
                      case "2":
                      $tipo="Jornada No Laboral";
                      break;
              }
              @endphp
              <td><center>{{ $tipo }}</center></td>
              @php
              switch ($document->tipo_comision) {
                      case "1":
                      $tipo1="Misma Cede";
                      break;
                      case "2":
                      $tipo1="Distinta Cede";
                      break;
                      case "3":
                      $tipo1="Exterior";
                      break;
              }
              @endphp
              <td class="text-center">{{ $tipo1 }}</td>
              <td class="d-flex align-items-center justify-content-center">
                <a href="{{route('comisiones.show',$document->uuid)}}" class="btn btn-warning" title="Ver ficha" target="_blank">Ver ficha de comision</a>
              </td>
            </tr>
          @endforeach
        </table>
        @else
          <h1 class="text-center">NO TIENE COMISIONES ASIGNADAS</h1>
        @endif

        </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endSection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>

@endsection