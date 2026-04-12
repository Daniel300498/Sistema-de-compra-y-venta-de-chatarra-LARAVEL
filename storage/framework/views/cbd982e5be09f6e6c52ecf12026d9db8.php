
<?php $__env->startSection('titulo','Inicio'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Inicio</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Inicio</a></li>
        <li class="breadcrumb-item active">Resúmen de Información</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section dashboard">
  <div class="row">
  <div class="col-lg-12">
    <div class="row" >
      <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <!-- Sales Card -->
      <div class="col-xxl-4 col-lg-4 col-md-4" style="height: 100%;">
        <div class="card info-card customers-card" style="height: 100%;">
          <div class="card-body">
            <h5 class="card-title">Nro. <?php echo e($d->tipo_cargo); ?></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <?php if(auth()->user()->rol[0]->id != 4 ^ auth()->user()->rol[0]->id == 9): ?>
                <h6><?php echo e($d->cantidad_empleados); ?></h6>
                <span class="text-success small pt-1 fw-bold"><?php echo e(number_format($d->total_sueldos)); ?></span> <span class="text-muted small pt-2 ps-1">Bs.</span>
               <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xxl-4 col-xl-6 col-md-6">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Total Mujeres</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                 <?php if(auth()->user()->rol[0]->id != 4 ^ auth()->user()->rol[0]->id == 9): ?>
                <h6><?php echo e($mujeres); ?></h6>
                <span class="text-success small pt-1 fw-bold"><?php echo e(number_format($sueldo[0]->total)); ?></span> <span class="text-muted small pt-2 ps-1">Bs.</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-xl-6 col-md-6">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Total Hombres</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                  <?php if(auth()->user()->rol[0]->id != 4 ^ auth()->user()->rol[0]->id == 9): ?>
                <h6><?php echo e($hombres); ?></h6>
                <span class="text-success small pt-1 fw-bold"><?php echo e(number_format($sueldo[1]->total)); ?></span> <span class="text-muted small pt-2 ps-1">Bs.</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <?php if(auth()->user()->rol[0]->id != 4 ^ auth()->user()->rol[0]->id == 9): ?>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Número de empleados por cargo</h5>

        <div class="activity">

          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center"><small>Denominación del Cargo</small></th>
                  <th class="text-center"><small>Haber básico</small></th>
                  <th class="text-center"><small>Cant. Items</small></th>
                  <th class="text-center"><small>Haber Mensual</small></th>
                  <th class="text-center"><small>Salario Anual</small></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($e->nro_empleados > 0): ?>
                  <tr>
                    <td><small><?php echo e($e->cargo); ?> (<?php echo e($e->tipo_cargo); ?>)</small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo)); ?></small></td>
                    <td class="text-center"><small><?php echo e($e->nro_empleados); ?></small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo * $e->nro_empleados)); ?></small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo * $e->nro_empleados*12)); ?></small></td>
                  </tr>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <script >
  $('#datos').DataTable({
        "language": {
            "processing": "Procesando...",
            "lengthMenu": 'Filtrar <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">Todos</option>'+
                '</select> Registros',
            "paginate": {
                "sFirst":    "Primero",
                "sLast":    "Último"
            },
            "info": "Pagina _PAGE_ de _PAGES_",
            "search": "Buscador Gral",
            "emptyTable": "No existen datos registrados.",
            "infoEmpty": "",
        },
        orderCellsTop: true,
        fixedHeader: true,
        ordering: false,
        pageLength: 10
    });</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_rrhh\resources\views/home.blade.php ENDPATH**/ ?>