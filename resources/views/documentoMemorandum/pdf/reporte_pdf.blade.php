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



<table style="width:100%; font-size:10">
  <tr class="items">
    <th style="width: 20%; text-align:center; border:none; font-size:10px; font-weight:bold;" >
       <img src="{{asset('assets/img/escudoGobRed.png')}}" width="60px" alt="Image"/>
       <br>
       SUCURSAL LA PAZ 
    </th>
        <th style="width: 60%;  text-align:center; font-size:20px; font-weight: bold; border:none">
            DIRECCIÓN DE RECURSOS HUMANOS <br>
            REPORTE DE MEMORANDUMS<br>
            FECHAS {{ date('d-m-Y', strtotime($fecha_desde))}} al {{ date('d-m-Y', strtotime($fecha_hasta))}}
        </th> 
      <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
        Fecha Reporte <br>
        
        <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="{{date('d-m-Y')}}">
      </th> 
</tr>
</table>


<br>
<table style="width:100%;">
    <thead>      
      <tr style="background: darkgray;text-align:center; font-size: 5px; ">
        <th style="font-size:10px; font-weight:bold"> Nº </th>
        <th style="font-size: 10px; font-weight:bold;"> NOMBRE COMPLETO </th>
        <th style="font-size: 10px; font-weight:bold;"> CI </th>
        <th style="font-size: 10px; font-weight:bold;"> CARGO </th>
        <th style="font-size: 10px; font-weight:bold;"> LUGAR DE TRABAJO </th>
        <th style="font-size: 10px; font-weight:bold;"> FECHA </th>
        <th style="font-size: 10px; font-weight:bold;"> TIPO </th>
      </tr>
    </thead>
    <tbody>
      @if (count($info_empleado) > 0)
      @foreach ($info_empleado as $index => $info_empleado_object)    
      <tr>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{ $index +1 }}</th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{$info_empleado_object->empleado->nombres}} {{$info_empleado_object->empleado->ap_paterno}} {{$info_empleado_object->empleado->ap_materno}}</th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{$info_empleado_object->empleado->ci}}</th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">
          @if(count($info_empleado_object->empleado->cargo_actual) > 0)
            {{$info_empleado_object->empleado->cargo_actual[0]->nombre}}
          @else
            --- Sin cargo actual ---
          @endif  
        </th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{$info_empleado_object->empleado->ubicacion->descripcion}}</th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{ \Carbon\Carbon::parse($info_empleado_object->fecha_registro)->format('d/m/Y') }}</th>
        <th style="font-size: 10px; text-align:center; vertical-align: middle;">{{$info_empleado_object->tipo_id->descripcion}}</th>
      
      </tr>
      @endforeach
      @else
      <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
        No se encontraron registros de las fechas ingresadas
     </th> 
     
      @endif
        
    </tbody>
    <tfoot>
      <tr></tr>
    </tfoot>
    </table >