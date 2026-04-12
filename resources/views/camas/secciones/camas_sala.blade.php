<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Camas Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede editar o eliminar una cama.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la cama que corresponda.</p>
           <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
               <thead>
                   <tr>
                       <th class="text-center">N&uacute;mero de cama</th>
                       <th class="text-center">Estado</th>
                       <th class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($camas_depende as $a)
                   <tr>
                   <td class="text-center"><small>{{$a->numero}}</small></td>
                   <td class="text-center"><small>{{$a->estado}}</small></td>
                   <td class="d-flex justify-content-center" >
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opciones
                        </button>
                        <ul class="dropdown-menu">
                            @can('camas.edit')
                            <li><a class="dropdown-item" href="{{ route('camas.edit',$a->uuid) }}">Modificar Cama</a></li>
                            @endcan        
                            @can('camas.destroy')
                            <li><a class="dropdown-item" href="{{ route('camas.destroy',$a->uuid) }}" onclick="return confirm('¿Está seguro que desea eliminar la cama?');">Eliminar Cama</a></li>
                            @endcan
                        </ul>
                      </div>
                   </td>
                   </tr>
              @endforeach
               </tbody>
           </table>
           <!-- EndCONTENIDO Example -->
        </div>
    </div>
</div>
</div>
</section>