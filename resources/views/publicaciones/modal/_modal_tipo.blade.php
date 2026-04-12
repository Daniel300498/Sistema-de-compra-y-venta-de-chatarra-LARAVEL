<div class="modal fade" id="tipoPub" tabindex="-1" aria-labelledby="tipoPubLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #784212;">
                <h5 class="modal-title" id="tipoPubLabel">Agregar Nuevo Tipo de Publicaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeTipo" role="form">
                @csrf 
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Tipo de Publicaci&oacute;n</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" id="descripcion2" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
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
