
<?php $__env->startSection('titulo','Licencias'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Licencias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Licencias</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Solicitud de Licencias</h5>



            <form action="<?php echo e(route('buscar_empleado_licencia')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="row justify-content-center d-flex">
                <div class="col-md-8">
                  <div class="form-group d-flex">
                      <div class="col-md-4">
                        <label for="nombre">Carnet de Identidad</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="ci" id="ci" class="form-control  text-uppercase ms-1">
                        
                      </div>
                      <div class="col-md-4 justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                      </div>
                  </div>
                </div>
              </div>
          </form>

          <br>

          <form action="<?php echo e(route('buscar_empleado_fecha')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="row justify-content-center d-flex">
              <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                      <label for="nombre">Buscar por mes</label>
                    </div>
                    <div class="col-md-3">
                      <select name="mes" class="form-control text-center" id="mes">
                        <option value="1" selected>Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select name="anio" class="form-control text-center" id="anio">
                        <option value="2024" selected>2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                      </select>
                    </div>
                    <div class="col-md-4 justify-content-center d-flex">
                      <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
              </div>
            </div>
        </form>
        <br>



          <?php if($empleados != null): ?>

          <h6>Empleado(s) que coinciden con la busqueda</h6>
                <div class="table-responsive">
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre Completo</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Fecha Inicio</th>
                                    <th class="text-center">Fecha Fin</th>
                                    <th class="text-center">Motivo</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="userDetails">
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $e->licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?> </td>
                                    <td class="text-center">
                                    
                                      <?php echo e($licencia->tipo->descripcion); ?> 
                                    
                                    </td>
                                    <td class="text-center"><?php echo e(date('d-m-y', strtotime($licencia->fecha_inicio))); ?></td>
                                    <td class="text-center"><?php echo e(date('d-m-y', strtotime($licencia->fecha_fin))); ?></td>
                                    <td class="text-center"><?php echo e($licencia->motivo); ?></td>
                                    

                                    <?php if($licencia->estado->descripcion == "PENDIENTE"): ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#estadoModal_<?php echo e($licencia->id); ?>"><?php echo e($licencia->estado->descripcion); ?></button>                                                                   
                                            <div class="modal" tabindex="-1" id="estadoModal_<?php echo e($licencia->id); ?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h3>Acepta o Rechaza la Solicitud de Licencia</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.update')): ?>
                                                        <form id="the-form" action="<?php echo e(route('licencias.update',$licencia->id)); ?>" method="POST">
                                                            <?php echo method_field('PUT'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="estado" id="estado" value="aceptado">
                                                            <button type="submit" id="the-submit" class="btn btn-primary">Aceptar</button>
                                                        </form>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.update')): ?>
                                                        <form id="the-form" action="<?php echo e(route('licencias.update',$licencia->id)); ?>" method="POST">
                                                            <?php echo method_field('PUT'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="estado" id="estado" value="denegado">
                                                            <button type="submit" id="the-submit" class="btn btn-warning">Denegar</button>
                                                        </form>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.destroy')): ?>
                                                        <?php echo Form::open(['route'=>['licencias.destroy',$licencia->id],'method'=>'DELETE']); ?>

                                                            <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar al empleado?');">Eliminar</button>
                                                        <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </td>
                                    <?php else: ?>
                                        <?php if($licencia->estado->descripcion == "DENEGADO"): ?>
                                            <td class="text-center">
                                            <button type="button" class="btn btn-danger"><?php echo e($licencia->estado->descripcion); ?></button>
                                            </td>
                                        <?php else: ?>
                                            <td class="text-center">
                                            <button type="button" class="btn btn-success"><?php echo e($licencia->estado->descripcion); ?></button>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
        
                                    
                                    <td class="d-flex justify-content-center" >
                                        <?php if($licencia->estado->descripcion != "DENEGADO"): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.show')): ?>
                                            <a href="<?php echo e(route('licencias.show',$licencia->id)); ?>" class="btn btn-info" title="Ver ficha" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($licencia->estado->descripcion == "ACEPTADO"): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.upload')): ?>
                                            <a href="<?php echo e(route('licencias.ficha',$licencia)); ?>" class="btn btn-success" title="Subir licencia firmada"><i class="bi bi-vector-pen"></i></a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($licencia->estado->descripcion == "PENDIENTE"): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.edit')): ?>
                                            <a href="<?php echo e(route('licencias.edit',[$e, $licencia])); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                        <?php endif; ?>
                                        <?php endif; ?>  

                                    </td>

                                    
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                </div>

          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/mostrarSugerenciaEmpleado.js')); ?>" type="text/javascript"></script>
<script>


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/licencias/index.blade.php ENDPATH**/ ?>