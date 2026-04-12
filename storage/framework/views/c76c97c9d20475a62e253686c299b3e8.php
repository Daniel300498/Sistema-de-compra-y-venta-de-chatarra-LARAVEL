

<?php $__env->startSection('titulo','Memorandum'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Memorandums</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Memorandums</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('memorandums.create')): ?>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Generar Nuevo Memorandum</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p>Para generar el memorandum correspondiente debe ingresar la fecha de emisión y tipo de memorandum que sera asignado al empleado. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
            <form action="<?php echo e(route('memorandums.store',$empleado->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>" >
              <div class="row mb-3">
                  <div class="col-lg-3">
                    <?php echo e(Form::label('fecha_emision','Fecha De Emision')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_emision" type="date" class="form-control <?php echo e($errors->has('fecha_emision') ? ' error' : ''); ?>" name="fecha_emision" value="<?php echo e(old('fecha_emision')); ?>"   >
                        <?php if($errors->has('fecha_emision')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_emision')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
                  <div class="col-lg-3">
                    <?php echo e(Form::label('tipo','Tipo Memorandum' )); ?> <span class="text-danger">(*)</span>
                    <select name="tipo" id="tipo" class="form-control <?php echo e($errors->has('tipo') ? ' error' : ''); ?>"  id="tipo" Onchange = "mostrar()" data-old="<?php echo e(old('tipo')); ?>">
                      <option value="">-- SELECCIONE --</option>
                      <?php $__currentLoopData = $tipos_memorandum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tipo->id); ?>" <?php echo e(old('tipo')==$tipo->id ? 'selected' :''); ?>><?php echo e($tipo->descripcion); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('tipo')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('tipo')); ?>

                        </span>
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-3" style="display: none" id="bloque">
                    <label for="lugar_trabajo" style="display: none" id="label">Lugar Trabajo<span class="text-danger">(*)</span></label>
                    <select name="lugar_trabajo"  class="form-control form-control <?php echo e($errors->has('lugar_trabajo') ? ' error' : ''); ?>" id="tipo_lugar" data-old="<?php echo e(old('tipo_lugar')); ?>" >
                      <option value="">--SELECCIONE--</option>
                      <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($lugar->id); ?>" <?php echo e(old('lugar_trabajo') == $lugar->id ? 'selected' :''); ?> ><?php echo e($lugar->descripcion); ?> </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('lugar_trabajo')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('lugar_trabajo')); ?>

                    </span>
                <?php endif; ?>
                  </div>
                  <div class="col-lg-5" style="display: none" id="bloque1">
                    <label for="todos_empleados" style="display: none" id="label1">Generado Por<span class="text-danger">(*)</span></label>
                    <select name="todos_empleados"  class="form-control form-control <?php echo e($errors->has('todos_empleados') ? ' error' : ''); ?>" id="todos_empleados" data-old="<?php echo e(old('todos_empleados')); ?>">
                      <option value="">--SELECCIONE--</option>
                      <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($e->id); ?>" <?php echo e(old('todos_empleados') == $e->id ? 'selected' :''); ?>><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('todos_empleados')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('todos_empleados')); ?>

                      </span>
                  <?php endif; ?>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-8">
                  <label for="cargo_id">Cargo</label>
                  <select name="cargo_id" id="cargo_id" class="form-control <?php echo e($errors->has('cargo_id') ? ' error' : ''); ?>">
                    <option value="">-- SELECCIONE --</option>
                    <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ca->id); ?>" <?php echo e(old('cargo_id') == $ca->id ? 'selected' :''); ?>><?php echo e($ca->nro_item); ?> - <?php echo e($ca->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php if($errors->has('cargo_id')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('cargo_id')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <p>Se completa el campo <strong>Cargo</strong> solo si el memorandum corresponde a <strong>PROMOCIÓN/TRANSFERENCIA/ALTA DE USUARIO</strong>.</p>
              </div>
                  <textarea name="contenido" id="contenido" cols="100" rows="7" style="display:none;" ></textarea>
              <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="<?php echo e(route('memorandums.index')); ?>" class="btn btn-danger">Salir</a>
              </div>
              <input type="hidden" value="<?php echo e($empleado->id); ?>" id='empleado_id' name="empleado_id">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if(count($memorandums)>0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Memorandums registrados</h5>
          <input type="hidden" value="<?php echo e(auth()->user()->can('memorandums.edit')); ?>" id='can_edit_memo'>
          <input type="hidden" value="<?php echo e(auth()->user()->can('memorandums.destroy')); ?>" id='can_destroy'>
          <input type="hidden" value="<?php echo e(auth()->user()->can('memorandums.edit')); ?>" id='can_edit'>
          <input type="hidden" value="<?php echo e(auth()->user()->can('memorandums.show')); ?>" id='can_show'>
          <p>Desde el menú de <strong>Opciones</strong> puede aprobar, desaprobar, eliminar y ver el memorandum generado por el sistema.</p>
          <div class="">
            <table class="table table-hover table-bordered table-sm" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Tipo Memorandum</th>
                  <th class="text-center">Fecha Registro</th>
                  <th class="text-center">Estado Memorandum</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                
                
              </tbody>
            </table>
            <br><br><br>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">NO TIENE MEMORADUMS ASIGNADOS</h5>
        </div>
      </div>
    </div>
  </div>

</section>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  $("#cargo_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
  }).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
  });
  
