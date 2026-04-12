<div id="carrerasTable" style="display: none;"> 
    <div class="container mt-3">
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
        </br>
            <button type="submit" class="btn btn-primary">Agregar Carrera</button>
        </form>
        <hr> 
        <div class="table-responsive">
            <table cellspacing="0" width="100%" id="opcion2" class="table table-hover table-bordered table-sm"> 
                <thead>
                    <tr>
                        <th class="text-center">Carreras Universitarias</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $carreras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <small><?php echo e($c->descripcion); ?></small>
                        </td>
                        <td class="d-flex justify-content-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('academico.edit')): ?>
                            <a href="<?php echo e(route('academico.edit',$c->id)); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('academico.destroy')): ?>
                            <?php echo Form::open(['route'=>['academico.destroy',$c->id],'method'=>'DELETE']); ?>

                            <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar la Carrera Universitaria?');"><i class="bi bi-trash"></i></button>
                            <?php echo Form::close(); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/academico/secciones/carreras_table.blade.php ENDPATH**/ ?>