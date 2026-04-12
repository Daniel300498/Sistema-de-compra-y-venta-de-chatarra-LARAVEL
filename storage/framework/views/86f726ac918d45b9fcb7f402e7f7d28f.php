<p>
    Debe ingresar datos de la Sala. Al momento de registrar/editar debe agregar las camas pertenecientes a la misma</p>
    <form action="<?php echo e(route('salas.store')); ?>" method="POST" enctype="multipart/form-data">
    <div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombre','Nombre')); ?> <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre', isset($sala) ? $sala->nombre : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombre')); ?>

        </span>
    <?php endif; ?>
</div>      
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('piso','Piso')); ?> <span class="text-danger">(*)</span>
    <input id="piso" type="text" class="form-control <?php echo e($errors->has('piso') ? ' error' : ''); ?>" name="piso" value="<?php echo e(old('piso', isset($sala) ? $sala->piso : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('piso')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('piso')); ?>

        </span>
    <?php endif; ?>
</div>      
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('tipo','Tipo de Sala')); ?>

    <input id="tipo" type="text" class="form-control <?php echo e($errors->has('tipo') ? ' error' : ''); ?>" name="tipo" value="<?php echo e(old('tipo', isset($sala) ? $sala->tipo : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('tipo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('tipo')); ?>

        </span>
    <?php endif; ?>
</div>      

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('salas.index')); ?>" class="btn btn-danger">Salir</a>
    </div>
</div>
</form><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/salas/_form.blade.php ENDPATH**/ ?>