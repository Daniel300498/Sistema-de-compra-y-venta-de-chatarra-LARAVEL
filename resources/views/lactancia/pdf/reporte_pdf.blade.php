<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reportes</title>
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
                PLANILLA ASIGNACIONES FAMILIARES <br>
                MES: {{$mes}} <br>
            </th> 
          <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
            Fecha <br>
            
            <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="{{date('d-m-Y')}}">
          </th> 
    </tr>
    </table>

    <br>
    
      <table style="width:100%;">
      <thead>      
        <tr style="background: darkgray;text-align:center; font-size: 5px; ">
          <th rowspan="3" style="height:25px; font-size:10px font-weight:bold;"> Nº </th>
          <th colspan="6"  style="font-size: 10px; font-weight:bold;"> EMPLEADO(A) </th>
          <th colspan="5" style="font-size: 10px; font-weight:bold;"> BENEFICIARIA </th>
          <th style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> PRENATAL </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> LACTANCIA </th>
          <th rowspan="3" style="font-size: 10px; font-weight:bold;"> TOTAL <br> (Bs.) </th>
        </tr>
        <tr style="background: darkgray;text-align:center; ">
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> C.I. </th>
          <th rowspan="2" style="font-size: 10px; font-weight:bold;"> MATRICULA <br>SEGURO </th>  
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> APELLIDOS Y NOMBRES </th>  

          <th colspan="2" style="font-size: 10px; font-weight:bold;"> C.I. </th>
          <th colspan="3" style="font-size: 10px; font-weight:bold;"> APELLIDOS Y NOMBRES </th>  
          <th  style="font-size: 10px; font-weight:bold;"> SOLICITUD </th>
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th></th>
          <th colspan="2" style="font-size: 10px; font-weight:bold;"> FECHA </th>
          <th></th>
        </tr>
        <tr style="background: darkgray;text-align:center; ">
          
          <th style="font-size: 10px; font-weight:bold;"> N° </th>
          <th style="font-size: 10px; font-weight:bold;">LUGAR</th> 
          
          <th style="font-size: 10px; font-weight:bold;"> AP. PATERNO </th>  
          <th style="font-size: 10px; font-weight:bold;"> AP. MATERNO</th>
          <th style="font-size: 10px; font-weight:bold;"> NOMBRES</th>

          <th style="font-size: 10px; font-weight:bold;"> N° </th>
          <th style="font-size: 10px; font-weight:bold;">LUGAR</th> 
          <th style="font-size: 10px; font-weight:bold;"> AP. PATERNO </th>  
          <th style="font-size: 10px; font-weight:bold;"> AP. MATERNO</th>
          <th style="font-size: 10px; font-weight:bold;"> NOMBRES</th>

          <th style="font-size: 10px; font-weight:bold;"> c/NOTA </th>
          <th style="font-size: 10px; font-weight:bold;"> INICIO </th>
          <th style="font-size: 10px; font-weight:bold;"> FINAL </th>
          <th style="font-size: 10px; font-weight:bold;"> {{$mes}} </th>

          <th style="font-size: 10px; font-weight:bold;"> INICIO </th>
          <th style="font-size: 10px; font-weight:bold;"> FINAL </th>
          <th style="font-size: 10px; font-weight:bold;"> {{$mes}}  </th>
        </tr>
      </thead>
      <tbody>
        @if (count($lactancias) > 0)
        @foreach ($lactancias as $index => $lactancia_object)    
        <tr>
          <th style="height:30px;">{{ $index +1 }}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ci}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ci_lugar}}</th>
          <th style="font-size: 10px">{{$lactancia_object->matricula_lactancia->codigo}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ap_paterno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ap_materno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->nombres}}</th>
          @if($lactancia_object->beneficiaria_lactancia == null)
          <th style="font-size: 10px">{{$lactancia_object->empleado->ci}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ci_lugar}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ap_paterno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->ap_materno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->empleado->nombres}}</th>
        @else
          <th style="font-size: 10px">{{$lactancia_object->beneficiaria_lactancia->ci}}</th>
          <th style="font-size: 10px">{{$lactancia_object->beneficiaria_lactancia->ci_lugar}}</th>
          <th style="font-size: 10px">{{$lactancia_object->beneficiaria_lactancia->ap_paterno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->beneficiaria_lactancia->ap_materno}}</th>
          <th style="font-size: 10px">{{$lactancia_object->beneficiaria_lactancia->nombres}}</th>

        @endif

        @if($lactancia_object->inicio_lactancia == $licencia_prenatal->id)
        <th style="font-size: 10px">{{ date('d/m/y', strtotime($lactancia_object->fecha_inicio_prenatal))}}</th>

          @foreach ($lactancia_object->mensual as $mensual)
            @if($mensual->mes == 5)
              <th style="font-size: 10px">{{ date('m/y', strtotime($mensual->fecha_firma))}}</th>
            @endif
            @if($mensual->mes == 9)
              <th style="font-size: 10px">{{ date('m/y', strtotime($mensual->fecha_firma))}}</th>
            @endif
          @endforeach
          <th style="font-size: 10px">1</th>
          <th></th>
          <th></th>
          <th></th>
          <th style="font-size: 10px">{{number_format($bono_lactancia->valor, 2, '.', ',')}}</th>
        @else
          @if($lactancia_object->inicio_lactancia == $licencia_postnatal->id)
          <th style="font-size: 10px">{{ date('d/m/y', strtotime($lactancia_object->fecha_inicio_postnatal))}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th style="font-size: 10px">{{ date('m/y', strtotime($lactancia_object->fecha_inicio_postnatal))}}</th>
            <th style="font-size: 10px">{{ date('d/m/y', strtotime($lactancia_object->fecha_fin_postnatal))}}</th>
            <th style="font-size: 10px">1</th>
            <th style="font-size: 10px">{{number_format($bono_lactancia->valor, 2, '.', ',')}}</th>

            @endif
        @endif
        
        </tr>
        @endforeach
        @else
        <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none" colspan="6">
          No se encontraron registros de las fechas ingresadas
       </th> 
       
        @endif
          
      </tbody>
      <tfoot>
        <tr>
          <th colspan="19" style="background: darkgray;text-align:center; font-size: 10px; font-weight:bold;"> TOTAL</th>
          <th style="font-size: 10px; font-weight: bold; background: darkgray;" >{{number_format((count($lactancias) * $bono_lactancia->valor), 2, '.', ',')}}</th>
        </tr>
      </tfoot>
      </table >
   
  

      
      <br>
      <table style="width:100%; font-size:10">
        <tr class="items">
          <th style="width: 20%; border:none"></th>
              <th style="width: 60%;  text-align:center; font-size:12px; font-weight: bold; border:none">
                  Reporte fechas: {{ date('d-m-Y', strtotime($fecha_inicio))}} al {{ date('d-m-Y', strtotime($fecha_fin))}} <br>
              </th> 
          <th style="width: 20%; border:none"></th> 
      </tr>
      </table>