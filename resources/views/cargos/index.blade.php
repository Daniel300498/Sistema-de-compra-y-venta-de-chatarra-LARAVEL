@extends('layouts.app')
@section('titulo','Cargos')
@section('content')

@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Cargos</h1>
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Cargos</a></li>
                    <li class="breadcrumb-item active">Ver Cargos</li>
                </ol>
                </nav>
        </div>
        @can('cargos.create')
            <a href="{{route('cargos.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cargos Registrados</h5>
            <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede editar o eliminar un cargo.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el cargo que corresponda.</p>
           <!--CONTENIDO -->
           <div class="table-responsive table-sm">
            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Área</th>
                        <th class="text-center">Nro item</th>
                        <th class="text-center">Denominación del Cargo</th>
                        <th class="text-center">Cargo funcional</th>
                        <th class="text-center">Salario Bs.</th>
                        <th class="text-center">Requisito Mínimo</th>
                        <th class="text-center">Tipo Cargo</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cargos as $cargo)

                        <tr>
                            <td><small>{{ $cargo->area->nombre }}</small></td>
                            <td class="text-center">{{$cargo->nro_item}}</td>
                            <td><small>{{$cargo->denominacion->descripcion}}</small></td>
                            <td>{{$cargo->nombre}}</td>
                            <td>{{number_format($cargo->sueldo,2)}}</td>
                            <td><small>{{ $cargo->requisito_minimo }}</small></td>
                            <td class="text-center"><small>{{$cargo->tipo_cargo}}</small></td>
                            <td class="d-flex justify-content-center" >
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('cargos.edit')
                                            <li><a class="dropdown-item" href="{{route('cargos.edit',$cargo->uuid)}}">Modificar Datos</a></li>
                                        @endcan
                                        @can('cargos.destroy')
                                            <li><a class="dropdown-item" href="{{route('cargos.destroy',$cargo->uuid)}}" onclick="return confirm('¿Está seguro que desea eliminar al CARGO?');">Eliminar Cargo</a></li>
                                        @endcan
                                    </ul>
                                  </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
