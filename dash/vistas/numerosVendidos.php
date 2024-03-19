<?php
    include '../include/header.php';
    include '../config/config_db.php';
    include '../functions/query.php';
    $conn = obtenerConexion();

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
                <h1 class="mt-4 mb-4 mx-4">Tablero</h1>
                    <div class="container-fluid px-4">
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