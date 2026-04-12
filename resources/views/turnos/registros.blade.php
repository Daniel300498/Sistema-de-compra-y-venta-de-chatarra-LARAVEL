@extends('layouts.app')

@section('titulo','Turnos')

@section('content')

<div class="pagetitle">
    <h1>TURNOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
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
            <h5 class="card-title">Turnos registrados</h5>
           
          </div>
        
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Empresa</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Tipo Horario</th>
                  <th class="text-center">Opciones</th>

                
                </tr>
              </thead>
              <tbody>
                @foreach ($turnos as  $key=>$document)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        {{ $document->empresa  }}
                    </td>
                    <td class="text-center">
                        {{ $document->nombre }}
                  
                    </td>
                    <td class="text-center">
                      {{ $document->horario->nombre }}
                  
                  </td>
                  <td class="text-center">
                    <a href="{{route('turnos.edit',$document->id )}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
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