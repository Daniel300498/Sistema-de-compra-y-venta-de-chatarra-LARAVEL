<p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes, presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>

<!-- CONTENIDO -->
<form action="{{ route('contratos.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
    
    <div class="row mb-4">
        <div class="col-lg-4">
            <label for="documento" class="form-control-label">Contrato</label><span class="text-danger">(*)</span>
            <div class="d-flex align-items-center">
                <input type="file" name="documento" class="form-control text-center me-3 {{ $errors->has('documento') ? 'error' : '' }}" accept="application/pdf">
                @if ($contratos->documento)
                    <a href="{{ asset('contratos/' . $contratos->documento) }}" class="btn btn-info" title="Ver Adjunto" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                @endif
            </div>
            @can('contratos.edit')
            @if ($errors->has('documento'))
                <span class="text-danger">{{ $errors->first('documento') }}</span>
            @endif
            @endcan
        </div>

        <div class="col-lg-4">
            {{ Form::label('fecha_ini', 'Fecha de Inicio') }} <span class="text-danger">(*)</span>
            <input type="date" name="fecha_ini" id="fecha_ini" class="form-control text-center {{ $errors->has('fecha_ini') ? 'error' : '' }}" value="{{ old('fecha_ini', isset($contratos) ? $contratos->fecha_ini : '') }}">
            @if ($errors->has('fecha_ini'))
                <span class="text-danger">{{ $errors->first('fecha_ini') }}</span>
            @endif
        </div>

        <div class="col-lg-4">
            {{ Form::label('fecha_fin', 'Fecha de Fin') }}
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control text-center {{ $errors->has('fecha_fin') ? 'error' : '' }}" value="{{ old('fecha_fin', isset($contratos) ? $contratos->fecha_fin : '') }}">
            @if ($errors->has('fecha_fin'))
                <span class="text-danger">{{ $errors->first('fecha_fin') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            {{ Form::label('nro_contrato', 'Nro de Contrato') }}
            <input type="text" name="nro_contrato" id="nro_contrato" class="form-control text-center {{ $errors->has('nro_contrato') ? 'error' : '' }}" value="{{ old('nro_contrato', isset($contratos) ? $contratos->nro_contrato : '') }}">
            @if ($errors->has('nro_contrato'))
                <span class="text-danger">{{ $errors->first('nro_contrato') }}</span>
            @endif
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('contratos.index') }}" class="btn btn-danger">Salir</a>
    </div>
</form>
