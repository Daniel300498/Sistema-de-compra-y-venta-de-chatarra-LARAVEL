<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda ver y administrar la información que corresponda</p>

      
<div class="col-lg-4 mt-2">
    {{Form::label('nombre','Nombre')}} <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre',$proveedor->nombre) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombre'))
        <span class="text-danger">
            {{ $errors->first('nombre') }}
        </span>
    @endif
</div>

<div class="col-lg-2 mt-2">
    {{Form::label('nit','NIT / CI ' )}} <span class="text-danger">(*)</span>
    <input type="text" class="form-control {{ $errors->has('nit') ? ' error' : '' }}" name="nit" id="nit" value="{{ old('nit',$proveedor->nit) }}"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('nit'))
        <span class="text-danger">
            {{ $errors->first('nit') }}
        </span>
    @endif
</div>

<div class="col-lg-6 mt-2">
    {{Form::label('direccion','Direccion')}} <span class="text-danger">(*)</span>
    <input type="text" name="direccion" id="direccion" class="form-control {{ $errors->has('direccion') ? ' error' : '' }}" value="{{ old('direccion',$proveedor->direccion) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('direccion'))
        <span class="text-danger">
            {{ $errors->first('direccion') }}
        </span>
    @endif
</div>

<div class="col-md-4 mt-2">
    {{Form::label('email','Correo Electrónico' )}} <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email',$proveedor->email) }}" >
    @if ($errors->has('email'))
        <span class="text-danger">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('telefono','Telefono' )}} <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono',$proveedor->telefono) }}" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('telefono'))
        <span class="text-danger">
            {{ $errors->first('telefono') }}
        </span>
    @endif
</div>

<div class ="col-md-6 mt-2">
    {{Form::label('tipo_producto','Tipo de Producto' )}} <span class="text-danger">(*)</span>
    <input type="text" name="tipo_producto" id="tipo_producto" class="form-control {{ $errors->has('tipo_producto') ? ' error' : '' }}" value="{{ old('tipo_producto',$proveedor->tipo_producto) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('tipo_producto'))
        <span class="text-danger">
            {{ $errors->first('tipo_producto') }}
        </span>
    @endif
</div>
<div class="col-md-12 mt-2">
    {{Form::label('pais','Pais' )}} <span class="text-danger">(*)</span>
    <input type="text" name="pais" id="pais" class="form-control {{ $errors->has('pais') ? ' error' : '' }}" value="{{ old('pais',$proveedor->pais) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('pais'))
        <span class="text-danger">
            {{ $errors->first('pais') }}
        </span>
    @endif

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="background-color: var(--second); border-color:var(--second);">{{ $texto }}</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-danger" style="background-color: var(--first); border-color:var(--first);">Cancelar</a>
    </div>
</div>