<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍀El día de tu Suerte🍀</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</body>
</html>
<?php

require 'config_bd.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza estos valores con los de tu conexión real)
    $conexion = obtenerConexion();

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Escapar los valores recibidos del formulario
    $numero_premiado = mysqli_real_escape_string($conexion, $_POST["numero_premiado"]);

    try {
        // Inicia una transacción
        $conexion->begin_transaction();

        // Prepara la consulta SQL para insertar el número premiado
        $consulta_numero_premiado = $conexion->prepare("INSERT INTO numeros (numero) VALUES (?)");
        $consulta_numero_premiado->bind_param("i", $numero_premiado);
        $consulta_numero_premiado->execute();

        // Verifica si la inserción del número premiado fue exitosa
        if ($consulta_numero_premiado->affected_rows > 0) {
            echo "<script>
            Swal.fire({
                title: '¡Perfecto!',
                text: 'El número $numero_premiado se agregó correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../vistas/numerosDisponibles.php';
                }
            });
            </script>";
            $conexion->commit();
        } else {
            echo "<script>
            Swal.fire({
                title: '¡Algo salió mal!',
                text: 'No se pudo agregar el número $numero_premiado.',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../vistas/numerosDisponibles.php';
                }
            });
            </script>";
        }
    } catch (Exception $e) {
        // Si ocurre algún error, revierte la transacción
        $conexion->rollback();
        echo "<script>
        Swal.fire({
            title: 'Algo salió mal!',
            text: 'No se pudo agregar el número $numero_premiado. Verifique e inténtelo nuevamente.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#000'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../vistas/numerosDisponibles.php';
            }
        });
        </script>";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se envió el formulario por el método POST, muestra un mensaje de error
    echo "Error: No se recibió el formulario.";
}
?>
