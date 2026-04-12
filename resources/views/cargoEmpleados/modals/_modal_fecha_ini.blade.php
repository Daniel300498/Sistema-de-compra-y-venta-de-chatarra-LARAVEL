<div class="modal fade" id="editarfecha-{{ $ce->id }}" tabindex="-1" aria-labelledby="editarfechaLabel-{{ $ce->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cargoEmpleados.store_fecha', $ce->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    
                    <h5 class="modal-title" id="editarfechaLabel-{{ $ce->id }}">Editar Fecha Inicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
            
                    <div class="mb-3">
                        <label for="fecha_inicio_{{ $ce->id }}" class="form-label">Fecha de Inicio</label><span class="text-danger">(*)</span>
                        <input type="date" class="form-control" id="fecha_inicio_{{ $ce->id }}" name="fecha_inicio" value="{{ old('fecha_inicio', $ce->fecha_inicio) }}" required>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Está seguro que desea cambiar la fecha de inicio?');">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



