
<div id="formacionTable" style="display: none;"> 
    <section class="section">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Agregar Formación</h5>
                <form action="{{ route('academico.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="formacion">
                    <div class="form-group">
                        <label for="descripcion">Nombre:<span class="text-danger">*</span></label>
                        <input required id="descripcion"  type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name= "descripcion" value="{{ old('descripcion', isset($parametros) ? $parametros->descripcion : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                        @error('descripcion')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button> 
                </form>
              </div>
            </div>
          </div>
   
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Formaciones Registradas</h5>
                <div class="container mt-3">
                   <p class="mb-0">Puede modificar y eliminar una formación desde el menú de <strong>Opciones</strong>.</p>
                   <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla la formación que corresponda.</p>
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Formaciones</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formacion as $f)
                            <tr>
                                <td class="text-center">
                                    <small>{{$f->descripcion}}</small>
                                </td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                              Opciones
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('academico.edit')
                                                <li><a class="dropdown-item" href="{{route('academico.edit',$f->uuid)}}">Modificar Descripción</a></li>
                                                @endcan
                                                @can('academico.destroy')
                                                <li><a class="dropdown-item" href="{{ route('academico.destroy',$f->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar en registro?');">Eliminar</a></li>
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
            </div>
          </div>
        </div>
    </section>
    