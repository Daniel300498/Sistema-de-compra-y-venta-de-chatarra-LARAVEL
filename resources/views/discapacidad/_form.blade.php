
    <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
    <p class="mb-0">Para adjuntar el documento correspondiente debe rellenar todos los campos y presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción solo presione el botón <strong>SALIR</strong></p>
    <p>El valor predeterminado de tipo de asignación de discapacidad se asigno desde el registro del empleado, puede realizar el cambio de esa asignación seleccionando el valor que corresponda del campo de <strong>Empleado con discapacidad o es tutor?</strong></p>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
                <div class="form-group d-flex">
                    <div class="col-md-5">
                        {{Form::label('tutor','Empleado con discapacidad o es tutor?')}} <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-7 text-center">
                        <select name="tutor" id="tutor" class="form-control text-center {{ $errors->has('tutor') ? ' error' : '' }}" >
                            <option value="">-- SELECCIONE --</option>
                            <option value="1" {{ old('tutor',$empleado->discapacidad) =='1' ? 'selected' :'' }}>Discapacitado</option>
                            <option value="2" {{ old('tutor',$empleado->discapacidad) =='2' ? 'selected' :'' }}>Tutor</option>
                        </select>
                        @if ($errors->has('tutor'))
                            <span class="text-danger">
                                {{ $errors->first('tutor') }}
                            </span>
                        @endif
                    </div>
                </div>

                <br>

                <div class="form-group d-flex">
                    <div class="col-md-5">
                        <label for="example-text-input" class="form-control-label">Documento Persona con Discapacidad <span class="text-danger">(*)</span></label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" class="form-control {{ $errors->has('documento') ? ' error' : '' }}" name="documento" id="files" accept="application/pdf">  
                        @if ($errors->has('documento'))
                            <span class="text-danger">
                                {{ $errors->first('documento') }}
                            </span>
                        @endif
                    </div>
                    @if($discapacidad->id!=null)
                        <a href="{{ asset('discapacidad/'.$discapacidad->adjunto) }}" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                    @endif
                </div>
        
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">{{ $texto }}</button>
                @if($tipo==1)
                <a href="{{ route('discapacidades_empleados.index') }}" class="btn btn-danger">Salir</a>
                @else
                <a href="{{ route('discapacidades.index') }}" class="btn btn-danger">Salir</a>
                @endif
            </div>
        </div>
    </div>


    

                    
