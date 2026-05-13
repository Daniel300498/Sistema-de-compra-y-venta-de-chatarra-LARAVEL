@extends('layouts.app')
@section('titulo', 'Bancos y Cuentas Bancarias')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>BANCOS Y CUENTAS BANCARIAS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Bancos</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalBanco" onclick="resetModalBanco()">
                <i class="bi bi-plus-lg"></i> Nuevo Banco
            </button>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalCuenta" onclick="resetModalCuenta()">
                <i class="bi bi-plus-lg"></i> Nueva Cuenta
            </button>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">

        {{-- ===== BANCOS ===== --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bancos Registrados</h5>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Administra los bancos y sus cuentas bancarias asociadas a la empresa, proveedores u operadores de transporte.
                        Las cuentas registradas aquí se usan para registrar los pagos realizados y recibidos en el sistema.
                    </p>
                    @if($bancos->isEmpty())
                        <div class="alert alert-info py-2">
                            <small><i class="bi bi-info-circle"></i> No hay bancos registrados.</small>
                        </div>
                    @else
                    <div class="list-group list-group-flush">
                        @foreach($bancos as $banco)
                        <div class="list-group-item px-0 py-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ $banco->nombre }}</strong>
                                    <span class="badge bg-secondary ms-1">{{ $banco->pais }}</span>
                                    @if($banco->codigo_swift)
                                        <small class="text-muted ms-1">SWIFT: {{ $banco->codigo_swift }}</small>
                                    @endif
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-credit-card"></i> {{ $banco->cuentas_count }} cuenta(s)
                                    </small>
                                </div>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-secondary"
                                        onclick="editarBanco('{{ $banco->uuid }}', '{{ addslashes($banco->nombre) }}', '{{ addslashes($banco->pais) }}', '{{ $banco->codigo_swift }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('bancos.destroy', $banco->uuid) }}"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar el banco {{ $banco->nombre }}?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== CUENTAS BANCARIAS ===== --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cuentas Bancarias</h5>
                    @php
                        $cuentas = \App\Models\CuentaBancaria::with(['banco', 'titular'])
                            ->whereNull('deleted_at')
                            ->orderBy('tipo_titular')
                            ->orderBy('alias')
                            ->get();
                    @endphp
                    @if($cuentas->isEmpty())
                        <div class="alert alert-info py-2">
                            <small><i class="bi bi-info-circle"></i> No hay cuentas registradas.</small>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table id="tabla_cuentas" class="table table-hover table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Banco</th>
                                    <th>Titular</th>
                                    <th>Tipo</th>
                                    <th>N° Cuenta</th>
                                    <th>Moneda</th>
                                    <th>Alias</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuentas as $cuenta)
                                @php
                                    $tipoColor = ['empleado' => 'secondary', 'cliente' => 'success', 'proveedor' => 'primary', 'operador' => 'info text-dark'];
                                    $tipoIcon  = ['empleado' => 'bi-person-badge', 'cliente' => 'bi-people', 'proveedor' => 'bi-box-seam', 'operador' => 'bi-person-vcard'];
                                    $tipoLabel = ['empleado' => 'Empleado', 'cliente' => 'Cliente', 'proveedor' => 'Proveedor', 'operador' => 'Propietario/Conductor'];
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $cuenta->banco->nombre }}</strong>
                                        <small class="text-muted d-block">{{ $cuenta->banco->pais }}</small>
                                    </td>
                                    <td>{{ $cuenta->nombre_titular }}</td>
                                    <td>
                                        <span class="badge bg-{{ $tipoColor[$cuenta->tipo_titular] ?? 'secondary' }}">
                                            <i class="bi {{ $tipoIcon[$cuenta->tipo_titular] ?? 'bi-person' }}"></i>
                                            {{ $tipoLabel[$cuenta->tipo_titular] ?? ucfirst($cuenta->tipo_titular) }}
                                        </span>
                                    </td>
                                    <td><code>{{ $cuenta->numero_cuenta }}</code></td>
                                    <td><span class="badge bg-light text-dark border">{{ $cuenta->moneda }}</span></td>
                                    <td>{{ $cuenta->alias ?? '—' }}</td>
                                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary"
                                            onclick="editarCuenta(
                                                '{{ $cuenta->uuid }}',
                                                {{ $cuenta->banco_id }},
                                                '{{ $cuenta->tipo_titular }}',
                                                {{ $cuenta->titular_id ?? 'null' }},
                                                '{{ addslashes($cuenta->titular?->nombre_completo ?? $cuenta->titular?->nombre ?? '') }}',
                                                '{{ $cuenta->numero_cuenta }}',
                                                '{{ $cuenta->moneda }}',
                                                '{{ addslashes($cuenta->alias ?? '') }}',
                                                '{{ addslashes($cuenta->nombre_titular_cuenta ?? '') }}',
                                                '{{ addslashes($cuenta->tipo_relacion ?? '') }}'
                                            )" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="{{ route('bancos.cuenta.destroy', $cuenta->uuid) }}"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Eliminar esta cuenta bancaria?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== MODAL BANCO ===== --}}
