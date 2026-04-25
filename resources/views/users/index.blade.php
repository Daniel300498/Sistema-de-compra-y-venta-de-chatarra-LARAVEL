@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')
<div class="pagetitle mb-0">
    <div class="d-flex flex-row align-items-center justify-content-between mb-0">
        <div>
            <h1>SEGURIDAD DE ACCESOS</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
            </nav>
        </div>
           @can('users.create')
            <a href="{{route('users.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos"> Agregar Nuevo</a>
            @endcan
        </div>
   
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Usuarios Registrados</h5>
            <p class="text-muted small mb-3">
                <i class="bi bi-info-circle me-1"></i>
                Administra las cuentas de acceso al sistema. Cada usuario tiene un rol asignado que determina las acciones que puede realizar.
                Crea, edita o desactiva usuarios según las necesidades del equipo de trabajo.
            </p>
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Correo para acceso <br> al sistema</th>
                            <th class="text-center">Rol Asignado</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">
                                    @foreach ($user->roles as $rol )
                                    <strong>{{$rol->name}}</strong>
                                    @endforeach
                                </td>
                             
                                 <td class="text-center">
                                      <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                            <ul class="dropdown-menu">
                                                @can('users.edit')
                                                <li><a class="dropdown-item" href="{{ route('users.edit',$user->uuid) }}"> <i class="bi bi-pencil"></i> Modificar</a></li>
                                                @endcan
                                                @can('users.destroy')
                                                <li><a class="dropdown-item text-danger" href="{{ route('users.destroy', $user->uuid) }}" onclick="return confirm('¿Eliminar este usuario?')"><i class="bi bi-trash"></i> Eliminar</a></li>
                                                @endcan
                                            </ul>
                                        </div>
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
