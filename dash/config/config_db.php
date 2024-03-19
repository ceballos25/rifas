<?php
// Función para obtener la conexión a la base de datos
function obtenerConexion() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rifa_moto";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Establecer el conjunto de caracteres a utf8 (opcional)
    $conn->set_charset("utf8");

    return $conn;
}
?>