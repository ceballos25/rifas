<?php
    include '../include/header.php';
    include '../config/config_db.php';
    include '../functions/query.php';
    $conn = obtenerConexion();

    // Obtener la suma total de números vendidos
    $numeros_vendidos = obtenerTotalNumerosVendidos($conn);

    // Definir el objetivo de ventas
    $objetivo_ventas = 10000; // Cambia esto al número deseado

    // Calcular los números faltantes
    $numeros_faltantes = $objetivo_ventas - $numeros_vendidos;

    // Obtener el total vendido
    $total_pagado = obtenerTotalVendido($conn);

    // Obtener el total de clientes
    $suma_total_clientes = obtenerTotalClientes($conn);

    // Obtiene los clientes
    $clientes = obtenerClientes($conn);


    // Llama a la función para obtener los clientes con más compras
    $clientesConMasCompras = obtenerClientesConMasVentas($conn);

    // Prepara los datos para el gráfico
    $nombresClientes = [];
    $totalCompras = [];

    foreach ($clientesConMasCompras as $cliente) {
        $nombresClientes[] = $cliente['nombre_cliente'];
        $totalCompras[] = $cliente['total_numeros'];
    }



        // Llama a la función para obtener las 10 ciudades con más ventas
        $ciudadesMasVendidas = obtenerCiudadesMasVendidas($conn);

        // Prepara los datos para el gráfico
        $nombresCiudades = [];
        $totalVentas = [];

        foreach ($ciudadesMasVendidas as $ciudad) {
            $nombresCiudades[] = $ciudad['ciudad'];
            $totalVentas[] = $ciudad['total_ventas'];
        } 


// Llama a la función para obtener el número de ventas por sorteo
$ventasPorSorteo = obtenerVentasSorteo($conn);

// Prepara los datos para el gráfico
$nombresSorteo = [];
$totalVentasSorte = [];

foreach ($ventasPorSorteo as $venta) {
    $nombresSorteo[] = $venta['codigo_sorteo'];
    $totalVentasSorteo[] = $venta['total_ventas_sorteo'];
}
?>

<!-- termina header -->

<!-- inicia plantilla -->
<?php

    include 'plantilla.php';
?>
<!-- termina plantilla -->
 

