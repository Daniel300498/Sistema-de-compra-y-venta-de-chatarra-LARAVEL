
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
            <?php if($empleado_id != null): ?> 
            <h3 class="card-title">Historial Solicitudes</h3>
                <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Numero de dias</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $__currentLoopData = $empleado->licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></td>
                                <td class="text-center"><?php echo e($licencia->tipo->descripcion); ?> </td>
                                <td class="text-center"><?php echo e($licencia->numero_dias); ?></td>
                                <td class="text-center"><?php echo e($licencia->motivo); ?></td>

                                <?php if($licencia->estado->descripcion == "PENDIENTE"): ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo e($licencia->estado->descripcion); ?></button>
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
                                            <?php if($licencia->estado->descripcion != "ACEPTADO"): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.upload')): ?>
                                            <a href="<?php echo e(route('licencias.ficha',$licencia)); ?>" class="btn btn-success" title="Subir licencia firmada"><i class="bi bi-vector-pen"></i></a>
                                            <?php endif; ?>
                                            <?php endif; ?> 
                                        <?php endif; ?>
                                        
                                        <?php if($licencia->estado->descripcion == "PENDIENTE"): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.edit')): ?>
                                            <a href="<?php echo e(route('licencias.edit',[$empleado, $licencia])); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                        <?php endif; ?>
                                        <?php endif; ?>  


                                        <?php if($licencia->estado->descripcion == "PENDIENTE"): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.destroy')): ?>
                                            <a class="btn btn-warning" title="Eliminar Licencia"><i class="bi bi-trash" onclick="eliminar(<?php echo e($licencia->id); ?>)"></i></a>
                                        <?php endif; ?>
                                        <?php endif; ?>  



                                    </td>              
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                        </tbody>
                </table>


                </div>
            <?php else: ?>
                <br>
                <h2>Esta es la vista del empleado</h2>
                <br>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>


var adminUrl=url_global;
  var btnSave = $('.btnSave');
  var btnUpdate = $('.btnUpdate');
  var csrf = $('input[name="_token"]').val();
  var editar=$('#can_edit').val();
  var editar_jefe=$('#can_edit_jefe').val();
  var editar_rrhh=$('#can_edit_rrhh').val();
  var destroy=$('#can_destroy').val();
  var show=$('#can_show').val();
  var upload=$('#can_upload').val();
  var empleado_id=$('#empleado_id').val();
  $.ajaxSetup({
      headers: {'X-CSRF-Token': csrf}
  });
  
      function eliminar(id){
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la licencias ya no se contara en planilla",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI',
          cancelButtonText:'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  method: 'DELETE',
                  url: adminUrl + '/licencia/'+id+'/destroy',
                  dataType: 'JSON',
                  success: function (){ 
                      Swal.fire({
                          title: "Eliminado!",
                          text: "El registro fue eliminado correctamente.",
                          icon: "success"
                      });
                      getRecords();
                  }
              })
          }
        });
  }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/empleado_index.blade.php ENDPATH**/ ?>