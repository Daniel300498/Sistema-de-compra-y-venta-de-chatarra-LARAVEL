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



<table style="width:100%; font-size:10">
  <tr class="items">
    <th style="width: 20%; text-align:center; border:none; font-size:10px; font-weight:bold;" >
       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
       <br>
       SUCURSAL LA PAZ 
    </th>
        <th style="width: 60%;  text-align:center; font-size:20px; font-weight: bold; border:none">
            DIRECCIÓN DE RECURSOS HUMANOS <br>
            REPORTE DE LICENCIAS <br>
            FECHAS <?php echo e(date('d-m-Y', strtotime($fecha_desde))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha_hasta))); ?>

        </th> 
      <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
        Fecha <br>
        
        <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="<?php echo e(date('d-m-Y')); ?>">
      </th> 
</tr>
</table>

<br>

<table style="width:100%; font-size:10">
    <tr class="items">
      <?php if($doc_lugar_trabajo == 1): ?>
        <?php if($lugar_trabajo_busqueda != null): ?>
          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
            SEDE: <?php echo e($lugar_trabajo_busqueda->descripcion); ?>

          </th>
        <?php endif; ?>
      <?php endif; ?>
      <?php if($doc_area == 1): ?>
        <?php if($area_busqueda != null): ?>
          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
            AREA: <?php echo e($area_busqueda->nombre); ?>

          </th>
        <?php endif; ?>
      <?php endif; ?>
      <?php if($doc_tipo_licencia == 1): ?>
        <?php if($tipo_licencia_busqueda != null): ?>
          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
            TIPO LICENCIA: <?php echo e($tipo_licencia_busqueda->descripcion); ?>

          </th>
        <?php endif; ?>
      <?php endif; ?>
    </tr>
  </table>

<br>
<table style="width:100%;">
    <thead>      
      <tr style="background: darkgray;text-align:center; font-size: 5px; ">
        <th style="font-size:10px; font-weight:bold"> Nº </th>
        <th style="font-size: 10px; font-weight:bold;"> NOMBRE COMPLETO </th>
        <th style="font-size: 10px; font-weight:bold;"> CI </th>
                          
        <?php if($doc_lugar_trabajo == 0): ?>
        <th style="font-size: 10px; font-weight:bold;"> SEDE </th>
        <?php endif; ?>
        <?php if($doc_area == 0): ?>
        <th style="font-size: 10px; font-weight:bold;"> AREA </th>
        <?php endif; ?>
        <?php if($doc_tipo_licencia == 0): ?>
        <th style="font-size: 10px; font-weight:bold;"> TIPO </th>
        <?php endif; ?>
        <th style="font-size: 10px; font-weight:bold;"> N DIAS </th>
        <th style="font-size: 10px; font-weight:bold;"> MOTIVO </th>
        <th style="font-size: 10px; font-weight:bold;"> FECHAS </th>
        <th style="font-size: 10px; font-weight:bold;"> HORAS </th>
        <th style="font-size: 10px; font-weight:bold;"> ESTADO </th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($info_empleado) > 0): ?>
      <?php $__currentLoopData = $info_empleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $info_empleado_object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
      <tr>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($index +1); ?></th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->empleado->nombres); ?> <?php echo e($info_empleado_object->empleado->ap_paterno); ?> <?php echo e($info_empleado_object->empleado->ap_materno); ?></th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->empleado->ci); ?></th>
        <?php if($doc_lugar_trabajo == 0): ?>
          <?php if($info_empleado_object->empleado->ubicacion!=null): ?>
            <th style="font-size: 10px;  text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->empleado->ubicacion->descripcion); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($doc_area == 0): ?>
          <?php if($info_empleado_object->area_id!=null): ?>
            <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->area_id->nombre); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($doc_tipo_licencia == 0): ?>
          <?php if($info_empleado_object->tipo!=null): ?>
            <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->tipo->descripcion); ?></th>
          <?php else: ?>
            <th></th>
          <?php endif; ?>
        <?php endif; ?>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->numero_dias); ?></th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->motivo); ?></th>
    
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">
          <?php $__currentLoopData = $info_empleado_object->fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
          <?php echo e(date('d-m-Y', strtotime($fecha->fecha_inicio))); ?> al <?php echo e(date('d-m-Y', strtotime($fecha->fecha_hasta))); ?>

          <br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </th>

        <th style="font-size: 10px; text-align:center; vertical-align: middle;">
          <?php $__currentLoopData = $info_empleado_object->fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
            <?php if($fecha->horario == '8'): ?>
             DIA COMPLETO
            <br>
            <?php else: ?>
            MEDIO DIA
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;"><?php echo e($info_empleado_object->estado->descripcion); ?></th>

      
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
        No se encontraron registros de las fechas ingresadas
     </th> 
     
      <?php endif; ?>
        
    </tbody>
    <tfoot>
      <tr></tr>
    </tfoot>
    </table ><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/pdf/reporte_pdf.blade.php ENDPATH**/ ?>