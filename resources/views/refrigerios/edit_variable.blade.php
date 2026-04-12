@extends('layouts.app')
@section('titulo','Variables Refrigerios')
@section('content')

<div class="pagetitle">
    <h1>Variables Refrigerios</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Editar Variables Refrigerios</a></li>
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
            <h5 class="card-title">Variables Registradas en Refrigerios</h5>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar.</p>
            <input type="hidden" value="{{ auth()->user()->can('refrigerios.edit') }}" id='can_edit'>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Tipo Empleado</th>
                            <th class="text-center">Monto</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       
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
<script src="{{ asset('assets/js/forms/variablesRefrigerios.js') }}" type="text/javascript"></script>

@endsection
