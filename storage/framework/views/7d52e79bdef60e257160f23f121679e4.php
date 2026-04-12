<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 6px;
            margin: 10px;
        }
        table {
            width: 98%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            padding: 1px;
            text-align: center;
            font-size: 6px;
            vertical-align: middle;
        }
        th {
            background-color: #ebf1de;
            font-weight: bold;
        }
        h2, h3 {
            margin: 0;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center; font-weight: bold;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</h2>
    <h3 style="text-align: center; font-weight: bold;">PLANILLA DE REFRIGERIOS CORRESPONDIENTE AL MES DE <?php echo e(strtoupper($mes)); ?> - <?php echo e($gestion); ?></h3>
    
    <table>
        <tbody>
            <?php
                $currentAreaId = null;
                $mostrarDias = auth()->user()->can('refrigerios.show');
                $colspanSinDias = 16;
                $colspanConDias = $colspanSinDias + count($diasArray); /* Cantidad total de columnas si se muestran los días */
            ?>

            <?php $__currentLoopData = $biometricoMensual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($registro->area_id !== $currentAreaId): ?>
                    <?php if($currentAreaId !== null): ?>
                        <tr>
                            <td colspan="<?php echo e($mostrarDias ? $colspanConDias : $colspanSinDias); ?>" style="border: none;"></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="<?php echo e($mostrarDias ? $colspanConDias : $colspanSinDias); ?>" style="text-align: center; font-size: 10px; font-weight: bold; border: 1px solid black;"><?php echo e($registro->area); ?></td>
                    </tr>
                    <tr>
                        <th>Apellidos y Nombres</th>
                        <th>Cargo</th>
                        <th>C.I.</th>
                        <th>Item</th>
                        <th>Sueldo</th>
                        <?php if($mostrarDias): ?>
                            <?php $__currentLoopData = $diasArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($dia); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <th>Días Hábiles Trabajados</th>
                        <th>Faltas</th>
                        <th>Abandono</th>
                        <th>Vacación</th>
                        <th>LCGH</th>
                        <th>LSGH</th>
                        <th>Asueto</th>
                        <th>Viáticos</th>
                        <th>Feriados</th>
                        <th>Importe Diario</th>
                        <th>Total a Pagar</th>
                    </tr>
                    <?php
                        $currentAreaId = $registro->area_id;
                    ?>
                <?php endif; ?>
                <tr>
                    <td><?php echo e($registro->ap_paterno); ?> <?php echo e($registro->ap_materno); ?> <?php echo e($registro->nombres); ?></td>
                    <td><?php echo e($registro->descripcion); ?></td>
                    <td><?php echo e($registro->ci); ?></td>
                    <td><?php echo e($registro->nro_item); ?></td>
                    <td><?php echo e(number_format($registro->sueldo, 2)); ?></td>
                    <?php if($mostrarDias): ?>
                        <?php for($i = 1; $i <= $diasEnElMes; $i++): ?>
                            <?php $valor = $registro->{'col_'.$i}; ?>
                            <td><?php echo e($valor); ?></td>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <td><?php echo e($registro->dias_trabajados); ?></td>
                    <td><?php echo e($registro->faltas); ?></td>
                    <td><?php echo e($registro->abandono); ?></td>
                    <td><?php echo e($registro->vacacion); ?></td>
                    <td><?php echo e($registro->LCH); ?></td>
                    <td><?php echo e($registro->LSH); ?></td>
                    <td><?php echo e($registro->ASUETO); ?></td>
                    <td><?php echo e($registro->VIATICOS); ?></td>
                    <td><?php echo e($registro->feriado); ?></td>
                    <td>Bs. 17.00</td>
                    <td>Bs. <?php echo e(number_format($registro->dias_trabajados * 17, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/refrigerio_pdf.blade.php ENDPATH**/ ?>