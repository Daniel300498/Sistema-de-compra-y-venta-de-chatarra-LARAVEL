<p>
    Debe ingresar datos de la Sala. Al momento de registrar/editar debe agregar las camas pertenecientes a la misma</p>
    <form action="{{route('salas.store')}}" method="POST" enctype="multipart/form-data">
    <div class="col-lg-4 mt-2">
    {{Form::label('nombre','Nombre')}} <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' error' : '' }}" name="nombre" value="{{ old('nombre', isset($sala) ? $sala->nombre : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombre'))
        <span class="text-danger">
            {{ $errors->first('nombre') }}
        </span>
    @endif
</div>      
<div class="col-lg-4 mt-2">
    {{Form::label('piso','Piso')}} <span class="text-danger">(*)</span>
    <input id="piso" type="text" class="form-control {{ $errors->has('piso') ? ' error' : '' }}" name="piso" value="{{ old('piso', isset($sala) ? $sala->piso : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('piso'))
        <span class="text-danger">
            {{ $errors->first('piso') }}
        </span>
    @endif
</div>      
<div class="col-lg-4 mt-2">
    {{Form::label('tipo','Tipo de Sala')}}
    <input id="tipo" type="text" class="form-control {{ $errors->has('tipo') ? ' error' : '' }}" name="tipo" value="{{ old('tipo', isset($sala) ? $sala->tipo : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('tipo'))
        <span class="text-danger">
            {{ $errors->first('tipo') }}
        </span>
    @endif
</div>      

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ $texto }}</button>
        <a href="{{ route('salas.index') }}" class="btn btn-danger">Salir</a>
    </div>
</div>
</form>