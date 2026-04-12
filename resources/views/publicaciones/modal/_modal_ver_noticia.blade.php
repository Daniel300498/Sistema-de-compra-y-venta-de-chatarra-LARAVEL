<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="background-color: rgba(199, 195, 195, 0.929); border-radius: 10px;">
            <div class="modal-header">
                <div class="modal-footer justify-content-center">
                    <div class="btn-group" role="group" aria-label="Tipos de Documentos">
                        @foreach($noticiasFiltradas as $tipo => $noticiasPorTipo)
                            <button type="button" class="btn btn-primary back-color-second" data-bs-target="#newsCarousel" data-bs-slide-to="{{ $loop->index }}">{{ $tipo }}</button>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #ff0000; font-size: 2.5rem; opacity: 1;"></button>
            </div>
            <div class="modal-body">
                <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($noticiasFiltradas as $tipo => $noticiasPorTipo)
                            <div class="carousel-item @if($loop->first) active @endif">
                                @foreach(array_chunk($noticiasPorTipo->all(), 2) as $chunk)
                                    <div class="row">
                                        @foreach($chunk as $noticia)
                                            <div class="col-md-12">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">{{ $noticia->titulo }}</h5>
                                                        <div class="card-body">
                                                            <p class="card-text small"><strong>Descripci&oacute;n:</strong> {{ $noticia->descripcion }}</p>
                                                            <p class="card-text small"><strong>Fecha de Publicaci&oacute;n:</strong> {{ date('d-m-Y', strtotime($noticia->fecha_publicacion)) }}</p>
                                                            <p class="card-text small"><strong>Fecha de Caducidad:</strong> {{ date('d-m-Y', strtotime($noticia->fecha_caducidad)) }}</p>
                                                            <p class="card-text">
                                                                <a href="{{ asset('publicaciones/' . $noticia->documento) }}" target="_blank" class="btn btn-primary">Ver Documento</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('assets/js/forms/mostrarPublicaciones.js') }}" type="text/javascript"></script>
@endsection
