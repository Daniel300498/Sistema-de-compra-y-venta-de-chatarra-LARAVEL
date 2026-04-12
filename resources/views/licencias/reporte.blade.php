@extends('layouts.app')
@section('titulo','Reportes')
@section('content')
<div class="pagetitle">
    <h1>Licencias</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="">Licencias</a></li>
        <li class="breadcrumb-item active">Reportes</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reportes</h5>
            <p>Para generar el reporte debe rellenar todos los campos y presionar el botón <strong>GENERAR PDF</strong> o <strong>GENERAR EXCEL</strong>dependiendo del formato en el que desee el reporte.</p>
           <!--CONTENIDO -->
           
           <form action="{{route('licencias.reporte_ver')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-6">
                  <label for="fecha_desde"> Fecha Desde:<span class="text-danger">(*)</span></label>
                      <input id="fecha_desde" type="date" class="form-control" name="fecha_desde" value="{{ old('fecha_desde') }}" required>
                </div>
                <div class="col-lg-6">
                  <label for="fecha_hasta"> Fecha Hasta:<span class="text-danger">(*)</span></label>
                      <input id="fecha_hasta" type="date" class="form-control" name="fecha_hasta" value="{{ old('fecha_hasta') }}" required>
                </div>

               
              </div>
              <div class="row">
                <div class="col-lg-6" >
                  <br>
                  {{Form::label('personal','Personal' )}} <span class="text-danger">(*)</span>
                  <select name="personal" class="form-control" required id="personal" onchange="personal_change()">
                      <option value="" selected>-- SELECCIONE --</option>
                      <option value="1">INDIVIDUAL </option>
                      <option value="2">GENERAL </option>
                  </select>
              </div> 
                
                <div class="col-lg-6" >
                    <br>
                    {{Form::label('tipo_licencia','Tipo Licencia' )}}
                    <select name="tipo_licencia"  class="form-control form-control {{ $errors->has('tipo_licencia') ? ' error' : '' }}" id="tipo_licencia" >
                      <option value="">--SELECCIONE--</option>
                      @foreach($tipo_licencia as $tipo_lic)
                          <option value="{{$tipo_lic->id}}" >{{$tipo_lic->descripcion}} </option>
                      @endforeach
                    </select>
                </div>
               
                <div class="col-lg-12" id="div_empleado" style="display: none">
                  <br>
                  {{Form::label('empleado','Empleado' )}}
                  <br>
                  <select name="empleado" id="empleado" class="form-control {{ $errors->has('empleado') ? ' error' : '' }}" style="width: 100%">
                      <option value="" selected>-- SELECCIONE --</option>
                      @foreach ($empleados as $e)
                          <option value="{{ $e->id }}">{{ $e->ci }} - {{ $e->nombres  }} {{$e->ap_paterno}} {{$e->ap_materno}}</option>
                      @endforeach
                  </select>
      
                </div>
                <div class="col-lg-6" id="div_lugar_trabajo" style="display: none">
                  <br>
                  {{Form::label('lugar_trabajo','Lugar De Trabajo' )}}
                  <select name="lugar_trabajo"  class="form-control form-control {{ $errors->has('lugar_trabajo') ? ' error' : '' }}" id="tipo_lugar" >
                    <option value="">--SELECCIONE--</option>
                    @foreach($lugares as $lugar)
                        <option value="{{$lugar->id}}" >{{$lugar->descripcion}} </option>
                    @endforeach
                  </select>
                </div>

                
                <div class="col-lg-6" id="div_area" style="display: none">
                   <br>
                  {{Form::label('area','Area' )}} 
                  <select name="area"  class="form-control form-control" id="area">
                  <option value="">--SELECCIONE--</option>
                  @foreach($areas as $a)
                    <option value="{{$a->id}}">{{$a->nombre}} </option>
                  @endforeach
                  </select>
                </div>
              </div>    
              

            </div>         
            <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">Buscar</button>
                
              {{-- <button type="submit" class="btn btn-primary" name="boton1">Generar PDF</button>
              <button type="submit" class="btn btn-danger" name="boton2" >Generar Excel</button> --}}
            </div>
         </form>
         <br>
         <br>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@if($info_empleado!=null)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Los datos que coinciden con la busqueda</h5>
                <!--CONTENIDO -->
                <p>Presione sobre el botón <strong>Generar PDF</strong> si quiere que se genere el pdf de la busqueda mostrada a continuación.</p>
                <p>Presione sobre el botón <strong>Generar Excel</strong> si quiere que se descargue el excel de la busqueda mostrada a continuación.</p>
              
                <div class="">

               <table style="width:100%; font-size:10">
                      <tr class="items">
                        <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">    
                        </th> 
                          <th style="width: 20%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            <form action="{{ route('licencias.reporte_descargar') }}" method="POST" target="_blank">
                                @csrf
                                <input type="hidden" name="info_empleado" value="{{ json_encode($info_empleado) }}">
                                <input type="hidden" name="tipo_reporte" value="pdf">
                                <input type="hidden" name="doc_lugar_trabajo" value="{{$doc_lugar_trabajo}}">
                                <input type="hidden" name="doc_area" value="{{$doc_area}}">
                                <input type="hidden" name="doc_tipo_licencia" value="{{$doc_tipo_licencia}}">
                                <input type="hidden" name="lugar_trabajo_busqueda" value="{{$lugar_trabajo_busqueda}}">
                                <input type="hidden" name="area_busqueda" value="{{$area_busqueda}}">
                                <input type="hidden" name="tipo_licencia_busqueda" value="{{$tipo_licencia_busqueda}}">
                                <input type="hidden" name="fecha_desde" value="{{$fecha_desde}}">
                                <input type="hidden" name="fecha_hasta" value="{{$fecha_hasta}}">
                                <button type="submit" class="btn btn-primary">Generar PDF</button>
                            </form>

                          </th>                  
                          <th style="width: 20%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            <form action="{{ route('licencias.reporte_descargar') }}" method="POST">
                              @csrf
                              <input type="hidden" name="info_empleado" value="{{ json_encode($info_empleado) }}">
                              <input type="hidden" name="tipo_reporte" value="excel">
                              <input type="hidden" name="doc_lugar_trabajo" value="{{$doc_lugar_trabajo}}">
                              <input type="hidden" name="doc_area" value="{{$doc_area}}">
                              <input type="hidden" name="doc_tipo_licencia" value="{{$doc_tipo_licencia}}">
                              <input type="hidden" name="lugar_trabajo_busqueda" value="{{$lugar_trabajo_busqueda}}">
                              <input type="hidden" name="area_busqueda" value="{{$area_busqueda}}">
                              <input type="hidden" name="tipo_licencia_busqueda" value="{{$tipo_licencia_busqueda}}">
                              <input type="hidden" name="fecha_desde" value="{{$fecha_desde}}">
                              <input type="hidden" name="fecha_hasta" value="{{$fecha_hasta}}">   
                              <button type="submit" class="btn btn-primary">Generar Excel</button>
                          </form>


                          </th>
                          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                          </th>                     
                      </tr>
                    </table>
      



               <table style="width:100%; font-size:10">
                <tr class="items">
                  <th style="width: 20%; text-align:center; border:none; font-size:10px; font-weight:bold;" >
                    <img src="{{asset('assets/img/escudoGobRed.png')}}" width="60px" alt="Image"/>
                    <br>
                    SUCURSAL LA PAZ 
                  </th>
                      <th style="width: 60%;  text-align:center; font-size:20px; font-weight: bold; border:none">
                          DIRECCIÓN DE RECURSOS HUMANOS <br>
                          REPORTE DE LICENCIAS <br>
                          FECHAS {{ date('d-m-Y', strtotime($fecha_desde))}} al {{ date('d-m-Y', strtotime($fecha_hasta))}}
                      </th> 
                    <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
                      Fecha <br>
                      
                      <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="{{date('d-m-Y')}}">
                    </th> 
              </tr>
              </table>
              <br>



                    
                
                    <table style="width:100%; font-size:10">
                      <tr class="items">
                        @if ($doc_lugar_trabajo == 1)
                          @if ($lugar_trabajo_busqueda != null)
                          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            SEDE: {{$lugar_trabajo_busqueda->descripcion}}
                          </th>
                          @endif
                        @endif
                        @if ($doc_area == 1)
                          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            AREA: {{$area_busqueda->nombre}}
                          </th>
                        @endif
                        @if ($doc_tipo_licencia == 1)
                          <th style="width: 30%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            TIPO LICENCIA: {{$tipo_licencia_busqueda->descripcion}}
                          </th>
                        @endif
                      </tr>
                    </table>
                    <br>
                       <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                           <thead>
                               <tr>
                                   <th class="text-center">N°</th>
                                   <th class="text-center">Nombre Completo</th>
                                   <th class="text-center">CI</th>
                                    @if ($doc_lugar_trabajo == 0)
                                      <th class="text-center">Sede</th>
                                    @endif
                                    @if ($doc_area == 0)
                                      <th class="text-center">Area</th>
                                    @endif
                                    @if ($doc_tipo_licencia == 0)
                                      <th class="text-center">Tipo</th>
                                    @endif
                                   <th class="text-center">N° Dias</th>
                                   <th class="text-center">Motivo</th>
                                   <th class="text-center">Fechas</th>
                                   <th class="text-center">Horas</th>
                                   <th class="text-center">Estado</th>
                               </tr>
                           </thead>
                           <tbody>
                            @if (count($info_empleado) > 0)
                            @foreach ($info_empleado as $index => $info_empleado_object)    
                            <tr>
                              <th style="height:30px;">{{ $index +1 }}</th>
                              <th class="text-center">{{$info_empleado_object->empleado->nombres}} {{$info_empleado_object->empleado->ap_paterno}} {{$info_empleado_object->empleado->ap_materno}}</th>
                              <th class="text-center">{{$info_empleado_object->empleado->ci}}</th>
                              @if ($doc_lugar_trabajo == 0)
                                @if ($info_empleado_object->empleado->ubicacion!=null)
                                  <th class="text-center">{{$info_empleado_object->empleado->ubicacion->descripcion}}</th>
                                @else
                                  <th></th>
                                @endif
                              @endif
                              @if ($doc_area == 0)
                                @if ($info_empleado_object->area_id!=null)
                                  <th class="text-center">{{$info_empleado_object->area_id->nombre}}</th>
                                @else
                                  <th></th>
                                @endif
                              @endif
                              @if ($doc_tipo_licencia == 0)
                                @if ($info_empleado_object->tipo!=null)
                                  <th class="text-center">{{$info_empleado_object->tipo->descripcion}}</th>
                                @else
                                  <th></th>
                                @endif
                              @endif
                              <th class="text-center">{{$info_empleado_object->numero_dias}}</th>
                              <th class="text-center">{{$info_empleado_object->motivo}}</th>
                          
                              <th class="text-center" style="font-size:12px">
                                @foreach ($info_empleado_object->fechas as $fecha)   
                                {{ date('d/m/Y', strtotime($fecha->fecha_inicio))}} al {{ date('d/m/Y', strtotime($fecha->fecha_hasta))}}
                                <br>
                                @endforeach
                              </th>
                      
                              <th class="text-center" style="font-size:12px">
                                @foreach ($info_empleado_object->fechas as $fecha)   
                                  @if($fecha->horario == '8')
                                   DIA COMPLETO
                                  <br>
                                  @else
                                  MEDIO DIA
                                  @endif
                                @endforeach
                              </th>
                              <th class="text-center">{{$info_empleado_object->estado->descripcion}}</th>
                            
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
                       </table>
                       
               </div>
               <!-- EndCONTENIDO Example -->
              </div>
            </div>
          </div>
        </div>
</section>
@endif

@endsection

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

function personal_change(){
  var pe= $('#personal').val();
  if(pe == 1){  
    $("#div_lugar_trabajo").css('display', 'none');
    $("#div_tipo_empleado").css('display', 'none');
    $("#div_area").css('display', 'none');
    $("#div_empleado").css('display', 'block');
  }else if( pe == 2)
  {
    $("#div_lugar_trabajo").css('display', 'block');
    $("#div_tipo_empleado").css('display', 'block');
    $("#div_area").css('display', 'block');
    $("#div_empleado").css('display', 'none');
  }
}
</script>

<script>
  
</script>

@section('scripts')
<script>
    $("#empleado").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
@endsection