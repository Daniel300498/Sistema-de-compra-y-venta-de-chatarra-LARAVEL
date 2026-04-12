<table>
    <thead>
        <tr>
            <th>Nro</th>
            <th>Tipo de documento de identidad</th>
            <th>Número de documento de identidad</th>
            <th>Lugar de expedición</th>
            <th>Fecha de nacimiento</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Nombres</th>
            <th>País de nacionalidad</th>
            <th>Sexo</th>
            <th>Jubilado</th>
            <th>¿Aporta a la AFP?</th>
            <th>¿Persona con discapacidad?</th>
            <th>Tutor de persona con discapacidad</th>
            <th>Fecha de ingreso</th>
            <th>Fecha de retiro</th>
            <th>Motivo retiro</th>
            <th>Caja de salud</th>
            <th>AFP a la que aporta</th>
            <th>NUA/CUA</th>
            <th>Sucursal o ubicación adicional</th>
            <th>Clasificación laboral</th>
            <th>Cargo</th>
            <th>Modalidad de contrato</th>
            <th>Tipo contrato</th>
            <th>Días pagados</th>
            <th>Horas pagadas</th>
            <th>Haber Básico</th>
            <th>Bono de antigüedad</th>
            <th>RC-IVA</th>
            <th>Aporte Caja Salud</th>
            <th>Aporte AFP</th>
            <th>Otros descuentos</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td>CI</td>
                <td><?php echo e($dato->ci); ?></td>
                <td><?php echo e($dato->ci_lugar); ?></td>
                <td><?php echo e(date("d/m/Y", strtotime($dato->fecha_nacimiento))); ?></td>
                <td><?php echo e($dato->ap_paterno); ?></td>
                <td><?php echo e($dato->ap_materno); ?></td>
                <td><?php echo e($dato->nombres); ?></td>
                <td><?php echo e($dato->pais); ?></td>
                <td><?php if($dato->sexo==1): ?> F <?php else: ?> M <?php endif; ?></td>
                <td>0</td>
                <td>1</td>
                <td><?php if($dato->discapacidad==1): ?> 1 <?php else: ?> 0 <?php endif; ?> </td>
                <td><?php if($dato->discapacidad==2): ?> 1 <?php else: ?> 0 <?php endif; ?></td>
                <td><?php echo e(date("d/m/Y", strtotime($dato->fecha_inicio))); ?></td>
                <td><?php echo e($dato->fecha_conclusion ?  date("d/m/Y", strtotime($dato->fecha_conclusion)) : ''); ?></td>
                <td><?php echo e($dato->tipo_baja); ?></td>
                <td><?php echo e($dato->caja); ?></td>
                <td><?php echo e($dato->afp); ?></td>
                <td><?php echo e($dato->nro_cua); ?></td>
                <td><?php echo e($dato->sucursal); ?></td>
                <td><?php echo e($dato->clasificacion); ?></td>
                <td><?php echo e($dato->cargo); ?></td>
                <td><?php echo e($dato->modalidad_contrato); ?></td>
                <td><?php echo e($dato->tipo_contrato); ?></td>
                <td><?php echo e($dato->dias_pagados); ?></td>
                <td><?php echo e($dato->horas_pagadas); ?></td>
                <td><?php echo e($dato->sueldo); ?></td>
                <td><?php echo e($dato->bono); ?></td>
                <td></td>
                <td><?php echo e(number_format(($dato->sueldo + $dato->bono)*0.10,2)); ?></td>
                <td><?php echo e(number_format(($dato->sueldo + $dato->bono)*0.1271,2)); ?></td>
                <td><?php echo e($dato->sancion); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/planillas/xls/planilla_mensual.blade.php ENDPATH**/ ?>