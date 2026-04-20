
let telefonoIndex = 1;
function addTelefono() {
    telefonoIndex++;
    const container = document.getElementById('telefonos-container');
    const items = container.querySelectorAll('.telefono-item');

    if (items.length > 0) {
        const lastBtnContainer = items[items.length - 1].querySelector('.col-md-2');

        lastBtnContainer.innerHTML = `
            <button type="button" class="btn btn-danger" onclick="removeTelefono(this)">
                🗑️
            </button>
        `;
    }

    const div = document.createElement('div');
    div.classList.add('row', 'mb-2', 'telefono-item');

    div.innerHTML = `
        <div class="col-md-10">
            <input type="text" name="telefonos[]" class="form-control" placeholder="Teléfono ${telefonoIndex}">
        </div>

        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-success" onclick="addTelefono()">
                +
            </button>
        </div>
    `;

    container.appendChild(div);
}

function removeTelefono(btn) {
    const container = document.getElementById('telefonos-container');

    btn.closest('.telefono-item').remove();
    const items = container.querySelectorAll('.telefono-item');

    if (items.length > 0) {
        const lastBtnContainer = items[items.length - 1].querySelector('.col-md-2');
        lastBtnContainer.innerHTML = `
            <button type="button" class="btn btn-success" onclick="addTelefono()">
                +
            </button>
        `;
    }
    telefonoIndex--;
}
// direcciones
let direccionIndex = 1;
function addDireccion() {
    direccionIndex++;

    const container = document.getElementById('direcciones-container');
    const items = container.querySelectorAll('.direccion-item');
    if (items.length > 0) {
        const lastBtnContainer = items[items.length - 1].querySelector('.col-md-2');

        lastBtnContainer.innerHTML = `
            <button type="button" class="btn btn-danger" onclick="removeDireccion(this)">
                🗑️
            </button>
        `;
    }


    const div = document.createElement('div');
    div.classList.add('row', 'mb-2', 'direccion-item');

    div.innerHTML = `
        <div class="col-md-10">
            <input type="text" name="direcciones[]" class="form-control" placeholder="Dirección ${direccionIndex}">
        </div>

        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-success" onclick="addDireccion()">
                +
            </button>
        </div>
    `;
    container.appendChild(div);
}

function removeDireccion(btn) {
    const container = document.getElementById('direcciones-container');
    btn.closest('.direccion-item').remove();
    const items = container.querySelectorAll('.direccion-item');
    if (items.length > 0) {
        const lastBtnContainer = items[items.length - 1].querySelector('.col-md-2');
        lastBtnContainer.innerHTML = `
            <button type="button" class="btn btn-success" onclick="addDireccion()">
                +
            </button>
        `;
    }   
    direccionIndex--;
}