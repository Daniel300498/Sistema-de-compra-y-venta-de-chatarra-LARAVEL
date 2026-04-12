
<?php $__env->startSection('titulo','Vacaciones Solicitadas'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Vacaciones Solicitadas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Vacaciones Solicitadas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados Con Solicitud De Vacacion</h5>
            
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Fecha Solicitada</th>
                            <th class="text-center">Fecha Desde</th>
                            <th class="text-center">Fecha Hasta</th>
                            <th class="text-center">Nro. Dias Solicitados</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $d2=\App\Models\Empleado::where('id',$e->empleado_id)->first();
                        ?>
                            <tr>
                                <td><?php echo e($d2->nombres); ?> <?php echo e($d2->ap_paterno); ?> <?php echo e($d2->ap_materno); ?> </td>
                                <td class="text-center"><?php echo e($e->fecha_solicitud); ?></td>
                                <td class="text-center"><strong><?php echo e($e->fecha_inicio); ?></strong></td>
                                <td class="text-center"><strong><?php echo e($e->fecha_hasta); ?></strong></td>
                                <td class="text-center"><strong><?php echo e($e->nro_dias_solicitados); ?></strong></td>
                                <td class="text-center"><strong><?php echo e($e->estado); ?></strong></td>
                                <td class="d-flex justify-content-center" >
                                    
                                    <?php if($e->estado == "pendiente"): ?>
                                    <a href="<?php echo e(route('vacacion.edit',$e->id)); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('vacacion.solicitud_vacacion',$e->id)); ?>" class="btn btn-info" title="Ver solicitud vacacion" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    <?php if(auth()->user()->rol[0]->id !=4 && $e->estado == "pendiente"): ?>
                                  
                                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rechazos-<?php echo e($e->id); ?>" title="Rechazar Vacacion">
                                    <i class="bi bi-trash"></i>
                                  </button>
                                  <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="rechazos-<?php echo e($e->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Rechazar Vacacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('vacacion.rechazo')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="vacacion_id" id="vacacion_id" value="<?php echo e($e->id); ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="fecha_aprobacion" class="col-control-label">Observacion</label>
                        <input type="text" class="form-control" name="observacion" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Rechazado Por</label>
                        <select name="empleado_id" id="empleado_id" class="form-control <?php echo e($errors->has('empleado_id') ? ' error' : ''); ?>">
                            <option value="">-- SELECCIONE --</option>
                            <?php $__currentLoopData = $todosEmpleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $templeado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($templeado->id); ?>" <?php echo e(old('empleado_id',$templeado->id) == $templeado->id ? 'selected' : ''); ?>><?php echo e($templeado->nombres); ?> <?php echo e($templeado->ap_paterno); ?> <?php echo e($templeado->ap_materno); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn back-color-second">Guardar</button>
                    <button type="button" class="btn back-color-first" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/vacaciones/vacaciones_solicitadas.blade.php ENDPATH**/ ?>