-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2023 a las 02:40:20
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_clientes`
--

CREATE TABLE `abono_clientes` (
  `id_abono` int(11) NOT NULL,
  `id_credito_clientes` int(11) DEFAULT NULL,
  `fecha_pago` date NOT NULL,
  `monto_abonado` float(8,0) NOT NULL,
  `monto_pendiente` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_proveedor`
--

CREATE TABLE `abono_proveedor` (
  `id_abono` int(11) NOT NULL,
  `id_credito_proveedor` int(11) DEFAULT NULL,
  `fecha_pago` date NOT NULL,
  `monto_abonado` float(8,0) NOT NULL,
  `monto_pendiente` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(13) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(10, 'dulces'),
(11, 'lacteos'),
(12, 'Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `productos` longtext NOT NULL,
  `movimiento` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `id_user`, `id_proveedor`, `fecha`, `productos`, `movimiento`, `cantidad`, `total`) VALUES
(1063, 1, 5, '2023-03-26', '[{\"codigo\":\"6758\",\"descripcion\":\"Bombones Columbias\",\"cant\":5,\"compra\":23,\"venta\":{\"1\":\"37\",\"2\":\"45\",\"3\":\"56\",\"8\":\"34\"},\"subtotal\":115,\"es\":\"comprado\"},{\"codigo\":\"54\",\"descripcion\":\"Aceite\",\"cant\":24,\"compra\":234,\"venta\":{\"0\":\"238\",\"1\":\"239\"},\"subtotal\":5616,\"es\":\"comprado\"},{\"codigo\":\"32\",\"descripcion\":\"Detergente ultraklin 400kg \",\"cant\":5,\"compra\":55,\"venta\":{\"0\":\"60\"},\"subtotal\":275,\"es\":\"comprado\"}]', 'Contado', 34, 6006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito_clientes`
--

CREATE TABLE `credito_clientes` (
  `id_credito_clientes` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `fecha_iniicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `monto_total` float(8,0) NOT NULL,
  `saldo_pendiente` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito_proveedores`
--

CREATE TABLE `credito_proveedores` (
  `id_credito_proveedor` int(11) NOT NULL,
  `id_compras` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `fecha_iniicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `monto_total` float(8,0) NOT NULL,
  `saldo_pendiente` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

CREATE TABLE `datos_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) NOT NULL,
  `contacto2` varchar(255) DEFAULT NULL,
  `iva` float(8,0) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `nombre`, `ruc`, `direccion`, `correo`, `contacto`, `contacto2`, `iva`, `logo`) VALUES
(1, 'DISMA', 'GHD465678999', 'Dtras de la iglesia católica', 'joel8080ur@gmail.com', '+505 85860266', 'no hay', 8, 'app/vistas/img/logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_compras` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_compras` int(11) DEFAULT NULL,
  `id_compra` int(11) NOT NULL,
  `cantidad` float(8,0) NOT NULL,
  `total` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_ventas` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` float(8,0) NOT NULL,
  `precio_venta` float(8,0) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_inventario`
--

CREATE TABLE `entradas_inventario` (
  `id_entrada` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_entrada` date NOT NULL,
  `cantidad` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganancias`
--

CREATE TABLE `ganancias` (
  `id_ganancia` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `total` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `cantidad` float(8,0) NOT NULL,
  `tipo_movimiento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidacion`
--

CREATE TABLE `liquidacion` (
  `id_liquidacion` int(11) NOT NULL,
  `id_ruta` int(11) DEFAULT NULL,
  `efectivo_inicial_total` float(8,0) NOT NULL,
  `recuperado_total` float(8,0) NOT NULL,
  `credito_total` float(8,0) NOT NULL,
  `facturacion_vale` float(8,0) NOT NULL,
  `gasto_total` float(8,0) NOT NULL,
  `efectivo_final` float(8,0) NOT NULL,
  `diferencia` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `stock` float NOT NULL,
  `medida` varchar(255) NOT NULL,
  `precio_venta` longtext NOT NULL,
  `precio_compra` longtext NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo`, `descripcion`, `stock`, `medida`, `precio_venta`, `precio_compra`, `img`) VALUES
(46, 10, '6758', 'Bombones Columbias', 5, 'paquetes', '{\"8\":\"34\",\"1\":\"37\",\"2\":\"45\",\"3\":\"56\"}', '23', 'app/vistas/img/producto.png'),
(47, 12, '32', 'Detergente ultraklin 400kg ', 0, 'paquetes', '{\"0\":\"60\"}', '50', 'app/vistas/img/producto.png'),
(48, 12, '54', 'Aceite', 24, 'Balde', '{\"0\":\"238\",\"1\":\"239\"}', '234', 'app/vistas/img/producto.png'),
(49, 10, '74g', 'jabón', 0, 'ristra', '{\"0\":\"36\"}', '34', 'app/vistas/img/producto.png'),
(50, 11, '12t5', 'leche', 0, 'Balde', '{\"0\":\"46\"}', '36', 'app/vistas/img/producto.png'),
(51, 10, '2385', 'desodorante', 0, 'caja', '{\"0\":\"49\",\"1\":\"50\"}', '43', 'app/vistas/img/producto.png'),
(52, 10, '876', 'azucar', 0, 'sacos', '{\"0\":\"1300\"}', '1280', 'app/vistas/img/producto.png'),
(53, 10, '2324d', 'Gel', 0, 'Baso', '{\"0\":\"29\",\"1\":\"38\"}', '23', 'app/vistas/img/producto.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `ruc`, `direccion`, `contacto`, `correo`) VALUES
(4, 'CTECP PLUS', 'rtry432343213443erds', 'del ondo al gancho findo', '+507 8745375', 'pedro@gmail.com'),
(5, 'DISTRIBU', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `id_vale` int(11) DEFAULT NULL,
  `codigo_ruta` varchar(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `recuperado` float(8,0) NOT NULL,
  `efectivo_inicial` float(8,0) NOT NULL,
  `credito` float(8,0) NOT NULL,
  `gastos` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_inventario`
--

CREATE TABLE `salida_inventario` (
  `id_salida` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_salida` date NOT NULL,
  `cantidad` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `nombre`, `contacto`, `cedula`, `correo`, `user`, `passwd`, `tipo`, `estado`, `img`) VALUES
(1, 'Joel Urbina', '+507 8745375', '', 'joel@gmail.com', 'joel', '$2y$10$cB//BfX.A3PGPZCjnGNVL.ibxnUO1KX6aDQ.E347vh6qEGxjmNl0u', 'Administrador', 'Activado', 'app/vistas/img/perfil/joel.jpg'),
(2, 'Pedro Herrera', '85860266', '123456789CCC', 'pedro@gmail.com', 'pedro', '$2y$10$ybpY/MGhAAKgmqGorAvGiOWwMyDVxXzxpJddJAYHHY2Ql4aEXyESW', 'Administrador', 'Activado', 'app/vistas/img/perfil/pedro.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vale_carga`
--

CREATE TABLE `vale_carga` (
  `id_vale` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `codigo_vale` varchar(255) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `cargas` text NOT NULL,
  `total_carga` float(8,0) NOT NULL,
  `devolucion` float(8,0) NOT NULL,
  `cantcredito` float(8,0) NOT NULL,
  `cantcontado` float(8,0) NOT NULL,
  `cantidadventa` float(8,0) NOT NULL,
  `facturacion` float(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono_clientes`
--
ALTER TABLE `abono_clientes`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `Ref1416` (`id_credito_clientes`);

--
-- Indices de la tabla `abono_proveedor`
--
ALTER TABLE `abono_proveedor`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `Ref1825` (`id_credito_proveedor`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `Ref110` (`id_user`);

--
-- Indices de la tabla `credito_clientes`
--
ALTER TABLE `credito_clientes`
  ADD PRIMARY KEY (`id_credito_clientes`),
  ADD KEY `Ref1313` (`id_cliente`),
  ADD KEY `Ref614` (`id_venta`);

--
-- Indices de la tabla `credito_proveedores`
--
ALTER TABLE `credito_proveedores`
  ADD PRIMARY KEY (`id_credito_proveedor`),
  ADD KEY `Ref1717` (`id_proveedor`),
  ADD KEY `Ref1124` (`id_compras`);

--
-- Indices de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_compras`),
  ADD KEY `Ref1111` (`id_compras`),
  ADD KEY `Ref312` (`id_producto`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `Ref34` (`id_producto`),
  ADD KEY `Ref67` (`id_venta`);

--
-- Indices de la tabla `entradas_inventario`
--
ALTER TABLE `entradas_inventario`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `Ref35` (`id_producto`);

--
-- Indices de la tabla `ganancias`
--
ALTER TABLE `ganancias`
  ADD PRIMARY KEY (`id_ganancia`),
  ADD KEY `Ref68` (`id_venta`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `Ref32` (`id_producto`);

--
-- Indices de la tabla `liquidacion`
--
ALTER TABLE `liquidacion`
  ADD PRIMARY KEY (`id_liquidacion`),
  ADD KEY `Ref2123` (`id_ruta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `Ref2021` (`id_vale`);

--
-- Indices de la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `Ref36` (`id_producto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `vale_carga`
--
ALTER TABLE `vale_carga`
  ADD PRIMARY KEY (`id_vale`),
  ADD KEY `Ref320` (`id_producto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `Ref19` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono_clientes`
--
ALTER TABLE `abono_clientes`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `abono_proveedor`
--
ALTER TABLE `abono_proveedor`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1064;

--
-- AUTO_INCREMENT de la tabla `credito_clientes`
--
ALTER TABLE `credito_clientes`
  MODIFY `id_credito_clientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito_proveedores`
--
ALTER TABLE `credito_proveedores`
  MODIFY `id_credito_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas_inventario`
--
ALTER TABLE `entradas_inventario`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ganancias`
--
ALTER TABLE `ganancias`
  MODIFY `id_ganancia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `liquidacion`
--
ALTER TABLE `liquidacion`
  MODIFY `id_liquidacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vale_carga`
--
ALTER TABLE `vale_carga`
  MODIFY `id_vale` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono_clientes`
--
ALTER TABLE `abono_clientes`
  ADD CONSTRAINT `Refcredito_clientes16` FOREIGN KEY (`id_credito_clientes`) REFERENCES `credito_clientes` (`id_credito_clientes`);

--
-- Filtros para la tabla `abono_proveedor`
--
ALTER TABLE `abono_proveedor`
  ADD CONSTRAINT `Refcredito_proveedores25` FOREIGN KEY (`id_credito_proveedor`) REFERENCES `credito_proveedores` (`id_credito_proveedor`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `Refusers10` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `credito_clientes`
--
ALTER TABLE `credito_clientes`
  ADD CONSTRAINT `Refclientes13` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `Refventas14` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `credito_proveedores`
--
ALTER TABLE `credito_proveedores`
  ADD CONSTRAINT `Refcompras24` FOREIGN KEY (`id_compras`) REFERENCES `compras` (`id_compras`),
  ADD CONSTRAINT `Refproveedores17` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `Refcompras11` FOREIGN KEY (`id_compras`) REFERENCES `compras` (`id_compras`),
  ADD CONSTRAINT `Refproductos12` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `Refproductos4` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `Refventas7` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `entradas_inventario`
--
ALTER TABLE `entradas_inventario`
  ADD CONSTRAINT `Refproductos5` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ganancias`
--
ALTER TABLE `ganancias`
  ADD CONSTRAINT `Refventas8` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `Refproductos2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `liquidacion`
--
ALTER TABLE `liquidacion`
  ADD CONSTRAINT `Refrutas23` FOREIGN KEY (`id_ruta`) REFERENCES `rutas` (`id_ruta`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `Refvale_carga21` FOREIGN KEY (`id_vale`) REFERENCES `vale_carga` (`id_vale`);

--
-- Filtros para la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  ADD CONSTRAINT `Refproductos6` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `vale_carga`
--
ALTER TABLE `vale_carga`
  ADD CONSTRAINT `Refproductos20` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `Refusers9` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
