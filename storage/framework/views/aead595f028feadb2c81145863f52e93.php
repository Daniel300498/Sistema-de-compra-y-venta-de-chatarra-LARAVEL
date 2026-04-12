<?php $__env->startSection('titulo','Orden Salida'); ?>
<?php $__env->startSection('content'); ?>


<div class="pagetitle">
    <h1>Historial Orden Salida</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Orden de Salida</a></li>
            <li class="breadcrumb-item active">Historial Orden de Salida</li>
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
            <h3 class="card-title">Historial Ordenes de Salida</h3>
            <p>En esta secci√≥n puedes ver tus ordenes de salida registradas, podr&aacute;s ver y descargar tu orden de salida una vez la haya aceptado tu jefe.</p>
            
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Hora Salida</th>
                            <th class="text-center">Hora Retorno</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Jefe</th>
                            <th class="text-center">Control de personal</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="userDetails">
                      <?php if($empleado->orden_salida != null): ?>
                        <?php $__currentLoopData = $empleado->orden_salida; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orden_salida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></td>
                            <td><?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_lugar); ?></td>
                            <td class="text-center">
                              <?php echo e($orden_salida->tipo->descripcion); ?> 
                            </td>
                            <td class="text-center"><?php echo e($orden_salida->hora_salida); ?></td>
                            <td class="text-center"><?php echo e($orden_salida->hora_retorno); ?></td>
                            <td class="text-center"><?php echo e($orden_salida->motivo); ?></td>
                            <td class="text-center"><?php echo e(date('d/m/Y', strtotime($orden_salida->fecha_orden_salida))); ?> </td>
                            <td class="text-center">
                              <?php switch($orden_salida->jefe_estado->descripcion):
                                  case ('PENDIENTE'): ?>
                                      <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                      <?php break; ?>
                                  <?php case ('ACEPTADO'): ?>
                                      <h5><span class="badge bg-success">ACEPTADO</span></h5>
                                      <?php break; ?>
                                  <?php case ('ANULADO'): ?>
                                      <h5><span class="badge bg-danger">ANULADO</span></h5>
                                      <?php break; ?>
                              <?php endswitch; ?>
                            </td>
                            <td class="text-center">
                              <?php switch($orden_salida->rrhh_estado->descripcion):
                                  case ('PENDIENTE'): ?>
                                      <h5><span class="badge bg-secondary">PENDIENTE</span></h5>
                                      <?php break; ?>
                                  <?php case ('ACEPTADO'): ?>
                                      <h5><span class="badge bg-success">ACEPTADO</span></h5>
                                      <?php break; ?>
                                  <?php case ('ANULADO'): ?>
                                      <h5><span class="badge bg-danger">ANULADO</span></h5>
                                      <?php break; ?>
                              <?php endswitch; ?>
                            </td>
                            <td class="text-center" >
                              <div class="btn-group" role="group">
                               
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Opciones
                                </button>
                                
                                 <ul class="dropdown-menu">
                                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.show')): ?>
                                     
                                    <?php if($orden_salida->jefe_estado->descripcion != "ANULADO"): ?>
                                      <li><a class="dropdown-item" href="<?php echo e(route('orden_salida.show',$orden_salida->uuid)); ?>" target="_blank">Ver Solicitud</a></li>
                                    <?php endif; ?>
                                  <?php endif; ?>

                                   
                                    
                                    
                                    <?php if($orden_salida->jefe_estado->descripcion == "PENDIENTE"): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.destroy')): ?>
                                    <li>
                                        <a class="dropdown-item btnDelete" href="javascript:void(0);" onclick="eliminar(<?php echo e($orden_salida->id); ?>)" data-id="<?php echo e($orden_salida->id); ?>">
                                            Eliminar Orden de Salida
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                 
                                 </ul>
                                 
                                 
                              </div>
                            </td>
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      <?php else: ?>
                       <div class="text-center">No se tienen registros</div>
                      <?php endif; ?>
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
  var csrf = $('input[name="_token"]').val();


$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});
  function eliminar(id){
    console.log(id);
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la orden de salida no se contar®¢ en la planilla mensual",
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
                  url: adminUrl + '/orden_salida/'+id+'/destroy',
                  dataType: 'JSON',
                  success: function (){ 
                      
                      Swal.fire({
                          title: "Eliminado!",
                          text: "El registro fue eliminado correctamente.",
                          icon: "success"
                      });

                     
                          location.reload();
                    
                  }
              })
          
          }
        });

  }
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/orden_salida/empleado_index.blade.php ENDPATH**/ ?>