<p>Debe rellenar todos los campos marcados con <span class="text-danger">(*)</span>. Al momento de registrar / editar una publicación, puede programar la publicación ingresando una fecha futura en el campo Fecha de Publicación.</p>
<form action="<?php echo e(route('publicacion.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> 
    <div class="row"> 
        <div class="col-md-6">
            <?php echo e(Form::label('tipoPub', 'Tipo de Publicaci&oacute;n')); ?> <span class="text-danger">(*)</span>
            <div class="d-flex align-items-center justify-content-between">
                <select name="tipo" id="tipo" class="form-control <?php echo e($errors->has('tipo') ? ' error' : ''); ?>">
                    <option value="">-- SELECCIONE --</option>
                    <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tipo->descripcion); ?>" <?php echo e(old('tipo', isset($publicacion) ? $publicacion->tipo : '') == $tipo->descripcion ? 'selected' : ''); ?>><?php echo e($tipo->descripcion); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tipoPub" title="Agregar Tipo de Publicación">
                   <i class="bi bi-plus-lg"></i>
                </button>
                <?php if($errors->has('tipo')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('tipo')); ?>

                    </span>
                <?php endif; ?>
            </div> 

            <div class="form-group">
                <label for="documento">Documento <?php if(!$publicacion->documento): ?><span class="text-danger">(*)</span><?php endif; ?></label>
                <div class="input-group">
                    <input id="nombre" type="file" class="form-control <?php echo e($errors->has('documento') ? ' error' : ''); ?>" name="documento" value="<?php echo e(old('documento', isset($publicacion) ? $publicacion->documento : '')); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    <?php if($publicacion->documento): ?>
                        <a href="<?php echo e(asset('publicaciones/' . $publicacion->documento)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                    <?php endif; ?>
                </div>
                <?php if($errors->has('documento')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('documento')); ?>

                    </span>
                <?php endif; ?>
            </div>
                           
                <div class="form-group">
                <?php if(!$publicacion->fecha_publicacion): ?>
                    <label for="fecha_publicacion">Fecha de Publicación <span class="text-danger">(*)</span></label>
                <?php endif; ?>
                <input id="fecha_publicacion" <?php if($publicacion->fecha_publicacion): ?> type="hidden" <?php else: ?> type="date" <?php endif; ?> class="form-control <?php echo e($errors->has('fecha_publicacion') ? ' error' : ''); ?>" name="fecha_publicacion" value="<?php echo e(old('fecha_publicacion', isset($publicacion) && $publicacion->fecha_publicacion ? $publicacion->fecha_publicacion : now()->format('Y-m-d'))); ?>">                
                <?php if($errors->has('fecha_publicacion')): ?>
                <span class="text-danger">
                    <?php echo e($errors->first('fecha_publicacion')); ?>

                </span>
                <?php endif; ?>
            </div>

             <div class="form-group">
                <label for="fecha_caducidad">Fecha de Caducidad <span class="text-danger">(*)</span></label>
                <input id="fecha_caducidad" type="date" class="form-control <?php echo e($errors->has('fecha_caducidad') ? ' error' : ''); ?>" name="fecha_caducidad" value="<?php echo e(old('fecha_caducidad', isset($publicacion) ? $publicacion->fecha_caducidad : now()->addDays(1)->format('Y-m-d'))); ?>">                
                <?php if($errors->has('fecha_caducidad')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_caducidad')); ?>

                    </span>
                <?php endif; ?>
            </div>

        </div>
   
        <div class="col-md-6">
            <div class="form-group">
                <label for="titulo">Título <span class="text-danger">(*)</span></label>
                <input id="titulo" type="text" class="form-control <?php echo e($errors->has('titulo') ? ' error' : ''); ?>" name="titulo" value="<?php echo e(old('titulo', isset($publicacion) ? $publicacion->titulo : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();">                
               
                <?php if($errors->has('titulo')): ?>
                <span class="text-danger">
                    <?php echo e($errors->first('titulo')); ?>

                </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción <span class="text-danger">(*)</span></label>
                <textarea id="descripcion" rows="6" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion"  onkeydown="return soloLetras(event);"><?php echo e(old('descripcion', isset($publicacion) ? $publicacion->descripcion : '')); ?></textarea>
                <?php if($errors->has('descripcion')): ?>
                <span class="text-danger">
                    <?php echo e($errors->first('descripcion')); ?>

                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col text-center">   
                <?php if(!$publicacion->estado): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.publicar')): ?>
                <button type="submit" class="btn btn-primary" name="estado" value="2">Publicar</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.create')): ?>
                <button type="submit" class="btn btn-secondary" name="estado" value="0">Guardar</button>
                <?php endif; ?>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="estado" value="2">Publicar</button>
                <?php endif; ?>
                <a href="<?php echo e(route('publicacion.index')); ?>" class="btn btn-danger">Salir</a>
            </form>
        </div>
    </div>
   
</form>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/_form.blade.php ENDPATH**/ ?>