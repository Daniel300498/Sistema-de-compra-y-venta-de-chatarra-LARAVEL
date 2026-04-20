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


   
<div class="col-md-4 mt-2">
    <?php echo e(Form::label('email','Correo Electrónico' )); ?> <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$cliente->email)); ?>" >
    <?php if($errors->has('email')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('email')); ?>

        </span>
    <?php endif; ?>
</div>

<div id="telefonos-container">
    <div class="row mb-2 telefono-item">
        <div class="col-md-10">
            <input type="number" name="telefonos[]" class="form-control" placeholder="Teléfono 1">
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-success" onclick="addTelefono()">
                +
            </button>
        </div>
    </div>
</div>


<div id="direcciones-container">
    <div class="row mb-2 direccion-item">
        <div class="col-md-10">
            <input type="text" name="direcciones[]" class="form-control" placeholder="Dirección 1">
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-success" onclick="addDireccion()">
                +
            </button>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('assets/js/forms/contactosVarios.js')); ?>" type="text/javascript"></script>
<?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/secciones/datos_personales.blade.php ENDPATH**/ ?>