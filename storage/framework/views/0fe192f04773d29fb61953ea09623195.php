<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombre','Nombre o Razon Social')); ?> <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre',$cliente->nombre)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombre')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('pais','País')); ?> <span class="text-danger">(*)</span>
    <select id="pais" class="form-control <?php echo e($errors->has('pais') ? ' error' : ''); ?>" name="pais" value="<?php echo e(old('pais',$cliente->pais)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <option value="BOLIVIA">BOLIVIA</option>
            <option value="BRASIL">BRASIL</option>
    </select>
    <?php if($errors->has('pais')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('pais')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nit','NIT / RUC / CI')); ?> <span class="text-danger">(*)</span>
    <input type="number" name="nit" id="nit" class="form-control <?php echo e($errors->has('nit') ? ' error' : ''); ?>" value="<?php echo e(old('nit',$cliente->nit)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('nit')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nit')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2"> 
    <?php echo e(Form::label('telefono','N°Celular' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo e(old('telefono',$cliente->telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('telefono')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('telefono')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-md-4 mt-2">
    <?php echo e(Form::label('email','Correo Electrónico' )); ?> <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$cliente->email)); ?>" >
    <?php if($errors->has('email')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('email')); ?>

        </span>
    <?php endif; ?>
</div>


<div class="col-md-6 mt-2"> 
    <?php echo e(Form::label('direccion','Direccion' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo e(old('direccion',$cliente->direccion)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="javascript: ))">
    <?php if($errors->has('direccion')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('direccion')); ?>

        </span>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/secciones/datos_personales.blade.php ENDPATH**/ ?>