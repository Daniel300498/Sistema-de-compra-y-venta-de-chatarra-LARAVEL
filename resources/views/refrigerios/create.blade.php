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
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">CI</th>
                        @for($i = 1; $i <= 31; $i++)
                              <th class="text-center">{{$i}}</th>
                             @endfor
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refrigerios as $r)
                        <tr>
                         
                            <td class="text-left">{{$r->mes}}</td>
                            <td class="text-left"> {{$r->ap_paterno}} {{$r->ap_materno}} {{$r->nombres}}</td>
                            <td class="text-left">{{$r->descripcion}}</td>
                            <td class="text-left">{{$r->ci}}</td>
                             @for($i = 1; $i <= 31; $i++)
                                            @php $valor = $r->{'col_'.$i}; @endphp
                                            <td class="text-left">{{ $valor }}</td>
                                        @endfor
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