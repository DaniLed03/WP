-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2024 a las 11:18:49
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
-- Base de datos: `poder_judicial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estatus`
--

CREATE TABLE `cat_estatus` (
  `ID_ESTATUS` int(11) NOT NULL,
  `ESTATUS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipoasunto`
--

CREATE TABLE `cat_tipoasunto` (
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `TIPOASUNTO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_tipoasunto`
--

INSERT INTO `cat_tipoasunto` (`ID_TIPOASUNTO`, `TIPOASUNTO`) VALUES
(0, 'Sin especificar'),
(1, 'Amparo indirecto'),
(2, 'Causa penal'),
(3, 'Procesos civiles o administrativos'),
(4, 'Medidas precautorias'),
(5, 'Procedimientos de extradición'),
(6, 'Varios'),
(7, 'Amparo indirecto, causa penal, juicios civiles y administrativos'),
(8, 'Comunicaciones oficiales enviadas'),
(9, 'Comunicaciones oficiales recibidas'),
(10, 'Comunicaciones oficiales recibidas de las áreas del CJF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipocomunicacion`
--

CREATE TABLE `cat_tipocomunicacion` (
  `ID_TIPOCOMUNICACION` int(11) NOT NULL,
  `TIPOCOMUNICACION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipocuaderno`
--

CREATE TABLE `cat_tipocuaderno` (
  `ID_TIPOCUADERNO` int(11) NOT NULL,
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `TIPOCUADERNO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_valoracion`
--

CREATE TABLE `cat_valoracion` (
  `ID_VALORACION` int(11) NOT NULL,
  `VALORACION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadernos`
--

CREATE TABLE `cuadernos` (
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `NOEXPEDIENTE` varchar(255) NOT NULL,
  `ID_TIPOCUADERNO` int(11) NOT NULL,
  `ID_TIPOCOMUNICACION` int(11) NOT NULL,
  `AÑO` int(11) NOT NULL,
  `EXPEDIENTE` int(11) NOT NULL,
  `CANT_TOMOS` int(11) NOT NULL,
  `CANT_ANEXOS` int(11) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `FECHA_ARCHIVO` date NOT NULL,
  `FECHA_REMISION` date NOT NULL,
  `FECHA_RECEPCION` date NOT NULL,
  `ID_VALORACION` int(11) NOT NULL,
  `FECHA_ACTA` date NOT NULL,
  `OBSERVACIONES` text NOT NULL,
  `ESTATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_prestamo`
--

CREATE TABLE `det_prestamo` (
  `ID_SOLPRESTAMO` int(11) NOT NULL,
  `NO_REGISTRO` int(11) NOT NULL,
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `NOEXPEDIENTE` text NOT NULL,
  `EXPEDIENTE` int(11) NOT NULL,
  `AÑO` int(11) NOT NULL,
  `ID_TIPOCUADERNO` int(11) NOT NULL,
  `TOMOS` int(11) NOT NULL,
  `ANEXOS` int(11) NOT NULL,
  `IDPER_RECIBE_PRES` int(11) NOT NULL,
  `IDPER_ENTREGA_PRES` int(11) NOT NULL,
  `FECHA_SALIDA` date NOT NULL,
  `IDPER_ENTREG_DEV` int(11) NOT NULL,
  `IDPER_RECIBE_DEV` int(11) NOT NULL,
  `FECHA_DEVOLUCION` date NOT NULL,
  `OBSERVACIONES` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `NOEXPEDIENTE` varchar(255) NOT NULL,
  `NUN_ORDEN` text NOT NULL,
  `AÑO` int(11) NOT NULL,
  `EXPEDIENTE` int(11) NOT NULL,
  `PERSONA` text NOT NULL,
  `MESA` text NOT NULL,
  `SECRETARIO` text NOT NULL,
  `OBSERVACIONES` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sol_prestamo`
--

CREATE TABLE `sol_prestamo` (
  `ID_SOLPRESTAMO` int(11) NOT NULL,
  `FECHA_PRESTAMO` date NOT NULL,
  `ID_TIPOASUNTO` int(11) NOT NULL,
  `NOEXPEDIENTE` text NOT NULL,
  `ID_PERSONA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuarios` int(11) NOT NULL,
  `NO_EXP` int(50) NOT NULL,
  `Nombres` text NOT NULL,
  `Apellido_Paterno` text NOT NULL,
  `Apellido_Materno` text NOT NULL,
  `CARGO` text NOT NULL,
  `Edad` int(11) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Direccion` text NOT NULL,
  `Sexo` int(11) NOT NULL,
  `Nom_Usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `Rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuarios`, `NO_EXP`, `Nombres`, `Apellido_Paterno`, `Apellido_Materno`, `CARGO`, `Edad`, `Fecha_Nacimiento`, `Direccion`, `Sexo`, `Nom_Usuario`, `contrasena`, `Rol`) VALUES
(19, 0, 'DANIEL ARMANDO', 'LEDEZMA', 'DONJUAN', 'DESARROLLADOR DE SISTEMAS', 20, '2003-07-01', 'Calle Lomas de la Hacienda', 0, 'admin', 'admin', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_tipoasunto`
--
ALTER TABLE `cat_tipoasunto`
  ADD PRIMARY KEY (`ID_TIPOASUNTO`);

--
-- Indices de la tabla `cat_tipocomunicacion`
--
ALTER TABLE `cat_tipocomunicacion`
  ADD PRIMARY KEY (`ID_TIPOCOMUNICACION`);

--
-- Indices de la tabla `cat_tipocuaderno`
--
ALTER TABLE `cat_tipocuaderno`
  ADD PRIMARY KEY (`ID_TIPOCUADERNO`);

--
-- Indices de la tabla `cat_valoracion`
--
ALTER TABLE `cat_valoracion`
  ADD PRIMARY KEY (`ID_VALORACION`);

--
-- Indices de la tabla `cuadernos`
--
ALTER TABLE `cuadernos`
  ADD PRIMARY KEY (`ID_TIPOASUNTO`,`NOEXPEDIENTE`,`ID_TIPOCUADERNO`),
  ADD KEY `fk_cuadernos_tipocuaderno` (`ID_TIPOCUADERNO`),
  ADD KEY `fk_cuadernos_tipocomunicacion` (`ID_TIPOCOMUNICACION`),
  ADD KEY `fk_cuadernos_valoracion` (`ID_VALORACION`);

--
-- Indices de la tabla `det_prestamo`
--
ALTER TABLE `det_prestamo`
  ADD PRIMARY KEY (`ID_SOLPRESTAMO`,`NO_REGISTRO`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`ID_TIPOASUNTO`,`NOEXPEDIENTE`);

--
-- Indices de la tabla `sol_prestamo`
--
ALTER TABLE `sol_prestamo`
  ADD PRIMARY KEY (`ID_SOLPRESTAMO`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cat_tipoasunto`
--
ALTER TABLE `cat_tipoasunto`
  ADD CONSTRAINT `cat_tipoasunto_ibfk_1` FOREIGN KEY (`ID_TIPOASUNTO`) REFERENCES `expedientes` (`ID_TIPOASUNTO`);

--
-- Filtros para la tabla `cuadernos`
--
ALTER TABLE `cuadernos`
  ADD CONSTRAINT `fk_cuadernos_tipoasunto` FOREIGN KEY (`ID_TIPOASUNTO`) REFERENCES `cat_tipoasunto` (`ID_TIPOASUNTO`),
  ADD CONSTRAINT `fk_cuadernos_tipocomunicacion` FOREIGN KEY (`ID_TIPOCOMUNICACION`) REFERENCES `cat_tipocomunicacion` (`ID_TIPOCOMUNICACION`),
  ADD CONSTRAINT `fk_cuadernos_tipocuaderno` FOREIGN KEY (`ID_TIPOCUADERNO`) REFERENCES `cat_tipocuaderno` (`ID_TIPOCUADERNO`),
  ADD CONSTRAINT `fk_cuadernos_valoracion` FOREIGN KEY (`ID_VALORACION`) REFERENCES `cat_valoracion` (`ID_VALORACION`);

--
-- Filtros para la tabla `det_prestamo`
--
ALTER TABLE `det_prestamo`
  ADD CONSTRAINT `fk_det_prestamo_sol_prestamo` FOREIGN KEY (`ID_SOLPRESTAMO`) REFERENCES `sol_prestamo` (`ID_SOLPRESTAMO`);

--
-- Filtros para la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD CONSTRAINT `expedientes_ibfk_1` FOREIGN KEY (`ID_TIPOASUNTO`) REFERENCES `cuadernos` (`ID_TIPOASUNTO`),
  ADD CONSTRAINT `fk_expedientes_tipoasunto` FOREIGN KEY (`ID_TIPOASUNTO`) REFERENCES `cat_tipoasunto` (`ID_TIPOASUNTO`);

--
-- Filtros para la tabla `sol_prestamo`
--
ALTER TABLE `sol_prestamo`
  ADD CONSTRAINT `sol_prestamo_ibfk_1` FOREIGN KEY (`ID_SOLPRESTAMO`) REFERENCES `det_prestamo` (`ID_SOLPRESTAMO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
