@extends('layouts.app')
@section('titulo','Publicaciones')
@section('content')
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Publicaciones</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Publicaciones</a></li>
                    <li class="breadcrumb-item active">Listar Publicaciones</li>
                </ol>
            </nav>
        </div>
        @can('publicacion.create')
            <a href="{{ route('publicacion.create') }}" class="btn btn-primary mb-3">Agregar Publicación</a>     
        @endcan
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Publicaciones Registradas</h5>
                    <p class="mb-0">Desde el botón <strong>Filtrar Publicaciones</strong> puede ver todas las publicaciones.</p>
                    <p></p>
                        
                    <!-- Filter Dropdown -->
                    <div class="dropdown mb-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrar Publicaciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="ACTIVO">Publicaciones Activas</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="PROGRAMADO">Publicaciones Programadas</a></li>
                            @can('publicacion.renovar')
                            <li><a class="dropdown-item filter-option" href="#" data-filter="CADUCADO">Publicaciones Caducadas</a></li>
                            @endcan
                            <li><a class="dropdown-item filter-option" href="#" data-filter="PENDIENTE">Publicaciones Pendientes de Revisi&oacute;n</a></ 
                            <li><a class="dropdown-item filter-option" href="#" data-filter="REVISADA">Publicaciones Pendientes de Publicaci&oacute;n</a></li>
                        </ul>
                    </div>

                    <!-- Filter Title -->
                    <h5 class="filter-title bg-primary text-white text-center p-2 rounded" id="filterTitle" style="display: none;">Publicaciones Programadas</h5>

                    <div class="table-responsive" id="tablaPublicaciones" style="display: none;">    
                        <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede ver el documento adjunto, editar o eliminar una Publicación.</p>
                        <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la Publicación que corresponda.</p>
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha de Registro</th>
                                    <th class="text-center">Fecha de Publicación</th>
                                    <th class="text-center">Fecha de Caducidad</th>
                                    <th class="text-center">Tipo de Noticia</th>
                                    <th class="text-center">T&iacute;tulo</th>
                                    <th class="text-center">Opciones</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($portal as $noticia)
                                <tr class="publication-row" data-status="{{ $noticia->custom_status }}"
                                    @if($noticia->custom_status == 'PROGRAMADO')
                                    class="bg-info"
                                    @elseif($noticia->custom_status == 'ACTIVO')
                                    class="bg-success"
                                    @elseif($noticia->custom_status == 'CADUCADO')
                                    class="bg-danger"
                                    @elseif($noticia->custom_status == 'PENDIENTE')
                                    class="bg-warning"
                                    @endif>             

                                    @if($noticia->motivo)                   
                                    <td class="text-center"><h5><span class="badge bg-danger">ANULADO</span></h5></td>
                                    @else
                                    <td class="text-center">{{ $noticia->estado }}</td>
                                    @endif
                                    <td class="text-center">{{ $noticia->fecha_registro_format }}</td>
                                    @if ($noticia->estado == 0 || $noticia->estado == 1)
                                    <td class="text-center">{{ "NO SE PUBLICÓ" }}</td>     
                                    @else 
                                    <td class="text-center">{{ $noticia->fecha_publicacion_format }}</td>
                                    @endif
                                    @if ($noticia->estado == 2 && $noticia->fecha_caducidad < \Carbon\Carbon::now()->format('Y-m-d'))
                                    <td class="text-center">{{"Caducado en fecha ".$noticia->fecha_caducidad }}</td>
                                    @else
                                    <td class="text-center">{{ $noticia->fecha_caducidad_format }}</td>
                                    @endif
                                    <td class="text-center">{{ $noticia->tipo}}</td>
                                    <td class="text-center">{{ $noticia->titulo }}</td>
                                                           
                                    <td class="d-flex justify-content-center">
                                    <div class="btn-group" role="group">
                                    @can('publicacion.publicar')
                                        @if ($noticia->estado == 1)     
                                        <form action="{{ route('publicacion.publicar', $noticia->uuid) }}" method="POST" @if($noticia->fecha_publicacion < \Carbon\Carbon::now()->format('Y-m-d')) onsubmit="return confirm('La fecha de publicación se actualizará a la fecha de hoy ¿desea continuar?');" @else onsubmit="return confirm('¿Está seguro que desea publicar?');" @endif>
                                        @csrf
                                                <button type="submit" class="btn btn-primary btn-sm me-2">Publicar</button>
                                            </form>
                                        @endif
                                    @endcan
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" target="_blank" href="{{ asset('publicaciones/' . $noticia->documento) }}">Ver Documentación</a></li>
                                            <li> 
                                                @if ($noticia->estado == 2 && $noticia->fecha_caducidad < \Carbon\Carbon::now()->format('Y-m-d'))
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#renovarModal{{ $noticia->uuid }}">Vista Preliminar / Renovar</a></li>
                                                @elseif ($noticia->estado == 0)
                                                    @can('publicacion.aprobar')
                                                    @if(!$noticia->motivo)
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#noticiaModal{{ $noticia->uuid }}"> Vista Preliminar / Aprobar - Rechazar</a>
                                                    </li>
                                                    @endif
                                                    @endcan
                                                @endif
                                            </li>            
                                            @can('publicacion.edit')
                                                @if(!$noticia->motivo)
                                                    <li><a class="dropdown-item" href="{{route('publicacion.edit',$noticia->uuid)}}">Modificar Publicación</a></li>
                                                @endif
                                            @endcan        
                                            @can('publicacion.destroy')
                                                <li>
                                                    <form action="{{ route('publicacion.destroy', $noticia->uuid) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar la publicación?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Eliminar Publicación</button>
                                                    </form>
                                                </li>
                                            @endcan          
                                        </ul>
                                    </div>
                                </td>

                                </tr>
                                @include('publicaciones.modal._modal_renovar')
                                @include('publicaciones.modal._modal_publicar')
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
<script src="{{ asset('assets/js/tablas/publicaciones.js') }}" type="text/javascript"></script>
@endsection
