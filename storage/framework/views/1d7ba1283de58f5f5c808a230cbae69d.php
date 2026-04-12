<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
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
  font-size: 8;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}
  </style>  

  <?php switch($tipo):
      case (1): ?>
      <table  style="width:100%; font-size:5">
        <thead>
            <tr class="items" >
                <th style="width: 60%; text-align:center" colspan="2" >
                   <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="4">
                        DIRECCIÓN DE RECURSOS HUMANOS <br>
                        <?php echo e($titulo); ?><br>
                     </th> 
        </tr>
        </thead>
      </table>
        <br>
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
        <?php $__currentLoopData = $vacaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th><?php echo e($key+1); ?></th>
          <th><?php echo e($de->empleado->ci); ?></th>
          <th> <?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
          <th><?php echo e($de->empleado->cargo->first()->nombre); ?></th>
          <th><?php echo e(date('d-m-Y', strtotime($de->fecha_inicio))); ?> </th>
          <th><?php echo e(date('d-m-Y', strtotime($de->fecha_hasta))); ?> </th>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
      </table >
          <?php break; ?>
      <?php case (2): ?>
        <table  style="width:100%; font-size:5">
          <thead>
              <tr class="items" >
                  <th style="width: 60%; text-align:center" colspan="2" >
                     <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                  </th>
                  <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                    DIRECCIÓN DE RECURSOS HUMANOS <br>
                    <?php echo e($titulo); ?><br>
                 </th> 
          </tr>
          </thead>
        </table>
        <br>
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
            <?php $__currentLoopData = $licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            <th><?php echo e($key+1); ?></th>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></th>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></th>
                  <?php else: ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></th>
                  <?php endif; ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></th>
                  <th><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
                  <th><?php echo e($de->empleado->ci); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></th>
                  <th><?php echo e($de->numero_dias); ?> DIA</th>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table >
          <?php break; ?>     
      <?php case (3): ?>
         <table  style="width:100%; font-size:5">
              <thead>
                  <tr class="items" >
                      <th style="width: 60%; text-align:center" colspan="2" >
                         <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                      </th>
                      <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                        DIRECCIÓN DE RECURSOS HUMANOS <br>
                        <?php echo e($titulo); ?><br>
                     </th>  
              </tr>
              </thead>
         </table>
            <br>
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
                <?php $__currentLoopData = $licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <th><?php echo e($key+1); ?></th>
                <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></th>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></th>
                  <?php else: ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></th>
                  <?php endif; ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></th>
                  <th><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
                  <th><?php echo e($de->empleado->ci); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></th>
                  <th><?php echo e($de->numero_dias); ?> DIA</th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table >
          <?php break; ?> 
      <?php case (4): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th>  
            </tr>
            </thead>
          </table>
          <br>
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
              <?php $__currentLoopData = $licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
              <th><?php echo e($key+1); ?></th>
              <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->area->nombre); ?></th>
                  <?php if($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo == "ITEM"): ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nro_item); ?></th>
                  <?php else: ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->tipo_cargo); ?></th>
                  <?php endif; ?>
                  <th><?php echo e($de->empleado->cargoEmpleados->first()->cargo->nombre); ?></th>
                  <th><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
                  <th><?php echo e($de->empleado->ci); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?> al <br> <?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></th>
                  <th><?php echo e($de->numero_dias); ?> DIA</th>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table >
          <?php break; ?>

      <?php case (5): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
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
              <?php $__currentLoopData = $licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
              <th><?php echo e($key+1); ?></th>
                  <th> <?php echo e($de->empleado->ci); ?></th>
                  <th> <?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_inicio))); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fechas->first()->fecha_hasta))); ?></th>
                  <th><?php echo e($de->numero_dias); ?> </th>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            
          </table >
          <?php break; ?>
      <?php case (6): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
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
                <?php $__currentLoopData = $empleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <th><?php echo e($key+1); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->fecha_inicio))); ?></th>
                  <th> <?php echo e($de->empleado->ci); ?></th>
                  <th><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
                  <th><?php echo e($de->cargo->nombre); ?></th>
                  <th><?php echo e(date('d-m-Y', strtotime($de->empleado->fecha_nacimiento))); ?></th>
                  <th><?php echo e($de->empleado->ciudad->depto); ?></th>
                  <th><?php echo e($de->empleado->contacto_telefono); ?> </th>
                  <th><?php echo e($de->empleado->profesion->descripcion); ?></th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          <?php break; ?>
      <?php case (7): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="3" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                        <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            REPORTES DE PERSONAL PASIVO<br>
                         </th> 
                </tr>
                </thead>
                </table>
               <br>
               <table>
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
              <th><?php echo e(date('d-m-Y', strtotime($de->fecha_conclusion))); ?></th>
              <th> <?php echo e($de->empleado->ci); ?></th>
              <th><?php echo e($de->empleado->nombres); ?> <?php echo e($de->empleado->ap_paterno); ?> <?php echo e($de->empleado->ap_materno); ?></th>
              <th><?php echo e($de->cargo->nombre); ?></th>
              <?php if($de->cargo->nro_item): ?>
              <th><?php echo e($de->cargo->nro_item); ?></th>
              <?php else: ?>
              <th><?php echo e($de->cargo->tipo_cargo); ?></th>
              <?php endif; ?>
              <th><?php echo e($de->tipo_baja); ?></th>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          </table >
          <?php break; ?>
          <?php case (8): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
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
          <?php case (9): ?>
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
          <table>
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
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
          <table>
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
          <table  style="width:100%; font-size:5">
            <thead>
                <tr class="items" >
                    <th style="width: 60%; text-align:center" colspan="2" >
                       <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                    </th>
                    <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                      DIRECCIÓN DE RECURSOS HUMANOS <br>
                      <?php echo e($titulo); ?><br>
                   </th> 
            </tr>
            </thead>
          </table>
          <br>
          <table>
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
          <?php case (12): ?>
          <table  style="width:100%; font-size:5">
              <thead>
                  <tr class="items" >
                      <th style="width: 60%; text-align:center" colspan="2" >
                         <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                      </th>
                      <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                        DIRECCIÓN DE RECURSOS HUMANOS <br>
                        <?php echo e($titulo); ?><br>
                     </th> 
              </tr>
              </thead>
          </table>
          <br>
          <table>
                <thead>
                  <tr style="background: darkgray;text-align:center;">
                    <th> Nº</th>
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
          <?php case (13): ?>
          <table  style="width:100%; font-size:5">
                <thead>
                    <tr class="items" >
                        <th style="width: 60%; text-align:center" colspan="2" >
                           <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                        </th>
                        <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                          DIRECCIÓN DE RECURSOS HUMANOS <br>
                          <?php echo e($titulo); ?><br>
                       </th> 
                </tr>
                </thead>
          </table>
          <br>
          <table>
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
          <?php case (14): ?>
          <table  style="width:100%; font-size:5">
                  <thead>
                      <tr class="items" >
                          <th style="width: 60%; text-align:center" colspan="2" >
                             <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                          </th>
                          <th style="width: 30%;  text-align:center; font-size:20px; font-weight: bold;" colspan="6">
                            DIRECCIÓN DE RECURSOS HUMANOS <br>
                            <?php echo e($titulo); ?><br>
                         </th> 
                  </tr>
                  </thead>
          </table>
          <br>
          <table>
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
  <?php endswitch; ?>

      <?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/reportes/pdf/reporte_pdf.blade.php ENDPATH**/ ?>