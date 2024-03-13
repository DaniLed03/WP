-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 10:15:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carros`
--

CREATE TABLE `carros` (
  `id_carro` int(11) NOT NULL,
  `no_serie` int(11) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `submarca` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `capacidad` int(10) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `procedencia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carros`
--

INSERT INTO `carros` (`id_carro`, `no_serie`, `marca`, `submarca`, `tipo`, `modelo`, `color`, `capacidad`, `año`, `procedencia`) VALUES
(13, 1213, 'CHEVROLET', 'MALIBU', 'CARRO', '2000', 'NEGRO', 5, 2002, 'GUERRERO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_servicios`
--

CREATE TABLE `entrada_servicios` (
  `id_entrada` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `total_pagar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrada_servicios`
--

INSERT INTO `entrada_servicios` (`id_entrada`, `id_carro`, `fecha_ingreso`, `id_servicio`, `total_pagar`) VALUES
(33, 13, '2024-03-11', 2, 1200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre`, `costo`) VALUES
(2, 'Reparación de Clima', 1200.00),
(4, 'Reparación de Mofle', 500.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_carro`),
  ADD UNIQUE KEY `no_serie` (`no_serie`);

--
-- Indices de la tabla `entrada_servicios`
--
ALTER TABLE `entrada_servicios`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entrada_carro` (`id_carro`),
  ADD KEY `fk_entrada_servicio` (`id_servicio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carros`
--
ALTER TABLE `carros`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `entrada_servicios`
--
ALTER TABLE `entrada_servicios`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada_servicios`
--
ALTER TABLE `entrada_servicios`
  ADD CONSTRAINT `fk_entrada_carro` FOREIGN KEY (`id_carro`) REFERENCES `carros` (`id_carro`),
  ADD CONSTRAINT `fk_entrada_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
