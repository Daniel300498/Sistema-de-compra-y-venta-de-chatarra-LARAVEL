@extends('layouts.app')
@section('titulo','Asignar Cargo')
@section('content')

<div class="pagetitle">
    <h1>Asignar Cargo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cargoEmpleados.index') }}">Cargo Empleados</a></li>
            <li class="breadcrumb-item active">Asignar Cargo</li>
        </ol>
    </nav>
</div>
<section class="section">  
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Asignacion de Cargo a Empleado</h5>
                        <h3><span class="badge bg-nombre-empleado">CARGO: {{$cargo->nombre}}</span></h3>
                    </div>
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. Debe seleccionar el nombre del funcionario al cual quiere asignarle el <strong>ITEM</strong>.</p>
                    
                    <form action="{{ route('cargoEmpleados.store_asignar',$cargo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-6">
                                {{ Form::label('empleado_id', 'Funcionarios Sin Cargo') }} <span class="text-danger">(*)</span>
                                <div class="d-flex align-items-center justify-content-between">
                                    <select name="empleado_id" id="empleado_id" class="form-control {{ $errors->has('empleado_id') ? ' error' : '' }}">
                                        <option value="">-- SELECCIONE --</option>
                                        @foreach ($empleadosSinCargo as $empleado)
                                            <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('empleado_id'))
                                        <span class="text-danger"> {{ $errors->first('empleado_id') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('tipo_alta', 'Tipo de Alta') }} <span class="text-danger">(*)</span>
                                <select name="tipo_alta" id="tipo_alta" class="form-control {{ $errors->has('tipo_alta') ? ' error' : '' }}" value="{{ old('tipo_alta') }}">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="PROMOCION">PROMOCION</option>
                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                    <option value="REINGRESO">REINGRESO</option>
                                </select>
                                @if ($errors->has('tipo_alta'))
                                    <span class="text-danger">{{ $errors->first('tipo_alta') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento2"> Documento  @if ($cargo->tipo_cargo == "PERSONAL EVENTUAL")Contrato @endif <span class="text-danger">(*)</span></label>
                                    <div class="input-group">
                                        <input id="documento2" type="file" class="form-control {{ $errors->has('documento2') ? ' error' : '' }}" name="documento2">                  
                                    </div>
                                    @if ($errors->has('documento2'))
                                        <span class="text-danger">{{ $errors->first('documento2') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($cargo->tipo_cargo =="PERSONAL EVENTUAL")
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nro_contrato">Numero de contrato <span class="text-danger">(*)</span></label>
                                    <input id="nro_contrato" type="text" class="form-control {{ $errors->has('nro_contrato') ? ' error' : '' }}" name="nro_contrato" value="{{ old('nro_contrato') }}">                
                                    @if ($errors->has('nro_contrato'))
                                        <span class="text-danger">{{ $errors->first('nro_contrato') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio <span class="text-danger">(*)</span></label>
                                    <input id="fecha_inicio" type="date" class="form-control {{ $errors->has('fecha_inicio') ? ' error' : '' }}" name="fecha_inicio" value="{{ old('fecha_inicio') }}">                
                                    @if ($errors->has('fecha_inicio'))
                                        <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($cargo->tipo_cargo =="PERSONAL EVENTUAL")
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_conclusion">Fecha de Conclusion <span class="text-danger">(*)</span></label>
                                    <input id="fecha_conclusion" type="date" class="form-control {{ $errors->has('fecha_conclusion') ? ' error' : '' }}" name="fecha_conclusion" value="{{ old('fecha_conclusion') }}">                
                                    @if ($errors->has('fecha_conclusion'))
                                        <span class="text-danger">{{ $errors->first('fecha_conclusion') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="row mt-4">  
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary" name="estado">Guardar</button>
                                <a href="{{ route('cargoEmpleados.acefalo_index') }}" class="btn btn-danger">Salir</a>
                            </div>
                            </div>
                        </form>

                    </div>
                </div>
        </div>
    </div>
</section>

@endsection
