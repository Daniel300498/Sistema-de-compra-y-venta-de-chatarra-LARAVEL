@extends('layouts.app')
@section('titulo','Reportes')
@section('content')
<div class="pagetitle">
    <h1>Memorandums</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="">Memorandums</a></li>
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
           
           <form action="{{route('documentomemorandum.reporte_ver')}}" method="POST" enctype="multipart/form-data">
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
                    {{Form::label('tipo_memorandum','Tipo Memorandum' )}} 
                    <select name="tipo_memorandum" class="form-control form-control {{ $errors->has('tipo_memorandum') ? ' error' : '' }}" id="tipo_memorandum" >
                      <option value="">--SELECCIONE--</option>
                      @foreach($tipo_memorandum as $tipo_memo)
                          <option value="{{$tipo_memo->id}}" >{{$tipo_memo->descripcion}} </option>
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
                            <form action="{{ route('documentomemorandum.reporte_descargar') }}" method="POST" target="_blank">
                                @csrf
                                <input type="hidden" name="info_empleado" value="{{ json_encode($info_empleado) }}">
                                <input type="hidden" name="tipo_reporte" value="pdf">
                                <input type="hidden" name="fecha_desde" value="{{$fecha_desde}}">
                                <input type="hidden" name="fecha_hasta" value="{{$fecha_hasta}}">
                                <button type="submit" class="btn btn-primary">Generar PDF</button>
                            </form>

                          </th>                  
                          <th style="width: 20%;  text-align:center; font-size:15px; font-weight: bold; border:none">
                            <form action="{{ route('documentomemorandum.reporte_descargar') }}" method="POST">
                              @csrf
                              <input type="hidden" name="info_empleado" value="{{ json_encode($info_empleado) }}">
                              <input type="hidden" name="tipo_reporte" value="excel">
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
                          REPORTE DE MEMORANDUMS <br>
                          FECHAS {{ date('d-m-Y', strtotime($fecha_desde))}} al {{ date('d-m-Y', strtotime($fecha_hasta))}}
                      </th> 
                    <th style="width: 20%;  text-align:center; font-size:13px; font-weight: bold; border:none">
                      Fecha <br>
                      
                      <input style="border:none; border-bottom-style: dotted; " id="txtName" type='text' value="{{date('d-m-Y')}}">
                    </th> 
              </tr>
              </table>
              <br>



                    
                
                   
                    <br>
                       <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                           <thead>
                               <tr>
                                   <th class="text-center">N°</th>
                                   <th class="text-center">Nombre Completo</th>
                                   <th class="text-center">CI</th>
                                   <th class="text-center">Cargo</th> 
                                   <th class="text-center">Lugar de Trabajo</th>
                                   <th class="text-center">Fecha</th>
                                   <th class="text-center">Tipo</th>
                               </tr>
                           </thead>
                           <tbody>
                            @if (count($info_empleado) > 0)
                            @foreach ($info_empleado as $index => $info_empleado_object)    
                            <tr>
                              <th style="height:30px;">{{ $index +1 }}</th>
                              <th class="text-center">{{$info_empleado_object->empleado->nombres}} {{$info_empleado_object->empleado->ap_paterno}} {{$info_empleado_object->empleado->ap_materno}}</th>
                              <th class="text-center"> {{$info_empleado_object->empleado->ci}}</th>
                              <th class="text-center">
                              @if(count($info_empleado_object->empleado->cargo_actual) > 0)
                                  {{$info_empleado_object->empleado->cargo_actual[0]->nombre}}
                              @else
                                  --- Sin cargo actual ---
                              @endif
                              </th>
                              <th class="text-center">{{$info_empleado_object->empleado->ubicacion->descripcion}}</th>
                              <th class="text-center"> {{ \Carbon\Carbon::parse($info_empleado_object->fecha_registro)->format('d/m/Y') }}</th>
                              
                              <th class="text-center">{{$info_empleado_object->tipo_id->descripcion}}</th>
                            

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
    $("#div_tipo_empleado").css('display', 'none');
    $("#div_empleado").css('display', 'block');
  }else if( pe == 2)
  {
    $("#div_tipo_empleado").css('display', 'block');
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