</script>




<script>
   mostrar();
  function mostrar() {
 
  var x = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
  switch (x) {
    case "1":
       /////////
       $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
       $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido");   
var contenidoNuevo ="Comunico a Usted que, el Gobierno Autónomo Departamental de La Paz, a través de la Dirección de Recursos Humanos determina su PROMOCIÓN del ítem [variable1] al ítem [variable2,] en el cargo de [variable3,] dependiente de la [variable4.] Respecto a la documentación (físico y digital) que fue designado a su cargo, deberá entregar a su inmediato superior mediante informe final, como prevé la Disposición Adicional Única del D.S. 718 de 01 de diciembre. Deseando éxito en sus funciones y el mejor compromiso laboral en bien de la gestión institucional, saludo a usted."; 
textarea.value = contenidoNuevo;
      break;
    case "2":
        /////////
        $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
    $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "Comunico a Usted que, el Gobierno Autónomo Departamental de La Paz, a través de la Dirección de Recursos Humanos determina su TRANSFERENCIA del ítem [variable1] al ítem [variable2,] en el cargo de [variable3,] dependiente de la [variable4,] del Gobierno Autónomo Departamental de La Paz. Respecto a la documentación (físico y digital) que fue designado a su cargo, deberá entregar a su inmediato superior mediante informe final, como prevé la Disposición Adicional Única del D.S. 718 de 01 de diciembre. Deseando éxito en sus funciones y el mejor compromiso laboral en bien de la gestión institucional, saludo a usted."; 
textarea.value = contenidoNuevo;

      break;
      case "3":
        /////////
        $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
      $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "Comunico a usted que el Gobierno Autónomo Departamental de La Paz, ha decidido otorgarle los días de vacación correspondientes a la gestión 2021/2022 y 2022/2023 esto en el marco de la Ley N° 2027 Estatuto del Funcionario Público, mismos que se otorgaran de acuerdo al siguiente Detalle. Una vez concluida la vacación, se dará por terminada la Relación Laboral entre su persona y la Institución, para el efecto deberá hacer la entrega de su sello personal a su jefe inmediato superior y devolver la Credencial Institucional a la Dirección de Recursos Humanos; asimismo, deberá presentar su Declaración Jurada de Bienes y Rentas por dejación al cargo, en cumplimiento a lo dispuesto por el artículo 4 Parágrafo II del Decreto Supremo N° 1233. Respecto a la documentación (físico y digital) que fue designado a su cargo, deberá entregar a su inmediato superior mediante informe final, a partir de cese de sus funciones, como prevé la Disposición Adicional Única del D.S. 718 de 01 de diciembre; con relación a los Activos a su cargo, deberá recabar la conformidad correspondiente de las Unidades pertinentes a través de Hoja de Descargo y presentar el mismo a Recursos Humanos; su inobservancia e incumplimiento de lo indicado generara responsabilidad por la función pública, como prevé la Ley 1178, Ley 2027, D.S. 23318-A modificado por el D.S. 26237. Sin otro particular, se agradece a usted por los servicios prestados durante su permanencia en la Institución."; 
textarea.value = contenidoNuevo;

      break;

      case "4":
        /////////
        $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
      $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "Me dirijo a usted para comunicarle que el Gobierno Autónomo Departamental de La Paz, a partir de la fecha, agradece sus SERVICIOS PRESTADOS como [variable1,] dependiente del [variable2,] concluida la relación laboral entre su persona y la Institución, deberá hacer la entrega de su sello personal a su inmediato superior y devolver la Credencial Institucional a Recursos Humanos; asimismo, deberá presentar su Declaración Jurada de Bienes y Rentas por dejación al cargo, en cumplimiento a lo dispuesto por el art. 4.II del D.S. N° 1233. Respecto a la documentación (físico y digital) que fue designado a su cargo, deberá entregar a su inmediato superior mediante informe final, a partir de cese de sus funciones, como prevé la Disposición Adicional Única del D.S. 718 de 01 de diciembre; con relación a los Activos a su cargo, deberá recabar la conformidad correspondiente de las Unidades pertinentes a través de Hoja de Descargo y presentar el mismo a Recursos Humanos; su inobservancia e incumplimiento de lo indicado generara responsabilidad por la función pública, como prevé la Ley 1178, Ley 2027, D.S. 23318-A modificado por el D.S. 26237. Sin otro particular, se agradece a usted por los servicios prestados durante su permanencia en la Institución"; 
textarea.value = contenidoNuevo;

      break;
      case "5":
         /////////
       $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
      $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = " De conformidad al Articulo 279 de la Contitucion Politica Del Estado Plurinacional de Bolivia y la Ley Departamental N. 228, de 08 de Septiembre de 2023,Usted es  DESIGNADO al item [variable1] en el cargo de [variable2] dependiente de la [variable3,] del Gobierno Autónomo Departamental De La Paz. Deseandole exitos en sus funciones  y el mejor compromiso laboral en bien de la gestion Institucional, saludo a usted."; 
textarea.value = contenidoNuevo;

      break;
      case "6":
           //////
      $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el2 = document.getElementById("label");
       el2.setAttribute("style", "display:none");
       var el3 = document.getElementById("bloque");
       el3.setAttribute("style", "display:none");
        /////
      var y = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
      if (y==6) {
       $("#todos_empleados").show();
       $("#todos_empleados").prop("", true);
       var el = document.getElementById("bloque1");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label1");
       el1.setAttribute("style", "display:block");
       
      }
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "La Secretaria Departamental de Turismo y Culturas dependiente del Gobierno Autonomo Departamental de La Paz, en el ejercicio de sus funciones y atribuciones conferidas eleva: LLAMADA DE ATENCION a su persona, debido al comportamiento consistente en el cumplimiento amparado en el Art. 11 del Reglamento Interno del Personal de Gobierno Autonomo Departamental de La Paz, (DEBERES CON LA ENTIDAD) inc. i) Cumplir las instrucciones emitidas por autoridades competentes, por tanto; amerita la amonestacion escrita por falta leve en cumplimiento al Art. 44 (FALTAS LEVES CON AMONESTACION ESCRITA) del citado Reglamento, cuando estas no se encuentren sancionadas en otro acapite del mismo o contengan sancion en normativas especificas. Asimismo, se le exhorta al cumplimiento de sus funciones con mayor responsabilidad y compromiso laboral, caso contrario se procedera conforme ala norma vigente."; 
textarea.value = contenidoNuevo;

      break;
      case "7":
         /////////
       $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el = document.getElementById("label1");
       el.setAttribute("style", "display:none");
        /////////
      $("#tipo_lugar").hide();
       $("#tipo_lugar").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
    var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "Comunico a Usted que, conforme a su solicitud de HORARIO DE LACTANCIA, en cumplimiento al D.S. 115 y la ley General del trabajo Art. 61, se le concede dicho beneficio.De tal forma se le asigna mediante la presente su horario de lactancia.  Por lo tanto, el marcado de su asistencia en el horario de salida será 1 hora antes de lo establecido.Con este motivo, saludo a usted."; 
textarea.value = contenidoNuevo;
      break;  
      case "8":
         /////////
       $("#todos_empleados").hide();
       $("#todos_empleados").removeAttr("");
       var el2 = document.getElementById("label1");
       el2.setAttribute("style", "display:none");
        /////////
      var y = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
      if (y==8) {
       $("#tipo_lugar").show();
       $("#tipo_lugar").prop("", true);
       var el = document.getElementById("bloque");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:block");
      }
var textarea = document.getElementById("contenido"); 
var contenidoNuevo = "Comunico a Usted que, conforme al Informe la Direccion de Recursos Humanos determina su Rotacion con su mismo item y nivel salarial alos predios de [variable1] a cumplir las funciones de [variable2] debiendoa  este efecto coordinar todo el trabajo con el Responsable de La Unidad de Servicios Generales y Transporte. Exhortando a su persona el mayor de los compromisos laborales y realice un adecuado estricto control."; 
textarea.value = contenidoNuevo;
      break;  
  }
  }  
  </script>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/memorandum.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/memorandums/create.blade.php ENDPATH**/ ?>