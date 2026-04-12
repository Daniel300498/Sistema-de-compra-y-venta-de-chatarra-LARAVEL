<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reportes Licencia</title>
<div class="margin-top">
  <style>
    .page-break{
      page-break-after: always
    }
    #footer{
      position: fixed;
      bottom: 0cm;
      left: 0cn;
      width: 100%;
      font-size: 8;
      color: black
    }

 th{
  font-size: 10;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}
</style>  



<table>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">
              DIRECCIÓN DE RECURSOS HUMANOS 
            </th> 
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">REPORTE DE LICENCIAS</th>  
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="10">FECHAS {{ date('d-m-Y', strtotime($fecha_desde))}} al {{ date('d-m-Y', strtotime($fecha_hasta))}}</th>  
      </tr>
      <tr class="items">
      <th style=" text-align:center; font-size:10px; vertical-align: middle; font-weight: bold; " colspan="10">FECHA {{date('d-m-Y')}}</th>  
      </tr>

      @if ($doc_lugar_trabajo == 1)
        @if ($lugar_trabajo_busqueda != null)
        <tr class="items">
         <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10">SEDE: {{$lugar_trabajo_busqueda->descripcion}}</th>  
        </tr>
        @endif
      @endif
      @if ($doc_area == 1)
        @if ($area_busqueda != null)
          <tr class="items">
            <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10"> AREA: {{$area_busqueda->nombre}}</th>  
          </tr>
        @endif
      @endif
      @if ($doc_tipo_licencia == 1)
        @if ($tipo_licencia_busqueda != null)
          <tr class="items">
          <th style=" text-align:center; font-size:12px; vertical-align: middle; font-weight: bold; " colspan="10">TIPO LICENCIA: {{$tipo_licencia_busqueda->descripcion}}</th>  
          </tr>
        @endif
      @endif
      
</table>





<table style="width:100%;">
    <thead>      
      <tr style="background: darkgray;text-align:center; font-size: 5px; ">
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> Nº </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> NOMBRE COMPLETO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> CI </th>
        @if ($doc_lugar_trabajo == 0)
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> SEDE </th>
        @endif
        @if ($doc_area == 0)
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> AREA </th>
        @endif
        @if ($doc_tipo_licencia == 0)
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> TIPO </th>
        @endif
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> N DIAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> MOTIVO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> HORAS </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> ESTADO </th>
      </tr>
    </thead>
    <tbody>
      @if (count($info_empleado) > 0)
      @foreach ($info_empleado as $index => $info_empleado_object)    
      <tr>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{ $index +1 }}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->nombres}} {{$info_empleado_object->empleado->ap_paterno}} {{$info_empleado_object->empleado->ap_materno}}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->ci}}</th>
        @if ($doc_lugar_trabajo == 0)
          @if ($info_empleado_object->empleado->ubicacion!=null)
            <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->ubicacion->descripcion}}</th>
          @else
            <th></th>
          @endif
        @endif
        @if ($doc_area == 0)
          @if ($info_empleado_object->area_id!=null)
            <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->area_id->nombre}}</th>
          @else
            <th></th>
          @endif
        @endif
        @if ($doc_tipo_licencia == 0)
          @if ($info_empleado_object->tipo!=null)
            <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->tipo->descripcion}}</th>
          @else
            <th></th>
          @endif
        @endif
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->numero_dias}}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->motivo}}</th>
    
        <th style="text-align:center; vertical-align: middle; border:solid;">
          @foreach ($info_empleado_object->fechas as $fecha)   
          {{ date('d-m-Y', strtotime($fecha->fecha_inicio))}} al {{ date('d-m-Y', strtotime($fecha->fecha_hasta))}}
          <br>
          @endforeach
        </th>

        <th style="text-align:center; vertical-align: middle; border:solid;">
          @foreach ($info_empleado_object->fechas as $fecha)   
            @if($fecha->horario == '8')
             DIA COMPLETO
            <br>
            @else
            MEDIO DIA
            @endif
          @endforeach
        </th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->estado->descripcion}}</th>

      
      </tr>
      @endforeach
      @else
      <tr>
        <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
          No se encontraron registros de las fechas ingresadas
      </th> 
     </tr>
     
      @endif
        
    </tbody>
    <tfoot>
      <tr></tr>
    </tfoot>
    </table >