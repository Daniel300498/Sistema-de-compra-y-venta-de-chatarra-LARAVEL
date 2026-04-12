<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reportes</title>
<div class="margin-top">
 
    <table>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="20">
                <br>
                PLANILLA ASIGNACIONES FAMILIARES - <?php echo e($mes); ?> <br>
            </th>   
      </tr>
    </table>
    <br>
      <table style="width:100%;">

        <thead style="border: 1px black">      
          <tr style="background: darkgray;text-align:center; ">
            <th rowspan="3" style="height:25px; vertical-align: middle; text-align:center; font-weight: bold; border: solid;"> Nº </th>
            <th colspan="6"  style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> EMPLEADO(A) </th>
            <th colspan="5" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> BENEFICIARIA </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHA </th>
            <th colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> PRENATAL </th>
            <th colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> LACTANCIA </th>
            <th rowspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> TOTAL <br> (Bs.) </th>
          </tr>
          <tr style="background: darkgray;text-align:center; ">
         
            <th colspan="2" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> C.I. </th>
            <th rowspan="2" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> MATRICULA <br>SEGURO </th>  
           
            <th colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> APELLIDOS Y NOMBRES </th>  
            <th colspan="2" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> C.I. </th>
            <th colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> APELLIDOS Y NOMBRES </th>  
            <th  style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> SOLICITUD </th>
            <th colspan="2" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHA </th>
            <th></th>
            <th colspan="2" style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHA </th>
            <th></th>
          </tr>
          <tr style="background: darkgray;text-align:center; ">
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> -------N°---- </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> LUGAR </th> 

            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AP. PATERNO </th>  
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AP. MATERNO</th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> NOMBRES</th>
  
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> N° </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> LUGAR </th> 
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AP. PATERNO </th>  
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AP. MATERNO</th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> NOMBRES</th>
  
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> c/NOTA </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> INICIO </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FINAL </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> <?php echo e($mes); ?> </th>
  
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> INICIO </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FINAL </th>
            <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> <?php echo e($mes); ?>  </th>
          </tr>
        </thead>


        <tbody>
          <?php if(count($lactancias) > 0): ?>
          <?php $__currentLoopData = $lactancias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lactancia_object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
          <tr>
            <th style="height:30px; text-align:center; vertical-align: middle; border:solid;"><?php echo e($index +1); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ci); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ci_lugar); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->matricula_lactancia->codigo); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ap_paterno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ap_materno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->nombres); ?></th>
            <?php if($lactancia_object->beneficiaria_lactancia == null): ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ci); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ci_lugar); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ap_paterno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->ap_materno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->empleado->nombres); ?></th>
            <?php else: ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->beneficiaria_lactancia->ci); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->beneficiaria_lactancia->ci_lugar); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->beneficiaria_lactancia->ap_paterno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->beneficiaria_lactancia->ap_materno); ?></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($lactancia_object->beneficiaria_lactancia->nombres); ?></th>
          <?php endif; ?>
     
          <?php if($lactancia_object->inicio_lactancia == $licencia_prenatal->id): ?>
          <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_inicio_prenatal))); ?></th>
  
            <?php $__currentLoopData = $lactancia_object->mensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($mensual->mes == 5): ?>
                <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('m/y', strtotime($mensual->fecha_firma))); ?></th>
              <?php endif; ?>
              <?php if($mensual->mes == 9): ?>
                <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('m/y', strtotime($mensual->fecha_firma))); ?></th>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th style="text-align:center; vertical-align: middle; border:solid;">1</th>
            <th style="text-align:center; vertical-align: middle; border:solid;"></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"></th>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(number_format($bono_lactancia->valor, 2, '.', ',')); ?></th>
          <?php else: ?>
            <?php if($lactancia_object->inicio_lactancia == $licencia_postnatal->id): ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_inicio_postnatal))); ?></th>

              <th style="text-align:center; vertical-align: middle; border:solid;"></th>
              <th style="text-align:center; vertical-align: middle; border:solid;"></th>
              <th style="text-align:center; vertical-align: middle; border:solid;"></th>
              <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('m/y', strtotime($lactancia_object->fecha_inicio_postnatal))); ?></th>
              <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_fin_postnatal))); ?></th>
              <th style="text-align:center; vertical-align: middle; border:solid;">1</th>
              <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e(number_format($bono_lactancia->valor, 2, '.', ',')); ?></th>
              <?php endif; ?>
          <?php endif; ?>
          
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="19">
            No se encontraron registros de las fechas ingresadas
         </th> 
         
          <?php endif; ?>
            
        </tbody>
        <tfoot>
          <tr>
            <th colspan="19" style="background: darkgray;text-align:center; font-weight: bold; font-size: 10px; vertical-align: middle; border:solid;"> TOTAL</th>
            <th style="font-size: 10px; font-weight: bold; background: darkgray; text-align:center; vertical-align: middle; border:solid;" ><?php echo e(number_format((count($lactancias) * $bono_lactancia->valor), 2, '.', ',')); ?></th>
          </tr>
        </tfoot>

      </table>
          
      <table style="width:100%;">
        <tr class="items">
          <th></th>
          <th style="width: 50%;  text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; border:none;" colspan="20">
                  Reporte fechas: <?php echo e(date('d-m-Y', strtotime($fecha_inicio))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha_fin))); ?> 
              </th> 
      </tr>
      </table>
      <?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/pdf/reporte_excel.blade.php ENDPATH**/ ?>