

<link rel="stylesheet" type="text/css" href="{{url('/assets/css/orden_salida/pdf_orden_salida.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

<div class="margin-top">
   <div style="border: solid 1px #4e4b4bfa; border-radius:20px; width: 80%;">
      <div style="padding: 12px; background-image: 
        url('assets/img/fondo_orden.png');
    background-size: 560px;
    background-repeat: no-repeat;
    background-position: center;">
         <table class="title">
            <tr class="items">
                  <td style="width: 20%; text-align:center">
                     <img src="{{asset('assets/img/escudoGobiernoAutonomo.png')}}" width="50px" alt="Image"/>
                     
                  </td>
                  <td style="width: 60%; text-align:center; font-weight: bold;">

                     <div style="font-size: 12px; font-weight: bold; margin-top: -10px; padding: 0;">
                        GOBIERNO AUT&Oacute;NOMO DEPARTAMENTAL DE LA PAZ 
                     </div>
                     <div style="font-size: 15px; font-weight: bold;  margin-top: -10px; padding: 0;">
                        DIRECCI&Oacute;N DE RECURSOS HUMANOS  
                     </div>

                     <div style="font-size: 24px; margin-top: -10px;">ORDEN DE SALIDA</div>
         
                     <div style="font-size: 12px; font-weight: bold; margin-top: -10px;">
                        La Paz - Bolivia
                     </div>
 
                  </td>
                  <td style="width: 20%; text-align:center"> 
                  <img src="{{asset('assets/img/escudoCondor.png')}}" width="70px" alt="Image"/>
                  
                     <table class="body" style="margin-top:2px;">
                        <tr class="items">
                           <td style="width: 30%; text-align:center; " >
                              <fieldset class='float-label-field'>
                                 <label for="txtName">C.I:</label>
                              </fieldset>
                           </td>
                           <td style="width: 70%; text-align:center" >
                              <fieldset class='float-label-field'>
                                 
                                 <input style="border-bottom-style: dotted;" id="txtName" type='text' value="{{$empleado->ci}}">
                              </fieldset>
                           </td>
                        </tr>
                     </table>
                  </td>
            </tr>
         </table>

   

         <table class="body">
            <tr class="items">
                     <td style="width: 15%; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Fecha:</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="{{ date('d-m-Y', strtotime($ordenSalida->fecha_creacion_solicitud))}}">
                         
                        </fieldset>
                     </td>
                     <td style="width: 15%;" >
                        <fieldset class='float-label-field'>
                           <label for="txtName">N° Registro Biom&eacute;trico:</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="{{$ordenSalida->registro_biometrico}}">
                        </fieldset>
                     </td>
            </tr>      
         </table>
   
         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%;" >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Nombre Completo:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="{{$empleado->nombres}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}">
                   </fieldset>
                </td>
            </tr>
         </table>

         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Cargo:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="{{$empleado->cargo_actual[0]->pivot['cargos.nombre']}}">
                   </fieldset>
                </td>
            </tr>
         </table>

         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%;  " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Dependencia:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="{{ $area->nombre }}">
                   </fieldset>
                </td>
            </tr>
         </table>
         

         @if($ordenSalida->nombre_aprobado_denegado_jefe!=null)
         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%;  " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Jefe:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="{{ $ordenSalida->nombre_aprobado_denegado_jefe }}">
                   </fieldset>
                </td>
            </tr>
         </table>
         @endif


         <br>
         <table class="body">
            <tr class="items">
                     <td style="width: 15%; text-align:center; " >
                        <fieldset class='float-label-field'>
                            <label for="txtName">Tipo Empleado:</label>
                         </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                            @if ($empleado->cargo[0]->pivot['cargos.tipo_cargo']=="ITEM")
                               <input id="txtName" type='text' value="{{$empleado->cargo[0]->pivot['cargos.tipo_cargo']}} - {{$empleado->cargo[0]->pivot['cargos.nro_item']}}">      
                            @else
                               <input id="txtName" type='text' value="{{$empleado->cargo[0]->pivot['cargos.tipo_cargo']}}">                 
                            @endif
                          </fieldset>
                     </td>
                     <td style="width: 15%; text-align:center; " >
                        <fieldset class='float-label-field'>
                            <label for="txtName">Solicitud de:</label>
                         </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                            <input id="txtName" type='text' value="{{ $tipo->descripcion }}">
                         </fieldset>
                     </td>
            </tr>      
         </table>

         <br>
         <table class="body">
            <tr class="items">
                     <td style="width: 15%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Sale:</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="{{$ordenSalida->hora_salida}}">
                        </fieldset>
                     </td>
                     <td style="width: 15%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Retorna:</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="{{$ordenSalida->hora_retorno}}">
                        </fieldset>
                     </td>
            </tr>      
         </table>

         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Motivo:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="{{$ordenSalida->motivo}}">
                   </fieldset>
                </td>
            </tr>
         </table>

         <br>
         <br>
      
         <table class="body">
            <tr class="items">
               <td style="width: 5%; text-align:center">          
               </td>
            <td style="width: 45%; text-align:center; " >
               <fieldset class='float-label-field-observacion'>
                  <label for="txtName">OBSERVACIONES</label>
                  <input id="txtName" type='text' value="">
                  @if($ordenSalida->observacion != null)
                  <p>{{$ordenSalida->observacion}}</p>
                  @else
                  <p> Por el momento no hay observaciones   </p>
                  @endif
               </fieldset>
            </td>
    
            <td style="width: 45%; text-align:center" >
               <fieldset class='float-label-field-observacion'>
                  <label for="txtName">FECHA DE PRESENTACI&Oacute;N</label>
                  <input id="txtName" type='text' value="">
                  @if($ordenSalida->fecha_aprobado_denegado_rrhh == null)
                     <p> Aún no se entrego la boleta a RRHH   </p>
                  @else
                     <p>{{ date('d-m-Y', strtotime($ordenSalida->fecha_aprobado_denegado_rrhh))}}</p>
                  @endif
                  </fieldset>
            </td>
            <td style="width: 5%; text-align:center">    
            </td>
            </tr>
         </table>


         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Fecha de entrega a Control de Personal:</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value=".">
                   </fieldset>
                </td>
            </tr>
         </table>


         <br>
          


     
         
      
        
      </div>
   </div>
</div>















