<?php if($mod): ?> <p>ALGUNOS CAMPOS DE LA SECCIÓN INSTITUCIONAL NO PUEDEN EDITARSE DIRECTAMENTE, DEBE ADJUNTAR MEMORANDUM DE TRANSFERENCIA, PROMOCIÓN, ETC DESDE 
<strong>CARGO DE EMPLEADOS</strong> EN EL MENÚ.</p> <?php endif; ?>
<?php if(!$mod): ?> <p>El <strong>Número de contrato</strong> se habilita únicamente para los funcionarios cuyo <strong> Tipo de Puesto </strong>  NO ES ITEM</p> <?php endif; ?>

<div class="col-lg-2 mt-1">
    <?php echo e(Form::label('tipo_cargo','Tipo de Puesto' )); ?> <span class="text-danger">(*)</span>
    <select <?php if($mod): ?> disabled <?php endif; ?>  name="tipo_cargo" id="tipo_cargo" class="form-control <?php echo e($errors->has('tipo_cargo') ? ' error' : ''); ?>" data-old="<?php echo e(old('tipo_cargo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.tipo_cargo'] : '')); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $tipos_cargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tc->descripcion); ?>" <?php echo e(old('tipo_cargo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.tipo_cargo'] : '') == $tc->descripcion ? 'selected' : ''); ?>><?php echo e($tc->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($mod): ?>
        <input type="hidden" name="tipo_cargo" value="<?php echo e(old('tipo_cargo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.tipo_cargo'] : '')); ?>">
    <?php endif; ?>
    <?php if($errors->has('tipo_cargo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('tipo_cargo')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-10 mt-1">
    <?php echo e(Form::label('area','Área' )); ?> <span class="text-danger">(*)</span>
    <select <?php if($mod): ?> disabled <?php endif; ?>  name="area" id="area_id" class="form-control <?php echo e($errors->has('area') ? ' error' : ''); ?>" data-old="<?php echo e(old('area',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.area_id'] : '')); ?>" data-ruta="<?php echo e(route('obtener_cargos')); ?>" >
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($a->id); ?>" <?php echo e(old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.area_id'] : '') == $a->id ? 'selected' : ''); ?>><?php echo e($a->nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($mod): ?>
    <input type="hidden" name="area" value="<?php echo e(old('area',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.area_id'] : '')); ?>">
    <?php endif; ?>
    <?php if($errors->has('area')): ?>  
        <span class="text-danger">
            <?php echo e($errors->first('area')); ?>    
        </span>
    <?php endif; ?>
</div>

<div class="col-lg-12 mt-2">
    <?php echo e(Form::label('cargo_id','(Denominación Cargo)--> Cargo Funcional' )); ?> <span class="text-danger">(*)</span>
    <div class="d-flex">
        <select <?php if($mod): ?> disabled <?php endif; ?> name="cargo_id" id="cargo_id" class="form-control <?php echo e($errors->has('cargo_id') ? ' error' : ''); ?>" data-old="<?php echo e(old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->id : '')); ?>"></select>
        <?php if(!$mod): ?><button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#nuevoCargo" title="Agregar Cargo">
            <i class="bi bi-plus-lg"></i> 
        </button><?php endif; ?>
    </div>
    <?php if($mod): ?>
    <input type="hidden" name="cargo_id" value="<?php echo e(old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->id : '')); ?>">
    <?php endif; ?>
    <?php if($errors->has('cargo_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('cargo_id')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('nro_contrato','Número de contrato')); ?> 
    <input type="text" name="nro_contrato" id="nro_contrato" class="form-control <?php echo e($errors->has('nro_contrato') ? ' error' : ''); ?>" value="<?php echo e(old('nro_contrato',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->nro_contrato : '')); ?>">
    <?php if($errors->has('nro_contrato')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nro_contrato')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-9 mt-2">
    <?php echo e(Form::label('requisito_minimo','Requisito mínimo del cargo' )); ?>

    <div class="d-flex">
        <input <?php if($mod): ?> readonly <?php endif; ?>  type="text" name="requisito_minimo" id="requisito_minimo" class="form-control <?php echo e($errors->has('requisito_minimo') ? ' error' : ''); ?>" value="<?php echo e(old('requisito_minimo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.requisito_minimo'] : '')); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    </div>
</div>

<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('fecha_ingreso','Fecha de Ingreso' )); ?> <span class="text-danger">(*)</span>
    <input <?php if($mod): ?> readonly <?php endif; ?>  type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control <?php echo e($errors->has('fecha_ingreso') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_ingreso',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_inicio : '')); ?>">
    <?php if($errors->has('fecha_ingreso')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('fecha_ingreso')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('fecha_conclusion','Fecha de Conclusión' )); ?> 
    <input <?php if($mod): ?> readonly <?php endif; ?> type="date" name="fecha_conclusion" id="fecha_conclusion" class="form-control <?php echo e($errors->has('fecha_conclusion') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_conclusion',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_conclusion : '')); ?>">
    <?php if($errors->has('fecha_conclusion')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('fecha_conclusion')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('nit','Nro de NIT' )); ?> 
    <input type="text" name="nit" id="nit" class="form-control <?php echo e($errors->has('nit') ? ' error' : ''); ?>" value="<?php echo e(old('nit',$empleado->nit)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nit')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nit')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('nro_cuenta','Número de Cuenta' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="nro_cuenta" id="nro_cuenta" class="form-control <?php echo e($errors->has('nro_cuenta') ? ' error' : ''); ?>" value="<?php echo e(old('nro_cuenta',$empleado->nro_cuenta)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nro_cuenta')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nro_cuenta')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('banco_id','Banco' )); ?> <span class="text-danger">(*)</span>
    <select name="banco_id" id="banco_id" class="form-control <?php echo e($errors->has('banco_id') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($d->id); ?>" <?php echo e(old('banco_id',$empleado->banco_id) == $d->id ? 'selected' : ''); ?>><?php echo e($d->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('banco_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('banco_id')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('afp_id','Seguro Largo Plazo AFP' )); ?> <span class="text-danger">(*)</span>
    <select name="afp_id" id="afp_id" class="form-control <?php echo e($errors->has('afp_id') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $afps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($a->id); ?>" <?php echo e(old('afp_id',$empleado->afp_id) == $a->id ? 'selected' : ''); ?>><?php echo e($a->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('afp_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('afp_id')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('nro_cua','Número CUA' )); ?> 
    <input type="text" name="nro_cua" id="nro_cua" class="form-control <?php echo e($errors->has('nro_cua') ? ' error' : ''); ?>" value="<?php echo e(old('nro_cua',$empleado->nro_cua)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nro_cua')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nro_cua')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('seguro_salud_id','Seguro de Salud' )); ?>

    <select disabled name="seguro_salud_id" id="seguro_salud_id" class="form-control <?php echo e($errors->has('seguro_salud_id') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $seguros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($e->id); ?>" <?php echo e(old('seguro_salud_id',$empleado->seguro_salud_id) == $e->id ? 'selected' : ''); ?>><?php echo e($e->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('seguro_salud_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('seguro_salud_id')); ?>

        </span>
    <?php endif; ?>
</div>

<hr class="mb-1">
<div class="row mt-3" id="div_discapacidad" style="display: none;">
    <div class="col-sm-10 d-flex align-items-center justify-content-left">
        <label for="" class="col-control-label">Empleado con discapacidad o tutor?</label> &nbsp;&nbsp;
        <div class="form-check">
          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="1" <?php echo e(old('discapacidad',$empleado->discapacidad) ==1 ? 'checked' : ''); ?>>
          <label class="form-check-label" for="gridRadios1">
            Con Discapacidad
          </label>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="form-check">
            <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="2" <?php echo e(old('discapacidad',$empleado->discapacidad) ==2 ? 'checked' : ''); ?>>
            <label class="form-check-label" for="gridRadios1">
              Tutor
            </label>
          </div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="form-check">
          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios2" value="0" <?php echo e(old('discapacidad',$empleado->discapacidad) ==0 ? 'checked' : ''); ?>>
          <label class="form-check-label" for="gridRadios2">
            Ninguno
          </label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <label for="lugar_trabajo_id" class="col-lg-4">Lugar de trabajo del Empleado</label>
    <div class="col-lg-6">
        <select <?php if($mod): ?> readonly <?php endif; ?>  name="lugar_trabajo_id" id="lugar_trabajo_id" class="form-control <?php echo e($errors->has('lugar_trabajo_id') ? ' error' : ''); ?>">
            <option value="">-- SELECCIONE --</option>
            <?php $__currentLoopData = $lugares_trabajo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lugar->id); ?>" <?php echo e(old('lugar_trabajo_id',$empleado->lugar_trabajo_id) == $lugar->id ? 'selected' : ''); ?>><?php echo e($lugar->descripcion); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('lugar_trabajo_id')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('lugar_trabajo_id')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>
<hr class="mb-1">
<div class="row mt-2">
    <div class="col-lg-4">
        <?php echo e(Form::label('fecha_registro','Fecha de Registro' )); ?> <span class="text-danger">(*)</span>
        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_registro',$empleado->fecha_registro)); ?>" >
        <?php if($errors->has('fecha_registro')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('fecha_registro')); ?>

            </span>
        <?php endif; ?>
    </div>
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/secciones/institucional.blade.php ENDPATH**/ ?>