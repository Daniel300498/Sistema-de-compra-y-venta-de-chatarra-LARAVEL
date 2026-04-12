<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
    <div class="row mb-1">
        <label for="tipo_cargo" class="col-md-4 col-form-label text-right">Tipo Cargo <span class="text-danger">(*)</span></label>
        <div class="col-md-6">
            <select name="tipo_cargo" id="tipo_cargo" class="form-control {{ $errors->has('tipo_cargo') ? ' error' : '' }}" onchange="changeTipoCargo();">
                <option value="">Seleccionar...</option>
                @foreach ($cargo_tipos as $tc)
                    <option value="{{ $tc->descripcion }}" {{ old('tipo_cargo',$cargo->tipo_cargo)==$tc->descripcion ? 'selected' : '' }}>{{ $tc->descripcion }}</option>
                @endforeach
            </select>
            @if ($errors->has('tipo_cargo'))
            <span class="text-danger">
                {{ $errors->first('tipo_cargo') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row mb-1">
    <label for="area_id" class="col-md-4 col-form-label text-right">Área <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select name="area_id" id="area_id" class="form-control {{ $errors->has('area_id') ? ' error' : '' }}">
            <option value="">Seleccionar...</option>
            @foreach ($areas as $a)
                <option value="{{ $a->id }}" {{ old('area_id',$cargo->area_id)==$a->id ? 'selected' : '' }}>{{ $a->nombre }}</option>
            @endforeach
        </select>
        @if ($errors->has('area_id'))
        <span class="text-danger">
            {{ $errors->first('area_id') }}
        </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="denominacion_cargo_id" class="col-md-4 col-form-label text-right ">Denominación <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select name="denominacion_cargo_id" id="denominacion_cargo_id" class="form-control {{ $errors->has('denominacion_cargo_id') ? ' error' : '' }}">
            <option value="">Seleccionar...</option>
            @foreach ($denominaciones as $d)
                <option value="{{ $d->id }}" {{ old('denominacion_cargo_id',$cargo->denominacion_cargo_id)==$d->id ? 'selected' : '' }}>{{ $d->descripcion }} --> SUELDO: {{ $d->valor }} BS.</option>
            @endforeach
        </select>
        @if ($errors->has('denominacion_cargo_id'))
            <span class="text-danger">
                {{ $errors->first('denominacion_cargo_id') }}
            </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="nro_item" class="col-md-4 col-form-label text-right "> Nro item</label>
    <div class="col-md-6">
        <input id="nro_item" type="text" class="form-control @error('nro_item') error @enderror" name="nro_item" disabled value="{{ old('nro_item',$cargo->nro_item) }}">
        @error('nro_item')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mb-1">
    <label for="nombre" class="col-md-4 col-form-label text-right "> Nombre del Cargo <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control @error('nombre') error @enderror" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('nombre',$cargo->nombre) }}">
        @error('nombre')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mb-1">
    <label for="requisito_minimo" class="col-md-4 col-form-label text-right "> Requisito mínimo del Cargo <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="requisito_minimo" type="text" class="form-control @error('requisito_minimo') error @enderror" name="requisito_minimo" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('requisito_minimo',$cargo->requisito_minimo) }}" >
        @error('requisito_minimo')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ $texto }}</button>
        <a href="{{ route('cargos.index') }}" class="btn btn-danger">Salir</a>
    </div>
</div>
