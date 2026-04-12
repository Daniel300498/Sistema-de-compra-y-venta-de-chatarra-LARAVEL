<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Reporte Declaraciones Juradas</title>
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
  font-size: 5;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}
  
  </style>
    
    
    <?php if($tipo_declaracion== 1): ?>
    
      <table  style="width:100%; font-size:5">
        <thead>
          <tr> 
                <td colspan="10" style=" font-weight: bold;">
                   DECLARACION JURADA DE BIENES Y RENTAS ANTES DEL EJERCICIO DEL CARGO
                </td> 
        </tr>
        <tr> 
          <?php switch($tipo_trimestre):
              case (1): ?>
              <td colspan="10" style="text-align:left;font-weight: bold;">
                Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
              </td> 
                  
                  <?php break; ?>
              <?php case (2): ?>
              <td colspan="10" style=" text-align:left; font-weight: bold;">
                Periodo 2°(Trimestre) (Abril, Mayo,Junio)
              </td> 
                  <?php break; ?>
              <?php case (3): ?>
              <td colspan="10" style=" text-align:left; font-weight: bold;">
                Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
              </td> 
                  
                  <?php break; ?>
              <?php case (4): ?>
              <td colspan="10" style=" text-align:left; font-weight: bold;">
                Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
              </td> 
                  
                  <?php break; ?>
              <?php default: ?>
                  
          <?php endswitch; ?>
        </tr>
        <tr>
          <td colspan="11" style=" text-align:center;  font-weight: bold;">
              PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
          </td>
        </tr>
        <tr style="background: darkgray;text-align:center;">
          <th>
              Nº
          </th>
          <th colspan="3">
              NOMBRES Y APELLIDOS
          </th>
          <th ROWSPAN=2>
              CEDULA DE IDENTIDAD
          </th >
         
          <th ROWSPAN=2>
              FECHA DE INGRESO
          </th>
          <th ROWSPAN=2>
              DENOMINACION DEL CARGO
          </th>
          <th ROWSPAN=2>
              CARGO FUNCIONAL
          </th>
          <th ROWSPAN=2>
              N° DE <br> CERTIFICADO <br> DE D.J.B.R.
          </th>
          <th ROWSPAN=2>
              FECHA DE CERTIFICACION
          </th>
          <th ROWSPAN=2>
              D.J.B.R.
          </th>
          
        </tr>
        <tr style="background: darkgray;text-align:center;">
          <th></th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Nombres</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <tr>
          <th><?php echo e($key+1); ?></th>
          <th><?php echo e($de->empleado->ap_paterno); ?></th>
          <th><?php echo e($de->empleado->ap_materno); ?></th>
          <th><?php echo e($de->empleado->nombres); ?></th>
          <th><?php echo e($de->empleado->ci); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['fecha_inicio']); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.nombre']); ?></th>
          <th><?php echo e($de->codigo); ?></th>
          <th><?php echo e($de->fecha_certificacion); ?></th>
          <th>ACREDITO SU D.J.B.R. OPORTUNAMENTE.</th>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
       
      </table >
      <footer id="footer"></footer>
    <caption id="footer"><center>_________________________________________ <br>Lic. Rocio Susana Rocabado Gutierrez <br>
      RESPONSABLE DE SEGUIMIENTO DE LA D.J.B.R. <br>
      GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ
      
    </center></caption>
    <script type="text/php">
      if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(270, 820, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
          ');
      }
    </script>
    <?php else: ?>
    
    <?php if($tipo_declaracion== 2): ?>
      <table style="width:100%; font-size:5"  >
        <thead>
          <tr> 
            <td colspan="10" style="text-align:left; font-weight: bold;">
                DECLARACION JURADA DE BIENES Y RENTAS (DURANTE EL EJERCICIO DEL CARGO).
            </td> 
    </tr>
    <tr> 
      <?php switch($tipo_trimestre):
          case (1): ?>
          <td colspan="10" style=" text-align:left; font-weight: bold;">
            Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
          </td> 
              
              <?php break; ?>
          <?php case (2): ?>
          <td colspan="10" style=" text-align:left; font-weight: bold;">
            Periodo 2°(Trimestre) (Abril, Mayo,Junio)
          </td> 
              <?php break; ?>
          <?php case (3): ?>
          <td colspan="10" style=" text-align:left; font-weight: bold;">
            Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
          </td> 
              
              <?php break; ?>
          <?php case (4): ?>
          <td colspan="10" style="text-align:left; font-weight: bold;">
            Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
          </td> 
              
              <?php break; ?>
          <?php default: ?>
              
      <?php endswitch; ?>
    </tr>
    <tr>
      <td colspan="13" style=" text-align:center; font-weight: bold;">
          PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
      </td>
    </tr>
        <tr style="background: darkgray;text-align:center;">
          <th>
              Nº
          </th>
          <th colspan="3">
              NOMBRES Y APELLIDOS
          </th>
          <th ROWSPAN=2>
              CEDULA DE IDENTIDAD
          </th >
          <th ROWSPAN=2>
              FECHA DE NACIMIENTO
          </th >
          <th ROWSPAN=2>
              FECHA DE INGRESO
          </th>
          <th ROWSPAN=2>
              DENOMINACION DEL CARGO
          </th>
          <th ROWSPAN=2>
              CARGO FUNCIONAL
          </th>
          <th ROWSPAN=2>
              RESIDE EN <br>CAPITAL <br>DEPTO
        </th>
          <th ROWSPAN=2>
              N° DE <br> CERTIFICADO <br> DE D.J.B.R.
          </th>
          <th ROWSPAN=2>
              FECHA DE CERTIFICACION
          </th>
          <th ROWSPAN=2>
            D.J.B.R.
        </th>
          <th ROWSPAN=2>
            CELULAR
          </th>
          <th ROWSPAN=2>
            DOMICILIO
          </th>
          
        </tr>
      
        <tr style="background: darkgray;text-align:center;">
          <th></th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Nombres</th>
        </tr>
      </thead>
        <tbody>
        <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
        <tr>
          <th><?php echo e($key+1); ?></th>
          <th><?php echo e($de->empleado->ap_paterno); ?></th>
          <th><?php echo e($de->empleado->ap_materno); ?></th>
          <th><?php echo e($de->empleado->nombres); ?></th>
          <th><?php echo e($de->empleado->ci); ?></th>
          <th><?php echo e($de->empleado->fecha_nacimiento); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['fecha_inicio']); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.nombre']); ?></th>
          <th><?php echo e($de->empleado->ciudad->depto); ?></th>
          <th><?php echo e($de->codigo); ?></th>
          <th><?php echo e($de->fecha_certificacion); ?></th>
          <th>Realizo y acredito oportunamente </th>
          <th><?php echo e($de->empleado->nro_celular); ?></th>
          <th><?php echo e($de->empleado->domicilio); ?></th>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
      </table >
      <footer id="footer"></footer>
    <caption id="footer"><center>_________________________________________ <br>Lic. Rocio Susana Rocabado Gutierrez <br>
      RESPONSABLE DE SEGUIMIENTO DE LA D.J.B.R. <br>
      GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ
      
    </center></caption>
    <script type="text/php">
      if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(270, 820, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
          ');
      }
    </script>
    <?php else: ?>
    
    
      <table style="width:100%; font-size:5">
        <thead>
          <tr> 
            <td colspan="10" style="text-align:left;font-weight: bold;">
                DECLARACION JURADA DE BIENES Y RENTAS (DESPUES DEL EJERCICIO DEL CARGO).
            </td> 
    </tr>
    <tr> 
      <?php switch($tipo_trimestre):
          case (1): ?>
          <td colspan="10" style=" text-align:left; font-weight: bold;">
            Periodo 1°(Trimestre) (Enero, Febrero,Marzo)
          </td> 
              
              <?php break; ?>
          <?php case (2): ?>
          <td colspan="10" style=" text-align:left;font-weight: bold;">
            Periodo 2°(Trimestre) (Abril, Mayo,Junio)
          </td> 
              <?php break; ?>
          <?php case (3): ?>
          <td colspan="10" style="text-align:left; font-weight: bold;">
            Periodo 3°(Trimestre) (Julio, Agosto,Septiembre)
          </td> 
              
              <?php break; ?>
          <?php case (4): ?>
          <td colspan="10" style="text-align:left;font-weight: bold;">
            Periodo 4°(Trimestre) (Octubre, Noviembre,Diciembre)
          </td> 
              
              <?php break; ?>
          <?php default: ?>
              
      <?php endswitch; ?>
    </tr>
    <tr>
      <td colspan="13" style=" text-align:center;font-weight: bold;">
          PERSONAL QUE ACREDITO SU DECLARACION JURADA DE BIENES Y RENTAS OPORTUNAMENTE.
      </td>
    </tr>

        <tr style="background: darkgray;text-align:center;">
          <th>
              Nº
          </th>
          <th colspan="3">
              NOMBRES Y APELLIDOS
          </th>
          <th ROWSPAN=2>
              CEDULA DE IDENTIDAD
          </th >
         
          <th ROWSPAN=2>
              DENOMINACION DEL CARGO
          </th>
          <th ROWSPAN=2>
              CARGO FUNCIONAL
          </th>
          <th ROWSPAN=2>
             FECHA RETIRO
        </th>
          
          <th ROWSPAN=2>
              N° DE <br> CERTIFICADO <br> DE D.J.B.R.
          </th>
          <th ROWSPAN=2>
              FECHA DE CERTIFICACION
          </th>
          <th ROWSPAN=2>
            FECHA DE PRESENTACION A RR.HH.
        </th>
          <th ROWSPAN=2>
            D.J.B.R.
        </th>
          <th ROWSPAN=2>
            CELULAR
          </th>
          <th ROWSPAN=2>
            DOMICILIO
          </th>
          <th ROWSPAN=2>TIPO SUPERVISOR</th>
          
        </tr>
        <tr style="background: darkgray;text-align:center;">
          <th></th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Nombres</th>
        </tr>
      </thead>
        <tbody>
          <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $de): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
        <tr>
          <th><?php echo e($key+1); ?></th>
          <th><?php echo e($de->empleado->ap_paterno); ?></th>
          <th><?php echo e($de->empleado->ap_materno); ?></th>
          <th><?php echo e($de->empleado->nombres); ?></th>
          <th><?php echo e($de->empleado->ci); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.denominacion_cargo_nombre']); ?></th>
          <th><?php echo e($de->empleado->cargo[0]->pivot['cargos.nombre']); ?></th>
          <th><?php echo e($de->fecha_retiro); ?></th>
          <th><?php echo e($de->codigo); ?></th>
          <th><?php echo e($de->fecha_certificacion); ?></th>
          <th><?php echo e($de->fecha_presentacion); ?></th>
          <th>ACREDITO SU D.J.B.R. OPORTUNAMENTE </th>
          <th><?php echo e($de->empleado->nro_celular); ?></th>
          <th><?php echo e($de->empleado->domicilio); ?></th>
          <th>PROVISORIO</th>
        </tr>
     
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
       
      </table >
    <footer id="footer"></footer>
    <caption id="footer"><center>_________________________________________ <br>Lic. Rocio Susana Rocabado Gutierrez <br>
      RESPONSABLE DE SEGUIMIENTO DE LA D.J.B.R. <br>
      GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ
      
    </center></caption>
    <script type="text/php">
      if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(270, 820, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
          ');
      }
    </script>
        
    <?php endif; ?>
        
    <?php endif; ?>
    

    
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/declaraciones/pdf/reporte_contraloria_pdf.blade.php ENDPATH**/ ?>