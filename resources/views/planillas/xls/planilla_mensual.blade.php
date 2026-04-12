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
        @foreach($datos as $key=>$dato)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>CI</td>
                <td>{{ $dato->ci }}</td>
                <td>{{ $dato->ci_lugar }}</td>
                <td>{{ date("d/m/Y", strtotime($dato->fecha_nacimiento)) }}</td>
                <td>{{ $dato->ap_paterno }}</td>
                <td>{{ $dato->ap_materno }}</td>
                <td>{{ $dato->nombres }}</td>
                <td>{{ $dato->pais }}</td>
                <td>@if($dato->sexo==1) F @else M @endif</td>
                <td>0</td>
                <td>1</td>
                <td>@if($dato->discapacidad==1) 1 @else 0 @endif </td>
                <td>@if($dato->discapacidad==2) 1 @else 0 @endif</td>
                <td>{{ date("d/m/Y", strtotime($dato->fecha_inicio)) }}</td>
                <td>{{ $dato->fecha_conclusion ?  date("d/m/Y", strtotime($dato->fecha_conclusion)) : '' }}</td>
                <td>{{ $dato->tipo_baja }}</td>
                <td>{{ $dato->caja }}</td>
                <td>{{ $dato->afp }}</td>
                <td>{{ $dato->nro_cua }}</td>
                <td>{{ $dato->sucursal }}</td>
                <td>{{ $dato->clasificacion }}</td>
                <td>{{ $dato->cargo }}</td>
                <td>{{ $dato->modalidad_contrato }}</td>
                <td>{{ $dato->tipo_contrato }}</td>
                <td>{{ $dato->dias_pagados }}</td>
                <td>{{ $dato->horas_pagadas }}</td>
                <td>{{ $dato->sueldo }}</td>
                <td>{{ $dato->bono }}</td>
                <td></td>
                <td>{{ number_format(($dato->sueldo + $dato->bono)*0.10,2) }}</td>
                <td>{{ number_format(($dato->sueldo + $dato->bono)*0.1271,2) }}</td>
                <td>{{ $dato->sancion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>