<!-- inicia contenido -->
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Bienvenido:  <?php echo  $_SESSION['usuario_nombre']; ?>🍀</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total números vendidos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <span class="large text-white stretched-link"><?php echo $numeros_vendidos; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Vendido</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="large text-white stretched-link"><?php echo '$' . number_format($total_pagado, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Clientes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="large text-white stretched-link"><?php echo $suma_total_clientes; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Falta por vender</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="large text-white stretched-link"><?php echo $numeros_faltantes; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Los 10 clientes  con más números comprados
                                </div>
                                <div class="card-body"><canvas id="myBarChartMes" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                          
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ciudad donde más se vende
                                    </div>
                                    <div class="card-body"><canvas id="ciudadesMasVendidas" width="100%" height="50%"></canvas></div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ventas Por Sorteo
                                    </div>
                                    <div class="card-body"><canvas id="ventasPorSorteoPieChart" width="100%" height="222"></canvas></div>
                                </div>
                            </div>
                            
                        </div>

                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Clientes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cédula</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Depto</th>
                                            <th>Ciudad</th>
                                            <th>Total números</th>
                                            <th>Pagó</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <tr>
                                                <td><?php echo $cliente['nombre_cliente']; ?></td>
                                                <td><?php echo $cliente['cedula_cliente']; ?></td>
                                                <td><?php echo $cliente['correo_cliente']; ?></td>
                                                <td><?php echo $cliente['celular_cliente']; ?></td>
                                                <td><?php echo $cliente['departamento']; ?></td>
                                                <td><?php echo $cliente['ciudad']; ?></td>
                                                <td><?php echo $cliente['total_numeros']; ?></td>
                                                <td><?php echo '$' . number_format($cliente['total_pagado'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
<!-- termina contenido -->

<!-- inicia footer -->
<?php
include '../include/footer.php';
?>
<!-- termina footer -->

   <script>
        // JavaScript para generar el gráfico de barras con Chart.js
        var ctx = document.getElementById('myBarChartMes').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nombresClientes); ?>, // Nombres de los clientes
                datasets: [{
                    label: 'Números',
                    data: <?php echo json_encode($totalCompras); ?>, // Total de compras por cliente
                    backgroundColor: [ // Definir colores para el fondo de las barras
                        'rgba(255, 99, 132, 0.2)', // Rojo
                        'rgba(54, 162, 235, 0.2)', // Azul
                        'rgba(255, 206, 86, 0.2)', // Amarillo
                        'rgba(75, 192, 192, 0.2)', // Verde
                        'rgba(153, 102, 255, 0.2)', // Morado
                        'rgba(255, 159, 64, 0.2)', // Naranja
                        'rgba(255, 99, 132, 0.2)', // Rojo (repetido)
                        'rgba(54, 162, 235, 0.2)', // Azul (repetido)
                        'rgba(255, 206, 86, 0.2)', // Amarillo (repetido)
                        'rgba(75, 192, 192, 0.2)' // Verde (repetido)
                        // Puedes agregar más colores si lo deseas
                    ],
                    borderColor: [ // Definir colores para el borde de las barras
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                        // Puedes agregar más colores si lo deseas
                    ],
                    borderWidth: 1
                }]
            
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


// ciudades donde más se vende
var ctx = document.getElementById('ciudadesMasVendidas').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($nombresCiudades); ?>,
        datasets: [{
            label: 'Total de Ventas',
            data: <?php echo json_encode($totalVentas); ?>,
            backgroundColor: [ // Definir colores para el fondo de las barras
                'rgba(255, 99, 132, 0.2)', // Rojo
                'rgba(54, 162, 235, 0.2)', // Azul
                'rgba(255, 206, 86, 0.2)', // Amarillo
                'rgba(75, 192, 192, 0.2)', // Verde
                'rgba(153, 102, 255, 0.2)', // Morado
                'rgba(255, 159, 64, 0.2)', // Naranja
                'rgba(255, 99, 132, 0.2)', // Rojo (repetido)
                'rgba(54, 162, 235, 0.2)', // Azul (repetido)
                'rgba(255, 206, 86, 0.2)', // Amarillo (repetido)
                'rgba(75, 192, 192, 0.2)' // Verde (repetido)
                // Puedes agregar más colores si lo deseas
            ],
            borderColor: [ // Definir colores para el borde de las barras
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
                // Puedes agregar más colores si lo deseas
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctxPie = document.getElementById('ventasPorSorteoPieChart').getContext('2d');
var myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($nombresSorteo); ?>, // Nombres de los sorteos
        datasets: [{
            label: 'Número de Ventas',
            data: <?php echo json_encode($totalVentasSorteo); ?>, // Total de ventas por sorteo
            backgroundColor: [ // Colores de fondo para cada sector
                'rgba(255, 99, 132, 0.8)', // Rojo
                'rgba(54, 162, 235, 0.8)', // Azul
                'rgba(255, 205, 86, 0.8)', // Amarillo
                'rgba(75, 192, 192, 0.8)', // Verde
                'rgba(153, 102, 255, 0.8)', // Morado
                'rgba(255, 159, 64, 0.8)', // Naranja
                'rgba(255, 0, 255, 0.8)', // Magenta
                'rgba(0, 255, 255, 0.8)', // Cian
                'rgba(128, 128, 128, 0.8)', // Gris
                'rgba(0, 0, 0, 0.8)' // Negro
            ],
            borderColor: 'rgba(255, 255, 255, 1)', // Color del borde de cada sector
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});



 
    </script>