<?php $__env->startSection('titulo','Cliente'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>GESTIÓN DE CLIENTES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </nav>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.create')): ?>
        <button type="button" class="btn btn-primary MB-3" data-bs-toggle="modal" data-bs-target="#modalCliente" onclick="resetModalCliente()"> <i class="bi bi-plus-lg"></i> Nuevo Cliente</button>
        <?php endif; ?>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="card-title mb-0">Clientes Registrados</h5>
                    </div>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-info-circle me-1"></i>Administra el directorio de clientes con quienes la empresa realiza operaciones de compra o venta de chatarra. Aquí puedes registrar sus datos de contacto, documentos de identificación y direcciones para facilitar la gestión comercial.
                    </p>
                    <div class="table-responsive">
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">NOMBRE</th>
                                    <th class="text-center">NIT / CI / RUC</th>
                                    <th class="text-center">PAÍS</th>
                                    <th class="text-center">TELÉFONOS</th>
                                    <th class="text-center">DIRECCIONES</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($c->nombre); ?></td>
                                    <td><?php echo e($c->nit); ?></td>
                                    <td><?php echo e($c->pais); ?></td>
                                    <td>
                                        <?php $__empty_1 = true; $__currentLoopData = $c->contacts->where('tipo','telefono'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="badge bg-primary"><?php echo e($contacto->valor); ?></span><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <span class="text-muted">Sin teléfonos</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php $__empty_1 = true; $__currentLoopData = $c->contacts->where('tipo','direccion'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="badge bg-secondary">Dir <?php echo e($index + 1); ?>: <?php echo e($contacto->valor); ?></span><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <span class="text-muted">Sin direcciones</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($c->email); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                            <ul class="dropdown-menu">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.edit')): ?>
                                                <li><a class="dropdown-item" href="#" onclick="editarCliente(<?php echo e($c); ?>)"><i class="bi bi-pencil"></i> Modificar</a></li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.destroy')): ?>
                                                <li><a class="dropdown-item text-danger" href="<?php echo e(route('clientes.destroy', $c->uuid)); ?>" onclick="return confirm('¿Eliminar este cliente?')"><i class="bi bi-trash"></i> Eliminar</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('clientes.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type ="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/contactosVarios.js')); ?>" type ="text/javascript"></script>

<script>

function resetModalCliente() {
    document.getElementById('tituloCliente').innerHTML ='<i class="bi bi-person-plus "></i> Nuevo Cliente';
    document.getElementById('btnCliente').innerText = 'Registrar';
    document.getElementById('methodCliente').value = 'POST';
    document.getElementById('formCliente').action = '<?php echo e(route("clientes.store")); ?>';
    limpiarFormularioCliente();
}
function editarCliente(cliente) {
    const baseUrl = "<?php echo e(url('/')); ?>";
    document.getElementById('tituloCliente').innerHTML = '<i class="bi bi-pencil-square"></i> Editar Cliente';
    document.getElementById('btnCliente').innerText = 'Actualizar';
    document.getElementById('methodCliente').value = 'PUT';
    document.getElementById('formCliente').action = baseUrl + '/clientes/' + cliente.id;
    document.getElementById('cli_nombre').value = cliente.nombre ?? '';
    document.getElementById('cli_nit').value = cliente.nit ?? '';
    document.getElementById('cli_pais').value = cliente.pais ?? '';
    document.getElementById('cli_email').value = cliente.email ?? '';
    const telContainer = document.getElementById('telefonos-container');
    const dirContainer = document.getElementById('direcciones-container');
    telContainer.innerHTML = '';
    dirContainer.innerHTML = '';
    let telefonos = cliente.contacts?.filter(c => c.tipo === 'telefono') ?? [];
    let direcciones = cliente.contacts?.filter(c => c.tipo === 'direccion') ?? [];

    if (telefonos.length === 0) {
        agregarTelefonoInput('', true);
    } else {
        telefonos.forEach((t, i) => agregarTelefonoInput(t.valor, i === 0));
    }

    if (direcciones.length === 0) {
        agregarDireccionInput('', true);
    } else {
        direcciones.forEach((d, i) => agregarDireccionInput(d.valor, i === 0));
    }
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCliente')).show();
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/index.blade.php ENDPATH**/ ?>