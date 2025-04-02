-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2024 a las 20:13:24
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
-- Base de datos: `ecoreboot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_reparacion`
--

CREATE TABLE `detalles_reparacion` (
  `id_detalles_reparacion` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_piezas_nuevas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles_reparacion`
--

INSERT INTO `detalles_reparacion` (`id_detalles_reparacion`, `descripcion`, `id_piezas_nuevas`) VALUES
(1, 'Reemplazo de pantalla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id_dispositivo` int(11) NOT NULL,
  `id_donacion` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id_dispositivo`, `id_donacion`, `descripcion`, `modelo`, `nombre`) VALUES
(1, 1, 'Laptop Dell Inspiron', 'Inspiron 15', 'Dell'),
(2, 1, 'Tablet Samsung Galaxy', 'Galaxy Tab S6', 'Samsung'),
(3, 1, 'PC HP Pavilion', 'Pavilion 590', 'HP'),
(4, 2, 'PC Lenovo', 'ThinkCentre M720', 'Lenovo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id_donacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_tipo_electrodomestico` int(11) DEFAULT NULL,
  `id_estado_dispositivo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imperfecciones` varchar(250) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `total_dispositivos` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`id_donacion`, `id_usuario`, `id_tipo_electrodomestico`, `id_estado_dispositivo`, `fecha`, `imperfecciones`, `telefono`, `total_dispositivos`, `activo`) VALUES
(1, 3, 1, 1, '2024-01-15', 'Ninguna', '5554567890', 3, 1),
(2, 3, 2, 2, '2024-02-10', 'Pantalla rota', '5554567890', 1, 1),
(3, 2, 5, 1, '2024-08-10', 'Ninguno', '4421389563', 1, 0),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donativos`
--

CREATE TABLE `donativos` (
  `id_donativo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `id_inventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `donativos`
--

INSERT INTO `donativos` (`id_donativo`, `fecha`, `id_institucion`, `id_inventario`) VALUES
(1, '2024-05-01', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_dispositivo`
--

