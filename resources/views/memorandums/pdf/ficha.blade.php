<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

<title>Ficha Personal</title>

<style>
    #vertical{
        width: 4px;
        height: 180px;
        background-color: black
    }
    #vertical1{
        height: 4px;
        width: 150px;
        background-color: black
    }
    #footer{
      color: black;
      position: fixed;
      bottom: 0cm;
      left: 0cn;
      width: 100%;
      font-size: 8;
      font-weight: bold;
      
    }
    @font-face{
    font-family:"Pinyon Script";
    src: url('{{storage_path('fonts/PinyonScript-Regular.ttf')}}') format('truetype');
}
#regular{
    font-family: "Pinyon Script";
    font-size: 12
}
</style>
<div class="margin-top">
    @switch($memorandum->memorandum_tipo_id)
        @case(1)
        <table>
            <tr>
                    <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                      <u>MEMORANDUM</u> <br>
                    </td>
            </tr>
        </table>
        <br>
        <table>
          <tr>
                  <td style="width: 49%">
                    <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                     <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                     <span style="font-size:12;">La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                  </td>
                  <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                    <div id="vertical" style=" text-align:center;"></div>  
                  </td>
                  <td style="width: 49%;font-size:12;">
                      <span style="font-size:10; font-weight: bold;">GADLP/SDEF/DRRHH/P-{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                      Señor (a): <br>
                      {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                      C.I. {{$empleado->ci}} <br>
                      ASUNTO: <span style="font-size:10; font-weight: bold;">PROMOCIÓN </span><br>
      
                  </td>
          </tr>
          <tr>
              <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
          </tr>
          <tr>
              <td colspan="3">
                  <p style="width: 100%;font-size:12;text-align:justify;">
                      <br>Señor (a):  <br>
                      {{$memorandum->contenido}} <br><br>
                      Atentamente.

      </p>
              </td>
          </tr>
      </table>
      <pre id="footer">
      
SQQ 
RSRG 
rftc 
C.C.:	DRRHH 
      File Personal 
      Activos Fijos 
      Registro 
PROM – {{$cargo->nro_item}}
      
          
      
      </pre> 
            
            @break
        @case(2)
        <table>
            <tr>
                    <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                      <u>MEMORANDUM</u> <br>
                    </td>
            </tr>
        </table>
        <br>
        <table>
          <tr>
                  <td style="width: 49%">
                    <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                     <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                     <span style="font-size:12;">La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                  </td>
                  <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                    <div id="vertical" style=" text-align:center;"></div>
                  </td>
                 
                  <td style="width: 49%;font-size:12;">
                      <span style="font-size:10; font-weight: bold;">GADLP/SDEF/DRRHH-{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                      Señor (a): <br>
                      {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                      C.I. {{$empleado->ci}} <br>
                      ASUNTO: <span style="font-size:10; font-weight: bold;">TRANSFERENCIA </span><br>
        
                  </td>
          </tr>
          <tr>
              <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
          </tr>
          <tr>
              <td colspan="3">
                  
                  <p style="width: 100%;font-size:12;text-align:justify;">
                      <br>Señor (a):  <br>
                      {{$memorandum->contenido}}
        </p>
              </td>
          </tr>
         
        </table>
        <pre id="footer">
        
SQQ
RSRG
rftc
C.C.:	  Original
        DRRHH
        File Personal
        UAP
        Kardex
TRANSF –  {{$cargo->nro_item}}
        </pre> 
            
            @break
        
        @case(3)
        <table>
            <tr>
                    <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                      <u>MEMORANDUM</u> <br>
                    </td>
            </tr>
        </table>
        <br>
        <table>
          <tr>
                  <td style="width: 49%">
                    <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                     <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                     <span style="font-size:12;">La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                  </td>
                  <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                    <div id="vertical" style=" text-align:center;"></div>
                    
                    
                  </td>
                  <td style="width: 49%;font-size:12;">
                      <span style="font-size:10; font-weight: bold;"> GADLP/SDEF/DRRHH/b/{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                      Señor (a): <br>
                      {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                      C.I. {{$empleado->ci}} <br>
                      ASUNTO: <span style="font-size:10; font-weight: bold;">AGRADECIMIENTO DE SERVICIOS
                    </span><br>
        
                  </td>
          </tr>
          <tr>
              <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
          </tr>
          <tr>
              <td colspan="3">
                  <p style="width: 100%;font-size:10;text-align:justify;">
                      <br>Señor (a):  <br>
                      {{$memorandum->contenido}}
                  </p>
                  <p style="width: 50%;font-size:12;text-align:center;">
                        <table border="1" style="width: 50%;margin-left: 200px">
                          <tr>
                              <td colspan="2" style="font-size:8;text-align:center;">DETALLE DE VACACIONES</td>
                          </tr>
                          <tr>
                            <td style="font-size:8;text-align:center;">TOTAL DE VACACIONES</td>
                            <td style="font-size:8;text-align:center;">FECHAS A CUENTA DE VACACIÓN</td>
                          </tr>
                          <tr>
                         
                            <td style="font-size:8;text-align:center;">{{$dias_disponibles->nro_dias_disponibles}}</td>
                            <td style="font-size:8;text-align:center;">{{$inicio_date}} <br>HASTA <br>{{$date_fin}}</td>
                          </tr>
                        </table>
                </p>
                <br>
                <p style="width: 100%;font-size:10;text-align:justify;">
                   


Atentamente. <br>

                </p>
              </td>
          </tr>     
        </table>
        <pre id="footer">
        
          

SQQ
RSRG
rftc
C.C.:	  Original
        DRRHH
        File Personal
        UAP
        Kardex 
BAJA – {{$cargo_actual->nro_item}}
          

        </pre> 
        
            @break
            @case(4)
            <table>
                <tr>
                        <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                          <u>MEMORANDUM</u> <br>
                        </td>
                </tr>
            </table>
            <br>
            <table>
              <tr>
                      <td style="width: 49%">
                        <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                         <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                         <span style="font-size:12;">La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                      </td>
                      <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                        <div id="vertical" style=" text-align:center;"></div>
                        
                        
                      </td>
                      <td style="width: 49%;font-size:12;">
                          <span style="font-size:10; font-weight: bold;"> GADLP/SDEF/DRRHH/b/{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                          Señor (a): <br>
                      {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                      C.I. {{$empleado->ci}} <br>
                      ASUNTO: <span style="font-size:10; font-weight: bold;">AGRADECIMIENTO DE SERVICIOS
                    </span><br>
            
                      </td>
              </tr>
              <tr>
                  <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
              </tr>
              <tr>
                  <td colspan="3">
                   
                      <p style="width: 100%;font-size:10;text-align:justify;">
                          <br>Señor (a):  <br>
                          {{$memorandum->contenido}} 
                          Atentamente, <br> 
                      </p>
                  </td>
              </tr>
            </table>
            <pre id="footer">
SQQ
RSRG
rftc
C.C.:	  Original
        DRRHH
        File Personal
        UAP
        Kardex 
BAJA – {{$cargo_actual->nro_item}}
            </pre> 
            @break
            
            @case(5)
            <table>
                <tr>
                        <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                          <u>MEMORANDUM</u> <br>
                        </td>
                </tr>
            </table>
            <br>
            <table>
              <tr>
                      <td style="width: 49%">
                        <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                         <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                         <span style="font-size:12;"> La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                      </td>
                      <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                        <div id="vertical" style=" text-align:center;"></div>
                      </td>
                      <td style="width: 49%;font-size:12;">
                          <span style="font-size:10; font-weight: bold;">GADLP/SDEF/DRRHH-{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                          Señor (a): <br>
                          {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                          C.I. {{$empleado->ci}} <br>
                          ASUNTO: <span style="font-size:10; font-weight: bold;">DESIGNACION </span><br>
            
                      </td>
              </tr>
              <tr>
                  <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
              </tr>
              <tr>
                  <td colspan="3">
                      
                      <p style="width: 100%;font-size:10;text-align:justify;">
                          <br>Señor (a):  <br>
                          {{$memorandum->contenido}}
                          Atentamente, <br> 
                      </p>
                  </td>
              </tr>
            </table>
            <pre id="footer">
SQQ 
RSRG 
rftc 
C.C.:	DRRHH 
      File Personal 
      Activos Fijos 
      Registro 
DESIGNACION – {{$cargo->nro_item}}
            </pre> 
            @break


            @case(6)
            <table>
                <tr>
                        <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                          <u>MEMORANDUM</u> <br>
                        </td>
                </tr>
            </table>
            <br>
            <table>
              <tr>
                      <td style="width: 49%">
                        <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                         <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                         <span style="font-size:12;"> La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                      </td>
                      <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                        <div id="vertical" style=" text-align:center;"></div>
                      </td>
                      <td style="width: 49%;font-size:12;">
                          <span style="font-size:10; font-weight: bold;">GADLP/SDEF/DRRHH-{{$memorandum->numero_correlativo}}/{{$año}}</span> <br>
                          <span style="font-size:10; font-weight: bold;">  DE:</span>
                          {{$emitido_por->nombres}} {{$emitido_por->ap_paterno}} {{$emitido_por->ap_materno}}<br>
                          <span style="font-size:10; font-weight: bold;"> {{$cargo_actual_emitido->nombre}} </span><br>
                          <span style="font-size:10; font-weight: bold;"> A: </span>
                          {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                          <span style="font-size:10; font-weight: bold;">{{$cargo->nombre}}<br>
                          ASUNTO: LLAMADA DE ATENCION </span><br>
            
                      </td>
              </tr>
              <tr>
                  <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
              </tr>
              <tr>
                  <td colspan="3">
                      <p style="width: 100%;font-size:10;text-align:justify;">
                          <br>Señor (a):  <br>
                          {{$memorandum->contenido}} <br>
                          Atentamente.
                      </p>
                  </td>
              </tr>
            </table>
            <pre id="footer">
E.Q.T
C.c/Arch. 
C.c/DRRHH
            </pre> 
            @break
            @case(7)
            <table>
                <tr>
                        <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                          <u>MEMORANDUM</u> <br>
                        </td>
                </tr>
            </table>
            <br>
            <table>
              <tr>
                      <td style="width: 49%">
                        <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                         <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                         <span style="font-size:12;"> La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                      </td>
                      <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                        <div id="vertical" style=" text-align:center;"></div>
                      </td>
                      <td style="width: 49%;font-size:12;">
                          <span style="font-size:10; font-weight: bold;"> A: </span>
                          {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                          <span style="font-size:10; font-weight: bold;">{{$cargo->nombre}}<br>
                          ASUNTO: LACTANCIA</span><br>
            
                      </td>
              </tr>
              <tr>
                  <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
              </tr>
              <tr>
                  <td colspan="3">
                      <p style="width: 100%;font-size:10;text-align:justify;">
                          <br>Señor (a):  <br>
                          {{$memorandum->contenido}} <br>
                          <ul>
                            @if ($lactancia->fecha_inicio_postnatal==null)
                            <li>Fecha de inicio		: No tiene  fecha de inicio postnatal</li>  
                            @else
                            <li>Fecha de inicio		: {{$lactancia->fecha_inicio_postnatal}}</li>
                            @endif
                           @if ($lactancia->fecha_fin_postnatal==null)
                           <li>Fecha de conclusión		: No tiene fecha fin de postnatal</li>   
                           @else 
                           <li>Fecha de conclusión		: {{$lactancia->fecha_fin_postnatal}}</li>    
                           @endif
                           
                            <li>Días y Horarios		: Lunes a Viernes, su salida será 1 hora antes del horario establecido.</li>
                           </ul> <br>
                          Atentamente.<br>  
                      </p>
                  </td>
              </tr>
            </table>
            <pre id="footer">
RSRG
rftc
C.C.:   DRRHH
        File Personal
        Registro

            </pre> 
            @break
            @case(8)
            <table>
                <tr>
                        <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                          <u>MEMORANDUM</u> <br>
                        </td>
                </tr>
            </table>
            <br>
            <table>
              <tr>
                      <td style="width: 49%">
                        <center> <img src="{{asset('assets/img/logoreporte.png')}}" width="60px" alt="Image"/></center>
                         <span id="regular">Gobierno Autónomo Departamental de La Paz</span><br>
                         <span style="font-size:12;"> La Paz,{{$dia}} de {{$mes_actual}} de {{$año}}.	</span>
                      </td>
                      <td style="width: 2%; text-align:center; font-size:20px; font-weight: bold;">
                        <div id="vertical" style=" text-align:center;"></div>
                      </td>
                      <td style="width: 49%;font-size:12;">
                          <span style="font-size:10; font-weight: bold;"> A: </span>
                          {{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}} <br>
                          <span style="font-size:10; font-weight: bold;">{{$cargo->nombre}}<br>
                          ASUNTO: ROTACION</span><br>
                      </td>
              </tr>
              <tr>
                  <td colspan="3" style="width: 50%; text-align:center;"> <div id="vertical1"  style="width: 100%; text-align:center;"></div></td>
              </tr>
              <tr>
                  <td colspan="3">
                      <p style="width: 100%;font-size:10;text-align:justify;">
                      
                          <br>Señor (a):  <br>
                          {{$memorandum->contenido}} <br>
                          Sin otro particular, saludo a usted.<br>
                          Atentamente, <br>  
                      </p>
                  </td>
              </tr>
            </table>
            <pre id="footer">
GUM/blih
C.C.:   DRRHH
        File Personal
        Registro

            </pre> 
            @break
    @endswitch
</div>