<div class="modal fade" id="liberarItemModal-{{ $ce->id }}" tabindex="-1" aria-labelledby="liberarItemModalLabel-{{ $ce->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cargoEmpleados.store_liberar', $ce->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="liberarItemModalLabel-{{ $ce->id }}">Liberar Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        {{ Form::label('tipo_baja', 'Tipo de Baja') }} <span class="text-danger">(*)</span>
                        <select required name="tipo_baja" id="tipo_baja_{{ $ce->id }}" class="form-control {{ $errors->has('tipo_baja') ? ' error' : '' }}">
                            <option value="">-- SELECCIONE --</option>
                            <option value="PROMOCION">PROMOCION</option>
                            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                            <option value="AGRADECIMIENTO DE SERVICIOS">AGRADECIMIENTO DE SERVICIOS</option> 
                            <option value="ACEPTACION DE RENUNCIA">ACEPTACION DE RENUNCIA</option>
                            <option value="RETIRO POR ABANDONO">RETIRO POR ABANDONO</option>
                            @if($ce->cargo->tipo_cargo == "PERSONAL EVENTUAL" || $ce->cargo->tipo_cargo == "CONSULTOR POR PROGRAMA" || $ce->cargo->tipo_cargo == "CONSULTOR INDIVIDUAL DE LINEA")
                            <option value="TERMINACION DE CONTRATO">TERMINACION DE CONTRATO </option>
                            @endif
                        </select>
                        @if ($errors->has('tipo_baja'))
                            <span class="text-danger">{{ $errors->first('tipo_baja') }}</span>
                        @endif
                    </div>
                
                    <div class="mb-3">
                        <label for="fecha_fin_{{ $ce->id }}" class="form-label">Fecha de Finalizacion</label><span class="text-danger">(*)</span>
                        <input type="date" class="form-control" id="fecha_fin_{{ $ce->id }}" name="fecha_fin" required>
                    </div>
                    <div class="mb-3" id="memorandum-container_{{ $ce->id }}" style="display: none;">
                        <label for="memorandum_{{ $ce->id }}" class="form-label">Adjuntar Memorandum</label><span class="text-danger">(*)</span>
                        <input type="file" class="form-control" id="memorandum_{{ $ce->id }}" name="memorandum">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Est&aacute; seguro que desea eliminar la relaci&oacute;n?');">Liberar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarMemo.js') }}" type="text/javascript"></script>
@endsection

