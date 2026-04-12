@extends('layouts.app')
@section('titulo','Historial Lactancia Firmas')
@section('content')

<div class="pagetitle mb-0">
    <h1>HISTORIAL LACTANCIA</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Registro Lactancia</a></li>
            <li class="breadcrumb-item active">Historial Lactancia Firmas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Historial</h5>
            @if($matricula!=null)
            <p> <h5><strong>Matricula Seguro:</strong> <span class="badge bg-secondary ">{{$matricula->codigo}}</span></h5></p>
            <p>En esta sección se muestra el historial de lactancias del empleado</p>
            @else
            <p><span class="badge bg-secondary ">AÚN NO INICIASTE UNA LACTANCIA</span></h5></p>
           
            @endif

            
            
                <div class="">
                    <table class="table table-hover table-bordered table-sm" id="datos">
                      <thead>
                        <tr>
                            <th class="text-center">CI</th>
                            <th class="text-center">Mes Inicio Prenatal</th>
                            <th class="text-center">Mes Inicio Postnatal</th>
                            <th class="text-center">Mes Fin Postnatal</th>
                            <th class="text-center">Meses Postnatal</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                      @if($empleado->lactancia != null)
                        @foreach($empleado->lactancia as $lactancia) 
                            <tr>
                                <td>{{$empleado->ci}} </td>
                                <td class="text-center">{{$lactancia->fecha_inicio_prenatal}} </td>
                                <td class="text-center">{{$lactancia->fecha_inicio_postnatal}} </td>
                                <td class="text-center">{{$lactancia->fecha_fin_prenatal}} </td>
                                <td class="text-center">{{$lactancia->meses_lactancia_postnatal}} </td>
                                @if($lactancia->inicio_lactancia == $lactancia_postnatal->id)
                                <td class="text-center">
                                  @can('licencias.show')
                                  <a href="{{route('lactancias_carta.show',$lactancia->empleado_id)}}" class="btn btn-info" title="Ver Carta" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                  @endcan
                                </td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
                <br><br>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/moment.js') }}" type="text/javascript"></script>

@endsection

