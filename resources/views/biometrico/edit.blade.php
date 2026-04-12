@extends('layouts.app')

@section('titulo','Biometricos')

@section('content')

<div class="pagetitle">
    <h1>BIOMETRICO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Modificar Biometrico</h5>
          </div>
          <p>Todos los campos marcados con  <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
         <!--CONTENIDO -->
         <form action="{{route('devices.update')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field()}}
          <input type="hidden" name="id" id="id" value="{{$response['id'] }}">
          <div class="row">
            <div class="col-lg-4">
              {{Form::label('nombre','Nombre Dispositivo' )}} <span class="text-danger">(*)</span>
              <input id="alias" type="text" class="form-control {{ $errors->has('alias') ? ' error' : '' }}" name="alias" value="{{$response['alias'] }}">
              @if ($errors->has('alias'))
              <span class="text-danger">
                  {{ $errors->first('alias') }}
              </span>
              @endif
            </div>
            <div class="col-lg-4">
              {{Form::label('nombre','Numero de serie' )}} <span class="text-danger">(*)</span>
              <input id="sn" type="text" class="form-control {{ $errors->has('sn') ? ' error' : '' }}" name="sn" value="{{$response['sn'] }}">
              @if ($errors->has('sn'))
              <span class="text-danger">
                  {{ $errors->first('sn') }}
              </span>
              @endif
            </div>
            <div class="col-lg-4">
              {{Form::label('nombre','Area' )}} <span class="text-danger">(*)</span>
              <input id="area" type="text" class="form-control {{ $errors->has('area') ? ' error' : '' }}" name="area" value="{{$response['area']['area_code']  }}">
              @if ($errors->has('area'))
              <span class="text-danger">
                  {{ $errors->first('area') }}
              </span>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              {{Form::label('nombre','Intervalo De Solicitud' )}} <span class="text-danger">(*)</span>
              <input id="heartbeat" type="text" class="form-control {{ $errors->has('heartbeat') ? ' error' : '' }}" name="heartbeat" value="{{$response['transfer_interval'] }}">
              @if ($errors->has('heartbeat'))
              <span class="text-danger">
                  {{ $errors->first('heartbeat') }}
              </span>
              @endif
            </div>
            <div class="col-lg-4">
              {{Form::label('nombre','Direccion Ip' )}} <span class="text-danger">(*)</span>
              <input id="ip_address" type="text" class="form-control {{ $errors->has('ip_address') ? ' error' : '' }}" name="ip_address" value="{{$response['ip_address'] }}">
              @if ($errors->has('ip_address'))
              <span class="text-danger">
                  {{ $errors->first('ip_address') }}
              </span>
              @endif
            </div>
            <div class="col-lg-4">
              {{Form::label('nombre','Terminal Tz' )}} <span class="text-danger">(*)</span>
              <input id="terminal_tz" type="text" class="form-control {{ $errors->has('terminal_tz') ? ' error' : '' }}" name="terminal_tz" value="{{$response['terminal_tz'] }}" required >
              @if ($errors->has('terminal_tz'))
              <span class="text-danger">
                  {{ $errors->first('terminal_tz') }}
              </span>
              @endif
            </div>        
          </div>
     
          <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="{{ route('devices.index') }}" class="btn btn-danger">Salir</a>
          </div>
        </form>
          <!-- EndCONTENIDO Example -->

        </div>
      </div>
    </div>
  </div>
  
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection