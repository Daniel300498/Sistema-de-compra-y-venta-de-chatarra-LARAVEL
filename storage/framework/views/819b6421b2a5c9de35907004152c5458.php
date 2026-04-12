

<?php $__env->startSection('titulo','Documentacion'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Documentaci&oacute;n</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('historialcvs.index')); ?>">Documentaci&oacute;n</a></li>
        <li class="breadcrumb-item active">Historial Curriculum Vitae</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Actualizar Historial Curriculum Vitae</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
            <!--CONTENIDO -->
     
            <form action="<?php echo e(route('historialcvs.store')); ?>" method="POST" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

             <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
               <div class="row">
                <div class="col-lg-4">
                    <label for="example-text-input" class="form-control-label">Documento De Grado</label><span class="text-danger">(*)</span>
                    <input   type="file" name="nombre" id="" class="form-control text-center <?php echo e($errors->has('nombre') ? ' error' : ''); ?>"  accept="application/pdf">
                    <?php if($errors->has('nombre')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nombre')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                
                 <div class="col-lg-4">
                    <?php echo e(Form::label('institucion_formacion','Universidad o Instituto' )); ?> <span class="text-danger">(*)</span>                
                        <select  name="institucion_formacion_id" id="institucion_formacion_id" class="form-control <?php echo e($errors->has('institucion_formacion_id') ? ' error' : ''); ?>">
                            <option value="">-- SELECCIONE --</option>
                            <?php $__currentLoopData = $instituciones_formacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($institucion->id); ?>" <?php echo e(old('institucion_formacion_id',$empleado->institucion_formacion_id) == $institucion->id ? 'selected' : ''); ?>><?php echo e($institucion->descripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                       
                        <?php if($errors->has('institucion_formacion_id')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('institucion_formacion_id')); ?>

                            </span>
                        <?php endif; ?>
                  
                 </div>
                 <div class="col-lg-4">
                    <?php echo e(Form::label('formacion','Formación' )); ?> <span class="text-danger">(*)</span>
                        <select  name="formacion_id" id="formacion_id" class="form-control <?php echo e($errors->has('formacion_id') ? ' error' : ''); ?>">
                            <option value="">-- SELECCIONE --</option>
                            <?php $__currentLoopData = $formaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($formacion->id); ?>" <?php echo e(old('formacion_id',$empleado->formacion_id) == $formacion->id ? 'selected' : ''); ?>><?php echo e($formacion->descripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('formacion_id')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('formacion_id')); ?>

                            </span>
                        <?php endif; ?>
               </div>
               </div>
               <br>
               <div class="row">
                <div class="col-lg-4">
                    <label for="example-text-input" class="form-control-label">Hoja De Vida</label><span class="text-danger">(*)</span>
                    <input type="file" name="hoja_vida" id="" class="form-control text-center <?php echo e($errors->has('hoja_vida') ? ' error' : ''); ?>"  accept="application/pdf"  >
                    <?php if($errors->has('hoja_vida')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('hoja_vida')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
            </div>
             <div class="text-center mt-3">
                 <button type="submit" class="btn btn-primary">Guardar</button>
                 <a href="<?php echo e(route('historialcvs.index')); ?>" class="btn btn-warning">Salir</a>
             </div>
          </form>
          <br>
              <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div> 
</section>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title">Historial Curriculum Vitae</h5>
        </div>
        <?php if(count($historial)>0): ?>
        <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción Modificar datos y volver a ingresarlo.</p>
        <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
             
              <th class="text-center">Nombre Empleado</th>
              <th class="text-center">Fecha Registro</th>
              <th class="text-center">Grado Obtenido</th>
              <th class="text-center">Lugar De Formacion</th>
            </tr>
            <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><center><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></center></td>
                <td><center><?php echo e($document->fecha_registro); ?></center></td>
                <td class="text-center"><?php echo e($document->formacion_id->descripcion); ?></td>
                <td class="text-center"><?php echo e($document->lugar_formacion_id->descripcion); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        <?php endif; ?>
      
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
   
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/historial_cvs/create.blade.php ENDPATH**/ ?>