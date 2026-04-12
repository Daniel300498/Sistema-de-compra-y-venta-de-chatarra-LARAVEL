@extends('layouts.app')

@section('titulo','Entradas y Salidas')

@section('content')

<div class="pagetitle">
    <h1>ENTRADAS BIOMETRICO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Entradas y Salidas</li>
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
            <h5 class="card-title">Entradas registradas</h5>
          </div>
          <p>Desde esta secci&oacute;n puede ver las entradas y salidas de todos los empleados 
           </p>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Id Empleado</th>
                  <th class="text-center">Nombre Completo</th>
                  <th class="text-center">Tipo</th>
                  <th class="text-center">Hora</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($response as  $key=>$entrada)
                  <tr>
                    <td class="text-center">
                        {{ $entrada['id']  }}
                    </td>

                    <td class="text-center">
                        {{ $entrada['first_name']  }} {{ $entrada['last_name']  }}
                    </td>
                    
                      @if($entrada['punch_state_display']=='Entrada')
                      <td class="text-center">
                        <button type="button" class="btn btn-secondary">{{ $entrada['punch_state_display']  }}</button>
                      </td>
                     
                      @else
                      <td class="text-center">
                        <button type="button" class="btn btn-primary">{{ $entrada['punch_state_display']  }}</button>
                      </td>
                      @endif
                    
                      <td class="text-center">
                        {{date("d/m/Y H:i:s", strtotime($entrada['punch_time'])) }} 
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