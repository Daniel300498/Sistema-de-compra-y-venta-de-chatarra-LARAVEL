<?php $__env->startSection('titulo','proveedores'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO proveedores</h1>
             <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Proveedores</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.create')): ?>
        <button type="button" class="btn btn-primary MB-3" data-bs-toggle="modal" data-bs-target="#modalProveedor" onclick="resetModalProveedor()"> <i class="bi bi-plus-lg"></i> Nuevo Proveedor</button>
        <?php endif; ?>
    </div>
</div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores Registrados</h5>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Gestiona el registro de proveedores que suministran materiales a la empresa.
                            Mantén actualizados sus datos de contacto, tipo de producto que ofrecen y documentación tributaria para agilizar los procesos de compra.
                        </p>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-left">Nombre</th>
                                            <th class="text-left">NIT / CI / RUC</th>
                                            <th class="text-left">Pais</th>
                                            <th class="text-left">TeléfonoS</th>
                                            <th class="text-left">Direcciones</th>
                                            <th class="text-left">Email</th>
                                            <th class="text-left">Tipo de Producto</th>
                                            <th class="text-left">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                     <td class="text-left"><?php echo e($e->nombre); ?></td>
                                                    <td class="text-left"><?php echo e($e->nit); ?></td>
                                                    <td class="text-left"><?php echo e($e->pais); ?></td>
                                                      <td>
                                                        <?php $__empty_1 = true; $__currentLoopData = $e->contacts->where('tipo','telefono'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <span class="badge bg-primary"><?php echo e($contacto->valor); ?></span><br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <span class="text-muted">Sin teléfonos</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php $__empty_1 = true; $__currentLoopData = $e->contacts->where('tipo','direccion'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <span class="badge bg-secondary">
                                                                Dir <?php echo e($index + 1); ?>: <?php echo e($contacto->valor); ?>

                                                            </span><br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <span class="text-muted">Sin direcciones</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-left"><?php echo e($e->email); ?></td>
                                                  
                                                    <td class="text-left"><?php echo e($e->tipo_producto); ?></td>
                                                       <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.edit')): ?>
                                                                        <li><a class="dropdown-item" href="#" onclick="editarProveedor(<?php echo e($e); ?>)"><i class="bi bi-pencil"></i> Modificar</a></li>
                                                                    <?php endif; ?>

                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.destroy')): ?>
                                                                         <li><a class="dropdown-item text-danger" href="<?php echo e(route('proveedores.destroy', $e->uuid)); ?>" onclick="return confirm('¿Eliminar este proveedor?')"><i class="bi bi-trash"></i> Eliminar</a></li>        
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
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
<?php echo $__env->make('proveedores.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/contactosVarios.js')); ?>"type ="text/javascript"></script>
<script>
    
function resetModalProveedor() {
    document.getElementById('tituloProveedor').innerHTML ='<i class="bi bi-building "></i> Nuevo Proveedor';
    document.getElementById('btnProveedor').innerText = 'Registrar';
    document.getElementById('methodProveedor').value = 'POST';
    document.getElementById('formProveedor').action = '<?php echo e(route("proveedores.store")); ?>';
    limpiarFormularioProveedor();
}
function editarProveedor(proveedor) {
    const baseUrl = "<?php echo e(url('/')); ?>";
    document.getElementById('tituloProveedor').innerHTML = '<i class="bi bi-pencil-square"></i> Editar Proveedor';
    document.getElementById('btnProveedor').innerText = 'Actualizar';
    document.getElementById('methodProveedor').value = 'PUT';
    document.getElementById('formProveedor').action = baseUrl + '/proveedores/' + proveedor.id;
    document.getElementById('prov_nombre').value = proveedor.nombre ?? '';
    document.getElementById('prov_nit').value = proveedor.nit ?? '';
    document.getElementById('prov_pais').value = proveedor.pais ?? '';
    document.getElementById('prov_email').value = proveedor.email ?? '';
    document.getElementById('prov_tipo_producto').value = proveedor.tipo_producto ?? '';

    const telContainer = document.getElementById('telefonos-container');
    const dirContainer = document.getElementById('direcciones-container');
    telContainer.innerHTML = '';
    dirContainer.innerHTML = '';
    let telefonos = proveedor.contacts?.filter(c => c.tipo === 'telefono') ?? [];
    let direcciones = proveedor.contacts?.filter(c => c.tipo === 'direccion') ?? [];

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
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalProveedor')).show();
}


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/proveedores/index.blade.php ENDPATH**/ ?>