      <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
      {{ csrf_field()}}

      <div class="col-md-10">
          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Certificado Medico <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
                <input type="file" name="documento" id="" class="form-control"  accept="application/pdf">
                  @if ($errors->has('documento'))
                    <span class="text-danger">
                      {{ $errors->first('documento') }}
                    </span>
                  @endif
             
            </div>
            @if($enfermedadTerminal->id!=null)
              <a href="{{ asset('enfermedades/'.$enfermedadTerminal->documento) }}" class="btn btn-info" title="Ver documento" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
            @endif
          </div>

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Descripci&oacute;n <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input id="descripcion" type="text" class="form-control text-center {{ $errors->has('descripcion') ? ' error' : '' }}" value="{{ old('descripcion',$enfermedadTerminal->descripcion)}}" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                    @if ($errors->has('descripcion'))
                        <span class="text-danger">
                            {{ $errors->first('descripcion') }}
                        </span>
                    @endif
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Nombre Medico <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
                <input id="nombre_medico" type="text" class="form-control text-center {{ $errors->has('nombre_medico') ? ' error' : '' }}" value="{{ old('nombre_medico',$enfermedadTerminal->nombre_medico)}}" name="nombre_medico"  onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                      @if ($errors->has('nombre_medico'))
                          <span class="text-danger">
                              {{ $errors->first('nombre_medico') }}
                          </span>
                      @endif
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Instituci&oacute;n <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input id="institucion" type="text" class="form-control text-center {{ $errors->has('institucion') ? ' error' : '' }}" name="institucion" value="{{ old('institucion',$enfermedadTerminal->institucion)}}" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                      @if ($errors->has('institucion'))
                          <span class="text-danger">
                              {{ $errors->first('institucion') }}
                          </span>
                      @endif
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Fecha <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input type="date" name="fecha_inicio_enfermedad" id="fecha_inicio_enfermedad" value="{{ old('fecha_inicio_enfermedad',$enfermedadTerminal->fecha_inicio_enfermedad)}}" class="form-control text-center {{ $errors->has('fecha_inicio_enfermedad') ? ' error' : '' }}">
                  @if ($errors->has('fecha_inicio_enfermedad'))
                      <span class="text-danger">
                          {{ $errors->first('fecha_inicio_enfermedad') }}
                      </span>
                  @endif
            </div>
          </div>
      </div>
                    
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('enfermedades.index') }}" class="btn btn-danger">Salir</a>
      </div>

             
 
