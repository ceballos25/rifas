-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2024 a las 02:39:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rifa_moto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_vendidos`
--

CREATE TABLE `numeros_vendidos` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `numero` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `numeros_vendidos`
--

INSERT INTO `numeros_vendidos` (`id`, `id_venta`, `numero`) VALUES
(39712, 36, '7231'),
(39713, 36, '1565');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `referencia_pago` varchar(50) NOT NULL,
  `id_ref_payco` varchar(255) NOT NULL,
  `respuesta` varchar(20) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `banco` varchar(255) NOT NULL,
  `recibo` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `fecha_transaccion` datetime NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `cedula_cliente` varchar(15) NOT NULL,
  `correo_cliente` varchar(255) NOT NULL,
  `celular_cliente` varchar(11) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `total_numeros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `referencia_pago`, `id_ref_payco`, `respuesta`, `motivo`, `banco`, `recibo`, `total`, `fecha_transaccion`, `nombre_cliente`, `cedula_cliente`, `correo_cliente`, `celular_cliente`, `departamento`, `ciudad`, `total_numeros`) VALUES
(36, '198923779', 'a7a5be60c3c62ff67655bc13', 'Aceptada', 'Aprobada', 'BANCO DE PRUEBAS', '198923779', '10000', '2024-03-16 20:32:01', 'Cristian Camilo Ceballos Marin', '1007581003', 'CEBALLOSMARINCRISTIANCAMILO@GMAIL.COM', '3245894268', 'Antioquia', 'Medellín', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `numeros_vendidos`
--
ALTER TABLE `numeros_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_ref_payco` (`id_ref_payco`),
  ADD UNIQUE KEY `referencia_pago` (`referencia_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `numeros_vendidos`
--
ALTER TABLE `numeros_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39714;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `numeros_vendidos`
--
ALTER TABLE `numeros_vendidos`
  ADD CONSTRAINT `numeros_vendidos_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
