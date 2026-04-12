@extends('layouts.app')
@section('titulo','Lactancia')
@section('content')

<div class="pagetitle mb-0">
    <h1>REGISTRO LACTANCIA</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Registro Lactancia</a></li>
            <li class="breadcrumb-item active">Bono Lactancia</li>
        </ol>
        </nav>
    </div>
   
 </div><!-- End Page Title -->

 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Historial Bono de Lactancia</h5>

            @can('empleados.create')
            <a class="btn btn-primary position-absolute top-0 end-0 mt-2" title="Edita el valor del bono lactancia" onclick="update_bono({{$bono_actual->id}},{{$bono_actual->valor}})">Actualizar Bono Lactancia</a>
            @endcan

            <p>Desde esta secci&oacute;n puede actualizar el bono de lactancia, tambi&eacute;n se puede observar el historial de lactancias.
           
          <input type="hidden" value="{{ auth()->user()->can('lactancias.edit') }}" id='can_edit'>
          <input type="hidden" value="{{ auth()->user()->can('lactancias.show') }}" id='can_show'>
          <input type="hidden" value="{{ auth()->user()->can('lactancias.destroy') }}" id='can_destroy'>
 

           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Activo</th>
                            <th class="text-center">Fecha Creaci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bonos_lactancia as $index => $b)
                            <tr>
                                <td class="text-center">{{ $index +1 }}</td>
                                <td class="text-center">{{$b->descripcion}} </td>
                                <td class="text-center">{{$b->valor}}</td>
                                <td class="text-center">
                                    @if ($b->deleted_at != null)
                                        <h5><span class="badge bg-warning">NO</span></h5>
                                    @else
                                        <h5><span class="badge bg-success">SI</span></h5>
                                    @endif
                                </td>
                                <td class="text-center">{{ date('d/m/Y',strtotime($b->created_at)) }} </td>
                            </tr>
                        @endforeach
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
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/lactanciaConsultaAndCreate.js') }}" type="text/javascript"></script>




@endsection