@extends('layouts.app')
@section('titulo','Camas')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>SALAS Y CAMAS</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Salas y Camas</a></li>
            <li class="breadcrumb-item active">Listar Camas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Camas Registradas</h5>
            <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede editar o eliminar una cama.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la cama que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Piso</th>
                            <th class="text-center">Nombre de la Sala</th>
                            <th class="text-center">Tipo de Sala</th>
                            <th class="text-center">Numero de Cama</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    @foreach($camas as $a)
                    <tr>
                    <td class="text-center">{{$a->salas->nombre}}</td>
                    <td class="text-center">{{$a->salas->piso}}</td>
                    <td class="text-center">{{$a->salas->tipo}}</td>
                    <td>{{$a->numero}}</td>
                    <td>{{$a->estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('camas.edit')
                                            <li><a class="dropdown-item" href="{{ route('camas.edit', $a->uuid) }}">Modificar Cama</a></li>
                                            @endcan        
                                            @can('camas.destroy')
                                            <li><a class="dropdown-item" href="{{ route('camas.destroy',$a->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la cama?');">Eliminar Cama</a></li>
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
