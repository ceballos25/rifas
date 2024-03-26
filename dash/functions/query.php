<?php

// Función para obtener el total de números vendidos
function obtenerTotalNumerosVendidos($conn) {
    $sql = 'SELECT COUNT(*) as numeros_vendidos FROM numeros_vendidos';
    $resultado = $conn->query($sql);
    return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['numeros_vendidos'] : 0;
}

// Función para obtener el total de dinero vendido
function obtenerTotalVendido($conn) {
    $sql = "SELECT SUM(total_pagado) as total_pagado FROM ventas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['total_pagado'] : 0;
}

// Función para obtener la cantidad de clientes, verificando que solo esté una vez la cédula
function obtenerTotalClientes($conn) {
    $sql = "SELECT COUNT(DISTINCT cedula_cliente) AS total_clientes FROM ventas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['total_clientes'] : 0;
}



// Función para obtener los clientes con más numeros vendidos
function obtenerClientes($conn) {
    $sql = "SELECT nombre_cliente, cedula_cliente, correo_cliente, celular_cliente, departamento, ciudad, total_numeros, total_pagado FROM ventas GROUP BY cedula_cliente ORDER BY total_numeros DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $clientes = array();
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $clientes[] = $fila;
        }
    }
    return $clientes;
}

// Función para obtener los clientes con más ventas
function obtenerClientesConMasVentas($conn, $limite = 10) {
    $sql = "SELECT nombre_cliente, cedula_cliente, SUM(total_numeros) AS total_numeros
    FROM ventas
    GROUP BY cedula_cliente
    ORDER BY total_numeros DESC
    LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limite);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $clientes = array();
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $clientes[] = $fila;
        }
    }
    return $clientes;
}


// Función para obtener las 10 ciudades con más ventas
function obtenerCiudadesMasVendidas($conn) {
    $sql = "SELECT ciudad, COUNT(*) AS total_ventas 
            FROM ventas 
            GROUP BY ciudad 
            ORDER BY total_ventas DESC 
            LIMIT 10";
    $resultado = $conn->query($sql);
    $ciudades = array();
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $ciudades[] = $fila;
        }
    }
    return $ciudades;
}



// Función para obtener el número de ventas por sorteo
function obtenerVentasSorteo($conn) {
    $sql = "SELECT codigo_sorteo, COUNT(*) AS total_ventas_sorteo
            FROM ventas 
            GROUP BY codigo_sorteo 
            ORDER BY total_ventas_sorteo DESC";
    $resultado = $conn->query($sql);
    $ventasPorSorteo = array(); // Inicializa el array para almacenar los datos de ventas por sorteo

    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $ventasPorSorteo[] = $fila; // Almacena cada fila en el array
        }
    }

    return $ventasPorSorteo;
}


?>
