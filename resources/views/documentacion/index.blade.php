@extends('layouts.app')
@section('titulo','Documentacion')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Documentación</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Documentación</a></li>
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
            <h5 class="card-title">Empleados Registrados con Documentación</h5>
            <p>Para acceder a las opciones de la documentación presione sobre el botón <strong>Opciones</strong> para acceder a la opcion de modificar o eliminar el registro.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    @if(count($documentos)>0)
                        
                    <tbody>
                        @foreach($documentos as $e)
                        @if($e->empleado!=null)
                            <tr>
                                <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }}</td>
                                <td class="text-center">{{$e->empleado->ci}} @if($e->empleado->ci_complemento != null) - {{ $e->empleado->ci_complemento }} @endif {{ $e->empleado->ci_lugar }}</td>
                                <td class="text-center">{{$e->empleado->cargo[0]->nombre}} <small>({{ $e->empleado->cargo[0]->tipo_cargo }})</small></td>
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('documentos.edit')
                                                <li><a class="dropdown-item" href="{{route('documentos.edit',$e->uuid)}}">Modificar Registro</a></li>
                                            @endcan
                                            @can('documentos.show')
                                                <li><a class="dropdown-item" href="{{route('documentos.show',$e->uuid)}}" target="_blank">Lista Documentos Entregados</a></li>
                                            @endcan
                                            
                                            @can('documentos.show')
                                                <li>
                                                    <a class="dropdown-item" href="{{ asset('documentos_empleados/' . $e->hoja_vida) }}" target="_blank">
                                                        Ver Curriculum
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('documentos.show')
                                                <li><a class="dropdown-item" href="{{route('documentos_todos.show',$e->uuid)}}" target="_blank">Ver Documentos File</a></li>
                                            @endcan

                                            @can('documentos.destroy')
                                            <form action="{{ route('documentos.destroy', $e->uuid) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar la documentación?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Eliminar Registro</button>
                                            </form>
                                            @endcan
                                        </ul>
                                      </div>
                                
                                
                              
                               </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    @endif
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

