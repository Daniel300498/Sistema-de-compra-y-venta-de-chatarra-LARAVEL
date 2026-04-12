
<?php $__env->startSection('titulo','Reportes'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Reportes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
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
           
           <form action="<?php echo e(route('reporte.pdf')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row mb-3">   
              <div class="row"> 
                <div class="col-lg-4">
                  <label for="fecha_desde"> Fecha Desde:<span class="text-danger">(*)</span></label>
                      <input id="fecha_desde" type="date" class="form-control" name="fecha_desde" value="<?php echo e(old('fecha_desde')); ?>" >
                      <?php if($errors->has('fecha_desde')): ?>
                      <span class="text-danger"><?php echo e($errors->first('fecha_desde')); ?></span>
                    <?php endif; ?>
                  </div>
               
                <div class="col-lg-4">
                  <label for="fecha_hasta"> Fecha Hasta:<span class="text-danger">(*)</span></label>
                      <input id="fecha_hasta" type="date" class="form-control" name="fecha_hasta" value="<?php echo e(old('fecha_hasta')); ?>" >
                      <?php if($errors->has('fecha_hasta')): ?>
                      <span class="text-danger"><?php echo e($errors->first('fecha_hasta')); ?></span>
                     <?php endif; ?>
                    </div>
                <div class="col-lg-4" >
                  <?php echo e(Form::label('tipo_reporte','Tipo Reporte' )); ?> <span class="text-danger">(*)</span>
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
                  <?php if($errors->has('tipo_reporte')): ?>
                      <span class="text-danger"><?php echo e($errors->first('tipo_reporte')); ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row"> 
                <div class="col-lg-4" >
                  <br>
                  <?php echo e(Form::label('lugar_trabajo','Lugar De Trabajo' )); ?>

                  <select name="lugar_trabajo"  class="form-control form-control <?php echo e($errors->has('lugar_trabajo') ? ' error' : ''); ?>" id="tipo_lugar" >
                    <option value="">--SELECCIONE--</option>
                    <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lugar->id); ?>" ><?php echo e($lugar->descripcion); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="col-lg-4" >
                <br>
                <?php echo e(Form::label('tipo_empleado','Tipo De Empleado' )); ?>

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
                  <?php echo e(Form::label('area','&Aacute;rea' )); ?> 
                  <select name="area"  class="form-control form-control" id="area">
                  <option value="">--SELECCIONE--</option>
                  <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($a->id); ?>"><?php echo e($a->nombre); ?> </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>         
            <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">Buscar</button>
              
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

