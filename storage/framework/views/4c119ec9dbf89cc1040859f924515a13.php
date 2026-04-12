<div class="row">
    <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Rol</h5>
            <p>Debe rellenar todos los campos</p>
            <div class="row mb-1">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <label for="name" class="">Nombre rol<span class="text-danger text-bold">(*)</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" id="name" value="<?php echo e(old('name',$role->name)); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <label class="error"><?php echo e($message); ?></label>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    <label for="descripcion" class="">Descripción<span class="text-danger text-bold">(*)</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="descripcion" id=descripcion value="<?php echo e(old('descripcion',$role->descripcion)); ?>">
                    </div>
                </div>
                <div class="text-center">
                 <?php echo e(Form::submit('Guardar',['class'=>'btn btn-primary'])); ?>

                 <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-danger">Cancelar</a>
             </div>
           </div>
        </div>
    </div>
            
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lista de Permisos</h5>
            <p>Marque los permisos que quiere asignar al Rol y luego presione el boton <strong>GUARDAR</strong></p>
            <!-- Accordion without outline borders -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont_grupo=>$grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-<?php echo e($cont_grupo); ?>" aria-expanded="false" aria-controls="flush-collapseOne-<?php echo e($cont_grupo); ?>">
                            <?php echo e($cont_grupo + 1); ?> - GESTIÓN DE <?php echo e($grupo->grupo); ?>

                        </button>
                    </h2>
                    <div id="flush-collapseOne-<?php echo e($cont_grupo); ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <ul class="list-unstyled">
                            <li>
                                <label>
                                    <?php echo e(Form::checkbox('marcar_todo_'.$grupo->grupo, null, false, ['class' => 'form-check-input marcar-todos', 'data-grupo' => $grupo->grupo])); ?>

                                    &nbsp; MARCAR / DESMARCAR TODOS
                                </label>
                            </li>
                            <?php $cont=0; ?>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($permission->grupo==$grupo->grupo): ?>
                            <?php $cont=$cont+1; ?>
                            <li>
                                <label>
                                    <?php echo e(Form::checkbox('permissions[]', $permission->id, null, ['class' => 'form-check-input', 'id' => 'basic_checkbox_' . $cont, 'data-grupo' => $grupo->grupo])); ?>

                                    &nbsp;&nbsp; <?php echo e($permission->descripcion ?: 'Sin descripción'); ?>

                                    <em>(<?php echo e($permission->name); ?>)</em>
                                </label>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
           
           </div>
        </div>
      </div>

</div>





<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/roles/_form.blade.php ENDPATH**/ ?>