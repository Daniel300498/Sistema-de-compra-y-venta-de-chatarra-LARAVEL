<?php $__env->startSection('titulo','Nuevo Rol'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Roles</a></li>
        <li class="breadcrumb-item active">Nuevo Rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
      <?php echo Form::open(['route'=>'roles.store','class'=>'forms-sample']); ?>

      <?php echo $__env->make('roles._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
      <?php echo Form::close(); ?>

</section>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  $(document).ready(function() {
      $('.marcar-todos').click(function() {
          var grupoId = $(this).data('grupo');
          var checked = $(this).prop('checked');
          $('input[type="checkbox"][data-grupo="' + grupoId + '"]').prop('checked', checked);
      });
  });
</script>
<?php $__env->stopSection(); ?>









<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/roles/create.blade.php ENDPATH**/ ?>