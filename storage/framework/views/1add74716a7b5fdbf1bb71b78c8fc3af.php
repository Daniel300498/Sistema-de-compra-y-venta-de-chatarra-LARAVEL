<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Camas Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar una cama.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la cama que corresponda.</p>
           <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
               <thead>
                   <tr>
                       <th class="text-center">N&uacute;mero de cama</th>
                       <th class="text-center">Estado</th>
                       <th class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $__currentLoopData = $camas_depende; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                   <td class="text-center"><small><?php echo e($a->numero); ?></small></td>
                   <td class="text-center"><small><?php echo e($a->estado); ?></small></td>
                   <td class="d-flex justify-content-center" >
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                        </button>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('camas.edit')): ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('camas.edit',$a->uuid)); ?>">Modificar Cama</a></li>
                            <?php endif; ?>        
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('camas.destroy')): ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('camas.destroy',$a->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la cama?');">Eliminar Cama</a></li>
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
</section><?php /**PATH C:\laragon\www\chatarra\resources\views/camas/secciones/camas_sala.blade.php ENDPATH**/ ?>