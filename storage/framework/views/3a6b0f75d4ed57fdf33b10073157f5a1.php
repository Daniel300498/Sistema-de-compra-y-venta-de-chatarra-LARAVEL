<p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>

<div class="col-lg-6 mt-2">
    <?php echo e(Form::label('nombre','Nombre o Razon Social')); ?> <span class="text-danger">(*)</span>
    <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre',$cliente->nombre)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombre')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-6 mt-2">
    <?php echo e(Form::label('pais','País')); ?> <span class="text-danger">(*)</span>
    <select id="pais" class="form-control <?php echo e($errors->has('pais') ? ' error' : ''); ?>" name="pais" value="<?php echo e(old('pais',$cliente->pais)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <option value="">Seleccione un país</option>
        <?php $__currentLoopData = $paises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pais): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($pais->descripcion); ?>" <?php echo e(old('pais',$cliente->pais) == $pais->descripcion ? 'selected' : ''); ?>>
                <?php echo e($pais->descripcion); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('pais')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('pais')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nit','NIT / CI ' )); ?> <span class="text-danger">(*)</span>
    <input type="text" class="form-control <?php echo e($errors->has('nit') ? ' error' : ''); ?>" name="nit" id="nit" value="<?php echo e(old('nit',$cliente->nit)); ?>"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nit')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nit')); ?>

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
    <label>Telefono</label>
<div id="telefonos-container">
    <div class="row mb-2 telefono-item">
        <div class="col-md-10">
            <input type="number" name="telefonos[]" class="form-control" placeholder="Teléfono 1">
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-success" onclick="addTelefono()">+</button>
        </div>
    </div>
</div>
</div>

<div class="col-md-6 mt-2">
    <label>Dirección</label>
    <div id="direcciones-container">
        <div class="row mb-2 direccion-item">
            <div class="col-md-10">
                <input type="text" name="direcciones[]" class="form-control" placeholder="Dirección 1">
            </div>      
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-success" onclick="addDireccion()">+</button>
            </div>

        </div>
    </div>
</div>

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="background-color: var(--second); border-color:var(--second);"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('clientes.index')); ?>" class="btn btn-danger" style="background-color: var(--first); border-color:var(--first);">Cancelar</a>
    </div>
</div>

<script src="<?php echo e(asset('assets/js/forms/contactosVarios.js')); ?>" type="text/javascript"></script><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/_form.blade.php ENDPATH**/ ?>