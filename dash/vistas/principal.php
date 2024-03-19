<?php
    include '../include/header.php';
    include '../config/config_db.php';
    include '../functions/query.php';
    $conn = obtenerConexion();

    // Obtener la suma total de números vendidos
    $suma_total_numeros_vendidos = obtenerTotalNumerosVendidos($conn);

    // Definir el objetivo de ventas
    $objetivo_ventas = 10000; // Cambia esto al número deseado

    // Calcular los números faltantes
    $numeros_faltantes = $objetivo_ventas - $suma_total_numeros_vendidos;

    // Obtener el total vendido
    $suma_total_vendido = obtenerTotalVendido($conn);

    // Obtener el total de clientes
    $suma_total_clientes = obtenerTotalClientes($conn);

    // Obtiene los clientes
    $clientes = obtenerClientes($conn);

    $conn->close();
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
                        <h1 class="mt-4 mb-4">Tablero</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total números vendidos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <span class="small text-white stretched-link"><?php echo $suma_total_numeros_vendidos; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Vendido</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white stretched-link"><?php echo $suma_total_vendido; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Clientes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white stretched-link"><?php echo $suma_total_clientes; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Falta por vender</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white stretched-link"><?php echo $numeros_faltantes; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ventas por mes
                                    </div>
                                    <div class="card-body"><canvas id="myBarChartMes" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Por Departamentos
                                    </div>
                                    <div class="card-body"><canvas id="myBarChartDepartamento" width="100%" height="40"></canvas></div>
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
                                            <th>Ciudady</th>
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