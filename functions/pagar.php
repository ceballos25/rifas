<?php
// Incluye el archivo autoload.php del SDK de Mercado Pago
require_once '../vendor/autoload.php';

// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $opciones_boletas = $_POST['opciones_boletas'];
    $otroInput = $_POST['otroInput']; // Puede ser nulo si no se selecciona "Otro"

    $totalNumeros = htmlspecialchars($_POST["totalNumeros"]);
    
    // Precio unitario de la rifa
    $valorRifa = 6000;

    // Calcula el total a pagar por el usuario
    $totalAPagar = $valorRifa * $totalNumeros;

    // Configura las credenciales de acceso
    MercadoPago\SDK::setAccessToken("TEST-6079703177078537-031923-02b6d4677ef29cefa763e3b9f772a70a-710691567");

    // Crea una preferencia de pago
    $preference = new MercadoPago\Preference();
    
    // Crea un artículo para la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Producto';
    $item->quantity = 1;
    $item->unit_price = $totalAPagar; // Utiliza el total a pagar recibido del formulario

    // Agrega el artículo a la preferencia
    $preference->items = array($item);

    // Define los métodos de pago permitidos y sus condiciones de disponibilidad
    $preference->payment_methods = array(
        "excluded_payment_methods" => array(),
        "excluded_payment_types" => array(),
        "installments" => 6
    );


    // Guarda la preferencia en Mercado Pago
    $preference->save();

    // Redirige al usuario a la página de pago de Mercado Pago
    header('Location: ' . $preference->sandbox_init_point); // Utiliza sandbox_init_point si estás en modo de pruebas
    exit();
} else {
    // Si no se recibieron los datos por POST, redirige a una página de error o muestra un mensaje
    echo "Error: No se recibieron los datos del formulario.";
}
?>
