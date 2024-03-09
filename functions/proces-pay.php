<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Venta</title>
    <!-- Se incluye la librería SweetAlert2 desde CDN para mostrar alertas atractivas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
// Verifica si los datos han sido enviados mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Accede a los datos del formulario después de escaparlos para prevenir inyecciones SQL y ataques XSS
    $nombre = htmlspecialchars($_POST["nombre"]);
    $cedula = htmlspecialchars($_POST["cedula"]);
    $correo = htmlspecialchars($_POST["correo"]);
    $celular = htmlspecialchars($_POST["celular"]);
    $totalNumeros = htmlspecialchars($_POST["totalNumeros"]);
    
    // Precio unitario de la rifa
    $valorRifa = 5000;

    // Calcula el total a pagar por el usuario
    $totalAPagar = $valorRifa * $totalNumeros;

    // Información de la rifa
    $nombreRifa = "Rifa Moto NS 200 0 KM";
    $descripcionRifa = "Rifa por una Moto 0 KM";

    // Intenta conectar a la base de datos
    require_once "../config/config_bd.php";

    try {
        // Obtiene la conexión a la base de datos
        $conn = obtenerConexion();
        
        // Configuración del script de ePayco
        echo "<script src='https://checkout.epayco.co/checkout.js'></script>
        <script>
            var data = {
                key: '536d47df9ca6b139b8490989e2c6270b',
                name: '$nombreRifa',
                description: '$descripcionRifa',
                amount: '$totalAPagar',
                currency: 'COP',
                country: 'CO',
                external: 'false',
                response: 'http://localhost/rifas/functions/respuesta',
                autoclick: 'true',
                test: 'true',
                type_doc_billing: 'cc',
                x_extra1: '$nombre',
                x_extra2: '$cedula',
                x_extra3: '$correo',
                x_extra4: '$celular',
                x_extra5: '$totalNumeros'
            };

            // Inicializa el checkout de ePayco
            var handler = ePayco.checkout.configure({
                key: '536d47df9ca6b139b8490989e2c6270b',
                test: 'true'
            });

            // Abre el formulario de pago
            handler.open(data);
        </script>";
    } catch (mysqli_sql_exception $ex) {
        // Algo salió mal con la conexión a la base de datos
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Algo Salió mal',
                text: 'Estimado usuario, presentamos inconvenientes, estamos trabajando para restablecer el servicio lo antes posible.',
                confirmButtonText: 'De acuerdo',
                confirmButtonColor: '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.php';
                }
            });
        </script>";
    }
}
?>
</body>
</html>
