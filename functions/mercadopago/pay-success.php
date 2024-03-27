<?php
session_start();

// Verificar si el token CSRF ya está en la sesión
if (!isset($_SESSION['csrf_token'])) {
    header('Location: /rifas'); // Redirige al usuario al inicio de la página principal
    exit();    
}

// Obtener el token CSRF de la sesión
$csrf_token = $_SESSION['csrf_token'];

// Validar el token CSRF recibido en la URL
if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $csrf_token) {
    header('Location: /rifas'); // Redirige al usuario al inicio de la página principal    
    exit(); 
}

require_once '../../config/config_bd.php';


// Incluye la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere el autoload de PHPMailer
require '../../vendor/autoload.php';

// Intenta establecer la conexión con la base de datos
$conexion = obtenerConexion();

if ($conexion) {
    // Si se recibieron los datos almacenados en la URL
    if (isset($_GET['nombre'], $_GET['cedula'], $_GET['correo'], $_GET['celular'], $_GET['departamento'], $_GET['ciudad'], $_GET['totalNumeros'], $_GET['csrf_token'])) {

        // Recupera y valida los datos almacenados en la URL
        $nombre = validar($_GET['nombre']);
        $cedula = validar($_GET['cedula']);
        $correo = validar($_GET['correo']);
        $celular = validar($_GET['celular']);
        $departamento = validar($_GET['departamento']);
        $ciudad = validar($_GET['ciudad']);
        $totalNumeros = validar($_GET['totalNumeros']);

        // Precio unitario de la rifa
        $valorRifa = 1000;

        // Calcula el total a pagar por el usuario
        $totalPagado = $valorRifa * $totalNumeros;

        // Obtiene los datos de la URL
        $payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : '';
        $codigoTransaccion = substr($cedula, -4) . mt_rand(1000, 9999);

        // Eliminar el token CSRF de la sesión
        unset($_SESSION['csrf_token']);

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
                $consulta_venta->bind_param("ssssssisss", $nombre, $cedula, $correo, $celular, $departamento, $ciudad, $totalNumeros, $totalPagado, $payment_id, $codigoTransaccion);
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
                        $numeros_html = '';

                        //numeros para la impresion en el correo
                        foreach ($numeros_vendidos as $numero) {
                            $numeros_html .= '<span style="margin-right: 10px;
                            color: #fff;
                            background-color: #000;
                            padding: 5px;
                            border-radius: 50%;
                            font-weight: bold;;">' . $numero . '</span>';
                        }
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
                                
                                <p>Queremos agracerte por la compra, y esperamos que la suerte este de tu lado.</p>
                                <p>A continuacion los numeros generados por nuestro sistema.</p>
                                <p><b>Recuerda:<b> el sorteo jugara con las (4) cifras de la L0t3teria de Medellin.</p>
                                <p>Al completar el 80% de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.</p>
                                    ' . $numeros_html . '
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

session_unset();

// Desconfigura todas las variables de sesión
?>


<!DOCTYPE html>
<html lang="es">
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
   <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script></head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
   <link rel="stylesheet" href="../../dash/css/agradecimiento.css">


<script>
const end = Date.now() + 15 * 100;

// go Buckeyes!
const colors = ["#FFA500", "#0f0"];

(function frame() {
  confetti({
    particleCount: 2,
    angle: 60,
    spread: 55,
    origin: { x: 0 },
    colors: colors,
  });

  confetti({
    particleCount: 2,
    angle: 120,
    spread: 55,
    origin: { x: 1 },
    colors: colors,
  });

  if (Date.now() < end) {
    requestAnimationFrame(frame);
  }
})();
</script>
<body>
<div class="container mt-1" style="background-color: #fff;">
    <div class="mt-2">
        <div class="card-header text-center" style="background-color: #fff;"></div>
        <h4 class= "d-flex justify-content-center my-4"> <b><?php echo $nombre; ?></b></h4>
        <div class="">
            <div class="card mb-3">
                <img src="../../dash/assets/img/agradecimiento-2.png" class="card-img-top" alt="...">
            </div>
            <ul class="list-group">
                <li class="list-group-item"> Queremos agracerte por la compra, y esperamos que la suerte esté de tu lado. 🍀</li>
                <p class="list-group-item"> A continuacion los numeros generados por nuestro sistema, <br>Recuerda el sorteo jugará con las (4) cifras de la L0t3teria de Medellin. <p>
                <p style="margin-left:15px">Al completar el <b>80%</b> de los numeros, anunciaremos la fecha del sorteo en nuestro sitio Web y redes sociales.</p>
                <li class="list-group-item">
                    <i class="fas fa-ticket-alt me-3"></i> <strong>Estos son tus números:</strong>
                    <div id="numeros_vendidos_container">
                        <?php
                            // Generar badges para cada número vendido
                            foreach ($numeros_vendidos as $numero) {
                                echo '<span class=" badge-warning p-2 mt-2 badge text-bg-warning text-large" style="margin-right: 10px;">' . $numero . '</span>';
                            }
                        ?>
                    </div>
                    <!-- Aquí se mostrarán los badges -->
                </li>
            </ul>
            <div class="text-center mt-2">
            <button onclick="descargarComoPDF()" class="btn btn-sm btn-success">Descargar PDF</button>
            <button" class="btn btn-sm btn-secondary">Regresar</button>
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
                scale: 3, // Escala para mejorar la calidad de la imagen
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

<?php session_unset() ?>;
</body>
</html>
        
</body>
</html>
