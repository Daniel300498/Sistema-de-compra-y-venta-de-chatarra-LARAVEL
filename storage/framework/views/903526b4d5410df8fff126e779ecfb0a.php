<br>
<br>
<table >
    <tr>
       <td colspan="2">Señora. <br>
          Lic. Rocio S. Rocabado Gutierrez <br>
          <span style=" font-weight: bold;">DIRECTORA DE RECURSOS HUMANOS</span> <br>
          <span style=" font-weight: bold;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</span><br><br>
          Presente.-
      </td>
       
    </tr>
    <tr>
        <td style="width: 50%; text-align:center" ></td>
        <td> <u style=" width: 50%;font-weight: bold;text-align:left;">REF.: SOLICITUD DE VACACIONES</u></td>
    </tr>
    <tr>
        <td colspan="2">
            <p  style="width: 100%; text-align:justify">
            De mi mayor consideracion: <br><br>
            Mediantes la presente reciba un cordial saludo y exito en la funcion que desempeña
            en bien de nuestra institucion. <br><br>
            El motivo de la presente misiva es para viabilizar la solicitud de vaciones de <span style="font-weight: bold"><?php echo e($dias); ?> dias 
            en fechas <?php echo e($vacacion->fecha_inicio); ?> a <?php echo e($vacacion->fecha_hasta); ?></span>, acuenta de los dias de vacaion disponible segun 
            antiguedad en el numero de item : 250 y segun los siguientes datos: <br><br>
            <span style="font-weight: bold">Nombre:</span> <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?> <br>
            <span style="font-weight: bold">Ci:  </span> <?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_lugar); ?>.<br>
            <span style="font-weight: bold">Nro De Item:  </span><?php echo e($cargo->nro_item); ?> <br>
            <span style="font-weight: bold">Cargo: <?php echo e($cargo->area_nombre); ?> </span> <br><br>
            Sin otro particular me despido con las consideraciones mas distinguidas. <br><br><br>
            Atentamente:<br><br>
            </p>
        </td>
    </tr>
    <tr>
       <td colspan="2" style="width: 100%; text-align:center"><br><br>___________________________________ <br>
        <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?> <br>
        CI.<?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_lugar); ?>

    </td>
       
    </tr>
</table><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/vacaciones/pdf/solicitud_vacacion.blade.php ENDPATH**/ ?>