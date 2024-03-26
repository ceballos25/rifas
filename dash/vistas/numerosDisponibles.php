<?php
    include '../include/header.php';
    include '../config/config_db.php';

    $conn = obtenerConexion();


// Verificar si se pudo obtener la conexión
if (!$conn) {
    die("Error al conectar con la base de datos.");
}

// Consulta SQL
$sql = "SELECT  id, numero FROM numeros;";

// Ejecutar la consulta
$resultado = $conn->query($sql);


    include 'plantilla.php';
?>
<!-- termina plantilla -->
 

<!-- inicia contenido -->
<div id="layoutSidenav_content">
    <main>
        <h1 class="mt-4 mb-4 mx-4 d-flex justify-content-center">Números Disponibles</h1>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Números Vendidos
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table-striped">
                        <thead>
                            <tr>
                                <th>Número</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultado->num_rows > 0) {
                                // Iterar sobre los resultados usando foreach
                                foreach ($resultado as $fila) { ?>
                                    <tr>
                                        <td><?php echo $fila["numero"]; ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan='4'>No se encontraron resultados.</td>
                                </tr>
                            <?php } ?>
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