@extends('layouts.app')
@section('titulo','Academico')
@section('content')

<div class="pagetitle"> 
    <h1>Parámetros</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Parámetros</a></li>
                <li class="breadcrumb-item active">Modificar paramatro Académico</li>
            </ol>
        </nav>        
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Modificar Parámetro</h5>
                        <h3><span class="badge bg-nombre-empleado">
                            @if ($parametro->tipo =='formacion')
                                TIPO: FORMACION
                            @elseif ($parametro->tipo =='profesion')   
                                TIPO: CARRERAS UNIVERSITARIAS
                            @elseif ($parametro->tipo =='institucion_formacion')   
                                TIPO: UNIVERSIDAD O INSTITUTO
                            @endif
                        </span></h3>
                      </div>
                    <!--CONTENIDO -->
                    <p>Debe ingresar el nombre del parámetro.</p>                  

                    <form action="{{ route('academico.update', $parametro->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descripcion">Nombre <span class="text-danger">*</span></label>
                                    <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion"  value="{{ old('descripcion', isset($parametro) ? $parametro->descripcion : '') }}" required="required" placeholder="Ingrese el nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                                    @error('descripcion')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div> 
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('academico.index') }}" class="btn btn-danger">Salir</a>  
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
