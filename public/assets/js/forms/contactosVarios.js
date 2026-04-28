window.reglasTelefonos = {
    BO: { nombre: "BO", codigo: "+591", longitud: 8, inicio: /^[67]/, inicioTxt: "6 o 7", validarInicio: true },
    PE: { nombre: "PE", codigo: "+51", longitud: 9, inicio: /^9/, inicioTxt: "9", validarInicio: true },
    AR: { nombre: "AR", codigo: "+54", longitud: 10, validarInicio: false },
    BR: { nombre: "BR", codigo: "+55", longitud: 11, validarInicio: false },
    PY: { nombre: "PY", codigo: "+595", longitud: 9, inicio: /^9/, inicioTxt: "9", validarInicio: true }
};

function crearTelefono(valor = '') {
    const div = document.createElement('div');
    div.classList.add('telefono-item', 'mb-2');

    div.innerHTML = `
        <div class="d-flex gap-2 align-items-start">
            <select class="form-select codigo-pais" style="max-width:110px">
                ${Object.entries(reglasTelefonos).map(([key, r]) =>
                    `<option data-pais="${key}">${r.nombre} ${r.codigo}</option>`
                ).join('')}
            </select>
            <div class="flex-grow-1">
                <input type="text" name="telefonos[]" class="form-control telefono-input" value="${valor}" autocomplete="off">
                <div class="mensaje-validacion"></div>
            </div>

            <div class="btn-container d-flex gap-1"></div>
        </div>
    `;

    return div;
}
function crearDireccion(valor = '') {
    const div = document.createElement('div');
    div.classList.add('direccion-item', 'mb-2');

    div.innerHTML = `
        <div class="d-flex gap-2 align-items-start">
            <div class="flex-grow-1">
                <input type="text" name="direcciones[]" class="form-control direccion-input"
                    value="${valor}" placeholder="EJ. AVENIDA SIEMPRE VIVA 117"
                    onkeyup="this.value = this.value.toUpperCase();">
                <div class="mensaje-validacion"></div>
            </div>
            <div class="btn-container d-flex gap-1"></div>
        </div>
    `;

    return div;
}
window.agregarTelefonoInput = function(valor = '') {
    document.getElementById('telefonos-container').appendChild(crearTelefono(valor));
    actualizarBotonesTelefonos();
};

window.agregarDireccionInput = function(valor = '') {
    document.getElementById('direcciones-container').appendChild(crearDireccion(valor));
    actualizarBotonesDirecciones();
};

window.limpiarFormularioCliente = function () {
    document.getElementById('formCliente').reset();
    document.getElementById('telefonos-container').innerHTML = '';
    document.getElementById('direcciones-container').innerHTML = '';
    agregarTelefonoInput();
    agregarDireccionInput();
};

window.limpiarFormularioProveedor = function () {
    document.getElementById('formProveedor').reset();
    document.getElementById('telefonos-container').innerHTML = '';
    document.getElementById('direcciones-container').innerHTML = '';
    agregarTelefonoInput();
    agregarDireccionInput();
};

function limpiarError(input) {
    input.classList.remove("is-invalid");
    input.parentNode.querySelectorAll(".invalid-feedback, .text-success").forEach(e => e.remove());
}

function mostrarError(input, mensaje) {
    limpiarError(input);
    input.classList.add("is-invalid");

    const div = document.createElement("div");
    div.classList.add("invalid-feedback", "d-block");
    div.innerText = mensaje;

    input.parentNode.appendChild(div);
}

function mostrarOk(input, mensaje) {
    limpiarError(input);

    const div = document.createElement("div");
    div.classList.add("text-success", "small");
    div.innerText = mensaje;

    input.parentNode.appendChild(div);
}

function actualizarPrefijoTelefono(item) {
    const select = item.querySelector('.codigo-pais');
    const input = item.querySelector('.telefono-input');

    const pais = select.selectedOptions[0].dataset.pais;
    const codigo = window.reglasTelefonos[pais].codigo;

    let numero = input.value.replace(/^\+\d+\s?/, '');
    input.value = codigo + ' ' + numero;
}
document.addEventListener("change", function(e) {
    if (e.target.classList.contains("codigo-pais")) {
        actualizarPrefijoTelefono(e.target.closest(".telefono-item"));
    }
});

document.addEventListener("input", function(e) {

    if (e.target.classList.contains("telefono-input")) {

        const item = e.target.closest(".telefono-item");
        const select = item.querySelector(".codigo-pais");

        const pais = select.selectedOptions[0].dataset.pais;
        const codigo = window.reglasTelefonos[pais].codigo;

        if (!e.target.value.startsWith(codigo)) {
            let soloNumero = e.target.value.replace(/^\+\d+\s?/, '');
            e.target.value = codigo + ' ' + soloNumero;
        }
    }
});

