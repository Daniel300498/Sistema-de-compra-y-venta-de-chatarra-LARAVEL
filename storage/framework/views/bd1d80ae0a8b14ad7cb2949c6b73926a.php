

<?php $__env->startSection('titulo','Tiempo Descanso'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>TIEMPO DESCANSO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('tiempo_descanso.index')); ?>">Tiempo Descanso</a></li>
        <li class="breadcrumb-item active">Editar</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Actualizar Tiempo De Descanso</h5>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>ACTUALIZAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
           <!--CONTENIDO -->
           <form id="tiempoDescansoForm" action="<?php echo e(route('tiempo_descanso.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="id" id="id" value="<?php echo e($tiempodescanso->id); ?>">


            <div class="row">
              <input id="empresa" type="hidden" class="form-control <?php echo e($errors->has('empresa') ? ' error' : ''); ?>" name="empresa" value="<?php echo e($tiempodescanso->empresa); ?>" readonly >
                
              <div class="col-lg-4">
                <?php echo e(Form::label('nombre','Nombre' )); ?> <span class="text-danger">(*)</span>
                <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e($tiempodescanso->nombre); ?>" >
                <?php if($errors->has('nombre')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('nombre')); ?>

                    </span>
                <?php endif; ?>
               </div>
               <div class="col-lg-4">
                <?php echo e(Form::label('tipo_calculo','Tipo de C&aacute;lculo' )); ?> <span class="text-danger">(*)</span>
                <select name="tipo_calculo" class="form-control <?php echo e($errors->has('tipo_calculo') ? ' error' : ''); ?>" id="tipo_calculo">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('tipo_calculo',$tiempodescanso->tipo_calculo ) =='1' ? 'selected' :''); ?>>Auto Descontar</option>
                    <option value="2" <?php echo e(old('tipo_calculo',$tiempodescanso->tipo_calculo ) =='2' ? 'selected' :''); ?>>Requiere Marcaci&oacute;n</option>
                </select>
                <?php if($errors->has('tipo_calculo')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('tipo_calculo')); ?>

                    </span>
                <?php endif; ?>
              </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Configuraci&oacute;n B&aacute;sica</h5>
            </div>
            
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('hora_inicial','Hora Inicial' )); ?> <span class="text-danger">(*)</span>
                  <input id="hora_inicial" type="time" class="form-control <?php echo e($errors->has('hora_inicial') ? ' error' : ''); ?>" name="hora_inicial" value="<?php echo e($tiempodescanso->hora_inicial); ?>" >
                  <?php if($errors->has('hora_inicial')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('hora_inicial')); ?>

                      </span>
                  <?php endif; ?>
              </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('hora_final','Hora Final' )); ?> <span class="text-danger">(*)</span>
                  <input id="hora_final" type="time" class="form-control <?php echo e($errors->has('hora_final') ? ' error' : ''); ?>" name="hora_final" value="<?php echo e($tiempodescanso->hora_final); ?>" >
                  <?php if($errors->has('hora_final')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('hora_final')); ?>

                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('duracion_descanso','Duraci&oacute;n Descanso (MINUTOS)' )); ?> <span class="text-danger">(*)</span>
                  <input id="duracion_descanso" type="number" class="form-control<?php echo e($errors->has('duracion_descanso') ? ' error' : ''); ?>" name="duracion_descanso" value="<?php echo e($tiempodescanso->duracion_descanso); ?>" >
                  <?php if($errors->has('duracion_descanso')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('duracion_descanso')); ?>

                      </span>
                  <?php endif; ?>
                </div>
              </div>
              <br>
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Configuracion De Regla</h5>
              </div>
              <div class="row">
              <div class="col-lg-4">
              </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('estado_marcacion','Basado En Estado De Marcaci&oacute;n' )); ?> <span class="text-danger">(*)</span>
                  <select name="estado_marcacion" class="form-control <?php echo e($errors->has('estado_marcacion') ? ' error' : ''); ?>" id="estado_marcacion">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('estado_marcacion',$tiempodescanso->estado_marcacion ) =='1' ? 'selected' :''); ?>>No</option>
                    <option value="2" <?php echo e(old('estado_marcacion',$tiempodescanso->estado_marcacion ) =='2' ? 'selected' :''); ?>>Si</option>
                  
                  </select>
                  <?php if($errors->has('estado_marcacion')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('estado_marcacion')); ?>

                      </span>
                  <?php endif; ?>
              </div>
              <div class="col-lg-4">
                </div>
              <br>
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?php echo e(route('tiempo_descanso.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('tiempoDescansoForm').addEventListener('submit', function (event) {
          // Obtener los valores de las horas y minutos
          let horaInicial = document.getElementById('hora_inicial').value;
          let horaFinal = document.getElementById('hora_final').value;
          let duracionDescanso = parseInt(document.getElementById('duracion_descanso').value) || 0;

          // Convertir horas en minutos
          function convertirAHorasEnMinutos(hora) {
              let [horas, minutos] = hora.split(':').map(Number);
              return horas * 60 + minutos;
          }

          let minutosInicial = convertirAHorasEnMinutos(horaInicial);
          let minutosFinal = convertirAHorasEnMinutos(horaFinal);
          let diferenciaMinutos = minutosFinal - minutosInicial;

          // Validar la duración del descanso
          if (diferenciaMinutos < duracionDescanso) {
            Swal.fire({
              title: 'La duracion excede el período',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar'
            })
              event.preventDefault(); // Evitar el envío del formulario
          }else{
            var ruta=adminUrl+'/tiempo_descanso/store/';
            window.location.assign(ruta);

          }

      });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/tiempo_descanso/edit.blade.php ENDPATH**/ ?>