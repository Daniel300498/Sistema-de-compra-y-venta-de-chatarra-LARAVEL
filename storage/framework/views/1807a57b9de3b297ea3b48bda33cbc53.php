<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/comisiones/pdf_comision.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<div class="margin-top">
   <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
      <div style="padding: 12px">
         <table class="title">
            <tr class="items">
                  <td style="width: 20%; text-align:center">
                     <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                  </td>
                  <td style="width: 60%; text-align:center; font-weight: bold;">
                     <div style="font-size: 15px; font-weight: bold;">
                        GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ 
                     </div>
                     <div style="font-size: 20px; font-weight: bold;">
                        DIRECCION DE RECURSOS HUMANOS  
                     </div>
                     <div style="font-size: 30px">COMISION</div>
                     <div style="font-size: 15px; font-weight: bold;">
                        La Paz - Bolivia
                     </div>
                  </td>
                  <td style="width: 20%; text-align:center"> 
                  </td>
            </tr>
         </table>
         <br>
         <br>
         <table class="body">
            <tr class="items">
                     <td style="width: 15%; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Fecha Inicio</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($comision->fecha_inicio); ?>">
                        </fieldset>
                     </td>
                     <td style="width: 15%;" >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Fecha Fin</label>
                        </fieldset>
                     </td>
                     <td style="width: 35%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($comision->fecha_fin); ?>">
                        </fieldset>
                     </td>
            </tr>      
         </table>
   
         <br>
         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Nombre Completo</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <br>
         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Cargo</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($cargo->nombre); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <br>
         <br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Tipo Comision</label>
                   </fieldset>
                </td>
                <?php
                switch ($comision->tipo_comision) {
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
                ?>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($tipo1); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <br><br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Tipo Jornada</label>
                   </fieldset>
                </td>
                <?php
                switch ($comision->tipo_jornada) {
                        case "1":
                        $tipo="Jornada Laboral";
                        break;
                        case "2":
                        $tipo="Jornada No Laboral";
                        break;
                }
                ?>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($tipo); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <br><br>
         <?php if($comision->tipo_jornada == "2"): ?>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Hora Entrada</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($comision->hora_entrada); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <br><br>
         <table class="body">
            <tr class="items">
                <td style="width: 30%; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Hora Salida</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($comision->hora_salida); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <?php endif; ?>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <table class="body">
            <tr class="items">
               <td style="width: 5%; text-align:center">          
               </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">JEFE INMEDIATO SUPERIOR <br></label>
                  </fieldset>
            </td>
            <td style="width: 30%; text-align:center" >
            </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">AUTORIZADO <br>RECURSOS HUMANOS</label>
                  </fieldset>
            </td>
            <td style="width: 5%; text-align:center">    
            </td>
            </tr>
         </table>
         <table class="body">
            <tr class="items">
            <td style="width: 35%; text-align:center" >
            </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">FIRMA DEL INTERESADO</label>
               </fieldset>
            </td>
            <td style="width: 35%; text-align:center" >
            </td>
            </tr>
         </table>
         <table style="top: -20px">
            <tr class="items">
            <td style="width: 20%; text-align:center" >
            </td>
            <td style="width: 60%; text-align:center; font-size:12px;" >
               NOTA: Esta papeleta deberá ser presentada a RR.HH. con 24 Hrs de anticipacion
            </td>
            <td style="width: 20%; text-align:center" >
            </td>
            </tr>
         </table>
      </div>
   </div>
</div>



<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/comisiones/pdf/ficha.blade.php ENDPATH**/ ?>