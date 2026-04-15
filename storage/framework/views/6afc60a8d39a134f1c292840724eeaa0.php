<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda ver y administrar la información que corresponda</p>

      
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombre','Nombre')); ?> <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre',$proveedor->nombre)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombre')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('nit','NIT / CI ' )); ?> <span class="text-danger">(*)</span>
    <input type="text" class="form-control <?php echo e($errors->has('nit') ? ' error' : ''); ?>" name="nit" id="nit" value="<?php echo e(old('nit',$proveedor->nit)); ?>"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nit')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nit')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-6 mt-2">
    <?php echo e(Form::label('direccion','Direccion')); ?> <span class="text-danger">(*)</span>
    <input type="text" name="direccion" id="direccion" class="form-control <?php echo e($errors->has('direccion') ? ' error' : ''); ?>" value="<?php echo e(old('direccion',$proveedor->direccion)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('direccion')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('direccion')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-md-4 mt-2">
    <?php echo e(Form::label('email','Correo Electrónico' )); ?> <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$proveedor->email)); ?>" >
    <?php if($errors->has('email')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('email')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('telefono','Telefono' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo e(old('telefono',$proveedor->telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('telefono')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('telefono')); ?>

        </span>
    <?php endif; ?>
</div>

<div class ="col-md-6 mt-2">
    <?php echo e(Form::label('tipo_producto','Tipo de Producto' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="tipo_producto" id="tipo_producto" class="form-control <?php echo e($errors->has('tipo_producto') ? ' error' : ''); ?>" value="<?php echo e(old('tipo_producto',$proveedor->tipo_producto)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('tipo_producto')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('tipo_producto')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-12 mt-2">
    <?php echo e(Form::label('pais','Pais' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="pais" id="pais" class="form-control <?php echo e($errors->has('pais') ? ' error' : ''); ?>" value="<?php echo e(old('pais',$proveedor->pais)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('pais')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('pais')); ?>

        </span>
    <?php endif; ?>

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="background-color: var(--second); border-color:var(--second);"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-danger" style="background-color: var(--first); border-color:var(--first);">Cancelar</a>
    </div>
</div><?php /**PATH C:\laragon\www\chatarra\resources\views/proveedores/_form.blade.php ENDPATH**/ ?>