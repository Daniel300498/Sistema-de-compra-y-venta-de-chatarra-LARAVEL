<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title">Historial de Contratos</h5>
                    </div>
                    @if($contratos_lista && $contratos_lista->count() > 0)
                        <p>Si necesita realizar una corrección del registro previamente ingresado, puede utilizar la opción "Modificar datos" y volver a ingresarlo.</p>
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha de Inicio</th>
                                    <th class="text-center">Fecha de Finalización</th>
                                    <th class="text-center">Nro de Contrato</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contratos_lista as $document)
                                    <tr>
                                        <td class="text-center">{{ $document->fecha_ini }}</td>
                                        <td class="text-center">{{ $document->fecha_fin }}</td>
                                        <td class="text-center">{{ $document->nro_contrato }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @can('contratos.edit')
                                                    <li><a class="dropdown-item" target="_blank" href="{{ asset('contratos/' . $document->documento) }}">Ver Contrato</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('contratos.edit', $document->uuid) }}">Modificar Contrato</a></li>
                                                    @endcan
                                                    @can('contratos.destroy')
                                                    <li>
                                                        <form action="{{ route('contratos.destroy', $document->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar el contrato?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">Eliminar Contrato</button>
                                                        </form>
                                                    </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No hay contratos disponibles en este momento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
