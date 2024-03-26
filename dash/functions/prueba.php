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
        // echo "Nombre: " . $nombre . "<br>";
        // echo "Cédula: " . $cedula . "<br>";
        // echo "Correo: " . $correo . "<br>";
        // echo "Celular: " . $celular . "<br>";
        // echo "Departamento: " . $departamento . "<br>";
        // echo "Ciudad: " . $ciudad . "<br>";
        // echo "Comprobante de pago: " . $comprobante . "<br>";
        // echo "Cantidad de números: " . $totalNumeros . "<br>";
        // echo "Total a Pagar: " . $totalAPagar . "<br>";



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
                       
                        $numeros_html = '<div style="display: flex; flex-wrap: wrap;">';
                        foreach ($numeros_vendidos as $key => $numero) {
                            if ($key > 0 && $key % 10 === 0) {
                                $numeros_html .= '</div><div style="display: flex; flex-wrap: wrap;">';
                            }
                            $numeros_html .= '<span style="margin-right: 10px; margin-bottom: 10px; color: #fff; background-color: #000; padding: 5px; border-radius: 50%; font-weight: bold; display: inline-block;">' . $numero . '</span>';
                        }
                        $numeros_html .= '</div>';
       
                        // Configura el servidor SMTP y crea una instancia de PHPMailer
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        // Contenido HTML del correo
                        $mail->isHTML(true);
                        $mail->Body = '<!DOCTYPE html>
                        <html lang="es">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Notificación de Ticket</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                    margin: 0;
                                    padding: 0;
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 20px auto;
                                    background-color: #fff;
                                    padding: 20px;
                                    border-radius: 10px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    text-align: center;
                                    color: #333;
                                }
                                p {
                                    color: #555;
                                    line-height: 1.6;
                                }
                                .ticket {
                                    background-color: #ffc107;
                                    color: #333;
                                    border-radius: 5px;
                                    padding: 8px 12px;
                                    margin-bottom: 10px;
                                    display: inline-block;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container">
                            <h2 style="text-align: center">'. $nombre .'</h2>
                                <img src="https://eldiadetusuerte.com/images/agradecimiento-2.png" alt="Imagen de agradecimiento" style="display: block; margin: 0 auto 20px; width: 100%;" >
                                
                                <p>Queremos agradecerte por tu compra en nuestro sitio.</p>
                                <p>A continuacion los numeros generados por nuestro sistema.</p>
                                <p>Recuerda el sorteo jugara con las (4) cifras de la L0t3teria de Medellin.</p>
                                <p>Al completar el 80% de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.</p>
                                <div class="badge-container">' . $numeros_html . '</div>
                                <p>Te deseamos mucha suerte</p>
                            </div>
                        </body>
                        </html>';

                        $mail->Host = 'smtp.hostinger.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'info@eldiadetusuerte.com';
                        $mail->Password = 'Colombia2024*';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Subject = 'Confirmacion:'.'#'. $codigoTransaccion.'-'.$id_venta;
                        $mail->Port = 587;
                        $mail->setFrom('info@eldiadetusuerte.com', 'El dia de Tu Suerte');
                        $mail->addAddress($correo);
                        $mail->addBCC('info@eldiadetusuerte.com', 'Copia oculta');


                        // Envía el correo electrónico
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
                    }
                } else {
                    // Si ocurre un error al insertar la venta, revierte la transacción
                    $conexion->rollback();
                    echo "Error: No se pudieron insertar los datos de la venta en la base de datos.";
                }
            } else {
                // Si no hay suficientes números disponibles, revierte la transacción
                $conexion->rollback();
                echo "Error: No hay suficientes números disponibles para realizar la venta.";
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

    // Cerrar la conexión
    mysqli_close($conexion);

    // Redireccionar o mostrar un mensaje de éxito
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Gracias por tu Compra!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/agradecimiento.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

</head>
<body class="mb-5">

<div class="container mt-1" style="background-color: #fff;">
    <div class="mt-2">
        <div class="card-header text-center" style="background-color: #fff;"></div>
        <div class="">
            <div class="card mb-3">
                <img src="../assets/img/agradecimiento-2.png" class="card-img-top" alt="...">
            </div>
            <ul class="list-group" style="background-color: #fff;">
                <li class="list-group-item d-flex"><i class="fas fa-user me-1"></i> <b><?php echo $nombre ?></b></li>
                <li class="list-group-item"> Queremos agracerte por la compra, y esperamos que la suerte esté de tu lado. 🍀</li>
                <li class="list-group-item"> A continuacion los numeros generados por nuestro sistema, recuerda El sorteo jugara con las (4) cifras de la L0t3teria de Medellin. Al completar el 80% de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.</li>
                <li class="list-group-item">
                    <i class="fas fa-ticket-alt me-3"></i> <strong>Estos son tus números:</strong>
                    <div id="numeros_vendidos_container">
                        <?php
                            // Generar badges para cada número vendido
                            foreach ($numeros_vendidos as $numero) {
                                echo '<span class="badge badge-warning p-2 mt-2 badge text-bg-warning" style="margin-right: 10px;">' . $numero . '</span>';
                            }
                        ?>
                    </div>
                    <!-- Aquí se mostrarán los badges -->
                </li>
            </ul>
            <div class="text-center mt-2">
            <button onclick="descargarComoPDF()" class="btn btn-sm btn-success">Descargar PDF</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    function descargarComoPDF() {
        const element = document.querySelector('.container');
        const options = {
            filename: 'agradecimiento.pdf', // Nombre del archivo PDF
            html2canvas: { // Configuración para html2canvas
                scale: 2, // Escala para mejorar la calidad de la imagen
            },
            jsPDF: { // Configuración para jsPDF
                format: 'letter', // Formato de página: 'letter', 'legal', 'tabloid', etc.
                orientation: 'portrait', // Orientación del documento: 'portrait' o 'landscape'
                unit: 'px', // Unidad de medida: 'mm', 'cm', 'in', 'px'
                hotfixes: ['px_scaling'], // Corrección para el escalado en píxeles
                format: [1000, 1000],
            }
        };
        html2pdf().set(options).from(element).save();
    }
</script>

<?php session() ?>
</body>
</html>
