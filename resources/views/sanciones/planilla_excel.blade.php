<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanciones Disciplinarias</title>
</head>
<body>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <th colspan="5" style="text-align: center; font-size: 14px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; font-size: 14px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">DIRECCION DE RECURSOS HUMANOS</th>
        </tr>
        <tr>
            <th colspan="18" style="text-align: center; font-size: 22px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">PLANILLA DE SANCIONES DISCIPLINARIAS</th>
        </tr>
        <tr>
            <th colspan="18" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">CORRESPONDIENTE AL MES DE {{ strtoupper($mes) }} - {{ $gestion }}</th>
        </tr>
       
        <tbody>
            @php
                $currentAreaId = null;
            @endphp

            @foreach($biometrico as $registro)
                @if($registro->area_id !== $currentAreaId)
                    @if($currentAreaId !== null)
                        <tr>
                            <td colspan="18" style="border: none;"></td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="18" style="text-align: center; font-size: 14px; font-weight: bold; border: 1px solid black;">{{ $registro->area }}</td>
                    </tr>
                    <tr>
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:180px; height: 45px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">CARGO</th>
                <th bgcolor="#0f243e" colspan="3" style="color: #FFFFFF; width:390px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">NOMBRES Y APELLIDOS</th>       
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:100px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">CEDULA DE IDENTIDAD</th>
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:55px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">Nro. Item</th>
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:65px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">HABER BASICO</th>
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:120px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">BONO DE ANTIGUEDAD</th>
                <th bgcolor="#0f243e" rowspan="2" style="color: #FFFFFF; width:100px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">TOTAL GANADO POR DIA</th>              
                <th bgcolor="#e26b0a" colspan="3" style="color: #FFFFFF; width:150px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">ATRASOS</th> 
                <th bgcolor="#ff0000" colspan="2" style="color: #FFFFFF; width:100px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">FALTAS</th> 
                <th bgcolor="#d8e4bc" colspan="3" style="width:100px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">LICENCIAS SIN GOCE DE HABERES</th> 
                <th bgcolor="#ffff00" rowspan="2" style="width:75px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">TOTAL DESCUENTO</th> 
            </tr>
            <tr>
                <th bgcolor="#0f243e" style="color: #FFFFFF; width:115px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">PATERNO</th>
                <th bgcolor="#0f243e" style="color: #FFFFFF; width:115px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">MATERNO</th>
                <th bgcolor="#0f243e" style="color: #FFFFFF; width:160px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">NOMBRES</th>
                <th bgcolor="#e26b0a" style="color: #FFFFFF; width:50px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">MINUTOS</th>
                <th bgcolor="#e26b0a" style="color: #FFFFFF; width:50px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">DIAS</th>
                <th bgcolor="#e26b0a" style="color: #FFFFFF; width:50px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">BS</th>
                <th bgcolor="#ff0000" style="color: #FFFFFF; width:50px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">DIAS</th>
                <th bgcolor="#ff0000" style="color: #FFFFFF; width:50px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">BS</th>
                <th bgcolor="#d8e4bc" style="width:65px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">DIAS</th>
                <th bgcolor="#d8e4bc" style="width:70px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">DESCUENTO POR LOS DIAS DE PERMISO</th>
                <th bgcolor="#d8e4bc" style="width:90px; border: 1px solid black; font-weight: bold; text-align: center; vertical-align: middle; white-space: nowrap;">BS</th>
            </tr>
                    @php
                        $currentAreaId = $registro->area_id;
                    @endphp
                @endif
                <tr>      
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->descripcion }}</td>             
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->ap_paterno }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->ap_materno }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->nombres }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->ci }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->nro_item }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format($registro->sueldo, 2) }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{$registro->bono}}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format($registro->sueldoDia, 2) }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ $registro->minutos_atraso }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{$registro->dias}}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format(($registro->sueldoDia * $registro->dias), 2) }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{$registro->faltas}}</td> 
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format(($registro->faltas * $registro->sueldoDia), 2) }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{$registro->LSH}}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format(($registro->LSH * $registro->sueldoDia), 2) }}</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format((($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>                    
                    <td style="border: 1px solid black; text-align: center; vertical-align: middle;">{{ number_format(($registro->faltas * $registro->sueldoDia) + ($registro->sueldoDia * $registro->dias)+ (($registro->LSH * $registro->sueldoDia*0.1671)+($registro->LSH * $registro->sueldoDia)), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
