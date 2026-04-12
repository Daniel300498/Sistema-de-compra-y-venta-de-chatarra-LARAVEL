

<?php $__env->startSection('titulo','Comisión'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Comision</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Comisión</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            <?php if(auth()->user()->rol[0]->id==1): ?>
            <h5 class="card-title">Agregar documento</h5>
            <!--CONTENIDO -->
            <h6  class="mt-0 text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
            <hr >
            <form action="<?php echo e(route('comisiones.store')); ?>" method="POST" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

             <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
               <div class="row">
                 <div class="col-lg-4">
                   <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                       <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" maxlength="8" value="<?php echo e(old('fecha_inicio')); ?>"  required>
                       <?php if($errors->has('fecha_inicio')): ?>
                           <span class="text-danger">
                               <?php echo e($errors->first('fecha_inicio')); ?>

                           </span>
                       <?php endif; ?>
                 </div>
                 <div class="col-lg-4">
                   <?php echo e(Form::label('fecha_fin','Fecha Fin')); ?> <span class="text-danger">(*)</span>
                       <input id="fecha_fin" type="date" class="form-control <?php echo e($errors->has('fecha_fin') ? ' error' : ''); ?>" name="fecha_fin" maxlength="8" value="<?php echo e(old('fecha_fin')); ?>"  required >
                       <?php if($errors->has('fecha_fin')): ?>
                           <span class="text-danger">
                               <?php echo e($errors->first('fecha_fin')); ?>

                           </span>
                       <?php endif; ?>
                 </div>
                 <div class="col-lg-4">
                   <?php echo e(Form::label('tipo','Tipo Jornada' )); ?> <span class="text-danger">(*)</span>
                   <select name="tipo_jornada" class="form-control" required id="tipo_jornada" Onchange = "mostrar('num')">
                     <option value="" selected>-- SELECCIONE --</option>
                     <option value="1">Jornada Laboral</option>
                     <option value="2" >Jornada No Laboral</option>
                   </select>
               </div>
              
 
               </div>
               <br>
               <div class="row">
                 <div class="col-lg-4">
                   <?php echo e(Form::label('','Tipo Comision' )); ?> <span class="text-danger">(*)</span>
                   <select name="tipo_comision" class="form-control" required id="tipo_comision">
                     <option value="" selected>-- SELECCIONE --</option>
                     <option value="1">Misma Cede</option>
                     <option value="2" >Distinta Cede</option>
                     <option value="3" >Exterior</option>
                   </select>
               </div>
                 
                 <div class="col-lg-4"style="display: none" id="bloque">
                   <label for="hora_entrada" style="display: none" id="label">Hora Entrada<span class="text-danger">(*)</span></label>
                   <input id="hora_entrada" type="time" class="form-control <?php echo e($errors->has('hora_entrada') ? ' error' : ''); ?>" name="hora_entrada" value="<?php echo e(old('hora_entrada')); ?>"  required >
                   <?php if($errors->has('hora_entrada')): ?>
                       <span class="text-danger">
                           <?php echo e($errors->first('hora_entrada')); ?>

                       </span>
                   <?php endif; ?>
                 </div>
                 <div class="col-lg-4"style="display: none" id="bloque1">
                   <label for="hora_salida" style="display: none" id="label1">Hora Salida<span class="text-danger">(*)</span></label>
                   <input id="hora_salida" type="time" class="form-control <?php echo e($errors->has('hora_salida') ? ' error' : ''); ?>" name="hora_salida" value="<?php echo e(old('hora_salida')); ?>"  required >
                   <?php if($errors->has('hora_salida')): ?>
                       <span class="text-danger">
                           <?php echo e($errors->first('hora_salida')); ?>

                       </span>
                   <?php endif; ?>
                 </div>
 
               </div>
             <div class="text-center mt-3">
                 <button type="submit" class="btn btn-primary">Guardar</button>
                 <a href="<?php echo e(route('declaraciones.index')); ?>" class="btn btn-warning">Salir</a>
             </div>
          </form>
          <br>
            <?php endif; ?>
           
         <?php if(count($comision)>0): ?>
         <div class="d-flex align-items-center justify-content-between">
          <h4 class="text-center">Comisiones Registrados</h4>
         
        </div>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
             
              <th class="text-center">Nombre Empleado</th>
              <th class="text-center">Tipo Jornada</th>
              <th class="text-center">Tipo Comision</th>
              <th class="text-center">Opciones</th>
            </tr>
            <?php $__currentLoopData = $comision; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                
                <td><center><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></center></td>
                <?php
                switch ($document->tipo_jornada) {
                        case "1":
                        $tipo="Jornada Laboral";
                        break;
                        case "2":
                        $tipo="Jornada No Laboral";
                        break;
                }
                ?>
                <td><center><?php echo e($tipo); ?></center></td>
                <?php
                switch ($document->tipo_comision) {
                        case "1":
                        $tipo1="Misma Cede";
                        break;
                        case "2":
                        $tipo1="Distinta Cede";
                        break;
                        case "3":
                        $tipo1="Exterior";
                        break;
                }
                ?>
                <td class="text-center"><?php echo e($tipo1); ?></td>
                <td class="d-flex align-items-center justify-content-center">
                  <a href="<?php echo e(route('comisiones.show',$document->id)); ?>" class="btn btn-info" title="Ver ficha" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                  <?php if(auth()->user()->rol[0]->id==1): ?>
                  <a href="<?php echo e(route('comisiones.edit',$document->id)); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>  
                  <?php endif; ?>
                  <a href="<?php echo e(route('comisiones.ficha',$document->id)); ?>" class="btn btn-success" title="Subir informe de actividades desarrolladas"><i class="bi bi-vector-pen"></i></a>
                  <?php if(auth()->user()->rol[0]->id==1): ?>
                  <?php echo Form::open(['route'=>['comisiones.destroy',$document->id],'method'=>'DELETE']); ?>

                  <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar al empleado?');"><i class="bi bi-trash"></i></button>
                  <?php echo Form::close(); ?>

                      
                  <?php endif; ?>
                
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        <?php endif; ?>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    <script>
      function mostrar(num) {
      var x = $("#tipo_jornada").val();
      if ( x==2 ) {
           $("#hora_entrada").show();
           $("#hora_entrada").prop("required", true);
           $("#hora_salida").show();
           $("#hora_salida").prop("required", true);
           var el = document.getElementById("bloque");
           el.setAttribute("style", "display:block");
           var el1 = document.getElementById("label");
           el1.setAttribute("style", "display:block");
           var el2 = document.getElementById("bloque1");
           el2.setAttribute("style", "display:block");
           var el3 = document.getElementById("label1");
           el3.setAttribute("style", "display:block");
           $("#hora_entrada").removeAttr("required");
           $("#hora_salida").removeAttr("required");
          } else {
           $("#hora_entrada").hide();
           $("#hora_entrada").removeAttr("required");
           $("#hora_salida").hide();
           $("#hora_salida").removeAttr("required");
           var el1 = document.getElementById("label");
           el1.setAttribute("style", "display:none");
           var el2 = document.getElementById("label1");
           el2.setAttribute("style", "display:none");
          } 
      }  
      </script>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/comisiones/create.blade.php ENDPATH**/ ?>