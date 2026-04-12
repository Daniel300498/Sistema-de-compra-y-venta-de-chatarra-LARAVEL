<p>Debe rellenar todos los campos marcados con <span class="text-danger">(*)</span>. Al momento de registrar / editar una publicación, puede programar la publicación ingresando una fecha futura en el campo Fecha de Publicación.</p>
<form action="{{ route('publicacion.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="row"> 
        <div class="col-md-6">
            {{ Form::label('tipoPub', 'Tipo de Publicaci&oacute;n') }} <span class="text-danger">(*)</span>
            <div class="d-flex align-items-center justify-content-between">
                <select name="tipo" id="tipo" class="form-control {{ $errors->has('tipo') ? ' error' : '' }}">
                    <option value="">-- SELECCIONE --</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->descripcion }}" {{ old('tipo', isset($publicacion) ? $publicacion->tipo : '') == $tipo->descripcion ? 'selected' : '' }}>{{ $tipo->descripcion }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tipoPub" title="Agregar Tipo de Publicación">
                   <i class="bi bi-plus-lg"></i>
                </button>
                @if ($errors->has('tipo'))
                    <span class="text-danger">
                        {{ $errors->first('tipo') }}
                    </span>
                @endif
            </div> 

            <div class="form-group">
                <label for="documento">Documento @if(!$publicacion->documento)<span class="text-danger">(*)</span>@endif</label>
                <div class="input-group">
                    <input id="nombre" type="file" class="form-control {{ $errors->has('documento') ? ' error' : '' }}" name="documento" value="{{ old('documento', isset($publicacion) ? $publicacion->documento : '') }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    @if ($publicacion->documento)
                        <a href="{{ asset('publicaciones/' . $publicacion->documento) }}" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                    @endif
                </div>
                @if ($errors->has('documento'))
                    <span class="text-danger">
                        {{ $errors->first('documento') }}
                    </span>
                @endif
            </div>
                           
                <div class="form-group">
                @if(!$publicacion->fecha_publicacion)
                    <label for="fecha_publicacion">Fecha de Publicación <span class="text-danger">(*)</span></label>
                @endif
                <input id="fecha_publicacion" @if($publicacion->fecha_publicacion) type="hidden" @else type="date" @endif class="form-control {{ $errors->has('fecha_publicacion') ? ' error' : '' }}" name="fecha_publicacion" value="{{ old('fecha_publicacion', isset($publicacion) && $publicacion->fecha_publicacion ? $publicacion->fecha_publicacion : now()->format('Y-m-d')) }}">                
                @if ($errors->has('fecha_publicacion'))
                <span class="text-danger">
                    {{ $errors->first('fecha_publicacion') }}
                </span>
                @endif
            </div>

             <div class="form-group">
                <label for="fecha_caducidad">Fecha de Caducidad <span class="text-danger">(*)</span></label>
                <input id="fecha_caducidad" type="date" class="form-control {{ $errors->has('fecha_caducidad') ? ' error' : '' }}" name="fecha_caducidad" value="{{ old('fecha_caducidad', isset($publicacion) ? $publicacion->fecha_caducidad : now()->addDays(1)->format('Y-m-d')) }}">                
                @if ($errors->has('fecha_caducidad'))
                    <span class="text-danger">
                        {{ $errors->first('fecha_caducidad') }}
                    </span>
                @endif
            </div>

        </div>
   
        <div class="col-md-6">
            <div class="form-group">
                <label for="titulo">Título <span class="text-danger">(*)</span></label>
                <input id="titulo" type="text" class="form-control {{ $errors->has('titulo') ? ' error' : '' }}" name="titulo" value="{{ old('titulo', isset($publicacion) ? $publicacion->titulo : '') }}"   onkeyup="javascript:this.value=this.value.toUpperCase();">                
               
                @if ($errors->has('titulo'))
                <span class="text-danger">
                    {{ $errors->first('titulo') }}
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción <span class="text-danger">(*)</span></label>
                <textarea id="descripcion" rows="6" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion"  onkeydown="return soloLetras(event);">{{ old('descripcion', isset($publicacion) ? $publicacion->descripcion : '') }}</textarea>
                @if ($errors->has('descripcion'))
                <span class="text-danger">
                    {{ $errors->first('descripcion') }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col text-center">   
                @if (!$publicacion->estado)
                @can('publicacion.publicar')
                <button type="submit" class="btn btn-primary" name="estado" value="2">Publicar</button>
                @endcan
                @can('publicacion.create')
                <button type="submit" class="btn btn-secondary" name="estado" value="0">Guardar</button>
                @endcan
                @else
                <button type="submit" class="btn btn-primary" name="estado" value="2">Publicar</button>
                @endif
                <a href="{{ route('publicacion.index') }}" class="btn btn-danger">Salir</a>
            </form>
        </div>
    </div>
   
</form>
