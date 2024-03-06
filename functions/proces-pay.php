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

    // Puedes imprimir los valores para debuggear
    echo "Nombre: " . $nombre . "<br>";
    echo "Cedula: " . $cedula . "<br>";
    echo "Correo: " . $correo . "<br>";
    echo "Celular: " . $celular . "<br>";
    echo "Cantidad Boletas: " . $totalNumeros . "<br>";
    echo "Cantidad Boletas: " . $totalAPagar . "<br>";

    // Realiza el procesamiento necesario con los datos recibidos
    // ...

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
            response: 'http://localhost/rifas/functions/respuest.php',
            autoclick: 'true',
            test: 'true',
            name_billing: '$nombre',
            type_doc_billing: 'cc',
       
        };
        
        // Inicializa el checkout de ePayco
        var handler = ePayco.checkout.configure({
            key: '536d47df9ca6b139b8490989e2c6270b',
            test: 'true'
        });

        // Abre el formulario de pago
        handler.open(data);
    </script>";
} else {
    // Si no se recibe una solicitud POST, muestra un mensaje de error
    echo "<script>alert('Error en la solicitud');</script>";
}
?>
