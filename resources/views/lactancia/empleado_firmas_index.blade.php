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
            <p>En esta sección se muestra el historial del empleado, se mostrará:
              <ul>
                <li>- <span class="badge bg-secondary">PENDIENTE</span> Cuando aún no se tiene la firma de ese mes</li>
                <li>- <span class="badge bg-danger">NO</span> Cuando el empleado no presento la firma ese mes</li>
                <li>- <span class="badge bg-success">CÓDIGO</span> Se mostrará el código para recoger la lactancia de ese mes.</li>
              </ul>
            </p>
            @else
            <p><span class="badge bg-secondary ">AÚN NO INICIASTE UNA LACTANCIA</span></h5></p>
           
            @endif

            
            
                <div class="">
                    <table class="table table-hover table-bordered table-sm" id="datos">
                      <thead>
                        <tr>
                            <th class="text-center">CI</th>
                            <th class="text-center">F. Inicio Prenatal</th>
                            <th class="text-center">Quinto</th>
                            <th class="text-center">Sexto</th>
                            <th class="text-center">Septimo</th>
                            <th class="text-center">Octavo</th>
                            <th class="text-center">Noveno</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                      @if($empleado->lactancia != null)
                        @foreach($empleado->lactancia as $lactancia) 
                          @if($lactancia->inicio_lactancia == $lactancia_prenatal->id)
                            <tr>
                                <td>{{$empleado->ci}} </td>
                                <td class="text-center">{{$lactancia->fecha_inicio_prenatal}} </td>
                                @foreach($lactancia->mensual as $mensual)
                                <td class="text-center">
                                @switch($mensual->estado)
                                  @case("SI")
                                    @if ($mensual->codigo_lactancia != null)<h5><span class="badge bg-success">{{$mensual->codigo_lactancia}}</span></h5>
                                    @else <h5><span class="badge bg-success">NO CÓDIGO</span></h5> @endif
                                    @break
                                  @case("NO") <h5><span class="badge bg-danger">NO</span></h5> @break
                                  @case("N/A") <h5><span class="badge bg-secondary">PENDIENTE</span></h5> @break
                                </td>
                                @endswitch
                                @endforeach

                                @if($lactancia->estado_prenatal == "PENDIENTE")
                               <td class="text-center"><h5><span class="badge bg-secondary">EN CURSO</span></h5></td>
                                @else
                                  <td class="text-center">
                                    <h5><span class="badge bg-success">{{$lactancia->estado_prenatal}}</span></h5>
                                  </td>
                                @endif
                            </tr>
                          @endif
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

