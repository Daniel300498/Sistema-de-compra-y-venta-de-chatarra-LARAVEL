<div class="modal fade" id="institutos" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Agregar Nueva Institución de Formación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeInstituto" role="form">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Nombre de la institución</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" id="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>