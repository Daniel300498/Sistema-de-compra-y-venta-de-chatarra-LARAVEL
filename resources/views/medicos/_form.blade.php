<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda ver y administrar la información que corresponda</p>

<h5>I. DATOS PERSONALES</h5>

@include('medicos.secciones.datos_personales')

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="background-color: var(--second); border-color:var(--second);">{{ $texto }}</button>
        <a href="{{ route('medicos.index') }}" class="btn btn-danger" style="background-color: var(--first); border-color:var(--first);">Cancelar</a>
    </div>
</div>