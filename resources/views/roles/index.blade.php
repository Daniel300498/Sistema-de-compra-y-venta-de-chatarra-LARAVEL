@extends('layouts.app')
@section('titulo','Roles Sistema')
@section('content')
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Roles de Acceso</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
            </nav>
        </div>
        @can('roles.create')
            <a href="{{route('roles.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Roles de accceso registrados</h5>
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Rol</th>
                        <th class="text-center ">Descripción</th>
                        <th class="text-center ">Nro usuarios <br>con el rol</th>
                        <th class="text-center" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="fw-bold">{{$role->name}}</td>
                            <td class="text-wrap">{{$role->descripcion}}</td>
                            <td class="text-wrap text-center"><h5><span class="badge bg-secondary">{{$role->users_count}} Usuarios</span></h5></td>
                            <td class="d-flex justify-content-center" >
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('roles.show',$role->uuid)}}">Ver Permisos asignados</a></li> 
                                            <li><a class="dropdown-item" href="{{route('roles.edit',$role->uuid)}}">Modificar Permisos</a></li>
                                            <li><a class="dropdown-item" href="{{ route('roles.destroy',$role->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar el ROL?');">Eliminar Rol</a></li>
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
<script src="{{ asset('js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection