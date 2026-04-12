
<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reporte Vacacion</title>
<div class="margin-top">
   <table >
      <tr> 
              <td colspan="2" style="width: 50%; text-align:center; font-size:20px; font-weight: bold;">
                 REGISTRO DE VACACIONES <br>
              </td> 
      </tr>
      <tr>
         <td>Funcionario: <span style=" font-weight: bold;"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></td>
         <td>Antiguedad:</td>
      </tr>
      <tr>
         <td >Item: <span style=" font-weight: bold;"><?php echo e($cargo->nro_item); ?></span></td>
         <td>Reconocida CAS: <span style=" font-weight: bold;">12/12/2022 5a-0m-24d</span></td>
      </tr>
      <tr>
         <td colspan="2" >Cargo: <span style=" font-weight: bold;"><?php echo e($cargo->nombre); ?></span></td>
      </tr>
      <tr>
         <td>Unidad/Area: <?php echo e($cargo->area_nombre); ?></td>
         <td>Nº Cedula Identidad: <span style=" font-weight: bold;"><?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_lugar); ?>.  </span>
         </td>
      </tr>
      <tr>
         <td colspan="2">Fecha Ingreso:<?php echo e($cargo_empleado->fecha_inicio); ?></td>
      </tr>

  </table>
  <br>
  <table class="title" >
   <tr> 
      <td style="text-align:center;">De fecha</td>
      <td style="text-align:center;">A fecha</td>
      <td style="text-align:center;">Vacacion Reconocida por <br>Gestion</td>
      <td style="text-align:center;">Dias solicitados</td>
      <td style="text-align:center;">Saldo Dias a <br>Favor</td>
      <td style="text-align:center;">Observaciones</td>
           
   </tr>
   <tr>
      <td colspan="2" style="text-align: center;font-weight: bold;">2024</td>
      <?php
          $total_dias_disponibles=$suma_dias+$dias_disponibles->nro_dias_disponibles;
          $saldo_favor_dias=$suma_dias+$dias_disponibles->nro_dias_disponibles;
      ?>
      <td style="text-align: center;font-weight: bold;"><?php echo e($total_dias_disponibles); ?></td>
      <td></td>
     
      <td style="text-align: center;font-weight: bold;"><?php echo e($total_dias_disponibles); ?></td>
      <td></td>
   </tr>
   <?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $va): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <?php
    $saldo_favor_dias=$saldo_favor_dias-$va->nro_dias_solicitados;
   ?>
   <tr>
      <td style="text-align:center;"><?php echo e($va->fecha_inicio); ?></td>
      <td style="text-align:center;"><?php echo e($va->fecha_hasta); ?></td>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"><?php echo e($va->nro_dias_solicitados); ?></td>
      
      <td style="text-align:center;"><?php echo e($saldo_favor_dias); ?></td>
      <td style="text-align:center;"></td>

   </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   

</table>

</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/pdf/ficha.blade.php ENDPATH**/ ?>