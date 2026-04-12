<?php $__env->startSection('titulo','Ordenes de Salida'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Ordenes de Salida</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Orden de Salida</a></li>
            <li class="breadcrumb-item active">Ver Registrados</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Ordenes de Salida Registradas</h5>
            <p>Para ver las ordenes de salida registradas puede buscarlas ingresando el carnet de identidad del empleado y luego presionar el bot&oacute;n <strong>BUSCAR</strong>.</p>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.edit')); ?>" id='can_edit'>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.show')); ?>" id='can_show'>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.destroy')); ?>" id='can_delete'>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.edit_jefe')); ?>" id='can_edit_jefe'>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.edit_rrhh')); ?>" id='can_edit_rrhh'>
            <input type="hidden" value="<?php echo e(auth()->user()->can('orden_salida.edit_jefe_rrhh')); ?>" id='can_edit_jefe_rrhh'>
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
                  </div>
                </div>
              </div>
          <br>
          <div class="row justify-content-center d-flex">
              <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                      <label for="estado">Estado Orden</label>
                    </div>
                    <div class="col-md-6">
                      <select id="estado" name="estado" class="form-control text-center" style="display: block;" required>
                        <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                        <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($estado->id); ?>" ><?php echo e($estado->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <div class="col-md-4 justify-content-center d-flex">
                      <button class="btn btn-primary" onclick="getRecords()">Buscar</button>
                    </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</section>
 <section class="section" id="section_search" style="display: none;">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Empleado(s) que coinciden con la b&uacute;squeda</h5>
                <!--CONTENIDO -->
                <p class="mb-0">Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la orden de salida ingresando un texto asociado a la b&uacute;squeda que requiera.</p>
                <p>Presione sobre el bot&oacute;n <strong>OPCIONES</strong> para ver la ficha de orden de salida.</p>
               <div class="">
                       <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                           <thead>
                               <tr>
                                   <th class="text-center">Nombre Completo</th>
                                   <th class="text-center">C.I.</th>
                                   <th class="text-center">Tipo</th>
                                   <th class="text-center">Hora Salida</th>
                                   <th class="text-center">Hora Retorno</th>
                                   <th class="text-center">Fecha Orden</th>
                                   <th class="text-center">Motivo</th>
                                   <th class="text-center">Jefe</th>
                                   <th class="text-center">Control de personal</th>
                                   <th class="text-center">Opciones</th>
                               </tr>
                           </thead>
                           <tbody>
                           </tbody>
                       </table>
                       
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
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/mostrarSugerenciaEmpleado.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/ordenSalida.js')); ?>" type="text/javascript"></script>
<script>

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/orden_salida/index.blade.php ENDPATH**/ ?>