<table class="table">
    <thead>
        <tr>
            <th colspan="<?php echo e($diasEnMes + 14); ?>" style="text-align: center; font-size: 20px; font-weight: bold; border: 1px solid black;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="<?php echo e($diasEnMes + 14); ?>" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black;">PLANILLA DE REFRIGERIOS</th>
        </tr>
        <tr>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA">N°</th>
            <?php if($tipo_cargo=='ITEM'): ?>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA">ITEM</th>
            <?php endif; ?>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:300px; border: 1px solid black; font-weight: bold; text-align: center;">APELLIDOS NOMBRES</th>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:150px; border: 1px solid black; font-weight: bold; text-align: center;">CARGO</th>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:99px; border: 1px solid black; font-weight: bold; text-align: center;">C.I.</th>
            <?php $__currentLoopData = $diasLiteral; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td bgcolor="#CCC0DA" style="border: 1px solid black; font-weight: bold; text-align: center;"><?php echo e($dia); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">DIAS HABILES TRABAJADOS</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> FALTAS</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> ABANDONO</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> VACACION</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> LCGH</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> LSGH</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> ASUETO</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> VIATICOS</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;"> FERIADOS</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:75px; border: 1px solid black; font-weight: bold; text-align: center;"> IMPORTE DIARIO</th>
            <th rowspan="2" bgcolor="#CCC0DA" style="width:100px; border: 1px solid black; font-weight: bold; text-align: center;"> TOTAL A PAGAR</th>
        </tr>
        <tr>
            <?php for($i = 1; $i <= $diasEnMes; $i++): ?>
                <th bgcolor="#CCC0DA" style="border: 1px solid black; font-weight: bold; text-align: center;"><?php echo e($i); ?></th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $reporteMensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center" style="border: 1px solid black; text-align: center;"><?php echo e($key+1); ?></td>
                <?php if($tipo_cargo=='ITEM'): ?>
                <td class="text-center" style="border: 1px solid black;"><?php echo e($item->empleado->cargo[0]->nro_item); ?></td>
                <?php endif; ?>
                <td class="text-center" style="border: 1px solid black;"><?php echo e($item->empleado->ap_paterno); ?> <?php echo e($item->empleado->ap_materno); ?> <?php echo e($item->empleado->nombres); ?></td>
                <td class="text-center" style="border: 1px solid black;"><?php echo e($item->empleado->cargo[0]->nombre); ?></td>
                <td class="text-center" style="border: 1px solid black;"><?php echo e($item->empleado->ci); ?></td>
                <?php for($i = 1; $i <= $diasEnMes; $i++): ?>
                
                <td style="border: 1px solid black; text-align: center;
                    <?php if($item->$i != 'X' && $item->$i != '' && $item->$i != 'Fse' && $item->$i != 'FE'): ?> 
                        background-color: #E6B8B7 
                    <?php else: ?>
                        <?php if($item->$i == 'Fse'): ?> 
                        background-color:#C4D79B
                        <?php else: ?>
                        <?php if($item->$i == 'FE'): ?>
                        background-color:#FCD5B4
                        <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?> ">
                    <?php if($item->$i != 'Fse'): ?><?php echo e($item->$i); ?> <?php endif; ?>
                </td>
                <?php endfor; ?>
                <th style="border: 1px solid black;"><?php echo e($item->dias_trabajados); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->faltas); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->abandono); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->vacacion); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->lcgs); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->lsgs); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->asueto); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->viaticos); ?></th>
                <th style="border: 1px solid black;"><?php echo e($item->feriado); ?></th>
                <th style="border: 1px solid black;">17</th>
                <th style="border: 1px solid black;"> <?php echo e($item->dias_trabajados * 17); ?></th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/planillas/xls/planilla_refrigerios.blade.php ENDPATH**/ ?>