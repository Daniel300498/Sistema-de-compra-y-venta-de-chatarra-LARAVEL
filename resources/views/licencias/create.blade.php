@extends('layouts.app')
@section('titulo','Nueva Licencia')
@section('content')
<div class="pagetitle">
    <h1>LICENCIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('licencias_empleados.index') }}">Licencias</a></li>
        <li class="breadcrumb-item active">Nueva Licencia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
                <!-- TITLE -->
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="card-title">Registrar Nueva Licencia</h5>
                  <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
                </div>
                <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
                <!--CONTENIDO -->
                {!! Form::open(['route'=>'licencias.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                    @include('licencias._form',['texto' => 'Registrar','color'=>'primary'])
                {!! Form::close() !!}
                <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<link href="http://t4t5.github.io/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
<script src="http://t4t5.github.io/sweetalert/dist/sweetalert.min.js"></script>
<!--<script src="{{ asset('assets/js/forms/licenciasControlCampos.js') }}" type="text/javascript"></script>-->
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$("#jefe_inmediato").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
  const feriados = <?php echo json_encode($arr_feriados); ?>;
</script>
@endsection
