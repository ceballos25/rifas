<?php
session_start();

// Verifica si la variable de sesión específica está definida
if (!isset($_SESSION['usuario_id'])) {
    // La variable de sesión no está definida, redirige al usuario al índice
    header("Location: ../../dash/");
    exit(); // Asegura que el script se detenga después de redirigir
}
?>;
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard | El día de tu Suerte</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>