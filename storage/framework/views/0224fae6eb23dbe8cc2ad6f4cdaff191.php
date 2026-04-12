<!--CONTENIDO -->
<input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
<input type="hidden" name="numero_dias" id="numero_dias" value="">
<input type="hidden" name="area" id="area" value="<?php echo e($empleado->cargo[0]->pivot['cargos.area_id']); ?>">
<input type="hidden" name="estado_id" id="estado_id" value="<?php echo e($estado->id); ?>">

<p class="mb-0">De acuerdo al tipo de licencia se mostraran diferentes campos para rellenar de información concerniente al tipo seleccionado.</p>
<p class="alert alert-warning alert-dismissible fade show mb-0 pb-0 mt-0 pt-0 " id="textoLimite"></p>
<div class="">
    <div class="col-md-10">
        <!--TIPO DE LICENCIA-->
        <?php if($errors->any()): ?>
            <div class="bg-red-100 text-red-700 p-3">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                <?php echo e(Form::label('tipo_id','Tipo Licencia')); ?> <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            
            <div class="col-md-7 ">
                <select name="tipo_id" class="form-control  <?php echo e($errors->has('tipo_id') ? ' error' : ''); ?>" id="tipo_id" onchange="changeType()" >
                    <option value="">--   SELECCIONE   --</option>
                    <?php $__currentLoopData = $tipoLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($t->descripcion!="VACACION"): ?>
                            <?php if($t->descripcion=="CON GOCE"): ?>
                                <?php if($con_goce==true): ?>
                                <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_id',$licencia->tipo_id) == $t->id ? 'selected' : ''); ?> >
                                    <?php echo e($t->descripcion); ?> 
                                </option>
                                <?php endif; ?>
                            <?php else: ?>
                                <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_id',$licencia->tipo_id) == $t->id ? 'selected' : ''); ?> >
                                    <?php echo e($t->descripcion); ?> 
                                </option>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php if($vacacion == true): ?>
                                <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_id',$licencia->tipo_id) == $t->id ? 'selected' : ''); ?> >
                                    <?php echo e($t->descripcion); ?> 
                                </option>
                            <?php endif; ?>
                        <?php endif; ?>
                      
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('tipo_id')): ?>                                                                                                        
                <span class="text-danger">
                    <?php echo e($errors->first('tipo_id')); ?>

                </span>
                <?php endif; ?>
                
            </div>
        </div>
        <!--Jefe Inmediato-->
        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
                <?php echo e(Form::label('jefe_inmediato','Jefe Inmediato')); ?> <span class="text-danger">(*)</span>&nbsp;&nbsp;
            </div>
            <div class="col-md-7">
                <select name="jefe_inmediato" id="jefe_inmediato" class="form-control  <?php echo e($errors->has('jefe_inmediato') ? ' error' : ''); ?>" >
                    <option value="">--   SELECCIONE   --</option>
                   <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($e->empleado->id); ?>" <?php echo e(old('jefe_inmediato',$licencia->jefe_inmediato) == $e->empleado->id ? 'selected' : ''); ?> ><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?> - <?php echo e($e->cargo->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('jefe_inmediato')): ?>                                                                                                        
                    <span class="text-danger">
                        <?php echo e($errors->first('jefe_inmediato')); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        
        <!--Enfermedad Licencia Especial-->
        <div  name="div_estado_critico" id="div_estado_critico"  style="display: none;">
            <div class="form-group d-flex align-items-center mb-2">
                <div class="col-md-5 text-right">
                    <?php echo e(Form::label('estado_critico','Condición o estado crítico de salud')); ?> <span class="text-danger">(*)</span>&nbsp;&nbsp;
                </div>
                <div class="col-md-7">
                    <select name="estado_critico" id="estado_critico" onchange="changeTypeEspecial();" class="form-control  <?php echo e($errors->has('estado_critico') ? ' error' : ''); ?>">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $enfermedad_licencia_especial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enfermedad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($enfermedad->id); ?>" <?php echo e(old('estado_critico',$licencia->enfermedad_especial) == $enfermedad->id ? 'selected' : ''); ?>><?php echo e($enfermedad->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('estado_critico')): ?>                                                                                                        
                        <span class="text-danger">
                            <?php echo e($errors->first('estado_critico')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>


        <!--Enfermedad Licencia Especial-->
        <div name="div_motivo_asueto" id="div_motivo_asueto"  style="display: none;">
            <div class="form-group d-flex align-items-center mb-2">
                <div class="col-md-5 text-right">
                    <?php echo e(Form::label('motivo_asueto','Motivo asueto')); ?> <span class="text-danger">(*)</span>&nbsp;&nbsp;
                </div>
                <div class="col-md-7">
                    <select name="motivo_asueto" id="motivo_asueto" onchange="changeTypeMotivoAsueto();" class="form-control  <?php echo e($errors->has('motivo_asueto') ? ' error' : ''); ?>">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tipoMotivoAsueto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asueto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($asueto->id); ?>" <?php echo e(old('motivo_asueto',$licencia->tipo_motivo)  == $asueto->id ? 'selected' : ''); ?>><?php echo e($asueto->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('motivo_asueto')): ?>                                                                                                        
                        <span class="text-danger">
                            <?php echo e($errors->first('motivo_asueto')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!--Enfermedad Licencia Especial-->
        <div name="div_motivo_baja" id="div_motivo_baja"  style="display: none;">
            <div class="form-group d-flex align-items-center mb-2">
                <div class="col-md-5 text-right">
                    <?php echo e(Form::label('motivo_baja','Motivo Baja')); ?> <span class="text-danger">(*)</span>&nbsp;&nbsp;
                </div>
                <div class="col-md-7">
                    <select id="tipo_baja_medica" name="tipo_baja_medica" onchange="changeTypeMotivoBaja();" class="form-control  <?php echo e($errors->has('tipo_baja_medica') ? ' error' : ''); ?>" >
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tipo_baja_medica; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_baja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipo_baja->id); ?>" <?php echo e(old('tipo_baja',$licencia->tipo_motivo) == $tipo_baja->id ? 'selected' : ''); ?>><?php echo e($tipo_baja->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('tipo_baja_medica')): ?>                                                                                                        
                        <span class="text-danger">
                            <?php echo e($errors->first('tipo_baja_medica')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        
        <div id="divMotivo" name="divMotivo">
            <div class="form-group d-flex align-items-center mb-2">             
                <div class="col-md-5 text-right">
                    <?php echo e(Form::label('motivo','Motivo')); ?> <span class="text-danger">(*)</span> &nbsp;&nbsp;
                </div>
                <div class="col-md-7">
                    
                    <select id="tratamiento_cancer" name="tratamiento_cancer" onchange="changeTypeTratamientoCancer();" class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_cancer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_cancer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_cancer->id); ?>" <?php echo e(old('tratamiento_cancer',$licencia->tipo_motivo) == $tratamiento_cancer->id ? 'selected' : ''); ?>><?php echo e($tratamiento_cancer->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select id="tratamiento_transplante" name="tratamiento_transplante" onchange="changeTypeTratamientoTransplante();" class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_transplante_otro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_transplante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_transplante->id); ?>" <?php echo e(old('tratamiento_transplante',$licencia->tipo_motivo) == $tratamiento_transplante->id ? 'selected' : ''); ?>><?php echo e($tratamiento_transplante->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select id="tratamiento_insuficiencia" name="tratamiento_insuficiencia" onchange="changeTypeTratamientoInsuficiencia();" class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_insuficiencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_insuficiencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_insuficiencia->id); ?>" <?php echo e(old('tratamiento_insuficiencia',$licencia->tipo_motivo) == $tratamiento_insuficiencia->id ? 'selected' : ''); ?>><?php echo e($tratamiento_insuficiencia->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select id="tratamiento_discapacidad" name="tratamiento_discapacidad" onchange="changeTypeTratamientoDiscapacidad();" class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_discapacidad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_discapacidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_discapacidad->id); ?>" <?php echo e(old('tratamiento_discapacidad',$licencia->tipo_motivo) == $tratamiento_discapacidad->id ? 'selected' : ''); ?>><?php echo e($tratamiento_discapacidad->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select id="tratamiento_accidente_muy_grave" name="tratamiento_accidente_muy_grave" onchange="changeTypeTratamientoAccidenteMuyGrave();"  class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_accidente_muy_grave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_accidente_muy_grave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_accidente_muy_grave->id); ?>" <?php echo e(old('tratamiento_accidente_muy_grave',$licencia->tipo_motivo) == $tratamiento_accidente_muy_grave->id ? 'selected' : ''); ?>><?php echo e($tratamiento_accidente_muy_grave->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select id="tratamiento_accidente_grave" name="tratamiento_accidente_grave" onchange="changeTypeTratamientoAccidenteGrave();" class="form-control " style="display: none; margin-bottom:10px;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tratamiento_licencia_especial_accidente_grave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tratamiento_accidente_grave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tratamiento_accidente_grave->id); ?>" <?php echo e(old('tratamiento_accidente_grave',$licencia->tipo_motivo) == $tratamiento_accidente_grave->id ? 'selected' : ''); ?>><?php echo e($tratamiento_accidente_grave->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
    
                    <select  id="tipo_motivo" name="tipo_motivo" class="form-control "  onchange="changeTypeMotivo(<?php echo e($licencia_rip[0]->dias); ?>);" style="display: none;">
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $tipoMotivo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($licencia_rip[0]->dias < 2 ): ?>
                            <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_motivo',$licencia->tipo_motivo) == $t->id ? 'selected' : ''); ?>><?php echo e($t->descripcion); ?></option>
                            <?php else: ?>
                                <?php if($t->descripcion!="RIP"): ?>
                                    <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_motivo',$licencia->tipo_motivo) == $t->id ? 'selected' : ''); ?>><?php echo e($t->descripcion); ?></option>
                                <?php else: ?>
                                    <?php if($flag_rip == true): ?>
                                        <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_motivo',$licencia->tipo_motivo) == $t->id ? 'selected' : ''); ?>><?php echo e($t->descripcion); ?></option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
    
         
                    
                    <input id="motivo" name="motivo" type="text" class="form-control <?php echo e($errors->has('motivo') ? ' error' : ''); ?>" value="<?php echo e(old('motivo',$licencia->motivo)); ?>" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" >
                    <?php if($errors->has('motivo')): ?>                                                                                                        
                        <span class="text-danger">
                                <?php echo e($errors->first('motivo')); ?>

                            </span>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <!--Fecha Registro-->
        <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
            <?php echo e(Form::label('fecha_registro','Fecha registro' )); ?> <span class="text-danger">(*)</span> &nbsp;&nbsp;
            </div>
            <div class="col-md-7">
                <?php if(Auth::user()->id != 4): ?>
                    <input type="date" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>"  value="<?php echo e(old('fecha_registro',$licencia->fecha_registro)); ?>" >
                <?php else: ?>   
                    <?php if($licencia->fecha_registro==null): ?>
                        <input type="hidden" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>"  value="<?php echo date("Y-m-d");?>" >    
                        <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" disabled >
                    <?php else: ?>
                        <input type="hidden" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>"  value="<?php echo e(old('fecha_registro',$licencia->fecha_registro)); ?>" >    
                        <input type="date" class="form-control" value="<?php echo e($licencia->fecha_registro); ?>" disabled >
                    <?php endif; ?>
                <?php endif; ?>
    
                <?php if($errors->has('fecha_registro')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_registro')); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center text-center mb-0">
    <div class="col-md-8">
        <table class="table table-bordered" id="invoice-details" style="border-color: white; width:100%;" >
            <thead>
                <tr class="">
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Horario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    <?php if($licencia_fechas == null): ?>
                    <tr>
                        <td style="width: 35%"><input required type="date" class="form-control " id="dates[0][dateinicio]" name="dates[0][dateinicio]" onchange="activeDateFinish();" ></td>
                        <td style="width: 35%"><input required type="date" class="form-control " id="dates[0][datefin]" name="dates[0][datefin]" onchange="activeDateFinish();" ></td>
                        <td style="width: 30%">
                            <select id="dates[0][horario]" name="dates[0][horario]" class="form-control "  required>
                                <option value="">--   SELECCIONE   --</option>
                                <?php $__currentLoopData = $horarioLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option id="<?php echo e($horario->id); ?>" value="<?php echo e($horario->id); ?>" ><?php echo e($horario->descripcion); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td style="width: 10%">
                            <button type="button" class="btn btn-primary add-row" onclick="addRow()"  style="display: none" id="foot_buttonAdd" name="foot_buttonAdd"><i class="bi bi-plus-lg"></i></button>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $licencia_fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if($loop->index == 0): ?>
                                <td style="width: 35%"><input type="date" required class="form-control " id="dates[0][dateinicio]" name="dates[0][dateinicio]" onchange="activeDateFinish();" value="<?php echo e(old('fecha_inicio',$fecha->fecha_inicio)); ?>" value="<?php echo e(old('dates[0][dateinicio]')); ?>" ></td>
                                <td style="width: 35%"><input type="date" required class="form-control " id="dates[0][datefin]" name="dates[0][datefin]" onchange="activeDateFinish();" value="<?php echo e(old('fecha_inicio',$fecha->fecha_hasta)); ?>" value="<?php echo e(old('dates[0][datefin]')); ?>"></td>
                                <td style="width: 30%">
                                    <select id="dates[0][horario]" name="dates[0][horario]" class="form-control " required >
                                        <option value="">--   SELECCIONE   --</option>
                                        <?php $__currentLoopData = $horarioLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option id="<?php echo e($horario->id); ?>" value="<?php echo e($horario->id); ?>"  <?php echo e(old("dates[][horario]",$fecha->horario_id) == $horario->id ? 'selected' : ''); ?>><?php echo e($horario->descripcion); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary add-row" onclick="addRow()"  style="display: none" id="foot_buttonAdd" name="foot_buttonAdd"><i class="bi bi-plus-lg"></i></button>
                                </td>
                            <?php else: ?>                                
                                <td style="width: 35%"><input type="date" class="form-control " id="<?php echo e($fecha->id); ?>" name="dates[<?php echo e($fecha->id); ?>][dateinicio]" onchange="changeDate(id);" value="<?php echo e(old('fecha_inicio',$fecha->fecha_inicio)); ?>" ></td>
                                <td style="width: 35%"><input type="date" class="form-control " id="<?php echo e($fecha->id); ?>" name="dates[<?php echo e($fecha->id); ?>][datefin]" onchange="changeDate(id);" value="<?php echo e(old('fecha_inicio',$fecha->fecha_hasta)); ?>" ></td>
                                <td style="width: 30%">
                                    
                                    <select id="dates[<?php echo e($fecha->id); ?>][horario]" name="dates[<?php echo e($fecha->id); ?>][horario]" class="form-control " >
                                        <option value="">--   SELECCIONE   --</option>
                                        <?php $__currentLoopData = $horarioLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option id="<?php echo e($horario->id); ?>" value="<?php echo e($horario->id); ?>" <?php echo e(old("dates[][horario]",$fecha->horario_id) == $horario->id ? 'selected' : ''); ?>><?php echo e($horario->descripcion); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td><button type="button" class="btn btn-danger remove-row" onclick="deleteRow(this)"><i class="bi bi-trash"></i></button></td>
                                <td></td>
                            <?php endif; ?>
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center text-center mt-0">
    <div class="col-md-8">     
        <div class=" mb-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="<?php echo e(route('licencias.index')); ?>" class="btn btn-danger">Salir</a>
        </div>
    </div>
</div>

<script>
    
window.onload = (event) => {

    if(document.getElementById("fecha_registro").value == ""){
        document.getElementById("fecha_registro").value = new Date();
    }

    var sel = document.getElementById("tipo_id");
    var str= sel.options[sel.selectedIndex].text;



    switch (str) {
        case "OTROS":
            var selMotivo = document.getElementById("tipo_motivo");
            var strMotivo= selMotivo.options[selMotivo.selectedIndex].text;
            
            if(strMotivo == "OTROS"){
                $("#tipo_motivo").css('display', 'block');      
                $("#motivo").css('margin-top', '15px'); 
                limit_days = 3;
                document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
            }else{
                $("#motivo").css('display', 'none');
                if(strMotivo == "BAJA MEDICA")
                {
                    $("#tipo_motivo").css('display', 'block');
                    $("#tipo_baja").css('display','block');
                    $("#tipo_baja").css('margin-top', '15px');
                    limit_days = 90;
                    document.getElementById('textoLimite').innerText = "El tiempo de la licencia varia según la recomendación de su doctor"        
            
                }else{
                    $("#tipo_motivo").css('display', 'block');
                    if(strMotivo=="NACIMIENTO" || strMotivo=="CENSO"){
                        limit_days = 2;
                    }else{
                        if (strMotivo == "PATERNIDAD" || strMotivo == "MATRIMONIO"){   
                            limit_days = 3;   
                        }else{   
                            if (strMotivo == "RIP") {   
                                limit_days = 1;
        
                            }else{
                
                                limit_days = 3;  
                            } 
                
                        }           
                        
                        }
                        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
            
                }
            }
            break;
        case "ASUETO":
            $("#div_motivo_asueto").css('display', 'block');
            var selMotivo = document.getElementById("motivo_asueto");
            var strMotivo= selMotivo.options[selMotivo.selectedIndex].text;
            if (strMotivo == "OTROS") {
                $("#divMotivo").css('display', 'block');
                $("#motivo").css('margin-top', '0px'); 
                $("#motivo").css('display', 'block'); 
                limit_days = 1;
                document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 30 dia de Asueto";
            }else{
                if(strMotivo =="FALLECIMIENTO PARIENTES"){
                    limit_days = 3;
                    $("#divMotivo").css('display', 'none');
                    $("#motivo").css('display', 'none'); 
                    document.getElementById("motivo").value = str;
                    document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 3 dias continuos de Asueto";
                }else{
                    if(strMotivo =="CUMPLEAÑOS" || strMotivo =="DIA DEL PADRE / MADRE"){
                        limit_days = 1;
                        $("#divMotivo").css('display', 'none');
                        $("#motivo").css('display', 'none'); 
                        document.getElementById("motivo").value = str;
                        document.getElementById('textoLimite').innerText = "Se pueden tomar hasta medio dia de Asueto";
                    }
                    else{
                        limit_days = 1;
                        $("#divMotivo").css('display', 'none');
                        $("#motivo").css('display', 'none'); 
                        document.getElementById("motivo").value = str;
                        document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 1 dia de Asueto";
                    }
                }
            }
            break;

        case "VACACION":
            $("#foot_buttonAdd").css('display', 'block'); 
            limit_days = 10;
            document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 10 dias continuos o discontinuos de Licencia a Cuenta de Vacacion \n En caso de querer tomar días discontinuos o con diferentes horarios seleccionar el boton '+'"

            break;

            
        case "ESPECIAL":
            $("#div_estado_critico").css('display', 'block');
                    $("#tipo_motivo").css('display', 'none');
                    $("#motivo").css('display', 'none');

                    var selEsp = document.getElementById("estado_critico");
                    var strEsp= selEsp.options[selEsp.selectedIndex].text;
                        if (strEsp == "CANCER INFANTIL O ADOLESCENTE") {
                            
                            $("#tratamiento_cancer").css('display', 'block');
                            var selCancer = document.getElementById("tratamiento_cancer");
                            var strCancer= selCancer.options[selCancer.selectedIndex].text;

                            if (strCancer == "TRATAMIENTO DEL CANCER") {          
                            limit_days = 5;
                            document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
                            }

                        
                        }else{
                            if(strEsp=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE" || 
                            strEsp=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
                            strEsp=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"
                            ){
                                $("#tratamiento_transplante").css('display', 'block');

                                var selEnf = document.getElementById("tratamiento_transplante");
                                var strEnf = selEnf.options[selEnf.selectedIndex].text;

                                if(strEsp=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE")
                                {
                                if (strEnf == "PREVIO A LA INTERVENCION QUIRURGICA") { 
                                    limit_days = 3;
                                }else{
                                    if (strEnf == "DIA DE LA INTERVENCION QUIRURGICA") { 
                                        limit_days = 1;
                                    }else{
                                        if (strEnf == "POSTERIOR A LA INTERVENCION QUIRURGICA") { 
                                            limit_days = 10;
                                        }

                                    }

                                }

                                document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"



                                }else{
                                if(strEsp=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
                                    strEsp=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"){
                                    if (strEnf == "PREVIO A LA INTERVENCION QUIRURGICA") { 
                                        limit_days = 3;
                                    }else{
                                        if (strEnf == "DIA DE LA INTERVENCION QUIRURGICA") {
                                            limit_days = 1;

                                        }else{
                                            if (strEnf == "POSTERIOR A LA INTERVENCION QUIRURGICA") {   
                                                limit_days = 3;
                                            }
                                        }
                                    }
                                    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"

                                }
                                }
                            
                            }else{
                                if (strEsp == "INSUFICIENCIA RENAL CRONICA") {
                                    var selIns = document.getElementById("tratamiento_insuficiencia");
                                    var strIns = selIns.options[selIns.selectedIndex].text;
                                    $("#tratamiento_insuficiencia").css('display', 'block');

                                    if (strIns == "HEMODIALISIS") {           
                                        limit_days = 2;
                                        $("#foot_buttonAdd").css('display', 'none');
                                        //contando los dias segun los limites
                                        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
                                    }else{

                                        if(strIns == "ESTADO TERMINAL DEL NIÑO/A ADOLESCENTE"){
                                            limit_days = 30;
                                            $("#foot_buttonAdd").css('display', 'block'); 
                                            document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos"

                                        }
                                    }

                                }else{
                                    if (strEsp == "DISCAPACIDAD GRAVE Y MUY GRAVE") {
                                        $("#tratamiento_discapacidad").css('display', 'block');
                                        limit_days = 3;
                                        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
                                    }else{
                                        if (strEsp == "ACCIDENTE GRAVE CON RIESGO DE MUERTE O SECUELA FUNCIONAL SEVERA Y PERMANENTE") {
                                            $("#tratamiento_accidente_muy_grave").css('display', 'block');
                                            $("#foot_buttonAdd").css('display', 'block'); 
                                            limit_days = 15;
                                            document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos";

                                        }else{
                                            if (strEsp == "ACCIDENTE GRAVE") {
                                                $("#tratamiento_accidente_grave").css('display', 'block');
                                                var selAccGrav = document.getElementById("tratamiento_accidente_grave");
                                                var strAccGrav= selAccGrav.options[selAccGrav.selectedIndex].text;
                                                if (strAccGrav == "ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE") {           
                                                limit_days = 3;
                                                document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia";
                                                }
                                            }

                                        }

                                    }         

                                }

                            } 

                        }

            break;

        case "BAJA MEDICA":
            $("#div_motivo_baja").css('display', 'block'); 
            $("#divMotivo").css('display', 'none');
            limit_days = 90;
            document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
          
            break;




        default:
            // Código a ejecutar si ninguno de los casos anteriores coincide
    }






};









//cantidad de dias limite para tomar licencia

var limit_days = 3;



//Al cambiar el tipo de licencia

function changeType() {
    /*Cuando cambia se vacia el motivo*/
    document.getElementById("motivo").value = "";
    $("#tipo_baja").css('display', 'none');
    $("#div_estado_critico").css('display', 'none');   

    document.getElementById('tratamiento_cancer').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_transplante').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_insuficiencia').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_discapacidad').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_accidente_muy_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_accidente_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    $("#tratamiento_cancer").css('display', 'none');
    $("#tratamiento_transplante").css('display', 'none');
    $("#tratamiento_insuficiencia").css('display', 'none');
    $("#tratamiento_discapacidad").css('display', 'none');
    $("#tratamiento_accidente_muy_grave").css('display', 'none');
    $("#tratamiento_accidente_grave").css('display', 'none');
    $("#div_motivo_asueto").css('display', 'none');

    /*Cuando cambia se elimina los datos de las fechas*/

    $('#invoice-details tbody tr:not(:first-child)').remove();

    var sel = document.getElementById("tipo_id");
    var str= sel.options[sel.selectedIndex].text;
    $("#motivo").css('margin-top', '0px'); 

    switch (str) {
        case "CON GOCE":
            $("#tipo_motivo").css('display', 'block');
            document.getElementById('tipo_motivo').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
            $("#motivo").css('display', 'none');
            $("#divMotivo").css('display', 'block'); 
            $("#foot_buttonAdd").css('display', 'none');
            limit_days = 3;
            document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
            break;

        case "ESPECIAL":
            document.getElementById('estado_critico').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
            $("#div_estado_critico").css('display', 'block'); 
            $("#divMotivo").css('display', 'none');
            document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
            break;


        case "ASUETO":
            $("#div_motivo_asueto").css('display', 'block');
            $("#divMotivo").css('display', 'none');
            document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
            limit_days = 1;
            break;

        case "VACACION":
            $("#tipo_motivo").css('display', 'none');   
            $("#divMotivo").css('display', 'block'); 
            $("#motivo").css('display', 'block'); 
            $('option:contains("OTROS")').prop('selected', true);
            $("#foot_buttonAdd").css('display', 'block');       
            limit_days = 10;
            document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 10 dias continuos o discontinuos de Licencia a Cuenta de Vacacion \n En caso de querer tomar días discontinuos o con diferentes horarios seleccionar el boton '+'"       
            break;

        case "BAJA MEDICA":
            $("#div_motivo_baja").css('display', 'block'); 
            $("#divMotivo").css('display', 'none');
            limit_days = 90;
            document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
            break;

        default:
            $("#tipo_motivo").css('display', 'none');   
            $("#divMotivo").css('display', 'block'); 
            $("#motivo").css('display', 'block'); 
            $('option:contains("OTROS")').prop('selected', true);
            limit_days = 3;
            document.getElementById('textoLimite').innerText = "En licencias Sin Goce de Haber solo puede tomarse tres dias seguidos"
            $("#foot_buttonAdd").css('display', 'none');                         
                
            // Código a ejecutar si ninguno de los casos anteriores coincide
        }

}







//Cambiando la cantidad de dias limites a tomar

function changeTypeMotivo(dias) {
    $("#motivo").css('margin-top', '0px'); 
    $("#tipo_baja").css('margin-top', '0px'); 
    
    var sel = document.getElementById("tipo_motivo");
    var str= sel.options[sel.selectedIndex].text;
    
    $("#tipo_baja").css('display', 'none');
    
    if (str == "OTROS") {
    $("#motivo").css('display', 'block');
    $("#motivo").css('margin-top', '15px'); 
    document.getElementById("motivo").value = "";
    
    limit_days = 3;
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
    }else{
  
        $("#motivo").css('display', 'none');
      
        if(str=="BAJA MEDICA"){
          $("#tipo_baja").css('display', 'block');     
        
            $("#tipo_baja").css('margin-top', '15px'); 
            //marcando maternidad como primera opcion         
            document.getElementById('tipo_baja').getElementsByTagName('option')['maternidad'].selected = 'selected';      
            str = "MATERNIDAD";     
            limit_days = 90;   
            document.getElementById('textoLimite').innerText = "El tiempo de la licencia varia según la recomendación de su doctor"        
        }else{
            if(str=="NACIMIENTO" || str=="CENSO"){
                limit_days = 2;
            }else{
                if (str == "PATERNIDAD" || str == "MATRIMONIO"){   
                    limit_days = 3;   
                }else{   
                    if (str == "RIP") {   
                        limit_days = 1;
                    }else{
                         limit_days = 3;  
                    } 
                }           
                }
                document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
            }     
            document.getElementById("motivo").value = str;
    }
    
    //contando los dias segun los limites
    
    countDays();
}


//Cambiando la cantidad de dias limites a tomar

function changeTypeMotivoAsueto(dias) {
    var sel = document.getElementById("motivo_asueto");
    var str= sel.options[sel.selectedIndex].text;
    if (str == "OTROS") {
        $("#divMotivo").css('display', 'block');
        $("#motivo").css('margin-top', '0px'); 
        $("#motivo").css('display', 'block'); 
        document.getElementById("motivo").value = "";
        limit_days = 1;
        document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 1 dia de Asueto";
    }else{
        if(str=="FALLECIMIENTO PARIENTES"){
            limit_days = 3;
            $("#divMotivo").css('display', 'none');
            $("#motivo").css('display', 'none'); 
            document.getElementById("motivo").value = str;
            document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 3 dias continuos de Asueto";
        }else{
            if(str=="CUMPLEAÑOS" || str=="DIA DEL PADRE / MADRE"){
                limit_days = 1;
                $("#divMotivo").css('display', 'none');
                $("#motivo").css('display', 'none'); 
                document.getElementById("motivo").value = str;
                document.getElementById('textoLimite').innerText = "Se pueden tomar hasta medio dia de Asueto";
            }
            else{
                limit_days = 1;
                $("#divMotivo").css('display', 'none');
                $("#motivo").css('display', 'none'); 
                document.getElementById("motivo").value = str;
                document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 1 dia de Asueto";
            }
        }
    }
    countDays();
}









//Cambiando segun el estado critico

function changeTypeEspecial() {
    var sel = document.getElementById("estado_critico");
    var str= sel.options[sel.selectedIndex].text;
    document.getElementById('tratamiento_cancer').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_transplante').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_insuficiencia').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_discapacidad').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_accidente_muy_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    document.getElementById('tratamiento_accidente_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';

    $("#tratamiento_cancer").css('display', 'none');
    $("#tratamiento_transplante").css('display', 'none');
    $("#tratamiento_insuficiencia").css('display', 'none');
    $("#tratamiento_discapacidad").css('display', 'none');
    $("#tratamiento_accidente_muy_grave").css('display', 'none');
    $("#tratamiento_accidente_grave").css('display', 'none');

    $("#foot_buttonAdd").css('display', 'none');
    $("#divMotivo").css('display', 'block');
    $("#motivo").css('display', 'none');
    $("#tipo_motivo").css('display', 'none');

    if (str == "CANCER INFANTIL O ADOLESCENTE") {
        $("#tratamiento_cancer").css('display', 'block');
    }else{
        if(str=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE" || 
        str=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
        str=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"
        ){
            $("#tratamiento_transplante").css('display', 'block');
        }else{
            if (str == "INSUFICIENCIA RENAL CRONICA") {
                $("#tratamiento_insuficiencia").css('display', 'block');
            }else{
                if (str == "DISCAPACIDAD GRAVE Y MUY GRAVE") {
                    $("#tratamiento_discapacidad").css('display', 'block');
                }else{
                    if (str == "ACCIDENTE GRAVE CON RIESGO DE MUERTE O SECUELA FUNCIONAL SEVERA Y PERMANENTE") {
                        $("#tratamiento_accidente_muy_grave").css('display', 'block');
                    }else{
                        if (str == "ACCIDENTE GRAVE") {
                            $("#tratamiento_accidente_grave").css('display', 'block');
                        }
                    }
                }         
            }
        } 
    }
}







