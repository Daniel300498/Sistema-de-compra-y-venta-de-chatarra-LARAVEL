<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Refrigerio</title>
</head>
<body>
    <?php
        // Calcular el número total de columnas basado en el permiso
        $mostrarDias = Gate::allows('refrigerios.show');
        $totalColumnas = 16 + ($mostrarDias ? count($diasArray) : 0); // 11 columnas fijas + días del mes si el usuario tiene permiso
    ?>

    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <th colspan="<?php echo e($totalColumnas); ?>" style="text-align: center; font-size: 20px; font-weight: bold; border: 1px solid black;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="<?php echo e($totalColumnas); ?>" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black;">PLANILLA DE REFRIGERIOS</th>
        </tr>
        <tr>
            <th colspan="<?php echo e($totalColumnas); ?>" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">
                CORRESPONDIENTE AL MES DE <?php echo e(strtoupper($mes)); ?> - <?php echo e($gestion); ?>

            </th>
        </tr>
        <tbody>
            <?php $__currentLoopData = $biometricoMensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!isset($currentAreaId) || $registro->area_id !== $currentAreaId): ?>
                    <?php if(isset($currentAreaId)): ?>
                        <tr>
                            <td colspan="<?php echo e($totalColumnas); ?>" style="border: none;"></td>
                        </tr>
                    <?php endif; ?>
               
                    <tr>
                        <td colspan="<?php echo e($totalColumnas); ?>" style="text-align: center; font-size: 14px; font-weight: bold; border: 1px solid black;"><?php echo e($registro->area); ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th bgcolor="#e5b8b7" style="border: 1px solid black; font-weight: bold; text-align: center;">ITEM</th>
                       
                        <th bgcolor="#e5b8b7" style="width:600px; border: 1px solid black; font-weight: bold; text-align: center;">APELLIDOS Y NOMBRES</th>
                        <th bgcolor="#e5b8b7" style="width:150px; border: 1px solid black; font-weight: bold; text-align: center;">CARGO</th>
                        <th bgcolor="#e5b8b7" style="width:99px; border: 1px solid black; font-weight: bold; text-align: center;">C.I.</th>
                        
         
                        <?php if($mostrarDias): ?>
                            <?php $__currentLoopData = $diasArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th bgcolor="#e5b8b7" style="width: 30px; border: 1px solid black; font-weight: bold; text-align: center;"><?php echo e($dia); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">DIAS HABILES<br>TRABAJADOS</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">FALTAS</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">ABANDONO</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">VACACION</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">LICENCIA CON<br>GOCE DE HABER</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">LICENCIA SIN<br>GOCE DE HABER</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">ASUETO</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">VIATICOS</th>
                        <th bgcolor="#e5b8b7" style="width:44px; border: 1px solid black; font-weight: bold; text-align: center;">FERIADOS</th>
                        <th bgcolor="#e5b8b7" style="width:75px; border: 1px solid black; font-weight: bold; text-align: center;">IMPORTE <br> DIARIO</th>
                        <th bgcolor="#e5b8b7" style="width:100px; border: 1px solid black; font-weight: bold; text-align: center;">TOTAL A PAGAR</th>
                    </tr>
                    <?php
                        $currentAreaId = $registro->area_id;
                    ?>
                <?php endif; ?>
                <tr>
                    <td></td>
                    <td style="border: 1px solid black;"><?php echo e($registro->nro_item); ?></td>
                    <td style="border: 1px solid black;"><?php echo e($registro->ap_paterno); ?> <?php echo e($registro->ap_materno); ?> <?php echo e($registro->nombres); ?></td>
                    <td style="border: 1px solid black;"><?php echo e($registro->descripcion); ?></td>
                    <td style="border: 1px solid black;"><?php echo e($registro->ci); ?></td>
                    
                 

                    <?php if($mostrarDias): ?>
                        <?php $__currentLoopData = range(1, $diasEnElMes); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $valor = $registro->{'col_'.$i}; ?>
                            <td style="border: 1px solid black; text-align: center;
                                <?php if($valor == 'X'): ?> background-color: #ebf1de;
                                <?php elseif($valor == 'S'): ?> background-color: #e8d9f3;
                                <?php elseif($valor == 'FE'): ?> background-color: #e8d9f3;
                                <?php else: ?> background-color: #fcd5b4;
                                <?php endif; ?>">
                                <?php echo e($valor); ?>

                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <td style="border: 1px solid black; <?php if($registro->dias_trabajados != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->dias_trabajados); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->faltas != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->faltas); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->abandono != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->abandono); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->vacacion != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->vacacion); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->LCH != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->LCH); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->LSH != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->LSH); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->ASUETO != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->ASUETO); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->VIATICOS != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->VIATICOS); ?></td>
                    <td style="border: 1px solid black; <?php if($registro->feriado != 0): ?> background-color: #ffc7ce; <?php endif; ?>"><?php echo e($registro->feriado); ?></td>
                    <td style="border: 1px solid black;">Bs. 17.00</td>
                    <td style="border: 1px solid black;">Bs. <?php echo e(number_format($registro->dias_trabajados * 17, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>


<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/refrigerio_excel.blade.php ENDPATH**/ ?>