<?php $__env->startSection('titulo','Lactancia Firmas'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>REGISTRO LACTANCIA</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Registro Lactancia</a></li>
            <li class="breadcrumb-item active">Ver Firmas Prenatal</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->

 <section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ver Firmas Prenatal</h5>
          <p>Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado del cual se quiere ver sus firmas de la lactancia prenatal y presionar el bot&oacute;n <strong>Buscar Empleado</strong>. Tambi&eacute;n puede obtener el listado de todos los empleados presionando el bot&oacute;n <strong>Buscar Empleado</strong></p>
              
              <div class="row">
                  <label for="nombre" class="col-md-4 col-control label text-right">Nombre Empleado</label>
                  <div class="col-lg-8">
                      <input type="text" name="nombre" id="nombre" class="form-control">
                  </div>
              </div>
              <div class="row mt-3">
                  <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                  <div class="col-lg-8">
                      <input type="text" name="ci" id="ci" class="form-control">
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-lg-12 text-center">
                      <button class="btn btn-primary" onclick="getRecords()">Buscar Empleado</button>
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
            <h5 class="card-title">Empleados Registrados con lactancia</h5>

          <input type="hidden" value="<?php echo e(auth()->user()->can('lactancias.edit')); ?>" id='can_edit'>
          <input type="hidden" value="<?php echo e(auth()->user()->can('lactancias.show')); ?>" id='can_show'>
            <p>Desde esta secci&oacute;n usando el bot&oacute;n <button class="badge bg-secondary">PENDIENTE</button> se puede actualizar las firmas de la lactancia prenatal desde el quinto mes y usando el bot&oacute;n <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span> se puede subir el documento que tiene las firmas como comprobante.
                
                <div class="">
                    <table class="table table-hover table-bordered table-sm" id="datos">
                      <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">C.I.</th>
                            <th class="text-center">F. Inicio Prenatal</th>
                            <th class="text-center">Quinto</th>
                            <th class="text-center">Sexto</th>
                            <th class="text-center">S&eacute;ptimo</th>
                            <th class="text-center">Octavo</th>
                            <th class="text-center">Noveno</th>
                            <th class="text-center">&Oacute;pcion</th>
                        </tr>
                    </thead>
                    <tbody>
                      
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
<script src="<?php echo e(asset('assets/js/forms/lactanciaFirmas.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/indexFirmas.blade.php ENDPATH**/ ?>