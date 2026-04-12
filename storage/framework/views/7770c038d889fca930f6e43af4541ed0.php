
<?php $__env->startSection('titulo', 'REPORTE'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
<div class="d-flex flex-row align-items-center justify-content-between">
   <div>
    <h1>REPORTE</h1>
         <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Reporte</li>
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
                    <h5 class="card-title">Generar Reporte</h5>
                    <p>Para sacar el reporte de todas las &aacute;reas en general, deje en "<strong>--SELECCIONE--</strong> el filtro de &aacute;reas </p>
                    <form action="<?php echo e(route('documentos.consulta')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                       
                        <div class="row mb-3">
                            <label for="area_trabajo" class="col-sm-4 text-right">&Aacute;reas</label>
                            <div class="col-sm-4">
                                <select name="area_trabajo" id="area_trabajo" class="form-control">
                                    <option value="">--SELECCIONE--</option>
                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($area->nombre); ?>"><?php echo e($area->nombre); ?></option>    
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
<?php if(count($reportes)>0): ?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informaci&oacute;n registrada de los Funcionarios</h5>
                    <?php if($area_trabajo): ?>
                    <h4 class="text-center">REPORTE DEL AREA: <?php echo e($area_trabajo); ?></h4>
                    <?php else: ?> 
                    <h4 class="text-center">REPORTE GENERAL</h4>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Apellidos Y Nombres</th>
                                    <th>C.I.</th>
                                    <th>Cargo</th>
                                    <th>Certificado Aymara</th>
                                    <th> Lugar de Emision</th>                                    
                                </tr>
                                <tr>                 
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reportes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($registro->empleado): ?>
                                        <td><?php echo e($registro->empleado->ap_paterno); ?> <?php echo e($registro->empleado->ap_materno); ?> <?php echo e($registro->empleado->nombres); ?></td>                                        
                                        <td><?php echo e($registro->empleado->ci); ?> <?php echo e($registro->empleado->ci_complemento); ?> <?php echo e($registro->empleado->ci_lugar); ?></td>
                                        <td><?php echo e($registro->cargo->nombre); ?></td>
                                        <?php else: ?>
                                        <td></td>
                                        <td></td>
                                        <?php endif; ?>
                                        <?php if($registro->empleado->documentacion->certificado_aymara): ?>
                                        <td>SI</td>
                                        <td><?php echo e($registro->empleado->documentacion->emitido_por); ?></td>
                                        <?php else: ?>
                                        <td>NO</td>  
                                        <td></td>                                         
                                        <?php endif; ?>
                             
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/documentacion/consulta_index.blade.php ENDPATH**/ ?>