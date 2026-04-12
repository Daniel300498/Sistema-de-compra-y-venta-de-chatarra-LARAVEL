<?php $__env->startSection('titulo','Acad&eacute;mico'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle"> 
    <h1>Parámetros</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Parámetros</a></li>
                <li class="breadcrumb-item active">Acad&eacute;mico</li>
            </ol>
        </nav>        
    </div>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Parámetros Acad&eacute;micos</h5>
                    <p class="mb-0">Puede modificar los valores de formación, carreras universitarias y universidad o instituto, variables que se utilizan en el formulario para registrar un empleado. </p>
                    <p>Presione sobre el botón que haga referencia al valor que quiere ingresar.</p>
                    <div class="row mb-3">
                        <div class="row">
                            <div class="col-lg-4 text-center">
                                <button id="botonFormacion" class="btn btn-primary boton-opcion" onclick="showTable('formacion')">Formaci&oacute;n</button>
                            </div>
                            <div class="col-lg-4 text-center">
                                <button id="botonCarreras" class="btn btn-primary boton-opcion" onclick="showTable('carreras')">Carreras Universitarias</button>
                            </div>
                            <div class="col-lg-4 text-center">
                                <button id="botonUniversidad" class="btn btn-primary boton-opcion" onclick="showTable('universidad')">Universidad o Instituto</button>
                            </div>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('parametros.academico.secciones.formacion_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('parametros.academico.secciones.carreras_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('parametros.academico.secciones.universidad_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    function showTable(tableId) {
        document.getElementById('formacionTable').style.display = 'none';
        document.getElementById('carrerasTable').style.display = 'none';
        document.getElementById('universidadTable').style.display = 'none';

        document.getElementById(tableId + 'Table').style.display = 'block';

        cambiarTipoFormulario(tableId);
    }
    var tipoFormulario = "carreras"; 
    function cambiarTipoFormulario(tipo) {
        tipoFormulario = tipo;
        document.querySelectorAll('.boton-opcion').forEach(function(boton) {
            boton.classList.remove('active');
        });
        document.getElementById('boton' + tipo.charAt(0).toUpperCase() + tipo.slice(1)).classList.add('active');
    }
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/tablas/academico.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/parametros/academico/index.blade.php ENDPATH**/ ?>