<?php $__env->startSection('titulo','MIS MEMORANDUMS'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>MIS MEMORANDUMS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Inicio</a></li>
        <li class="breadcrumb-item active">Memorandums</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Mis Memorandums</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <?php if(count($memorandums)>0): ?>
                <table class="table table-hover table-bordered table-sm" id="datos">
                    <thead>
                      <tr>
                        <th class="text-center">Tipo Memorandum</th>
                        <th class="text-center">Fecha Registro</th>
                        <th class="text-center">Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $memorandums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($memo->tipo_memorandum->descripcion); ?></td>
                            <td class="text-center"><?php echo e(date('d/m/Y',strtotime($memo->fecha_emision))); ?></td>
                            <td class="text-center"><a href="<?php echo e(route('memorandums.show', $memo->id)); ?>" class="btn btn-success btn-sm" target="_blank">Ver Memorandum</a></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                <?php else: ?>
                  <h3>
                    NO TIENE MEMORANDUMS ASIGNADOS.
                  </h3>
                <?php endif; ?>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/memorandums/mis_memos.blade.php ENDPATH**/ ?>