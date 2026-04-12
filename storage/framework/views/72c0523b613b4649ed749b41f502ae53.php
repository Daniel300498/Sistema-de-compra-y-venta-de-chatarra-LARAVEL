

<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/licencias/pdf_licencia_sin.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

<div class="margin-top">
   <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
      <div style="padding: 12px; background-image: 
         url('assets/img/escudoGobsinletrasOpacity.png');
         background-size: 500px;
         background-repeat: no-repeat;
         background-position: center;">
         <table class="title">
            <tr class="items">
                  <td style="width: 20%; text-align:center">
                     <img src="<?php echo e(asset('assets/img/escudoGobiernoAutonomo.png')); ?>" width="60px" alt="Image"/>
                  </td>
                  <td style="width: 60%; text-align:center; font-weight: bold;">
                     <div style="font-size: 13px; font-weight: bold; text-decoration: underline;">
                        GOBIERNO AUTÓNOMO DEPARTAMENTAL DE LA PAZ 
                     </div>
                     <div style="font-size: 15px; font-weight: bold;">
                        DIRECCIÓN DE RECURSOS HUMANOS 
                     </div>

                     <div style="font-size: 17px">FORMULARIO DE SOLICITUD EXCEPCIONAL DE</div>

                     <?php if($title == "ESPECIAL"): ?>
                        <div style="font-size: 17px">PERMISO PERSONAL <?php echo e($title); ?></div>
                     <?php else: ?>
                        <div style="font-size: 17px">PERMISO PERSONAL <?php echo e($title); ?> GOCE DE HABERES</div>
                     <?php endif; ?>
                  </td>
                  <td style="width: 20%; text-align:center"> 
                  <img src="<?php echo e(asset('assets/img/escudoCondor.png')); ?>" width="80px" alt="Image"/>
                     <table class="body" style="margin-top: 8px;">
                        <tr class="items">
                           <?php if($empleado->cargo[0]->pivot['cargos.nro_item']!=null): ?>
                           <td style="width: 30%; text-align:center; " >
                              <fieldset class='float-label-field'>
                                 <label for="txtName">N° ITEM</label>
                              </fieldset>
                           </td>
                           <td style="width: 70%; text-align:center" >
                              <fieldset class='float-label-field'>
                                 <input style="border-bottom-style: dotted;" id="txtName" type='text' value="<?php echo e($empleado->cargo[0]->pivot['cargos.nro_item']); ?>">
                              </fieldset>
                           </td>
                           <?php endif; ?>
                        </tr>
                     </table>
                  </td>
            </tr>
         </table>

         <br>


         <table class="body" style="margin-bottom: 15px;">
            <tr class="items">
                     <td style="width: 30%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Nombre Completo del Solicitante</label>
                        </fieldset>
                     </td>
                     <td style="width: 40%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                        </fieldset>
                     </td>
                     <td style="width: 10%; text-align:center; " >
                        <fieldset class='float-label-field'>
                              <label for="txtName">CI</label>
                        </fieldset>
                     </td>
                     <td style="width: 20%; text-align:center" >
                              <fieldset class='float-label-field'>
                                 <input style="border-bottom-style: dotted;" id="txtName" type='text' value="<?php echo e($empleado->ci); ?>">
                              </fieldset>
                     </td>
            </tr>
         </table>
         
         <table class="body">
            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Área Organizacional</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($area->nombre); ?>">
                   </fieldset>
                </td>
            </tr>

            <tr class="items">
               <td style="width: 30%; text-align:center; " >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Jefe Inmediato Superior</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($jefe->nombres); ?> <?php echo e($jefe->ap_paterno); ?> <?php echo e($jefe->ap_materno); ?>">
                  </fieldset>
               </td>
           </tr>

           <div style="font-size: 15px; font-weight: bold; border-radius: 20px; border: solid 1px #4e4b4bfa; text-align:center;"> SOLICITUD DE PERMISO  </div>

            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Número de días</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->numero_dias); ?>">
                  </fieldset>
               </td>
            </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Fecha(s)</label>
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
          


            <?php if($licencia->enfermedad_especial!=null): ?>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Enfermedad</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($enfermedad->descripcion); ?>">
                  </fieldset>
               </td>
            </tr>
            <?php endif; ?>



            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Fundamento o Causa de la Solicitud</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->motivo); ?>">
                  </fieldset>
               </td>
            </tr>
         </table>


        <br>
            <?php if($title == "SIN"): ?>
            <div style="font-size: 15px; font-weight: bold; border-radius: 20px; border: solid 1px #4e4b4bfa; text-align:center; width: 100%">
                REGLAMENTO INTERNO DE PERSONAL ART. 27 Y ART. 29 <br> (PERMISO PERSONAL SIN GOCE DE HABERES)  </div>
            <?php else: ?> 
               <?php if($title == "CON"): ?>
                  <div style="font-size: 15px; font-weight: bold; border-radius: 20px; border: solid 1px #4e4b4bfa; text-align:center; width:100%">
                  REGLAMENTO INTERNO DE PERSONAL ART. 26 Y PARÁGRAFO. <br> (SOLICITUD EXCEPCIONAL DE PERMISO PERSONAL CON GOCE DE HABERES)  </div>
               <?php endif; ?>
            <?php endif; ?>
         <br>

      
         <table class="body">
            <tr class="items">
               <td style="width: 40%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Fecha de entrega a Control de Personal: </label>
                  </fieldset>
               </td>
               <td style="width: 50%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value=".">
                  </fieldset>
               </td>
               <td style="width: 40%; text-align:center"  >
               </td>
            </tr>
         </table>
         <br>
         <br>
            
            
            <table class="body">
            <tr class="items">
               <td style="width: 10%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">La Paz,</label>
                  </fieldset>
               </td>
               <td style="width: 50%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->fecha_registro); ?>">
                  </fieldset>
               </td>
               <td style="width: 40%; text-align:center" >
               </td>
            </tr>
         </table>
         <br>
        
      </div>
   </div>

   <hr class="hr-style">


   <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
      <div style="padding: 12px; background-image: 
         url('assets/img/escudoGobsinletrasOpacity.png');
         background-size: 300px;
         background-repeat: no-repeat;
         background-position: center;">
            <?php if($title == "ESPECIAL"): ?>
               <div style="font-size: 15px; font-weight: bold; text-align:center;">
                  FORMULARIO DE SOLICITUD EXCEPCIONAL DE PERMISO PERSONAL <?php echo e($title); ?><br>
                  PARA USO DE CONTROL PERSONAL 
               </div>

            <?php else: ?>
               <div style="font-size: 15px; font-weight: bold; text-align:center;">
                  FORMULARIO DE SOLICITUD EXCEPCIONAL DE PERMISO PERSONAL <?php echo e($title); ?> GOCE DE HABERES <br>
                  PARA USO DE CONTROL PERSONAL 
               </div>

            <?php endif; ?>

            
         <br>


         <table class="body">
            <tr class="items">
                     <td style="width: 30%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Nombre del Solicitante</label>
                        </fieldset>
                     </td>
                     <td style="width: 40%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                        </fieldset>
                     </td>
            </tr>

            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Área de Trabajo</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($area->nombre); ?>">
                   </fieldset>
                </td>
            </tr>
            

            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Motivo</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->motivo); ?>">
                  </fieldset>
               </td>
            </tr>
         
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Fecha(s)</label>
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
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Lugar y Fecha</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="La Paz, <?php echo e($licencia->fecha_registro); ?>">
                  </fieldset>
               </td>
            </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Fecha de entrega a Control de Personal: </label>
                  </fieldset>
               </td>
               <td style="width: 50%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value=".">
                  </fieldset>
               </td>
               
            </tr>
         </table>
       

          
         <br>
      
            
      

        
      </div>
   </div>
</div>







<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/pdf/ficha.blade.php ENDPATH**/ ?>