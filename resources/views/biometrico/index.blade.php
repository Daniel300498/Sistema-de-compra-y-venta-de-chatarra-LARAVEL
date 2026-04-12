@extends('layouts.app')

@section('titulo','Biometricos')

@section('content')

<div class="pagetitle">
    <h1>BIOMETRICO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Biometricos</a></li>
        <li class="breadcrumb-item active">Ver todos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Biometricos registrados</h5>
          </div>
        
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Nombre Dispositivo</th>
                  <th class="text-center">Numero de series</th>
                  <th class="text-center">Area</th>
                  <th class="text-center">Direccion IP</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Ultima Actividad</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($response as  $key=>$document)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        {{ $document['alias']  }}
                    </td>
                    <td class="text-center">
                        {{ $document['sn']  }}
                    </td>
                    <td class="text-center">
                        {{ $document['area']['area_name']  }} 
                    </td>
                    <td class="text-center">
                        {{ $document['ip_address']}}
                    </td>
                    <td class="text-center">
                        {{ $document['state'] }} 
                    </td>
                    <td class="text-center">
                        {{ $document['last_activity'] }} 
                    </td>
                    <td class="text-center">
                      <a href="{{route('devices.edit',$document['id'] )}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                      <a href="{{route('devices.destroy',$document['id'] )}}" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar al Biometrico?');" ><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <br><br>
          </div>
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>

@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection