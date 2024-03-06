<?php
// Este script se ejecutará cada 30 minutos utilizando un trabajo cron

// Ruta correcta a tu archivo de conexión a la base de datos
require_once "../config/config_bd.php";

// Obtener todas las transacciones con estado PENDIENTE
$conn = obtenerConexion(); // Utiliza tu función para obtener la conexión
$sql = "SELECT id_ref_payco, respuesta  FROM ventas WHERE respuesta = 'Pendiente'";
$result = $conn->query($sql);

if (!$result) {
    // Imprime el mensaje de error y termina el script
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_ref_payco = $row['id_ref_payco'];

        // Realiza una solicitud a ePayco para verificar el estado actual
        $urlVerificacion = "https://secure.epayco.co/validation/v1/reference/" . $id_ref_payco;
        $response = file_get_contents($urlVerificacion);
        $responseData = json_decode($response, true);

        // Verifica si el estado ahora es APROBADO
        if ($responseData && $responseData['success'] && $responseData['data']['x_cod_response'] == 1) {
            // Actualiza el estado en la base de datos a APROBADO
            $updateSql = "UPDATE ventas SET respuesta = 'Aceptada', motivo = 'Aprobada' WHERE id_ref_payco = '$id_ref_payco'";
            $updateResult = $conn->query($updateSql);

            if (!$updateResult) {
                // Imprime el mensaje de error para la actualización
                echo "Error al actualizar el estado: " . $conn->error;
            }
        }
    }
}

// Cierra la conexión
$conn->close();
?>
