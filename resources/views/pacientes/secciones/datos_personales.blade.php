<div class="col-lg-4 mt-2">
    {{Form::label('ap_paterno','Apellido Paterno')}} <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control {{ $errors->has('ap_paterno') ? ' error' : '' }}" name="ap_paterno" value="{{ old('ap_paterno',$paciente->ap_paterno) }}"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        @if ($errors->has('ap_paterno'))
            <span class="text-danger">
                {{ $errors->first('ap_paterno') }}
            </span>
        @endif
</div>
<div class="col-lg-4 mt-2">
    {{Form::label('ap_materno','Apellido Materno')}} 
    <input id="ap_materno" type="text" class="form-control {{ $errors->has('ap_materno') ? ' error' : '' }}" name="ap_materno" value="{{ old('ap_materno',$paciente->ap_materno) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('ap_materno'))
        <span class="text-danger">
            {{ $errors->first('ap_materno') }}
        </span>
    @endif
</div>           
<div class="col-lg-4 mt-2">
    {{Form::label('nombres','Nombres')}} <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control {{ $errors->has('nombres') ? ' error' : '' }}" name="nombres" value="{{ old('nombres',$paciente->nombres) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombres'))
        <span class="text-danger">
            {{ $errors->first('nombres') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('fecha_nacimiento','Fecha Nacimiento')}} <span class="text-danger">(*)</span>
    <input type="date" class="form-control {{ $errors->has('fecha_nacimiento') ? ' error' : '' }}" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento',$paciente->fecha_nacimiento) }}" onkeyup="calcularEdad();">
    @if ($errors->has('fecha_nacimiento'))
        <span class="text-danger">
            {{ $errors->first('fecha_nacimiento') }}
        </span>
    @endif
</div>
<div class="col-lg-1 mt-2">
    {{Form::label('edad','Edad' )}} <span class="text-danger">(*)</span>
    <input type="number" name="edad" id="campo_edad" class="form-control" value="{{ old('edad',$paciente->edad) }}" readonly>

</div>
<div class="col-lg-3 mt-2">
    {{Form::label('sexo','Género' )}} <span class="text-danger">(*)</span>
    <select name="sexo" id="sexo" class="form-control {{ $errors->has('sexo') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        <option value="1" {{ old('sexo',$paciente->sexo) =='1' ? 'selected' :'' }}>Femenino</option>
        <option value="0" {{ old('sexo',$paciente->sexo) =='0' ? 'selected' :'' }}>Masculino</option>
    </select>
    @if ($errors->has('sexo'))
        <span class="text-danger">
            {{ $errors->first('sexo') }}
        </span>
    @endif
</div>


<div class="col-lg-2 mt-2">
    {{Form::label('ci','C.I.' )}} <span class="text-danger">(*)</span>
    <input type="text" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" name="ci" id="ci" value="{{ old('ci',$paciente->ci) }}"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('ci'))
        <span class="text-danger">
            {{ $errors->first('ci') }}
        </span>
    @endif
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('ci_complemento','Complemento' )}}
    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="{{ old('ci_complemento',$paciente->ci_complemento) }}" >
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('ci_lugar','Expedido' )}} <span class="text-danger">(*)</span>
    <select name="ci_lugar" id="ci_lugar" class="form-control {{ $errors->has('ci_lugar') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($lugares_ci as $lugar)
            <option value="{{ $lugar->descripcion }}" {{ old('ci_lugar',$paciente->ci_lugar) ==$lugar->descripcion ? 'selected' :'' }}>{{ $lugar->descripcion }}</option>
        @endforeach
    </select>
    @if ($errors->has('ci_lugar'))
        <span class="text-danger">
            {{ $errors->first('ci_lugar') }}
        </span>
    @endif
</div>
<div class="col-lg-6 mt-2">
    {{Form::label('domicilio','Domicilio')}} <span class="text-danger">(*)</span>
    <input type="text" name="domicilio" id="domicilio" class="form-control {{ $errors->has('domicilio') ? ' error' : '' }}" value="{{ old('domicilio',$paciente->domicilio) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('domicilio'))
        <span class="text-danger">
            {{ $errors->first('domicilio') }}
        </span>
    @endif
</div>

<div class="col-md-4 mt-2">
    {{Form::label('email','Correo' )}} <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email',$paciente->email) }}" >
    @if ($errors->has('email'))
        <span class="text-danger">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('nro_celular','N°Celular' )}} <span class="text-danger">(*)</span>
    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="{{ old('nro_celular',$paciente->nro_celular) }}" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('nro_celular'))
        <span class="text-danger">
            {{ $errors->first('nro_celular') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('nro_telefono','N° Telefono' )}}
    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="{{ old('nro_telefono',$paciente->telefono) }}" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
</div>
