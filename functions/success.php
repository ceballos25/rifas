<?php
// Ruta correcta a tu archivo de conexión a la base de datos
require_once "../config/config_bd.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Recuperar los datos del POST
    $ref_payco = $_GET['ref_payco'];
    $id_ref_payco = $_GET['id_ref_payco'];
    $respuesta = $_GET['respuesta'];
    $motivo = $_GET['motivo'];
    $banco = $_GET['banco'];
    $recibo = $_GET['recibo'];
    $total = $_GET['total'];
    $nombre_cliente = $_GET['nombre_cliente'];
    $cedula = $_GET['cedula'];
    $correo = $_GET['correo'];
    $celular = $_GET['celular'];
    $totalNumeros = $_GET['totalNumeros'];
    
    // Obtener la fecha en formato adecuado
    $fecha_transaccion = date('Y-m-d H:i:s', strtotime($_GET['fecha']));

    // Validar y limpiar los datos si es necesario

    // Insertar en la base de datos
    $conn = obtenerConexion(); // Función para obtener la conexión a la base de datos, implementa según tus necesidades

    $sql = "INSERT INTO ventas (referencia_pago,
                                id_ref_payco,
                                respuesta,
                                motivo,
                                banco,
                                recibo,
                                total,
                                fecha_transaccion,
                                nombre_cliente)
                                VALUES
                                ('$ref_payco',
                                '$id_ref_payco',
                                '$respuesta',
                                '$motivo',
                                '$banco',
                                '$recibo',
                                '$total',
                                '$fecha_transaccion',
                                '$nombre_cliente')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados en la base de datos con éxito";
    } else {
        echo "Error al insertar datos en la base de datos: " . $conn->error;
    }

    // Cerrar la conexión si es necesario
    $conn->close();
} else {
    echo "Acceso no permitido";
}
?>
