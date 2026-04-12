

<?php $__env->startSection('titulo','Documento Complementario'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>DOCUMENTOS COMPLEMENTARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Adjuntar Documento Complementario</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Adjuntar documento</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p>Todos los campos son de ingreso obligatorio. Para adjuntar un documento se debe seleccionar el archivo, agregar la descripcion correspondiente y presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción presione el botón <strong>SALIR</strong>.</p>
           <div class="d-flex justify-content-center">
           <div class="col-md-10">
           <form action="<?php echo e(route('complementarios.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <div class="row mb-3">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                        <label for="example-text-input" class="form-control-label">Documento Complementario</label><span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="nombre" id="" class="form-control text-center <?php echo e($errors->has('nombre') ? ' error' : ''); ?>"  accept="application/pdf">
                        <?php if($errors->has('nombre')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('nombre')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group d-flex">
                  <div class="col-md-4">
                    <?php echo e(Form::label('descripcion','Descripcion' )); ?> <span class="text-danger">(*)</span>
                  </div>
                  <div class="col-md-8">
                    <input id="descripcion" type="text" class="form-control text-center <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    <?php if($errors->has('descripcion')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('descripcion')); ?>

                        </span>
                    <?php endif; ?>
                  </div>
              </div>
          </div>          
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('complementarios_empleados.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
         </form>
        </div>
      </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php if(count($complementarios)>0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Documentos Complementarios Registrados</h5>
          <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción Eliminar y volver a ingresarlo.</p>
         <!--CONTENIDO -->
         <div class="d-flex align-items-center justify-content-between">
           <?php if(count($complementarios)>1): ?>
            <a href="<?php echo e(route('complementarios.show', $empleado->uuid)); ?>" class="btn btn-info" target="_blank">Ver Todos los Adjuntos</a>
           <?php endif; ?>
         </div>
         <div class="table-responsive">

         </div>
            <table class="table table-hover table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Descripcion</th>
                  <th class="text-center">Fecha registro</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $complementarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class="text-center"><?php echo e($key+1); ?></td>
                    <td><?php echo e($document->descripcion); ?></td>
                    <td class="text-center"><?php echo e(date('d/m/Y',strtotime($document->created_at))); ?></td>
                    <td class="d-flex align-items-center justify-content-center">
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                          </button>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?php echo e(asset('documentos_complementarios/'.$document->nombre)); ?>" target="_blank">Ver Adjunto</a></li>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complementarios.destroy')): ?>
                              <li><a class="dropdown-item" href="<?php echo e(route('complementarios.destroy',$document->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el Documento Complementario?');">Eliminar Adjunto</a></li>
                              <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                   </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
          </table>
          <br><br>
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/complementarios/create.blade.php ENDPATH**/ ?>