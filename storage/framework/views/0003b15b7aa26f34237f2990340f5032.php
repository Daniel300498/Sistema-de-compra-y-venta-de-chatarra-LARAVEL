<?php $__env->startSection('titulo','Declaración Jurada'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>DECLARACIONES JURADAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Reporte Contraloria</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reporte de Declaraciones Juradas</h5>
            <p>Para generar el reporte debe rellenar todos los campos y dependiendo del formato que desee presionar el botón <strong>GENERAR PDF</strong> o <strong>GENERAR EXCEL</strong>.</p>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('reporte_contraloria_pdf')); ?>" method="POST" enctype="multipart/form-data" id="formulario_reporte">
            <?php echo e(csrf_field()); ?>

            
              <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-4" >
                    <?php echo e(Form::label('tipo','Tipo Declaración' )); ?> <span class="text-danger">(*)</span>
                    <select name="tipo" class="form-control <?php echo e($errors->has('tipo') ? ' error' : ''); ?>">
                      <option value="" selected>-- SELECCIONE --</option>
                      <option value="1">Por Asumir</option>
                        <option value="2" >Por Actualización</option>
                        <option value="3">Después Del Ejercicio Del Cargo</option>
                    </select>
                    <?php if($errors->has('tipo')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('tipo')); ?>

                      </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4" >
                  <?php echo e(Form::label('trimestre','Trimestre' )); ?> <span class="text-danger">(*)</span>
                  <select name="trimestre" class="form-control <?php echo e($errors->has('trimestre') ? ' error' : ''); ?>">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Primer Trimestre</option>
                      <option value="2" >Segundo Trimestre</option>
                      <option value="3">Tercer Trimestre</option>
                      <option value="4">Cuarto Trimestre</option>
                  </select>
                  <?php if($errors->has('trimestre')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('trimestre')); ?>

                      </span>
                    <?php endif; ?>
              </div>
                <div class="col-lg-4" >
                  <?php echo e(Form::label('gestion','Gestion' )); ?> <span class="text-danger">(*)</span>
                  <?php
                  $cont = date('Y');
                  ?>
                  <select id="sel1" class="form-control <?php echo e($errors->has('gestion') ? ' error' : ''); ?>" name="gestion">
                  <?php while ($cont >= 2019) { ?>
                    <option value="<?php echo($cont); ?>" <?php echo e(old('gestion')==$cont ? 'selected' :''); ?>><?php echo($cont); ?></option>
                  <?php $cont = ($cont-1); } ?>
                  </select>
                  <?php if($errors->has('gestion')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('gestion')); ?>

                      </span>
                    <?php endif; ?>
              </div>
              </div>         
            <div class="text-center mt-3">
                
              <button type="submit" class="btn btn-primary" name="boton1">Generar PDF</button>
              <button type="submit" class="btn btn-danger" name="boton2" >Generar Excel</button>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<script>
  document.getElementById('formulario_reporte').addEventListener('submit', function(e) {
    if(e.submitter.name == "boton1"){
      var  a=document.getElementById("formulario_reporte").action = "<?php echo e(route('reporte_contraloria_pdf')); ?>"; 
    }else{
      var  b=document.getElementById("formulario_reporte").action = "<?php echo e(route('reporte_contraloria_excel')); ?>"; 
    }

  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/consultas/reporte_create_pdf.blade.php ENDPATH**/ ?>