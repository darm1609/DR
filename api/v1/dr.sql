-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2021 a las 10:33:18
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clicliente`
--

CREATE TABLE `clicliente` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clicliente`
--

INSERT INTO `clicliente` (`Id`, `Nombre`, `Estado`) VALUES
(1, 'Cliente 0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genadjunto`
--

CREATE TABLE `genadjunto` (
  `Id` int(11) NOT NULL,
  `ClienteId` int(11) NOT NULL,
  `Nombre` varchar(500) NOT NULL,
  `Ruta` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genadjunto`
--

INSERT INTO `genadjunto` (`Id`, `ClienteId`, `Nombre`, `Ruta`) VALUES
(1, 1, '3c52cea7577f0f356d081b8b8e10d587.jpg', 'adjuntos/3c52cea7577f0f356d081b8b8e10d587.jpg.jpg'),
(2, 1, 'db06ab617d6fb8f773500a3d82a6393b.jpg', 'adjuntos/db06ab617d6fb8f773500a3d82a6393b.jpg.jpg'),
(3, 1, '9297adcf079f5eecb456e73ef9a20eed', 'adjuntos/9297adcf079f5eecb456e73ef9a20eed'),
(4, 1, 'd68e9ccc955f025e28e44d30ff05777d.jpg', 'adjuntos/d68e9ccc955f025e28e44d30ff05777d.jpg'),
(5, 1, 'f5ae0ba85fd0248486381f03cec95950.jpg', 'adjuntos/f5ae0ba85fd0248486381f03cec95950.jpg'),
(6, 1, 'cce2c8f21d5b271942f0ed1164efda24.jpg', 'adjuntos/cce2c8f21d5b271942f0ed1164efda24.jpg'),
(7, 1, 'b22b648515bae0982e31e16595e40da9.jpg', 'adjuntos/b22b648515bae0982e31e16595e40da9.jpg'),
(8, 1, 'f09a83db101defad2d980412a2e9ec0a.jpg', 'adjuntos/f09a83db101defad2d980412a2e9ec0a.jpg'),
(9, 1, 'f408418e00679a5b4a01a6cc72edbb55.png', 'adjuntos/f408418e00679a5b4a01a6cc72edbb55.png'),
(10, 1, '8d40674b4f6d0d78a64802226a9a7000.png', 'adjuntos/8d40674b4f6d0d78a64802226a9a7000.png'),
(11, 1, 'c410a74c37a04e331b80b07a1178098a.png', 'adjuntos/c410a74c37a04e331b80b07a1178098a.png'),
(12, 1, '7cfed1f0080794cc65d064f613ed3b23.png', 'adjuntos/7cfed1f0080794cc65d064f613ed3b23.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perpersona`
--

CREATE TABLE `perpersona` (
  `Id` int(11) NOT NULL,
  `ClienteId` int(11) NOT NULL,
  `Email` varchar(500) NOT NULL,
  `Nombres` varchar(200) NOT NULL,
  `Apellidos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perpersona`
--

INSERT INTO `perpersona` (`Id`, `ClienteId`, `Email`, `Nombres`, `Apellidos`) VALUES
(4, 1, 'admin@admin.com', 'admin', 'admin'),
(5, 1, 'admin1@admin.com', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proproducto`
--

CREATE TABLE `proproducto` (
  `Id` int(11) NOT NULL,
  `TipoDeProductoId` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `VigenciaDesde` int(11) NOT NULL,
  `VigenciaHasta` int(11) NOT NULL,
  `Visible` tinyint(1) NOT NULL,
  `Disponible` tinyint(1) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `AdjuntoId` int(11) NOT NULL,
  `ListaDePrecioId` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proproducto`
--

INSERT INTO `proproducto` (`Id`, `TipoDeProductoId`, `Nombre`, `VigenciaDesde`, `VigenciaHasta`, `Visible`, `Disponible`, `Descripcion`, `AdjuntoId`, `ListaDePrecioId`) VALUES
(1, 1, 'pizza 2', 2147483647, 222222223, 1, 1, 'Esta pizza esta hecha con finos ingredientes', 1, 4),
(3, 1, 'pizza', 1111111111, 22222222, 1, 1, 'Esta pizza esta hecha con finos ingredientes...', 1, 0),
(6, 1, 'pizza123', 1111111111, 22222222, 1, 1, 'Esta pizza esta hecha con finos ingredientes...', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protipodeproducto`
--

CREATE TABLE `protipodeproducto` (
  `Id` int(11) NOT NULL,
  `ClienteId` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `VigenciaDesde` int(11) NOT NULL,
  `VigenciaHasta` int(11) NOT NULL,
  `Visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `protipodeproducto`
--

INSERT INTO `protipodeproducto` (`Id`, `ClienteId`, `Nombre`, `VigenciaDesde`, `VigenciaHasta`, `Visible`) VALUES
(1, 1, 'pizza12', 111111, 22222, 1),
(3, 1, 'Pizzas', 1617350299, 1648886299, 1),
(4, 1, 'Pizzas2', 1617350299, 1648886299, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segusuario`
--

CREATE TABLE `segusuario` (
  `Id` int(11) NOT NULL,
  `PersonaId` int(11) NOT NULL,
  `Login` varchar(500) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `segusuario`
--

INSERT INTO `segusuario` (`Id`, `PersonaId`, `Login`, `Password`) VALUES
(4, 4, 'admin', '758ec7ef6a58c678db24046a32fcf8f9e5d7471a4d403e6f2f65f1102ea85e1de24e36ecc6ac91956f8ac1a6bae137b906708860200b4793d4710cbfdced93a1'),
(5, 5, 'admin1', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vtslistadeprecio`
--

CREATE TABLE `vtslistadeprecio` (
  `Id` int(11) NOT NULL,
  `ClienteId` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `VigenciaDesde` int(11) NOT NULL,
  `VigenciaHasta` int(11) NOT NULL,
  `Visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vtslistadeprecio`
--

INSERT INTO `vtslistadeprecio` (`Id`, `ClienteId`, `Nombre`, `VigenciaDesde`, `VigenciaHasta`, `Visible`) VALUES
(4, 1, 'Lista 1', 1617350299, 1648886299, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vtsproductodelistadeprecio`
--

CREATE TABLE `vtsproductodelistadeprecio` (
  `Id` int(11) NOT NULL,
  `ListadeprecioId` int(11) NOT NULL,
  `ProductoId` int(11) NOT NULL,
  `VigenciaDesde` int(11) NOT NULL,
  `VigenciaHasta` int(11) NOT NULL,
  `Precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vtsproductodelistadeprecio`
--

INSERT INTO `vtsproductodelistadeprecio` (`Id`, `ListadeprecioId`, `ProductoId`, `VigenciaDesde`, `VigenciaHasta`, `Precio`) VALUES
(1, 4, 6, 0, 0, '100000'),
(2, 4, 1, 111111111, 22222222, '40000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clicliente`
--
ALTER TABLE `clicliente`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `genadjunto`
--
ALTER TABLE `genadjunto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_genAdjunto_cliClienteId` (`ClienteId`);

--
-- Indices de la tabla `perpersona`
--
ALTER TABLE `perpersona`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_perPersona_cliClienteId` (`ClienteId`);

--
-- Indices de la tabla `proproducto`
--
ALTER TABLE `proproducto`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `nr_nombre` (`TipoDeProductoId`,`Nombre`),
  ADD KEY `Fk_proProducto_AdjuntoId` (`AdjuntoId`);

--
-- Indices de la tabla `protipodeproducto`
--
ALTER TABLE `protipodeproducto`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `nr_nombre_tipodeproducto` (`ClienteId`,`Nombre`);

--
-- Indices de la tabla `segusuario`
--
ALTER TABLE `segusuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `nr_login` (`Login`),
  ADD KEY `Fk_segusuario_PersonaId` (`PersonaId`);

--
-- Indices de la tabla `vtslistadeprecio`
--
ALTER TABLE `vtslistadeprecio`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `nr_nombre` (`ClienteId`,`Nombre`);

--
-- Indices de la tabla `vtsproductodelistadeprecio`
--
ALTER TABLE `vtsproductodelistadeprecio`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_vtsProductoDeListaDePrecios_vtsListaDePrecioId` (`ListadeprecioId`),
  ADD KEY `Fk_vtsProductoDeListaDePrecios_proProducto` (`ProductoId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clicliente`
--
ALTER TABLE `clicliente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `genadjunto`
--
ALTER TABLE `genadjunto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `perpersona`
--
ALTER TABLE `perpersona`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proproducto`
--
ALTER TABLE `proproducto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `protipodeproducto`
--
ALTER TABLE `protipodeproducto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `segusuario`
--
ALTER TABLE `segusuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vtslistadeprecio`
--
ALTER TABLE `vtslistadeprecio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vtsproductodelistadeprecio`
--
ALTER TABLE `vtsproductodelistadeprecio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `genadjunto`
--
ALTER TABLE `genadjunto`
  ADD CONSTRAINT `Fk_genAdjunto_cliClienteId` FOREIGN KEY (`ClienteId`) REFERENCES `clicliente` (`Id`);

--
-- Filtros para la tabla `perpersona`
--
ALTER TABLE `perpersona`
  ADD CONSTRAINT `Fk_perPersona_cliClienteId` FOREIGN KEY (`ClienteId`) REFERENCES `clicliente` (`Id`);

--
-- Filtros para la tabla `proproducto`
--
ALTER TABLE `proproducto`
  ADD CONSTRAINT `Fk_proProducto_AdjuntoId` FOREIGN KEY (`AdjuntoId`) REFERENCES `genadjunto` (`Id`),
  ADD CONSTRAINT `Fk_proProducto_TipoDeProductoId` FOREIGN KEY (`TipoDeProductoId`) REFERENCES `protipodeproducto` (`Id`);

--
-- Filtros para la tabla `protipodeproducto`
--
ALTER TABLE `protipodeproducto`
  ADD CONSTRAINT `Fk_proTipoDeProducto_ClienteId` FOREIGN KEY (`ClienteId`) REFERENCES `clicliente` (`Id`);

--
-- Filtros para la tabla `segusuario`
--
ALTER TABLE `segusuario`
  ADD CONSTRAINT `Fk_segusuario_PersonaId` FOREIGN KEY (`PersonaId`) REFERENCES `perpersona` (`Id`);

--
-- Filtros para la tabla `vtslistadeprecio`
--
ALTER TABLE `vtslistadeprecio`
  ADD CONSTRAINT `Fk_vtsListaDePrecio_cliClienteId` FOREIGN KEY (`ClienteId`) REFERENCES `clicliente` (`Id`);

--
-- Filtros para la tabla `vtsproductodelistadeprecio`
--
ALTER TABLE `vtsproductodelistadeprecio`
  ADD CONSTRAINT `Fk_vtsProductoDeListaDePrecios_proProducto` FOREIGN KEY (`ProductoId`) REFERENCES `proproducto` (`Id`),
  ADD CONSTRAINT `Fk_vtsProductoDeListaDePrecios_vtsListaDePrecioId` FOREIGN KEY (`ListadeprecioId`) REFERENCES `vtslistadeprecio` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
