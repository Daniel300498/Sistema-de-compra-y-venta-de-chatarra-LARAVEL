@extends('layouts.app')
@section('titulo','Reportes')
@section('content')
<div class="pagetitle">
    <h1>KARDEX</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
         <li class="breadcrumb-item"><a href="">Kardex</a></li>
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
            <p>Para generar el reporte debe rellenar todos los campos y dependiendo del formato en el que desee el reporte presionar el botón <strong>GENERAR PDF</strong> o <strong>GENERAR EXCEL</strong>.</p>
           <!--CONTENIDO -->
           
           <form action="{{route('reportes.generate')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-4">
                  <label for="fecha_desde"> Fecha Desde:<span class="text-danger">(*)</span></label>
                      <input id="fecha_desde" type="date" class="form-control" name="fecha_desde" value="{{ old('fecha_desde') }}" >
                </div>
                <div class="col-lg-4">
                  <label for="fecha_hasta"> Fecha Hasta:<span class="text-danger">(*)</span></label>
                      <input id="fecha_hasta" type="date" class="form-control" name="fecha_hasta" value="{{ old('fecha_hasta') }}" >
                </div>
                <div class="col-lg-4" >
                  {{Form::label('tipo_reporte','Tipo Reporte' )}} <span class="text-danger">(*)</span>
                  <select name="tipo_reporte" class="form-control" required id="tipo_reporte">
                    <option value="" selected>-- SELECCIONE --</option>                    
                      <option value="8">Altas Personal</option>
                      <option value="9">Bajas Personal</option>
                      <option value="10">Tranferecias Personal</option>
                      <option value="11">Promociones Personal</option>
                       <!--<option value="12">Lactancia Personal</option>
                      <option value="13">Llamada De Atencion Personal</option>
                      <option value="14">Rotacion Personal</option> -->
                  </select>
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
                      <option value="CONSULTORES">CONSULTORES</option>
                      <option value="EVENTUALES">EVENTUALES</option>
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
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <p>  
              <form id="formulario-enviar" action="{{ route('reportes.pdfs') }}" method="POST" >
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
          <h5  class="card-title"> <center>{{$titulo}}</center></h5>
          <div class="table-responsive">
            @switch($tipo)
            @case(8)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE INGRESO
                  </th>
                  <th >
                      Nº MEMO
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
            @case(9)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE BAJA
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
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
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE TRANFERENCIA
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
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
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE PROMOCIONES
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
                  <th>{{$de->numero_correlativo}}/{{$año}}</th>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(12)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE LACTANCIA
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
                  <th>{{$de->numero_correlativo}}/{{$año}}</th>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(13)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE LLAMADA ATENCION
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
                  <th>{{$de->numero_correlativo}}/{{$año}}</th>
                </tr>
                @endforeach
              </tbody>
            </table>
            @break
            @case(14)
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr style="background: darkgray;text-align:center;">
                  <th>
                      Nº
                  </th>
                  <th>
                      DEPENDENCIA
                  </th>
                  <th>
                      CARGO
                  </th>
                  <th>
                      ITEM
                  </th> 
                  <th >
                      PATERNO
                  </th>  
                  <th >
                       MATERNO
                  </th>
                  <th >
                      NOMBRES
                  </th>
                  <th >
                      CI
                  </th >
                  <th >
                      FECHA DE ROTACION
                  </th>
                  <th >
                      Nº MEMO
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
                  <th>{{$de->fecha_emision}}</th>
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
    var  a=document.getElementById("formulario-enviar").action = "{{route('reportes.pdfs')}}"; 
  }else{
    var  b=document.getElementById("formulario-enviar").action = "{{route('reportes.excel')}}"; 
  }
 
});
</script>
@endSection
@section('scripts')
<script>
  $("#area").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_empleado").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_reporte").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
<script>
  $("#tipo_lugar").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>
@endSection