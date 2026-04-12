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
  font-size: 5;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}  
  </style>  
  @switch($tipo)
      @case(1)
      <table  style="width:100%; font-size:5">
        <thead>
            <tr class="items" >
                    <th style="width: 30%;  text-align:center; font-weight: bold;" colspan="6">
                        DIRECCIÓN DE RECURSOS HUMANOS 
                        {{$titulo}}
                     </th> 
        </tr>
      </thead>
       </table>
      <table  style="width:100%; font-size:5">
        <thead>
        <tr style="background: darkgray;text-align:center;">
                  <th>Nº</th>
                  <th>CI</th>
                  <th>NOMBRES Y APELLIDOS</th> 
                  <th>CARGO</th>  
                  <th>FECHA INICIO</th>
                  <th>FECHA HASTA</th>
        </tr>
          </thead>
         <tbody>
                
        @foreach ($vacaciones as $key => $de)
      
        <tr>
        <th>{{$key+1}}</th>
          <th>{{$de->empleado->ci}}</th>
          <th> {{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
          <th>{{$de->empleado->cargo->first()->nombre}}</th>
          <th>{{date('d-m-Y', strtotime($de->fecha_inicio))}} </th>
          <th>{{date('d-m-Y', strtotime($de->fecha_hasta))}} </th>
        </tr>
        @endforeach
         </tbody>
      </table >
          @break
      @case(2)
      <table  style="width:100%; font-size:5">
        <thead>
            <tr class="items">
                    <th style="width: 30%;  text-align:center;font-weight: bold;" colspan="7">
                        DIRECCIÓN DE RECURSOS HUMANOS 
                        {{$titulo}}
                     </th> 
            </tr>
         </thead>
      </table>
      <table  style="width:100%; font-size:5">
        <thead>
          <tr style="background: darkgray;text-align:center;">
          <th>Nº</th>
                  <th>DEPENDENCIA</th>
                  <th>ITEM</th> 
                  <th>CARGO</th>
                  <th>NOMBRES Y APELLIDOS</th>
                  <th>CI</th >
                  <th>FECHA DE PERMISO</th>
                  <th>Total Dias </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($licencia as $key => $de)
          <tr>
          <th>{{$key+1}}</th>
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</th>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</th>
                  @else
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</th>
                  @endif
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</th>
                  <th>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{$de->empleado->ci}}</th>
                  <th>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</th>
                  <th>{{$de->numero_dias}} DIA</th>
          </tr>
          @endforeach
        </tbody>
      </table >
          @break     
          @case(3)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items">
                        <th style="width: 30%;  text-align:center;font-weight: bold;" colspan="7">
                            DIRECCIÓN DE RECURSOS HUMANOS 
                            {{$titulo}}
                         </th> 
                </tr>
             </thead>
          </table>
          <table  style="width:100%; font-size:5">
            <thead>
              <tr style="background: darkgray;text-align:center;">
              <th>Nº</th>
                  <th>DEPENDENCIA</th>
                  <th>ITEM</th> 
                  <th>CARGO</th>
                  <th>NOMBRES Y APELLIDOS</th>
                  <th>CI</th >
                  <th>FECHA DE PERMISO</th>
                  <th>Total Dias </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($licencia as $key => $de)
              <tr>
              <th>{{$key+1}}</th>
                <th>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</th>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</th>
                  @else
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</th>
                  @endif
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</th>
                  <th>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{$de->empleado->ci}}</th>
                  <th>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</th>
                  <th>{{$de->numero_dias}} DIA</th>
              </tr>
              @endforeach
            </tbody>
          </table >
          @break 
          {{-- //// --}}
          @case(4)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items">
                        <th style="width: 30%;  text-align:center;font-weight: bold;" colspan="7">
                            DIRECCIÓN DE RECURSOS HUMANOS 
                            {{$titulo}}
                         </th> 
                </tr>
             </thead>
          </table>
          <table  style="width:100%; font-size:5">
            <thead>
              <tr style="background: darkgray;text-align:center;">
              <th>Nº</th>
                  <th>DEPENDENCIA</th>
                  <th>ITEM</th> 
                  <th>CARGO</th>
                  <th>NOMBRES Y APELLIDOS</th>
                  <th>CI</th >
                  <th>FECHA DE PERMISO</th>
                  <th>Total Dias </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($licencia as $key => $de)
              <tr>
              <th>{{$key+1}}</th>
              <th>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</th>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</th>
                  @else
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</th>
                  @endif
                  <th>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</th>
                  <th>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{$de->empleado->ci}}</th>
                  <th>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</th>
                  <th>{{$de->numero_dias}} DIA</th>
              </tr>
              @endforeach
            </tbody>
          </table >
          @break

          @case(5)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="8">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table>
            <thead>
              <tr style="background: darkgray;text-align:center;">
              <th> Nº</th>
                  <th>CI</th>
                  <th>NOMBRES Y APELLIDOS</th> 
                  <th>DESDE</th>  
                  <th>HASTA</th>  
                  <th>Nº DE DIAS</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($licencia as $key => $de)
              <tr>
                <th>{{$key+1}}</th>
                <th> {{$de->empleado->ci}}</th>
                  <th> {{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))}}</th>
                  <th>{{date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))}}</th>
                  <th>{{$de->numero_dias}} </th>
              </tr>
              @endforeach
            </tbody>
          </table >
          @break
          @case(6)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 30%;  text-align:center;font-weight: bold;" colspan="9">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      {{$titulo}}
                      </th> 
                </tr>
            </thead>
          </table>
          <table>
            <thead>
              <tr style="background: darkgray;text-align:center;">
              <th>Nº</th>
                  <th>FECHA REGISTRO</th>
                  <th>CI</th>
                  <th>NOMBRES Y APELLIDOS</th> 
                  <th>CARGO</th>  
                  <th>FECHA NACIMIENTO</th>
                  <th>CIUDAD</th>
                  <th>NUMERO CELULAR</th>
                  <th>PROFESION</th>
              </tr>
            </thead>
            <tbody>
             
              @foreach ($empleado as $key => $de)
              <tr>
              <th>{{$key+1}}</th>
                  <th>{{date('d-m-Y', strtotime($de->fecha_inicio))}}</th>
                  <th> {{$de->empleado->ci}}</th>
                  <th>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{$de->cargo->nombre}}</th>
                  <th>{{date('d-m-Y', strtotime($de->empleado->fecha_nacimiento))}}</th>
                  <th>{{$de->empleado->ciudad->depto}}</th>
                  <th>{{$de->empleado->contacto_telefono}} </th>
                  <th>{{$de->empleado->profesion->descripcion}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(7)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                  <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                  DIRECCIÓN DE RECURSOS HUMANOS <br>
                    {{$titulo}}
                  </th> 
            </tr>
              <tr style="background: darkgray;text-align:center;">
              <th>Nº</th>
              <th>FECHA CONCLUSION</th>
              <th>CI</th>
              <th>NOMBRES Y APELLIDOS</th> 
              <th>CARGO</th>  
              <th>ITEM</th>
              <th>TIPO DE BAJA</th>
            </tr>
              </thead>
              <tbody>
            @foreach ($empleado as $key => $de)
            <tr>
            <th>{{$key+1}}</th>
                  <th>{{date('d-m-Y', strtotime($de->fecha_conclusion))}}</th>
                  <th> {{$de->empleado->ci}}</th>
                  <th>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</th>
                  <th>{{$de->cargo->nombre}}</th>
                  @if($de->cargo->nro_item)
                  <th>{{$de->cargo->nro_item}}</th>
                  @else
                  <th>{{$de->cargo->tipo_cargo}}</th>
                  @endif
                  <th>{{$de->tipo_baja}}</th>
            </tr>
            @endforeach
          </tbody>
          </table >
          @break
          @case(8)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th> PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(9)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(10)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(11)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(12)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(13)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break
          @case(14)
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                   
                        <th style="width: 30%;  text-align:center;font-weight: bold;"  colspan="9">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            {{$titulo}}
                         </th> 
                </tr>
            </thead>
          </table>
          <table >
            <thead>
              <tr  style="background: darkgray;text-align:center;">
                <th>Nº</th>
                <th>DEPENDENCIA</th>
                <th>CARGO</th>
                <th>ITEM</th> 
                <th>PATERNO</th>  
                <th>MATERNO</th>
                <th>NOMBRES</th>
                <th>CI</th>
                <th>FECHA DE INGRESO</th>
                <th>Nº MEMO</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($variable as $key => $de)
              @php
                $fechaComoEntero = strtotime($de->fecha_inicio);
                $año= date("Y", $fechaComoEntero);
              @endphp
              <tr>
                <th>{{$key+1}}</th>
                <th>{{$de->nombre}}</th>
                <th>{{$de->nombre_cargo}}</th>
                <th>{{$de->nro_item}}</th>
                <th>{{$de->ap_paterno}}</th>
                <th>{{$de->ap_materno}}</th>
                <th> {{$de->nombres}}  </th>
                <th>{{$de->ci}}</th>
                <th>{{$de->fecha_inicio}}</th>
                <th>{{$de->numero_correlativo}}/{{$año}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @break


          {{-- /// --}}
  @endswitch