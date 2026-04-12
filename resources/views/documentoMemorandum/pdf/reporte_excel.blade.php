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
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="7">
              DIRECCIÓN DE RECURSOS HUMANOS 
            </th> 
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="7">REPORTE DE MEMORANDUMS</th>  
      </tr>
      <tr class="items">
            <th style=" text-align:center; font-size:20px; vertical-align: middle; font-weight: bold; " colspan="7">FECHAS {{ date('d-m-Y', strtotime($fecha_desde))}} al {{ date('d-m-Y', strtotime($fecha_hasta))}}</th>  
      </tr>
      <tr class="items">
      <th style=" text-align:center; font-size:10px; vertical-align: middle; font-weight: bold; " colspan="7">FECHA REPORTE {{date('d-m-Y')}}</th>  
      </tr>

 
</table>





<table style="width:100%;">
    <thead>      
      <tr style="background: darkgray;text-align:center; font-size: 5px; ">
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> Nº </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> NOMBRE COMPLETO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> CI </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> CARGO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> LUGAR DE TRABAJO </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> FECHA </th>
        <th style="text-align:center; vertical-align: middle; font-weight: bold; border: solid;"> TIPO </th>
      </tr>
    </thead>
    <tbody>
      @if (count($info_empleado) > 0)
      @foreach ($info_empleado as $index => $info_empleado_object)    
      <tr>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{ $index +1 }}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->nombres}} {{$info_empleado_object->empleado->ap_paterno}} {{$info_empleado_object->empleado->ap_materno}}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->ci}}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">
          @if(count($info_empleado_object->empleado->cargo_actual) > 0)
            {{$info_empleado_object->empleado->cargo_actual[0]->nombre}}
          @else
            --- Sin cargo actual ---
          @endif                              
        </th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->empleado->ubicacion->descripcion}}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;"> {{ \Carbon\Carbon::parse($info_empleado_object->fecha_registro)->format('d/m/Y') }}</th>
        <th style="text-align:center; vertical-align: middle; border:solid;">{{$info_empleado_object->tipo_id->descripcion}}</th>  
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