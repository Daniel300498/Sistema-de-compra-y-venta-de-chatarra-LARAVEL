<?php $__env->startSection('titulo','Nuevo Cliente'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Nuevo Cliente</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('clientes.index')); ?>">Clientes</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
</div>
<?php echo $__env->make('clientes.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/contactosVarios.js')); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    resetModalCliente();
    let modal = new bootstrap.Modal(document.getElementById('modalCliente'));
    modal.show();
    document.getElementById('modalCliente').addEventListener('hidden.bs.modal', function () {
        window.location.href = "<?php echo e(route('clientes.index')); ?>";
    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/create.blade.php ENDPATH**/ ?>