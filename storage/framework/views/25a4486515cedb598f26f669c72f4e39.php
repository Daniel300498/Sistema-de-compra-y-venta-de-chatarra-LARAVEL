<?php $__env->startSection('titulo','Planilla de Sueldos'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Planilla de Sueldos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Planillas de Sueldos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Generar Planilla</h5>
           <!--CONTENIDO -->
            <?php echo Form::open(['route'=>'planillas.generar','class'=>'form-horizontal']); ?>

                <div class="row mb-3">
                    <label for="gestion" class="col-sm-4 text-right">Gestión</label>
                    <div class="col-sm-4">
                        <select name="gestion" id="gestion" class="form-control">
                            <option value="">--SELECCIONE--</option>
                            <option value="2024" selected>2024</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mes" class="col-sm-4 text-right">Mes</label>
                    <div class="col-sm-4">
                        <select name="mes" id="mes" class="form-control">
                            <option value="">--SELECCIONE--</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/planillas/index.blade.php ENDPATH**/ ?>