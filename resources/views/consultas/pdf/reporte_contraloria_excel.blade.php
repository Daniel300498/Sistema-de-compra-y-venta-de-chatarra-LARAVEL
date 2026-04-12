<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reporte Declaraciones Juradas</title>
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
font-size: 5;
font-weight:normal;
border-collapse: unset;
text-align: center
} 
</style> 
<div class="margin-top">
    {{-- REPORTE DE DECLARACIONES POR ASUMIR --}}
    @if ($tipo_declaracion== 1)
      <table style="width:100%;">
        <tr> 
          <td colspan="10" style="font-weight: bold;" >
             DECLARACION JURADA DE BIENES Y RENTAS ANTES DEL EJERCICIO DEL CARGO
          </td> 
  </tr>
  <tr> 
    @switch($tipo_trimestre)
        @case(1)
        <td  colspan="10" style=" font-weight: bold;">
          Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
        </td> 
            
            @break
        @case(2)
        <td colspan="10" style=" font-weight: bold;">
          Periodo 2°(Trimestre) (Abril, Mayo,Junio)
        </td> 
            @break
        @case(3)
        <td colspan="10" style="font-weight: bold;">
          Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
        </td> 
            
            @break
        @case(4)
        <td colspan="10" style="font-weight: bold;">
          Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
        </td> 
            
            @break
        @default
            
    @endswitch
  </tr>
  <tr>
    <td colspan="11" style="  text-align:center;font-weight: bold;">
        PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
    </td>
  </tr>
        <tr >
          <td style="font-weight: bold; text-align:center;background-color:#BDBCBB;">
              Nº
          </td>
          <td colspan="3" style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              NOMBRES Y APELLIDOS
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CEDULA DE <br>IDENTIDAD
          </td >
         
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              FECHA DE <br>INGRESO
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              DENOMINACION DEL <br>CARGO
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CARGO <br>FUNCIONAL
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              N° DE <br> CERTIFICADO <br> DE D.J.B.R.
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              FECHA DE <br>CERTIFICACION
          </td>
          <td ROWSPAN=2 style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              D.J.B.R.
          </td>
          
        </tr>
        <tr>
          <td style="font-weight: bold;text-align:center;background-color:#BDBCBB;"></td>
          <td style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Paterno</td>
          <td style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Materno</td>
          <td style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Nombres</td>
        </tr>
        
        @foreach ($declaraciones as $key => $de)
       
        <tr>
          <td style="text-align:center;">{{$key+1}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_paterno}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_materno}}</td>
          <td style="text-align:center;">{{$de->empleado->nombres}}</td>
          <td style="text-align:center;">{{$de->empleado->ci}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['fecha_inicio']}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.nombre']}}</td>
          <td style="text-align:center;">{{$de->codigo}}</td>
          <td style="text-align:center;">{{$de->fecha_certificacion}}</td>
          <td style="text-align:center;">ACREDITO SU D.J.B.R. OPORTUNAMENTE.</td>
        </tr>
        @endforeach
       
      </table >
    @else
    {{-- REPORTE DE DECLARACIONES POR ACTUALIZACION --}}
    @if ($tipo_declaracion== 2)
    
      <table style="width:100%;" >
        <tr> 
          <td colspan="13" style="font-weight: bold;">
              DECLARACION JURADA DE BIENES Y RENTAS (POR ACTUALIZACION).
          </td> 
  </tr>
  <tr> 
    @switch($tipo_trimestre)
        @case(1)
        <td colspan="10" style="font-weight: bold;">
          Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
        </td> 
            
            @break
        @case(2)
        <td colspan="10" style="font-weight: bold;">
          Periodo 2°(Trimestre) (Abril, Mayo,Junio)
        </td> 
            @break
        @case(3)
        <td  colspan="10" style="font-weight: bold;">
          Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
        </td> 
            
            @break
        @case(4)
        <td  colspan="10" style="font-weight: bold;">
          Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
        </td> 
            
            @break
        @default
            
    @endswitch
  </tr>
  <tr>
    <td  colspan="15" style="text-align:center;font-weight: bold;">
        PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
    </td>
  </tr>
        <tr >
          <td style="font-weight: bold; text-align:center;background-color:#BDBCBB;">
            Nº
        </td>
          <td colspan="3"  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              NOMBRES Y APELLIDOS
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CEDULA DE IDENTIDAD
          </td >
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              FECHA DE NACIMIENTO
          </td >
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              FECHA DE INGRESO
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              DENOMINACION DEL CARGO
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CARGO FUNCIONAL
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              RESIDE EN <br>CAPITAL <br>DEPTO
        </td>
         
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            D.J.B.R.
        </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            CELULAR
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            DOMICILIO
          </td>
          
        </tr>
        <tr style="background: darkgray;text-align:center;">
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;"></td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Paterno</td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Materno</td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Nombres</td>
        </tr>
        
        @foreach ($declaraciones as $key => $de)
        
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_paterno}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_materno}}</td>
          <td style="text-align:center;">{{$de->empleado->nombres}}</td>
          <td style="text-align:center;">{{$de->empleado->ci}}</td>
          <td style="text-align:center;">{{$de->empleado->fecha_nacimiento}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['fecha_inicio']}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.nombre']}}</td>
          <td style="text-align:center;">{{$de->empleado->ciudad->depto}}</td>
          
          <td style="text-align:center;">Realizo y acredito oportunamente </td>
          <td style="text-align:center;">{{$de->empleado->nro_celular}}</td>
          <td style="text-align:center;">{{$de->empleado->domicilio}}</td>


          
        </tr>
        @endforeach
       
      </table >
    @else
   
      <table style="width:100%;">
        <tr> 
          <td colspan="10" style="font-weight: bold;">
              DECLARACION JURADA DE BIENES Y RENTAS (DESPUES DEL EJERCICIO DEL CARGO).
          </td> 
  </tr>
  <tr> 
    @switch($tipo_trimestre)
        @case(1)
        <td  colspan="10" style="font-weight: bold;">
          Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
        </td> 
            
            @break
        @case(2)
        <td colspan="10"  style="font-weight: bold;">
          Periodo 2°(Trimestre) (Abril, Mayo,Junio)
        </td> 
            @break
        @case(3)
        <td colspan="10"  style="font-weight: bold;">
          Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
        </td> 
            
            @break
        @case(4)
        <td colspan="10"  style="font-weight: bold;">
          Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
        </td> 
            
            @break
        @default
            
    @endswitch
  </tr>
  <tr>
    <td colspan="11" style=" text-align:center;font-weight: bold;text-align:center;">
        PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
    </td>
  </tr>
        <tr>
          <td style="font-weight: bold; text-align:center;background-color:#BDBCBB;">
              Nº
          </td>
          <td colspan="3"  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              NOMBRES Y APELLIDOS
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CEDULA DE <br> IDENTIDAD
          </td >
         
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              DENOMINACION <br> DEL CARGO
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              CARGO <br>FUNCIONAL
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
             FECHA <br> RETIRO
        </td>
          
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              N° DE <br> CERTIFICADO <br> DE D.J.B.R.
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
              FECHA DE <br> CERTIFICACION
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            FECHA DE <br> PRESENTACION A RR.HH.
        </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            D.J.B.R.
        </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            CELULAR
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">
            DOMICILIO
          </td>
          <td ROWSPAN=2  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">TIPO <br> SUPERVISOR</td>
          
        </tr>
        <tr>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;"></td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Paterno</td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Materno</td>
          <td  style="font-weight: bold;text-align:center;background-color:#BDBCBB;">Nombres</td>
        </tr>
        @foreach ($declaraciones as $key => $de)
        <tr>
          <td style="text-align:center;">{{$key+1}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_paterno}}</td>
          <td style="text-align:center;">{{$de->empleado->ap_materno}}</td>
          <td style="text-align:center;">{{$de->empleado->nombres}}</td>
          <td style="text-align:center;">{{$de->empleado->ci}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']}}</td>
          <td style="text-align:center;">{{$de->empleado->cargo[0]->pivot['cargos.nombre']}}</td>
          <td style="text-align:center;">{{$de->fecha_retiro}}</td>
          <td style="text-align:center;">{{$de->codigo}}</td>
          <td style="text-align:center;">{{$de->fecha_certificacion}}</td>
          <td style="text-align:center;">{{$de->fecha_presentacion}}</td>
          <td style="text-align:center;">ACREDITO SU D.J.B.R. OPORTUNAMENTE </td>
          <td style="text-align:center;">{{$de->empleado->nro_celular}}</td>
          <td style="text-align:center;">{{$de->empleado->domicilio}}</td>
          <td style="text-align:center;">PROVISORIO</td>
        </tr>
        @endforeach
      </table >   
    @endif
    @endif
    {{-- REPORTE DE DECLARACIONES DESPUES DEL CARGO --}}
</div>