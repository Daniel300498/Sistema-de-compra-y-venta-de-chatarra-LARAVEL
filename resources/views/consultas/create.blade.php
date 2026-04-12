@extends('layouts.app')
@section('titulo', 'Consultas')

@section('content')
<div class="pagetitle">
  <h1>CONSULTAS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('consultas.create', ['uuidPaciente' => $paciente->uuid ]) }}">Consultas</a></li>
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
            <h5 class="card-title">Adjuntar Consultas</h5>
            <h3><span class="badge bg-nombre-empleado">{{ $paciente->nombres }} {{ $paciente->ap_paterno }} {{ $paciente->ap_materno }}</span></h3>
          </div>

          <p>
            Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. 
            Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. 
            Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.
          </p>

          <form action="{{ route('consultas.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

            <div class="row">
              <div class="col-lg-4 mb-3">
                    {{ Form::label('fecha', 'Fecha de Consulta') }} <span class="text-danger">*</span>
                    <input type="date" name="fecha" id="fecha" class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" value="{{ old('fecha') }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              <div class="col-lg-4 mb-3">
                  {{ Form::label('medico_id', 'Médico Responsable') }} <span class="text-danger">*</span>
                  <select name="medico_id" id="medico_id" class="form-control {{ $errors->has('medico_id') ? 'is-invalid' : '' }}">
                      <option value="">-- Seleccione un médico --</option>
                      @foreach ($medicos as $medico)
                          <option value="{{ $medico->id }}" {{ old('medico_id') == $medico->id ? 'selected' : '' }}>
                              {{ $medico->nombres }} {{ $medico->ap_paterno }} {{ $medico->ap_materno }}
                          </option>
                      @endforeach
                  </select>
                  @error('medico_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="col-lg-4 mb-3">
                  {{ Form::label('motivo_consulta', 'Motivo de la Consulta') }} <span class="text-danger">*</span>
                  <input type="text" name="motivo_consulta" id="motivo_consulta" class="form-control {{ $errors->has('motivo_consulta') ? 'is-invalid' : '' }}" value="{{ old('motivo_consulta') }}">
                  @error('motivo_consulta')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="col-lg-6 mb-3">
                  {{ Form::label('diagnostico', 'Diagnóstico') }} <span class="text-danger">*</span>
                  <textarea name="diagnostico" id="diagnostico" rows="4" class="form-control {{ $errors->has('diagnostico') ? 'is-invalid' : '' }}">{{ old('diagnostico') }}</textarea>
                  @error('diagnostico')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="col-lg-6 mb-3">
                  {{ Form::label('observaciones', 'Observaciones') }}
                  <textarea name="observaciones" id="observaciones" rows="4" class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}">{{ old('observaciones') }}</textarea>
                  @error('observaciones')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

          </div>

          <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="{{ route('consultas.index') }}" class="btn btn-danger">Salir</a>
          </div>
      </form>
        </div>
      </div>
    </div>
  </div>
</section>

@if(count($consultas) > 0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Consultas registradas</h5> 
          </div>
          <p>
            Si necesita realizar una corrección del registro previamente ingresado o eliminarlo puede utilizar las opciones del menú.
          </p>

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="datos" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Motivo de la Consulta</th>
                  <th class="text-center">Diagnostico</th>
                  <th class="text-center">Observaciones</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($consultas as $key => $consulta)
                <tr>
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td class="text-center">{{date('d/m/Y', strtotime($consulta->fecha))}}</td>
                  <td class="text-center">{{$consulta->motivo_consulta}}</td>
                  <td class="text-center" title="{{ $consulta->diagnostico }}">{{ \Illuminate\Support\Str::limit($consulta->diagnostico, 50) }}</td>
                  <td class="text-center" title="{{ $consulta->observaciones }}">{{ \Illuminate\Support\Str::limit($consulta->observaciones, 50) }}</td>                  <td class="d-flex align-items-center justify-content-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                      <ul class="dropdown-menu">
                         @can('consultas.edit')
                          <li><a class="dropdown-item" href="{{ route('consultas.edit', $consulta->uuid) }}">Modificar datos</a></li>
                        @endcan
                        @can('consultas.destroy')
                          <li>
                            <a class="dropdown-item" href="{{ route('consultas.destroy', $consulta->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la consulta?');">
                              Eliminar Consulta
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
      $("#fecha_retiro").show().prop("required", true);
      $("#bloque, #label").show();
    } else {
      $("#fecha_retiro").hide().removeAttr("required");
      $("#label").hide();
    }
  }
</script>
@endsection
