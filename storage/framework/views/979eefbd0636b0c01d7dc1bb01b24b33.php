<?php $__env->startSection('titulo','Historial Lactancia Firmas'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>HISTORIAL LACTANCIA</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Registro Lactancia</a></li>
            <li class="breadcrumb-item active">Historial Lactancia Firmas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Historial</h5>
            <?php if($matricula!=null): ?>
            <p> <h5><strong>Matricula Seguro:</strong> <span class="badge bg-secondary "><?php echo e($matricula->codigo); ?></span></h5></p>
            <p>En esta sección se muestra el historial del empleado, se mostrará:
              <ul>
                <li>- <span class="badge bg-secondary">PENDIENTE</span> Cuando aún no se tiene la firma de ese mes</li>
                <li>- <span class="badge bg-danger">NO</span> Cuando el empleado no presento la firma ese mes</li>
                <li>- <span class="badge bg-success">CÓDIGO</span> Se mostrará el código para recoger la lactancia de ese mes.</li>
              </ul>
            </p>
            <?php else: ?>
            <p><span class="badge bg-secondary ">AÚN NO INICIASTE UNA LACTANCIA</span></h5></p>
           
            <?php endif; ?>

            
            
                <div class="">
                    <table class="table table-hover table-bordered table-sm" id="datos">
                      <thead>
                        <tr>
                            <th class="text-center">CI</th>
                            <th class="text-center">F. Inicio Prenatal</th>
                            <th class="text-center">Quinto</th>
                            <th class="text-center">Sexto</th>
                            <th class="text-center">Septimo</th>
                            <th class="text-center">Octavo</th>
                            <th class="text-center">Noveno</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                      <?php if($empleado->lactancia != null): ?>
                        <?php $__currentLoopData = $empleado->lactancia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lactancia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                          <?php if($lactancia->inicio_lactancia == $lactancia_prenatal->id): ?>
                            <tr>
                                <td><?php echo e($empleado->ci); ?> </td>
                                <td class="text-center"><?php echo e($lactancia->fecha_inicio_prenatal); ?> </td>
                                <?php $__currentLoopData = $lactancia->mensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="text-center">
                                <?php switch($mensual->estado):
                                  case ("SI"): ?>
                                    <?php if($mensual->codigo_lactancia != null): ?><h5><span class="badge bg-success"><?php echo e($mensual->codigo_lactancia); ?></span></h5>
                                    <?php else: ?> <h5><span class="badge bg-success">NO CÓDIGO</span></h5> <?php endif; ?>
                                    <?php break; ?>
                                  <?php case ("NO"): ?> <h5><span class="badge bg-danger">NO</span></h5> <?php break; ?>
                                  <?php case ("N/A"): ?> <h5><span class="badge bg-secondary">PENDIENTE</span></h5> <?php break; ?>
                                </td>
                                <?php endswitch; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($lactancia->estado_prenatal == "PENDIENTE"): ?>
                               <td class="text-center"><h5><span class="badge bg-secondary">EN CURSO</span></h5></td>
                                <?php else: ?>
                                  <td class="text-center">
                                    <h5><span class="badge bg-success"><?php echo e($lactancia->estado_prenatal); ?></span></h5>
                                  </td>
                                <?php endif; ?>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </tbody>
                </table>
                <br><br>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/empleado_firmas_index.blade.php ENDPATH**/ ?>