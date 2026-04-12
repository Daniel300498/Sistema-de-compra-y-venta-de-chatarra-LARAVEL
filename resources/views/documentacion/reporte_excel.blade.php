<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de documentación</title>
</head>
<body>

    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <th colspan="6" style="text-align: center; font-size: 20px; font-weight: bold; border: 1px solid black;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black;">REPORTE DE DOCUMENTACIÓN</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">
                @if($area_trabajo)
                CORRESPONDIENTE AL ÁREA DE: {{$area_trabajo}}
                @else 
                CORRESPONDIENTE A TODAS LAS ÁREAS
                @endif
            </th>
        </tr>
        <tbody>
                <tr>
                    <th></th>                       
                    <th bgcolor="#e5b8b7" style="width:290px; border: 1px solid black; font-weight: bold; text-align: center;">APELLIDOS Y NOMBRES</th> 
                    <th bgcolor="#e5b8b7" style="width:100px; border: 1px solid black; font-weight: bold; text-align: center;">C.I.</th>
                    <th bgcolor="#e5b8b7" style="width:250px; border: 1px solid black; font-weight: bold; text-align: center;">CARGO</th>
                    <th bgcolor="#e5b8b7" style="width:50px; border: 1px solid black; font-weight: bold; text-align: center;">CERTIFICADO AYMARA</th>
                    <th bgcolor="#e5b8b7" style="width:110px; border: 1px solid black; font-weight: bold; text-align: center;">LUGAR EMISION</th>
                </tr>
                    @foreach($reportes as $registro)
                <tr>
                    <td></td>
                    <td style="border: 1px solid black;">{{$registro->empleado->ap_paterno}} {{$registro->empleado->ap_materno}} {{$registro->empleado->nombres}} </td>
                    <td style="border: 1px solid black;">{{$registro->empleado->ci}} {{$registro->empleado->ci_complemento}} {{$registro->empleado->ci_lugar}}</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; vertical-align: middle; white-space: normal; word-wrap: break-word;">
                        {{$registro->cargo->nombre}}
                    </td>

                    @if($registro->empleado->documentacion->certificado_aymara)
                    <td style="border: 1px solid black;">SI</td>
                    <td style="border: 1px solid black; padding:8px; text-align: center; vertical-align: middle; white-space: normal; word-wrap: break-word">{{$registro->empleado->documentacion->emitido_por}}</td>
                     @else
                    <td style="border: 1px solid black;">NO</td>
                    <td style="border: 1px solid black;"></td>
                    @endif
                
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


