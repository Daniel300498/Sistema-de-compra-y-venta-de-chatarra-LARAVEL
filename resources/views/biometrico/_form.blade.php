<div class="row">
    <div class="col-lg-2">
    </div>

    <div class="col-lg-4">
        {{Form::label('nombre','Nombre Dispositivo' )}} <span class="text-danger">(*)</span>
        <input id="alias" type="text" class="form-control {{ $errors->has('alias') ? ' error' : '' }}" name="alias"   value="{{ old('alias',$response['alias']) }}" >
        @if ($errors->has('alias'))
        <span class="text-danger">
            {{ $errors->first('alias') }}
        </span>
        @endif
    </div>

    <div class="col-lg-6">
    </div>
</div>


<div class="row">
    <div class="col-lg-2">
    </div>

    <div class="col-lg-4">
        {{Form::label('nombre','Número de serie' )}} <span class="text-danger">(*)</span>
        <input id="sn" type="text" class="form-control {{ $errors->has('sn') ? ' error' : '' }}" name="sn" value="{{ old('sn',$response['sn']) }}" placeholder="Ej:12345678">
        @if ($errors->has('sn'))
        <span class="text-danger">
            {{ $errors->first('sn') }}
        </span>
        @endif
    </div>

    <div class="col-lg-4">
          {{Form::label('nombre','Direccion Ip' )}} <span class="text-danger">(*)</span>
          <input id="ip_address" type="text" class="form-control {{ $errors->has('ip_address') ? ' error' : '' }}" name="ip_address"  value="{{ old('ip_address',$response['ip_address']) }}">
          @if ($errors->has('ip_address'))
          <span class="text-danger">
              {{ $errors->first('ip_address') }}
          </span>
          @endif
    </div>

    <div class="col-lg-2">
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
    </div>

    <div class="col-lg-4">
        {{Form::label('nombre','Área' )}} <span class="text-danger">(*)</span>
        <select name="area" id="area" class="form-control text-center {{ $errors->has('area') ? ' error' : '' }}">
            <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
            @foreach ($areas as $area)
                <option value="{{$area['id']}}">{{$area['area_name']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-4">
        {{Form::label('nombre','Zona horaria' )}} <span class="text-danger">(*)</span>
        <select name="terminal_tz" id="terminal_tz" class="form-control text-center {{ $errors->has('terminal_tz') ? ' error' : '' }}">
            <option value="-750">Etc/GMT-12:30</option>
            <option value="-12">Etc/GMT-12</option>
            <option value="-690">Etc/GMT-11:30</option>
            <option value="-11">Etc/GMT-11</option>
            <option value="-630">Etc/GMT-10:30</option>
            <option value="-10">Etc/GMT-10</option>
            <option value="-570">Etc/GMT-9:30</option>
            <option value="-9">Etc/GMT-9</option>
            <option value="-510">Etc/GMT-8:30</option>
            <option value="-8">Etc/GMT-8</option>
            <option value="-450">Etc/GMT-7:30</option>
            <option value="-7">Etc/GMT-7</option>
            <option value="-390">Etc/GMT-6:30</option>
            <option value="-6">Etc/GMT-6</option>
            <option value="-330">Etc/GMT-5:30</option>
            <option value="-5">Etc/GMT-5</option>
            <option value="-270">Etc/GMT-4:30</option>
            <option value="-4"  selected="">Etc/GMT-4</option>
            <option value="-210">Etc/GMT-3:30</option>
            <option value="-3">Etc/GMT-3</option>
            <option value="-150">Etc/GMT-2:30</option>
            <option value="-2">Etc/GMT-2</option>
            <option value="-90">Etc/GMT-1:30</option>
            <option value="-1">Etc/GMT-1</option>
            <option value="-30">Etc/GMT-0:30</option>
            <option value="0">Etc/GMT</option>
            <option value="30">Etc/GMT+0:30</option>
            <option value="1">Etc/GMT+1</option>
            <option value="90">Etc/GMT+1:30</option>
            <option value="2">Etc/GMT+2</option>
            <option value="150">Etc/GMT+2:30</option>
            <option value="3">Etc/GMT+3</option>
            <option value="210">Etc/GMT+3:30</option>
            <option value="4">Etc/GMT+4</option>
            <option value="270">Etc/GMT+4:30</option>
            <option value="5">Etc/GMT+5</option>
            <option value="330">Etc/GMT+5:30</option>
            <option value="6">Etc/GMT+6</option>
            <option value="390">Etc/GMT+6:30</option>
            <option value="7">Etc/GMT+7</option>
            <option value="450">Etc/GMT+7:30</option>
            <option value="8">Etc/GMT+8</option>
            <option value="510">Etc/GMT+8:30</option>
            <option value="9">Etc/GMT+9</option>
            <option value="570">Etc/GMT+9:30</option>
            <option value="10">Etc/GMT+10</option>
            <option value="630">Etc/GMT+10:30</option>
            <option value="11">Etc/GMT+11</option>
            <option value="690">Etc/GMT+11:30</option>
            <option value="12">Etc/GMT+12</option>
            <option value="750">Etc/GMT+12:30</option>
            <option value="13">Etc/GMT+13</option>
            <option value="810">Etc/GMT+13:30</option>
        </select>
    </div>

    <div class="col-lg-2">
    </div>
</div>


<div class="row">
    <div class="col-lg-2">
    </div>

    <div class="col-lg-4">
        {{Form::label('is_attendance','Asistencia' )}} <span class="text-danger">(*)</span>
        <select name="is_attendance" id="is_attendance" class="form-control text-center {{ $errors->has('is_attendance') ? ' error' : '' }}">
            <option value="0">No</option>
            <option value="1" selected="">Si</option>
        </select>
    </div>

    <div class="col-lg-4">

    </div>

    <div class="col-lg-2">
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
    </div>
        
    <div class="col-lg-4">
        {{Form::label('nombre','Intervalo De Solicitud (segundos)' )}} <span class="text-danger">(*)</span>
        <input id="heartbeat" type="number" class="form-control {{ $errors->has('heartbeat') ? ' error' : '' }}" name="heartbeat" value="{{ old('heartbeat',$response['heartbeat']) }}">
        @if ($errors->has('heartbeat'))
        <span class="text-danger">
        {{ $errors->first('heartbeat') }}
        </span>
        @endif
    </div>

    <div class="col-lg-4">
        {{Form::label('tipo_transferencia','Tipo de Transferencia' )}} <span class="text-danger">(*)</span>
        <select name="tipo_transferencia" id="tipo_transferencia" class="form-control text-center {{ $errors->has('tipo_transferencia') ? ' error' : '' }}">
            <option value="0">Sincronizar</option>
            <option value="1" selected="">Tiempo Real</option>
        </select>
    </div>

    <div class="col-lg-2">
    </div>
</div>


<div class="row">
    <div class="col-lg-2">
    </div>
        
    <div class="col-lg-4">
        {{Form::label('transfer_interval','Intervalo de Transferencia (minutos)' )}} <span class="text-danger">(*)</span>
        <input id="transfer_interval" type="number" class="form-control {{ $errors->has('transfer_interval') ? ' error' : '' }}" name="transfer_interval">
        @if ($errors->has('transfer_interval'))
        <span class="text-danger">
        {{ $errors->first('transfer_interval') }}
        </span>
        @endif
    </div>

    <div class="col-lg-4">
        {{Form::label('transfer_time','Hora de transferencia' )}} <span class="text-danger">(*)</span>
        <input id="transfer_time" type="text" class="form-control {{ $errors->has('transfer_time') ? ' error' : '' }}" name="transfer_time" >
        @if ($errors->has('transfer_time'))
        <span class="text-danger">
        {{ $errors->first('transfer_time') }}
        </span>
        @endif
    </div>

    <div class="col-lg-2">
    </div>
</div>



           
<div class="text-center mt-3">
    <button type="submit" class="btn btn-primary">{{$texto}}</button>
    <a href="{{ route('devices.index') }}" class="btn btn-danger">Salir</a>
</div>