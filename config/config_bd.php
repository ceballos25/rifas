<?php
// Función para obtener la conexión a la base de datos
function obtenerConexion() {
    $servername = "127.0.0.1:8080";
    $username = "root";
    $password = "12345";
    $dbname = "rifa_moto";
    $port = 3307;

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Establecer el conjunto de caracteres a utf8 (opcional)
    $conn->set_charset("utf8");

    return $conn;
}
?>
