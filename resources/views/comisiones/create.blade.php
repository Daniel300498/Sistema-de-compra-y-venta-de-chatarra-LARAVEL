@extends('layouts.app')
@section('titulo','Comision')
@section('content')

<div class="pagetitle">
    <h1>Comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Comisión</li>
      </ol>
    </nav>

</div><!-- End Page Title -->

@can('comisiones.create')
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Registrar Comisión</h5>
              <h3><span class="badge bg-nombre-empleado">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{$empleado->ap_materno }}</span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
            <form action="{{route('comisiones.store')}}" method="POST" enctype="multipart/form-data">
             {{ csrf_field()}}
             <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
               <div class="row mb-3">
                 <div class="col-lg-4">
                   {{Form::label('fecha_inicio','Fecha Inicio')}} <span class="text-danger">(*)</span>
                       <input id="fecha_inicio" type="date" class="form-control {{ $errors->has('fecha_inicio') ? ' error' : '' }}" name="fecha_inicio" maxlength="8" value="{{ old('fecha_inicio') }}">
                       @if ($errors->has('fecha_inicio'))
                           <span class="text-danger">
                               {{ $errors->first('fecha_inicio') }}
                           </span>
                       @endif
                 </div>
                 <div class="col-lg-4">
                   {{Form::label('fecha_fin','Fecha Fin')}} <span class="text-danger">(*)</span>
                       <input id="fecha_fin" type="date" class="form-control {{ $errors->has('fecha_fin') ? ' error' : '' }}" name="fecha_fin" maxlength="8" value="{{ old('fecha_fin') }}">
                       @if ($errors->has('fecha_fin'))
                           <span class="text-danger">
                               {{ $errors->first('fecha_fin') }}
                           </span>
                       @endif
                 </div>
                 <div class="col-lg-4">
                   {{Form::label('tipo','Tipo Jornada' )}} <span class="text-danger">(*)</span>
                   <select name="tipo_jornada" class="form-control {{ $errors->has('tipo_jornada') ? ' error' : '' }}" id="tipo_jornada" Onchange = "mostrar()" data-old="{{ old('tipo_jornada') }}">
                     <option value="" selected>-- SELECCIONE --</option>
                     <option value="1" {{ old('tipo_jornada')==1 ? 'selected' : '' }}>Jornada Laboral</option>
                     <option value="2" {{ old('tipo_jornada')==2 ? 'selected' : '' }}>Jornada No Laboral</option>
                   </select>
                   @if ($errors->has('tipo_jornada'))
                        <span class="text-danger">
                            {{ $errors->first('tipo_jornada') }}
                        </span>
                    @endif
               </div>
              </div>
               
               <div class="row">
                 <div class="col-lg-4">
                   {{Form::label('','Tipo Comision' )}} <span class="text-danger">(*)</span>
                   <select name="tipo_comision" class="form-control {{ $errors->has('tipo_comision') ? ' error' : '' }}"  id="tipo_comision">
                     <option value="" selected>-- SELECCIONE --</option>
                     <option value="1" {{ old('tipo_comision')==1 ? 'selected' : '' }} >Misma Cede</option>
                     <option value="2" {{ old('tipo_comision')==2 ? 'selected' : '' }}>Distinta Cede</option>
                     <option value="3" {{ old('tipo_comision')==3 ? 'selected' : '' }}>Exterior</option>
                   </select>
                   @if ($errors->has('tipo_comision'))
                   <span class="text-danger">
                       {{ $errors->first('tipo_comision') }}
                   </span>
               @endif
               </div>
                 <div class="col-lg-4"style="display: none" id="bloque">
                   <label for="hora_entrada" style="display: none" id="label">Hora Entrada<span class="text-danger">(*)</span></label>
                   <input id="hora_entrada" type="time" class="form-control {{ $errors->has('hora_entrada') ? ' error' : '' }}" name="hora_entrada" value="{{ old('hora_entrada') }}" >
                   @if ($errors->has('hora_entrada'))
                       <span class="text-danger">
                           {{ $errors->first('hora_entrada') }}
                       </span>
                   @endif
                 </div>
                 <div class="col-lg-4"style="display: none" id="bloque1">
                   <label for="hora_salida" style="display: none" id="label1">Hora Salida<span class="text-danger">(*)</span></label>
                   <input id="hora_salida" type="time" class="form-control {{ $errors->has('hora_salida') ? ' error' : '' }}" name="hora_salida" value="{{ old('hora_salida') }}" >
                   @if ($errors->has('hora_salida'))
                       <span class="text-danger">
                           {{ $errors->first('hora_salida') }}
                       </span>
                   @endif
                 </div>
               </div>
             <div class="text-center mt-3">
                 <button type="submit" class="btn btn-primary">Guardar</button>
                 <a href="{{ route('comisiones.index') }}" class="btn btn-danger">Salir</a>
             </div>
          </form>
          </div>
        </div>
      </div>
    </div> 
