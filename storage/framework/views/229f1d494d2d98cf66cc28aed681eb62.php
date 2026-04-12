<?php $__env->startSection('titulo','Licencias'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Licencias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Licencias</a></li>
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
            <h5 class="card-title">Licencias Registradas</h5>
            <p>Para ver las licencias registradas, ingrese el Carnet de Identidad del empleado o el Estado de licencia y luego presionar el bot&oacute;n <strong>BUSCAR</strong>.</p>
              <div class="row justify-content-center d-flex">
                <div class="col-md-8">
                  <div class="form-group d-flex">
                      <div class="col-md-4">
                        <label for="ci">Carnet de Identidad</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="ci" id="ci" class="form-control text-uppercase ms-1">
                      </div>
                  </div>
                </div>
              </div>
          <br>
            <div class="row justify-content-center d-flex">
              <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                      <label for="estado">Estado Licencia</label>
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
          <br>
       
          </div>
        </div>
      </div>
    </div>
</section>
<section class="section" id="section_search" name="section_search" style="display: none;">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Empleado(s) que coinciden con la b&uacute;squeda</h5>
         <!--CONTENIDO -->
         <p class="mb-0">Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la licencia ingresando un texto asociado a la b&uacute;squeda que requiera.</p>
         <p>Presione sobre el bot&oacute;n <strong>OPCIONES</strong> para aprobar o rechazar la licencia, modificar la licencia, adjuntar licencia firmada y eliminar la licencia, estas opciones dependen del estado de la licencia.</p>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.edit')); ?>" id='can_edit'>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.show')); ?>" id='can_show'>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.upload')); ?>" id='can_upload'>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.destroy')); ?>" id='can_destroy'>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.edit_rrhh')); ?>" id='can_edit_rrhh'>
         <input type="hidden" value="<?php echo e(auth()->user()->can('licencias.edit_jefe')); ?>" id='can_edit_jefe'>

                  <div class="">
                       <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                           <thead>
                               <tr>
                                   <th class="text-center">Nombre Completo</th>
                                   <th class="text-center">C.I.</th>
                                   <th class="text-center">Tipo</th>
                                   <th class="text-center">Nro. d&iacute;as</th>
                                   <th class="text-center">Motivo</th>
                                   <th class="text-center">Estado Jefe</th>
                                   <th class="text-center">Estado RRHH</th>
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
<script src="<?php echo e(asset('assets/js/forms/licenciaIndex.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/index.blade.php ENDPATH**/ ?>