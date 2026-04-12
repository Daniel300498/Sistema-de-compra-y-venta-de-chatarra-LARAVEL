
<?php $__env->startSection('titulo','Documentacion'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>DOCUMENTACIÓN</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('documentos.index')); ?>">Ver todos</a></li>
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
                <h5 class="card-title">CONTROL DE RECEPCIÓN DE DOCUMENTOS</h5>
                <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
           <!--CONTENIDO -->
           <div class="row">
            <div class="col-md-12">
                <div class="">
                    <p>Se deben marcar o seleccionar todos los campos marcados con <strong class="text-danger">(*)</strong></p>
                    <form action="<?php echo e(route('documentos.store')); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
                        <input type="hidden" name="ci" id="ci" value="<?php echo e($empleado->ci); ?>">
                        <?php echo e(csrf_field()); ?>

                        <p class="text-uppercase text-sm">DOCUMENTACIÓN PERSONAL</p>
                        <div class="row justify-content-center" >
                            <div class="col-md-8 .bg-danger">
                                    <div class="form-group d-flex">
                                        <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Hoja de vida(curricular vitae) documentado</label> <span class="text-danger">(*)</span>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="file" name="hoja_vida" id="hoja_vida" required  accept="application/pdf" class="form-control <?php echo e($errors->has('hoja_vida') ? ' error' : ''); ?>" >
                                        <?php if($errors->has('hoja_vida')): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first('hoja_vida')); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                            </div>
                        </div>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label" >Fotografía 4x4 Fondo Blanco</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="foto" id="foto" required accept="image/png, image/gif, image/jpeg" class="form-control<?php echo e($errors->has('foto') ? ' error' : ''); ?>" >
                                        <?php if($errors->has('foto')): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first('foto')); ?>

                                        </span>
                                         <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Carnet Identidad</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="fotocopia_carnet_identidad" id="fotocopia_carnet_identidad" required  accept="application/pdf" class="form-control<?php echo e($errors->has('fotocopia_carnet_identidad') ? ' error' : ''); ?>" >
                                        <?php if($errors->has('fotocopia_carnet_identidad')): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first('fotocopia_carnet_identidad')); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Certificado Nacimiento</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="fotocopia_certificado_nacimiento" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="fotocopia_certificado_nacimiento" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                          </div>             
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Servicio Militar(varones)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="fotocopia_servicio_militar" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="fotocopia_servicio_militar" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <p class="text-uppercase text-sm">DOCUMENTACIÓN COMPLEMENTARIA</p>
                            <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group d-flex align-items-center">                                    
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label" accept="application/pdf">Certificado Aymara</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="certificado_aymara"  id="" class="form-control">
                                    </div>   
                                        <?php $__errorArgs = ['certificado_aymara'];
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
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group d-flex align-items-center">
                                        <div class="col-md-6">
                                            <label for="emitido_por" class="form-control-label">Certificado de Aymara emitido Por</label>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if(isset($documentacion->emitido_por) && $documentacion->emitido_por != ''): ?>
                                                <input type="text" class="form-control" value="<?php echo e($documentacion->emitido_por); ?>" readonly>
                                            <?php else: ?>
                                                <select name="emitido_por" id="emitido_por" class="form-control">
                                                    <option value="">--SELECCIONE--</option>
                                                    <?php $__currentLoopData = $emitido_por; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($e->descripcion); ?>" <?php echo e(old('emitido_por', isset($documentacion) ? $documentacion->emitido_por : '') === $e->descripcion ? 'selected' : ''); ?>>
                                                            <?php echo e($e->descripcion); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__errorArgs = ['emitido_por'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Certificado 1178 Ley Safco</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="certificado_ley_safco" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="certificado_ley_safco" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Formulario Segip</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_segip" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_segip" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Cuenta Banco Union</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="cuenta_banco_union" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="cuenta_banco_union" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">GESTORA O NUA(si corresponde)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="gestora" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="gestora" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label" accept="application/pdf">Formulario Seguro AVC-04</label> 
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="formulario_seguro_avc_04" id="formulario_seguro_avc_04" class="form-control <?php echo e($errors->has('formulario_seguro_avc_04') ? ' error' : ''); ?>" >
                                        <?php if($errors->has('formulario_seguro_avc_04')): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first('formulario_seguro_avc_04')); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario Baja Seguro AVC-07</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_baja_seguro" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_baja_seguro" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Ciudadanía Digital</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="ciudadania_digital" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="ciudadania_digital" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="formulario_incompatibilidad" class="form-control-label" >Formulario Incompatibilidad</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="formulario_incompatibilidad" id="formulario_incompatibilidad" accept="application/pdf" class="form-control <?php echo e($errors->has('formulario_incompatibilidad') ? ' error' : ''); ?>">
                                        <?php if($errors->has("formulario_incompatibilidad")): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first("formulario_incompatibilidad")); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="certificacion_prevencion_violencia" class="form-control-label">Certificado de Prevencion de la Violencia</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                                <input type="radio" class="form-check-input" id="radio1" name="certificacion_prevencion_violencia" value="no" checked>NO
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                                <input type="radio" class="form-check-input" id="radio2" name="certificacion_prevencion_violencia" value="si">SI
                                                <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-uppercase text-sm">DOCUMENTACIÓN INSTITUCIONAL PERSONAL</p>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Memorándum Designación</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="memorandum_designacion" id="memorandum_designacion" required  accept="application/pdf" class="form-control <?php echo e($errors->has('memorandum_designacion') ? ' error' : ''); ?>" >
                                        <?php if($errors->has('memorandum_designacion')): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first('memorandum_designacion')); ?>

                                        </span>
                                        <?php endif; ?>
                                  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Otros memorándums que conciernen al Servicio Público</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="memorandum_servidor_publico" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="memorandum_servidor_publico" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Memorándum (Destitución o Retiro)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="memorandum_destitucion" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="memorandum_destitucion" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-uppercase text-sm">DOCUMENTACIÓN INSTITUCIONAL</p>


                         
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="formulario_incompatibilidad_percepcion" class="form-control-label">Formulario de declaración de incompatibilidades de doble percepción</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control <?php echo e($errors->has('formulario_incompatibilidad_percepcion') ? ' error' : ''); ?>" id="formulario_incompatibilidad_percepcion" name="formulario_incompatibilidad_percepcion" accept="application/pdf">
                                        <?php if($errors->has("formulario_incompatibilidad_percepcion")): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first("formulario_incompatibilidad_percepcion")); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                                        
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario de declaración de incompatibilidades</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_declaracion_incompatibilidades" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_declaracion_incompatibilidades" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario de inducción</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_induccion" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_induccion" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Certificado de SIPASSE y REJAP</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="certificado_sipasse_rejap" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="certificado_sipasse_rejap" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Calificación de años de servicio</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="cas" id="" accept="application/pdf" class="form-control <?php echo e($errors->has('cas') ? ' error' : ''); ?>">
                                         <?php if($errors->has("cas")): ?>
                                        <span class="text-danger">
                                            <?php echo e($errors->first("cas")); ?>

                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>



                            <p class="text-uppercase text-sm">VACACIONES Y LICENCIAS</p>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Licencias</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="licencias" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="licencias" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Vacaciones</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="vacaciones" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="vacaciones" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Lactancia</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="lactancia" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="lactancia" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary back-color-second">Guardar</button>
                            <a href="<?php echo e(route('documentos.index')); ?>" class="btn btn-danger">Salir</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/documentacion/create.blade.php ENDPATH**/ ?>