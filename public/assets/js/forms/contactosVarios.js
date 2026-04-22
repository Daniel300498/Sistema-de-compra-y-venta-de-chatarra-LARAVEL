document.addEventListener('DOMContentLoaded', function () {
    const telContainer = document.getElementById('telefonos-container');
    const dirContainer = document.getElementById('direcciones-container');
    function crearTelefono(valor = '', isFirst = false) {
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2', 'telefono-item');
        div.innerHTML = `
            <input type="text" name="telefonos[]" class="form-control telefono-input"
                   value="${valor}" placeholder="Ej: 70123456">
            <button type="button" class="btn btn-danger btn-remove-telefono">
                <i class="bi bi-trash"></i>
            </button>
            <button type="button" class="btn btn-success btn-add-telefono">
                <i class="bi bi-plus-lg"></i>
            </button>`;
        if (isFirst) {
            div.querySelector('.btn-remove-telefono').style.display = 'none';
        }
        return div;
    }

    if (telContainer.children.length === 0) {
        telContainer.appendChild(crearTelefono('', true));
    }
    telContainer.addEventListener('click', function (e) {
        if (e.target.closest('.btn-add-telefono')) {
            const inputs = telContainer.querySelectorAll('.telefono-input');
            const last = inputs[inputs.length - 1];
            if (last.value.trim() === '') return alert('Completa el teléfono actual');
            telContainer.appendChild(crearTelefono());
        }

        if (e.target.closest('.btn-remove-telefono')) {
            if (telContainer.children.length === 1)
                return alert('Debe haber al menos un teléfono');
            e.target.closest('.telefono-item').remove();
        }
    });
    function crearDireccion(valor = '', isFirst = false) {
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2', 'direccion-item');
        div.innerHTML = `
            <input type="text" name="direcciones[]" class="form-control direccion-input"
                   value="${valor}" placeholder="Dirección">
            <button type="button" class="btn btn-danger btn-remove-direccion">
                <i class="bi bi-trash"></i>
            </button>
            <button type="button" class="btn btn-success btn-add-direccion">
                <i class="bi bi-plus-lg"></i>
            </button>`;
        if (isFirst) {
            div.querySelector('.btn-remove-direccion').style.display = 'none';
        }
        return div;
    }
    if (dirContainer.children.length === 0) {
        dirContainer.appendChild(crearDireccion('', true));
    }
    dirContainer.addEventListener('click', function (e) {
        if (e.target.closest('.btn-add-direccion')) {
            const inputs = dirContainer.querySelectorAll('.direccion-input');
            const last = inputs[inputs.length - 1];
            if (last.value.trim() === '') return alert('Completa la dirección actual');
            dirContainer.appendChild(crearDireccion());
        }
        if (e.target.closest('.btn-remove-direccion')) {
            if (dirContainer.children.length === 1)
                return alert('Debe haber al menos una dirección');
            e.target.closest('.direccion-item').remove();
        }
    });
    window.agregarTelefonoInput = (v = '', first = false) => telContainer.appendChild(crearTelefono(v, first));
    window.agregarDireccionInput = (v = '', first = false) => dirContainer.appendChild(crearDireccion(v, first));
});