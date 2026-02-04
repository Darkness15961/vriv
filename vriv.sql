-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2026 a las 22:58:36
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
-- Base de datos: `vriv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `IDEnvio` int(11) NOT NULL,
  `IDParticipacion` int(11) DEFAULT NULL,
  `IDEventoPremio` int(11) DEFAULT NULL,
  `Empresa` varchar(150) DEFAULT NULL,
  `CodigoRastreo` varchar(100) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `FechaEnvio` datetime DEFAULT NULL,
  `FechaEntrega` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventopremio`
--

CREATE TABLE `eventopremio` (
  `IDEventoPremio` int(11) NOT NULL,
  `IDEvento` int(11) DEFAULT NULL,
  `IDPremio` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `PosicionGanador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `IDEvento` int(11) NOT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `IDCreador` int(11) DEFAULT NULL,
  `PuntosMinimos` int(11) DEFAULT NULL,
  `IDPlanMinimo` int(11) DEFAULT NULL,
  `IDTipoEvento` int(11) DEFAULT NULL,
  `FechaInicio` datetime DEFAULT NULL,
  `FechaFin` datetime DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `ReglasBases` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_Logro` int(11) NOT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `ImagenURL` varchar(255) DEFAULT NULL,
  `PuntosOtorgados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logrousuarios`
--

CREATE TABLE `logrousuarios` (
  `ID_LogroUsuario` int(11) NOT NULL,
  `IDUsuario` int(11) DEFAULT NULL,
  `IDLogro` int(11) DEFAULT NULL,
  `FechaObtencion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `IDNotificacion` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `IDTipoNotificacion` int(11) NOT NULL,
  `Mensaje` text DEFAULT NULL,
  `Leido` tinyint(1) DEFAULT 0,
  `FechaCreacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacion`
--

CREATE TABLE `participacion` (
  `IDParticipacion` int(11) NOT NULL,
  `IDUsuario` int(11) DEFAULT NULL,
  `IDEvento` int(11) DEFAULT NULL,
  `FechaParticipacion` datetime DEFAULT NULL,
  `EsGanador` tinyint(1) DEFAULT NULL,
  `PuntajeEvento` int(11) DEFAULT NULL,
  `TiempoLogrado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planessuscripciones`
--

CREATE TABLE `planessuscripciones` (
  `IDPlan` int(11) NOT NULL,
  `IDCreador` int(11) DEFAULT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Periodicidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `IDPremio` int(11) NOT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Imagen_URL` varchar(255) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `ValorReferencial` decimal(10,2) DEFAULT NULL,
  `Proveedor` varchar(150) DEFAULT NULL,
  `EsEnvio` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `IDVinculo` int(11) NOT NULL,
  `IDUsuarioSeguidor` int(11) NOT NULL,
  `IDPlan` int(11) DEFAULT NULL,
  `FechaInicio` datetime DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoeventos`
--

CREATE TABLE `tipoeventos` (
  `IDTipo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiponotificaciones`
--

CREATE TABLE `tiponotificaciones` (
  `IDTipoNotificacion` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `idTipoUsuarios` int(11) NOT NULL,
  `nombreTipo` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `IDTransaccion` int(11) NOT NULL,
  `IDUsuario` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Moneda` varchar(10) DEFAULT NULL,
  `IDReferenciaOrigen` int(11) DEFAULT NULL,
  `TipoTransaccion` varchar(50) DEFAULT NULL,
  `MetodoPago` varchar(50) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `FechaTransaccion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `FotoPerfil` varchar(255) DEFAULT NULL,
  `GoogleID` varchar(150) DEFAULT NULL,
  `idTipoUsuario` int(11) DEFAULT NULL,
  `BiografiaDescripcion` text DEFAULT NULL,
  `PuntosScore` int(11) DEFAULT 0,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`IDEnvio`),
  ADD KEY `IDParticipacion` (`IDParticipacion`),
  ADD KEY `IDEventoPremio` (`IDEventoPremio`);

--
-- Indices de la tabla `eventopremio`
--
ALTER TABLE `eventopremio`
  ADD PRIMARY KEY (`IDEventoPremio`),
  ADD KEY `IDEvento` (`IDEvento`),
  ADD KEY `IDPremio` (`IDPremio`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`IDEvento`),
  ADD KEY `IDCreador` (`IDCreador`),
  ADD KEY `IDPlanMinimo` (`IDPlanMinimo`),
  ADD KEY `IDTipoEvento` (`IDTipoEvento`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`id_Logro`);

--
-- Indices de la tabla `logrousuarios`
--
ALTER TABLE `logrousuarios`
  ADD PRIMARY KEY (`ID_LogroUsuario`),
  ADD KEY `IDUsuario` (`IDUsuario`),
  ADD KEY `IDLogro` (`IDLogro`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`IDNotificacion`),
  ADD KEY `IDUsuario` (`IDUsuario`),
  ADD KEY `IDTipoNotificacion` (`IDTipoNotificacion`);

--
-- Indices de la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD PRIMARY KEY (`IDParticipacion`),
  ADD KEY `IDUsuario` (`IDUsuario`),
  ADD KEY `IDEvento` (`IDEvento`);

--
-- Indices de la tabla `planessuscripciones`
--
ALTER TABLE `planessuscripciones`
  ADD PRIMARY KEY (`IDPlan`),
  ADD KEY `IDCreador` (`IDCreador`);

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`IDPremio`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`IDVinculo`),
  ADD KEY `IDUsuarioSeguidor` (`IDUsuarioSeguidor`);

--
-- Indices de la tabla `tipoeventos`
--
ALTER TABLE `tipoeventos`
  ADD PRIMARY KEY (`IDTipo`);

--
-- Indices de la tabla `tiponotificaciones`
--
ALTER TABLE `tiponotificaciones`
  ADD PRIMARY KEY (`IDTipoNotificacion`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`idTipoUsuarios`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`IDTransaccion`),
  ADD KEY `IDUsuario` (`IDUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `IDEnvio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventopremio`
--
ALTER TABLE `eventopremio`
  MODIFY `IDEventoPremio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `IDEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `id_Logro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logrousuarios`
--
ALTER TABLE `logrousuarios`
  MODIFY `ID_LogroUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `IDNotificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacion`
--
ALTER TABLE `participacion`
  MODIFY `IDParticipacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planessuscripciones`
--
ALTER TABLE `planessuscripciones`
  MODIFY `IDPlan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `IDPremio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `IDVinculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoeventos`
--
ALTER TABLE `tipoeventos`
  MODIFY `IDTipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiponotificaciones`
--
ALTER TABLE `tiponotificaciones`
  MODIFY `IDTipoNotificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `idTipoUsuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `IDTransaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`IDParticipacion`) REFERENCES `participacion` (`IDParticipacion`),
  ADD CONSTRAINT `envios_ibfk_2` FOREIGN KEY (`IDEventoPremio`) REFERENCES `eventopremio` (`IDEventoPremio`);

--
-- Filtros para la tabla `eventopremio`
--
ALTER TABLE `eventopremio`
  ADD CONSTRAINT `eventopremio_ibfk_1` FOREIGN KEY (`IDEvento`) REFERENCES `eventos` (`IDEvento`),
  ADD CONSTRAINT `eventopremio_ibfk_2` FOREIGN KEY (`IDPremio`) REFERENCES `premios` (`IDPremio`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`IDCreador`) REFERENCES `usuarios` (`idUsuarios`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`IDPlanMinimo`) REFERENCES `planessuscripciones` (`IDPlan`),
  ADD CONSTRAINT `eventos_ibfk_3` FOREIGN KEY (`IDTipoEvento`) REFERENCES `tipoeventos` (`IDTipo`);

--
-- Filtros para la tabla `logrousuarios`
--
ALTER TABLE `logrousuarios`
  ADD CONSTRAINT `logrousuarios_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`idUsuarios`),
  ADD CONSTRAINT `logrousuarios_ibfk_2` FOREIGN KEY (`IDLogro`) REFERENCES `logros` (`id_Logro`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`idUsuarios`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`IDTipoNotificacion`) REFERENCES `tiponotificaciones` (`IDTipoNotificacion`);

--
-- Filtros para la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD CONSTRAINT `participacion_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`idUsuarios`),
  ADD CONSTRAINT `participacion_ibfk_2` FOREIGN KEY (`IDEvento`) REFERENCES `eventos` (`IDEvento`);

--
-- Filtros para la tabla `planessuscripciones`
--
ALTER TABLE `planessuscripciones`
  ADD CONSTRAINT `planessuscripciones_ibfk_1` FOREIGN KEY (`IDCreador`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Filtros para la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`IDUsuarioSeguidor`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuarios` (`idTipoUsuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
