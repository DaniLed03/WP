-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2024 a las 05:25:05
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
-- Base de datos: `universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `materias_asignadas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `matricula`, `nombre`, `edad`, `email`, `id_carrera`, `materias_asignadas`) VALUES
(1, '2130147', 'LUCERO', 12, '2130147@upv.edu.mx', 6, 0),
(2, '2130147', 'DAVID', 27, '2130147@upv.edu.mx', 8, 0),
(4, '2130147', 'DANIEL', 12, '2130147@upv.edu.mx', 6, 0),
(5, '2130147', 'DANIEL', 12, '2130147@upv.edu.mx', 7, 0),
(7, '2130149', 'ARYLU', 25, 'daniel.ledezmadon@gmail.com', 8, 0),
(9, '2130149', 'DIEGO', 22, '2130149@upv.edu.mx', 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_materias_alumno`
--

CREATE TABLE `asignacion_materias_alumno` (
  `id_asignacion` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacion_materias_alumno`
--

INSERT INTO `asignacion_materias_alumno` (`id_asignacion`, `id_alumno`, `id_materia`) VALUES
(15, 1, 2),
(16, 1, 3),
(17, 1, 4),
(18, 1, 5),
(19, 1, 6),
(20, 1, 7),
(21, 2, 2),
(22, 2, 3),
(23, 2, 4),
(24, 2, 5),
(25, 2, 9),
(26, 2, 11),
(32, 9, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_materias_carrera`
--

CREATE TABLE `asignacion_materias_carrera` (
  `id_asignacion` int(11) NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacion_materias_carrera`
--

INSERT INTO `asignacion_materias_carrera` (`id_asignacion`, `id_carrera`, `id_materia`) VALUES
(1, 6, 2),
(2, 6, 3),
(3, 6, 4),
(4, 6, 5),
(5, 6, 6),
(6, 6, 7),
(10, 6, 11),
(11, 6, 12),
(12, 8, 2),
(13, 8, 3),
(14, 8, 4),
(15, 8, 5),
(16, 8, 6),
(17, 8, 7),
(18, 8, 8),
(19, 8, 9),
(20, 8, 11),
(21, 8, 12),
(22, 13, 2),
(23, 13, 3),
(24, 13, 4),
(25, 13, 11),
(26, 13, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `calificacion` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `id_alumno`, `id_materia`, `calificacion`) VALUES
(53, 1, 2, 100.00),
(54, 1, 3, 99.00),
(55, 1, 4, 99.00),
(56, 1, 5, 78.00),
(57, 1, 6, 99.00),
(58, 1, 7, 99.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre`, `id_materia`) VALUES
(6, 'MECATRONICA', NULL),
(7, 'ITI', NULL),
(8, 'LAYGE', NULL),
(13, 'PLASTICOS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`) VALUES
(2, 'Electricidad'),
(3, 'Redes'),
(4, 'Español'),
(5, 'Web'),
(6, 'Magnetismo'),
(7, 'Liderazgo'),
(8, 'Automatas'),
(9, 'Expresion Oral y Escrita'),
(11, 'Ingles'),
(12, 'POO'),
(13, 'Transformación de Plasticos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `asignacion_materias_alumno`
--
ALTER TABLE `asignacion_materias_alumno`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `asignacion_materias_carrera`
--
ALTER TABLE `asignacion_materias_carrera`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `asignacion_materias_alumno`
--
ALTER TABLE `asignacion_materias_alumno`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `asignacion_materias_carrera`
--
ALTER TABLE `asignacion_materias_carrera`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `asignacion_materias_alumno`
--
ALTER TABLE `asignacion_materias_alumno`
  ADD CONSTRAINT `fk_id_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_materia` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignacion_materias_carrera`
--
ALTER TABLE `asignacion_materias_carrera`
  ADD CONSTRAINT `asignacion_materias_carrera_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`),
  ADD CONSTRAINT `asignacion_materias_carrera_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`);

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
