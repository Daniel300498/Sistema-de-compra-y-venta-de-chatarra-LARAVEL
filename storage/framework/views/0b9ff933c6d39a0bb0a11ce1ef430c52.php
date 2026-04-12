<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reportes</title>
<div class="margin-top">
  <style>
    .page-break{
      page-break-after: always
    }
    #footer{
      position: fixed;
      bottom: 0cm;
      left: 0cn;
      width: 100%;
      font-size: 8;
      color: black
    }

 th{
  font-size: 10;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}
  
  </style>  


    <table style="width:100%; font-size:10">
      <tr class="items">
        <th style="width: 20%; text-align:center; border:none; font-size:10px; font-weight:bold;" >
           <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
           <br>
           SUCURSAL LA PAZ 
        </th>
            <th style="width: 60%;  text-align:center; font-size:20px; font-weight: bold; border:none">
                DIRECCIÓN DE RECURSOS HUMANOS <br>
                PLANILLA ASIGNACIONES FAMILIARES <br>
                MES: <?php echo e($mes); ?> <br>
            </th> 
          <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
            Fecha <br>
            
            <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="<?php echo e(date('d-m-Y')); ?>">
          </th> 
    </tr>
    </table>

    <br>
    
      <table style="width:100%;">
      <thead>      
        <tr style="background: darkgray;text-align:center; font-size: 5px; ">
          <th rowspan="3" style="height:25px; font-size:10px font-weight:bold;"> Nº </th>
          <th colspan="6"  style="font-size: 10px; font-weight:bold;"> EMPLEADO(A) </th>
          <th colspan="5" style="font-size: 10px; font-weight:bold;"> BENEFICIARIA </th>
          <th style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> PRENATAL </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> LACTANCIA </th>
          <th rowspan="3" style="font-size: 10px; font-weight:bold;"> TOTAL <br> (Bs.) </th>
        </tr>
        <tr style="background: darkgray;text-align:center; ">
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> C.I. </th>
          <th rowspan="2" style="font-size: 10px; font-weight:bold;"> MATRICULA <br>SEGURO </th>  
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> APELLIDOS Y NOMBRES </th>  

          <th colspan="2" style="font-size: 10px; font-weight:bold;"> C.I. </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> APELLIDOS Y NOMBRES </th>  
          <th  style="font-size: 10px; font-weight:bold;"> SOLICITUD </th>
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th></th>
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th></th>
        </tr>
        <tr style="background: darkgray;text-align:center; ">
          
          <th style="font-size: 10px; font-weight:bold;"> N° </th>
          <th style="font-size: 10px; font-weight:bold;">LUGAR</th> 
          
          <th style="font-size: 10px; font-weight:bold;"> AP. PATERNO </th>  
          <th style="font-size: 10px; font-weight:bold;"> AP. MATERNO</th>
          <th style="font-size: 10px; font-weight:bold;"> NOMBRES</th>

          <th style="font-size: 10px; font-weight:bold;"> N° </th>
          <th style="font-size: 10px; font-weight:bold;">LUGAR</th> 
          <th style="font-size: 10px; font-weight:bold;"> AP. PATERNO </th>  
          <th style="font-size: 10px; font-weight:bold;"> AP. MATERNO</th>
          <th style="font-size: 10px; font-weight:bold;"> NOMBRES</th>

          <th style="font-size: 10px; font-weight:bold;"> c/NOTA </th>
          <th style="font-size: 10px; font-weight:bold;"> INICIO </th>
          <th style="font-size: 10px; font-weight:bold;"> FINAL </th>
          <th style="font-size: 10px; font-weight:bold;"> <?php echo e($mes); ?> </th>

          <th style="font-size: 10px; font-weight:bold;"> INICIO </th>
          <th style="font-size: 10px; font-weight:bold;"> FINAL </th>
          <th style="font-size: 10px; font-weight:bold;"> <?php echo e($mes); ?>  </th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($lactancias) > 0): ?>
        <?php $__currentLoopData = $lactancias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lactancia_object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <tr>
          <th style="height:30px;"><?php echo e($index +1); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ci); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ci_lugar); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->matricula_lactancia->codigo); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ap_paterno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ap_materno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->nombres); ?></th>
          <?php if($lactancia_object->beneficiaria_lactancia == null): ?>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ci); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ci_lugar); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ap_paterno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->ap_materno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->empleado->nombres); ?></th>
        <?php else: ?>
          <th style="font-size: 10px"><?php echo e($lactancia_object->beneficiaria_lactancia->ci); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->beneficiaria_lactancia->ci_lugar); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->beneficiaria_lactancia->ap_paterno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->beneficiaria_lactancia->ap_materno); ?></th>
          <th style="font-size: 10px"><?php echo e($lactancia_object->beneficiaria_lactancia->nombres); ?></th>

        <?php endif; ?>

        <?php if($lactancia_object->inicio_lactancia == $licencia_prenatal->id): ?>
        <th style="font-size: 10px"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_inicio_prenatal))); ?></th>

          <?php $__currentLoopData = $lactancia_object->mensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($mensual->mes == 5): ?>
              <th style="font-size: 10px"><?php echo e(date('m/y', strtotime($mensual->fecha_firma))); ?></th>
            <?php endif; ?>
            <?php if($mensual->mes == 9): ?>
              <th style="font-size: 10px"><?php echo e(date('m/y', strtotime($mensual->fecha_firma))); ?></th>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <th style="font-size: 10px">1</th>
          <th></th>
          <th></th>
          <th></th>
          <th style="font-size: 10px"><?php echo e(number_format($bono_lactancia->valor, 2, '.', ',')); ?></th>
        <?php else: ?>
          <?php if($lactancia_object->inicio_lactancia == $licencia_postnatal->id): ?>
          <th style="font-size: 10px"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_inicio_postnatal))); ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="font-size: 10px"><?php echo e(date('m/y', strtotime($lactancia_object->fecha_inicio_postnatal))); ?></th>
            <th style="font-size: 10px"><?php echo e(date('d/m/y', strtotime($lactancia_object->fecha_fin_postnatal))); ?></th>
            <th style="font-size: 10px">1</th>
            <th style="font-size: 10px"><?php echo e(number_format($bono_lactancia->valor, 2, '.', ',')); ?></th>

            <?php endif; ?>
        <?php endif; ?>
        
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
          No se encontraron registros de las fechas ingresadas
       </th> 
       
        <?php endif; ?>
          
      </tbody>
      <tfoot>
        <tr>
          <th colspan="19" style="background: darkgray;text-align:center; font-size: 10px; font-weight:bold;"> TOTAL</th>
          <th style="font-size: 10px; font-weight: bold; background: darkgray;" ><?php echo e(number_format((count($lactancias) * $bono_lactancia->valor), 2, '.', ',')); ?></th>
        </tr>
      </tfoot>
      </table >
   
  

      
      <br>
      <table style="width:100%; font-size:10">
        <tr class="items">
          <th style="width: 20%; border:none"></th>
              <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none">
                  Reporte fechas: <?php echo e(date('d-m-Y', strtotime($fecha_inicio))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha_fin))); ?> <br>
              </th> 
          <th style="width: 20%; border:none"></th> 
      </tr>
      </table><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/pdf/reporte_pdf.blade.php ENDPATH**/ ?>