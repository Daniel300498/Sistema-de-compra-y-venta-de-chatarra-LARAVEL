
<?php $__env->startSection('titulo', 'PLANILLA REFRIGERIO'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
<div class="d-flex flex-row align-items-center justify-content-between">
   <div>
    <h1>PLANILLA REFRIGERIO</h1>
         <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Planilla Refrigerio</li>
            </ol>
        </nav>
    </div>
  
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generar Planilla</h5>
                    <form action="<?php echo e(route('refrigerios.consulta')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="gestion" class="col-sm-4 text-right">Gesti&oacute;n</label>
                            <div class="col-sm-4">
                                <select name="gestion" id="gestion" class="form-control" required>
                                    <option value="">--SELECCIONE--</option>
                                    <option value="2024" selected>2024</option>
                                    <option value="2025" selected>2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mes" class="col-sm-4 text-right">Mes</label>
                            <div class="col-sm-4">
                                <select name="mes" id="mes" class="form-control" required>
                                    <option value="enero">Enero</option>
                                    <option value="febrero">Febrero</option>
                                    <option value="marzo">Marzo</option>
                                    <option value="abril">Abril</option>
                                    <option value="mayo">Mayo</option>
                                    <option value="junio">Junio</option>
                                    <option value="julio">Julio</option>
                                    <option value="agosto">Agosto</option>
                                    <option value="septiembre">Septiembre</option>
                                    <option value="octubre">Octubre</option>
                                    <option value="noviembre">Noviembre</option>
                                    <option value="diciembre">Diciembre</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tipo_cargo" class="col-sm-4 text-right">Tipo de Cargo <span class="text-danger">(*)</span></label>
                            <div class="col-sm-4">
                                <select name="tipo_cargo" id="tipo_cargo" class="form-control" required>
                                    <option value="">--SELECCIONE--</option>
                                    <?php $__currentLoopData = $tipo_cargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($tipo->descripcion !== 'PASANTE'): ?>
                                            <option value="<?php echo e($tipo->descripcion); ?>"><?php echo e($tipo->descripcion); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="hidden" name="exportType" id="exportType" value="consulta">
                            <button type="submit" class="btn btn-warning">Generar</button>
                            <button type="submit" class="btn btn-primary" onclick="setExportType('excel')">Generar Excel</button>
                        </div>
                    </form>

                    <script>
                        function setExportType(type) {
                            document.getElementById('exportType').value = type;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($empleados != null): ?>
<?php if(count($biometricoMensual)>0): ?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informaci&oacute;n registrada por d&iacute;a para el refrigerio</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Apellidos y Nombres</th>
                                    <th>Cargo</th>
                                    <th>C.I.</th>
                                    <th>Item</th>
                                    <th>Sueldo</th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.show')): ?>
                                    <?php $__currentLoopData = $diasArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($dia); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <th> DIAS HABILES TRABAJADOS</th>
                                    <th> FALTAS</th>
                                    <th> ABANDONO</th>
                                    <th> VACACION</th>
                                    <th> LCGH</th>
                                    <th> LSGH</th>
                                    <th> ASUETO</th>
                                    <th> VIATICOS</th>
                                    <th> FERIADOS </th>
                                    <th> IMPORTE DIARIO</th>
                                    <th> TOTAL A PAGAR</th>
                                </tr>
                                <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.show')): ?>
                                <?php for($i = 1; $i <= $diasEnElMes; $i++): ?>
                                    <th><?php echo e($i); ?></th>
                                    <?php endfor; ?>
                                    <?php endif; ?>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $biometricoMensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      
                                        <td><?php echo e($registro->ap_paterno); ?> <?php echo e($registro->ap_materno); ?> <?php echo e($registro->nombres); ?> </td>
                                        <td><?php echo e($registro->descripcion); ?></td>
                                        <td><?php echo e($registro->ci); ?></td>
                                        <td><?php echo e($registro->nro_item); ?></td>
                                        <td><?php echo e($registro->sueldo); ?></td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.show')): ?>
                                       <?php for($i = 1; $i <= $diasEnElMes; $i++): ?>
                                            <?php $valor = $registro->{'col_'.$i}; ?>
                                            <td class="<?php echo e($valor == 'X' ? 'bg-success' : 
                                                ($valor == 'F' ? 'bg-danger' : 
                                                ($valor == 'AB' ? 'bg-warning' : ''))); ?>">
                                                <?php echo e($valor); ?>

                                            </td>
                                        <?php endfor; ?>
                                        <?php endif; ?>
                                        <td><?php echo e($registro->dias_trabajados); ?></td>
                                        <td><?php echo e($registro->faltas); ?></td>
                                        <td><?php echo e($registro->abandono); ?></td>
                                        <td><?php echo e($registro->vacacion); ?></td>
                                        <td><?php echo e($registro->LCH); ?></td>
                                        <td><?php echo e($registro->LSH); ?></td>
                                        <td><?php echo e($registro->ASUETO); ?></td>
                                        <td><?php echo e($registro->VIATICOS); ?></td>
                                        <td><?php echo e($registro->feriado); ?></td>
                                        <td>Bs. <?php echo e($monto_pago->valor); ?></td>
                                         <td>Bs. <?php echo e(number_format($registro->dias_trabajados * $monto_pago->valor, 2)); ?></td>
                
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?> 
<h5 class="text-center">NO SE ENCONTR&Oacute; NING&Uacute;N REGISTRO CON LOS FILTROS SELECCIONADOS</h5>
<?php endif; ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/index.blade.php ENDPATH**/ ?>