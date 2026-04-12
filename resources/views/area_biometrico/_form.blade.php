<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <input type="hidden" name="id" id="id" value="{{$response['id'] }}">
        <!--CODIGO EMPLEADO-->
        <div class="form-group d-flex">
            <div class="col-md-5">
              {{Form::label('codigo_area','Código De Área')}} <span class="text-danger">(*)</span>
            </div>
            <div class="col-md-7 text-center">
              @if($response['area_code'] != null)
              <input id="area_code" type="text" class="form-control {{ $errors->has('area_code') ? ' error' : '' }}" name="area_code"  value="{{ old('area_name',$response['area_code']) }}"  disabled  required >
              @else
              <input id="area_code" type="text" class="form-control {{ $errors->has('area_code') ? ' error' : '' }}" name="area_code" value=""required >
              @endif
              @if ($errors->has('area_code'))
              <span class="text-danger">
              {{ $errors->first('area_code') }}
              </span>
              @endif
            </div>
        </div>
        <br>

        <div class="form-group d-flex">
            <div class="col-md-5">
              {{Form::label('nombre_area','Nombre de Área' )}} <span class="text-danger">(*)</span>
            </div>
            <div class="col-md-7 text-center">
              <input id="area_name" type="text" class="form-control {{ $errors->has('area_name') ? ' error' : '' }}" name="area_name" value="{{ old('area_name',$response['area_name']) }}" required >
              @if ($errors->has('area_name'))
              <span class="text-danger">
              {{ $errors->first('area_name') }}
              </span>
              @endif
            </div>
        </div>
        <br>

        <div class="form-group d-flex">
            <div class="col-md-5">
              {{Form::label('parent_area','Área Superior' )}} 
            </div>
            <div class="col-md-7 text-center">
              <select name="parent_area" id="parent_area" class="form-control text-center {{ $errors->has('parent_area') ? ' error' : '' }}" >
                  <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                  @foreach ($areas as $area)
                      <option value="{{$area['id']}}" {{ old('parent_area', $response['parent_area'] != null ? $response['parent_area']['id'] : '') == $area['id'] ? 'selected' :'' }}>{{$area['area_name']}}</option>
                  @endforeach
              </select>
            </div>
        </div>
        <br>

        <div class="text-center mt-3">
          <button type="submit" class="btn btn-primary">{{$texto}}</button>
          <a href="{{ route('area_biometrico.index') }}" class="btn btn-danger">Salir</a>
        </div>
    </div>
</div>


    