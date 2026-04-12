<!-- Modal principal para la noticia -->
<div class="modal fade" id="noticiaModal{{ $noticia->uuid }}" tabindex="-1" aria-labelledby="noticiaModalLabel{{ $noticia->uuid }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticiaModalLabel{{ $noticia->uuid }}">{{ $noticia->titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo de Noticia:</strong> {{ $noticia->tipo }}</p>
                <p>{{ $noticia->descripcion }}</p>
                <p><strong>Fecha de Publicación:</strong> {{ date('d-m-Y', strtotime($noticia->fecha_publicacion)) }}</p>
                <p><strong>Fecha de Caducidad:</strong> {{ date('d-m-Y', strtotime($noticia->fecha_caducidad)) }}</p>
                <p><a href="{{ asset('publicaciones/' . $noticia->documento)}}" target="_blank" class="btn btn-secondary">Ver Documento</a></p>
            </div>
            <div class="modal-footer">
            <form action="{{ route('publicacion.aprobar', $noticia->uuid) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary" name="estado" value="1" onclick="return confirm('¿Está seguro que desea aprobar?');">Aprobar</button>
            </form>
            <form action="{{ route('publicacion.aprobar', $noticia->uuid) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="estado" value="0">
                <input type="hidden" name="motivo" value="Anulado">
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea rechazar la publicación?');">Rechazar</button>
            </form>

            </div>
        </div>
    </div>
</div>


