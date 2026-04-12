@extends('layouts.app')
@section('titulo','Mis Datos')
@section('content')

<div class="pagetitle">
    <h1>Mis Datos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Mis datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="{{ asset('assets/avatar/'.auth()->user()->avatar) }}" alt="Profile" class="rounded-circle">
            <h2 class="text-center">{{ $user->name }}</h2>
            <h3 class="text-center">{{ $user->rol[0]->name }}</h3>
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
                  <div class="col-lg-9 col-md-8">@if($user->empleado_id == null) {{ $user->name }} @else {{ $user->empleado->nombres }} {{ $user->empleado->ap_paterno }} {{ $user->empleado->ap_materno }} @endif</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Cargo</div>
                  <div class="col-lg-9 col-md-8">@if($user->empleado_id != null){{ $user->empleado->cargo[0]->nombre }} @endif</div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">&Aacute;rea</div>
                  <div class="col-lg-9 col-md-8">@if($user->empleado_id != null){{ $user->empleado->cargo[0]->area->nombre }} @endif</div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Rol de Acceso</div>
                  <div class="col-lg-9 col-md-8">{{ $user->rol[0]->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Usuario</div>
                  <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>
                
                 @if ($user->empleado)
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Correo Electr&oacute;nico</div>
                  <div class="col-lg-9 col-md-8">{{ $user->empleado->email }}</div>
                </div>
                @endif 
              </div>
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <!-- Profile Edit Form -->
                {!! Form::model($user,['route'=>['users.update_profile',$user->id],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
               <p>Puede ingresar la nueva foto de perfil y presionar el bot&oacute;n <strong>GUARDAR</strong> para que se guarde en el sistema. El usuario permite acceder al sistema.</p>  
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-form-label text-right">Foto de Perfil</label>
                      <div class="col-md-8 ">
                        <img src="{{ asset('assets/avatar/'.auth()->user()->avatar) }}" alt="Profile" id="imagen">
                        <div class="pt-2">
                            <label for="fileInput" class="btn btn-warning" title="Cambiar Foto">
                                <i class="bi bi-upload"></i>
                            </label>
                             <input type="file" id="fileInput" name="avatar" style="display: none;" accept="image/*">
                        </div>
                      </div>
                    </div>
                 
                    <div class="row mt-2">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
              </div>
              <div class="tab-pane fade pt-3" id="profile-change-password">
                <form method="POST" action="{{ route('change.password') }}">
                  @csrf
                  <div class="row mb-3">
                    <label for="current_password" class="col-md-4 col-lg-3 col-form-label {{ $errors->has('current_password') ? ' error' : '' }}">Contraseña Actual</label>
                    <div class="col-md-8 col-lg-6 position-relative">
                        <input name="current_password" type="password" class="form-control" id="current_password" required>
                        <i id="togglePasswordIcon" class="bi bi-eye position-absolute" style="right: 15px; top: 10px; cursor: pointer;" onclick="togglePassword('current_password', 'togglePasswordIcon')"></i>
                        @error('current_password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>

                  <div class="row mb-3">
                  <label for="new_password" class="col-md-4 col-lg-3 col-form-label {{ $errors->has('new_password') ? ' error' : '' }}">Nueva Contraseña</label>
                  <div class="col-md-8 col-lg-6 position-relative">
                      <input name="new_password" type="password" class="form-control" id="new_password">
                      <i id="togglePasswordIcon" class="bi bi-eye position-absolute" style="right: 15px; top: 10px; cursor: pointer;" onclick="togglePassword('new_password', 'togglePasswordIcon')"></i>
                      @error('new_password')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Confirmar Nueva Contraseña</label>
                    <div class="col-md-8 col-lg-6 position-relative">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                        <i id="togglePasswordIcon" class="bi bi-eye position-absolute" style="right: 15px; top: 10px; cursor: pointer;" onclick="togglePassword('new_password_confirmation', 'togglePasswordIcon')"></i>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            <span id="passwordMatch"></span>
                        </small>
                    </div>
                </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endSection
@section('scripts')
<script src="{{ asset('assets/js/forms/verContrasenia.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/users.js') }}" type="text/javascript"></script>
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
@endSection