<div class="modal fade" id="AsignarItemModal" tabindex="-1" aria-labelledby="AsignarItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('cargoEmpleados.store_asignar', ['empleado' => $empleado->id, 'cargo' => $cargo->id]) }}">                   
                 @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="AsignarItemModalLabel">Liberar Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label><span class="text-danger">(*)</span>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
                    <input type="hidden" name="cargo_id" value="{{ $cargo->id }}">                           
                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Está seguro que desea asignar el cargo al empleado solicitado?');">Asignar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
         </div>
    </div>
</div>
