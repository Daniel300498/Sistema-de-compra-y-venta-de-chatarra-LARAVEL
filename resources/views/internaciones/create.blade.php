@extends('layouts.app')

@section('titulo', 'Internaciones')

@section('content')
<div class="pagetitle">
  <h1>internaciones</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('internaciones.create', ['uuidPaciente' => $paciente->uuid ]) }}">internaciones</a></li>
      <li class="breadcrumb-item active">Nuevo</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Adjuntar Internaciones</h5>
            <h3><span class="badge bg-nombre-empleado">{{ $paciente->nombres }} {{ $paciente->ap_paterno }} {{ $paciente->ap_materno }}</span></h3>
          </div>

          <p>
            Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. 
            Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. 
            Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.
          </p>
        <form action="{{ route('internaciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

            <div class="row">
                <div class="col-lg-4">
                    {{ Form::label('fecha_ocupacion', 'Fecha de Ocupación') }} <span class="text-danger">(*)</span>
                    <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control {{ $errors->has('fecha_ocupacion') ? 'error' : '' }}" value="{{ old('fecha_ocupacion') }}" >
                    @error('fecha_ocupacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-4">
                    {{ Form::label('fecha_desocupacion', 'Fecha de Desocupación') }}
                    <input type="date" name="fecha_desocupacion" id="fecha_desocupacion" class="form-control {{ $errors->has('fecha_desocupacion') ? 'error' : '' }}" value="{{ old('fecha_desocupacion') }}">
                    @error('fecha_desocupacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    {{ Form::label('motivo', 'Motivo de la Internación') }} <span class="text-danger">(*)</span>
                    <input type="text" name="motivo" id="motivo" class="form-control {{ $errors->has('motivo') ? 'error' : '' }}" value="{{ old('motivo') }}" >
                    @error('motivo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12">
                    {{ Form::label('observaciones', 'Observaciones') }}
                    <textarea name="observaciones" id="observaciones" rows="4" class="form-control {{ $errors->has('observaciones') ? 'error' : '' }}">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6">
                    {{ Form::label('medico_id', 'Médico Responsable') }} <span class="text-danger">(*)</span>
                    <select name="medico_id" id="medico_id" class="form-control {{ $errors->has('medico_id') ? 'error' : '' }}" >
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($medicos as $medico)
                            <option value="{{ $medico->id }}" {{ old('medico_id') == $medico->id ? 'selected' : '' }}>
                                {{ $medico->nombres }} {{ $medico->ap_paterno }} {{ $medico->ap_materno }}
                            </option>
                        @endforeach
                    </select>
                    @error('medico_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6">
                    {{ Form::label('cama_id', 'Sala y Cama') }} <span class="text-danger">(*)</span>
                    <select name="cama_id" id="cama_id" class="form-control {{ $errors->has('cama_id') ? 'error' : '' }}" >
                        <option value="">-- SELECCIONE --</option>
                        @foreach ($camas as $cama)
                            <option value="{{ $cama->id }}" {{ old('cama_id') == $cama->id ? 'selected' : '' }}>{{ $cama->salas->piso }} || {{ $cama->salas->nombre }} || CAMA {{ $cama->numero }}</option>
                        @endforeach
                    </select>
                    @error('cama_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-3">
                    {{ Form::label('nombre_cobertura', 'Nombre de Cobertura') }}
                    <select name="nombre_cobertura" id="nombre_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                        <option value="CAJA NACIONAL" {{ old('nombre_cobertura') == 'CAJA NACIONAL' ? 'selected' : '' }}>CAJA NACIONAL</option>
                        <option value="SOAT" {{ old('nombre_cobertura') == 'SOAT' ? 'selected' : '' }}>SOAT</option>
                        <option value="PARTICULAR" {{ old('nombre_cobertura') == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    {{ Form::label('tipo_cobertura', 'Tipo de Cobertura') }}
                    <select name="tipo_cobertura" id="tipo_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                        <option value="SEGURO PUBLICO" {{ old('tipo_cobertura') == 'SEGURO PUBLICO' ? 'selected' : '' }}>SEGURO PÚBLICO</option>
                        <option value="SEGURO PRIVADO" {{ old('tipo_cobertura') == 'SEGURO PRIVADO' ? 'selected' : '' }}>SEGURO PRIVADO</option>
                    </select>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('internaciones.index') }}" class="btn btn-danger">Salir</a>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>

@if(count($internaciones) > 0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">internaciones registradas</h5> 
          </div>
          <p>
            Si necesita realizar una corrección del registro previamente ingresado o eliminarlo puede utilizar las opciones del menú.
          </p>

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="datos" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Fecha de Ocupacion</th>
                  <th class="text-center">Fecha de Desocupacion</th>
                  <th class="text-center">Medico Responsable</th>
                  <th class="text-center">Sala y Cama</th>
                  <th class="text-center">Tipo de Cobertura</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($internaciones as $key => $internacion)
                <tr>
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td class="text-center">{{date('d/m/Y', strtotime($internacion->fecha_ocupacion))}}</td>
                  @if($internacion->fecha_desocupacion)
                  <td class="text-center">{{date('d/m/Y', strtotime($internacion->fecha_desocupacion))}}</td>
                  @else
                  <td class="text-center">AUN INTERNADO</td>
                  @endif
                  <td class="text-center">{{$internacion->medicos->nombres}} {{$internacion->medicos->ap_paterno}} {{$internacion->medicos->ap_materno}}</td>
                  <td class="text-center">{{$internacion->camas->salas->piso }} || {{$internacion->camas->salas->nombre }} || {{$internacion->camas->numero }}</td>
                  <td class="text-center">{{$internacion->tipo_cobertura }}</td>
                  <td class="d-flex align-items-center justify-content-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                      <ul class="dropdown-menu">
                      @can('internaciones.edit')
                          <li><a class="dropdown-item" href="{{ route('internaciones.edit', $internacion->uuid) }}">Modificar datos</a></li>
                        @endcan
                        @can('internaciones.destroy')
                          <li>
                            <a class="dropdown-item" href="{{ route('internaciones.destroy', $internacion->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la internacion?');">
                              Eliminar internacion
                            </a>
                          </li>
                        @endcan
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endif
@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}"></script>
<script>
  mostrar();
  function mostrar() {
    const tipo = $("#tipo").val() ?? $("#tipo").data('old');
    if (tipo == 3) {
      $("#fecha_retiro").show().prop("", true);
      $("#bloque, #label").show();
    } else {
      $("#fecha_retiro").hide().removeAttr("");
      $("#label").hide();
    }
  }
</script>
@endsection
