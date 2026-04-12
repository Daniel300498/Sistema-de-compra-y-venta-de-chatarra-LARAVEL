<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 8px; 
            margin: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 2px; 
            text-align: center;
            font-size: 8px;
        }
        th {
            background-color: #ebf1de;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center; font-weight: bold;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</h2>
    <h3 style="text-align: center; font-size: 10px; font-weight: bold;">PLANILLA DE SANCIONES DISCIPLINARIAS CORRESPONDIENTE AL MES DE {{ strtoupper($mes) }} - {{ $gestion }}</h3>
    
    <table>
        <tbody>
            @php
                $currentAreaId = null;
            @endphp

            @foreach($biometrico as $registro)
                @if($registro->area_id !== $currentAreaId)
                    @if($currentAreaId !== null)
                        <tr>
                            <td colspan="46" style="border: none;"></td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="46" style="text-align: center; font-size: 10px; font-weight: bold; border: 1px solid black;">{{$registro->area }}</td>
                    </tr>
            <tr>
                <th rowspan="2">CARGO</th>
                <th colspan="3">NOMBRES Y APELLIDOS</th>
                <th rowspan="2">CEDULA DE IDENTIDAD</th>
                <th rowspan="2">Nro. Item</th>
                <th rowspan="2">HABER BASICO</th>
                <th rowspan="2">BONO DE ANTIGUEDAD</th>
                <th rowspan="2">TOTAL GANADO POR DIA</th>
                <th colspan="3">ATRASOS</th>
                <th colspan="2">FALTAS</th>
                <th colspan="3">LICENCIAS SIN GOCE DE HABERES</th> 
                <th rowspan="2">TOTAL DESCUENTO</th>
            </tr>
            <tr>
                <th>PATERNO</th>
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>MINUTOS</th>
                <th>DIAS</th>
                <th>BS</th>
                <th>DIAS</th>
                <th>BS</th>
                <th>DIAS</th>
                <th>DESCUENTO POR LOS DIAS DE PERMISO</th>
                <th>BS</th>
            </tr>
                    @php
                        $currentAreaId = $registro->area_id; // Actualiza el ID del área actual
                    @endphp
                @endif
                    <tr>      
                        <td>{{ $registro->descripcion }}</td>             
                        <td>{{ $registro->ap_paterno }}</td>
                        <td>{{ $registro->ap_materno }}</td>
                        <td>{{ $registro->nombres }}</td>
                        <td>{{ $registro->ci }}</td>
                        <td>{{ $registro->nro_item }}</td>
                        <td>{{ number_format($registro->sueldo, 2) }}</td>

                        <td>{{$registro->bono}}</td>
                        <td>{{ number_format($registro->sueldoDia, 2) }}</td>
                        <td>{{ $registro->minutos_atraso }} </td>
                        <td>{{$registro->dias}}</td>
                        <td>{{ number_format(($registro->sueldoDia * $registro->dias), 2) }}</td>
                        <td>{{$registro->faltas}}</td> 
                        <td>{{ number_format(($registro->faltas * $registro->sueldoDia), 2) }}</td>
                        <td>{{$registro->LSH}}</td>
                        <td>{{ number_format(($registro->LSH * $registro->sueldoDia), 2) }}</td>
                        <td>{{ number_format((($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>                    
                        <td>{{ number_format(($registro->faltas * $registro->sueldoDia) + ($registro->sueldoDia * $registro->dias)+ (($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>
                    </tr>
                        @endforeach
        </tbody>
    </table>
</body>
</html>
