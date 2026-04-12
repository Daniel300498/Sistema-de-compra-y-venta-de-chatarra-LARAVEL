<div class="modal fade" id="nuevaCiudad" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Agregar Nueva Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeCiudad" role="form">
                <input type="hidden" id="areaIdModal">
                <input type="hidden" id="tipoCargoModal">
                <div class="modal-body">
                    <p>Debe seleccionar el departamento antes de ingresar una nueva ciudad.</p>
                    <div class="col-lg-12 mt-2">
                        <input type="hidden" id="nombre_depto">
                        <label for="provincia" class="col-control-label">Provincia</label>
                        <select name="provincia_id" id="provincia_id" class="form-control">
                            <option value="">-- SELECCIONE --</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="ciudad" class="col-control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_ciudad" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reset();">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/empleados/modals/_modal_ciudad.blade.php ENDPATH**/ ?>