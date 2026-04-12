@extends('layouts.app')

@section('titulo','Tiempo De Descanso')

@section('content')

<div class="pagetitle">
    <h1>TIEMPO DESCANSO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tiempo_descanso.index') }}">Tiempo Descanso</a></li>
        <li class="breadcrumb-item active">Ver Todos</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Tiempo Descanso Registrados</h5>
          </div>
          <p>Desde esta secci&oacute;n puede modificar y eliminar el tiempo de descanso correspondiente
            @if(count($tiempo_descanso) > 0)
            , se accede a estas opciones desde el bot&oacute;n <strong>Opciones</strong>.
            @endif
          </p>
            
        
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Hora Inicial</th>
                  <th class="text-center">Hora Final</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tiempo_descanso as  $key=>$tiempo)
                  <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    
                    <td class="text-center">
                        {{ $tiempo->nombre  }}
                    
                    </td>
                    <td class="text-center">
                      {{ $tiempo->hora_inicial  }}
                       
                    
                    </td>
                    <td class="text-center">
                      {{ $tiempo->hora_final  }}
                    </td>
                    <td class="text-center">
                      @can('tiempo_descanso.edit')
                        <a href="{{route('tiempo_descanso.edit',$tiempo->id )}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                      @endcan
                      @can('tiempo_descanso.destroy')
                        <a class="btn btn-danger" href="{{ route('tiempo_descanso.destroy',$tiempo->id) }}" onclick="return confirm('¿Está seguro que desea eliminar el registro?');"><i class="bi bi-trash"></i></a>
                      @endcan
                    </td>
                   
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
            <br><br>
          </div>
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

<script>
  
</script>