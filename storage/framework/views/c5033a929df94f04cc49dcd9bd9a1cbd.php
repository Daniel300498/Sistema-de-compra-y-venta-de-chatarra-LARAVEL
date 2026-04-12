<?php $__env->startSection('titulo','Adjuntar Respaldos Lactancia'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>REGISTRO LACTANCIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lactancias.index')); ?>">Ver Registrados</a></li>
        <li class="breadcrumb-item active">Adjuntar Documentación Complementaria</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Actualizar Documentación Lactancia</h5>
                <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
                <!--CONTENIDO -->
                <p>Puedes editar algún documento ya ingresado o ingresar alguna nueva documentación con su respectiva fecha.</p>      
                  <?php echo Form::model($lactancia,['route'=>['lactancias.update',$lactancia->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                      <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
                      <input type="hidden" name="lactancia_tipo" id="lactancia_tipo" value="<?php echo e($lactancia->inicio_lactancia); ?>">
                      <input type="hidden" name="lactancia_postnatal" id="lactancia_postnatal" value="<?php echo e($lactancia->documento_certificado_nacimiento); ?>">
                      <?php echo e(csrf_field()); ?>

                      <!--TIPO DE LICENCIA-->  

                      <?php if($lactancia->documento_certificado_nacimiento==null): ?>
                      <h5 class="card-title">Documentación Prenatal</h5>
                      <div id="prenatalDocumentacion" name="prenatalDocumentacion">
                        <div class="col-md-10">
                          <div class="form-group d-flex align-items-center mb-2">
                            <div class="col-md-5 text-right">
                              <label for="example-text-input" class="form-control-label">Certificado Medico </label>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-7 d-flex text-center">
                              <input type="file" name="documento_prenatal" class="form-control" id="" accept="application/pdf">
                              <?php if($lactancia->documento_prenatal): ?>
                                  <a href="<?php echo e(asset('documentos_lactancia/' . $lactancia->documento_prenatal)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                              <?php endif; ?>
                            </div>
                          </div> 
                          <div class="form-group d-flex align-items-center mb-2">
                            <div class="col-md-5 text-right">
                              <?php echo e(Form::label('fecha_inicio_prenatal','Fecha Certificado Medico' )); ?> &nbsp;&nbsp;
                            </div>
                            <div class="col-md-7 d-flex text-center  justify-content-center">
                              <span><?php echo e(date('d / m / Y', strtotime($lactancia->fecha_inicio_prenatal))); ?></span>
                            </div>
                          </div>         
                        </div>                        
                      </div>
                      <?php endif; ?>
          
                      <div id="postnatalDocumentacion" name="postnatalDocumentacion">
                        <h5 class="card-title">Documentación Postnatal</h5>
                          <div class="col-md-10">
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <label for="example-text-input" class="form-control-label">Certificado de Nacimiento  </label>&nbsp;&nbsp;
                              </div>
                              <div class="col-md-7 d-flex text-center">
                                <input type="file" name="documento_certificado_nacimiento" id="documento_certificado_nacimiento" class="form-control <?php echo e($errors->has('documento_certificado_nacimiento') ? ' error' : ''); ?>"   accept="application/pdf">
                                <?php if($lactancia->documento_certificado_nacimiento): ?>
                                  <a href="<?php echo e(asset('documentos_lactancia/' . $lactancia->documento_certificado_nacimiento)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                <?php endif; ?>
                                <?php if($errors->has('documento_certificado_nacimiento')): ?>
                                  <span class="text-danger"> 
                                      <?php echo e($errors->first('documento_certificado_nacimiento')); ?>

                                  </span>
                                <?php endif; ?>
                              </div>
                            </div> 
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <?php echo e(Form::label('fecha_certificado_nacimiento','Fecha de Nacimiento' )); ?> &nbsp;&nbsp;
                                <?php if($lactancia->documento_certificado_nacimiento==null): ?>
                                  <span class="text-danger">(*)</span> 
                                <?php endif; ?>
                              </div>
                              <div class="col-md-7 text-center">
                                <input type="date" name="fecha_certificado_nacimiento" id="fecha_certificado_nacimiento" class="form-control text-center <?php echo e($errors->has('fecha_certificado_nacimiento') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_certificado_nacimiento',$lactancia->fecha_certificado_nacimiento)); ?>" >
                                  <?php if($errors->has('fecha_certificado_nacimiento')): ?>
                                      <span class="text-danger">
                                          <?php echo e($errors->first('fecha_certificado_nacimiento')); ?>

                                      </span>
                                  <?php endif; ?>
                              </div>
                            </div>
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <label for="example-text-input" class="form-control-label">Respaldo de la Caja de Salud </label>&nbsp;&nbsp;
                              </div>
                              <div class="col-md-7 d-flex text-center">
                                <input type="file" name="documento_caja_postnatal" id="documento_caja_postnatal" class="form-control <?php echo e($errors->has('documento_caja_postnatal') ? ' error' : ''); ?>"  accept="application/pdf">
                                <?php if($lactancia->documento_caja_postnatal): ?>
                                      <a href="<?php echo e(asset('documentos_lactancia/' . $lactancia->documento_caja_postnatal)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                <?php endif; ?>
                                <?php if($errors->has('documento_caja_postnatal')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('documento_caja_postnatal')); ?>

                                </span>
                                <?php endif; ?>
                              </div>
                            </div> 
                            <div class="form-group d-flex align-items-center mb-2">
                              <div class="col-md-5 text-right">
                                <?php echo e(Form::label('fecha_registro_caja_postnatal','Fecha del Respaldo' )); ?>&nbsp;&nbsp;
                                <?php if($lactancia->documento_caja_postnatal==null): ?>
                                  <span class="text-danger">(*)</span> 
                                <?php endif; ?>
                              </div>
                              <div class="col-md-7 text-center">
                                <input type="date" name="fecha_registro_caja_postnatal" id="fecha_registro_caja_postnatal" class="form-control text-center <?php echo e($errors->has('fecha_registro_caja_postnatal') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_registro_caja_postnatal',$lactancia->fecha_registro_caja_postnatal)); ?>" >
                                  <?php if($errors->has('fecha_registro_caja_postnatal')): ?>
                                      <span class="text-danger">
                                          <?php echo e($errors->first('fecha_registro_caja_postnatal')); ?>

                                      </span>
                                  <?php endif; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                          
                      <div class="text-center mt-4">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                          <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="btn btn-danger">Salir</a>
                      </div>
                                      
                  <?php echo Form::close(); ?>



              
                  <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/edit.blade.php ENDPATH**/ ?>