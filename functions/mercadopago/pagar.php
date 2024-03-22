<?php
// Incluye el archivo autoload.php del SDK de Mercado Pago
require_once '../../vendor/autoload.php';

session_start();

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

    // Verifica si los datos son válidos
    if (empty($nombre) || empty($cedula) || empty($correo) || empty($celular) || empty($departamento) || empty($ciudad) || empty($opciones_boletas) || empty($totalNumeros)) {
        echo "Error: Todos los campos del formulario son obligatorios.";
        header('Location: /rifas' ); //se debe cambiar por la des servidor
        
        exit;
    }
    
    // Precio unitario de la rifa
    $valorRifa = 6000;

    // Calcula el total a pagar por el usuario
    $totalAPagar = $valorRifa * $totalNumeros;

    // Genera el código único de transacción
    $codigoTransaccion = substr($cedula, -4) . mt_rand(1000, 9999); // Combina los últimos 4 dígitos de la cédula con un número aleatorio de 4 dígitos

    // Almacena los datos en variables de sesión
    $_SESSION['nombre'] = $nombre;
    $_SESSION['cedula'] = $cedula;
    $_SESSION['correo'] = $correo;
    $_SESSION['celular'] = $celular;
    $_SESSION['departamento'] = $departamento;
    $_SESSION['ciudad'] = $ciudad;
    $_SESSION['totalNumeros'] = $totalNumeros;

    // Configura las credenciales de acceso
    MercadoPago\SDK::setAccessToken("APP_USR-5629971001463341-032121-4eaf717f3023ca445a54d50d53f647c2-1736789621");

    // Crea una preferencia de pago
    $preference = new MercadoPago\Preference();
    
    // Crea un artículo para la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Producto';
    $item->quantity = 1;
    $item->unit_price = $totalAPagar; // Utiliza el total a pagar recibido del formulario

    // Agrega el artículo a la preferencia
    $preference->items = array($item);

    // Asigna el código único de transacción como external_reference
    $preference->external_reference = $codigoTransaccion;

    // Deshabilita el método de pago por efecty
    $preference->payment_methods = array(
        "excluded_payment_methods" => array(
            array("id" => "efecty") // Excluye el método de pago Efecty
        )
    );

    // URL de respuestas deben coincidir con las del hosting
    $base_url = "http://localhost/rifas/functions/mercadopago/";
    $preference->back_urls = array(
        "success" => $base_url . "pay-success.php",// Página a la que se redirigirá si la transacción es exitosa
        "failure" => $base_url . "pay-error.php", // Página a la que se redirigirá si la transacción falla
        "pending" => $base_url . "pay-pending.php" // Página a la que se redirigirá si la transacción está pendiente
    );
    //aqui especificamos que lo redirecciones de manera automática
    $preference->auto_return = "approved";

    // Guarda la preferencia en Mercado Pago
    $preference->save();

    // Redirige al usuario a la página de pago de Mercado Pago
    header('Location: ' . $preference->sandbox_init_point); // Utiliza sandbox_init_point si estás en modo de pruebas
    exit();
} else {
    // Si no se recibieron los datos por POST, redirige a una página de error o muestra un mensaje
    header('Location: /rifas' ); //se debe cambiar por la des servidor
}
?>
