-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2023 a las 01:31:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallerintegracion3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Correo_Cliente` char(50) NOT NULL,
  `Nombre_cliente` char(50) DEFAULT NULL,
  `Contraseña` char(50) DEFAULT NULL,
  `ID_Direccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_Direccion` int(11) NOT NULL,
  `Direccion` char(50) DEFAULT NULL,
  `Indicaciones` char(50) DEFAULT NULL,
  `Ciudad` char(50) DEFAULT NULL,
  `Region` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido aceptado`
--

CREATE TABLE `pedido aceptado` (
  `ID_pedido` int(11) NOT NULL,
  `nombre_pedido` char(50) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ID_solicitud` int(11) DEFAULT NULL,
  `Rut_Trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud de trabajo`
--

CREATE TABLE `solicitud de trabajo` (
  `ID_solicitud` int(11) NOT NULL,
  `tipo_servicio` char(50) DEFAULT NULL,
  `descripcion` char(200) DEFAULT NULL,
  `Correo_Cliente` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `Rut_Trabajador` int(11) NOT NULL,
  `Nombre_Trabajador` char(50) DEFAULT NULL,
  `Correo_Trabajador` char(50) DEFAULT NULL,
  `Titulos` char(50) DEFAULT NULL,
  `Foto` char(50) DEFAULT NULL,
  `Profesion` char(50) DEFAULT NULL,
  `Monto_Cuenta` char(50) DEFAULT NULL,
  `Estado` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Correo_Cliente`),
  ADD KEY `ID_Direccion` (`ID_Direccion`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_Direccion`);

--
-- Indices de la tabla `pedido aceptado`
--
ALTER TABLE `pedido aceptado`
  ADD PRIMARY KEY (`ID_pedido`),
  ADD KEY `ID_solicitud` (`ID_solicitud`),
  ADD KEY `Rut_Trabajador` (`Rut_Trabajador`);

--
-- Indices de la tabla `solicitud de trabajo`
--
ALTER TABLE `solicitud de trabajo`
  ADD PRIMARY KEY (`ID_solicitud`),
  ADD KEY `Correo_Cliente` (`Correo_Cliente`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`Rut_Trabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID_Direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido aceptado`
--
ALTER TABLE `pedido aceptado`
  MODIFY `ID_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud de trabajo`
--
ALTER TABLE `solicitud de trabajo`
  MODIFY `ID_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ID_Direccion`) REFERENCES `direccion` (`ID_Direccion`);

--
-- Filtros para la tabla `pedido aceptado`
--
ALTER TABLE `pedido aceptado`
  ADD CONSTRAINT `pedido aceptado_ibfk_1` FOREIGN KEY (`ID_solicitud`) REFERENCES `solicitud de trabajo` (`ID_solicitud`),
  ADD CONSTRAINT `pedido aceptado_ibfk_2` FOREIGN KEY (`Rut_Trabajador`) REFERENCES `trabajadores` (`Rut_Trabajador`);

--
-- Filtros para la tabla `solicitud de trabajo`
--
ALTER TABLE `solicitud de trabajo`
  ADD CONSTRAINT `solicitud de trabajo_ibfk_1` FOREIGN KEY (`Correo_Cliente`) REFERENCES `clientes` (`Correo_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
