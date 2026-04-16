@extends('layouts.app')
@section('titulo','Empleados')
@section('content')

<div class="pagetitle mb-0">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>MIEMBROS RECONOCIDOS</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="">Miembros Reconocidos</a></li>
                <li class="breadcrumb-item active">Ver Todos</li>
            </ol>
            </nav>
        </div>
       
    </div>
</div><!-- End Page Title -->

@if(count($empleados)>0)
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Miembros Reconocidos</h5>
                    <p>Para acceder a las opciones de los miembros reconocidos presione sobre el botón <strong>Opciones</strong> para acceder a la opcion de Retirar de miembros reconocidos.</p>
                        <div class="table-responsive">
                            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">Número de Item</th>
                                        <th class="text-center">Nombre Completo</th>
                                        <th class="text-center">CI</th>
                                        <th class="text-center">Cargo</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Fecha Inicio</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($empleados->sortBy('cargo.nro_item') as $e)
                                    
                                        @if(request('tipo_cargo') == '' || $e->cargo[0]->tipo_cargo == request('tipo_cargo'))
                                            <tr>
                                                <td class="text-center">
                                                    @foreach ($e->cargo as $c )
                                                    <small>{{$c->nro_item}}</small>
                                                    @endforeach 
                                                </td>
                                                <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                                <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                                <td class="text-left">
                                                    @foreach ($e->cargo as $c )
                                                    {{$c->nombre}} <br> <small>({{ $c->tipo_cargo  }})</small>
                                                    @endforeach 
                                                </td>
                                                <td>{{ $e->cargo[0]->area['nombre'] }}</td>
                                                <td>{{ date('d/m/Y',strtotime($e->cargo[0]['pivot']->fecha_inicio)) }}</td>
                                            
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Opciones
                                                            </button>
                                                            <ul class="dropdown-menu">
                                            
                                                                @can('empleados.retirar')
                                                                <li><a class="dropdown-item" href="{{ route('empleados.retirar',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea retirar al empleado como miembro reconocido de la institución?');">Retirar de Miembros Reconocidos</a></li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><center>NO HAY MIEMBROS RECONOCIDOS</center></h5>
        </div>
      </div>
    </div>
  </div>

</section>
@endif
@endsection

@section('scripts')
    