</section>
@endcan


<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
           @if (auth()->user()->rol[0]->id==4)
          <h5 class="card-title">Mis Comisiones</h5>
          @else
          <h5 class="card-title">Comisiones Registrados</h5>
          @endif
        </div>
        @if(count($comision)>0)
        <p>Si necesita realizar una corrección del registro previamente ingresado puede utilizar la opción <strong>Modificar datos</strong> y volver a ingresarlo.</p>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
              <th class="text-center">Desde</th>
              <th class="text-center">Hasta</th>
              <th class="text-center">Tipo Jornada</th>
              <th class="text-center">Tipo Comision</th>
              <th class="text-center"></th>
            </tr>
            @foreach ($comision as  $key=>$document)
              <tr>
                <td class="text-center">{{ date('d/m/Y',strtotime($document->fecha_inicio)) }}</td>
                <td class="text-center">{{ date('d/m/Y',strtotime($document->fecha_fin)) }}</td>
                @php
                switch ($document->tipo_jornada) {
                        case "1":
                        $tipo="Jornada Laboral";
                        break;
                        case "2":
                        $tipo="Jornada No Laboral";
                        break;
                }
                @endphp
                <td><center>{{ $tipo }}</center></td>
                @php
                switch ($document->tipo_comision) {
                        case "1":
                        $tipo1="Misma Cede";
                        break;
                        case "2":
                        $tipo1="Distinta Cede";
                        break;
                        case "3":
                        $tipo1="Exterior";
                        break;
                }
                @endphp
                <td class="text-center">{{ $tipo1 }}</td>
                <td class="d-flex align-items-center justify-content-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Opciones
                      </button>
                      <ul class="dropdown-menu">
                          <li> <a href="{{route('comisiones.show',$document->uuid)}}" class="dropdown-item" title="Ver ficha" target="_blank">Ver ficha de comision</a></li>
                          <li><a href="{{route('comisiones.ficha',$document->uuid)}}" class="dropdown-item" title="Subir informe de actividades desarrolladas">Subir archivo de actividades</a></li>
                          @can('comisiones.destroy')
                          <li><a class="dropdown-item" href="{{ route('comisiones.destroy',$document->uuid) }}" onclick="return confirm('&iquest;Est&aacute; seguro que desea eliminar la comision?');">Eliminar comision</a></li>
                          @endcan
                          @can('comisiones.edit')
                          <a href="{{route('comisiones.edit',$document->uuid)}}" class="dropdown-item" title="Modificar datos">Modificar datos</a>  
                          @endcan
                      </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>
          @else
          <div class="table-responsive">  
         
          <h3>NO TIENE COMISIONES ASIGNADAS</h3>
        </div>
        @endif
          </div>
          </div>
     </div>
  </div>
</section>
@endSection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
  mostrar();
  function mostrar() {
    var x = $("#tipo_jornada").val() != null ? $("#tipo_jornada").val() : $("#tipo_jornada").data('old');
  if ( x==2 ) {
       $("#hora_entrada").show();
       $("#hora_entrada").prop("", true);
       $("#hora_salida").show();
       $("#hora_salida").prop("", true);
       var el = document.getElementById("bloque");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:block");
       var el2 = document.getElementById("bloque1");
       el2.setAttribute("style", "display:block");
       var el3 = document.getElementById("label1");
       el3.setAttribute("style", "display:block");
      } else {
       $("#hora_entrada").hide();
       $("#hora_entrada").removeAttr("");
       $("#hora_salida").hide();
       $("#hora_salida").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
       var el2 = document.getElementById("label1");
       el2.setAttribute("style", "display:none");
      } 
  }  
  </script>
@endsection