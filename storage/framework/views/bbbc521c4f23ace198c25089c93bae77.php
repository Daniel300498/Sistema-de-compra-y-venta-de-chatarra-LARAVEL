
<?php $__env->startSection('titulo','Vacaciones Solicitadas'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Vacaciones Solicitadas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
             <li class="breadcrumb-item"><a href="">Vacaciones</a></li>
            <li class="breadcrumb-item active">Historial Vacaciones Solicitadas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <?php if(auth()->user()->rol[0]->id==4): ?>
            <h5 class="card-title">Mi Historial De Vacaciones</h5>
                
            <?php else: ?>
            <h5 class="card-title">Empleados Registrados Con Solicitud De Vacaci&oacute;n</h5>
                
            <?php endif; ?>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Fecha Solicitada</th>
                            <th class="text-center">Fecha Desde</th>
                            <th class="text-center">Fecha Hasta</th>
                            <th class="text-center">Nro. D&iacute;as Solicitados</th>
                            <th class="text-center">Fecha Aprobaci&oacute;n</th>
                            <th class="text-center">Aprobado por</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                            <tr>
                                <td><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?> </td>
                                <td class="text-center"><?php echo e(date('d/m/Y', strtotime($e->fecha_solicitud))); ?></td>
                                <td class="text-center"><strong><?php echo e(date('d/m/Y', strtotime($e->fecha_inicio))); ?></strong></td>
                                <td class="text-center"><strong><?php echo e(date('d/m/Y', strtotime($e->fecha_hasta))); ?></strong></td>
                                <td class="text-center"><strong><?php echo e($e->nro_dias_solicitados); ?></strong></td>
                                <?php if($e->fecha_aprobacion==null): ?>
                                <td class="text-center"><strong>
                                    <?php if($e->estado='pendiente'): ?>
                                    <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                    <?php endif; ?>
                                </td> 
                                    
                                <?php else: ?>
                                <td class="text-center"><strong><?php echo e(date('d/m/Y', strtotime($e->fecha_aprobacion))); ?></strong></td>
                                <?php endif; ?>
                               
                                <?php if($e->id_empleado_aprobacion==null): ?>
                                <td class="text-center">
                                    <?php if($e->estado='pendiente'): ?>
                                        <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                    <?php endif; ?>
                                </td>
                                <?php else: ?>
                                <td class="text-center"><strong><?php echo e($e->empleado_aprobacion->nombres); ?> <?php echo e($e->empleado_aprobacion->ap_paterno); ?> <?php echo e($e->empleado_aprobacion->ap_materno); ?></strong></td>
                                    
                                <?php endif; ?>
                               
                                <td class="text-center">
                                <?php switch($e->estado):
                                    case ('pendiente'): ?>
                                        <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                        <?php break; ?>

                                    <?php case ('aprobado'): ?>
                                        <h5><span class="badge bg-success">APROBADO</span></h5>
                                        <?php break; ?>

                                    <?php case ('rechazado'): ?>
                                        <h5><span class="badge bg-danger">DENEGADO</span></h5>
                                        <?php break; ?>

                                <?php endswitch; ?>
                                    
                               </td>


                                <td class="d-flex justify-content-center" >
                                    
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacacion.edit')): ?>
                                            <?php if($e->estado == "pendiente"): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('vacacion.edit',$e->uuid)); ?>">Modificar Datos</a></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->rol[0]->id !=4 && $e->estado == "pendiente"): ?>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#rechazos-<?php echo e($e->id); ?>">Rechazar Solicitud</a></li>
                                        <?php endif; ?>
                                        <?php if($e->estado=='aprobado'): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('vacacion.show',$e->empleado_id)); ?>"   target="_blank">Reporte de vacaci&oacute;n</a></li>
                                            <li><a class="dropdown-item" href="<?php echo e(route('vacacion.solicitud_vacacion',$e->uuid)); ?>" target="_blank">Ver Documento de Solicitud</a></li>
                                      <?php endif; ?>
                                    </ul>
                                  </div>
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
                <h5 class="modal-title">Rechazar Vacaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('vacacion.rechazo')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="vacacion_id" id="vacacion_id" value="<?php echo e($e->id); ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="fecha_aprobacion" class="col-control-label">Observaci&oacute;n</label>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/vacaciones_solicitadas.blade.php ENDPATH**/ ?>