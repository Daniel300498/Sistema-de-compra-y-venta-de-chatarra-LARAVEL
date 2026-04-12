<!--CONTENIDO -->
<input type="hidden" name="empleado_id" id="empleado_id" value="{{$empleado->id}}">
<input type="hidden" name="area" id="area" value="{{$empleado->cargo_actual[0]->pivot['cargos.area_id']}}">

<p class="mb-0">Selecciona el tipo de orden de salida, el horario de salida - retorno y llena el motivo.</p>
<div class="">
    <div class="col-md-10">
        <!--TIPO DE LICENCIA-->
        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                {{Form::label('tipo_id','Tipo Orden Salida')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            <div class="col-md-7 text-center">
                <select name="tipo_id" class="form-control text-center {{ $errors->has('tipo_id') ? ' error' : '' }}" id="tipo_id" onchange="changeTypeSalida()" >
                    <option value="">--   SELECCIONE   --</option>
                    
                    @foreach ($tipoOrdenSalida as $t)
                        <option value="{{$t->id}}" {{ old('tipo_id',$orden_salida->tipo_id) == $t->id ? 'selected' : '' }} >
                            {{$t->descripcion}} 
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('tipo_id'))                                                                                                        
                <span class="text-danger">
                    {{ $errors->first('tipo_id') }}
                </span>
                @endif      
            </div>
        </div>

        <div style="display: none" id="div_tipo_horario" >
        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                {{Form::label('horario','Horario')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            <div class="col-md-7 text-center">
                <select name="horario" class="form-control text-center {{ $errors->has('horario') ? ' error' : '' }}" id="horario" onchange="changeTypeHorario()" >
                    <option id="tipo_nulo" name="tipo_nulo"  value="">--   SELECCIONE   --</option>
                    @foreach ($horario_orden_salida as $h)
                        <option value="{{$h->id}}" {{ old('horario',$orden_salida->horario) == $h->id ? 'selected' : '' }} >
                            {{$h->descripcion}} 
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('horario'))                                                                                                        
                <span class="text-danger">
                    {{ $errors->first('horario') }}
                </span>
                @endif      
            </div>
        </div>
        </div>



        <div style="display: none" id="div_horario" >
            <div class="form-group d-flex align-items-center mb-2"  >
                <div class="col-md-5 text-right">
                    {{Form::label('horario_salida','Horario Salida')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                </div>
                <div class="col-md-7 text-center" >
                    <input
                            id="horario_salida"
                            type="time"
                            list="times"
                            name="horario_salida"
                            step="900"
                            value=@if($orden_salida->hora_salida!=null){{ old('horario_salida',$orden_salida->hora_salida) }}@else {{"08:30"}} @endif
    
                            class="form-control text-center"
                             />
    
                    @if ($errors->has('horario_salida'))                                                                                                        
                    <span class="text-danger">
                        {{ $errors->first('horario_salida') }}
                    </span>
                    @endif             
                </div>
            </div>
    
            <div class="form-group d-flex align-items-center mb-2">
                <div class="col-md-5 text-right">
                    {{Form::label('horario_retorno','Horario Retorno')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
                </div>
                <div class="col-md-7 text-center">
                    <input
                    id="horario_retorno"
                    type="time"
                    list="times"
                    name="horario_retorno"
                    step="900"
                    
                    value=@if($orden_salida->hora_retorno!=null){{ old('horario_retorno',$orden_salida->hora_retorno) }}@else {{"08:30"}} @endif
    
                    class="form-control text-center"
                     />
                    @if ($errors->has('horario_retorno'))                                                                                                        
                    <span class="text-danger">
                        {{ $errors->first('horario_retorno') }}
                    </span>
                    @endif
                    
                </div>
            </div> 
    
            <datalist id="times">
                <option value="08:30:00">
                <option value="08:45:00">
                <option value="09:00:00">
                <option value="09:15:00">
                <option value="09:30:00">
                <option value="09:45:00">
                <option value="10:00:00">
                <option value="10:15:00">
                <option value="10:30:00">
                <option value="10:45:00">
                <option value="11:00:00">
                <option value="11:15:00">
                <option value="11:30:00">
                <option value="11:45:00">
                <option value="12:00:00">            
                <option value="12:15:00">
                <option value="12:30:00">
                <option value="14:30:00">
                <option value="14:45:00">
                <option value="15:00:00">
                <option value="15:15:00">
                <option value="15:30:00">
                <option value="15:45:00">
                <option value="16:00:00">
                <option value="16:15:00">
                <option value="16:30:00">
                <option value="16:45:00">
                <option value="17:00:00">
                <option value="17:15:00">
                <option value="17:30:00">
                <option value="17:45:00">
                <option value="18:00:00">
                <option value="18:15:00">
                <option value="18:30:00">
    
    
            </datalist>
        </div>
       

        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                {{Form::label('motivo','Motivo')}} <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            <div class="col-md-7 text-center">
                <input id="motivo" name="motivo" style="text-align: center" type="text" class="form-control {{ $errors->has('motivo') ? ' error' : '' }}" value="{{ old('motivo',$orden_salida->motivo) }}" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" >
                @if ($errors->has('motivo'))                                                                                                        
                    <span class="text-danger">
                            {{ $errors->first('motivo') }}
                        </span>
                    @endif
                
            </div>
        </div>


         <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                {{ Form::label('fecha_orden_salida', 'Fecha Orden') }} <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            <div class="col-md-7 text-center">
                <?php 
                    $maxDate = date('Y-m-d', strtotime('+14 days')); 
                ?>
                <input type="date" name="fecha_orden_salida" id="fecha_orden_salida"  
                     @if(auth()->user()->rol[0]->id!=8)
                        min="<?php echo date('Y-m-d'); ?>" 
                    @endif
                    max="<?php echo $maxDate; ?>" 
                    class="form-control text-center {{ $errors->has('fecha_orden_salida') ? ' error' : '' }}" 
                    value="{{ old('fecha_orden_salida', $orden_salida->fecha_orden_salida) }}">
                @if ($errors->has('fecha_orden_salida'))
                    <span class="text-danger">
                        {{ $errors->first('fecha_orden_salida') }}
                    </span>
                @endif
            </div>
        </div>



    </div>
</div>
<div class="d-flex justify-content-center mt-0">
    <div class="col-md-8">     
        <div class="text-center mb-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
             @if(auth()->user()->rol[0]->id == 4)
                <a href="{{ route('orden_salida_empleado.index') }}" class="btn btn-danger">Salir</a>
            @else
                <a href="{{ route('orden_salida.index') }}" class="btn btn-danger">Salir</a>
            @endif
        </div>
    </div>
</div>



<script>
  
    /*------------------------------------Create - Update Script --------------------------------- */
    window.onload = (event) => {
      var sel_tipo = document.getElementById("tipo_id");
      var str_tipo= sel_tipo.options[sel_tipo.selectedIndex].text;
      if(str_tipo=="SALIDA OFICIAL"){
          $("#div_tipo_horario").css('display', 'block');  
      }else{
          $("#div_horario").css('display', 'block');
          $("#div_tipo_horario").css('display', 'none'); 
      }
    
      var sel_horario = document.getElementById("horario");
      var str_horario= sel_horario.options[sel_horario.selectedIndex].text;
      if(str_horario=="OTROS"){
          $("#div_horario").css('display', 'block');
      }else{
          $("#div_horario").css('display', 'none'); 
          
      }
    
    
    };
    
    function changeTypeSalida(){
      var sel = document.getElementById("tipo_id");
      var str= sel.options[sel.selectedIndex].text;
      if(str=="SALIDA OFICIAL"){
          document.getElementById('horario').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
          $("#div_tipo_horario").css('display', 'block');
          $("#div_horario").css('display', 'none');
          document.getElementById('horario_salida').value = '';
          document.getElementById('horario_retorno').value = '';  
      }else{
          $('option:contains("OTROS")').prop('selected', true);
          $("#div_horario").css('display', 'block');
          $("#div_tipo_horario").css('display', 'none'); 
          document.getElementById('horario_salida').value = '';
          document.getElementById('horario_retorno').value = '';  
      }
    }
    function changeTypeHorario(){
      var sel = document.getElementById("horario");
      var str= sel.options[sel.selectedIndex].text;
      if(str=="OTROS"){
          $("#div_horario").css('display', 'block');
          document.getElementById('horario_salida').value = '';
          document.getElementById('horario_retorno').value = '';
      }else{
          $("#div_horario").css('display', 'none'); 
          if(str=="DIA COMPLETO"){
              document.getElementById('horario_salida').value = '08:30';
              document.getElementById('horario_retorno').value = '18:30';
          }else{
              if(str=="MEDIO DIA (TARDE)"){
              document.getElementById('horario_salida').value = '14:30';
              document.getElementById('horario_retorno').value = '18:30';
              }else{
                  document.getElementById('horario_salida').value = '08:30';
                  document.getElementById('horario_retorno').value = '12:30';   
              }
          }
      }
    }
    </script>