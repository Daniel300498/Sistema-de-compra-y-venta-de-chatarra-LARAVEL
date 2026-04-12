@extends('layouts.app')

@section('titulo','MIS MEMORANDUMS')

@section('content')

<div class="pagetitle">
    <h1>MIS MEMORANDUMS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Inicio</a></li>
        <li class="breadcrumb-item active">Memorandums</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Mis Memorandums</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                @if(count($memorandums)>0)
                <table class="table table-hover table-bordered table-sm" id="datos">
                    <thead>
                      <tr>
                        <th class="text-center">Tipo Memorandum</th>
                        <th class="text-center">Fecha Registro</th>
                        <th class="text-center">Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($memorandums as $memo)
                        <tr>
                            <td class="text-center">{{$memo->tipo_memorandum->descripcion}}</td>
                            <td class="text-center">{{ date('d/m/Y',strtotime($memo->fecha_emision)) }}</td>
                            <td class="text-center"><a href="{{ route('memorandums.show', $memo->id) }}" class="btn btn-success btn-sm" target="_blank">Ver Memorandum</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <h3>
                    NO TIENE MEMORANDUMS ASIGNADOS.
                  </h3>
                @endif
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection