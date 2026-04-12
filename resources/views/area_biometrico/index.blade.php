@extends('layouts.app')

@section('titulo','Area Biometrico')

@section('content')

<div class="pagetitle">
    <h1>AREA BIOMETRICO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('area_biometrico.index') }}">&Aacute;rea Biometrico</a></li>
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
          <h5 class="card-title">Area Biometrico Registrados</h5>
          <p>Desde esta sección puede modificar o eliminar áreas registradas en el biometrico desde <strong>OPCIONES</strong>.</p>
           
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Codigo Área</th>
                  <th class="text-center">Nombre De Área</th>
                  <th class="text-center">Área Superior</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($response as  $key=>$area)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        {{ $area['area_code']  }}
                    </td>
                    <td class="text-center">
                        {{ $area['area_name']  }}
                    </td>
                   <td class="text-center">
                      @if($area['parent_area'] != null) 
                        {{ $area['parent_area']['area_name']  }} 
                      @else
                      N/A
                      @endif
                    </td>
                 
                    <td class="text-center">
                      <a href="{{route('area_biometrico.edit',$area['id'] )}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                      <a href="{{route('area_biometrico.destroy',$area['id'] )}}" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el area Biometrico?');" ><i class="bi bi-trash"></i></a>
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