<?php
require_once "../config/config_bd.php";
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Validar y sanitizar los datos del GET
    $ref_payco = filter_input(INPUT_GET, 'ref_payco', FILTER_SANITIZE_STRING);
    $id_ref_payco = filter_input(INPUT_GET, 'id_ref_payco', FILTER_SANITIZE_STRING);
    $respuesta = filter_input(INPUT_GET, 'respuesta', FILTER_SANITIZE_STRING);
    $motivo = filter_input(INPUT_GET, 'motivo', FILTER_SANITIZE_STRING);
    $banco = filter_input(INPUT_GET, 'banco', FILTER_SANITIZE_STRING);
    $recibo = filter_input(INPUT_GET, 'recibo', FILTER_SANITIZE_STRING);
    $total = filter_input(INPUT_GET, 'total', FILTER_SANITIZE_STRING);
    $nombre_cliente = filter_input(INPUT_GET, 'nombre_cliente', FILTER_SANITIZE_STRING);
    $cedula_cliente = filter_input(INPUT_GET, 'cedula_cliente', FILTER_SANITIZE_STRING);
    $correo_cliente = filter_input(INPUT_GET, 'correo_cliente', FILTER_SANITIZE_EMAIL);
    $celular_cliente = filter_input(INPUT_GET, 'celular_cliente', FILTER_SANITIZE_STRING);
    $departamento_cliente = filter_input(INPUT_GET, 'departamento_cliente', FILTER_SANITIZE_STRING);
    $ciudad_cliente = filter_input(INPUT_GET, 'ciudad_cliente', FILTER_SANITIZE_STRING);
    $total_numeros = filter_input(INPUT_GET, 'total_numeros', FILTER_SANITIZE_STRING);

    // Verificar si todos los datos necesarios están presentes
    if (!$ref_payco || !$id_ref_payco || !$respuesta || !$motivo || !$banco || !$recibo || !$total || !$nombre_cliente || !$cedula_cliente || !$correo_cliente || !$celular_cliente || !$departamento_cliente || !$ciudad_cliente || !$total_numeros) {        
        header("Location: ../");
        exit;
    }

    // Obtener la fecha en formato adecuado
    $fecha_transaccion = date('Y-m-d H:i:s', strtotime($_GET['fecha']));

    // Insertar en la base de datos
    $conn = obtenerConexion();

    // Query de inserción de datos de la venta (usando sentencias preparadas)
    $sql = "INSERT INTO ventas (referencia_pago, id_ref_payco, respuesta, motivo, banco, recibo, total, fecha_transaccion, nombre_cliente, cedula_cliente, correo_cliente, celular_cliente, departamento, ciudad, total_numeros)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsssssssi", $ref_payco, $id_ref_payco, $respuesta, $motivo, $banco, $recibo, $total, $fecha_transaccion, $nombre_cliente, $cedula_cliente, $correo_cliente, $celular_cliente, $departamento_cliente, $ciudad_cliente, $total_numeros);

    if ($stmt->execute()) {
        // Obtener el ID de la última inserción
        $id_insercion_venta = $stmt->insert_id;

        // Generar números únicos de 4 dígitos y agregarlos a la tabla de números vendidos
        $numeros_generados = [];

        // Bucle para generar números
        for ($i = 0; $i < $total_numeros; $i++) {
            // Generar número aleatorio de 4 dígitos
            $numero_aleatorio = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            // Verificar si el número ya existe en la tabla de números vendidos
            $consulta_existencia = "SELECT * FROM numeros_vendidos WHERE numero = ?";
            $stmt_existencia = $conn->prepare($consulta_existencia);
            $stmt_existencia->bind_param("s", $numero_aleatorio);
            $stmt_existencia->execute();
            $resultado_existencia = $stmt_existencia->get_result();

            // Si el número no existe, insertarlo en la tabla
            if ($resultado_existencia->num_rows === 0) {
                // Query de inserción del número en la tabla de números vendidos
                $sql_insert_numero = "INSERT INTO numeros_vendidos (id_venta, numero) VALUES (?, ?)";
                $stmt_insert_numero = $conn->prepare($sql_insert_numero);
                $stmt_insert_numero->bind_param("is", $id_insercion_venta, $numero_aleatorio);
                $stmt_insert_numero->execute();

                // Agregar el número al array de números generados
                $numeros_generados[] = $numero_aleatorio;
            } else {
                // Aquí simplemente estamos decrementando $i para intentar generar otro número en su lugar.
                $i--;
            }
        }

        // Mensaje de éxito
        echo "Datos insertados en la base de datos con éxito. Números generados: " . implode(', ', $numeros_generados);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuraciones de SMTP (ajusta según tu proveedor de correo)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ceballosmarincristiancamilo@gmail.com';
            $mail->Password = 'mxyt zsmy klrx bjfp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuraciones generales
            $mail->setFrom('ceballosmarincristiancamilo@gmail.com', 'Sorteo Moto MT-14');
            $mail->addAddress($correo_cliente, $nombre_cliente);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // Configurar el juego de caracteres
            $mail->Subject = 'Información del Sorteo';

            // Cuerpo del mensaje
            $mensaje = "Gracias por tu compra. Aquí está la información de tu transacción:<br><br>" .
                    "Números generados: " . implode(', ', $numeros_generados);
            $mail->Body = $mensaje;

            // Enviar correo electrónico
            $mail->send();
        } catch (Exception $e) {
            // Imprimir mensaje de error
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        // Mensaje de error si la inserción falla
        echo "Error al insertar datos en la base de datos: " . $stmt->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Mensaje si la solicitud no es de tipo GET
    echo "Acceso no permitido";
}
?>
