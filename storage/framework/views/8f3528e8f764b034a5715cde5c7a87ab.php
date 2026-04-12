

<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/licencias/pdf_licencia_vac.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

<div class="margin-top">
   <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
      <div style="padding: 12px; background-image: 
         url('assets/img/escudoGobsinletrasOpacity.png');
         background-size: 300px;
         background-repeat: no-repeat;
         background-position: center;">
         <table class="title">
            <tr class="items">
                  <td style="width: 10%; text-align:center">
                     <img src="<?php echo e(asset('assets/img/escudoGobiernoAutonomo.png')); ?>" width="70px" alt="Image"/>
                     
                  </td>
                  <td style="width: 60%; text-align:center; font-weight: bold;">
                     <div style="font-size: 13px; font-weight: bold; text-decoration: underline;">
                        GOBIERNO AUTÓNOMO DEPARTAMENTAL DE LA PAZ 
                     </div>
                     <div style="font-size: 15px; font-weight: bold;">
                        DIRECCIÓN DE RECURSOS HUMANOS 
                     </div>
                     


                     <div style="font-size: 30px">PAPELETA DE LICENCIA</div>
         
                     <div style="font-size: 20px"><?php echo e($title); ?></div>
                  </td>
                  <td style="width: 30%; text-align:center"> 
                     <table class="body">

                        <tr class="items">
                           <td style="width: 30%; text-align:center; " >
                              <fieldset class='float-label-field' >
                                 <label for="txtName">R.R.H.H.</label>
                              </fieldset>
                           </td>
                           <td style="width: 70%; text-align:center" >
                              
                           </td>
                        </tr>
                        <tr class="items">
                           <td style="width: 30%; text-align:center; padding:0" >
                              <fieldset class='float-label-field'>
                                 <label for="txtName">N° ÍTEM</label>
                              </fieldset>
                           </td>
                           <td style="width: 70%; text-align:center; padding:0" >
                              <fieldset class='float-label-field'>
                                 <input style="border-bottom-style: dotted;" id="txtName" type='text' value="<?php echo e($empleado->cargo[0]->pivot['cargos.nro_item']); ?>">
                              </fieldset>
                           </td>
                        </tr>

                        <tr class="items">
                           <td style="width: 30%; text-align:center; padding:0" >
                              <fieldset class='float-label-field'>
                                 <label for="txtName">CI</label>
                              </fieldset>
                           </td>
                           <td style="width: 70%; text-align:center; padding:0" >
                              <fieldset class='float-label-field'>
                                 <input style="border-bottom-style: dotted;" id="txtName" type='text' value="<?php echo e($empleado->ci); ?>">
                              </fieldset>
                           </td>
                        </tr>
                     </table>
                  </td>
            </tr>
         </table>



         <hr class="hr-style">
         <table class="body">
            <tr class="items">
                     <td style="width: 30%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">NOMBRE Y APELLIDO</label>
                        </fieldset>
                     </td>
                     <td style="width: 70%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                        </fieldset>
                     </td>
            </tr>
         </table>
         <hr class="hr-style">
         <table class="body">
            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">DEPENDIENTE</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($area->nombre); ?>">
                   </fieldset>
                </td>
            </tr>
         </table>
         <hr class="hr-style">
         <table class="body">
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">N° DE DÍAS</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->numero_dias); ?>">
                  </fieldset>
               </td>
            </tr>
         </table>
         <hr class="hr-style">
         <table class="body">
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">FECHA(S) DE VACACIÓN</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     
                     <?php $__currentLoopData = $licencia_fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                        <input id="txtName" type='text' value="<?php echo e(date('d-m-y', strtotime($fecha->fecha_inicio))); ?>  al  <?php echo e(date('d-m-y', strtotime($fecha->fecha_hasta))); ?>  -  <?php echo e(html_entity_decode($fecha->horario_desc->descripcion)); ?>">
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </fieldset>
               </td>
            </tr>
         </table>
         <hr class="hr-style">
         <table class="body">
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">MOTIVO</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->motivo); ?>">
                  </fieldset>
               </td>
            </tr>
         </table>
         <hr class="hr-style">
         <table class="body">
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">FECHA DE PRESENTACIÓN</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->fecha_registro); ?>">
                  </fieldset>
               </td>
            </tr>
         </table>
         <hr class="hr-style">

         <table class="body">
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">FECHA DE ENTREGA A CONTROL DE PERSONAL</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value=".">
                  </fieldset>
               </td>
            </tr>
         </table>

         <hr class="hr-style">

 

         
         <table style="top: -20px">
            <tr class="items">
            <td style="width: 20%; text-align:center" >
            </td>
            <td style="width: 60%; text-align:center; font-size:12px;" >
               NOTA: Las licencias deben pedirse con 24 hrs de anticipacion
            </td>
            <td style="width: 20%; text-align:center" >
            </td>
            </tr>
         </table>



      
        
      </div>
   </div>
</div>











<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/pdf/fichaVacacion.blade.php ENDPATH**/ ?>