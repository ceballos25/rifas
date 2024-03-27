<?php
date_default_timezone_set('America/Bogota'); //asignamos hora y fecha
// Incluye el archivo autoload.php del SDK de Mercado Pago
require_once '../../vendor/autoload.php';

session_start();

//recibimos los datos por post, los limpiamos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación y obtención de los datos del formulario
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';
    $correo = isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '';
    $celular = isset($_POST['celular']) ? htmlspecialchars($_POST['celular']) : '';
    $departamento = isset($_POST['departamento']) ? htmlspecialchars($_POST['departamento']) : '';
    $ciudad = isset($_POST['ciudad']) ? htmlspecialchars($_POST['ciudad']) : '';
    $opciones_boletas = isset($_POST['opciones_boletas']) ? htmlspecialchars($_POST['opciones_boletas']) : '';
    $otroInput = isset($_POST['otroInput']) ? htmlspecialchars($_POST['otroInput']) : '';
    $totalNumeros = isset($_POST['totalNumeros']) ? intval($_POST['totalNumeros']) : 0;
    $csrf_token = isset($_SESSION['csrf_token']) ? htmlspecialchars($_SESSION['csrf_token']) : '';

    // Verifica si los datos son válidos
    if (empty($nombre) || empty($cedula) || empty($correo) || empty($celular) || empty($departamento) || empty($ciudad) || empty($opciones_boletas) || empty($totalNumeros)) {
        echo "Error: Todos los campos del formulario son obligatorios.";
        header('Location: https://eldiadetusuerte.com' ); //se debe cambiar por la des servidor
        exit;
    }

    $nombre = trim($nombre);    

    // Separar el nombre completo en nombre y apellido
    $nombreCompleto = explode(" ", $nombre);
    $apellido = array_pop($nombreCompleto); // Obtiene el último elemento del array, que sería el apellido
    $nombre = implode(" ", $nombreCompleto);
    
    // Precio unitario de la rifa
    $valorRifa = 1000;

    // Calcula el total a pagar por el usuario
    $totalAPagar = $valorRifa * $totalNumeros;

    // Genera el código único de transacción
    $codigoTransaccion = substr($cedula, -4) . mt_rand(1000, 9999);

    // Configura las credenciales de acceso
    MercadoPago\SDK::setAccessToken("APP_USR-5629971001463341-032121-4eaf717f3023ca445a54d50d53f647c2-1736789621");

    // Crea una preferencia de pago
    $preference = new MercadoPago\Preference();
    $preference->binary_mode = true;

    // Crea un artículo para la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'EL día de Tu Suerte';
    $item->quantity = 1;
    $item->unit_price = $totalAPagar; // Utiliza el total a pagar recibido del formulario

    // Agrega el artículo a la preferencia
    $preference->items = array($item);

    // Agrega los datos del comprador
    $payer = new MercadoPago\Payer();
    $payer->first_name = $nombre; // Asigna el nombre
    $payer->last_name = $apellido; // Asigna el apellido
    $payer->email = $correo; // Asigna el correo electrónico    
    $payer->identification = $cedula;
    $payer->phone =  $celular;

    // Asigna el código único de transacción como external_reference
    $preference->external_reference = $codigoTransaccion;

    // Deshabilita el método de pago por efecty
    $preference->payment_methods = array(
        "excluded_payment_types" => array(
            array("id" => "credit_card"),
            array("id" => "debit_card"),
            array("id" => "ticket")
        ),
        "excluded_payment_methods" => array(
            array("id" => "cash"),
            array("id" => "atm"),
            array("id" => "bank_transfer")
        )
    );
    
    $preference->notification_url = "https://eldiadetusuerte.com/functions/mercadopago/alertas-mercado-pago.php";
    

    // URL de respuestas deben coincidir con las del hosting
    $base_url = "https://localhost/rifas/functions/mercadopago/";
    $preference->back_urls = array(
        "success" => $base_url . "pay-success.php?" . http_build_query($_POST), // Página a la que se redirigirá si la transacción es exitosa
        "failure" => $base_url . "pay-error.php?" . http_build_query($_POST), // Página a la que se redirigirá si la transacción falla
        "pending" => $base_url . "pay-pending.php?" . http_build_query($_POST) // Página a la que se redirigirá si la transacción está pendiente
    );
    //aquí especificamos que lo redirecciones de manera automática
    $preference->auto_return = "approved";
    

    // Guarda la preferencia en Mercado Pago
    $preference->save();


    // Define el directorio donde se guardarán los archivos de consulta SQL
    $directorio_archivos = 'consultas_sql/';
    
    // Verifica si el directorio existe, si no, créalo
    if (!file_exists($directorio_archivos)) {
        mkdir($directorio_archivos, 0777, true); // Cambia los permisos según necesites
    }
        // Guarda el INSERT INTO en un archivo con nombre único basado en payment_id
        $consulta_sql = "INSERT INTO ventas (nombre_cliente, cedula_cliente, correo_cliente, celular_cliente, departamento, ciudad, total_numeros, total_pagado, payment_id_mercadopago, external_reference_codigo_transaccion, fecha) VALUES ('$nombre', '$cedula', '$correo', '$celular', '$departamento', '$ciudad', '$totalNumeros', '$totalAPagar', '$codigoTransaccion', '$payment_id', '$fecha_actual')";
    
        $nombre_archivo = $directorio_archivos . $cedula . '.txt'; // Agrega el directorio y el nombre de archivo
        $archivo_consulta = fopen($nombre_archivo, "w");
        fwrite($archivo_consulta, $consulta_sql);
        fclose($archivo_consulta);
    // Redirige al usuario a la página de pago de Mercado Pago
    header('Location: ' . $preference->init_point); // Utiliza sandbox_init_point si estás en modo de pruebas
    exit();
} else {
    // Si no se recibieron los datos por POST, redirige a una página de error o muestra un mensaje
    // header('Location: https://localhost/rifas' ); //se debe cambiar por la des servidor
    echo '<script>alert("Algo Salió mal, por vuelva a intentarlo, si el error persiste, contáctenos.")</script>;';
    header('Location: https://eldiadetusuerte.com' ); //se debe cambiar por la des servidor
 }
?>
