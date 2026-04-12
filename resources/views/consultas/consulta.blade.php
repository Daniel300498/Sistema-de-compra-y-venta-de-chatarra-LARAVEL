@extends('layouts.app')
@section('titulo','')
@section('content')

<div class="pagetitle">
     <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
        <h1>CONSULTA M&Eacute;DICA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consultas.index') }}">Consultas M&eacute;dica</a></li>
                <li class="breadcrumb-item active"> Nuevo</li>
            </ol>
            </nav>
        </div>
      @can('pacientes.create')
            <a href="{{route('pacientes.create')}}" class="btn btn-primary MB-3">Registrar Paciente</a>
        @endcan
    </div>
 </div>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registrar Consulta</h5>
            <p>Puede <strong>REGISTRAR</strong> o <strong>VER</strong> la informaci&oacute;n de las consultas de cada paciente registrado, para ello  puede ingresar el nombre o C.I. para ubicarlo en el sistema y acceder a la opci&oacute;n correspondiente. En caso de que el paciente no se encuentre registrado 
            puedo crearlo con el bot&oacute;n <strong>Registrar Paciente</strong></p>

            <form action="{{route('buscar_pacientes')}}" method="post">
                @csrf
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre del paciente</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                    <div class="col-lg-8">
                        <input type="text" name="ci" id="ci" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar Pacientes</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@if ($pacientes != null)
    <section class="section">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Paciente(s) encontrados según la busqueda</h5>
                <p class="text-justify">Cada paciente tiene la opción de adjuntar una consulta <span class="btn btn-warning"><i class="bi-paperclip"></i></span>, solo tiene que presionarlo para acceder al registro correspondiente.</p>
            <!--CONTENIDO -->
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">CI</th>
                                <th class="text-center">Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacientes as $e)
                                <tr>
                                    <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                    <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                    <td class="d-flex justify-content-center" >
                                        @can('consultas.create')
                                            <a href="{{route('consultas.create',$e->uuid)}}" class="btn btn-warning" title="Ver / Registrar"><i class="bi-paperclip"></i></a>
                                        @endcan
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
@endif
@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection