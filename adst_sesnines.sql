-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2018 a las 09:55:07
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adst_sesnines`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulos`
--

CREATE TABLE `adst_sesnines_articulos` (
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `nombre_articulo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `referencia_articulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `referencia_proveedor_articulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descripcion_articulo` text CHARACTER SET latin1 NOT NULL,
  `activado_articulo` tinyint(1) UNSIGNED NOT NULL,
  `visible_en_tienda_articulo` tinyint(1) UNSIGNED NOT NULL,
  `precio_coste_articulo` decimal(10,2) UNSIGNED NOT NULL,
  `coste_externo_portes_articulo` decimal(10,2) UNSIGNED NOT NULL,
  `PVP_final_articulo` decimal(10,2) UNSIGNED NOT NULL,
  `margen_articulo` decimal(10,2) UNSIGNED NOT NULL,
  `deleted_articulo` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `cantidad_articulo` int(11) UNSIGNED NOT NULL,
  `inicio_descuento_articulo` date DEFAULT NULL,
  `fin_descuento_articulo` date DEFAULT NULL,
  `descuento_porcentaje_articulo` decimal(3,0) DEFAULT NULL,
  `descuento_euros_articulo` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_articulos`
--

INSERT INTO `adst_sesnines_articulos` (`id_articulo`, `nombre_articulo`, `referencia_articulo`, `referencia_proveedor_articulo`, `descripcion_articulo`, `activado_articulo`, `visible_en_tienda_articulo`, `precio_coste_articulo`, `coste_externo_portes_articulo`, `PVP_final_articulo`, `margen_articulo`, `deleted_articulo`, `cantidad_articulo`, `inicio_descuento_articulo`, `fin_descuento_articulo`, `descuento_porcentaje_articulo`, `descuento_euros_articulo`) VALUES
(1, 'Juanitaaa flores', 'h', 'ho', 'hol', 0, 0, '2.00', '3.00', '4.00', '5.00', 0, 0, NULL, NULL, NULL, NULL),
(2, 'Pepe', 'ghjghj', 'ghjg', 'ghjh', 0, 0, '1.00', '1.00', '1.00', '1.00', 0, 0, NULL, NULL, NULL, NULL),
(3, 'thrth', 'fghfgh', 'ffhfgh', 'gjkjk', 0, 0, '4.00', '7.00', '6.00', '5.00', 0, 0, NULL, NULL, NULL, NULL),
(4, 'Juam', 'ghjghj', 'ghjg', 'ghjghj', 0, 0, '3.00', '2.00', '5.00', '5.00', 0, 0, NULL, NULL, NULL, NULL),
(5, 'fgd', 'jkh', 'ghhg', 'hjk', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(6, 'sdasd', 'asdsad', 'asdasd', 'asdasd', 1, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(7, 'dfgd', 'dfgdfg', 'dfgdg', 'dfgdg', 1, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(8, 'dfgdfg', 'dfgdfg', 'dfgdfg', 'dfgdfg', 0, 1, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(9, 'edfsdf', 'sdfdsf', 'sdfsdf', 'sdfsdf', 1, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(17, 'ksjdhkj', 'sdfd', 'sdfds', 'sddfs', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(18, 'adsfsdf', 'sdfdsf', 'sdfsdf', 'dgfdgf', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(19, 'fdgdfg', 'dfgf', 'dfgf', 'dfgdgf', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(20, 'sdfsdfds', 'jashdkjas', 'asldkjasld', 'adsa', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(21, 'Bolso de Chanel', '5646849', '68468465846', 'Un bolso muy cuco', 1, 0, '100.00', '125.00', '150.00', '50.00', 0, 0, NULL, NULL, NULL, NULL),
(22, 'dthfgf', 'ghgfhf', 'ghgfhf', 'ghgfh', 0, 0, '0.00', '0.00', '0.00', '0.00', 0, 0, NULL, NULL, NULL, NULL),
(23, 'Camiseta33', '43534534', '345345345', 'Camiseta33', 1, 1, '55.00', '60.00', '70.00', '10.00', 0, 10, NULL, NULL, NULL, NULL),
(24, 'Tirantes', '684384638', '8468468', 'tirantes verdes', 0, 0, '50.00', '55.00', '60.00', '10.00', 0, 20, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_etiquetas`
--

CREATE TABLE `adst_sesnines_articulo_etiquetas` (
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `id_etiqueta` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_articulo_etiquetas`
--

INSERT INTO `adst_sesnines_articulo_etiquetas` (`id_articulo`, `id_etiqueta`) VALUES
(1, 1),
(1, 2),
(1, 3),
(9, 2),
(22, 4),
(23, 3),
(24, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_categorias`
--

CREATE TABLE `adst_sesnines_categorias` (
  `id_categoria` smallint(6) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen_categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_categorias`
--

INSERT INTO `adst_sesnines_categorias` (`id_categoria`, `nombre_categoria`, `imagen_categoria`) VALUES
(1, 'CASUAL DEPORTIVA', 'http://sesnineshopper.com/adstorm/img/casualdeportiva.jpg'),
(2, 'CASUAL STREET', 'http://sesnineshopper.com/adstorm/img/casualstreet.jpg'),
(3, 'CLASICA', 'http://sesnineshopper.com/adstorm/img/clasica.jpg'),
(4, 'ACTUAL', 'http://sesnineshopper.com/adstorm/img/actual.jpg'),
(5, 'OFFICE', 'http://sesnineshopper.com/adstorm/img/office.jpg'),
(6, 'SOFISTICADA', 'http://sesnineshopper.com/adstorm/img/sofisticada.jpg'),
(7, 'EXTREMADA', 'http://sesnineshopper.com/adstorm/img/extremada.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_estilos`
--

CREATE TABLE `adst_sesnines_estilos` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `tipo_estilo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `color_estilo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `textura_estilo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `referente_estilo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_estilos`
--

INSERT INTO `adst_sesnines_estilos` (`id_usuario`, `tipo_estilo`, `color_estilo`, `textura_estilo`, `referente_estilo`) VALUES
(39, 'Entallada', 'rojo', 'Estampados', 'nadie'),
(40, 'Entallada', 'rojo', 'Colores lisos', 'naidee');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_etiquetas`
--

CREATE TABLE `adst_sesnines_etiquetas` (
  `id_etiqueta` smallint(6) UNSIGNED NOT NULL,
  `nombre_etiqueta` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_etiquetas`
--

INSERT INTO `adst_sesnines_etiquetas` (`id_etiqueta`, `nombre_etiqueta`) VALUES
(1, 'Falda'),
(2, 'Zapatos'),
(3, 'Bolso'),
(4, 'Camisa rosa'),
(8, 'Camisa Pepe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_img_articulos`
--

CREATE TABLE `adst_sesnines_img_articulos` (
  `id_img` int(10) UNSIGNED NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_img_articulos`
--

INSERT INTO `adst_sesnines_img_articulos` (`id_img`, `id_articulo`, `ruta`) VALUES
(2, 3, 'Koala.jpg'),
(4, 3, 'Hydrangeas.jpg'),
(51, 2, 'prueba.bmp'),
(52, 4, 'Desert.jpg'),
(53, 5, 'Hydrangeas.jpg'),
(54, 1, 'Koala.jpg'),
(56, 1, 'Koala.jpg'),
(57, 1, 'Koala.jpg'),
(58, 1, 'Penguins.jpg'),
(59, 1, 'Penguins.jpg'),
(60, 1, 'Medusa.png'),
(61, 19, 'Hydrangeas.jpg'),
(62, 20, 'Hydrangeas.jpg'),
(63, 20, 'Lighthouse.jpg'),
(64, 0, 'Koala.jpg'),
(65, 0, 'Koala.jpg'),
(66, 0, 'Medusa.png'),
(67, 0, 'Medusa.png'),
(68, 0, 'Medusa.png'),
(69, 0, 'Hydrangeas.jpg'),
(70, 0, 'Hydrangeas.jpg'),
(71, 0, 'Tulips.jpg'),
(72, 0, 'Koala.jpg'),
(73, 0, 'Tulips.jpg'),
(74, 0, 'Koala.jpg'),
(75, 0, 'Tulips.jpg'),
(76, 0, 'Koala.jpg'),
(77, 0, 'Tulips.jpg'),
(78, 0, 'Koala.jpg'),
(79, 0, 'Tulips.jpg'),
(80, 0, 'Koala.jpg'),
(81, 0, 'Tulips.jpg'),
(82, 0, 'Koala.jpg'),
(83, 0, 'Tulips.jpg'),
(84, 0, 'Koala.jpg'),
(85, 0, 'Tulips.jpg'),
(86, 0, 'Koala.jpg'),
(87, 0, 'Tulips.jpg'),
(88, 0, 'Koala.jpg'),
(89, 0, 'Koala.jpg'),
(90, 0, 'Koala.jpg'),
(91, 0, 'Koala.jpg'),
(92, 0, 'Koala.jpg'),
(93, 0, 'Koala.jpg'),
(94, 0, 'Koala.jpg'),
(95, 0, 'Koala.jpg'),
(96, 0, 'Koala.jpg'),
(97, 0, 'Medusa.png'),
(98, 0, 'Medusa.png'),
(99, 22, 'Medusa.png'),
(100, 22, 'Hydrangeas.jpg'),
(101, 22, 'Hydrangeas.jpg'),
(102, 22, 'Hydrangeas.jpg'),
(103, 23, 'Desert.jpg'),
(104, 23, 'Hydrangeas.jpg'),
(105, 23, 'Tulips.jpg'),
(106, 23, 'Hydrangeas.jpg'),
(107, 24, 'Medusa.png'),
(108, 24, 'Koala.jpg'),
(109, 24, 'Tulips.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_looks`
--

CREATE TABLE `adst_sesnines_looks` (
  `id_look` smallint(6) UNSIGNED NOT NULL,
  `tipo_look` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `imagen_look` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_looks`
--

INSERT INTO `adst_sesnines_looks` (`id_look`, `tipo_look`, `imagen_look`) VALUES
(1, 'libre', 'https://lookiero.es/images/dia_1.jpg'),
(2, 'libre', 'https://lookiero.es/images/dia_2.jpg'),
(3, 'libre', 'https://lookiero.es/images/dia_3.jpg'),
(4, 'libre', 'https://lookiero.es/images/dia_4.jpg'),
(5, 'trabajo', 'https://lookiero.es/images/trabajo_1.jpg'),
(6, 'trabajo', 'https://lookiero.es/images/trabajo_2.jpg'),
(7, 'trabajo', 'https://lookiero.es/images/trabajo_3.jpg'),
(8, 'trabajo', 'https://lookiero.es/images/trabajo_4.jpg'),
(9, 'otro', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_tallas`
--

CREATE TABLE `adst_sesnines_tallas` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `talla_superior` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `talla_inferior` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `talla_pecho` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `altura` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `parte_preferida_cuerpo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `parte_menos_preferida_cuerpo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tono_piel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `color_ojos` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `color_pelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `calzado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_tallas`
--

INSERT INTO `adst_sesnines_tallas` (`id_usuario`, `talla_superior`, `talla_inferior`, `talla_pecho`, `altura`, `parte_preferida_cuerpo`, `parte_menos_preferida_cuerpo`, `tono_piel`, `color_ojos`, `color_pelo`, `calzado`) VALUES
(39, '34XS', '40L', '100', 'más', 'biseps', 'uñas', 'beige', 'gris', 'rubio', '36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuarios`
--

CREATE TABLE `adst_sesnines_usuarios` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email_usuario` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `randomkey` smallint(12) DEFAULT NULL,
  `telf_usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nie_usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombrecompleto_usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contrasenya_usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_tipo_usuario` tinyint(4) NOT NULL,
  `desc_usuario` varchar(150) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado_usuario` tinyint(1) NOT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `fecha_nacimiento` date NOT NULL,
  `ps_completo` tinyint(1) NOT NULL,
  `tipo_suscripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuarios`
--

INSERT INTO `adst_sesnines_usuarios` (`id_usuario`, `nombre_usuario`, `email_usuario`, `randomkey`, `telf_usuario`, `nie_usuario`, `nombrecompleto_usuario`, `contrasenya_usuario`, `id_tipo_usuario`, `desc_usuario`, `estado_usuario`, `deleted`, `fecha_nacimiento`, `ps_completo`, `tipo_suscripcion`) VALUES
(1, 'sesnines', 'sergio.vegas@adstormcommunication.com', NULL, '123456', '654321', 'Administrador', '1234', 1, 'Administrador - SUPER ROOT', 0, 0, '0000-00-00', 0, NULL),
(20, 'test', 'test@test.com', NULL, '987654321', '123456798', 'Nombre test', '1234', 10, '', 0, 1, '0000-00-00', 0, NULL),
(39, 'dmartinezh97@gmail.com', 'dmartinezh97@gmail.com', NULL, '62222222', 'E82222222', 'Dani Martinez', '1234', 10, '', 0, 0, '2018-04-02', 1, NULL),
(40, 'beta@gmail.com', 'beta@gmail.com', NULL, '62222222', 'E82222222', 'Beta testeeer', '1234', 10, '', 0, 0, '2018-04-27', 1, '3meses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_categorias`
--

CREATE TABLE `adst_sesnines_usuario_categorias` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `id_categoria` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuario_categorias`
--

INSERT INTO `adst_sesnines_usuario_categorias` (`id_usuario`, `id_categoria`) VALUES
(1, 1),
(40, 1),
(40, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_destinos`
--

CREATE TABLE `adst_sesnines_usuario_destinos` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cp` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora_inicio` time NOT NULL,
  `fecha_hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuario_destinos`
--

INSERT INTO `adst_sesnines_usuario_destinos` (`id_usuario`, `nombre`, `direccion`, `cp`, `poblacion`, `provincia`, `fecha_hora_inicio`, `fecha_hora_fin`) VALUES
(39, 'Daniiii', 'Calle cantabria num 45', '08521', 'Barcelona', 'Granollers', '17:40:00', '19:20:00'),
(40, 'Super beta tester', 'Calle testeo', '08520', 'Barselona', 'grano', '05:45:00', '09:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_imgs`
--

CREATE TABLE `adst_sesnines_usuario_imgs` (
  `id_imagen` smallint(6) UNSIGNED NOT NULL,
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `nombre_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuario_imgs`
--

INSERT INTO `adst_sesnines_usuario_imgs` (`id_imagen`, `id_usuario`, `nombre_imagen`) VALUES
(1, 39, '39Lighthouse.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_looks`
--

CREATE TABLE `adst_sesnines_usuario_looks` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `id_look` smallint(6) UNSIGNED NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuario_looks`
--

INSERT INTO `adst_sesnines_usuario_looks` (`id_usuario`, `id_look`, `comentario`) VALUES
(39, 2, ''),
(39, 5, ''),
(39, 9, '&quot;&gt;asdada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adst_sesnines_articulos`
--
ALTER TABLE `adst_sesnines_articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `adst_sesnines_articulo_etiquetas`
--
ALTER TABLE `adst_sesnines_articulo_etiquetas`
  ADD PRIMARY KEY (`id_articulo`,`id_etiqueta`),
  ADD KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `adst_sesnines_categorias`
--
ALTER TABLE `adst_sesnines_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `adst_sesnines_estilos`
--
ALTER TABLE `adst_sesnines_estilos`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `adst_sesnines_etiquetas`
--
ALTER TABLE `adst_sesnines_etiquetas`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `adst_sesnines_img_articulos`
--
ALTER TABLE `adst_sesnines_img_articulos`
  ADD PRIMARY KEY (`id_img`,`id_articulo`);

--
-- Indices de la tabla `adst_sesnines_looks`
--
ALTER TABLE `adst_sesnines_looks`
  ADD PRIMARY KEY (`id_look`);

--
-- Indices de la tabla `adst_sesnines_tallas`
--
ALTER TABLE `adst_sesnines_tallas`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `adst_sesnines_usuarios`
--
ALTER TABLE `adst_sesnines_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `adst_sesnines_usuario_categorias`
--
ALTER TABLE `adst_sesnines_usuario_categorias`
  ADD PRIMARY KEY (`id_usuario`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `adst_sesnines_usuario_imgs`
--
ALTER TABLE `adst_sesnines_usuario_imgs`
  ADD PRIMARY KEY (`id_imagen`,`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_articulos`
--
ALTER TABLE `adst_sesnines_articulos`
  MODIFY `id_articulo` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_etiquetas`
--
ALTER TABLE `adst_sesnines_etiquetas`
  MODIFY `id_etiqueta` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_img_articulos`
--
ALTER TABLE `adst_sesnines_img_articulos`
  MODIFY `id_img` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_looks`
--
ALTER TABLE `adst_sesnines_looks`
  MODIFY `id_look` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_usuarios`
--
ALTER TABLE `adst_sesnines_usuarios`
  MODIFY `id_usuario` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_usuario_imgs`
--
ALTER TABLE `adst_sesnines_usuario_imgs`
  MODIFY `id_imagen` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adst_sesnines_articulo_etiquetas`
--
ALTER TABLE `adst_sesnines_articulo_etiquetas`
  ADD CONSTRAINT `adst_sesnines_articulo_etiquetas_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `adst_sesnines_articulos` (`id_articulo`) ON DELETE CASCADE,
  ADD CONSTRAINT `adst_sesnines_articulo_etiquetas_ibfk_2` FOREIGN KEY (`id_etiqueta`) REFERENCES `adst_sesnines_etiquetas` (`id_etiqueta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adst_sesnines_usuario_categorias`
--
ALTER TABLE `adst_sesnines_usuario_categorias`
  ADD CONSTRAINT `adst_sesnines_usuario_categorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `adst_sesnines_categorias` (`id_categoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `adst_sesnines_usuario_categorias_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `adst_sesnines_usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
