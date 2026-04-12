    @extends('layouts.app')

@section('titulo','Feriados')

@section('content')

<div class="pagetitle">
  <div class="d-flex flex-row align-items-center justify-content-between">
    <div>
          <h1>Feriados</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
              <li class="breadcrumb-item active">Feriados Nacionales y Generales</li>
            </ol>
          </nav>
        </div>
        @can('feriados.create')
            <button class="btn btn-primary" onclick="create();" >Agregar Nuevo</button>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de feriados Registrados</h5>
           <!--CONTENIDO -->
           <p class="mb-0">En el listado de feriados el tipo <strong>General</strong> indica que son fechas que se repiten todos los años, <strong>Anual</strong> indica que es una feriado solo para el año en curso.</p>
           <p>Debe considerar que las fechas ingresadas son utilizadas para el cálculo de vacaciones o licencias, por lo que deben ser incorporadas a inicio de año.</p>
            <div class="table-responsive table-sm">
                <input type="hidden" value="{{ auth()->user()->can('feriados.destroy') }}" id='can_destroy'>
                <input type="hidden" value="{{ auth()->user()->can('feriados.edit') }}" id='can_edit'>
                <table class="table table-bordered table-hover table-sm" id="datos">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    @include('feriados._modal')
    </section>
    @endSection
    
@section('scripts')
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/forms/crudFeriados.js') }}" type="text/javascript"></script>
@endsection