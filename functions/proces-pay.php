<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
// Verifica si los datos han sido enviados mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Accede a los datos del formulario después de escaparlos
    $nombre = htmlspecialchars($_POST["nombre"]);
    $cedula = htmlspecialchars($_POST["cedula"]);
    $correo = htmlspecialchars($_POST["correo"]);
    $celular = htmlspecialchars($_POST["celular"]);
    $totalNumeros = htmlspecialchars($_POST["totalNumeros"]);
    $valorRifa = 5000;

    $totalAPagar = $valorRifa * $totalNumeros;
    $nombreRifa = "Rifa Moto NS 200 0 KM";
    $descripcionRifa = "Rifa por una Moto 0 KM ";

    // Procedemos a consultar la conexión a bd
    require_once "../config/config_bd.php";

    try {
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
                response: 'http://localhost/rifas/functions/respuesta.php',
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

