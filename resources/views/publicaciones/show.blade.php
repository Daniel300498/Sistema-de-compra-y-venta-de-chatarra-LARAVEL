@extends('layouts.app')
@section('titulo','Publicaciones')
@section('content')
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Publicaciones</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                     <li class="breadcrumb-item"><a href="#">Publicaciones</a></li>
                    <li class="breadcrumb-item active">Ver Publicaciones</li>
                </ol>
            </nav>
        </div>
    </div>
</div><!-- End Page Title -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-transparent">
                        </br>
                        <strong><h2 class="text-center">Bienvenido al Portal de Publicaciones!</h2></strong>
                        </br>
                        <p class="text-center">Encontrarás contenido actualizado diariamente para mantenerte informado. Aquí podrás acceder a formatos, comunicados, reglamentos, normativas y formularios de interés. Nuestro objetivo es proporcionarte información relevante y precisa, de una manera fácil y accesible. Navega por las secciones, y accede a la publicaci&oacute;n completa presionando sobre el t&iacute;tulo de la misma</p>
                        @foreach ($grupoPublicaciones as $tipo => $publicacion)
                        <div class="mb-4">
                            <h3 class="text-uppercase text-center">{{ $tipo }}</h3>
                            <div class="row row-cols-1 row-cols-md-4 g-4"> 
                                @foreach ($publicacion as $noticia)
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalNoticia{{ $noticia->uuid }}">
                                        <div class="card position-relative">
                                            <div class="card-body">
                                                @if ($noticia->es_nuevo)
                                                    <span class="badge btn-primary back-color-second">Nuevo</span>
                                                @endif
                                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                               <p class="card-text"><small class="text-muted">Fecha de Publicaci&oacute;n: {{ date('d-m-Y', strtotime($noticia->fecha_publicacion)) }}</small></p>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                @include('publicaciones.modal._modal_noticias')
                                @endforeach   
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($hayNoticias)
        @include('publicaciones.modal._modal_ver_noticia')
    @endif
</section>
@endsection
