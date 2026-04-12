@extends('layouts.app')
@section('titulo','Reportes')
@section('content')
<div class="pagetitle">
    <h1>Registro Lactancia</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Registro Lactancia</a></li>
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
            <p>Para generar el reporte debe seleccionar un rango de fechas y el tipo de reporte que puede ser <strong>PDF</strong> o <strong>EXCEL</strong>, se mostrar&aacute; las firmas de lactancia prenatal que fueron entregadas entre esas fechas ( para ver las lactancias del mes se debe seleccionar el primero y &uacute;ltimo d&iacute;a del mes actual ).</p>
           <!--CONTENIDO -->
           
           <form id="pdfForm" action="{{route('lactancias.reporte_ver')}}" method="POST" enctype="multipart/form-data"  >
            {{ csrf_field()}}
            <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-6">
                  <label for="fecha_desde"> Selecciona la fecha(se obtendr&aacute; el mes para el reporte):<span class="text-danger">(*)</span></label>
                  <input id="fecha_desde"  type="date" class="form-control text-center" name="fecha_desde" value="{{ old('fecha_desde') }}" required >
                </div>
                
              <div class="col-lg-6" >
                {{Form::label('reporte','Tipo Reporte' )}} <span class="text-danger">(*)</span>
                <select id="reporte" name="reporte" class="form-control text-center" required>
                  <option value="" selected>-- SELECCIONE --</option>
                  <option value="pdf">PDF</option>
                    <option value="excel">EXCEL</option>
                </select>
            </div>
              </div>         
            <div class="text-center mt-3">
              <button type="button" class="btn btn-primary" onclick="submitForm()">Generar</button> 
              <a href="{{ route('lactancias.index') }}" class="btn btn-danger">Salir</a>
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



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('scripts')
<script>
    function submitForm() {
        // Encuentra el formulario por su ID
        var form = document.getElementById('pdfForm');
        // Cambia el atributo target del formulario a _blank
        var sel = document.getElementById("reporte");
        var str= sel.options[sel.selectedIndex].text;
        if(str == 'PDF'){
          form.target = '_blank';
        }

        // Envia el formulario
        form.submit();
    }
</script>

@endsection