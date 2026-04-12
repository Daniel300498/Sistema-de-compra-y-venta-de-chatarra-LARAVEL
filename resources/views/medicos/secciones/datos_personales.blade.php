<div class="col-lg-4 mt-2">
    {{Form::label('ap_paterno','Apellido Paterno')}} <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control {{ $errors->has('ap_paterno') ? ' error' : '' }}" name="ap_paterno" value="{{ old('ap_paterno',$medico->ap_paterno) }}"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        @if ($errors->has('ap_paterno'))
            <span class="text-danger">
                {{ $errors->first('ap_paterno') }}
            </span>
        @endif
</div>
<div class="col-lg-4 mt-2">
    {{Form::label('ap_materno','Apellido Materno')}} 
    <input id="ap_materno" type="text" class="form-control {{ $errors->has('ap_materno') ? ' error' : '' }}" name="ap_materno" value="{{ old('ap_materno',$medico->ap_materno) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('ap_materno'))
        <span class="text-danger">
            {{ $errors->first('ap_materno') }}
        </span>
    @endif
</div>           
<div class="col-lg-4 mt-2">
    {{Form::label('nombres','Nombres')}} <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control {{ $errors->has('nombres') ? ' error' : '' }}" name="nombres" value="{{ old('nombres',$medico->nombres) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombres'))
        <span class="text-danger">
            {{ $errors->first('nombres') }}
        </span>
    @endif
</div>
<div class="col-lg-6 mt-2">
    {{Form::label('especialidad','Especialidad')}} <span class="text-danger">(*)</span>
    <input type="text" name="especialidad" id="especialidad" class="form-control {{ $errors->has('especialidad') ? ' error' : '' }}" value="{{ old('especialidad',$medico->especialidad) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('especialidad'))
        <span class="text-danger">
            {{ $errors->first('especialidad') }}
        </span>
    @endif
</div>

<div class="col-md-4 mt-2">
    {{Form::label('correo','Correo' )}} <span class="text-danger">(*)</span>
    <input type="correo" name="correo" id="correo" class="form-control {{ $errors->has('correo') ? ' error' : '' }}" value="{{ old('correo',$medico->correo) }}" >
    @if ($errors->has('correo'))
        <span class="text-danger">
            {{ $errors->first('correo') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('telefono','N°Celular' )}} <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono',$medico->telefono) }}" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('telefono'))
        <span class="text-danger">
            {{ $errors->first('telefono') }}
        </span>
    @endif
</div>

