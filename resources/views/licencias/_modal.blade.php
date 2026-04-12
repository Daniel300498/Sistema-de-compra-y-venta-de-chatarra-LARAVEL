
<div class="modal fade" id="estadoModal_{{ $licencia->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title justiy-content-center"></h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @can('licencias.update')
            <form id="the-form"  method="POST">
            @method('PUT')
            @csrf
            <div class="modal-body">
                <h4 class="text-center mb-3">Acepta o Rechaza <br>Solicitud de Licencia</h4>
                <input id="estado" name="estado" type="hidden"  value="pendiente">
                            
                <div class="form-group row mb-3">
                    <label for="fecha_aprobacion" class="col-md-5 text-right">Fecha Aprobación/Rechazo <span class="text-danger">(*)</span></label>
                    <div class="col-md-7">
                        <input type="date" style="text-align: center" name="fecha_aprobacion" id="fecha_aprobacion" class="form-control {{ $errors->has('fecha_aprobacion') ? ' error' : '' }}" required>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="Observación" class="col-md-5 text-right">Observación </label>
                    <div class="col-md-7">
                        <input id="observacion" name="observacion" style="text-align: center" type="text" class="form-control {{ $errors->has('observacion') ? ' error' : '' }}" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                        @if ($errors->has('observacion'))                                                                                                        
                            <span class="text-danger">
                                {{ $errors->first('observacion') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @can('licencias.show')
                @if($licencia->documento_respaldo!= null)
                <div class="form-group row text-center">
                    <h6>Documento de restaldo</h6>
                    <embed src="{{ asset('licencias/'.$licencia->documento_respaldo) }}" type="application/pdf" width="150px" height="200px">
                </div>
                @else
                <div class="form-group row text-center">
                    <h4>Este usuario no adjunto ningun comprobante.</h4>
                </div>
                @endif
            @endcan
            <div class="modal-footer justify-content-center">
                <button type="submit" id="the-submit" class="btn btn-primary" formaction="{{route('licencias.update',[$licencia->id, $estado_aceptado->id])}}">Aceptar</button>
                <button type="submit" id="the-submit" class="btn btn-danger" formaction="{{route('licencias.update',[$licencia->id, $estado_denegado->id])}}">Denegar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </form>
        @endcan
      </div>
    </div>
  </div>