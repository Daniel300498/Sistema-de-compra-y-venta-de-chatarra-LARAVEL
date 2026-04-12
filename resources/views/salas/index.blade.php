@extends('layouts.app')
@section('titulo','Sala')
@section('content')

@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Salas y Camas</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Salas y Camas</a></li>
                <li class="breadcrumb-item active">Ver Salas</li>
            </ol>
            </nav>
        </div>
        @can('salas.create')
            <a href="{{route('salas.create')}}" class="btn btn-primary" title="Crea un nueva sala">Agregar Nuevo</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Salas Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede agregar una cama, editar o eliminar una sala.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la sala que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Piso</th>
                            <th class="text-center">Nombre de la Sala</th>
                            <th class="text-center">Tipo de Sala</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salas as $e)
                            <tr>
                            <td class="text-center"><small>{{$e->piso}}</small> </td>
                            <td class="text-center"><small>{{$e->nombre}}</small> </td>
                            <td class="text-center"><small>{{$e->tipo}}</small> </td>
                                
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('salas.edit')
                                                <li><a class="dropdown-item" href="{{route('salas.edit',$e->uuid)}}">Modificar Sala</a></li>
                                            @endcan
                                            @can('camas.create') 
                                            <li><a class="dropdown-item" href="{{route('camas.create',$e->uuid)}}">Agregar Camas</a></li>
                                            @endcan
                                            @can('salas.destroy')
                                            <li><a class="dropdown-item" href="{{ route('salas.destroy',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la sala?');">Eliminar Sala</a></li>
                                            @endcan
                                        </ul>
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

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
