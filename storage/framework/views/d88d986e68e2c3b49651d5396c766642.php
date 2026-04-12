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
  font-size: 10;
  font-weight:normal;
  border-collapse: unset;
  text-align: center
}
  
  </style>  


    <table style="width:100%; font-size:10">
      <tr class="items">
        <th style="width: 100%; text-align: right; font-style:italic; border:none; font-size:15px; font-weight:normal;" >
          <div>
            La Paz, 11 de Julio del 2024
          </div>
        </th>           
      </tr>
      <br>
      <tr class="items">
        <th style="width: 100%; text-align: left; border:none; font-size:15px; " >
          <div style="font-weight:normal;">
            Señora:
          </div>
          <div style="font-weight:bold;">
            Lic. Rocio Susana Rocabado Gutierrez
          </div>
          <div style="font-weight:bold;">
            DIRECTORA DE RECURSOS HUMANOS
          </div>
          <div style="font-weight:bold;">
            GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ
          </div>
          <div>
            Presente.
          </div>
        </th>           
      </tr>

      <br>
      <tr class="items">
        <th style="width: 100%; text-align: right; border:none; font-size:17px; text-decoration-line: underline;" >
         
          <div style="font-weight:bold;  ">
            Ref.: Solicitud de Bono Natalidad y Lactancia
          </div>
       
        </th>           
      </tr>

      <tr class="items">
        <th style="width: 100%; text-align: left; border:none; font-size:17px; text-decoration-line: underline;" >
         
          <br>
          <div style="font-weight:normal;  font-style:italic ">
            De mi mayor consideración
          </div>
          <br>
          <div style="font-weight:normal;  font-style:italic ">
            <p style="line-height: 2.0em;">Por medio de la presente desearle éxitos en la labor que desempeñe y el motivo es para solicitarle muy respetuosamente instruya a quien corresponda el pago de <strong> Subsidio de Bono Natalidad y Lactancia </strong>en virtud a la autorizacion de la C.N.S. según el Reglamente de Asignaciones Familiares R.M. 1676 emitido por el Ministerio de Salud y Deportes, asimismo hago conocer que el recojo del beneficio sea en la Ciudad de La Paz para lo cual adjunto los siguientes documentos: </p>
          </div>
          <div style="font-weight:normal;  font-style:italic ">
            
            <ul style="bottom: 10%;">
              <li>Fotocopia de Formularios AVC-06 (Autorizado por la C.N.S. para pago de Lactancia)</li>
              <li>Certificado de Nacimiento</li>
              <li>Fotocopia de Cedula de Identidad (Servidor Publico y beneficiaria)</li>
              <li>Memorádum de designación</li>
              <li>Certificado de Nacido vivo</li>
              <li>Registro Sigep (si corresponde)</li>
            </ul>
          </div>
          
          
        </th>           
      </tr>

      <tr class="items">
        <th style="width: 100%; text-align: left; border:none; font-size:17px; text-decoration-line: underline;" >
          <div style="font-weight:normal;  font-style:italic ">
            Sin otro particular me despido de usted con la consideraciones más distinguidas 
          </div>
        </th>           
      </tr>

      <br>
      <br>
      <br>
      <tr class="items">
        <th style="width: 100%; text-align: center; border:none; font-size:17px; text-decoration-line: underline;" >
          <div style="font-weight:normal;  font-style:normal ">
            ..........................................................................
          </div>
          <div style="font-weight:normal;  font-style:normal ">
            <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>

          </div>
          <div style="font-weight:normal;  font-style:normal ">
            C.I. <?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_lugar); ?>

          </div>
        </th>           
      </tr>
    </table>

    <br>
    
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/pdf/carta.blade.php ENDPATH**/ ?>