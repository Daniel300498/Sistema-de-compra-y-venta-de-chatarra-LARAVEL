<div id="carrerasTable" style="display: none;"> 
    <section class="section">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Agregar Carrera de formación</h5>
                <form action="<?php echo e(route('academico.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tipo" value="profesion">
                    <div class="form-group">
                        <label for="descripcion">Nombre:<span class="text-danger">*</span></label>
                        <input required id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name= "descripcion" value="<?php echo e(old('descripcion', isset($parametros) ? $parametros->descripcion : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                        <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"> Carreras Registradas</h5>
                <p class="mb-0">Puede modificar y eliminar una carrera desde el menú de <strong>Opciones</strong>.</p>
                <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla la carrera que corresponda.</p>
               <div class="container mt-3">
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" id="opcion2" class="table table-hover table-bordered table-sm"> 
                        <thead>
                            <tr>
                                <th class="text-center">Carreras Universitarias</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $carreras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center">
                                    <small><?php echo e($c->descripcion); ?></small>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('academico.edit')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('academico.edit',$c->uuid)); ?>">Modificar Descripción</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('academico.destroy')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('academico.destroy',$c->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar en registro?');">Eliminar</a></li>
                                            <?php endif; ?>
                                        </ul>
                                      </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
                <!-- EndCONTENIDO Example -->
              </div>
            </div>
          </div>
        </div>
    </section>
    
</div>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/parametros/academico/secciones/carreras_table.blade.php ENDPATH**/ ?>