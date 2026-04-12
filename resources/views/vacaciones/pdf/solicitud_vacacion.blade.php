<br>
<br>
<table >
    <tr>
       <td colspan="2">Señora. <br>
          Lic. Rocio S. Rocabado Gutierrez <br>
          <span style=" font-weight: bold;">DIRECTORA DE RECURSOS HUMANOS</span> <br>
          <span style=" font-weight: bold;">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</span><br><br>
          Presente.-
      </td>
       
    </tr>
    <tr>
        <td style="width: 50%; text-align:center" ></td>
        <td> <u style=" width: 50%;font-weight: bold;text-align:left;">REF.: SOLICITUD DE VACACIONES</u></td>
    </tr>
    <tr>
        <td colspan="2">
             <p  style="width: 100%; text-align:justify">
            De mi mayor consideracion: <br><br>
            Mediantes la presente reciba un cordial saludo y exito en la funcion que desempe&ntilde;a
            en bien de nuestra institucion. <br><br>
            El motivo de la presente misiva es para viabilizar la solicitud de vaciones en fechas <span style="font-weight: bold">
            {{$total_fechas}}</span>, acuenta de los dias de vacacion disponible segun 
            antiguedad en el numero de item : 250 y segun los siguientes datos: <br><br>
            <span style="font-weight: bold">Nombre:</span> {{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }} <br>
            <span style="font-weight: bold">Ci:  </span> {{ $empleado->ci }} {{ $empleado->ci_lugar }}.<br>
            <span style="font-weight: bold">Nro De Item:  </span>{{$cargo->nro_item}} <br>
            <span style="font-weight: bold">Cargo: {{$cargo->area_nombre}} </span> <br><br>
            Sin otro particular me despido con las consideraciones mas distinguidas. <br><br><br>
            Atentamente:<br><br>
            </p>
        </td>
    </tr>
    <tr>
       <td colspan="2" style="width: 100%; text-align:center"><br><br>___________________________________ <br>
        {{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }} <br>
        CI.{{ $empleado->ci }} {{ $empleado->ci_lugar }}
    </td>
       
    </tr>
</table>