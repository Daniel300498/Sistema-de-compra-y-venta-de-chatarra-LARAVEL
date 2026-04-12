@extends('layouts.app')
@section('titulo', 'Incremento Salarial')
@section('content')

<div class="pagetitle">
    <h1>Cargos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Cargos</a></li>
            <li class="breadcrumb-item active">Incremento Salarial</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Incremento Salarial</h5>
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. Al momento de agregar un incremento salarial, tomar en cuenta que el porcentaje
                         que aplique debe estar sujeto a ley vigente y la misma actualizará los salarios de todas las denominaciones del cargo que seleccione.</p>
                    <!-- CONTENIDO -->            
                    <form action="{{ route('incrementoSalarial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="porcentaje_incremento">Porcentaje de incremento al haber básico <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="porcentaje_incremento" name="porcentaje_incremento" type="number" class="form-control {{ $errors->has('porcentaje_incremento') ? ' error' : '' }}" value="{{ old('porcentaje_incremento', isset($incrementoSalarial) ? $incrementoSalarial->porcentaje_incremento : '') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <span id="porcentaje-error" class="text-danger"></span>
                                @error('porcentaje_incremento')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="fecha_autorizacion">Fecha de Autorización <span class="text-danger">*</span></label>
                                <input id="fecha_autorizacion" name="fecha_autorizacion" type="date" class="form-control {{ $errors->has('fecha_autorizacion') ? ' error' : '' }}" value="{{ old('fecha_autorizacion', isset($incrementoSalarial) ? $incrementoSalarial->fecha_autorizacion : '') }}">
                                @error('fecha_autorizacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="motivo_autorizacion">Motivo de Autorización <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select name="motivo_autorizacion" id="motivo_autorizacion" class="form-control {{ $errors->has('motivo_autorizacion') ? ' error' : '' }}">
                                        <option value="">-- SELECCIONE --</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->descripcion }}" {{ old('motivo_autorizacion', isset($incrementoSalarial) ? $incrementoSalarial->motivo_incremento : '') == $tipo->descripcion ? 'selected' : '' }}>{{ $tipo->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tipoMotiv" title="Agregar Motivo de Autorización">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('motivo_autorizacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <label for="nombre" class="col-md-12 col-form-label">Seleccionar Archivo de Autorización : <span class="text-danger">(*)</span></label>
                                    <input type="file" name="nombre" id="" value="{{ old('nombre', isset($incrementoSalarial) ? $incrementoSalarial->documento_autorizacion : '') }}">
                                    @error('nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="denominaciones" class="col-md-12 col-form-label">Seleccione las denominaciones del cargo a las cuales desea aplicar el aumento salarial: <span class="text-danger">(*)</span></label>
                                    <div id="checkboxes">
                                        <label>
                                            <input type="checkbox" id="select_todos"/>Seleccionar todos
                                        </label>
                                        <br>
                                        @foreach($cargoDenominaciones as $cargoDenominacion)
                                        <label for="chk_{{ $cargoDenominacion->id }}">
                                            <input type="checkbox" id="chk_{{ $cargoDenominacion->id }}" name="denominaciones[]" value="{{ $cargoDenominacion->id }}"/>
                                            {{ $cargoDenominacion->descripcion }}
                                        </label>
                                        <br>
                                    @endforeach
                                    </div>
                                    @error('denominaciones')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('home') }}" class="btn btn-danger"> Salir </a>
                                </div>
                            </div>
                        </div>  
                    </form> 
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@include('incrementoSalarial.modals._modal_tipo')
@section('scripts')
<script src="{{ asset('assets/js/forms/agregaMotivo.js') }}" type="text/javascript"></script>
@endsection

