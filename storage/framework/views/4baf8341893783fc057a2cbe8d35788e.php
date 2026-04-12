<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/empleados/pdf.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Ficha Personal</title>
<div class="margin-top" style="background-image: 
         url('assets/img/escudoGobsinletrasOpacity.png');
         background-size: 500px;
         background-repeat: no-repeat;
         background-position: center;">
   <table class="title">
      <tr class="items">
              <td style="width: 20%; text-align:center">
                 <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
              </td>
              <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                  <div style="font-size: 13px; font-weight: bold;">
                     GOBIERNO AUTÓNOMO DEPARTAMENTAL DE LA PAZ 
                  </div>
                  <div style="font-size: 15px; font-weight: bold;">
                     DIRECCIÓN DE RECURSOS HUMANOS
                  </div>
                  <div style="font-size: 17px; font-weight: bold;">
                     FICHA - PERSONAL
                  </div>
                 
                 <?php echo e($empleado->cargo[0]->pivot['cargos.tipo_cargo']); ?>

              </td>
              <td style="width: 20%; text-align:center">
                  <?php if($empleado->foto!=null): ?>
                  <img src="<?php echo e(asset('fotos_empleados/'.$empleado->id.'/'.$empleado->foto)); ?>" height="100px;">
                  <?php endif; ?>
              </td>
      </tr>
  </table>

  <p style="font-weight: bold">1. DATOS PERSONALES</p>
   <table class="body">
       <tr class="items" style="width: 100%">
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName" >Nombres</label>
                     <input id="txtName" class="campo" type='text' value="<?php echo e($empleado->nombres); ?>">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Paterno</label>
                     <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->ap_paterno); ?>">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Materno</label>
                     <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->ap_materno); ?>">
                   </fieldset>
               </td>
       </tr>
   </table>
   <table class="body">
      <tr class="items" style="width:100%">
        <td style="width: 40%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Fecha de Nacimiento</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e(date('d-m-Y', strtotime($empleado->fecha_nacimiento))); ?>">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Edad</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->edad); ?>">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Estado Civil</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->estado_civil); ?>">
            </fieldset>
        </td>
         <?php if($empleado->nro_hijos!=null): ?>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Nro. de Hijos</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nro_hijos); ?>">
            </fieldset>
        </td>
        <?php endif; ?>
      </tr>
  </table>
  <table class="body">

      <tr class="items" style="width:100%">
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Lugar de Nacimiento</label>
               <input id="txtName" type='text' class="campo" value="<?php echo e($ciudad->ciudad); ?>">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Provincia</label>
               <input id="txtName" type='text' class="campo" value="<?php echo e($ciudad->provincia); ?>">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Cédula de Identidad</label>
               <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->ci); ?> <?php echo e($empleado->ci_complemento); ?> <?php echo e($empleado->ci_lugar); ?>">
            </fieldset>
         </td>
      </tr>
   </table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 60%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Domicilio</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->domicilio); ?>">
         </fieldset>
     </td>
      <?php if($empleado->nro_libreta_militar!=null): ?>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Nro. de Libreta de Servicio Militar</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nro_libreta_militar); ?>">
         </fieldset>
     </td>
     <?php endif; ?>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 60%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Correo</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->email); ?>">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Celular</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nro_celular); ?>">
         </fieldset>
     </td>
      <?php if($empleado->nro_telefono!=null): ?>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Teléfono</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nro_telefono); ?>">
         </fieldset>
     </td>
     <?php endif; ?>
   </tr>
</table>
<table class="body">
    <?php if($empleado->redes_sociales!=null): ?>
   <tr class="items" style="width:100%">
        <td style="width: 60%; text-align:center" >
            <fieldset class='float-label-field'>
            <label for="txtName">Cuenta de Facebook o Instagram</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->redes_sociales); ?>">
            </fieldset>
        </td>
        <td style="width: 40%; text-align:center"></td>
   </tr>
   <?php endif; ?>
</table>

<p style="font-weight: bold;">2. PERSONA DE CONTACTO EN CASO DE EMERGENCIA</p>
<table class="body">
   
   <tr class="items" style="width:100%">
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Nombre</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->contacto_nombre); ?>">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Teléfono</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->contacto_telefono); ?>">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Parentesco</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->contacto_parentesco); ?>">
            </fieldset>
      </td>
   </tr>
