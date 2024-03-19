<?php


    //funcionn para obtener el total de numeros vendidos
    function obtenerTotalNumerosVendidos($conn) {
        $sql = 'SELECT SUM(total_numeros) AS suma_total_numeros_vendidos FROM ventas;';
        $resultado = $conn->query($sql);
        return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['suma_total_numeros_vendidos'] : 0;
    }

    //funcionn para obtener el total de dinero vendido
    function obtenerTotalVendido($conn) {
        $sql = "SELECT SUM(total) AS total_vendido FROM ventas WHERE respuesta = 'Aceptada'";
        $resultado = $conn->query($sql);
        return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['total_vendido'] : 0;
    }

    //funcionn para obtener la cantidad de clientes, verifica que solo esté una vez la cédula
    function obtenerTotalClientes($conn) {
        $sql = "SELECT COUNT(DISTINCT cedula_cliente) AS total_clientes FROM ventas";
        $resultado = $conn->query($sql);
        return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc()['total_clientes'] : 0;
    }

    function obtenerClientes($conn) {
        $sql = "SELECT nombre_cliente, cedula_cliente, correo_cliente, celular_cliente, departamento, ciudad FROM ventas GROUP BY cedula_cliente HAVING COUNT(cedula_cliente) <= 2";
        $resultado = $conn->query($sql);
        $clientes = array(); // Inicializar un array para almacenar los resultados
        
        // Verificar si la consulta se ejecutó correctamente
        if ($resultado && $resultado->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array
            while ($fila = $resultado->fetch_assoc()) {
                $clientes[] = $fila;
            }
        }
    
        return $clientes;
    }
    

// Función para obtener las ventas de los últimos 6 meses
function obtenerVentasUltimosSeisMeses($conn) {
    $sql = "SELECT DATE_FORMAT(fecha_transaccion, '%d/%m/%Y %H:%i') AS fecha, total
            FROM ventas
            WHERE fecha_transaccion >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
            ORDER BY fecha_transaccion ASC";
    $resultado = $conn->query($sql);
    $ventas = array(); // Inicializar un array para almacenar los resultados

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado && $resultado->num_rows > 0) {
        // Recorrer los resultados y almacenarlos en el array
        while ($fila = $resultado->fetch_assoc()) {
            $ventas[] = $fila;
        }
    }

    return $ventas;
}    