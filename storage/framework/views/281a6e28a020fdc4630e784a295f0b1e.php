<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ingreso | </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php echo $__env->make('layouts.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="body-login">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-1">
                <a href="#" class="logo-login d-flex align-items-center w-auto">
                  <img src="<?php echo e(asset('assets/img/irca.png')); ?>" alt=""  width="180px"  height="160px">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                    <div class="pt-7 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Bienvenid@!!!</h5>
                        <p class="text-center small">Debe ingresar el correo electr&oacute;nico, usuario y contraseña para acceder al sistema.</p>
                    </div>

                    <form class="row g-3 needs-validation"  method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-12">
                           <label for="email" class="form-label">Usuario o Correo Electr&oacute;nico</label>
                            <div class="input-group has-validation">
                                <input type="text" name="email" class="form-control" id="email" required>
                                <?php if($errors->has('email')): ?>
                                  <span class="text-danger">
                                    <?php echo e($errors->first('email')); ?>

                                  </span>
                                <?php endif; ?>
                            </div>
                        </div>

                         <div class="col-12">
                          <label for="yourPassword" class="form-label">Contrase&ntilde;a</label>
                          <div class="position-relative">
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                            <span class="position-absolute" style="right: 10px; top: 10px; cursor: pointer;" onclick="togglePassword('yourPassword', 'toggleYourPasswordIcon')">
                              <i id="toggleYourPasswordIcon" class="bi bi-eye"></i>
                            </span>
                          </div>
                          <?php if($errors->has('password')): ?>
                          <div class="invalid-feedback">Ingrese su contrasenia</div>
                          <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Recordarme</label>
                            </div>
                        </div>
                        <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 <?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\laragon\www\dashboard\resources\views/auth/login.blade.php ENDPATH**/ ?>