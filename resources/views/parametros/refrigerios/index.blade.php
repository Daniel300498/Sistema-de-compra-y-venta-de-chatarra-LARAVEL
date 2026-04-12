@extends('layouts.app')

@section('titulo','PLANILLA REFRIGERIO')

@section('content')

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <div class="d-flex align-items-center justify-content-between">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Planilla Refrigerio</li>
          </ol>
        </nav>
        @can('refrigerios.create')
            <a href="{{ route('refrigerios.create') }}" class="btn btn-primary">Agregar Información</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Información registrada por día para el refrigerio</h5>
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nobre Empleado</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">CI</th>
                            @for($i = 1; $i <= 31; $i++)
                            <th class="text-center">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    @php
                        $empleado='';
                    @endphp
                    <tbody>
                        @foreach ($funcionarios as $f)
                        <tr> 
                            <td>{{ $f->nombre }}</td>
                            <td>{{ $f->cargo }}</td>
                            <td>{{ $f->ci }}</td>
                            @for($i = 1; $i <= 31; $i++)
                            <td>
                                @foreach ($refrigerios as $r)
                                    @if($r->funcionario_id==$f->id)
                                        @if($r->dia == $i)
                                        {{ $r->tipo_dato }}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection