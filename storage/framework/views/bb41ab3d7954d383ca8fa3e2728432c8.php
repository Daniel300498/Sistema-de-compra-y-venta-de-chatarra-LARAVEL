

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="text-center mb-4">Resumen Empresarial</h1>

    <div class="row g-4">
        <!-- Cuadro BETTYS -->
        <div class="col-md-6 col-lg-4">
            <a href="http://localhost/rotiseria_betty/sistemav4/login" style="text-decoration:none; color:inherit;">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <img src="<?php echo e(asset('assets/img/logo_betty.png')); ?>" alt="BETTYS" style="width: 80px; height: auto;" class="mb-2">
                        <h5 class="card-title">Bettys</h5>
                        <p class="card-text">Ventas: <?php echo e($bettyVentasCount); ?></p>
                        <canvas id="bettyChart" height="100"></canvas>
                    </div>
                </div>
            </a>
        </div>

        <!-- Cuadro TORRES -->
        <div class="col-md-6 col-lg-4">
            <a href="http://localhost/torres/sistema_contable/login" style="text-decoration:none; color:inherit;">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <img src="<?php echo e(asset('assets/img/logo_torres.png')); ?>" alt="TORRES" style="width: 80px; height: auto;" class="mb-2">
                        <h5 class="card-title">Torres Gundlach</h5>
                        <p class="card-text">Recibos: <?php echo e($torresData); ?></p>
                        <canvas id="torresChart" height="100"></canvas>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bettyChart = new Chart(document.getElementById('bettyChart'), {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie'],
            datasets: [{
                label: 'Ventas',
                data: [12, 19, 7, 15, 9], // Puedes reemplazar estos datos dinámicamente
                backgroundColor: '#198754'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const torresChart = new Chart(document.getElementById('torresChart'), {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie'],
            datasets: [{
                label: 'Recibos',
                data: [5, 9, 6, 3, 7], // Puedes reemplazar por datos reales
                fill: false,
                borderColor: '#0d6efd',
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard\resources\views/home.blade.php ENDPATH**/ ?>