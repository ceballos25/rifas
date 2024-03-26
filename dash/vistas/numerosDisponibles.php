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
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Agregar número Premiado 123</button></div>
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

        <!-- Modal agregar números premiados -->


            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingresar número premiado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../functions/agregar-premiado.php">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Número:</label>
                        <input type="number" requiered class="form-control" id="numero_premiado" name="numero_premiado">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </div>
                </form>
            </div>
            </div>
    </main>



         
<!-- termina contenido -->

<!-- inicia footer -->
<?php
include '../include/footer.php';
?>
<!-- termina footer -->