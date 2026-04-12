
<?php $__env->startSection('titulo','Cargo de Empleados'); ?>
<?php $__env->startSection('content'); ?>


<div class="pagetitle">
    <h1>Cargo de Empleados</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('cargoEmpleados.buscar_cargo_empleado')); ?>">Cargo de Empleados</a></li>
            <li class="breadcrumb-item"><a href="#">Cargo de Empleados Activos</a></li>
            <li class="breadcrumb-item active">Agregar Interino</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Agregar al Empleado a un Cargo como interino</h5>
                        <h3><span class="badge bg-nombre-empleado">EMPLEADO: <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>  
                    </div> 
                    <?php if($cargoempleados->where('tipo_alta', 'INTERINO')->isEmpty()): ?> 
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. 
                    <form action="<?php echo e(route('cargoEmpleados.store_interino', $empleado->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>"> 
                        <div class="mb-3">
                                 <?php echo e(Form::label('cargo', 'Cargo')); ?> <span class="text-danger">(*)</span>
                                <select name="cargo" id="cargo" class="form-control <?php echo e($errors->has('cargo') ? ' error' : ''); ?>">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cargo->id); ?>" 
                                            <?php echo e(old('cargo') == $cargo->id ? 'selected' : ''); ?>> 
                                            <?php echo e($cargo->nombre); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('cargo')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('cargo')); ?></span>
                                <?php endif; ?>
                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_ini" class="form-label">Fecha de Inicio</label><span class="text-danger">(*)</span>
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini">
                                    <?php if($errors->has('fecha_ini')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('fecha_ini')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="memorandum" class="form-label">Adjuntar Memorandum</label><span class="text-danger">(*)</span>
                                    <input type="file" class="form-control" id="memorandum" name="memorandum">
                                    <?php if($errors->has('memorandum')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('memorandum')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Agregar Interino</button>
                            <a href="<?php echo e(route('cargoEmpleados.buscar_cargo_empleado')); ?>" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cargos Registrados</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar unicamente el cargo de interinato.</p>
           <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
               <thead>
                   <tr>
                        <th class="text-center">ITEM</th>
                       <th class="text-center">Cargo</th>
                       <th class="text-center">Fecha Inicio</th>
                       <th class="text-center">Tipo Alta</th>
                       <th class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $__currentLoopData = $cargoempleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                   <td class="text-center"><small><?php echo e($a->cargo->nro_item); ?></small></td>
                    <td class="text-center"><small><?php echo e($a->cargo->nombre); ?></small></td>
                   <td class="text-center"><small><?php echo e(date('d/m/Y', strtotime($a->fecha_inicio))); ?></small></td>
                   <td class="text-center"><small><?php echo e($a->tipo_alta); ?></small></td>
                 
                   <td class="d-flex justify-content-center" >
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                        </button>
                        <ul class="dropdown-menu">
                        <?php if($a->tipo_alta ==="INTERINO"): ?>
                        <li><a class="dropdown-item" href="<?php echo e(asset('memorandums/' . $a->archivo_memorandum)); ?>" target="_blank">Ver Memorándum</a></li>     
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.destroy')): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('cargoEmpleados.destroy',$a->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el Cargo de interino?');">Eliminar Cargo Interino</a></li>
                            <?php endif; ?>
                        <?php endif; ?>    
                    </ul>
                      </div>
                   </td>
                 
                   </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
           </table>
           <!-- EndCONTENIDO Example -->
        </div>
    </div>
</div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>$("#depende_id").select2({placeholder: '--SELECCIONE--',width: 'resolve' }).on('select2-open', function () {$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();});</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/interino.blade.php ENDPATH**/ ?>