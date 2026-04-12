
<?php $__env->startSection('titulo','Horarios'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>HORARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Turnos registrados</h5>
           
          </div>
        
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Empresa</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Opciones</th>
                 
                
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $turnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class="text-center"><?php echo e($key+1); ?></td>
                    <td class="text-center">
                      <?php echo e($document->empresa); ?>

                  
                  </td>
                    <td class="text-center">
                        <?php echo e($document->nombre); ?>

                    
                    </td>
                    <td class="text-center">
                      <a href="<?php echo e(route('horarios.edit',$document->id )); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    
                    
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <br><br>
          </div>
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/horarios/registros.blade.php ENDPATH**/ ?>