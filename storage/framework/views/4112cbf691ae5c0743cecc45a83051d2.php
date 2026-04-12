<p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes, presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>

<!-- CONTENIDO -->
<form action="<?php echo e(route('contratos.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
    
    <div class="row mb-4">
        <div class="col-lg-4">
            <label for="documento" class="form-control-label">Contrato</label><span class="text-danger">(*)</span>
            <div class="d-flex align-items-center">
                <input type="file" name="documento" class="form-control text-center me-3 <?php echo e($errors->has('documento') ? 'error' : ''); ?>" accept="application/pdf">
                <?php if($contratos->documento): ?>
                    <a href="<?php echo e(asset('contratos/' . $contratos->documento)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                <?php endif; ?>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contratos.edit')): ?>
            <?php if($errors->has('documento')): ?>
                <span class="text-danger"><?php echo e($errors->first('documento')); ?></span>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <?php echo e(Form::label('fecha_ini', 'Fecha de Inicio')); ?> <span class="text-danger">(*)</span>
            <input type="date" name="fecha_ini" id="fecha_ini" class="form-control text-center <?php echo e($errors->has('fecha_ini') ? 'error' : ''); ?>" value="<?php echo e(old('fecha_ini', isset($contratos) ? $contratos->fecha_ini : '')); ?>">
            <?php if($errors->has('fecha_ini')): ?>
                <span class="text-danger"><?php echo e($errors->first('fecha_ini')); ?></span>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <?php echo e(Form::label('fecha_fin', 'Fecha de Fin')); ?>

            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control text-center <?php echo e($errors->has('fecha_fin') ? 'error' : ''); ?>" value="<?php echo e(old('fecha_fin', isset($contratos) ? $contratos->fecha_fin : '')); ?>">
            <?php if($errors->has('fecha_fin')): ?>
                <span class="text-danger"><?php echo e($errors->first('fecha_fin')); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4">
            <?php echo e(Form::label('nro_contrato', 'Nro de Contrato')); ?>

            <input type="text" name="nro_contrato" id="nro_contrato" class="form-control text-center <?php echo e($errors->has('nro_contrato') ? 'error' : ''); ?>" value="<?php echo e(old('nro_contrato', isset($contratos) ? $contratos->nro_contrato : '')); ?>">
            <?php if($errors->has('nro_contrato')): ?>
                <span class="text-danger"><?php echo e($errors->first('nro_contrato')); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?php echo e(route('contratos.index')); ?>" class="btn btn-danger">Salir</a>
    </div>
</form>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/contratos/_form.blade.php ENDPATH**/ ?>