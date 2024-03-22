<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion | El día de Tu Suerte</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <script src="../../js/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
   <!-- sidebar -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

   <!-- mercado pago -->
   <script src="https://sdk.mercadopago.com/js/v2"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

   <!-- icons -->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <script src="https://kit.fontawesome.com/cf96aaa9b2.js" crossorigin="anonymous"></script>

    <!-- descargar en imagen  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</head>
<body>


    <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmación</h5>
                </div>
                <div class="modal-body">
                    Estimado(a), <p><b><?php echo $_SESSION['nombre'] ?>,</b> por favor tome nota de los números con los que usted participará en el sorteo. También podrá descargarlos en formato imagen: <a class="btn btn m-0 p-1 descargar-img" onclick="descargarComoImagen()"><i class="fa-solid fa-image"></i> <i class="fa-solid fa-down-long"></i></a>. </p>
                    <b>Recuerde:</b>
                    <p>Jugará con las (4) cifras de la L0t3teria de Medellín. Al completar el <b>80%</b> de los números, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.</p>
                    <!-- Aquí se muestra la lista de números generados -->
                    <b>Sus números:</b>
                    <div id="numeros_vendidos_container" style="display: flex; flex-wrap: wrap; font-size:large"></div>                    
                    <div id="external_reference_container" style="display: flex; flex-wrap: wrap; font-size:large"></div>                                                    
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                <div>
                    <a type="button" href="https://instagram.com/jorgeherreraoficial" target="_blank" class="btn btn-dark btn-small p-0 mr-2"><span class="fa fa-instagram m-2"></span></a>
                    <a type="button" href="https://www.facebook.com/profile.php?id=100092247236425" target="_black" class="btn btn-dark btn-small p-0 mr-2"><span class="fa fa-facebook m-2"></span></a>
                    <a type="button" href="https://t.me/infoeldiadetusuerte" target="_blank" class="btn btn-dark btn-small p-0 mr-2"><span class="fa-brands fa-telegram m-2"></span></a>
                    <a type="button" href="https://wa.link/2u006f" target="_blank" class="btn btn-dark btn-small p-0 mr-2"><span class="fa-brands fa-brands fa-whatsapp m-2"></span></a>
                </div>
                <div>
                    <a type="button" href="/rifas/" class="btn btn-secondary">Salir</a>
                </div>
            </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    function descargarComoImagen() {
        var container = document.getElementById("numeros_vendidos_container").cloneNode(true); // Clonar el contenedor
        document.body.appendChild(container); // Agregar el contenedor clonado al cuerpo del documento

        // Captura el contenedor clonado como una imagen
        html2canvas(container, {
            onrendered: function(canvas) {
                // Crea un enlace para descargar la imagen
                var link = document.createElement('a');
                link.download = 'sorteo-el-dia-de-tu-suerte.png'; // Nombre del archivo a descargar
                link.href = canvas.toDataURL("image/png");
                // Agrega el enlace al documento y lo simula haciendo clic en él
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Remueve el contenedor clonado del documento
                document.body.removeChild(container);
            }
        });
    }
</script>

</body>
</html>
        
</body>
</html>
<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../config/config_bd.php';

// Incluye la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere el autoload de PHPMailer
require '../../vendor/autoload.php';

// Intenta establecer la conexión con la base de datos
$conexion = obtenerConexion();

// Verifica si la conexión se estableció correctamente
if ($conexion) {
    // Si se recibieron los datos almacenados en la sesión
    if (isset($_SESSION['nombre'], $_SESSION['cedula'], $_SESSION['correo'], $_SESSION['celular'], $_SESSION['departamento'], $_SESSION['ciudad'], $_SESSION['totalNumeros'])) {
        // Recupera y valida los datos almacenados en las sesiones
        $nombre = validar($_SESSION['nombre']);
        $cedula = validar($_SESSION['cedula']);
        $correo = validar($_SESSION['correo']);
        $celular = validar($_SESSION['celular']);
        $departamento = validar($_SESSION['departamento']);
        $ciudad = validar($_SESSION['ciudad']);
        $totalNumeros = validar($_SESSION['totalNumeros']);

        // Precio unitario de la rifa
        $valorRifa = 6000;

        // Calcula el total a pagar por el usuario
        $totalPagado = $valorRifa * $totalNumeros;

        // Obtiene los datos de la URL
        $payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : '';
        $external_reference = isset($_GET['external_reference']) ? $_GET['external_reference'] : '';

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
                $consulta_venta->bind_param("ssssssisss", $nombre, $cedula, $correo, $celular, $departamento, $ciudad, $totalNumeros, $totalPagado, $payment_id, $external_reference);
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
                        $mail->Subject = 'Confirmacion:'.'#'. $external_reference.'-'.$id_venta;
                        $mail->Body = "Estimado(a) " . $nombre . ",\n\n";
                        $mail->Body .= "A continuacion los numeros generados por nuestro sistema: " . implode(", ", $numeros_vendidos) . ".\n\n";
                        $mail->Body .= "El sorteo jugara con las (4) cifras de la L0t3teria de Medellin. Al completar el 80% de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.: " .".\n\n";
                        $mail->Body .= "Gracias por tu compra.\n\n";
                        $mail->Body .= "Atentamente,\n";
                        $mail->Body .= "🍀El dia de Tu Suerte🍀";

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
} else {
    // Si la conexión a la base de datos no se estableció correctamente, muestra un mensaje de error
    echo "Error de conexión a la base de datos.";
}

// Función para validar los datos recibidos
function validar($dato) {
    // Filtra y escapa los datos para evitar inyección de HTML y JavaScript
    return htmlspecialchars(strip_tags(trim($dato)));
}

// Cierra la conexión
$conexion->close();

// Desconfigura todas las variables de sesión
session_unset();
?>
