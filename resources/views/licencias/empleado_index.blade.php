@extends('layouts.app')
@section('titulo','Licencias')
@section('content')


<div class="pagetitle">
    <h1>Licencias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Licencias</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if($empleado_id != null) 
            <h3 class="card-title">Historial Solicitudes</h3>
                <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Numero de dias</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($empleado->licencia as $licencia) 
                            <tr>
                                <td>{{$empleado->nombres}} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</td>
                                <td class="text-center">{{$licencia->tipo->descripcion}} </td>
                                <td class="text-center">{{ $licencia->numero_dias}}</td>
                                <td class="text-center">{{$licencia->motivo}}</td>

                                @if ($licencia->estado->descripcion == "PENDIENTE")
                                <td class="text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$licencia->estado->descripcion}}</button>
                                </td>
                                @else
                                    @if ($licencia->estado->descripcion == "DENEGADO")
                                    <td class="text-center">
                                    <button type="button" class="btn btn-danger">{{$licencia->estado->descripcion}}</button>
                                    </td>
                                    @else
                                    <td class="text-center">
                                    <button type="button" class="btn btn-success">{{$licencia->estado->descripcion}}</button>
                                    </td>
                                    @endif
                                    @endif


                                    <td class="d-flex justify-content-center" >
                                        @if ($licencia->estado->descripcion != "DENEGADO")
                                            @can('licencias.show')
                                            <a href="{{route('licencias.show',$licencia->id)}}" class="btn btn-info" title="Ver ficha" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                            @endcan
                                            @if ($licencia->estado->descripcion != "ACEPTADO")
                                            @can('licencias.upload')
                                            <a href="{{route('licencias.ficha',$licencia)}}" class="btn btn-success" title="Subir licencia firmada"><i class="bi bi-vector-pen"></i></a>
                                            @endcan
                                            @endif 
                                        @endif
                                        
                                        @if ($licencia->estado->descripcion == "PENDIENTE")
                                        @can('licencias.edit')
                                            <a href="{{route('licencias.edit',[$empleado, $licencia])}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                        @endcan
                                        @endif  


                                        @if ($licencia->estado->descripcion == "PENDIENTE")
                                        @can('licencias.destroy')
                                            <a class="btn btn-warning" title="Eliminar Licencia"><i class="bi bi-trash" onclick="eliminar({{$licencia->id}})"></i></a>
                                        @endcan
                                        @endif  



                                    </td>              
                            </tr>
                            @endforeach
                                
                        </tbody>
                </table>


                </div>
            @else
                <br>
                <h2>Esta es la vista del empleado</h2>
                <br>
            @endif
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>


var adminUrl=url_global;
  var btnSave = $('.btnSave');
  var btnUpdate = $('.btnUpdate');
  var csrf = $('input[name="_token"]').val();
  var editar=$('#can_edit').val();
  var editar_jefe=$('#can_edit_jefe').val();
  var editar_rrhh=$('#can_edit_rrhh').val();
  var destroy=$('#can_destroy').val();
  var show=$('#can_show').val();
  var upload=$('#can_upload').val();
  var empleado_id=$('#empleado_id').val();
  $.ajaxSetup({
      headers: {'X-CSRF-Token': csrf}
  });
  
      function eliminar(id){
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la licencias ya no se contara en planilla",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI',
          cancelButtonText:'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  method: 'DELETE',
                  url: adminUrl + '/licencia/'+id+'/destroy',
                  dataType: 'JSON',
                  success: function (){ 
                      Swal.fire({
                          title: "Eliminado!",
                          text: "El registro fue eliminado correctamente.",
                          icon: "success"
                      });
                      getRecords();
                  }
              })
          }
        });
  }
</script>
@endsection

