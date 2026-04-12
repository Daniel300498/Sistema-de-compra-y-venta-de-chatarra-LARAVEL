@extends('layouts.app')
@section('titulo','Reportes')
@section('content')
<div class="pagetitle">
    <h1>Reportes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
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
            <p>Para generar el reporte debe rellenar todos los campos, posteriormente presionar el bot&oacute;n <strong>GENERAR PDF</strong> o <strong>GENERAR EXCEL</strong> de acuerdo al formato que requiera el reporte.</p>
           <!--CONTENIDO -->
           
           <form action="{{route('reporte.pdf')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-4">
                  <label for="fecha_desde"> Fecha Desde:<span class="text-danger">(*)</span></label>
                      <input id="fecha_desde" type="date" class="form-control" name="fecha_desde" value="{{ old('fecha_desde') }}" >
                      @if ($errors->has('fecha_desde'))
                      <span class="text-danger">{{ $errors->first('fecha_desde') }}</span>
                    @endif
                  </div>
               
                <div class="col-lg-4">
                  <label for="fecha_hasta"> Fecha Hasta:<span class="text-danger">(*)</span></label>
                      <input id="fecha_hasta" type="date" class="form-control" name="fecha_hasta" value="{{ old('fecha_hasta') }}" >
                      @if ($errors->has('fecha_hasta'))
                      <span class="text-danger">{{ $errors->first('fecha_hasta') }}</span>
                     @endif
                    </div>
                <div class="col-lg-4" >
                  {{Form::label('tipo_reporte','Tipo Reporte' )}} <span class="text-danger">(*)</span>
                  <select name="tipo_reporte" class="form-control"  id="tipo_reporte">
                      <option value="" selected>-- SELECCIONE --</option>
                      <option value="1">Vacaciones </option>
                      <option value="2">Con Goce De Haber</option>
                      <option value="3">Sin Goce De Haber</option>
                      <option value="4">Licencias</option>
                      <option value="5">Bajas M&eacute;dicas</option>
                      <option value="6">Personal Activo</option>
                      <option value="7">Personal Pasivo</option>
                  </select>
                  @if ($errors->has('tipo_reporte'))
                      <span class="text-danger">{{ $errors->first('tipo_reporte')}}</span>
                  @endif
                </div>
              </div>
              <div class="row"> 
                <div class="col-lg-4" >
                  <br>
                  {{Form::label('lugar_trabajo','Lugar De Trabajo' )}}
                  <select name="lugar_trabajo"  class="form-control form-control {{ $errors->has('lugar_trabajo') ? ' error' : '' }}" id="tipo_lugar" >
                    <option value="">--SELECCIONE--</option>
                    @foreach($lugares as $lugar)
                        <option value="{{$lugar->id}}" >{{$lugar->descripcion}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4" >
                <br>
                {{Form::label('tipo_empleado','Tipo De Empleado' )}}
                  <select name="tipo_empleado" class="form-control" id="tipo_empleado">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="ITEM">ITEM </option>
                      <option value="CONSULTOR INDIVIDUAL DE LINEA">CONSULTOR INDIVIDUAL DE LINEA</option>
                      <option value="PERSONAL EVENTUAL">PERSONAL EVENTUAL</option>
                      <option value="PASANTES">PASANTES</option> 
                  </select>
                </div>
                <div class="col-lg-4" >
                   <br>
                  {{Form::label('area','&Aacute;rea' )}} 
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
<!-- EndCONTENIDO Example -->

@if(count($variable)>0)
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

        <div class="d-flex align-items-center justify-content-between">
            <p>  
              <form id="formulario-enviar" action="{{ route('reporte.pdfs') }}" method="POST" >
                @csrf
                {{ Form::hidden('tipo_reporte', $tipo) }}
                {{ Form::hidden('titulo', $titulo) }}
                {{ Form::hidden('variable', base64_encode(serialize($variable))) }}
                 <br>
                <button type="submit" class="btn btn-primary" name="boton1">Generar PDF</button>
                <button type="submit" class="btn btn-danger" name="boton2" >Generar Excel</button>
              </form>
            </p>
          </div>
          <h5  class="card-title text-center">{{$titulo}}</h5>
          <h6  class="card-title text-center">DEL {{ date('d-m-Y', strtotime($fecha_ini))}} AL {{date('d-m-Y', strtotime($fecha_fin))}} </h6>
          <div class="table-responsive">
            @switch($tipo)
            @case(1)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{$de->empleado->ci}}</td>
                  <td> {{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->empleado->cargo->first()->nombre}}</td>
                  <td>{{date('d-m-Y', strtotime($de->fecha_inicio))}} </td>
                  <td>{{date('d-m-Y', strtotime($de->fecha_hasta))}} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break   
            @case(2)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</td>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</td>
                  @else
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</td>
                  @endif
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</td>
                  <td>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->empleado->ci}}</td>
                  <td>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</td>
                  <td>{{$de->numero_dias}} DIA</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(3)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</td>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</td>
                  @else
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</td>
                  @endif
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</td>
                  <td>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->empleado->ci}}</td>
                  <td>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</td>
                  <td>{{$de->numero_dias}} DIA</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(4)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->area->nombre}}</td>
                  @if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM")
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nro_item}}</td>
                  @else
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->tipo_cargo}}</td>
                  @endif
                  <td>{{$de->empleado->cargoEmpleados->first()->cargo->nombre}}</td>
                  <td>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->empleado->ci}}</td>
                  <td>{{ date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio)) }} al <br> {{ date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta)) }}</td>
                  <td>{{$de->numero_dias}} DIA</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(5)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td> {{$de->empleado->ci}}</td>
                  <td> {{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))}}</td>
                  <td>{{date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))}}</td>
                  <td>{{$de->numero_dias}} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(6)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{date('d-m-Y', strtotime($de->fecha_inicio))}}</td>
                  <td> {{$de->empleado->ci}}</td>
                  <td>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->cargo->nombre}}</td>
                  <td>{{date('d-m-Y', strtotime($de->empleado->fecha_nacimiento))}}</td>
                  <td>{{$de->empleado->ciudad->depto}}</td>
                  <td>{{$de->empleado->contacto_telefono}} </td>
                  <td>{{$de->empleado->profesion->descripcion}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(7)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
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
                @foreach ($variable as $key => $de)
                <tr>
                  <th>{{$key+1}}</th>
                  <td>{{date('d-m-Y', strtotime($de->fecha_conclusion))}}</td>
                  <td> {{$de->empleado->ci}}</td>
                  <td>{{$de->empleado->nombres}} {{$de->empleado->ap_paterno}} {{$de->empleado->ap_materno}}</td>
                  <td>{{$de->cargo->nombre}}</td>
                  @if($de->cargo->nro_item)
                  <td>{{$de->cargo->nro_item}}</td>
                  @else
                  <td>{{$de->cargo->tipo_cargo}}</td>
                  @endif
                  <td>{{$de->tipo_baja}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(8)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
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
            @case(9)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
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
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
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
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>Nº</th>
                  <th>DEPENDENCIA</th>
                  <th>CARGO</th>
                  <th>ITEM</th> 
                  <th>PATERNO</th>  
                  <th>MATERNO</th>
                  <th>NOMBRES</th>
                  <th>CI</th>
                  <th>FECHA DE INGRESO</th>
                  <th>Nº MEMO
                  </th>
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
            @endswitch
           
            <br><br>
          </div>
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>
@else
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><center>NO HAY RESULTADOS</center></h5>
        </div>
      </div>
    </div>
  </div>

</section>
@endif
<script>
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo a���o
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fecha_desde').value=ano+"-"+mes+"-"+dia;
  document.getElementById('fecha_hasta').value=ano+"-"+mes+"-"+dia;
}
</script>
<script>
    document.getElementById('formulario-enviar').addEventListener('submit', function(e) {
 console.log(e.submitter.name);
  if(e.submitter.name == "boton1"){
    var  a=document.getElementById("formulario-enviar").action = "{{route('reporte.pdfs')}}"; 
  }else{
    var  b=document.getElementById("formulario-enviar").action = "{{route('reporte.excel')}}"; 
  }
 
});
</script>
@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
@section('scripts')
<script>
  $("#area").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_empleado").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_reporte").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_lugar").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
@endSection
