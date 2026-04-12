@extends('layouts.app')
@section('titulo','DATOS REFRIGERIO')
@section('content')

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">   
            <h5 class="card-title">Modificar datos para la planilla de refrigerio</h5>
            <h3><span class="badge bg-nombre-empleado">Funcionario: {{$cargoEmpleado->empleado->nombres}} {{$cargoEmpleado->empleado->ap_paterno}} {{$cargoEmpleado->empleado->ap_materno}}</span></h3>
      </div>
            <!--CONTENIDO -->
           {!! Form::model($refrigerio,['route'=>['refrigerios.update',$refrigerio],'method'=>'PUT']) !!}
                @include('refrigerios._form',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
    $("#funcionario_id").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
@endsection


