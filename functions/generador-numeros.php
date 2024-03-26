<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "u794556006_sorteo_01");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Generar una lista de números de cuatro cifras con el relleno de ceros en la parte delantera
$numeros = [];
for ($i = 0; $i <= 9999; $i++) {
    $numero = str_pad($i, 4, '0', STR_PAD_LEFT); // Agregar relleno de ceros
    $numeros[] = $numero;    
}

// Barajar la lista de números
shuffle($numeros);

// Mostrar los números generados en desorden
echo implode(', ', $numeros) . '<br>';

// Insertar los números en la base de datos
foreach ($numeros as $numero) {
    // Insertar el número en la base de datos
    $sql = "INSERT INTO numeros (numero) VALUES ('$numero')";
    if ($conexion->query($sql) !== TRUE) {
        echo "Error al insertar número: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();

//echo "Se han insertado 10,000 números únicos de cuatro cifras en la base de datos en desorden aleatorio con relleno de ceros.";


?>
