-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2023 a las 21:56:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techome`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Correo_Cliente` varchar(255) NOT NULL,
  `nombre_Cliente` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `ID_direccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_direccion` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `indicaciones` text DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_aceptado`
--

CREATE TABLE `pedido_aceptado` (
  `ID_pedido` int(11) NOT NULL,
  `nombre_pedido` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ID_solicitud` int(11) DEFAULT NULL,
  `Rut_Trabajador` varchar(15) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `Rut_Trabajador` varchar(15) NOT NULL,
  `nombre_solicitante` varchar(255) DEFAULT NULL,
  `correo_solicitante` varchar(255) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudservicio`
--

CREATE TABLE `solicitudservicio` (
  `ID_solicitud` int(11) NOT NULL,
  `tipo_servicio` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `Correo_Cliente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `Rut_Trabajador` varchar(15) NOT NULL,
  `Nombre_Trabajador` varchar(255) DEFAULT NULL,
  `Correo_Trabajador` varchar(255) DEFAULT NULL,
  `Foto` longblob DEFAULT NULL,
  `Profesion` varchar(255) DEFAULT NULL,
  `Monto_Cuenta` decimal(10,2) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Correo_Cliente`),
  ADD KEY `ID_direccion` (`ID_direccion`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_direccion`);

--
-- Indices de la tabla `pedido_aceptado`
--
ALTER TABLE `pedido_aceptado`
  ADD PRIMARY KEY (`ID_pedido`),
  ADD KEY `ID_solicitud` (`ID_solicitud`),
  ADD KEY `Rut_Trabajador` (`Rut_Trabajador`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`Rut_Trabajador`);

--
-- Indices de la tabla `solicitudservicio`
--
ALTER TABLE `solicitudservicio`
  ADD PRIMARY KEY (`ID_solicitud`),
  ADD KEY `Correo_Cliente` (`Correo_Cliente`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`Rut_Trabajador`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ID_direccion`) REFERENCES `direccion` (`ID_direccion`);

--
-- Filtros para la tabla `pedido_aceptado`
--
ALTER TABLE `pedido_aceptado`
  ADD CONSTRAINT `pedido_aceptado_ibfk_1` FOREIGN KEY (`ID_solicitud`) REFERENCES `solicitudservicio` (`ID_solicitud`),
  ADD CONSTRAINT `pedido_aceptado_ibfk_2` FOREIGN KEY (`Rut_Trabajador`) REFERENCES `trabajador` (`Rut_Trabajador`);

--
-- Filtros para la tabla `solicitudservicio`
--
ALTER TABLE `solicitudservicio`
  ADD CONSTRAINT `solicitudservicio_ibfk_1` FOREIGN KEY (`Correo_Cliente`) REFERENCES `clientes` (`Correo_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