</table>


<p style="font-weight: bold">3. OCUPACIÓN</p>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 33.3%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Formación</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($formacion->descripcion); ?>">
         </fieldset>
     </td>
     <td style="width: 33.3%; text-align:center" >
      <fieldset class='float-label-field'>
         <label for="txtName">Carrera Universitaria</label>
         <input id="txtName" type='text' class="campo" value="<?php echo e($profesion->descripcion); ?>">
       </fieldset>
   </td>
  
   </tr>
</table>
<table class="body">
   <tr class="items" style="width:100%">
      <td style="width: 50%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Universidad o Instituto</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($institucion_educativa->descripcion); ?>">
          </fieldset>
      </td>
      <td style="width: 50%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Ultimo empleo</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->ultimo_empleo); ?>">
          </fieldset>
      </td>
    
   </tr>
</table>


<p style="font-weight: bold">4. INSTITUCIONAL</p>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">F. Ingreso</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e(date('d-m-Y', strtotime($cargo[0]->fecha_inicio))); ?>">
         </fieldset>
     </td>
     <?php if($cargo[0]->fecha_conclusion!=null): ?>
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">F. Conclusión</label>
           <input id="txtName" type='text' class="campo" value="<?php if($cargo[0]->fecha_conclusion!=null): ?><?php echo e(date('d-m-Y', strtotime($cargo[0]->fecha_conclusion))); ?> <?php endif; ?>" >
         </fieldset>
     </td>
     <?php endif; ?>
     
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Puesto</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->cargo[0]->nombre); ?>">
         </fieldset>
     </td>
     <?php if($empleado->cargo[0]->tipo_cargo=='CONSULTOR'): ?>
     <td style="text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">NIT</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nit); ?>">
         </fieldset>
      </td>
     <?php endif; ?>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Número de Cuenta</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nro_cuenta); ?>">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Institución Bancaria</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($banco->descripcion); ?>">
         </fieldset>
     </td>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Seguro a Largo Plazo AFP:</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($afp->descripcion); ?>">
         </fieldset>
     </td>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Seguro de Salud</label>
           <?php if($seguro_salud!=null): ?>
           <input id="txtName" type='text' class="campo" value="<?php echo e($seguro_salud->descripcion); ?>">
           <?php else: ?>
           <input id="txtName" type='text' class="campo" value="N/A">
           <?php endif; ?>
         </fieldset>
     </td>
      <?php
     $fecha_ingreso=date('Y-m-d', strtotime($cargo[0]->fecha_inicio));
     $date1 = new DateTime($fecha_ingreso);
     $date2 = new DateTime("now");
     $diff = $date1->diff($date2);
     ?>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Años de Servicio </label>
           
           <input id="txtName" type='text' class="campo" value="<?php echo e($diff->format('%y Años %m Meses %d Dias')); ?> ">
         </fieldset>
     </td>
     <?php if($empleado->nit === NULL): ?>
     <td style="width: 40%; text-align:center" >

     </td>
     <?php else: ?>
     <td style="width: 40%; text-align:center" >
      <fieldset class='float-label-field'>
         <label for="txtName">Nit </label>
         
         <input id="txtName" type='text' class="campo" value="<?php echo e($empleado->nit); ?> ">
       </fieldset>

     </td>


     <?php endif; ?>
    
   </tr>
</table>

<table class="body">
   <tr class="items">
        <td style="width: 25%; text-align:center">
        </td>
        <td style="width: 50%; height: 20px; text-align:center; font-size:10px; font-weight: bold;">
            <div style="padding: 0.5px;  border-bottom-style: dotted; height: 25px;">

            </div>
        </td>
        <td style="width: 25%; text-align:center">
        <fieldset class='float-label-field'>
            <label for="txtName">Fecha:</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e(date('d-m-Y',strtotime($empleado->fecha_registro))); ?>">
            </fieldset>
        </td>
   </tr>
</table>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 25%;" >

     </td>
     <td style="width: 50%; text-align:center; font-weight: bold;" >
        <p>FIRMA DEL FUNCIONARIO</p>
     </td>
     <td style="width: 25%;" >

     </td>
   </tr>
</table>
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/pdf/ficha.blade.php ENDPATH**/ ?>