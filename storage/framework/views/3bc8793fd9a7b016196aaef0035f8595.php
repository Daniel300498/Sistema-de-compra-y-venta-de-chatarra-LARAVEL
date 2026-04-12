<?php $__env->startSection('titulo','Asistencia Empleado'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Asistencia Empleado</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Asistencia Empleados</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Seleccione al empleado y rango de fechas para obtener sus marcaciones</h5>
                    </div>
                    <!-- CONTENIDO -->
                    
                    
                    <form action="<?php echo e(route('asistencias.show')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row mb-1">
                            <label for="empleado" class="col-md-4 col-form-label text-right">Empleado: <span class="text-danger">(*)</span></label>
                            <div class="col-md-8">
                                <select name="empleado_id" id="empleado_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($e->id); ?>"><?php echo e($e->ci); ?> - <?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="fecha_inicio" class="col-md-4 col-form-label text-right">Fecha Desde: <span class="text-danger">(*)</span></label>
                            <div class="col-md-4">
                                <input type="date" name="fecha_inicio" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="fecha_fin" class="col-md-4 col-form-label text-right">Fecha Hasta: <span class="text-danger">(*)</span></label>
                            <div class="col-md-4">
                                <input type="date" name="fecha_fin" class="form-control" id="">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ver Marcaciones</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($reporteEmpleado != null): ?>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Reporte de Asistencia Desde <?php echo e(date('d/m/Y',strtotime($fecha_inicio))); ?> Hasta <?php echo e(date('d/m/Y',strtotime($fecha_fin))); ?> </h5>
                <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <h6 class="text-danger">Total Minutos de Retraso <?php echo e($totalMinutosRetraso); ?></h6>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Marcaciones</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Resúmen Por Día</a>
                </li>
              </ul>
              <div class="tab-content pt-5" id="tab-content">
                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Dia</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Hora <br>Registrada</th>
                                    <th class="text-center">Horario</th>
                                    <th class="text-center">Entrada <br> Turno</th>
                                    <th class="text-center">Salida <br>Turno</th>
                                    <th class="text-center">Minutos <br> Retraso</th>
                                    <th class="text-center">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $marcaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr >
                                        <td class="text-center"><?php echo e($item->dia_semana); ?></td>
                                        <?php if($item->es_feriado==true): ?>
                                            <td class="text-center" style="background-color: #FCD5B4;"><?php echo e(date('d/m/Y',strtotime($item->checkTime))); ?></td>
                                            <td class="text-center" style="background-color: #FCD5B4;" colspan="6">FERIADO</td>
                                        <?php else: ?>
                                            <td class="text-center"><?php echo e(date('d/m/Y',strtotime($item->checkTime))); ?></td>
                                            <td class="text-center"><?php echo e(date('H:i:s',strtotime($item->checkTime))); ?></td>
                                            <td class="text-center"><?php echo e($item->estado); ?></td>
                                            <td class="text-center"><?php echo e($item->startTime); ?></td>
                                            <td class="text-center"><?php echo e($item->endTime); ?></td>
                                            <td class="text-center"><?php if($item->retrasoMinutos> 0): ?> <strong class="text-danger"><?php echo e($item->retrasoMinutos); ?> min.</stro> <?php else: ?> -- <?php endif; ?> </td>
                                            <td class="text-ce"><?php echo e($item->tipo_falta); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Dia</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">OS</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">V</th>
                                    <th class="text-center">C</th>
                                    <th class="text-center">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reporteEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($item['feriado']==true): ?>
                                            <td class="text-center" style="background-color: #FCD5B4;"><?php echo e($item['dia']); ?></td>
                                            <td class="text-center" style="background-color: #FCD5B4;"><?php echo e(date('d/m/Y',strtotime($item['fecha']))); ?></td>
                                            <td class="text-center" style="background-color: #FCD5B4;" colspan="5">FERIADO</td>
                                        <?php else: ?>
                                            <?php if($item['dia']=='D' || $item['dia']=='S'): ?>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e($item['dia']); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e(date('d/m/Y',strtotime($item['fecha']))); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e($item['ordenSalidaOficial']!='' ? $item['ordenSalidaOficial'] : ($item['ordenSalidaParticular'] != '' ? $item['ordenSalidaParticular'] : '')); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e($item['licencias']); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e($item['vacaciones']); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"><?php echo e($item['comisiones']); ?></td>
                                                <td class="text-center" style="background-color: #C4D79B;"></td>
                                            <?php else: ?>
                                            <td class="text-center"><?php echo e($item['dia']); ?></td>
                                                <td class="text-center"><?php echo e(date('d/m/Y',strtotime($item['fecha']))); ?></td>
                                                <td class="text-center"><?php echo e($item['ordenSalidaOficial']!='' ? $item['ordenSalidaOficial'] : ($item['ordenSalidaParticular'] != '' ? $item['ordenSalidaParticular'] : '')); ?></td>
                                                <td class="text-center"><?php echo e($item['licencias']); ?></td>
                                                <td class="text-center"><?php echo e($item['vacaciones']); ?></td>
                                                <td class="text-center"><?php echo e($item['comisiones']); ?></td>
                                                <td class="text-center"><?php echo e($item['inasistencia']); ?></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <p><strong>Aclaraciones:</strong></p>
                        <p>INASISTENCIA SIMPLE : No marco en una entrada</p>
                        <p>ABANDONO SIMPLE : No marco en una salida</p>
                        <p>INASISTENCIA PARCIAL : No marco la ultima salida</p>
                        <p>ABANDONO DOBLE : No marco en ambas salidas</p>
                        <p>INASISTENCIA ABANDONO : En el primer turno Marco entrada, No marco salida; En el segundo Marco solo salida</p>
                        <p>INASISTENCIA TURNO ABANDONO : No marco un turno, y tiene una salida</p>
                        <p>INASISTENCIA TURNO: No marco un turno</p>
                    </div>
                </div>
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
<script>
    $("#empleado_id").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/asistencia/marcaciones/index.blade.php ENDPATH**/ ?>