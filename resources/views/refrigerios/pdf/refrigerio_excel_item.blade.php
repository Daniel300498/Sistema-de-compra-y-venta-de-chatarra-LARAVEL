<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Refrigerio</title>
</head>
<body>
    @php
        // Calcular el número total de columnas basado en el permiso
        $mostrarDias = Gate::allows('refrigerios.show');
        $totalColumnas = 16 + ($mostrarDias ? count($diasArray) : 0); // 11 columnas fijas + días del mes si el usuario tiene permiso
    @endphp

    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <th colspan="{{ $totalColumnas }}" style="text-align: center; font-size: 20px; font-weight: bold; border: 1px solid black;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="{{ $totalColumnas }}" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black;">PLANILLA DE REFRIGERIOS</th>
        </tr>
        <tr>
            <th colspan="{{ $totalColumnas }}" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black; vertical-align: middle; white-space: nowrap;">
                CORRESPONDIENTE AL MES DE {{ strtoupper($mes) }} - {{ $gestion }}
            </th>
        </tr>
        <tbody>
            @foreach($biometricoMensual as $registro)
                @if(!isset($currentAreaId) || $registro->area_id !== $currentAreaId)
                    @isset($currentAreaId)
                        <tr>
                            <td colspan="{{ $totalColumnas }}" style="border: none;"></td>
                        </tr>
                    @endisset
               
                    <tr>
                        <td colspan="{{ $totalColumnas }}" style="text-align: center; font-size: 14px; font-weight: bold; border: 1px solid black;">{{ $registro->area }}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th bgcolor="#e5b8b7" style="border: 1px solid black; font-weight: bold; text-align: center;">ITEM</th>
                       
                        <th bgcolor="#e5b8b7" style="width:600px; border: 1px solid black; font-weight: bold; text-align: center;">APELLIDOS Y NOMBRES</th>
                        <th bgcolor="#e5b8b7" style="width:150px; border: 1px solid black; font-weight: bold; text-align: center;">CARGO</th>
                        <th bgcolor="#e5b8b7" style="width:99px; border: 1px solid black; font-weight: bold; text-align: center;">C.I.</th>
                        
         
                        @if($mostrarDias)
                            @foreach($diasArray as $dia)
                                <th bgcolor="#e5b8b7" style="width: 30px; border: 1px solid black; font-weight: bold; text-align: center;">{{ $dia }}</th>
                            @endforeach
                        @endif

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
                    @php
                        $currentAreaId = $registro->area_id;
                    @endphp
                @endif
                <tr>
                    <td></td>
                    <td style="border: 1px solid black;">{{ $registro->nro_item }}</td>
                    <td style="border: 1px solid black;">{{ $registro->ap_paterno }} {{ $registro->ap_materno }} {{ $registro->nombres }}</td>
                    <td style="border: 1px solid black;">{{ $registro->descripcion }}</td>
                    <td style="border: 1px solid black;">{{ $registro->ci }}</td>
                    
                 

                    @if($mostrarDias)
                        @foreach(range(1, $diasEnElMes) as $i)
                            @php $valor = $registro->{'col_'.$i}; @endphp
                            <td style="border: 1px solid black; text-align: center;
                                @if($valor == 'X') background-color: #ebf1de;
                                @elseif($valor == 'S') background-color: #e8d9f3;
                                @elseif($valor == 'FE') background-color: #e8d9f3;
                                @else background-color: #fcd5b4;
                                @endif">
                                {{ $valor }}
                            </td>
                        @endforeach
                    @endif
                    <td style="border: 1px solid black; @if($registro->dias_trabajados != 0) background-color: #ffc7ce; @endif">{{ $registro->dias_trabajados }}</td>
                    <td style="border: 1px solid black; @if($registro->faltas != 0) background-color: #ffc7ce; @endif">{{ $registro->faltas }}</td>
                    <td style="border: 1px solid black; @if($registro->abandono != 0) background-color: #ffc7ce; @endif">{{ $registro->abandono }}</td>
                    <td style="border: 1px solid black; @if($registro->vacacion != 0) background-color: #ffc7ce; @endif">{{ $registro->vacacion }}</td>
                    <td style="border: 1px solid black; @if($registro->LCH != 0) background-color: #ffc7ce; @endif">{{ $registro->LCH }}</td>
                    <td style="border: 1px solid black; @if($registro->LSH != 0) background-color: #ffc7ce; @endif">{{ $registro->LSH }}</td>
                    <td style="border: 1px solid black; @if($registro->ASUETO != 0) background-color: #ffc7ce; @endif">{{ $registro->ASUETO }}</td>
                    <td style="border: 1px solid black; @if($registro->VIATICOS != 0) background-color: #ffc7ce; @endif">{{ $registro->VIATICOS }}</td>
                    <td style="border: 1px solid black; @if($registro->feriado != 0) background-color: #ffc7ce; @endif">{{ $registro->feriado }}</td>
                    <td style="border: 1px solid black;">Bs. {{$monto_pago->valor}}</td>
                    <td style="border: 1px solid black;">Bs. {{ number_format($registro->dias_trabajados * $monto_pago->valor, 2) }}</td>
                 </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>




