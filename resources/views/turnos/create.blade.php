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
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Adjuntar Turnos</h5>
              {{-- <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3> --}}
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el boton <strong>GUARDAR</strong>. Presione el boton <strong>Salir</strong> si no desea realizar ninguna accion.</p>
           <!--CONTENIDO -->
           <form action="{{route('turnos.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            {{-- <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}" > --}}
            <div class="row">
              <div class="col-lg-4">
                {{Form::label('empresa','Empresa' )}} <span class="text-danger">(*)</span>
                <input id="empresa" type="text" class="form-control {{ $errors->has('empresa') ? ' error' : '' }}" name="empresa" value="company.defualt" readonly >
                @if ($errors->has('empresa'))
                    <span class="text-danger">
                        {{ $errors->first('empresa') }}
                    </span>
                @endif
            </div>
              <div class="col-lg-4">
                {{Form::label('nombre','Nombre' )}} <span class="text-danger">(*)</span>
                <input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre') }}" >
                @if ($errors->has('nombre'))
                    <span class="text-danger">
                        {{ $errors->first('nombre') }}
                    </span>
                @endif
            </div>
                <div class="col-lg-4">
                    {{Form::label('unidad','Unidad' )}} <span class="text-danger">(*)</span>
                    <select name="unidad" class="form-control {{ $errors->has('unidad') ? ' error' : '' }}" id="unidad">
                   
                      <option value="1" {{ old('unidad')==1 ? 'selected' : '' }} selected>Dia</option>
                      <option value="2" {{ old('unidad')==2 ? 'selected' : '' }}>Semana</option>
                      <option value="3" {{ old('unidad')==3 ? 'selected' : '' }}>Mes</option>
                    
                    </select>
                    @if ($errors->has('unidad'))
                        <span class="text-danger">
                            {{ $errors->first('unidad') }}
                        </span>
                    @endif
                </div>
                

              
              </div>
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('ciclo','Ciclo' )}} <span class="text-danger">(*)</span>
                  <input id="ciclo" type="number" class="form-control {{ $errors->has('ciclo') ? ' error' : '' }}" name="ciclo" value="{{ old('ciclo') }}" >
                  @if ($errors->has('ciclo'))
                      <span class="text-danger">
                          {{ $errors->first('ciclo') }}
                      </span>
                  @endif
              </div>
                
              <div class="col-lg-4">
                <label for="cargo_id">Tipo Horario</label>
                <select name="horario_id" id="horario_id" class="form-control {{ $errors->has('horario_id') ? ' error' : '' }}">
                  <option value="">-- SELECCIONE --</option>
                  @foreach ($horario as $ho)
                      <option value="{{$ho->id}}" {{ old('horario_id') == $ho->id ? 'selected' :'' }}>{{$ho->nombre}}</option>
                  @endforeach
                </select>
                @if ($errors->has('horario_id'))
                    <span class="text-danger">
                        {{ $errors->first('horario_id') }}
                    </span>
                @endif
              </div>
              </div>
              
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('declaraciones.index') }}" class="btn btn-danger">Salir</a>
            </div>
         </form>
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