<div class="modal fade" id="modalBanco" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-bank"></i> <span id="tituloBanco">Nuevo Banco</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formBanco" method="POST" action="{{ route('bancos.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodBanco" value="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre del Banco <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="nombre" id="banco_nombre" required maxlength="150"
                                placeholder="Ej: BANCO BISA" style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">País <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="pais" id="banco_pais" required>
                                <option value="">-- Seleccione --</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Brasil">Brasil</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Chile">Chile</option>
                                <option value="Perú">Perú</option>
                                <option value="Paraguay">Paraguay</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Código SWIFT</label>
                            <input type="text" class="form-control" name="codigo_swift" id="banco_swift" maxlength="20"
                                placeholder="Ej: BISABOLPX" style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnBanco">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL CUENTA BANCARIA ===== --}}
<div class="modal fade" id="modalCuenta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-credit-card"></i> <span id="tituloCuenta">Nueva Cuenta Bancaria</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCuenta" method="POST" action="{{ route('bancos.cuenta.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodCuenta" value="POST">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Banco <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="banco_id" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($bancos as $b)
                                    <option value="{{ $b->id }}">{{ $b->nombre }} ({{ $b->pais }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Moneda <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="moneda" required>
                                <option value="BOB">BOB — Boliviano</option>
                                <option value="USD">USD — Dólar</option>
                                <option value="BRL">BRL — Real brasileño</option>
                                <option value="EUR">EUR — Euro</option>
                                <option value="ARS">ARS — Peso argentino</option>
                                <option value="PEN">PEN — Sol peruano</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Titular <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_titular" id="tipo_titular" required
                                onchange="cambiarTitular(this.value)">
                                <option value="">-- Seleccione --</option>
                                <option value="empleado">Empleado de la empresa</option>
                                <option value="cliente">Cliente</option>
                                <option value="proveedor">Proveedor</option>
                                <option value="operador">Propietario / Conductor</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="sec_titular" style="display:none;">
                            <label class="form-label fw-semibold" id="lbl_titular">Titular</label>
                            <input type="hidden" name="titular_id" id="titular_id_hidden">
                            <input type="text" class="form-control" id="buscar_titular"
                                placeholder="Buscar por nombre..." autocomplete="off"
                                oninput="filtrarTitulares(this.value)">
                            <div id="lista_titulares" class="list-group mt-1" style="max-height:180px;overflow-y:auto;display:none;position:absolute;z-index:1000;width:calc(50% - 1.5rem);"></div>
                            <small class="text-muted" id="titular_seleccionado"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Número de Cuenta <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="numero_cuenta" required maxlength="100"
                                placeholder="Ej: 1234-5678-9012">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Alias / Descripción</label>
                            <input type="text" class="form-control" name="alias" maxlength="150"
                                placeholder="Ej: Cuenta principal USD">
                        </div>

                        {{-- Toggle titular diferente --}}
                        <div class="col-12" id="sec_toggle_titular" style="display:none;">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="toggle_titular_diferente" onchange="toggleTitularDiferente(this.checked)">
                                <label class="form-check-label" for="toggle_titular_diferente">
                                    La cuenta pertenece a otra persona (familiar, representante, etc.)
                                </label>
                            </div>
                        </div>

                        {{-- Nombre + relación: solo si el toggle está activo --}}
                        <div class="col-md-6" id="sec_nombre_titular_cuenta" style="display:none;">
                            <label class="form-label fw-semibold">Nombre del titular de la cuenta <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="nombre_titular_cuenta" id="inp_nombre_titular_cuenta" maxlength="150"
                                placeholder="Ej: María Pérez">
                        </div>

                        <div class="col-md-6" id="sec_tipo_relacion" style="display:none;">
                            <label class="form-label fw-semibold">Relación con el titular principal <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_relacion" id="sel_tipo_relacion">
                                <option value="">-- Seleccione --</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnCuenta"><i class="bi bi-save"></i> Registrar Cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
const proveedores = @json($proveedores->map(fn($p) => ['id' => $p->id, 'nombre' => $p->nombre]));
const operadores  = @json($operadores->map(fn($o) => ['id' => $o->id, 'nombre' => $o->nombre_completo]));
const empleados   = @json($empleados->map(fn($e) => ['id' => $e->id, 'nombre' => $e->apellido . ', ' . $e->nombre . ($e->cargo ? ' (' . $e->cargo . ')' : '')]));
const clientes    = @json($clientes->map(fn($c) => ['id' => $c->id, 'nombre' => $c->nombre]));

let listaTitularActual = [];

const relacionesPorTipo = {
    'proveedor': ['Gerente', 'Empleado', 'Representante legal', 'Socio'],
    'operador':  ['Esposa', 'Esposo', 'Hermana', 'Hermano', 'Madre', 'Padre', 'Familiar'],
    'empleado':  ['Esposa', 'Esposo', 'Hermana', 'Hermano', 'Madre', 'Padre', 'Familiar'],
    'cliente':   ['Gerente', 'Empleado', 'Representante legal', 'Socio', 'Familiar'],
};

function cambiarTitular(tipo) {
    const sec = document.getElementById('sec_titular');

    if (tipo === '') {
        sec.style.display = 'none';
        limpiarTitular();
        actualizarRelaciones('');
        return;
    }

    const listas = {
        'empleado':  { lista: empleados,   label: 'Empleado de la empresa' },
        'cliente':   { lista: clientes,    label: 'Cliente' },
        'proveedor': { lista: proveedores, label: 'Proveedor' },
        'operador':  { lista: operadores,  label: 'Propietario / Conductor' },
    };

    const { lista, label } = listas[tipo] ?? { lista: [], label: 'Titular' };
    document.getElementById('lbl_titular').textContent = label;
    listaTitularActual = lista;
    sec.style.display = 'block';
    limpiarTitular();
    actualizarRelaciones(tipo);
}

let _relacionesActuales = [];

function actualizarRelaciones(tipo) {
    const sel = document.getElementById('sel_tipo_relacion');
    sel.innerHTML = '<option value="">-- Seleccione --</option>';

    _relacionesActuales = relacionesPorTipo[tipo] || [];
    _relacionesActuales.forEach(r => {
        const opt = document.createElement('option');
        opt.value = r;
        opt.textContent = r;
        sel.appendChild(opt);
    });

    // Ocultar toggle y campos si cambia el tipo de titular
    document.getElementById('toggle_titular_diferente').checked = false;
    toggleTitularDiferente(false);

    // Mostrar el toggle solo si hay opciones de relación (es decir, hay titular real)
    const secToggle = document.getElementById('sec_toggle_titular');
    secToggle.style.display = _relacionesActuales.length ? 'block' : 'none';
}

function toggleTitularDiferente(activo) {
    const secNombre = document.getElementById('sec_nombre_titular_cuenta');
    const secRel    = document.getElementById('sec_tipo_relacion');
    const inp       = document.getElementById('inp_nombre_titular_cuenta');
    const sel       = document.getElementById('sel_tipo_relacion');

    if (activo) {
        secNombre.style.display = 'block';
        secRel.style.display    = 'block';
    } else {
        secNombre.style.display = 'none';
        secRel.style.display    = 'none';
        inp.value  = '';
        sel.value  = '';
    }
}

function limpiarTitular() {
    document.getElementById('titular_id_hidden').value = '';
    document.getElementById('buscar_titular').value = '';
    document.getElementById('titular_seleccionado').textContent = '';
    document.getElementById('lista_titulares').style.display = 'none';
}

function filtrarTitulares(q) {
    const lista = document.getElementById('lista_titulares');
    document.getElementById('titular_id_hidden').value = '';
    document.getElementById('titular_seleccionado').textContent = '';

    if (!q.trim()) { lista.style.display = 'none'; return; }

    const termino = q.toLowerCase();
    const resultados = listaTitularActual.filter(i => i.nombre.toLowerCase().includes(termino));

    lista.innerHTML = '';
    if (resultados.length === 0) {
        lista.innerHTML = '<div class="list-group-item text-muted small">Sin resultados</div>';
    } else {
        resultados.forEach(item => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'list-group-item list-group-item-action py-1 small';
            btn.textContent = item.nombre;
            btn.onclick = () => seleccionarTitular(item);
            lista.appendChild(btn);
        });
    }
    lista.style.display = 'block';
}

function seleccionarTitular(item) {
    document.getElementById('titular_id_hidden').value = item.id;
    document.getElementById('buscar_titular').value = item.nombre;
    document.getElementById('titular_seleccionado').textContent = '✓ Seleccionado';
    document.getElementById('lista_titulares').style.display = 'none';
}

document.addEventListener('click', function(e) {
    const lista = document.getElementById('lista_titulares');
    if (lista && !lista.contains(e.target) && e.target.id !== 'buscar_titular') {
        lista.style.display = 'none';
    }
});

function resetModalBanco() {
    document.getElementById('tituloBanco').textContent = 'Nuevo Banco';
    document.getElementById('btnBanco').textContent    = 'Registrar';
    document.getElementById('methodBanco').value       = 'POST';
    document.getElementById('formBanco').action        = '{{ route("bancos.store") }}';
    document.getElementById('banco_nombre').value      = '';
    document.getElementById('banco_pais').value        = '';
    document.getElementById('banco_swift').value       = '';
}

function resetModalCuenta() {
    document.getElementById('tituloCuenta').textContent  = 'Nueva Cuenta Bancaria';
    document.getElementById('btnCuenta').innerHTML       = '<i class="bi bi-save"></i> Registrar Cuenta';
    document.getElementById('methodCuenta').value        = 'POST';
    document.getElementById('formCuenta').action         = '{{ route("bancos.cuenta.store") }}';
    document.getElementById('tipo_titular').value        = '';
    document.getElementById('sec_titular').style.display = 'none';
    document.getElementById('sec_toggle_titular').style.display = 'none';
    document.getElementById('toggle_titular_diferente').checked  = false;
    toggleTitularDiferente(false);
    limpiarTitular();
    // Limpiar otros campos
    document.querySelectorAll('#formCuenta select:not(#tipo_titular):not(#sel_tipo_relacion)').forEach(s => s.selectedIndex = 0);
    document.querySelectorAll('#formCuenta input[type="text"]').forEach(i => { if (i.id !== 'buscar_titular') i.value = ''; });
}

function editarCuenta(uuid, bancoId, tipoTitular, titularId, titularNombre, numeroCuenta, moneda, alias, nombreTitularCuenta, tipoRelacion) {
    document.getElementById('tituloCuenta').textContent = 'Editar Cuenta Bancaria';
    document.getElementById('btnCuenta').innerHTML      = '<i class="bi bi-save"></i> Actualizar Cuenta';
    document.getElementById('methodCuenta').value       = 'PUT';
    document.getElementById('formCuenta').action        = '/bancos/cuentas/' + uuid;

    // Banco y moneda
    document.querySelector('#formCuenta select[name="banco_id"]').value = bancoId;
    document.querySelector('#formCuenta select[name="moneda"]').value   = moneda;
    document.querySelector('#formCuenta input[name="numero_cuenta"]').value = numeroCuenta;
    document.querySelector('#formCuenta input[name="alias"]').value     = alias;

    // Tipo titular → dispara cambiarTitular para poblar lista y relaciones
    const selTipo = document.getElementById('tipo_titular');
    selTipo.value = tipoTitular;
    cambiarTitular(tipoTitular);

    // Pre-seleccionar titular
    if (titularId && titularNombre) {
        document.getElementById('titular_id_hidden').value      = titularId;
        document.getElementById('buscar_titular').value         = titularNombre;
        document.getElementById('titular_seleccionado').textContent = '✓ Seleccionado';
    }

    // Titular diferente (nombre_titular_cuenta)
    if (nombreTitularCuenta) {
        document.getElementById('toggle_titular_diferente').checked = true;
        toggleTitularDiferente(true);
        document.getElementById('inp_nombre_titular_cuenta').value  = nombreTitularCuenta;
        document.getElementById('sel_tipo_relacion').value          = tipoRelacion;
    }

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCuenta')).show();
}

function editarBanco(uuid, nombre, pais, swift) {
    document.getElementById('tituloBanco').textContent = 'Editar Banco';
    document.getElementById('btnBanco').textContent    = 'Actualizar';
    document.getElementById('methodBanco').value       = 'PUT';
    document.getElementById('formBanco').action        = '/bancos/' + uuid;
    document.getElementById('banco_nombre').value      = nombre;
    document.getElementById('banco_pais').value        = pais;
    document.getElementById('banco_swift').value       = swift ?? '';
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalBanco')).show();
}
</script>
@endsection
