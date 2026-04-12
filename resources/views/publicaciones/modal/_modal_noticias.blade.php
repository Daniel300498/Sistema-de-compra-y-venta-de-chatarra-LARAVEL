<div class="modal fade" id="modalNoticia{{ $noticia->uuid }}" tabindex="-1" aria-labelledby="modalNoticiaLabel{{ $noticia->uuid }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNoticiaLabel{{ $noticia->uuid }}">{{ $noticia->titulo }}</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Fecha de Publicaci&oacute;n:</strong> {{ date('d-m-Y', strtotime($noticia->fecha_publicacion))}}</p>
                <p><strong>Descripci&oacute;n:</strong> {{ $noticia->descripcion }}</p>
                <p><a href="{{ asset('publicaciones/' . $noticia->documento)}}" target="_blank" class="btn btn-primary">Ver Documento</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>