//Cambiando la cantidad de dias limites a tomar

function changeTypeTratamientoCancer() {

    var sel = document.getElementById("tratamiento_cancer");

    var str= sel.options[sel.selectedIndex].text;

    if (str == "TRATAMIENTO DEL CANCER") {           
    document.getElementById("motivo").value = str;
    limit_days = 5;
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
    }

    //contando los dias segun los limites

    countDays();

}





function changeTypeTratamientoTransplante() {
    var selCrit = document.getElementById("estado_critico");
    var strCrit = selCrit.options[selCrit.selectedIndex].text;
    var sel = document.getElementById("tratamiento_transplante");
    var str = sel.options[sel.selectedIndex].text;

    if(strCrit=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE")
    {
    if (str == "PREVIO A LA INTERVENCION QUIRURGICA") {           
        document.getElementById("motivo").value = str;
        limit_days = 3;
    }else{
        if (str == "DIA DE LA INTERVENCION QUIRURGICA") {           
            document.getElementById("motivo").value = str;
            limit_days = 1;
        }else{
            if (str == "POSTERIOR A LA INTERVENCION QUIRURGICA") {           
                document.getElementById("motivo").value = str;
                limit_days = 10;
            }
        }
    }
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
    }else{
    if(strCrit=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
    strCrit=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"){
        if (str == "PREVIO A LA INTERVENCION QUIRURGICA") {           
            document.getElementById("motivo").value = str;
            limit_days = 3;
        }else{
            if (str == "DIA DE LA INTERVENCION QUIRURGICA") {           
                document.getElementById("motivo").value = str;
                limit_days = 1;

            }else{
                if (str == "POSTERIOR A LA INTERVENCION QUIRURGICA") {           
                    document.getElementById("motivo").value = str;
                    limit_days = 3;
                }
            }
        }
        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
    }
    }
    //contando los dias segun los limites
    countDays();
}





function changeTypeTratamientoInsuficiencia() {
    var sel = document.getElementById("tratamiento_insuficiencia");
    var str= sel.options[sel.selectedIndex].text;
    if (str == "HEMODIALISIS") {           
    document.getElementById("motivo").value = str;
    limit_days = 2;
    $("#foot_buttonAdd").css('display', 'none');
    //contando los dias segun los limites
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"

    countDays();

    }else{
        if (str == "ESTADO TERMINAL DEL NIÑO/A ADOLESCENTE") {           
            document.getElementById("motivo").value = str;
            limit_days = 30;
            $("#foot_buttonAdd").css('display', 'block');
            document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos"
        }  
    }
}







//Cambiando la cantidad de dias limites a tomar

function changeTypeTratamientoDiscapacidad() {
    var sel = document.getElementById("tratamiento_discapacidad");
    var str= sel.options[sel.selectedIndex].text;
        if (str == "ATENCIÓN EN SALUD NIÑO/A ADOLESCENTE") {           
        document.getElementById("motivo").value = str;
        limit_days = 3;
        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
        }
    //contando los dias segun los limites
    countDays();
}





//Cambiando la cantidad de dias limites a tomar

function changeTypeTratamientoAccidenteMuyGrave() {
    var sel = document.getElementById("tratamiento_accidente_muy_grave");
    var str= sel.options[sel.selectedIndex].text;

    if (str == "ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE O SECUELA") {           
    document.getElementById("motivo").value = str;
    limit_days = 15;
    $("#foot_buttonAdd").css('display', 'block');
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos";
    }
}







//Cambiando la cantidad de dias limites a tomar

function changeTypeTratamientoAccidenteGrave() {

    var sel = document.getElementById("tratamiento_accidente_grave");
    var str= sel.options[sel.selectedIndex].text;
    if (str == "ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE") {           
        document.getElementById("motivo").value = str;
        limit_days = 3;
        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia";
    }
    //contando los dias segun los limites
    countDays();
}



//Cambiando la cantidad de dias limites a tomar

function changeTypeMotivoBaja() {
    var sel = document.getElementById("tipo_baja_medica");
    var str= sel.options[sel.selectedIndex].text;   
    document.getElementById("motivo").value = str;
    //contando los dias segun los limites
}





//activando la fecha de inicio, una vez se

function activeDateFinish() {
    if(limit_days == 1){
    if(Date.parse(document.getElementsByName("dates[0][datefin]")[0].value) != Date.parse(document.getElementsByName("dates[0][dateinicio]")[0].value)){
        Swal.fire({
                title: 'Advertencia',
                text: 'No puedes pedir mas de '+limit_days+' dias de licencia!!!',
                type: 'warning',
                confirmButtonText: 'OK'
                });
                document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
                $('#numero_dias').val(0);
    }
    }else{
    countDays();
    }
}



//contando la cantidad de dias entre inicio y fin
function countDays() { 
var sel = document.getElementById("tipo_id");
var str= sel.options[sel.selectedIndex].text;

    if(document.getElementsByName("dates[0][datefin]")[0].value!=''){    
        if(Date.parse(document.getElementsByName("dates[0][datefin]")[0].value) >= Date.parse(document.getElementsByName("dates[0][dateinicio]")[0].value))
        {
            let start = new Date(document.getElementsByName("dates[0][dateinicio]")[0].value);
            let end = new Date(document.getElementsByName("dates[0][datefin]")[0].value);
            // otherwise, the end date is excluded (error?)
            end.setDate(end.getDate() + 1);
            let interval = end.getTime() - start.getTime();
            // total days
            let days = Math.floor(interval / (1000 * 60 * 60 * 24));
            // create an iterable date period (P1D is equivalent to 1 day)
            let period = [];
            let currentDate = new Date(start);
            while (currentDate <= end) {
                period.push(new Date(currentDate));
                currentDate.setDate(currentDate.getDate() + 1);
            }
            // stored as an array, so you can add more than one holiday
            let holidays = feriados;
            for (let dt of period) {
                let curr = dt.toLocaleDateString('en-US', { weekday: 'short' });
                // check if it's Saturday or Sunday
                if (curr === 'Sat' || curr === 'Sun') {
                    days--;
                } else if (holidays.includes(dt.toISOString().slice(0, 10))) {
                    days--;
                }
            }
                if(days>limit_days){
                    Swal.fire({
                    title: 'Advertencia',
                    text: 'No puedes pedir mas de '+limit_days+' dias de licencia!!!',
                    type: 'warning',
                    confirmButtonText: 'OK'
                    });
                    document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
                    $('#numero_dias').val(0);
                } else{
                    $('#numero_dias').val(days);
                }
        }else{
            Swal.fire({
            title: 'Advertencia',
            text: 'La fecha no puede ser menor a la de inicio!!!',
            type: 'warning',
            confirmButtonText: 'OK'
            });
            document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
            $('#numero_dias').val(0);

        }   
    }
}





let rowCount = Math.floor(Math.random() * 10000);
// Función para agregar una nueva fila
function addRow() {
    let row = `
        <tr>
            <td><input type="date" class="form-control " id="${rowCount}" name="dates[${rowCount}][dateinicio]" onchange="changeDate(id);" required></td>
            <td><input type="date" class="form-control " id="${rowCount}" name="dates[${rowCount}][datefin]" onchange="changeDate(id);" required></td>
            <td>
            <select id="dates[${rowCount}][horario]" name="dates[${rowCount}][horario]" class="form-control " required>
                <option value="">--   SELECCIONE   --</option>
                <?php $__currentLoopData = $horarioLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option id="<?php echo e($horario->id); ?>" value="<?php echo e($horario->id); ?>" ><?php echo e($horario->descripcion); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </td>
            <td><button type="button" class="btn btn-danger remove-row" onclick="deleteRow(this)"><i class="bi bi-trash"></i></button></td>
        </tr>
    `;
    $('#invoice-details tbody').append(row);
    rowCount++;
}





function deleteRow(el) {
    $(el).closest('tr').remove();
}





function changeDate(id){
    if(document.getElementsByName(`dates[${id}][datefin]`)[0].value!="" && document.getElementsByName(`dates[${id}][dateinicio]`)[0].value!=""){
        if(Date.parse(document.getElementsByName(`dates[${id}][datefin]`)[0].value) < Date.parse(document.getElementsByName(`dates[${id}][dateinicio]`)[0].value))
        {
            Swal.fire({
            title: 'Advertencia',
            text: 'La fecha no puede ser menor a la de inicio!!!',
            type: 'warning',
            confirmButtonText: 'OK'
            });
            document.getElementsByName(`dates[${id}][datefin]`)[0].value = document.getElementsByName(`dates[${id}][dateinicio]`)[0].value;
        }
    }
}


</script>











<!-- EndCONTENIDO Example --><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/_form.blade.php ENDPATH**/ ?>