function validarTelefono(input, pais) {

    let r = window.reglasTelefonos[pais];

    let v = input.value.replace(/^\+\d+\s?/, '').trim();

    if (!v) {
        limpiarError(input);
        return false;
    }

    if (!/^\d+$/.test(v)) {
        mostrarError(input, "Solo se permiten números");
        return false;
    }

    if (r.validarInicio && !r.inicio.test(v)) {
        mostrarError(input, `Para ${r.nombre}: debe iniciar con ${r.inicioTxt}`);
        return false;
    }

    if (v.length !== r.longitud) {
        mostrarError(input, `Para ${r.nombre}: debe tener ${r.longitud} dígitos`);
        return false;
    }

    mostrarOk(input, `✔ Teléfono válido (${r.nombre})`);
    return true;
}

function validarEmail(input) {
    let v = input.value.trim();

    if (!v) return limpiarError(input);

    if (!v.includes("@"))
        return mostrarError(input, "Falta el símbolo @");

    let [user, domain] = v.split("@");

    if (!user) return mostrarError(input, "Falta usuario antes del @");
    if (!domain) return mostrarError(input, "Falta dominio después del @");
    if (!domain.includes(".")) return mostrarError(input, "Falta el dominio");

    mostrarOk(input, "✔ Correo válido");
}

function validarNIT(input) {
    let v = input.value.trim();

    if (!v) return limpiarError(input);

    if (!/^\d+$/.test(v))
        return mostrarError(input, "Solo números");

    if (v.length < 5)
        return mostrarError(input, "Nro de Documento no válido");

    mostrarOk(input, "✔ Válido");
}
document.addEventListener("input", function(e) {

    if (e.target.classList.contains("telefono-input")) {

        const item = e.target.closest(".telefono-item");
        const pais = item.querySelector(".codigo-pais").selectedOptions[0].dataset.pais;

        validarTelefono(e.target, pais);
    }

    if (e.target.classList.contains("validar-email"))
        validarEmail(e.target);

    if (e.target.classList.contains("validar-nit"))
        validarNIT(e.target);

    if (e.target.classList.contains("direccion-input")) {
        if (e.target.value.trim().length < 5)
            mostrarError(e.target, "Dirección muy corta");
        else
            mostrarOk(e.target, "✔ Dirección válida");
    }
});
function actualizarBotonesTelefonos() {
    const items = document.querySelectorAll('#telefonos-container .telefono-item');

    items.forEach((item, index) => {
        const btnContainer = item.querySelector('.btn-container');
        btnContainer.innerHTML = '';

        if (index === items.length - 1) {
            btnContainer.innerHTML = items.length === 1
                ? `<button type="button" class="btn btn-primary btn-add-telefono"><i class="bi bi-plus"></i></button>`
                : `
                    <button type="button" class="btn btn-primary btn-add-telefono"><i class="bi bi-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-remove-telefono"><i class="bi bi-trash-fill"></i></button>
                `;
        }
    });
}

function actualizarBotonesDirecciones() {
    const items = document.querySelectorAll('#direcciones-container .direccion-item');

    items.forEach((item, index) => {
        const btnContainer = item.querySelector('.btn-container');
        btnContainer.innerHTML = '';

        if (index === items.length - 1) {
            btnContainer.innerHTML = items.length === 1
                ? `<button type="button" class="btn btn-primary btn-add-direccion"><i class="bi bi-plus"></i></button>`
                : `
                    <button type="button" class="btn btn-primary btn-add-direccion"><i class="bi bi-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-remove-direccion"><i class="bi bi-trash-fill"></i></button>
                `;
        }
    });
}

document.addEventListener("click", function(e) {

    if (e.target.closest('.btn-add-telefono')) {
        const container = document.getElementById('telefonos-container');
        const last = container.lastElementChild;
        const input = last.querySelector('.telefono-input');

        if (!input.value.trim()) {
            mostrarError(input, "Debe ingresar un número");
            return;
        }

        agregarTelefonoInput();
    }

    if (e.target.closest('.btn-remove-telefono')) {
        e.target.closest('.telefono-item').remove();
        actualizarBotonesTelefonos();
    }

    if (e.target.closest('.btn-add-direccion')) {
        const container = document.getElementById('direcciones-container');
        const last = container.lastElementChild;
        const input = last.querySelector('.direccion-input');

        if (!input.value.trim()) {
            mostrarError(input, "Debe ingresar una dirección");
            return;
        }

        if (input.value.trim().length < 5) {
            mostrarError(input, "Dirección muy corta");
            return;
        }

        agregarDireccionInput();
    }

    if (e.target.closest('.btn-remove-direccion')) {
        e.target.closest('.direccion-item').remove();
        actualizarBotonesDirecciones();
    }
});