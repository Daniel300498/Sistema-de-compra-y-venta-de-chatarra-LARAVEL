<?php $__env->startSection('titulo','Declaración Jurada'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>DECLARACIONES JURADAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('declaraciones.create', ['uuidEmpleado' => $empleado->uuid ])); ?>">Declaraciones Juradas</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Adjuntar Declaraciones Juradas</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('declaraciones.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>" >
            <div class="row mb-3">
                <div class="col-md-6">
                  <label for="nombre" class="col-md-12 col-form-label">Seleccionar Archivo de declaración: <span class="text-danger">(*)</span></label>
                  <input type="file" name="nombre" class="<?php echo e($errors->has('nombre') ? 'error' : ''); ?>"   accept="application/pdf" value="<?php echo e(old('nombre')); ?>">
                    <?php if($errors->has('nombre')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nombre')); ?>

                        </span>
                        
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <?php echo e(Form::label('codigo','Número De Certificado De D.J.B.R')); ?> <span class="text-danger">(*)</span>
                    <input id="codigo" type="text" class="form-control <?php echo e($errors->has('codigo') ? ' error' : ''); ?>" name="codigo" maxlength="8" value="<?php echo e(old('codigo')); ?>"   onkeydown="javascript: return event.keyCode === 8 ||
                    event.keyCode === 46 ? true : !isNaN(Number(event.key))" value="<?php echo e(old('codigo')); ?>">
                    <?php if($errors->has('codigo')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('codigo')); ?>

                        </span>
                    <?php endif; ?>
              </div>
              <div class="col-lg-4">
                  <?php echo e(Form::label('tipo','Tipo Declaración' )); ?> <span class="text-danger">(*)</span>
                  <select name="tipo" class="form-control <?php echo e($errors->has('tipo') ? ' error' : ''); ?>"  id="tipo" Onchange = "mostrar()" data-old="<?php echo e(old('tipo')); ?>">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('tipo')==1 ? 'selected' : ''); ?>>Por Asumir</option>
                    <option value="3" <?php echo e(old('tipo')==3 ? 'selected' : ''); ?>>Después Del Ejercicio Del Cargo</option>
                  </select>
                  <?php if($errors->has('tipo')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('tipo')); ?>

                        </span>
                    <?php endif; ?>
              </div>
              <div class="col-lg-4" style="display: none" id="bloque">
                <label for="fecha_retiro" style="display: none" id="label"> Fecha Retiro<span class="text-danger">(*)</span></label>
                    <input id="fecha_retiro" type="date" class="form-control <?php echo e($errors->has('fecha_retiro') ? ' error' : ''); ?>" name="fecha_retiro" value="<?php echo e(old('fecha_retiro')); ?>" >
                    <?php if($errors->has('fecha_retiro')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('fecha_retiro')); ?>

                        </span>
                    <?php endif; ?>
              </div>

              </div>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_certificacion','Fecha De Certificación')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_certificacion" type="date" class="form-control <?php echo e($errors->has('fecha_certificacion') ? ' error' : ''); ?>" name="fecha_certificacion" value="<?php echo e(old('fecha_certificacion')); ?>"   >
                      <?php if($errors->has('fecha_certificacion')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_certificacion')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-6">
                  <?php echo e(Form::label('fecha_presentacion','Fecha De Presentacion A Recursos Humanos')); ?> <span class="text-danger">(*)</span>
                  <input id="fecha_presentacion" type="date" class="form-control <?php echo e($errors->has('fecha_presentacion') ? ' error' : ''); ?>" name="fecha_presentacion"  value="<?php echo e(old('fecha_presentacion')); ?>"   >
                  <?php if($errors->has('fecha_presentacion')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('fecha_presentacion')); ?>

                      </span>
                  <?php endif; ?>
              </div>

              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('declaraciones.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>
<?php if(count($declaraciones)>0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Declaraciones Juradas registradas</h5>
            <?php if(count($declaraciones)>1): ?>
            <a href="<?php echo e(route('declaraciones.show', $empleado->uuid)); ?>" class="btn btn-info" target="_blank">Ver Todos los Adjuntos</a>
            <?php endif; ?>
          </div>
          <p>Si necesita realizar una corrección del registro previamente ingresado o eliminarlo puede utilizar las opciones del menu.</p>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Tipo declaración</th>
                  <th class="text-center">Fecha Certificado</th>
                  <th class="text-center">Fecha Presentacion RRHH</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class="text-center"><?php echo e($key+1); ?></td>
                    <td>
                    <?php switch($document->tipo): 
                      case ("1"): ?>
                        Por Asumir
                        <?php break; ?>
                      <?php case ("2"): ?>
                        Por Actualización
                        <?php break; ?>
                      <?php case ("3"): ?>
                        Después Del Ejercicio Del Cargo
                      <?php break; ?>
                    <?php endswitch; ?>
                    </td>
                    <td class="text-center"><?php echo e(date('d/m/Y',strtotime($document->fecha_certificacion))); ?></td>
                    <td class="text-center"><?php echo e(date('d/m/Y',strtotime($document->fecha_presentacion))); ?></td>
                    <td class="d-flex align-items-center justify-content-center">
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                          </button>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?php echo e(asset('declaraciones_juradas/'.$document->nombre)); ?>" target="_blank">Ver Adjunto</a></li>
                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.edit')): ?>
                              <li><a href="<?php echo e(route('declaraciones.edit',$document->uuid)); ?>" class="dropdown-item" title="Modificar datos">Modificar datos</a></li> 
                              <?php endif; ?>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.destroy')): ?>
                              <li><a class="dropdown-item" href="<?php echo e(route('declaraciones.destroy',$document->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar Declaracion Jurada?');">Eliminar Declaracion Jurada</a></li>
                                  
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
          </div>
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
<script>
  mostrar();
  function mostrar() {
  var x = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
  if (x==3) {
       $("#fecha_retiro").show();
       $("#fecha_retiro").prop("", true);
       var el = document.getElementById("bloque");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:block");
      } else {
       $("#fecha_retiro").hide();
       $("#fecha_retiro").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
      } 
 
  }  
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/declaraciones/create.blade.php ENDPATH**/ ?>