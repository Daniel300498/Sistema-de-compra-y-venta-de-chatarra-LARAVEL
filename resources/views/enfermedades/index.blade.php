@extends('layouts.app')
@section('titulo','Enfermedad Terminal')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Registro Enfermedad Terminal</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Registro Enfermedad Terminal</a></li>
            <li class="breadcrumb-item active">Ver Registrados</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados con Enfermedad Terminal</h5>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">C.I.</th>
                            <th class="text-center">Nombre M&eacute;dico</th>
                            <th class="text-center">Enfermedad</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $e)
                            <tr>
                               
                                <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                
                                <td class="text-center">{{$e->nombre_medico}}</td>
                                <td class="text-center">{{$e->descripcion}}</td>
                                <td class="d-flex justify-content-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('enfermedades.edit')
                                                <li><a class="dropdown-item" href="{{route('enfermedades.edit',$e->et_uuid)}}">Modificar Datos</a></li>
                                            @endcan
                                            @can('enfermedades.show')
                                                <li><a class="dropdown-item" href="{{ asset('enfermedades/'.$e->documento) }}" target="_blank">Ver certificado M&eacute;dico</a></li>
                                            @endcan
                                            @can('enfermedades.destroy')
                                            <li><a class="dropdown-item" onclick="return confirm('¿Está seguro que desea eliminar el registro?');" href="{{ route('enfermedades.destroy',$e->et_uuid) }}">Eliminar Registro</a></li>
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

