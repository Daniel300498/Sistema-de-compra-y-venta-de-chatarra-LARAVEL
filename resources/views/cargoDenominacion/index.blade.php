@extends('layouts.app')
@section('titulo', 'Denominación del Cargo')
@section('content')

<div class="pagetitle">
    <h1>Cargos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Cargos</a></li>
            <li class="breadcrumb-item active">Denominación del Cargo</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Agregar Denominación del Cargo</h5>
                      <p> Debe rellenar el campo descripción y el salario correspondiente y presionar el botón <strong>GUARDAR</strong>.</p>
                    <!-- CONTENIDO -->            
                    <form action="{{route('cargoDenominacion.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                                    <input id="descripcion" name= "descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}"required value="{{ old('descripcion', isset($area) ? $area->descripcion : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                                    @error('descripcion')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="sueldo">Salario</label> <span class="text-danger">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bs.-</span>
                                    </div>
                                    <input name="sueldo" id="sueldo" type="number" step="0.01" class="form-control {{ $errors->has('sueldo') ? ' error' : '' }}" required>
                                    @error('sueldo')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($cargoDenominacion)>0)
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Denominaciones de Cargos Registrados</h5>
            <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede editar o eliminar una denominación.</p><p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la denominación de la cual quiera aplicar alguna acción.</p>
                    <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
                        <thead>
                            <tr>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Salario</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cargoDenominacion as $a)
                            <tr>
                            <td>
                                <small>{{$a->descripcion}}</small>   
                            </td>
                            <td class="text-center">
                                    <small>Bs.- {{number_format($a->sueldo,2) }}</small>       
                            </td>
                            <td class="d-flex justify-content-center" >
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('cargoDenominacion.edit')
                                            <li><a class="dropdown-item" href="{{route('cargoDenominacion.edit',$a->uuid)}}">Modificar Datos</a></li>
                                        @endcan        
                                        @can('cargoDenominacion.destroy')
                                        <li><a class="dropdown-item" href="{{ route('cargoDenominacion.destroy',$a->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la denominación del cargo?');">Eliminar Denominación</a></li>
                                        @endcan
                                    </ul>
                                  </div>
                            </td>
                            </tr>
                     @endforeach
                        </tbody>
                    </table>
                    
          </div>
        </div>
      </div>
    </div>
</section>
@endif
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection

