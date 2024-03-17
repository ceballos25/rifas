<?php

//la transacción fue rechazada, no hacer nada
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
    $total_numeros = filter_input(INPUT_GET, 'total_numeros', FILTER_SANITIZE_STRING);

    // Verificar si todos los datos necesarios están presentes
    if (!$ref_payco || !$id_ref_payco || !$respuesta || !$motivo || !$banco || !$recibo || !$total || !$nombre_cliente || !$cedula_cliente || !$correo_cliente || !$celular_cliente || !$total_numeros) {        
        header("Location: ../");
        exit;
    }

    } else {
        echo "algo salió mal";
    }
    // Mensaje si la solicitud no es de tipo GET
    echo "Acceso no permitido";
?>
