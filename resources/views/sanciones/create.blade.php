@extends('layouts.app')

@section('titulo','DATOS REFRIGERIO')

@section('content')

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Refrigerios</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Llenado de datos para pago de refrigerios</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'refrigerios.store','class'=>'form-horizontal']) !!}
                @include('refrigerios._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Llenado de datos para pago de refrigerios</h5>
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-bordered" id="datos">
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Tipo Registro</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refrigerios as $r)
                        <tr>
                            <td class="text-center">{{ date('d/m/Y',strtotime($r->fecha)) }}</td>
                            <td class="text-left">
                                @switch($r->tipo_dato)
                                    @case('X')  ASISTENCIA @break
                                    @case('AB')  ABANDONO @break
                                    @case('BM')  BAJA MEDICA @break
                                    @case('BP')  BAJA DE PERSONAL @break
                                    @case('C')  CUMPLEAÑOS @break
                                    @case('LCH')  LICENCIA CON HABER @break
                                    @case('LSH')  LICENCIA SIN GOCE @break
                                    @case('C')  COMISION @break
                                    @case('F')  FALTA @break
                                    @case('T')  TRANSFERENCIA @break
                                    @case('CL')  COMPENSACION LABORAL @break
                                    @case('D')  DESCANSO @break
                                    @case('XOS')  ORDEN DE SALIDA @break
                                    @case('XHP')  HORA PARTICULAR @break
                                    @case('XJM')  JUSTIFICATIVO MEDICO  @break
                                @endswitch
                            </td>
                            <td class="text-left">{{ $r->funcionario->nombre }}</td>
                            <td class="text-left">{{ $r->funcionario->cargo }}</td>
                            <td class="text-left">{{ $r->funcionario->ci }}</td>
                            <td class="d-flex align-items-center justify-content-center">
                                @can('refrigerios.edit')
                                    <a href="{{ route('refrigerios.edit',$r->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
                                @can('refrigerios.destroy')
                                    <a href="{{ route('refrigerios.destroy',$r->id) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
@endSection
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