<?php $__env->startSection('titulo','Comision'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Mis Comisiones</li>
      </ol>
    </nav>

</div><!-- End Page Title -->
<?php if(count($comisiones)>0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title">Mis Comisiones Asignadas</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-sm table-responsive">
          <tr>
            <th class="text-center">Desde</th>
            <th class="text-center">Hasta</th>
            <th class="text-center">Tipo Jornada</th>
            <th class="text-center">Tipo Comision</th>
            <th class="text-center"></th>
          </tr>
          <?php $__currentLoopData = $comisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="text-center"><?php echo e(date('d/m/Y',strtotime($document->fecha_inicio))); ?></td>
              <td class="text-center"><?php echo e(date('d/m/Y',strtotime($document->fecha_fin))); ?></td>
              <?php
              switch ($document->tipo_jornada) {
                      case "1":
                      $tipo="Jornada Laboral";
                      break;
                      case "2":
                      $tipo="Jornada No Laboral";
                      break;
              }
              ?>
              <td><center><?php echo e($tipo); ?></center></td>
              <?php
              switch ($document->tipo_comision) {
                      case "1":
                      $tipo1="Misma Cede";
                      break;
                      case "2":
                      $tipo1="Distinta Cede";
                      break;
                      case "3":
                      $tipo1="Exterior";
                      break;
              }
              ?>
              <td class="text-center"><?php echo e($tipo1); ?></td>
              <td class="d-flex align-items-center justify-content-center">
                <a href="<?php echo e(route('comisiones.show',$document->id)); ?>" class="btn btn-warning" title="Ver ficha" target="_blank">Ver ficha de comision</a>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php else: ?>
          <h1 class="text-center">NO TIENE COMISIONES ASIGNADAS</h1>
        <?php endif; ?>

        </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/comisiones/mis_comisiones.blade.php ENDPATH**/ ?>