CREATE TABLE `estado_dispositivo` (
  `id_estado_dispositivo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_dispositivo`
--

INSERT INTO `estado_dispositivo` (`id_estado_dispositivo`, `nombre`) VALUES
(1, 'Funcional'),
(2, 'Defectuoso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id_institucion` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id_institucion`, `cantidad`, `telefono`, `nombre`) VALUES
(1, 10, '5551237890', 'Escuela Primaria Benito Juarez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_reparacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_reparacion`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mat_reciclados`
--

CREATE TABLE `mat_reciclados` (
  `id_mat_reciclados` int(11) NOT NULL,
  `id_reciclaje` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mat_reciclados`
--

INSERT INTO `mat_reciclados` (`id_mat_reciclados`, `id_reciclaje`, `nombre`) VALUES
(1, 1, 'Plástico reciclado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas_nuevas`
--

CREATE TABLE `piezas_nuevas` (
  `id_piezas_nuevas` int(11) NOT NULL,
  `id_reparacion` int(11) DEFAULT NULL,
  `id_reciclaje` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `piezas_nuevas`
--

INSERT INTO `piezas_nuevas` (`id_piezas_nuevas`, `id_reparacion`, `id_reciclaje`, `precio`, `nombre`) VALUES
(1, 1, 1, '50.00', 'Pantalla nueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reciclajes`
--

CREATE TABLE `reciclajes` (
  `id_reciclaje` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_dispositivo` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reciclajes`
--

INSERT INTO `reciclajes` (`id_reciclaje`, `fecha`, `id_dispositivo`, `descripcion`) VALUES
(1, '2024-03-01', 4, 'Reciclaje de componentes defectuosos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id_reparacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_dispositivo` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `id_detalles_reparacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id_reparacion`, `fecha`, `id_dispositivo`, `descripcion`, `costo`, `id_detalles_reparacion`) VALUES
(1, '2024-04-05', 2, 'Reparación de pantalla', '150.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuarios`
--

CREATE TABLE `rol_usuarios` (
  `id_rol_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_usuarios`
--

INSERT INTO `rol_usuarios` (`id_rol_usuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Trabajador'),
(3, 'Donante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_electrodomestico`
--

CREATE TABLE `tipo_electrodomestico` (
  `id_tipo_electrodomestico` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_electrodomestico`
--

INSERT INTO `tipo_electrodomestico` (`id_tipo_electrodomestico`, `nombre`) VALUES
(1, 'Laptop'),
(2, 'PC'),
(3, 'Tablet'),
(4, 'Monitor'),
(5, 'Teclado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `id_rol_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `telefono`, `correo`, `contraseña`, `id_rol_usuario`) VALUES
(1, 'Admin01', '4481028843', 'admin01@gmail.com', '123456789', 1),
(2, 'MariaLopez', '555555', '5559876543', 'maria.lopez@gmail.com', 2),
(3, 'CarlosGomez', '44444', '5554567890', 'carlos.gomez@gmail.com', 3),


--
-- Disparadores `usuarios`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_reparacion`
--
ALTER TABLE `detalles_reparacion`
  ADD PRIMARY KEY (`id_detalles_reparacion`),
  ADD KEY `id_piezas_nuevas` (`id_piezas_nuevas`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivo`),
  ADD KEY `id_donacion` (`id_donacion`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id_donacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tipo_electrodomestico` (`id_tipo_electrodomestico`),
  ADD KEY `id_estado_dispositivo` (`id_estado_dispositivo`);

--
-- Indices de la tabla `donativos`
--
ALTER TABLE `donativos`
  ADD PRIMARY KEY (`id_donativo`),
  ADD KEY `id_institucion` (`id_institucion`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `estado_dispositivo`
--
ALTER TABLE `estado_dispositivo`
  ADD PRIMARY KEY (`id_estado_dispositivo`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_reparacion` (`id_reparacion`);

--
-- Indices de la tabla `mat_reciclados`
--
ALTER TABLE `mat_reciclados`
  ADD PRIMARY KEY (`id_mat_reciclados`),
  ADD KEY `id_reciclaje` (`id_reciclaje`);

--
-- Indices de la tabla `piezas_nuevas`
--
ALTER TABLE `piezas_nuevas`
  ADD PRIMARY KEY (`id_piezas_nuevas`),
  ADD KEY `id_reparacion` (`id_reparacion`),
  ADD KEY `id_reciclaje` (`id_reciclaje`);

--
-- Indices de la tabla `reciclajes`
--
ALTER TABLE `reciclajes`
  ADD PRIMARY KEY (`id_reciclaje`),
  ADD KEY `id_dispositivo` (`id_dispositivo`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id_reparacion`),
  ADD KEY `id_dispositivo` (`id_dispositivo`);

--
-- Indices de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  ADD PRIMARY KEY (`id_rol_usuario`);

--
-- Indices de la tabla `tipo_electrodomestico`
--
ALTER TABLE `tipo_electrodomestico`
  ADD PRIMARY KEY (`id_tipo_electrodomestico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol_usuario` (`id_rol_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_reparacion`
--
ALTER TABLE `detalles_reparacion`
  MODIFY `id_detalles_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id_donacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `donativos`
--
ALTER TABLE `donativos`
  MODIFY `id_donativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_dispositivo`
--
ALTER TABLE `estado_dispositivo`
  MODIFY `id_estado_dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mat_reciclados`
--
ALTER TABLE `mat_reciclados`
  MODIFY `id_mat_reciclados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `piezas_nuevas`
--
ALTER TABLE `piezas_nuevas`
  MODIFY `id_piezas_nuevas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reciclajes`
--
ALTER TABLE `reciclajes`
  MODIFY `id_reciclaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  MODIFY `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_electrodomestico`
--
ALTER TABLE `tipo_electrodomestico`
  MODIFY `id_tipo_electrodomestico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_reparacion`
--
ALTER TABLE `detalles_reparacion`
  ADD CONSTRAINT `detalles_reparacion_ibfk_1` FOREIGN KEY (`id_piezas_nuevas`) REFERENCES `piezas_nuevas` (`id_piezas_nuevas`);

--
-- Filtros para la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD CONSTRAINT `dispositivos_ibfk_1` FOREIGN KEY (`id_donacion`) REFERENCES `donaciones` (`id_donacion`);

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `donaciones_ibfk_2` FOREIGN KEY (`id_tipo_electrodomestico`) REFERENCES `tipo_electrodomestico` (`id_tipo_electrodomestico`),
  ADD CONSTRAINT `donaciones_ibfk_3` FOREIGN KEY (`id_estado_dispositivo`) REFERENCES `estado_dispositivo` (`id_estado_dispositivo`);

--
-- Filtros para la tabla `donativos`
--
ALTER TABLE `donativos`
  ADD CONSTRAINT `donativos_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`),
  ADD CONSTRAINT `donativos_ibfk_2` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`);

--
-- Filtros para la tabla `mat_reciclados`
--
ALTER TABLE `mat_reciclados`
  ADD CONSTRAINT `mat_reciclados_ibfk_1` FOREIGN KEY (`id_reciclaje`) REFERENCES `reciclajes` (`id_reciclaje`);

--
-- Filtros para la tabla `piezas_nuevas`
--
ALTER TABLE `piezas_nuevas`
  ADD CONSTRAINT `piezas_nuevas_ibfk_1` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`),
  ADD CONSTRAINT `piezas_nuevas_ibfk_2` FOREIGN KEY (`id_reciclaje`) REFERENCES `reciclajes` (`id_reciclaje`);

--
-- Filtros para la tabla `reciclajes`
--
ALTER TABLE `reciclajes`
  ADD CONSTRAINT `reciclajes_ibfk_1` FOREIGN KEY (`id_dispositivo`) REFERENCES `dispositivos` (`id_dispositivo`);

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`id_dispositivo`) REFERENCES `dispositivos` (`id_dispositivo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol_usuario`) REFERENCES `rol_usuarios` (`id_rol_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
