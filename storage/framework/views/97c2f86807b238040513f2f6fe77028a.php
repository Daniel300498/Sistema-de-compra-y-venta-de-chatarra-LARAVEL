<?php $__env->startSection('titulo','Vacaciones Pendientes'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Vacaciones Pendientes</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Vacaciones</a></li>
            <li class="breadcrumb-item active">Ver Vacaciones Pendientes</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados Con Vacaciones Pendientes</h5>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">C.I.</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?> </td>
                                <td class="text-center"><?php echo e($e->empleado->ci); ?> <?php if($e->empleado->ci_complemento != null): ?> - <?php echo e($e->empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                                <td class="text-center"><strong><?php echo e($e->empleado->cargo[0]->pivot['cargos.nombre']); ?></strong></td>
                                <td class="text-center"><strong><h5><span class="badge bg-secondary"><?php echo e($e->estado); ?></span></h5></strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendientes-<?php echo e($e->id); ?>" title="Agregar Instituci&oacute;n">
                                        Aprobar
                                      </button>
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
<div class="modal fade" id="pendientes-<?php echo e($e->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Aprobar Vacaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('vacacion.aprobada')); ?>" method="POST" onclick="validar()">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="vacacion_id" id="vacacion_id" value="<?php echo e($e->id); ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="fecha_aprobacion" class="col-control-label">Fecha Aprobaci&oacute;n </label>
                        <input type="date" class="form-control" id="fechaReserva" name="fecha_aprobacion" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Aprobado Por</label>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/vacaciones_pendientes.blade.php ENDPATH**/ ?>