<?php if(count($variable)>0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

        <div class="d-flex align-items-center justify-content-between">
            <p>  
              <form id="formulario-enviar" action="<?php echo e(route('reporte.pdfs')); ?>" method="POST" >
                <?php echo csrf_field(); ?>
                <?php echo e(Form::hidden('tipo_reporte', $tipo)); ?>

                <?php echo e(Form::hidden('titulo', $titulo)); ?>

                <?php echo e(Form::hidden('variable', base64_encode(serialize($variable)))); ?>

                 <br>
                <button type="submit" class="btn btn-primary" name="boton1">Generar PDF</button>
                <button type="submit" class="btn btn-danger" name="boton2" >Generar Excel</button>
              </form>
            </p>
          </div>
          <h5  class="card-title text-center"><?php echo e($titulo); ?></h5>
          <h6  class="card-title text-center">DEL <?php echo e(date('d-m-Y', strtotime($fecha_ini))); ?> AL <?php echo e(date('d-m-Y', strtotime($fecha_fin))); ?> </h6>
          <div class="table-responsive">
            <?php switch($tipo):
            case (1): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e($de->empleado->ci); ?></td>
                  <td> <?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->empleado->cargo->first()->nombre); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fecha_inicio))); ?> </td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fecha_hasta))); ?> </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>   
            <?php case (2): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></td>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></td>
                  <?php else: ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></td>
                  <td><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->empleado->ci); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></td>
                  <td><?php echo e($de->numero_dias); ?> DIA</td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (3): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></td>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></td>
                  <?php else: ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></td>
                  <td><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->empleado->ci); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></td>
                  <td><?php echo e($de->numero_dias); ?> DIA</td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (4): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></td>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></td>
                  <?php else: ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></td>
                  <td><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->empleado->ci); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></td>
                  <td><?php echo e($de->numero_dias); ?> DIA</td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (5): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td> <?php echo e($de->empleado->ci); ?></td>
                  <td> <?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></td>
                  <td><?php echo e($de->numero_dias); ?> </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (6): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fecha_inicio))); ?></td>
                  <td> <?php echo e($de->empleado->ci); ?></td>
                  <td><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->cargo->nombre); ?></td>
                  <td><?php echo e(date('d-m-Y', strtotime($de->empleado->fecha_nacimiento))); ?></td>
                  <td><?php echo e($de->empleado->ciudad->depto); ?></td>
                  <td><?php echo e($de->empleado->contacto_telefono); ?> </td>
                  <td><?php echo e($de->empleado->profesion->descripcion); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (7): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <td><?php echo e(date('d-m-Y', strtotime($de->fecha_conclusion))); ?></td>
                  <td> <?php echo e($de->empleado->ci); ?></td>
                  <td><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></td>
                  <td><?php echo e($de->cargo->nombre); ?></td>
                  <?php if($de->cargo->nro_item): ?>
                  <td><?php echo e($de->cargo->nro_item); ?></td>
                  <?php else: ?>
                  <td><?php echo e($de->cargo->tipo_cargo); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($de->tipo_baja); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (8): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $fechaComoEntero = strtotime($de->fecha_inicio);
                  $año= date("Y", $fechaComoEntero);
                ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <th><?php echo e($de->nombre); ?></th>
                  <th><?php echo e($de->nombre_cargo); ?></th>
                  <th><?php echo e($de->nro_item); ?></th>
                  <th><?php echo e($de->ap_paterno); ?></th>
                  <th><?php echo e($de->ap_materno); ?></th>
                  <th> <?php echo e($de->nombres); ?>  </th>
                  <th><?php echo e($de->ci); ?></th>
                  <th><?php echo e($de->fecha_inicio); ?></th>
                  <th><?php echo e($de->numero_correlativo); ?>/<?php echo e($año); ?></th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (9): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $fechaComoEntero = strtotime($de->fecha_inicio);
                  $año= date("Y", $fechaComoEntero);
                ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <th><?php echo e($de->nombre); ?></th>
                  <th><?php echo e($de->nombre_cargo); ?></th>
                  <th><?php echo e($de->nro_item); ?></th>
                  <th><?php echo e($de->ap_paterno); ?></th>
                  <th><?php echo e($de->ap_materno); ?></th>
                  <th> <?php echo e($de->nombres); ?>  </th>
                  <th><?php echo e($de->ci); ?></th>
                  <th><?php echo e($de->fecha_inicio); ?></th>
                  <th><?php echo e($de->numero_correlativo); ?>/<?php echo e($año); ?></th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (10): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $fechaComoEntero = strtotime($de->fecha_inicio);
                  $año= date("Y", $fechaComoEntero);
                ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <th><?php echo e($de->nombre); ?></th>
                  <th><?php echo e($de->nombre_cargo); ?></th>
                  <th><?php echo e($de->nro_item); ?></th>
                  <th><?php echo e($de->ap_paterno); ?></th>
                  <th><?php echo e($de->ap_materno); ?></th>
                  <th> <?php echo e($de->nombres); ?>  </th>
                  <th><?php echo e($de->ci); ?></th>
                  <th><?php echo e($de->fecha_inicio); ?></th>
                  <th><?php echo e($de->numero_correlativo); ?>/<?php echo e($año); ?></th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php case (11): ?>
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
                <?php $__currentLoopData = $variable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php              
                  $fechaComoEntero = strtotime($de->fecha_inicio);
                  $año= date("Y", $fechaComoEntero);
                ?>
                <tr>
                  <th><?php echo e($key+1); ?></th>
                  <th><?php echo e($de->nombre); ?></th>
                  <th><?php echo e($de->nombre_cargo); ?></th>
                  <th><?php echo e($de->nro_item); ?></th>
                  <th><?php echo e($de->ap_paterno); ?></th>
                  <th><?php echo e($de->ap_materno); ?></th>
                  <th> <?php echo e($de->nombres); ?>  </th>
                  <th><?php echo e($de->ci); ?></th>
                  <th><?php echo e($de->fecha_inicio); ?></th>
                  <th><?php echo e($de->numero_correlativo); ?>/<?php echo e($año); ?></th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php break; ?>
            <?php endswitch; ?>
           
            <br><br>
          </div>
          <!-- EndCONTENIDO Example -->
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
          <h5 class="card-title"><center>NO HAY RESULTADOS</center></h5>
        </div>
      </div>
    </div>
  </div>

</section>
<?php endif; ?>
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
    var  a=document.getElementById("formulario-enviar").action = "<?php echo e(route('reporte.pdfs')); ?>"; 
  }else{
    var  b=document.getElementById("formulario-enviar").action = "<?php echo e(route('reporte.excel')); ?>"; 
  }
 
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/reportes/reporte.blade.php ENDPATH**/ ?>