<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">&Aacute;reas Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar una &aacute;rea.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el &aacute;rea que corresponda.</p>
           <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
               <thead>
                   <tr>
                       <th class="text-center">&Aacute;rea</th>
                       <th class="text-center">Descripci&oacute;n</th>
                       <th class="text-center">Depende de</th>
                       <th class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $__currentLoopData = $areas_depende; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                   <td class="text-center"><small><?php echo e($a->nombre); ?></small></td>
                   <td class="text-center"><small><?php echo e($a->descripcion); ?></small></td>
                   <td class="text-center">
                   <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($area->id == $a->depende_id): ?>
                           <small><?php echo e($area->nombre); ?></small>   
                       <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                   </td>
                   <td class="d-flex justify-content-center" >
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                        </button>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.edit')): ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('areas.edit',$a->uuid)); ?>">Modificar &Aacute;rea</a></li>
                            <?php endif; ?>        
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.destroy')): ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('areas.destroy',$a->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el &Aacute;rea?');">Eliminar &Aacute;rea</a></li>
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
</section><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/areas/secciones/areas_jerarquia.blade.php ENDPATH**/ ?>