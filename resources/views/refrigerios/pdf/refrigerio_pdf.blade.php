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
    <h3 style="text-align: center; font-weight: bold;">PLANILLA DE REFRIGERIOS CORRESPONDIENTE AL MES DE {{ strtoupper($mes) }} - {{ $gestion }}</h3>
    
    <table>
        <tbody>
            @php
                $currentAreaId = null;
                $mostrarDias = auth()->user()->can('refrigerios.show');
                $colspanSinDias = 16;
                $colspanConDias = $colspanSinDias + count($diasArray); /* Cantidad total de columnas si se muestran los días */
            @endphp

            @foreach($biometricoMensual as $registro)
                @if($registro->area_id !== $currentAreaId)
                    @if($currentAreaId !== null)
                        <tr>
                            <td colspan="{{ $mostrarDias ? $colspanConDias : $colspanSinDias }}" style="border: none;"></td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="{{ $mostrarDias ? $colspanConDias : $colspanSinDias }}" style="text-align: center; font-size: 10px; font-weight: bold; border: 1px solid black;">{{ $registro->area }}</td>
                    </tr>
                    <tr>
                        <th>Apellidos y Nombres</th>
                        <th>Cargo</th>
                        <th>C.I.</th>
                        <th>Item</th>
                        <th>Sueldo</th>
                        @if($mostrarDias)
                            @foreach($diasArray as $dia)
                                <th>{{ $dia }}</th>
                            @endforeach
                        @endif
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
                    @php
                        $currentAreaId = $registro->area_id;
                    @endphp
                @endif
                <tr>
                    <td>{{ $registro->ap_paterno }} {{ $registro->ap_materno }} {{ $registro->nombres }}</td>
                    <td>{{ $registro->descripcion }}</td>
                    <td>{{ $registro->ci }}</td>
                    <td>{{ $registro->nro_item }}</td>
                    <td>{{ number_format($registro->sueldo, 2) }}</td>
                    @if($mostrarDias)
                        @for($i = 1; $i <= $diasEnElMes; $i++)
                            @php $valor = $registro->{'col_'.$i}; @endphp
                            <td>{{ $valor }}</td>
                        @endfor
                    @endif
                    <td>{{ $registro->dias_trabajados }}</td>
                    <td>{{ $registro->faltas }}</td>
                    <td>{{ $registro->abandono }}</td>
                    <td>{{ $registro->vacacion }}</td>
                    <td>{{ $registro->LCH }}</td>
                    <td>{{ $registro->LSH }}</td>
                    <td>{{ $registro->ASUETO }}</td>
                    <td>{{ $registro->VIATICOS }}</td>
                    <td>{{ $registro->feriado }}</td>
                    <td>Bs. 17.00</td>
                    <td>Bs. {{ number_format($registro->dias_trabajados * 17, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
