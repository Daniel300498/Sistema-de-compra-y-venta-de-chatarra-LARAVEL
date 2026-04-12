
<?php $__env->startSection('titulo','Horarios'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>HORARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('horarios.create')); ?>">Horarios</a></li>
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
              <h5 class="card-title">Adjuntar Horarios</h5>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el boton <strong>GUARDAR</strong>. Presione el boton <strong>Salir</strong> si no desea realizar ninguna accion.</p>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('horarios.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Configuración Básica</h5>
            </div>
            <div class="row">
              <input id="empresa" type="hidden" class="form-control <?php echo e($errors->has('empresa') ? ' error' : ''); ?>" name="empresa" value="company.default">
              <div class="col-lg-4">
              </div>
              <div class="col-lg-4">
                <?php echo e(Form::label('nombre','Nombre' )); ?> <span class="text-danger">(*)</span>
                <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e(old('nombre')); ?>" >
                <?php if($errors->has('nombre')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('nombre')); ?>

                    </span>
                <?php endif; ?>
              </div>
              <div class="col-lg-4">
                </div>
              </div>
              <br>
              

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                      <?php echo e(Form::label('entrada_turno','Entrada Turno' )); ?> <span class="text-danger">(*)</span>
                      <input id="entrada_turno" type="time" class="form-control <?php echo e($errors->has('entrada_turno') ? ' error' : ''); ?>" name="entrada_turno" value="<?php echo e(old('entrada_turno')); ?>" >
                      <?php if($errors->has('entrada_turno')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('entrada_turno')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-6">
                </div>

             </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                  <div class="col-lg-4">
                    <?php echo e(Form::label('inicio_entrada_turno','Inicio Entrada Turno' )); ?> <span class="text-danger">(*)</span>
                    <input id="inicio_entrada_turno" type="time" class="form-control <?php echo e($errors->has('inicio_entrada_turno') ? ' error' : ''); ?>" name="inicio_entrada_turno" value="<?php echo e(old('inicio_entrada_turno')); ?>" >
                    <?php if($errors->has('inicio_entrada_turno')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('inicio_entrada_turno')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('inicio_entrada_turno_crusado_dias','Cruzado Días' )); ?> 
                  <select name="inicio_entrada_turno_crusado_dias" class="form-control <?php echo e($errors->has('inicio_entrada_turno_crusado_dias') ? ' error' : ''); ?>" id="inicio_entrada_turno_crusado_dias">
                    <option value="0" <?php echo e(old('inicio_entrada_turno_crusado_dias')==0 ? 'selected' : ''); ?> selected>0</option>
                    <option value="-1" <?php echo e(old('inicio_entrada_turno_crusado_dias')==-1 ? 'selected' : ''); ?>>-1</option>
                    <option value="-2" <?php echo e(old('inicio_entrada_turno_crusado_dias')==-2 ? 'selected' : ''); ?>>-2</option>
                    <option value="-3" <?php echo e(old('inicio_entrada_turno_crusado_dias')==-3 ? 'selected' : ''); ?>>-3</option>
                  </select>
                
                </div>
                <div class="col-lg-2">
                </div>
             </div>
            
             <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('final_entrada_turno','Final Entrada Turno' )); ?> <span class="text-danger">(*)</span>
                  <input id="final_entrada_turno" type="time" class="form-control <?php echo e($errors->has('final_entrada_turno') ? ' error' : ''); ?>" name="final_entrada_turno" value="<?php echo e(old('final_entrada_turno')); ?>" >
                  <?php if($errors->has('final_entrada_turno')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('final_entrada_turno')); ?>

                      </span>
                  <?php endif; ?>
              </div>
              <div class="col-lg-4">
                <?php echo e(Form::label('final_entrada_turno_crusado_dias','Cruzado Días' )); ?>

                <select name="final_entrada_turno_crusado_dias" class="form-control <?php echo e($errors->has('final_entrada_turno_crusado_dias') ? ' error' : ''); ?>" id="final_entrada_turno_crusado_dias">
                  <option value="0" <?php echo e(old('final_entrada_turno_crusado_dias')==0 ? 'selected' : ''); ?> selected>0</option>
                  <option value="1" <?php echo e(old('final_entrada_turno_crusado_dias')==1 ? 'selected' : ''); ?>>1</option>
                  <option value="2" <?php echo e(old('final_entrada_turno_crusado_dias')==2 ? 'selected' : ''); ?>>2</option>
                  <option value="3" <?php echo e(old('final_entrada_turno_crusado_dias')==3 ? 'selected' : ''); ?>>3</option>
                </select>
              </div>
              <div class="col-lg-2">
                </div>
                
            </div>
            <br>
              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('dia_pagado','Día Pagado (Días)' )); ?> <span class="text-danger">(*)</span>
                    <input id="dia_pagado" type="number" class="form-control <?php echo e($errors->has('dia_pagado') ? ' error' : ''); ?>" name="dia_pagado" value="<?php echo e(old('dia_pagado')); ?>" >
                    <?php if($errors->has('dia_pagado')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('dia_pagado')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('salida_turno','Salida Turno' )); ?> <span class="text-danger">(*)</span>
                  <input id="salida_turno" type="time" class="form-control <?php echo e($errors->has('salida_turno') ? ' error' : ''); ?>" name="salida_turno" value="<?php echo e(old('salida_turno')); ?>" >
                  <?php if($errors->has('salida_turno')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('salida_turno')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('salida_turno_crusado_dias','Cruzado Días' )); ?> 
                  <select name="salida_turno_crusado_dias" class="form-control <?php echo e($errors->has('salida_turno_crusado_dias') ? ' error' : ''); ?>" id="salida_turno_crusado_dias">
                    <option value="0" <?php echo e(old('salida_turno_crusado_dias')==0 ? 'selected' : ''); ?> selected>0</option>
                    <option value="1" <?php echo e(old('salida_turno_crusado_dias')==1 ? 'selected' : ''); ?>>1</option>
                    <option value="2" <?php echo e(old('salida_turno_crusado_dias')==2 ? 'selected' : ''); ?>>2</option>
                    <option value="3" <?php echo e(old('salida_turno_crusado_dias')==3 ? 'selected' : ''); ?>>3</option>
                  </select>
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('inicio_salida_turno','Inicio Salida Turno' )); ?> <span class="text-danger">(*)</span>
                    <input id="inicio_salida_turno" type="time" class="form-control <?php echo e($errors->has('inicio_salida_turno') ? ' error' : ''); ?>" name="inicio_salida_turno" value="<?php echo e(old('inicio_salida_turno')); ?>" >
                    <?php if($errors->has('inicio_salida_turno')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('inicio_salida_turno')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('inicio_salida_turno_crusado_dias','Cruzado Días' )); ?> 
                  <select name="inicio_salida_turno_crusado_dias" class="form-control <?php echo e($errors->has('inicio_salida_turno_crusado_dias') ? ' error' : ''); ?>" id="inicio_salida_turno_crusado_dias">
                    <option value="0" <?php echo e(old('inicio_salida_turno_crusado_dias')==0 ? 'selected' : ''); ?> selected>0</option>
                    <option value="1" <?php echo e(old('inicio_salida_turno_crusado_dias')==1 ? 'selected' : ''); ?>>1</option>
                    <option value="2" <?php echo e(old('inicio_salida_turno_crusado_dias')==2 ? 'selected' : ''); ?>>2</option>
                    <option value="3" <?php echo e(old('inicio_salida_turno_crusado_dias')==3 ? 'selected' : ''); ?>>3</option>
                  </select>
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('final_salida_turno','Final Salida Turno' )); ?> <span class="text-danger">(*)</span>
                    <input id="final_salida_turno" type="time" class="form-control <?php echo e($errors->has('final_salida_turno') ? ' error' : ''); ?>" name="final_salida_turno" value="<?php echo e(old('final_salida_turno')); ?>" >
                    <?php if($errors->has('final_salida_turno')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('final_salida_turno')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('final_salida_turno_crusado_dias','Cruzado Dias' )); ?> 
                  <select name="final_salida_turno_crusado_dias" class="form-control <?php echo e($errors->has('final_salida_turno_crusado_dias') ? ' error' : ''); ?>" id="final_salida_turno_crusado_dias">
                    <option value="0" <?php echo e(old('final_salida_turno_crusado_dias')==0 ? 'selected' : ''); ?> selected>0</option>
                    <option value="1" <?php echo e(old('final_salida_turno_crusado_dias')==1 ? 'selected' : ''); ?>>1</option>
                    <option value="2" <?php echo e(old('final_salida_turno_crusado_dias')==2 ? 'selected' : ''); ?>>2</option>
                    <option value="3" <?php echo e(old('final_salida_turno_crusado_dias')==3 ? 'selected' : ''); ?>>3</option>
                  </select> 
                </div>
                <div class="col-lg-2">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('ajuste_color','Ajuste Color' )); ?> <span class="text-danger">(*)</span>
                    <input id="ajuste_color" type="color" class="form-control <?php echo e($errors->has('ajuste_color') ? ' error' : ''); ?>" name="ajuste_color" value="<?php echo e(old('ajuste_color')); ?>" >
                    <?php if($errors->has('ajuste_color')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('ajuste_color')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuracion De Descanso</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('id_tiempo_descanso','Tiempo Descanso' )); ?> 
                  <select name="id_tiempo_descanso"  class="form-control form-control <?php echo e($errors->has('id_tiempo_descanso') ? ' error' : ''); ?>" id="id_tiempo_descanso" data-old="<?php echo e(old('id_tiempo_descanso')); ?>" >
                    <option value="">--SELECCIONE--</option>
                    <?php $__currentLoopData = $tiempo_descanso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tiempo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tiempo->id); ?>" <?php echo e(old('id_tiempo_descanso') == $tiempo->id ? 'selected' :''); ?> ><?php echo e($tiempo->nombre); ?>   , horas:   <?php echo e($tiempo->hora_inicial); ?> - <?php echo e($tiempo->hora_final); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="col-lg-4">
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuracion De Regla</h5>
              </div>
              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('necesario_marcar_entrada','Necesario Marcar Entrada' )); ?> <span class="text-danger">(*)</span>
                  <select name="necesario_marcar_entrada" class="form-control <?php echo e($errors->has('necesario_marcar_entrada') ? ' error' : ''); ?>" id="necesario_marcar_entrada">
                    <option value="0" <?php echo e(old('necesario_marcar_entrada')==0 ? 'selected' : ''); ?> selected>Si</option>
                    <option value="1" <?php echo e(old('necesario_marcar_entrada')==1 ? 'selected' : ''); ?>>No</option>
                  </select>
                  <?php if($errors->has('necesario_marcar_entrada')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('necesario_marcar_entrada')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('necesario_marcar_salida','Necesario Marcar Salida' )); ?> <span class="text-danger">(*)</span>
                  <select name="necesario_marcar_salida" class="form-control <?php echo e($errors->has('necesario_marcar_salida') ? ' error' : ''); ?>" id="necesario_marcar_salida">
                    <option value="0" <?php echo e(old('necesario_marcar_salida')==0 ? 'selected' : ''); ?> selected>Si</option>
                    <option value="1" <?php echo e(old('necesario_marcar_salida')==1 ? 'selected' : ''); ?>>No</option>
                  </select>
                  <?php if($errors->has('necesario_marcar_salida')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('necesario_marcar_salida')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-2">
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('permite_llegar_tarde','Permite Llegar Tarde (Minutos)' )); ?> <span class="text-danger">(*)</span>
                  <input id="permite_llegar_tarde" type="number" min="0" class="form-control <?php echo e($errors->has('permite_llegar_tarde') ? ' error' : ''); ?>" name="permite_llegar_tarde" value="0" >
                  <?php if($errors->has('permite_llegar_tarde')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('permite_llegar_tarde')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('permite_salida_tarde','Permite Salida Temprana (Minutos)' )); ?> <span class="text-danger">(*)</span>
                  <input id="permite_salida_tarde" type="number" min="0" class="form-control <?php echo e($errors->has('permite_salida_tarde') ? ' error' : ''); ?>" name="permite_salida_tarde" value="0" >
                  <?php if($errors->has('permite_salida_tarde')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('permite_salida_tarde')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-2">
                </div>
              </div>

              <div class="row">
              <div class="col-lg-2">
              </div>
              <div class="col-lg-4">
                <?php echo e(Form::label('acordes_marcacion','Acorde Al Estado Marcación' )); ?> <span class="text-danger">(*)</span>
                <select name="acordes_marcacion" class="form-control <?php echo e($errors->has('acordes_marcacion') ? ' error' : ''); ?>" id="acordes_marcacion">
                  <option value="0" <?php echo e(old('acordes_marcacion')==0 ? 'selected' : ''); ?> selected>No</option>
                    <option value="1" <?php echo e(old('acordes_marcacion')==1 ? 'selected' : ''); ?>>Si</option>
                </select>
                <?php if($errors->has('acordes_marcacion')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('acordes_marcacion')); ?>

                    </span>
                <?php endif; ?>
              </div>
              <div class="col-lg-4">
                <?php echo e(Form::label('hora_cambio_dia','Hora De Cambio Día' )); ?> <span class="text-danger">(*)</span>
                <input id="hora_cambio_dia" type="time" class="form-control <?php echo e($errors->has('hora_cambio_dia') ? ' error' : ''); ?>" name="hora_cambio_dia">
                <?php if($errors->has('hora_cambio_dia')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('hora_cambio_dia')); ?>

                    </span>
                <?php endif; ?>
              </div>
                <div class="col-lg-2">
                </div>
              </div>



              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('horarios.index')); ?>" class="btn btn-danger">Salir</a>
              </div>
         
         </form>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/horarios/create.blade.php ENDPATH**/ ?>