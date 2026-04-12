@extends('layouts.app')
@section('titulo','Consulta')
@section('content')

<div class="pagetitle">
    <h1>Consulta M&eacute;dica</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Reporte Declaración </li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reporte Declaraciones Excel</h5>
           <!--CONTENIDO -->
           
           <hr >
           <form action="{{route('reporte_contraloria_excel')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            {{-- <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}"> --}}
           
              
              <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-4" >
                    {{Form::label('tipo','Tipo Declaración' )}} <span class="text-danger">(*)</span>
                    <select name="tipo" class="form-control" required>
                      <option value="" selected>-- SELECCIONE --</option>
                      <option value="1">Por Asumir</option>
                        <option value="2" >Por Actualización</option>
                        <option value="3">Después Del Ejercicio Del Cargo</option>
                    </select>
                </div>
                <div class="col-lg-4" >
                  {{Form::label('trimestre','Trimestre' )}} <span class="text-danger">(*)</span>
                  <select name="trimestre" class="form-control" required>
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Primer Trimestre</option>
                      <option value="2" >Segundo Trimestre</option>
                      <option value="3">Tercer Trimestre</option>
                      <option value="4">Cuarto Trimestre</option>
                  </select>
              </div>
                <div class="col-lg-4" >
                  {{Form::label('gestion','Gestion' )}} <span class="text-danger">(*)</span>
                  <?php
                  $cont = date('Y');
                  ?>
                  <select id="sel1" class="form-control" name="gestion" required>
                  <?php while ($cont >= 2019) { ?>
                    <option value="<?php echo($cont); ?>" selected><?php echo($cont); ?></option>
                  <?php $cont = ($cont-1); } ?>
                  </select>
              </div>
              </div>         
            <div class="text-center mt-3">
                
                <button type="submit" class="btn back-color-second" >Generar</button>
                <a href="{{ route('declaraciones.excel') }}" class="btn back-color-first">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection