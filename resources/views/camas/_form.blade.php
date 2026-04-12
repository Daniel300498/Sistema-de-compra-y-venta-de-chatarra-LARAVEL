<p> Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Si la cama que está creando depende de otra unidad seleccione el que corresponda del listado de <strong> DEPENDE DE:</strong></p>
  <!-- CONTENIDO -->            
  <form action="{{route('camas.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="sala_id" id="sala_id" value="{{ $sala->id}}">
       <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
                  <label for="numero">Numero de cama <span class="text-danger">*</span></label>
                  <input id="numero" type="text" class="form-control {{ $errors->has('numero') ? ' error' : '' }}" name= "numero" value="{{ old('numero', isset($cama) ? $cama->numero : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                  @error('numero')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
          </div>
     <div class="col-lg-6">
            <div class="form-group">
                <label for="estado">Estado <span class="text-danger">*</span></label>
                <select id="estado" name="estado" class="form-control {{ $errors->has('estado') ? ' is-invalid' : '' }}">
                    <option value="">-- Seleccione estado --</option>
                    <option value="OCUPADO" {{ old('estado', $cama->estado ?? '') == 'OCUPADO' ? 'selected' : '' }}>OCUPADO</option>
                    <option value="DESOCUPADO" {{ old('estado', $cama->estado ?? '') == 'DESOCUPADO' ? 'selected' : '' }}>DESOCUPADO</option>
                </select>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
     </div>      
      <div class="row">
          <div class="col-lg-12">
              <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="{{ route('camas.index') }}" class="btn btn-danger">Salir</a>
              </div>
          </div>
      </div>
  </form> 