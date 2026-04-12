@extends('layouts.app')
@section('titulo','Discapacidad')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>REGISTRO DISCAPACIDADES</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('discapacidades.index') }}">Registro Discapacidades</a></li>
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
            <h5 class="card-title">Empleados con Documentos de discapacidad adjuntos</h5>
            <p>Desde esta secci&oacute;n puede modificar, ver documento adjunto y eliminar el registro de discapacidad correspondiente de cada empleado
            @if(count($discapacidades) != 0)
             , se accede a estas opciones desde el botón <strong>Opciones</strong>.
            @endif
           </p>
           <div class="table-responsive">
            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nro Item</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">&aacute;rea</th>
                        <th class="text-center">Empleado </th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discapacidades as $e)
                        <tr>
                            <td class="text-center">{{ $e->empleado->cargo[0]->nro_item }}</td>
                            <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }}</td>
                            <td class="text-center">{{$e->empleado->ci}} @if($e->empleado->ci_complemento != null) - {{ $e->empleado->ci_complemento }} @endif {{ $e->empleado->ci_lugar }}</td>
                            <td class="text-center">@foreach ($e->empleado->cargo as $c )
                                <strong>{{$c->nombre}}</strong>
                                @endforeach </td>
                            <td>{{ $e->empleado->cargo[0]->area->nombre }}</td>
                            <td class="text-center">
                                @if($e->tutor==1)
                                <h6><span class="badge bg-secondary">CON DISCAPACIDAD</span></h6>
                                @else
                                <h6><span class="badge bg-danger">ES TUTOR</span></h6>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opciones
                                      </button>
                                       <ul class="dropdown-menu">
                                          @can('discapacidades.edit')
                                              <li><a class="dropdown-item" href="{{route('discapacidades.edit',$e->uuid)}}">Modificar Datos</a></li>
                                          @endcan
                                          @can('discapacidades.show')
                                          @if ($e->adjunto != null )
                                          <li><a class="dropdown-item" href="{{ asset('discapacidad/'.$e->adjunto) }}" target="_blank">Ver Adjunto</a></li>
                                          @endif
                                          @endcan
                                          @can('discapacidades.destroy')
                                              <li><a class="dropdown-item" href="{{ route('discapacidades.destroy',$e->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar el registro tambien se eliminara el archivo adjunto?');">Eliminar Registro</a></li>
                                          @endcan
                                      </ul>
                                    </div>
                                </div>
                            </td>
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
@endsection
