<p> Debe rellenar el campo descripción y el salario correspondiente y presionar el botón <strong>GUARDAR</strong>.</p>
<form action="{{ route('cargoDenominacion.update', $cargoDenominacion->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="descripcion">Denominación del Cargo <span class="text-danger">*</span></label>
                <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion"  value="{{ old('descripcion', isset($cargoDenominacion) ? $cargoDenominacion->descripcion : '') }}"  required="required" placeholder="Ingrese la Denominación del cargo" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                @error('descripcion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <label for="sueldo">Salario</label> <span class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Bs.-</span>
                </div>
                <input id="sueldo" type="number" step="0.01" class="form-control {{ $errors->has('sueldo') ? ' error' : '' }}" name="sueldo"  value="{{ old('sueldo', isset($cargoDenominacion) ? $cargoDenominacion->sueldo : '') }}"  required="required">
                 @error('sueldo')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cargoDenominacion.index') }}" class="btn btn-danger">Salir</a>  
            </div>
        </div>
    </div>
</form>
