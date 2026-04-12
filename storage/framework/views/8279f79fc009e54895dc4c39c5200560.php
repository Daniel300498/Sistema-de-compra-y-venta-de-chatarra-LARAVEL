

<?php $__env->startSection('titulo','Mis Datos'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Mis Datos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item active">Mis datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo e(asset('assets/avatar/'.auth()->user()->avatar)); ?>" alt="Profile" class="rounded-circle">
            <h2 class="text-center"><?php echo e($user->name); ?></h2>
            <h3 class="text-center"><?php echo e($user->rol[0]->name); ?></h3>
            
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Mis Datos</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modificar Mis Datos</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
               
                <h5 class="card-title">Detalle</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                  <div class="col-lg-9 col-md-8"><?php if($user->empleado_id == null): ?> <?php echo e($user->name); ?> <?php else: ?> <?php echo e($user->empleado->nombres); ?> <?php echo e($user->empleado->ap_paterno); ?> <?php echo e($user->empleado->ap_materno); ?> <?php endif; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Cargo</div>
                  <div class="col-lg-9 col-md-8"><?php if($user->empleado_id != null): ?><?php echo e($user->empleado->cargo[0]->nombre); ?> <?php endif; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Rol de Acceso</div>
                  <div class="col-lg-9 col-md-8"><?php echo e($user->rol[0]->name); ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?php echo e($user->email); ?></div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <?php echo Form::model($user,['route'=>['users.update_profile',$user->id],'method'=>'PUT','enctype'=>"multipart/form-data"]); ?>

                <p>Puede ingresar los nuevos valores para el nombre completo o email y presionar el botón <strong>GUARDAR</strong> para que se guarde en el sistema. El correo electronico permite acceder al sistema.</p>
                
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-form-label text-right">Foto de Perfil</label>
                      <div class="col-md-8 ">
                        <img src="<?php echo e(asset('assets/avatar/'.auth()->user()->avatar)); ?>" alt="Profile" id="imagen">
                        <div class="pt-2">
                            <label for="fileInput" class="btn btn-warning" title="Cambiar Foto">
                                <i class="bi bi-upload"></i>
                            </label>
                            <input type="file" id="fileInput" name="avatar" style="display: none;">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-1">
                        <label for="name" class="col-md-4  col-form-label text-right">Nombre Completo: <span class="text-danger">(*)</span></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control <?php echo e($errors->has('name') ? ' error' : ''); ?>" name="name" value="<?php echo e(old('name',$user->name)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" >
                            <?php if($errors->has('name')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('name')); ?>

                                </span>
                                
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="row mb-1">
                        <label for="role_id" class="col-md-4 col-form-label text-right ">Correo Electrónico <span class="text-danger">(*)</span></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' error' : ''); ?>" name="email" value="<?php echo e(old('email',$user->email)); ?>" >
                            <?php if($errors->has('email')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('email')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="text-center">
                            <button type="submit" class="btn back-color-second">Guardar</button>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

             

              </div>

             

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="POST" action="<?php echo e(route('change.password')); ?>">
                  <?php echo csrf_field(); ?>
                  <div class="row mb-3">
                    <label for="current_password" class="col-md-4 col-lg-3 col-form-label <?php echo e($errors->has('currect_password') ? ' error' : ''); ?>">Contraseña Actual</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="current_password" type="password" class="form-control" id="current_password" required>
                      <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger">
                              <?php echo e($message); ?>

                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label <?php echo e($errors->has('new_password') ? ' error' : ''); ?>">Nueva Constraseña</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control" id="new_password">
                      <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger">
                              <?php echo e($message); ?>

                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar Nueva Constraseña</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                      <small id="passwordHelpBlock" class="form-text text-muted">
                          <span id="passwordMatch"></span>
                      </small>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('assets/js/forms/users.js')); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function () {
      $('#new_password, #new_password_confirmation').on('input', function () {
          if ($('#new_password').val() == $('#new_password_confirmation').val()) {
              $('#passwordMatch').html('Las contraseñas coinciden').css('color', 'green');
          } else {
              $('#passwordMatch').html('Las contraseñas no coinciden').css('color', 'red');
          }
      });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/users/profile.blade.php ENDPATH**/ ?>