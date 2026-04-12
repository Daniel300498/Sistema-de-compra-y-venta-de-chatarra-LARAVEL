<?php $__env->startSection('titulo','Lactancia'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>REGISTRO LACTANCIA</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Registro Lactancia</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar Nueva Lactancia</h5>
            <p>Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado al cual se quiere asignar una orden de salida y presionar el bot&oacute;n <strong>Buscar Empleado</strong>. Tambi&eacute;n puede obtener el listado de todos los empleados presionando el bot&oacute;n <strong>Buscar Empleado.</strong></p>
            <form action="<?php echo e(route('consulta.lactancia')); ?>" method="post">
                <?php echo csrf_field(); ?>
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
                        <button type="submit" class="btn btn-primary">Buscar Empleado</button>
                    </div>
                </div>
            </form>
        
          </div>
        </div>
      </div>
    </div>
</section>
<?php if($empleados != null): ?>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados</h5>
            <p class="mb-0">Para ingresar un registro de lactancia se presiona el bot&oacute;n <span class="btn btn-warning btn-sm"><i class="bi bi-plus-circle" ></i></span> asociado a cada registro de la tabla.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nro Item</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">&Aacute;rea</th>
                            <th class="text-center">Opci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($e->nro_item); ?></td>
                            <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                            <td class="text-center"><?php echo e($e->ci); ?> <?php if($e->ci_complemento != null): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                            <td><?php echo e($e->cargo); ?> </td>
                            <td><?php echo e($e->area); ?></td>
                            <td class="d-flex justify-content-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.create')): ?>
                                    <button type="button" class="btn btn-warning" onclick="create('<?php echo e($e->uuid); ?>')" title="Registrar documento de lactancia">
                                        <i class="bi bi-plus-circle"></i>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>
    var adminUrl=url_global;

    function create(id){
        $.ajax({
                  method: 'get',
                  url: adminUrl + '/lactancia/verificar/'+id,
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    switch(respuesta) {
                      case 0:
                        Swal.fire({
                                  title: "Advertencia",
                                  text: "Este empleado ya tiene una Lactancia Prenatal En Curso",
                                  icon: "error"
                              });
                        break;
                      case 1:
                        create_page(id);
                        break;
                        // code block
                    }
                  }
              })
    }


  function create_page(id) 
  {
    var ruta=adminUrl+'/lactancia/'+id+'/create';
    window.location.assign(ruta);
  }


</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/empleados.blade.php ENDPATH**/ ?>