<?php
    include '../include/header.php';
    include '../config/config_db.php';

    $conn = obtenerConexion();


// Verificar si se pudo obtener la conexión
if (!$conn) {
    die("Error al conectar con la base de datos.");
}

// Consulta SQL
$sql = "SELECT `id`, `nombre_cliente`, `cedula_cliente`, `correo_cliente`, `celular_cliente`, `departamento`, `ciudad`, `total_numeros`, `total_pagado`, `payment_id_mercadopago`, `external_reference_codigo_transaccion`, `fecha_venta`, `codigo_sorteo` FROM `ventas` WHERE 1";

// Ejecutar la consulta
$resultado = $conn->query($sql);


    include 'plantilla.php';
?>
<!-- termina plantilla -->
 

<!-- inicia contenido -->
<div id="layoutSidenav_content">
                <main>
                <h1 class="mt-4 mb-4 mx-4 d-flex justify-content-center">Ventas al Detalle</h1>
                    <div class="container-fluid px-4">
                    <div class="card-body">
                                <table id="datatablesSimple" class="table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Cédula</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Departamento</th>
                                            <th>Ciudad</th>
                                            <th>Total números</th>
                                            <th>Pagó</th>
                                            <th>Id MercadoPago</th>
                                            <th>Id Transacción</th>
                                            <th>Fecha</th>
                                            <th>Sorteo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($resultado->num_rows > 0) {
                                            // Iterar sobre los resultados usando foreach
                                            foreach ($resultado as $fila) { ?>
                                                <tr>
                                                    <td><?php echo $fila["id"]; ?></td>
                                                    <td><?php echo $fila["nombre_cliente"]; ?></td>
                                                    <td><?php echo $fila["cedula_cliente"]; ?></td>
                                                    <td><?php echo $fila["correo_cliente"]; ?></td>
                                                    <td><?php echo $fila["celular_cliente"]; ?></td>
                                                    <td><?php echo $fila["departamento"]; ?></td>
                                                    <td><?php echo $fila["ciudad"]; ?></td>
                                                    <td><?php echo $fila["total_numeros"]; ?></td>
                                                    <td><?php echo $fila["total_pagado"]; ?></td>
                                                    <td><?php echo $fila["payment_id_mercadopago"]; ?></td>
                                                    <td><?php echo $fila["external_reference_codigo_transaccion"]; ?></td>
                                                    <td><?php echo date("d/m/Y h:i A", strtotime($fila["fecha_venta"])); ?></td>
                                                    <td><?php echo $fila["codigo_sorteo"]; ?></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr><td colspan='13'>No se encontraron resultados.</td></tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                    </div>
                </main>
<!-- termina contenido -->

<!-- inicia footer -->
<?php
include '../include/footer.php';
?>
<!-- termina footer -->