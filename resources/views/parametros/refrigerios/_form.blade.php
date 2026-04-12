<p>Puede realizar la busqueda del funcionario ingresando el número de carnet o nombre en el listado siguiente.</p>
<div class="row mb-1">
    <label for="funcionario_id" class="col-md-4 col-form-label text-right ">Funcionario </label>
    <div class="col-md-8 ">
        <select name="funcionario_id"  class="form-control {{ $errors->has('funcionario_id') ? ' error' : '' }}" id="funcionario_id" data-old="{{ old('funcionario_id',$refrigerio->funcionario_id) }}" >
            @if(count($funcionarios)>0)
            <option value="">-- SELECCIONE --</option>
            @foreach($funcionarios as $empleado)
                <option value="{{$empleado->id}}" {{ old('empleado_id',$refrigerio->funcionario_id)== $empleado->id ? 'selected' : '' }}>{{ $empleado->ci }} - {{$empleado->nombre}} - {{$empleado->cargo}} </option>
            @endforeach
            @else
                <option value="">NO EXISTEN EMPLEADOS REGISTRADOS PARA SER HABILITADOS</option>
            @endif
        </select>
        @error('empleado_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="row mb-1">
    <label for="fecha" class="col-sm-12 col-md-4 control-label text-right">Fecha <span class="text-danger">(*)</span></label>
    <div class="col-sm-12 col-md-8">
        {{Form::date('fecha',null,['class'=>'form-control','id'=>'fecha', 'required'])}}
    </div>
</div>
<div class="row mb-1">
    <label for="" class="col-sm-12 col-md-4 control-label text-right">Tipo Información</label>
    <div class="col-md-4">
        <select name="tipo_dato" id="tipo_dato" class="form-control">
            <option value="">Seleccionar...</option>
            <option value="X" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'X' ? 'selected' : '' }}>ASISTENCIA</option>
            <option value="AB" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'AB' ? 'selected' : '' }}>ABANDONO</option>
            <option value="BM" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'BM' ? 'selected' : '' }}>BAJA MEDICA</option>
            <option value="BP"  {{ old('tipo_dato',$refrigerio->tipo_dato) == 'BP' ? 'selected' : '' }}>BAJA DE PERSONAL</option>
            <option value="C" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'C' ? 'selected' : '' }}>CUMPLEAÑOS</option>
            <option value="LCH" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'LCH' ? 'selected' : '' }}>LICENCIA CON HABER</option>
            <option value="LSH" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'LSH' ? 'selected' : '' }}>LICENCIA SIN GOCE</option>
            <option value="C" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'C' ? 'selected' : '' }}>COMISION</option>
            <option value="F" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'F' ? 'selected' : '' }}>FALTA</option>
            <option value="T" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'T' ? 'selected' : '' }}>TRANSFERENCIA</option>
            <option value="CL" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'CL' ? 'selected' : '' }}>COMPENSACION LABORAL</option>
            <option value="D" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'D' ? 'selected' : '' }}>DESCANSO</option>
            <option value="XOS" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'XOS' ? 'selected' : '' }}>ORDEN DE SALIDA</option>
            <option value="XHP" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'XHP' ? 'selected' : '' }}>HORA PARTICULAR</option>
            <option value="XJM" {{ old('tipo_dato',$refrigerio->tipo_dato) == 'XJM' ? 'selected' : '' }}>JUSTIFICATIVO MEDICO </option>
        </select>
    </div>
</div>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn back-color-second">{{ $texto }}</button>
        <a href="{{ route('refrigerios.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>