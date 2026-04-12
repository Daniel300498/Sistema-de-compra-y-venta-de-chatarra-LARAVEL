
<?php $__env->startSection('titulo','Documentacion'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Editar Documentación del Empleado</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('documentos.index')); ?>">Ver Todos</a></li>
            <li class="breadcrumb-item active">Editar Documentación</li>
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
                    <!-- CONTENIDO -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <p>Los campos que no tienen archivos adjuntos pueden ser completados, mientras que los campos con archivos adjuntos pueden ser visualizados y actualizados </p>
                                <form method="POST" action="<?php echo e(route('documentos.update', $documentacion->id)); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($documentacion->empleado->id); ?>">
                                    <input type="hidden" name="ci" id="ci" value="<?php echo e($documentacion->empleado->ci); ?>">
                                    <p class="text-uppercase text-sm">DOCUMENTACIÓN PERSONAL</p>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="form-group d-flex align-items-center">
                                                <div class="col-md-6">
                                                    <label for="hoja_vida" class="form-control-label">Hoja de Vida (Curriculum Vitae) documentado</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="hoja_vida" name="hoja_vida" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->hoja_vida): ?>
                                                        <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->hoja_vida)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                              
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="foto" class="form-control-label">Fotografía 4x4 Fondo Blanco</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/png, image/gif, image/jpeg">
                                                </div>
                                                    <?php if($documentacion->foto): ?>
                                                <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->foto)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-image"></i></a>
                                                    <?php endif; ?>  
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="fotografia" class="form-control-label">Fotocopia Carnet Identidad</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="fotocopia_carnet_identidad" name="fotocopia_carnet_identidad" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->fotocopia_carnet_identidad): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->fotocopia_carnet_identidad)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="fotocopia_certificado_nacimiento" class="form-control-label">Fotocopia Certificado Nacimiento</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="fotocopia_certificado_nacimiento" value="no" <?php echo e($documentacion->fotocopia_certificado_nacimiento == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="fotocopia_certificado_nacimiento" value="si" <?php echo e($documentacion->fotocopia_certificado_nacimiento == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="fotocopia_servicio_militar" class="form-control-label">Fotocopia Servicio Militar(varones)</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="fotocopia_servicio_militar" value="no" <?php echo e($documentacion->fotocopia_servicio_militar == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="fotocopia_servicio_militar" value="si" <?php echo e($documentacion->fotocopia_servicio_militar == 'si' ? 'checked' : ''); ?>>SI
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
                                                        <label for="certificado_aymara" class="form-control-label">Certificado Aymara</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="file" class="form-control" id="certificado_aymara" name="certificado_aymara" accept="application/pdf">
                                                    </div>
                                                        <?php if($documentacion->certificado_aymara): ?>
                                                            <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->certificado_aymara)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                        <?php endif; ?>
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
                                            
                                            <div class="col-md-8">
                                            <div class="form-group d-flex align-items-center">
                                                <div class="col-md-6">
                                                    <label for="emitido_por" class="form-control-label">Certificado de Aymara emitido Por</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <?php if(isset($documentacion->emitido_por) && $documentacion->emitido_por != ''): ?>
                                                        <input type="text" class="form-control" value="<?php echo e($documentacion->emitido_por); ?>" readonly>
                                                    <?php else: ?>
                                                        <select name="emitido_por" id="emitido_por" class="form-control <?php echo e($errors->has('emitido_por') ? 'is-invalid' : ''); ?>">
                                                            <option value="">--SELECCIONE--</option>
                                                            <?php $__currentLoopData = $emitido_por; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($e->descripcion); ?>" <?php echo e(old('emitido_por', isset($documentacion) ? $documentacion->emitido_por : '') === $e->descripcion ? 'selected' : ''); ?>>
                                                                    <?php echo e($e->descripcion); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    <?php endif; ?>
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="certificado_ley_safco" class="form-control-label">Certificado 1178 Ley Safco</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="certificado_ley_safco" value="no" <?php echo e($documentacion->certificado_ley_safco == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="certificado_ley_safco" value="si" <?php echo e($documentacion->certificado_ley_safco == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="formulario_segip" class="form-control-label">Formulario Segip</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="formulario_segip" value="no" <?php echo e($documentacion->formulario_segip == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="formulario_segip" value="si" <?php echo e($documentacion->formulario_segip == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="cuenta_banco_union" class="form-control-label">Cuenta Banco Union</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="cuenta_banco_union" value="no" <?php echo e($documentacion->cuenta_banco_union == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="cuenta_banco_union" value="si" <?php echo e($documentacion->cuenta_banco_union == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="gestora" class="form-control-label">GESTORA O NUA(Si corresponde)</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="gestora" value="no" <?php echo e($documentacion->gestora == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="gestora" value="si" <?php echo e($documentacion->gestora == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="formulario_seguro_avc_04" class="form-control-label">Formulario Seguro AVC-04</label>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="formulario_seguro_avc_04" name="formulario_seguro_avc_04" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->formulario_seguro_avc_04): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->formulario_seguro_avc_04)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="formulario_baja_seguro" class="form-control-label">Formulario Baja Seguro AVC-07</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="formulario_baja_seguro" value="no" <?php echo e($documentacion->formulario_baja_seguro == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="formulario_baja_seguro" value="si" <?php echo e($documentacion->formulario_baja_seguro == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="ciudadania_digital" class="form-control-label">Ciudadania Digital</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="ciudadania_digital" value="no" <?php echo e($documentacion->ciudadania_digital == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="ciudadania_digital" value="si" <?php echo e($documentacion->ciudadania_digital == 'si' ? 'checked' : ''); ?>>SI
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
                                                    <input type="file" name="formulario_incompatibilidad" id="formulario_incompatibilidad" accept="application/pdf" class="form-control">
                                                </div>
                                                <?php if($documentacion->formulario_incompatibilidad): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->formulario_incompatibilidad)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
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
                                                            <input type="radio" class="form-check-input" id="radio1" name="certificacion_prevencion_violencia" value="no" <?php echo e($documentacion->certificacion_prevencion_violencia== 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="certificacion_prevencion_violencia" value="si" <?php echo e($documentacion->certificacion_prevencion_violencia == 'si' ? 'checked' : ''); ?>>SI
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
                                                    <label for="memorandum_designacion" class="form-control-label">Memorandum de Designación</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="memorandum_designacion" name="memorandum_designacion" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->memorandum_designacion): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->memorandum_designacion)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="memorandum_servidor_publico" class="form-control-label">Otros memorándums que conciernen al Servicio Público</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="memorandum_servidor_publico" value="no" <?php echo e($documentacion->memorandum_servidor_publico == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="memorandum_servidor_publico" value="si" <?php echo e($documentacion->memorandum_servidor_publico == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="memorandum_destitucion" class="form-control-label">Memorándum (Destitución o Retiro)</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="memorandum_destitucion" value="no" <?php echo e($documentacion->memorandum_destitucion == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="memorandum_destitucion" value="si" <?php echo e($documentacion->memorandum_destitucion == 'si' ? 'checked' : ''); ?>>SI
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
                                                    <input type="file" class="form-control" id="formulario_incompatibilidad_percepcion" name="formulario_incompatibilidad_percepcion" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->formulario_incompatibilidad_percepcion!="no"): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->formulario_incompatibilidad_percepcion)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="formulario_declaracion_incompatibilidades" class="form-control-label">Formulario de declaración de incompatibilidades</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="formulario_declaracion_incompatibilidades" value="no" <?php echo e($documentacion->formulario_declaracion_incompatibilidades == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="formulario_declaracion_incompatibilidades" value="si" <?php echo e($documentacion->formulario_declaracion_incompatibilidades == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="formulario_induccion" class="form-control-label">Formulario de inducción</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="formulario_induccion" value="no" <?php echo e($documentacion->formulario_induccion == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="formulario_induccion" value="si" <?php echo e($documentacion->formulario_induccion == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="certificado_sipasse_rejap" class="form-control-label">Certificado de SIPASSE y REJAP</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="certificado_sipasse_rejap" value="no" <?php echo e($documentacion->certificado_sipasse_rejap == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="certificado_sipasse_rejap" value="si" <?php echo e($documentacion->certificado_sipasse_rejap == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="cas" class="form-control-label">Calificación de Años de Servicio</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" id="cas" name="cas" accept="application/pdf">
                                                </div>
                                                    <?php if($documentacion->cas): ?>
                                                       <a href="<?php echo e(asset('documentos_empleados/' . $documentacion->cas)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>

                                        <p class="text-uppercase text-sm">VACACIONES Y LICENCIAS</p>
                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="licencias" class="form-control-label">Licencias</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="licencias" value="no" <?php echo e($documentacion->licencias == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="licencias" value="si" <?php echo e($documentacion->licencias == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="vacaciones" class="form-control-label">Vacaciones</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="vacaciones" value="no" <?php echo e($documentacion->vacaciones == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="vacaciones" value="si" <?php echo e($documentacion->vacaciones == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group d-flex">
                                                <div class="col-md-6">
                                                    <label for="lactancia" class="form-control-label">Lactancia</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex">
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio1" name="lactancia" value="no" <?php echo e($documentacion->lactancia == 'no' ? 'checked' : ''); ?>>NO
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </div>
                                                        <div class="form-check d-block">
                                                            <input type="radio" class="form-check-input" id="radio2" name="lactancia" value="si" <?php echo e($documentacion->lactancia == 'si' ? 'checked' : ''); ?>>SI
                                                            <label class="form-check-label" for="radio2"></label>
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
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/documentacion/edit.blade.php ENDPATH**/ ?>