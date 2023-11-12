-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 21:23:20
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `Rut_administrador` varchar(255) NOT NULL,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `Contraseña_Administrador` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`Rut_administrador`, `nombre_completo`, `cargo`, `Contraseña_Administrador`) VALUES
('11345678-9', 'Administrador Uno', 'RRHH', 'contraseñarh'),
('26456769-0', 'Administrador Dos', 'Jefe', 'contraseñafe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciac`
--

CREATE TABLE `asistenciac` (
  `ID_AsistenciaC` int(11) NOT NULL,
  `ID_cliente` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistenciac`
--

INSERT INTO `asistenciac` (`ID_AsistenciaC`, `ID_cliente`, `nombre`, `correo`, `mensaje`, `fecha`) VALUES
(3, 0, 'Cliente Uno', 'cliente1@example.com', 'gfh', NULL),
(6, 1, 'Cliente Uno', 'cliente1@example.com', 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciat`
--

CREATE TABLE `asistenciat` (
  `ID_AsistenciaT` int(11) NOT NULL,
  `Rut_trabajador` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistenciat`
--

INSERT INTO `asistenciat` (`ID_AsistenciaT`, `Rut_trabajador`, `nombre`, `correo`, `mensaje`, `fecha`) VALUES
(3, '', 'Trabajador Siete', 'trabajador7@example.com', 'pacman', NULL),
(4, '', 'Trabajador Siete', 'trabajador7@example.com', 'lincol\r\n', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `Correo_Cliente` varchar(255) DEFAULT NULL,
  `nombre_Cliente` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `ID_direccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_cliente`, `Correo_Cliente`, `nombre_Cliente`, `contraseña`, `ID_direccion`) VALUES
(1, 'cliente1@example.com', 'Cliente Uno', '1contraseña', 1),
(2, 'cliente2@example.com', 'Cliente Dos', 'contraseña2', 2),
(3, 'cliente3@example.com', 'Cliente Tres', 'contraseña3', 3),
(4, 'cliente4@example.com', 'Cliente Cuatro', 'contraseña4', 4),
(5, 'cliente5@example.com', 'Cliente Cinco', 'contraseña5', 5),
(6, 'cliente6@example.com', 'Cliente Seis', 'contraseña6', 6),
(7, 'cliente7@example.com', 'Cliente Siete', 'contraseña7', 7),
(8, 'cliente8@example.com', 'Cliente Ocho', 'contraseña8', 8),
(9, 'cliente9@example.com', 'Cliente Nueve', 'contraseña9', 9),
(10, 'cliente10@example.com', 'Cliente Diez', 'contraseña10', 10),
(11, 'cliente11@example.com', 'Cliente Once', 'contraseña11', 11),
(12, 'cliente12@example.com', 'Cliente Doce', 'contraseña12', 12),
(13, 'cliente13@example.com', 'Cliente Trece', 'contraseña13', 13),
(14, 'cliente14@example.com', 'Cliente Catorce', 'contraseña14', 14),
(15, 'cliente15@example.com', 'Cliente Quince', 'contraseña15', 15),
(16, 'cliente16@example.com', 'Cliente Dieciséis', 'contraseña16', 16),
(17, 'cliente17@example.com', 'Cliente Diecisiete', 'contraseña17', 17),
(18, 'cliente18@example.com', 'Cliente Dieciocho', 'contraseña18', 18),
(19, 'cliente19@example.com', 'Cliente Diecinueve', 'contraseña19', 19),
(20, 'cliente20@example.com', 'Cliente Veinte', 'contraseña20', 20),
(21, 'cliente21@example.com', 'Cliente Veintiuno', 'contraseña21', 21),
(22, 'cliente22@example.com', 'Cliente Veintidós', 'contraseña22', 22),
(23, 'cliente23@example.com', 'Cliente Veintitrés', 'contraseña23', 23),
(24, 'cliente24@example.com', 'Cliente Veinticuatro', 'contraseña24', 24),
(25, 'cliente25@example.com', 'Cliente Veinticinco', 'contraseña25', 25),
(26, 'cliente26@example.com', 'Cliente Veintiséis', 'contraseña26', 26),
(27, 'cliente27@example.com', 'Cliente Veintisiete', 'contraseña27', 27),
(28, 'cliente28@example.com', 'Cliente Veintiocho', 'contraseña28', 28),
(29, 'cliente29@example.com', 'Cliente Veintinueve', 'contraseña29', 29),
(30, 'cliente30@example.com', 'Cliente Treinta', 'contraseña30', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_direccion` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `indicaciones` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`ID_direccion`, `direccion`, `indicaciones`, `ciudad`, `region`) VALUES
(1, 'Calle 1, 123', 'Casa Azul', 'Santiago', 'Metropolitana'),
(2, 'Avenida 2, 456', 'Edificio B', 'Valparaíso', 'Valparaíso'),
(3, 'Camino 3, 789', 'Apartamento', 'Concepción', 'Biobío'),
(4, 'Plaza 4, 1010', 'Oficina 1', 'Antofagasta', 'Antofagasta'),
(5, 'Pasaje 5, 1111', 'Departamento', 'La Serena', 'Coquimbo'),
(6, 'Carretera 6, 1313', 'Casa Blanca', 'Iquique', 'Tarapacá'),
(7, 'Ruta 7, 1515', 'Piso 2', 'Rancagua', 'O\'Higgins'),
(8, 'Autopista 8, 1717', 'Torre C', 'Talca', 'Maule'),
(9, 'Paseo 9, 1919', 'Casa Amarilla', 'Temuco', 'La Araucanía'),
(10, 'Boulevard 10, 2020', 'Chalet D', 'Arica', 'Arica y Parinacota'),
(11, 'Alameda 11, 2121', 'Casa Verde', 'Copiapó', 'Atacama'),
(12, 'Avenida 12, 2222', 'Apartamento', 'Puerto Montt', 'Los Lagos'),
(13, 'Camino 13, 2323', 'Oficina 3', 'Iquique', 'Tarapacá'),
(14, 'Calle 14, 2424', 'Piso 3', 'La Serena', 'Coquimbo'),
(15, 'Avenida 15, 2525', 'Departamento', 'Valparaíso', 'Valparaíso'),
(16, 'Carretera 16, 2626', 'Casa Blanca', 'Antofagasta', 'Antofagasta'),
(17, 'Plaza 17, 2727', 'Edificio A', 'Concepción', 'Biobío'),
(18, 'Pasaje 18, 2828', 'Chalet B', 'Rancagua', 'O\'Higgins'),
(19, 'Ruta 19, 2929', 'Piso 1', 'Santiago', 'Metropolitana'),
(20, 'Autopista 20, 3030', 'Torre D', 'Temuco', 'La Araucanía'),
(21, 'Paseo 21, 3131', 'Casa Roja', 'Talca', 'Maule'),
(22, 'Boulevard 22, 3232', 'Apartamento', 'Arica', 'Arica y Parinacota'),
(23, 'Alameda 23, 3333', 'Oficina 2', 'Copiapó', 'Atacama'),
(24, 'Avenida 24, 3434', 'Casa Gris', 'Puerto Montt', 'Los Lagos'),
(25, 'Camino 25, 3535', 'Edificio C', 'La Serena', 'Coquimbo'),
(26, 'Calle 26, 3636', 'Piso 4', 'Iquique', 'Tarapacá'),
(27, 'Avenida 27, 3737', 'Departamento', 'Rancagua', 'O\'Higgins'),
(28, 'Carretera 28, 3838', 'Casa Blanca', 'Valparaíso', 'Valparaíso'),
(29, 'Plaza 29, 3939', 'Chalet A', 'Antofagasta', 'Antofagasta'),
(30, 'Pasaje 30, 4040', 'Torre B', 'Concepción', 'Biobío');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_aceptado`
--

CREATE TABLE `pedido_aceptado` (
  `ID_pedido` int(11) NOT NULL,
  `nombre_pedido` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `calificacion` int(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ID_solicitud` int(11) DEFAULT NULL,
  `Rut_Trabajador` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido_aceptado`
--

INSERT INTO `pedido_aceptado` (`ID_pedido`, `nombre_pedido`, `precio`, `calificacion`, `fecha`, `ID_solicitud`, `Rut_Trabajador`, `estado`) VALUES
(1, 'Reparación de tuberías en el baño', '100.00', 5, '2023-10-20', 1, '43434343-4', 'finalizado'),
(2, 'Instalación de sistema eléctrico en la cocina', '150.00', NULL, '2023-10-21', 2, '54545454-5', 'trabajando'),
(3, 'Construcción de mesa de madera para el jardín', '200.00', NULL, '2023-10-22', 3, '65656565-6', 'finalizado'),
(4, 'Reparación de motor de automóvil', '120.00', NULL, '2023-10-23', 4, '76767676-7', 'en camino'),
(5, 'Desarrollo de software de gestión de inventario', '180.00', NULL, '2023-10-24', 5, '87878787-8', 'trabajando'),
(6, 'Mantenimiento de jardín delantero', '90.00', NULL, '2023-10-25', 6, '98989898-9', 'finalizado'),
(7, 'Instalación de sistema de gas en la cocina', '160.00', NULL, '2023-10-26', 7, NULL, 'en camino'),
(8, 'Reparación de silla de madera antigua', '220.00', NULL, '2023-10-27', 8, '12121212-2', 'trabajando'),
(9, 'Mantenimiento de motor de motocicleta', '130.00', NULL, '2023-10-28', 9, '13131313-3', 'finalizado'),
(10, 'Reparación de puerta de ropero', '170.00', NULL, '2023-10-29', 10, '14141414-4', 'en camino'),
(11, 'Chequeo de sistema de agua potable', '110.00', NULL, '2023-10-30', 11, '15151515-5', 'trabajando'),
(12, 'Desarrollo de aplicación web para empresa', '160.00', NULL, '2023-10-31', 12, NULL, 'finalizado'),
(13, 'Diseño de muebles modernos para sala', '210.00', NULL, '2023-11-01', 13, NULL, 'en camino'),
(14, 'Chequeo de redes informáticas', '170.00', NULL, '2023-11-02', 14, '18181818-8', 'trabajando'),
(15, 'Diseño de paisajismo para jardín', '190.00', NULL, '2023-11-03', 15, '19191919-9', 'finalizado'),
(16, 'Reparación de grifo del baño', '95.00', NULL, '2023-11-04', 16, '20202020-0', 'en camino'),
(17, 'Construcción de armario para habitación', '150.00', NULL, '2023-11-05', 17, '21212121-1', 'trabajando'),
(18, 'Mantenimiento de motores diesel', '200.00', NULL, '2023-11-06', 18, '22222222-2', 'finalizado'),
(19, 'Reparación de motor marino', '140.00', NULL, '2023-11-07', 19, NULL, 'en camino'),
(20, 'Instalación de sistema de calefacción', '180.00', NULL, '2023-11-08', 20, '24242424-4', 'trabajando'),
(21, 'Instalación de sistema de riego automático', '120.00', NULL, '2023-11-09', 21, '25252525-5', 'finalizado'),
(22, 'Desarrollo de aplicación móvil para comercio', '170.00', NULL, '2023-11-10', 22, '26262626-6', 'en camino'),
(23, 'Reparación de escape de automóvil', '220.00', NULL, '2023-11-11', 23, '27272727-7', 'trabajando'),
(24, 'Mantenimiento de sistemas de alcantarillado', '180.00', NULL, '2023-11-12', 24, '28282828-8', 'finalizado'),
(25, 'Restauración de muebles antiguos', '200.00', NULL, '2023-11-13', 25, '29292929-9', 'en camino'),
(26, 'Desarrollo de software empresarial', '100.00', NULL, '2023-11-14', 26, '30303030-0', 'trabajando'),
(27, 'Reparación de sistemas de fontanería', '160.00', NULL, '2023-11-15', 27, '31313131-1', 'finalizado'),
(28, 'Construcción de muebles a medida', '120.00', NULL, '2023-11-16', 28, '32323232-2', 'en camino'),
(29, 'Desarrollo de aplicaciones web', '180.00', NULL, '2023-11-17', 29, '33333333-3', 'trabajando'),
(30, 'Mantenimiento de jardines', '190.00', NULL, '2023-11-18', 30, '34343434-4', 'finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `Rut_solicitante` varchar(255) NOT NULL,
  `nombre_solicitante` varchar(255) DEFAULT NULL,
  `correo_solicitante` varchar(255) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`Rut_solicitante`, `nombre_solicitante`, `correo_solicitante`, `profesion`) VALUES
('10101010-0', 'Solicitante Uno', 'solicitante1@example.com', 'mecanico'),
('11111111-1', 'Solicitante Diez', 'solicitante10@example.com', 'informatico'),
('12121212-2', 'Solicitante Once', 'solicitante11@example.com', 'gasfiter'),
('13131313-3', 'Solicitante Doce', 'solicitante12@example.com', 'carpintero'),
('14141414-4', 'Solicitante Trece', 'solicitante13@example.com', 'mecanico'),
('15151515-5', 'Solicitante Catorce', 'solicitante14@example.com', 'informatico'),
('16161616-6', 'Solicitante Quince', 'solicitante15@example.com', 'gasfiter'),
('17171717-7', 'Solicitante Dieciséis', 'solicitante16@example.com', 'carpintero'),
('18181818-8', 'Solicitante Diecisiete', 'solicitante17@example.com', 'mecanico'),
('19191919-9', 'Solicitante Dieciocho', 'solicitante18@example.com', 'informatico'),
('20202020-0', 'Solicitante Diecinueve', 'solicitante19@example.com', 'gasfiter'),
('20202020-1', 'Solicitante Dos', 'solicitante2@example.com', 'informatico'),
('21212121-1', 'Solicitante Veinte', 'solicitante20@example.com', 'carpintero'),
('22222222-2', 'Solicitante Veintiuno', 'solicitante21@example.com', 'mecanico'),
('23232323-3', 'Solicitante Veintidós', 'solicitante22@example.com', 'informatico'),
('24242424-4', 'Solicitante Veintitrés', 'solicitante23@example.com', 'gasfiter'),
('25252525-5', 'Solicitante Veinticuatro', 'solicitante24@example.com', 'carpintero'),
('26262626-6', 'Solicitante Veinticinco', 'solicitante25@example.com', 'mecanico'),
('27272727-7', 'Solicitante Veintiséis', 'solicitante26@example.com', 'informatico'),
('28282828-8', 'Solicitante Veintisiete', 'solicitante27@example.com', 'gasfiter'),
('29292929-9', 'Solicitante Veintiocho', 'solicitante28@example.com', 'carpintero'),
('30303030-0', 'Solicitante Veintinueve', 'solicitante29@example.com', 'mecanico'),
('30303030-2', 'Solicitante Tres', 'solicitante3@example.com', 'gasfiter'),
('31313131-1', 'Solicitante Treinta', 'solicitante30@example.com', 'informatico'),
('40404040-3', 'Solicitante Cuatro', 'solicitante4@example.com', 'carpintero'),
('50505050-4', 'Solicitante Cinco', 'solicitante5@example.com', 'mecanico'),
('60606060-5', 'Solicitante Seis', 'solicitante6@example.com', 'informatico'),
('70707070-6', 'Solicitante Siete', 'solicitante7@example.com', 'gasfiter'),
('80808080-7', 'Solicitante Ocho', 'solicitante8@example.com', 'carpintero'),
('90909090-8', 'Solicitante Nueve', 'solicitante9@example.com', 'mecanico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudservicio`
--

CREATE TABLE `solicitudservicio` (
  `ID_solicitud` int(11) NOT NULL,
  `tipo_servicio` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `ID_cliente` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `Rut_Trabajador` varchar(255) DEFAULT NULL,
  `Grado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudservicio`
--

INSERT INTO `solicitudservicio` (`ID_solicitud`, `tipo_servicio`, `descripcion`, `ID_cliente`, `precio`, `Rut_Trabajador`, `Grado`) VALUES
(1, 'reparacion', 'Reparación de tuberías', 1, '100.00', '43434343-4', 'basico'),
(2, 'chequeo', 'Instalación de sistemas eléctricos', 2, '150.00', '54545454-5', 'medio'),
(3, 'mantencion', 'Construcción de muebles a medida', 3, '200.00', '65656565-6', 'urgente'),
(4, 'reparacion', 'Reparación de automóviles', 4, '120.00', '76767676-7', 'basico'),
(5, 'chequeo', 'Desarrollo de software personalizado', 5, '180.00', '87878787-8', 'medio'),
(6, 'mantencion', 'Mantenimiento de jardines', 6, '90.00', '98989898-9', 'urgente'),
(7, 'reparacion', 'Instalación de sistemas de gas', 7, '160.00', '10101010-1', 'basico'),
(8, 'chequeo', 'Reparación de muebles antiguos', 8, '220.00', '12121212-2', 'medio'),
(9, 'mantencion', 'Reparación de motores', 9, '130.00', '13131313-3', 'urgente'),
(10, 'reparacion', 'Diseño y construcción de puertas', 10, '170.00', '14141414-4', 'basico'),
(11, 'chequeo', 'Instalación de sistemas de agua', 11, '110.00', '15151515-5', 'medio'),
(12, 'mantencion', 'Desarrollo de aplicaciones web', 12, '160.00', '16161616-6', 'urgente'),
(13, 'reparacion', 'Diseño de muebles modernos', 13, '210.00', '17171717-7', 'basico'),
(14, 'chequeo', 'Configuración de redes informáticas', 14, '170.00', '18181818-8', 'medio'),
(15, 'mantencion', 'Diseño de paisajismo residencial', 15, '190.00', '19191919-9', 'urgente'),
(16, 'reparacion', 'Reparación de sistemas de fontanería', 16, '95.00', '20202020-0', 'basico'),
(17, 'chequeo', 'Construcción de armarios y estanterías', 17, '150.00', '21212121-1', 'medio'),
(18, 'mantencion', 'Reparación de motores diesel', 18, '200.00', '22222222-2', 'urgente'),
(19, 'reparacion', 'Mantenimiento de motores marinos', 19, '140.00', '23232323-3', 'basico'),
(20, 'chequeo', 'Instalación de sistemas de calefacción', 20, '180.00', '24242424-4', 'medio'),
(21, 'mantencion', 'Instalación de sistemas de riego automático', 21, '120.00', '25252525-5', 'urgente'),
(22, 'reparacion', 'Desarrollo de aplicaciones móviles', 22, '170.00', '26262626-6', 'basico'),
(23, 'chequeo', 'Reparación de sistemas de escape', 23, '220.00', '27272727-7', 'medio'),
(24, 'mantencion', 'Mantenimiento de sistemas de alcantarillado', 24, '180.00', '28282828-8', 'urgente'),
(25, 'reparacion', 'Restauración de muebles antiguos', 25, '200.00', '29292929-9', 'basico'),
(26, 'chequeo', 'Desarrollo de software empresarial', 26, '100.00', '30303030-0', 'medio'),
(27, 'mantencion', 'Reparación de sistemas de fontanería', 27, '160.00', '31313131-1', 'urgente'),
(28, 'reparacion', 'Construcción de muebles a medida', 28, '120.00', '32323232-2', 'basico'),
(29, 'chequeo', 'Desarrollo de aplicaciones web', 29, '180.00', '33333333-3', 'medio'),
(30, 'mantencion', 'Mantenimiento de jardines', 30, '190.00', '34343434-4', 'urgente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `Rut_trabajador` varchar(255) NOT NULL,
  `Nombre_Trabajador` varchar(255) DEFAULT NULL,
  `Correo_Trabajador` varchar(255) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Profesion` varchar(255) DEFAULT NULL,
  `Monto_Cuenta` decimal(10,2) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `Calificacion_T` decimal(3,2) DEFAULT NULL,
  `Pedidos` int(30) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Rut_Administrador` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`Rut_trabajador`, `Nombre_Trabajador`, `Correo_Trabajador`, `Foto`, `Profesion`, `Monto_Cuenta`, `contraseña`, `Calificacion_T`, `Pedidos`, `Descripcion`, `Rut_Administrador`) VALUES
('12121212-2', 'Trabajador Ocho', 'trabajador8@example.com', 'foto8.jpg', 'carpintero', '21000.00', 'contraseña8', NULL, NULL, 'Experto en construcción de estructuras de madera a medida.', NULL),
('13131313-3', 'Trabajador Nueve', 'trabajador9@example.com', 'foto9.jpg', 'mecanico', '18000.00', 'contraseña9', NULL, NULL, 'Amplia experiencia en reparaciones de motores y transmisiones.', NULL),
('14141414-4', 'Trabajador Diez', 'trabajador10@example.com', 'foto10.jpg', 'informatico', '16000.00', 'contraseña10', NULL, NULL, 'Especialista en desarrollo de software y soluciones tecnológicas.', NULL),
('15151515-5', 'Trabajador Once', 'trabajador11@example.com', 'foto11.jpg', 'gasfiter', '17000.00', 'contraseña11', NULL, NULL, 'Amplia experiencia en instalaciones de sistemas de agua para edificios comerciales.', NULL),
('18181818-8', 'Trabajador Catorce', 'trabajador14@example.com', 'foto14.jpg', 'informatico', '15000.00', 'contraseña14', NULL, NULL, 'Experto en administración de sistemas y redes informáticas.', NULL),
('19191919-9', 'Trabajador Quince', 'trabajador15@example.com', 'foto15.jpg', 'gasfiter', '18000.00', 'contraseña15', NULL, NULL, 'Especialista en instalaciones de fontanería para proyectos residenciales.', NULL),
('20202020-0', 'Trabajador Dieciséis', 'trabajador16@example.com', 'foto16.jpg', 'carpintero', '17500.00', 'contraseña16', NULL, NULL, 'Amplia experiencia en construcción de estructuras de madera para espacios comerciales.', NULL),
('21212121-1', 'Trabajador Diecisiete', 'trabajador17@example.com', 'foto17.jpg', 'mecanico', '21000.00', 'contraseña17', NULL, NULL, 'Especialista en reparaciones de motores diesel y maquinaria pesada.', NULL),
('22222222-2', 'Trabajador Dieciocho', 'trabajador18@example.com', 'foto18.jpg', 'informatico', '18000.00', '', NULL, NULL, 'Amplia experiencia en desarrollo de aplicaciones y soluciones empresariales.', NULL),
('24242424-4', 'Trabajador Veinte', 'trabajador20@example.com', 'foto20.jpg', 'carpintero', '15000.00', 'contraseña20', NULL, NULL, 'Experto en diseño y construcción de mobiliario de madera para oficinas.', NULL),
('25252525-5', 'Trabajador Veintiuno', 'trabajador21@example.com', 'foto21.jpg', 'mecanico', '18000.00', 'contraseña21', NULL, NULL, 'Amplia experiencia en reparaciones de motores de gasolina y sistemas de escape.', NULL),
('26262626-6', 'Trabajador Veintidós', 'trabajador22@example.com', 'foto22.jpg', 'informatico', '19000.00', 'contraseña22', NULL, NULL, 'Especialista en desarrollo de software y aplicaciones móviles avanzadas.', NULL),
('27272727-7', 'Trabajador Veintitrés', 'trabajador23@example.com', 'foto23.jpg', 'gasfiter', '17500.00', 'contraseña23', NULL, NULL, 'xddchatgpt', NULL),
('28282828-8', 'Trabajador Veinticuatro', 'trabajador24@example.com', 'foto24.jpg', 'carpintero', '18000.00', 'contraseña24', NULL, NULL, 'Especialista en restauración de muebles antiguos y diseño de interiores.', NULL),
('29292929-9', 'Trabajador Veinticinco', 'trabajador25@example.com', 'foto25.jpg', 'mecanico', '16000.00', 'contraseña25', NULL, NULL, 'Amplia experiencia en reparaciones de motores de vehículos híbridos.', NULL),
('30303030-0', 'Trabajador Veintiséis', 'trabajador26@example.com', 'foto26.jpg', 'informatico', '17000.00', 'contraseña26', NULL, NULL, 'Especialista en desarrollo de software de gestión empresarial y soluciones en la nube.', NULL),
('31313131-1', 'Trabajador Veintisiete', 'trabajador27@example.com', 'foto27.jpg', 'gasfiter', '20000.00', 'contraseña27', NULL, NULL, 'Amplia experiencia en instalaciones de sistemas de fontanería para complejos residenciales.', NULL),
('32323232-2', 'Trabajador Veintiocho', 'trabajador28@example.com', 'foto28.jpg', 'carpintero', '18000.00', 'contraseña28', NULL, NULL, 'Experto en diseño y fabricación de muebles modernos y funcionales.', NULL),
('33333333-3', 'Trabajador Veintinueve', 'trabajador29@example.com', 'foto29.jpg', 'mecanico', '17500.00', 'contraseña29', NULL, NULL, 'Especialista en reparaciones de motores de barcos y embarcaciones marinas.', NULL),
('34343434-4', 'Trabajador Treinta', 'trabajador30@example.com', 'foto30.jpg', 'informatico', '18000.00', 'contraseña30', NULL, NULL, 'Amplia experiencia en desarrollo de aplicaciones móviles y soluciones de comercio electrónico.', NULL),
('43434343-4', 'Trabajador Uno', 'trabajador1@example.com', 'foto1.jpg', 'mecanico', '15000.00', 'contraseña1', NULL, 5, 'Especialista en motores de automóviles y reparaciones generales.', NULL),
('54545454-5', 'Trabajador Dos', 'trabajador2@example.com', 'foto2.jpg', 'informatico', '18000.00', 'contraseña2', '4.20', NULL, 'Experto en desarrollo web y aplicaciones móviles.', NULL),
('65656565-6', 'Trabajador Tres', 'trabajador3@example.com', 'foto3.jpg', 'gasfiter', '20000.00', 'contraseña3', '4.80', NULL, 'Amplia experiencia en instalaciones de tuberías y sistemas de agua.', NULL),
('76767676-7', 'Trabajador Cuatro', 'trabajador4@example.com', 'foto4.jpg', 'carpintero', '16000.00', 'contraseña4', '4.30', NULL, 'Experto en diseño y fabricación de muebles de madera.', NULL),
('87878787-8', 'Trabajador Cinco', 'trabajador5@example.com', 'foto5.jpg', 'mecanico', '17000.00', 'contraseña5', '4.60', NULL, 'Especialista en reparaciones de vehículos comerciales.', NULL),
('98989898-9', 'Trabajador Seis', 'trabajador6@example.com', 'foto6.jpg', 'informatico', '19000.00', 'contraseña6', '4.40', NULL, 'Amplios conocimientos en redes y seguridad informática.', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`Rut_administrador`);

--
-- Indices de la tabla `asistenciac`
--
ALTER TABLE `asistenciac`
  ADD PRIMARY KEY (`ID_AsistenciaC`);

--
-- Indices de la tabla `asistenciat`
--
ALTER TABLE `asistenciat`
  ADD PRIMARY KEY (`ID_AsistenciaT`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_cliente`),
  ADD KEY `Correo_Cliente` (`Correo_Cliente`),
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
  ADD PRIMARY KEY (`Rut_solicitante`);

--
-- Indices de la tabla `solicitudservicio`
--
ALTER TABLE `solicitudservicio`
  ADD PRIMARY KEY (`ID_solicitud`),
  ADD KEY `ID_cliente` (`ID_cliente`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`Rut_trabajador`),
  ADD KEY `Rut_trabajador` (`Rut_trabajador`),
  ADD KEY `trabajador_ibfk_3` (`Rut_Administrador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistenciac`
--
ALTER TABLE `asistenciac`
  MODIFY `ID_AsistenciaC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asistenciat`
--
ALTER TABLE `asistenciat`
  MODIFY `ID_AsistenciaT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `pedido_aceptado`
--
ALTER TABLE `pedido_aceptado`
  MODIFY `ID_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `solicitudservicio`
--
ALTER TABLE `solicitudservicio`
  MODIFY `ID_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  ADD CONSTRAINT `pedido_aceptado_ibfk_2` FOREIGN KEY (`Rut_Trabajador`) REFERENCES `trabajador` (`Rut_trabajador`);

--
-- Filtros para la tabla `solicitudservicio`
--
ALTER TABLE `solicitudservicio`
  ADD CONSTRAINT `solicitudservicio_ibfk_1` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_cliente`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_3` FOREIGN KEY (`Rut_Administrador`) REFERENCES `administradores` (`Rut_administrador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
