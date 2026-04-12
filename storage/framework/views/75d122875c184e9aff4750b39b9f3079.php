<p>Puede realizar la búsqueda del funcionario ingresando el número de carnet o fecha en el listado siguiente.</p>


<form action="<?php echo e(route('refrigerios.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row mb-1">
        <label for="fecha" class="col-sm-12 col-md-4 control-label text-right">
            Fecha <span class="text-danger">(*)</span>
        </label>
        <div class="col-sm-12 col-md-8">
            <input id="fecha" type="date" class="form-control <?php echo e($errors->has('fecha') ? ' error' : ''); ?>"name="fecha" value="<?php echo e(old('fecha', isset($area) ? $area->fecha : '')); ?>"onkeyup="this.value = this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        </div>
    </div>
    <div class="row mb-1">
        <label for="tipo_dato" class="col-sm-12 col-md-4 control-label text-right">Tipo Información</label>
        <div class="col-md-4">
            <select name="tipo_dato" id="tipo_dato" class="form-control">
                <option value="">Seleccionar...</option>
                <option value="X" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'X' ? 'selected' : ''); ?>>ASISTENCIA</option>
                <option value="AB" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'AB' ? 'selected' : ''); ?>>ABANDONO</option>
                <option value="BM" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'BM' ? 'selected' : ''); ?>>BAJA MEDICA</option>
                <option value="BP" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'BP' ? 'selected' : ''); ?>>BAJA DE PERSONAL</option>
                <option value="C" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'C' ? 'selected' : ''); ?>>CUMPLEAÑOS</option>
                <option value="LCH" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'LCH' ? 'selected' : ''); ?>>LICENCIA CON HABER</option>
                <option value="LSH" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'LSH' ? 'selected' : ''); ?>>LICENCIA SIN GOCE</option>
                <option value="C" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'C' ? 'selected' : ''); ?>>COMISION</option>
                <option value="F" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'F' ? 'selected' : ''); ?>>FALTA</option>
                <option value="T" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'T' ? 'selected' : ''); ?>>TRANSFERENCIA</option>
                <option value="CL" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'CL' ? 'selected' : ''); ?>>COMPENSACION LABORAL</option>
                <option value="D" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'D' ? 'selected' : ''); ?>>DESCANSO</option>
                <option value="XOS" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'XOS' ? 'selected' : ''); ?>>ORDEN DE SALIDA</option>
                <option value="XHP" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'XHP' ? 'selected' : ''); ?>>HORA PARTICULAR</option>
                <option value="XJM" <?php echo e(old('tipo_dato', $refrigerio->tipo_dato) == 'XJM' ? 'selected' : ''); ?>>JUSTIFICATIVO MEDICO</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
            <a href="<?php echo e(route('refrigerios.index')); ?>" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>
</div>
</div>
</section>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Refrigerios Registrados del funcionario Seleccionado</h5>
                    <p class="mb-0">
                        Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar una &aacute;rea.
                    </p>
                    <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el &aacute;rea que corresponda.</p>
                    
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               <th>Nro Item</th>
                                <th>Sueldo</th>
                                <th>Nro Item</th>
                                <th>Sueldo</th>
                                <th>Dias habiles trabajados</th>
                                <th>Faltas</th>
                                <th>Abandono</th>
                                <th>Vacacion</th>
                                <th>LCGH</th>
                                <th>LSGH</th>
                                <th>Asueto</th>
                                <th>Viaticos</th>
                                <th>Feriados</th>
                                <th>Importe Diario</th>
                                <th>Total a Pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                                <tr>
                                <td><?php echo e($cargoEmpleado->cargo->nro_item); ?></td>
                                <td> <?php echo e($cargoEmpleado->cargo->sueldo); ?></td>
                                <td> <?php echo e($cargoEmpleado->cargo->nro_item); ?></td>
                                <td> <?php echo e($cargoEmpleado->cargo->sueldo); ?></td>
                                <td> <?php echo e($refrigerio->dias_trabajados); ?></td>
                                <td> <?php echo e($refrigerio->faltas); ?></td>
                                <td> <?php echo e($refrigerio->abandono); ?></td>
                                <td> <?php echo e($refrigerio->vacacion); ?></td>
                                <td> <?php echo e($refrigerio->LCH); ?></td>
                                <td> <?php echo e($refrigerio->LSH); ?></td>
                                <td> <?php echo e($refrigerio->ASUETO); ?></td>
                                <td> <?php echo e($refrigerio->VIATICOS); ?></td>
                                <td> <?php echo e($refrigerio->feriado); ?></td>
                                <td> Bs. 17.00</td>
                                <td> Bs. <?php echo e(number_format($refrigerio->dias_trabajados * 17, 2)); ?></td>
                                </tr>
                         </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr><?php $__currentLoopData = $diasArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><th><?php echo e($dia); ?></th><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tr>
                            <tr><?php for($i = 1; $i <= $diasEnElMes; $i++): ?><th><?php echo e($i); ?></th><?php endfor; ?></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $biometricoMensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php for($i = 1; $i <= $diasEnElMes; $i++): ?>
                                        <?php $valor = $registro->{'col_'.$i}; ?>
                                        <td class="<?php echo e($valor == 'X' ? 'bg-success' : 
                                            ($valor == 'F' ? 'bg-danger' : 
                                            ($valor == 'AB' ? 'bg-warning' : ''))); ?>">
                                            <?php echo e($valor); ?>

                                        </td>
                                    <?php endfor; ?>
                                   
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/_form.blade.php ENDPATH**/ ?>