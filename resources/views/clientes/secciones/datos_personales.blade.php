<div class="col-lg-4 mt-2">
    {{Form::label('nombre','Nombre o Razon Social')}} <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre',$cliente->nombre) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombre'))
        <span class="text-danger">
            {{ $errors->first('nombre') }}
        </span>
    @endif
</div>
<div class="col-lg-4 mt-2">
    {{Form::label('pais','País')}} <span class="text-danger">(*)</span>
    <select id="pais" class="form-control {{ $errors->has('pais') ? ' error' : '' }}" name="pais" value="{{ old('pais',$cliente->pais) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <option value="BOLIVIA">BOLIVIA</option>
            <option value="BRASIL">BRASIL</option>
    </select>
    @if ($errors->has('pais'))
        <span class="text-danger">
            {{ $errors->first('pais') }}
        </span>
    @endif
</div>

<div class="col-lg-4 mt-2">
    {{Form::label('nit','NIT / RUC / CI')}} <span class="text-danger">(*)</span>
    <input type="number" name="nit" id="nit" class="form-control {{ $errors->has('nit') ? ' error' : '' }}" value="{{ old('nit',$cliente->nit) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('nit'))
        <span class="text-danger">
            {{ $errors->first('nit') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2"> 
    {{Form::label('telefono','N°Celular' )}} <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono',$cliente->telefono) }}" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('telefono'))
        <span class="text-danger">
            {{ $errors->first('telefono') }}
        </span>
    @endif
</div>

<div class="col-md-4 mt-2">
    {{Form::label('email','Correo Electrónico' )}} <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email',$cliente->email) }}" >
    @if ($errors->has('email'))
        <span class="text-danger">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>


<div class="col-md-6 mt-2"> 
    {{Form::label('direccion','Direccion' )}} <span class="text-danger">(*)</span>
    <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion',$cliente->direccion) }}" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="javascript: ))">
    @if ($errors->has('direccion'))
        <span class="text-danger">
            {{ $errors->first('direccion') }}
        </span>
    @endif
</div>