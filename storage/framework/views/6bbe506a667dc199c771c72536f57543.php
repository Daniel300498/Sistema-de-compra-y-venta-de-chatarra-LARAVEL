<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/pacientes/pdf.css')); ?>">
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
              </td>
              <td style="width: 20%; text-align:center">
              </td>
      </tr>
  </table>

  <p style="font-weight: bold">1. DATOS PERSONALES</p>
   <table class="body">
       <tr class="items" style="width: 100%">
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName" >Nombres</label>
                     <input id="txtName" class="campo" type='text' value="<?php echo e($paciente->nombres); ?>">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Paterno</label>
                     <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->ap_paterno); ?>">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Materno</label>
                     <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->ap_materno); ?>">
                   </fieldset>
               </td>
       </tr>
   </table>
   <table class="body">
      <tr class="items" style="width:100%">
        <td style="width: 40%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Fecha de Nacimiento</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e(date('d-m-Y', strtotime($paciente->fecha_nacimiento))); ?>">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Edad</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->edad); ?>">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Estado Civil</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->estado_civil); ?>">
            </fieldset>
        </td>
         <?php if($paciente->nro_hijos!=null): ?>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Nro. de Hijos</label>
              <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->nro_hijos); ?>">
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
               <input id="txtName" type='text' class="campo" value="">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Provincia</label>
               <input id="txtName" type='text' class="campo" value="">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Cédula de Identidad</label>
               <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->ci); ?> <?php echo e($paciente->ci_complemento); ?> <?php echo e($paciente->ci_lugar); ?>">
            </fieldset>
         </td>
      </tr>
   </table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 60%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Domicilio</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->domicilio); ?>">
         </fieldset>
     </td>
      <?php if($paciente->nro_libreta_militar!=null): ?>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Nro. de Libreta de Servicio Militar</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->nro_libreta_militar); ?>">
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
           <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->email); ?>">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Celular</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->nro_celular); ?>">
         </fieldset>
     </td>
      <?php if($paciente->nro_telefono!=null): ?>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Teléfono</label>
           <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->nro_telefono); ?>">
         </fieldset>
     </td>
     <?php endif; ?>
   </tr>
</table>
<table class="body">
    <?php if($paciente->redes_sociales!=null): ?>
   <tr class="items" style="width:100%">
        <td style="width: 60%; text-align:center" >
            <fieldset class='float-label-field'>
            <label for="txtName">Cuenta de Facebook o Instagram</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->redes_sociales); ?>">
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
            <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->contacto_nombre); ?>">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Teléfono</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->contacto_telefono); ?>">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Parentesco</label>
            <input id="txtName" type='text' class="campo" value="<?php echo e($paciente->contacto_parentesco); ?>">
            </fieldset>
      </td>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 25%;" >

     </td>
     <td style="width: 50%; text-align:center; font-weight: bold;" >
        <p>FIRMA DEL PACIENTE</p>
     </td>
     <td style="width: 25%;" >

     </td>
   </tr>
</table>
</div><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/pacientes/pdf/ficha.blade.php ENDPATH**/ ?>