<p>
    Debe ingresar el nivel jer&aacute;rquico. Al momento de registrar/editar una Jerarqu&iacute;a, debe agregar las &aacute;reas pertenecientes a la misma</p>
    <form action="<?php echo e(route('jerarquias.store')); ?>" method="POST" enctype="multipart/form-data">
    <div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombre','Nivel Jerárquico')); ?> <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre', isset($jerarquia) ? $jerarquia->nombre : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombre')); ?>

        </span>
    <?php endif; ?>
</div>      

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('jerarquias.index')); ?>" class="btn btn-danger">Salir</a>
    </div>
</div>
</form><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/jerarquias/_form.blade.php ENDPATH**/ ?>