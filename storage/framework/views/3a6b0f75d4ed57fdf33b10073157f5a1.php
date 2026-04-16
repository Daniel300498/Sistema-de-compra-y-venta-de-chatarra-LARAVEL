<p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>

<h5>I. DATOS PERSONALES</h5>

<?php echo $__env->make('clientes.secciones.datos_personales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="background-color: var(--second); border-color:var(--second);"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('clientes.index')); ?>" class="btn btn-danger" style="background-color: var(--first); border-color:var(--first);">Cancelar</a>
    </div>
</div><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/_form.blade.php ENDPATH**/ ?>