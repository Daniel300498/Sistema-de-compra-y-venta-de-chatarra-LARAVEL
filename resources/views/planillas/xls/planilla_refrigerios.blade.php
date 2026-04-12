<table class="table">
    <thead>
        <tr>
            <th colspan="{{ $diasEnMes + 14 }}" style="text-align: center; font-size: 20px; font-weight: bold; border: 1px solid black;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</th>
        </tr>
        <tr>
            <th colspan="{{ $diasEnMes + 14 }}" style="text-align: center; font-size: 16px; font-weight: bold; border: 1px solid black;">PLANILLA DE REFRIGERIOS</th>
        </tr>
        <tr>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA">N°</th>
            @if($tipo_cargo=='ITEM')
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA">ITEM</th>
            @endif
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:300px; border: 1px solid black; font-weight: bold; text-align: center;">APELLIDOS NOMBRES</th>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:150px; border: 1px solid black; font-weight: bold; text-align: center;">CARGO</th>
            <th class="text-center" rowspan="2" bgcolor="#CCC0DA" style="width:99px; border: 1px solid black; font-weight: bold; text-align: center;">C.I.</th>
            @foreach($diasLiteral as $dia)
                <td bgcolor="#CCC0DA" style="border: 1px solid black; font-weight: bold; text-align: center;">{{$dia}}</td>
            @endforeach
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
            @for($i = 1; $i <= $diasEnMes; $i++)
                <th bgcolor="#CCC0DA" style="border: 1px solid black; font-weight: bold; text-align: center;">{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ($reporteMensual as $key => $item)
            <tr>
                <td class="text-center" style="border: 1px solid black; text-align: center;">{{$key+1}}</td>
                @if($tipo_cargo=='ITEM')
                <td class="text-center" style="border: 1px solid black;">{{ $item->empleado->cargo[0]->nro_item }}</td>
                @endif
                <td class="text-center" style="border: 1px solid black;">{{ $item->empleado->ap_paterno }} {{ $item->empleado->ap_materno }} {{ $item->empleado->nombres }}</td>
                <td class="text-center" style="border: 1px solid black;">{{ $item->empleado->cargo[0]->nombre }}</td>
                <td class="text-center" style="border: 1px solid black;">{{ $item->empleado->ci }}</td>
                @for($i = 1; $i <= $diasEnMes; $i++)
                
                <td style="border: 1px solid black; text-align: center;
                    @if($item->$i != 'X' && $item->$i != '' && $item->$i != 'Fse' && $item->$i != 'FE') 
                        background-color: #E6B8B7 
                    @else
                        @if($item->$i == 'Fse') 
                        background-color:#C4D79B
                        @else
                        @if($item->$i == 'FE')
                        background-color:#FCD5B4
                        @endif
                        @endif
                    @endif ">
                    @if($item->$i != 'Fse'){{ $item->$i }} @endif
                </td>
                @endfor
                <th style="border: 1px solid black;">{{ $item->dias_trabajados }}</th>
                <th style="border: 1px solid black;">{{$item->faltas}}</th>
                <th style="border: 1px solid black;">{{ $item->abandono }}</th>
                <th style="border: 1px solid black;">{{ $item->vacacion }}</th>
                <th style="border: 1px solid black;">{{ $item->lcgs }}</th>
                <th style="border: 1px solid black;">{{ $item->lsgs }}</th>
                <th style="border: 1px solid black;">{{ $item->asueto }}</th>
                <th style="border: 1px solid black;">{{ $item->viaticos }}</th>
                <th style="border: 1px solid black;">{{ $item->feriado }}</th>
                <th style="border: 1px solid black;">17</th>
                <th style="border: 1px solid black;"> {{ $item->dias_trabajados * 17 }}</th>
            </tr>
        @endforeach
    </tbody>
  </table>