<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reportes Licencia</title>
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



<table>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">
              DIRECCIÓN DE RECURSOS HUMANOS 
            </th> 
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">REPORTE DE LICENCIAS</th>  
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">FECHAS <?php echo e(date('d-m-Y', strtotime($fecha_desde))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha_hasta))); ?></th>  
      </tr>
      <tr class="items">
      <th style=" text-align:center; font-size:10px; vertical-align: middle; font-weight: bold; " colspan="10">FECHA <?php echo e(date('d-m-Y')); ?></th>  
      </tr>

      <?php if($doc_lugar_trabajo == 1): ?>
        <?php if($lugar_trabajo_busqueda != null): ?>
        <tr class="items">
         <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10">SEDE: <?php echo e($lugar_trabajo_busqueda->descripcion); ?></th>  
        </tr>
        <?php endif; ?>
      <?php endif; ?>
      <?php if($doc_area == 1): ?>
        <?php if($area_busqueda != null): ?>
          <tr class="items">
            <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10"> AREA: <?php echo e($area_busqueda->nombre); ?></th>  
          </tr>
        <?php endif; ?>
      <?php endif; ?>
      <?php if($doc_tipo_licencia == 1): ?>
        <?php if($tipo_licencia_busqueda != null): ?>
          <tr class="items">
          <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10">TIPO LICENCIA: <?php echo e($tipo_licencia_busqueda->descripcion); ?></th>  
          </tr>
        <?php endif; ?>
      <?php endif; ?>
      
</table>





<table style="width:100%;">
    <thead>      
      <tr style="background: darkgray;text-align:center; font-size: 5px; ">
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> Nº </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> NOMBRE COMPLETO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> CI </th>
        <?php if($doc_lugar_trabajo == 0): ?>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> SEDE </th>
        <?php endif; ?>
        <?php if($doc_area == 0): ?>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AREA </th>
        <?php endif; ?>
        <?php if($doc_tipo_licencia == 0): ?>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> TIPO </th>
        <?php endif; ?>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> N DIAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> MOTIVO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> HORAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> ESTADO </th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($info_empleado) > 0): ?>
      <?php $__currentLoopData = $info_empleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $info_empleado_object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
      <tr>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($index +1); ?></th>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->empleado->nombres); ?> <?php echo e($info_empleado_object->empleado->ap_paterno); ?> <?php echo e($info_empleado_object->empleado->ap_materno); ?></th>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->empleado->ci); ?></th>
        <?php if($doc_lugar_trabajo == 0): ?>
          <?php if($info_empleado_object->empleado->ubicacion!=null): ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->empleado->ubicacion->descripcion); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($doc_area == 0): ?>
          <?php if($info_empleado_object->area_id!=null): ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->area_id->nombre); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($doc_tipo_licencia == 0): ?>
          <?php if($info_empleado_object->tipo!=null): ?>
            <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->tipo->descripcion); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->numero_dias); ?></th>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->motivo); ?></th>
    
        <th style="text-align:center; vertical-align: middle; border:solid;">
          <?php $__currentLoopData = $info_empleado_object->fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
          <?php echo e(date('d-m-Y', strtotime($fecha->fecha_inicio))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha->fecha_hasta))); ?>

          <br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </th>

        <th style="text-align:center; vertical-align: middle; border:solid;">
          <?php $__currentLoopData = $info_empleado_object->fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
            <?php if($fecha->horario == '8'): ?>
             DIA COMPLETO
            <br>
            <?php else: ?>
            MEDIO DIA
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </th>
        <th style="text-align:center; vertical-align: middle; border:solid;"><?php echo e($info_empleado_object->estado->descripcion); ?></th>

      
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <tr>
        <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
          No se encontraron registros de las fechas ingresadas
      </th> 
     </tr>
     
      <?php endif; ?>
        
    </tbody>
    <tfoot>
      <tr></tr>
    </tfoot>
    </table ><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/pdf/reporte_excel.blade.php ENDPATH**/ ?>