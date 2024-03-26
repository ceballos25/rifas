
<?php

include "../config/config_db.php";
require '../../vendor/autoload.php';
'../../vendor/autoload.php';

// // Incluye la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza estos valores con los de tu conexión real)

    $conexion = obtenerConexion();

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Escapar los valores recibidos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $cedula = mysqli_real_escape_string($conexion, $_POST["cedula"]);
    $correo = mysqli_real_escape_string($conexion, $_POST["correo"]);
    $celular = mysqli_real_escape_string($conexion, $_POST["celular"]);
    $departamento = mysqli_real_escape_string($conexion, $_POST["departamento"]);
    $ciudad = mysqli_real_escape_string($conexion, $_POST["ciudad"]);
    $comprobante = mysqli_real_escape_string($conexion, $_POST["comprobante"]);
    $totalNumeros = mysqli_real_escape_string($conexion, $_POST["oportunidades"]);

    // Procesar los datos según sea necesario
    // Por ejemplo, puedes realizar operaciones con la base de datos o cualquier otra lógica de negocio aquí

        // Precio unitario de la rifa
        $valorRifa = 6000;

        // Calcula el total a pagar por el usuario
        $totalAPagar = $valorRifa * $totalNumeros;

        $payment_id = "VENTA MANUAL";

        // Mostrar los datos recibidos
        echo "Nombre: " . $nombre . "<br>";
        echo "Cédula: " . $cedula . "<br>";
        echo "Correo: " . $correo . "<br>";
        echo "Celular: " . $celular . "<br>";
        echo "Departamento: " . $departamento . "<br>";
        echo "Ciudad: " . $ciudad . "<br>";
        echo "Comprobante de pago: " . $comprobante . "<br>";
        echo "Cantidad de números: " . $totalNumeros . "<br>";
        echo "Cantidad de números: " . $totalAPagar . "<br>";



        // Genera el código único de transacción
        $codigoTransaccion = substr($cedula, -4) . mt_rand(1000, 9999);

        try {
            // Inicia una transacción
            $conexion->begin_transaction();

            // Prepara la consulta SQL para seleccionar números disponibles de manera aleatoria
            $consulta_numeros = $conexion->prepare("SELECT id, numero FROM numeros ORDER BY RAND() LIMIT ?");
            $consulta_numeros->bind_param("i", $totalNumeros);
            $consulta_numeros->execute();
            $resultado_numeros = $consulta_numeros->get_result();

            // Verifica si hay suficientes números disponibles
            if ($resultado_numeros->num_rows >= $totalNumeros) {
                // Prepara la consulta SQL para insertar la venta
                $consulta_venta = $conexion->prepare("INSERT INTO ventas (nombre_cliente, cedula_cliente, correo_cliente, celular_cliente, departamento, ciudad, total_numeros, total_pagado, payment_id_mercadopago, external_reference_codigo_transaccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $consulta_venta->bind_param("ssssssisss", $nombre, $cedula, $correo, $celular, $departamento, $ciudad, $totalNumeros, $totalAPagar, $payment_id, $codigoTransaccion);
                $consulta_venta->execute();

                // Verifica si la inserción de la venta fue exitosa
                if ($consulta_venta->affected_rows > 0) {
                    // Obtiene el ID de la venta insertada
                    $id_venta = $conexion->insert_id;

                    // Prepara la consulta SQL para insertar los números vendidos
                    $consulta_numeros_vendidos = $conexion->prepare("INSERT INTO numeros_vendidos (id_venta, numero) VALUES (?, ?)");

                    // Prepara la consulta SQL para eliminar los números vendidos de la tabla numeros
                    $consulta_eliminar_numeros = $conexion->prepare("DELETE FROM numeros WHERE id = ?");

                    // Array para almacenar los números vendidos
                    $numeros_vendidos = array();

                    // Itera sobre los números seleccionados y los inserta en la tabla numeros_vendidos
                    while ($fila = $resultado_numeros->fetch_assoc()) {
                        $id_numero = $fila['id'];
                        $numero = $fila['numero'];

                        // Inserta el número vendido en la tabla numeros_vendidos
                        $consulta_numeros_vendidos->bind_param("is", $id_venta, $numero);
                        $consulta_numeros_vendidos->execute();

                        // Almacena el número vendido en el array
                        $numeros_vendidos[] = $numero;

                        // Elimina el número vendido de la tabla numeros
                        $consulta_eliminar_numeros->bind_param("i", $id_numero);
                        $consulta_eliminar_numeros->execute();
                        
                    }
                    // Muestra el modal con los números
                    echo '<script>';
                    echo '$(document).ready(function() { ';
                    echo 'var numeros_vendidos = ' . json_encode($numeros_vendidos) . ';';
                    echo 'var numerosHTML = "";';
                    echo 'numeros_vendidos.forEach(function(numero) { ';
                    echo 'numerosHTML += "<span class=\"badge badge-warning p-2 mt-2\" style=\"margin-right: 10px;\">" + numero + "</span>";';
                    echo '});';
                    echo '$("#numeros_vendidos_container").html(numerosHTML);';
                    echo '$("#staticBackdrop").modal("show");';
                    echo '});';
                    echo '</script>';

                    // Cierra las consultas
                    $consulta_numeros_vendidos->close();
                    $consulta_eliminar_numeros->close();

                    // Confirma la transacción
                    $conexion->commit();

                    try {
                        // Configura el servidor SMTP y crea una instancia de PHPMailer
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.hostinger.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'info@eldiadetusuerte.com';
                        $mail->Password = 'Colombia2024*';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        $mail->setFrom('info@eldiadetusuerte.com', 'El dia de Tu Suerte');
                        $mail->addAddress($correo);
                        $mail->addBCC('info@eldiadetusuerte.com', 'Copia oculta');
                        $mail->Subject = 'Confirmacion:'.'#'. $codigoTransaccion.'-'.$id_venta;
                        $mail->Body = "Estimado(a) " . $nombre . ",\n\n";
                        $mail->Body .= "A continuacion los numeros generados por nuestro sistema: " . implode(", ", $numeros_vendidos) . ".\n\n";
                        $mail->Body .= "El sorteo jugara con las (4) cifras de la L0t3teria de Medellin. Al completar el 80% de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.: " .".\n\n";
                        $mail->Body .= "Gracias por tu compra.\n\n";
                        $mail->Body .= "Atentamente,\n";
                        $mail->Body .= "El dia de Tu Suerte";

                        // Envía el correo electrónico
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
                        echo '<script>alert("Algo Salió mal, por vuelva a intentarlo, si el error persiste, contáctenos.")</script>;';
                        header('Location: https://localhost/rifas' ); //se debe cambiar por la des servidor
                    }
                } else {
                    // Si ocurre un error al insertar la venta, revierte la transacción
                    $conexion->rollback();
                    echo "Error: No se pudieron insertar los datos de la venta en la base de datos.";
                    echo '<script>alert("Algo Salió mal, por vuelva a intentarlo, si el error persiste, contáctenos.")</script>;';
                    header('Location: https://localhost/rifas' ); //se debe cambiar por la des servidor
                }
            } else {
                // Si no hay suficientes números disponibles, revierte la transacción
                $conexion->rollback();
                echo "Error: No hay suficientes números disponibles para realizar la venta.";
                echo '<script>alert("Algo Salió mal, por vuelva a intentarlo, si el error persiste, contáctenos.")</script>;';
                header('Location: https://localhost/rifas' ); //se debe cambiar por la des servidor
            }

            // Cierra la consulta de números disponibles
            $consulta_numeros->close();
        } catch (Exception $e) {
            // Si se produce una excepción, revierte la transacción y muestra un mensaje de error
            $conexion->rollback();
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    } else {
        // Si no se encuentran los datos almacenados en la sesión, muestra un mensaje de error
        echo "Error: No se recibieron los datos del formulario.";
    }

// Función para validar los datos recibidos
function validar($dato) {
    // Filtra y escapa los datos para evitar inyección de HTML y JavaScript
    return htmlspecialchars(strip_tags(trim($dato)));
}

// Desconfigura todas las variables de sesión
session_unset();


    // Cerrar la conexión
    mysqli_close($conexion);

    // Redireccionar o mostrar un mensaje de éxito
?>
