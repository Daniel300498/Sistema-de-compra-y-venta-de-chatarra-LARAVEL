<div class="modal fade" id="renovarModal{{ $noticia->uuid }}" tabindex="-1" aria-labelledby="renovarModalLabel{{ $noticia->uuid }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renovarModalLabel{{ $noticia->uuid }}">{{ $noticia->titulo }}</h5> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo de Noticia:</strong> {{ $noticia->tipo }}</p>
                <p><strong>Descripci&oacute;n:</strong></p>
                <p>{{ $noticia->descripcion }}</p>
                <p><strong>Fecha de Caducidad Actual:</strong> Caducado en fecha {{ $noticia->fecha_caducidad }}</p>
                <p><a href="{{ asset('publicaciones/' . $noticia->documento)}}" target="_blank" class="btn btn-secondary">Ver Documento</a></p>
                <hr>
                <form action="{{ route('publicacion.renovar', $noticia->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fecha_caducidad" class="form-label">Nueva Fecha de Caducidad:</label>
                            <input type="date" id="fecha_caducidad" name="fecha_caducidad" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Renovar Publicaci&oacute;n</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
