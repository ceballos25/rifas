<?php

// Supongamos que tu variable entera es $numero
$numero = 10; // Puedes reemplazar esto con el valor de tu variable

// Generar $numero cantidad de números aleatorios de 4 dígitos
for ($i = 0; $i < $numero; $i++) {
    $numero_aleatorio = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    echo $numero_aleatorio . "<br>";
}
?>