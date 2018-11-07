-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2018 a las 11:52:20
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

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
  `descuento_euros_articulo` decimal(4,0) DEFAULT NULL,
  `almacen_articulo` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_articulos`
--

INSERT INTO `adst_sesnines_articulos` (`id_articulo`, `nombre_articulo`, `referencia_articulo`, `referencia_proveedor_articulo`, `descripcion_articulo`, `activado_articulo`, `visible_en_tienda_articulo`, `precio_coste_articulo`, `coste_externo_portes_articulo`, `PVP_final_articulo`, `margen_articulo`, `deleted_articulo`, `cantidad_articulo`, `inicio_descuento_articulo`, `fin_descuento_articulo`, `descuento_porcentaje_articulo`, `descuento_euros_articulo`, `almacen_articulo`) VALUES
(89, 'Articulo prueba', '#123', '#PROVEEDOR', 'Hola soy la descripcion', 0, 1, '10.00', '5.00', '22.00', '6.79', 0, 0, '0000-00-00', '0000-00-00', '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_colores`
--

CREATE TABLE `adst_sesnines_articulo_colores` (
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `id_color` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_color_imgs`
--

CREATE TABLE `adst_sesnines_articulo_color_imgs` (
  `id_color` smallint(6) UNSIGNED NOT NULL,
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `ruta0` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ruta1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ruta2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ruta3` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ruta4` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_color_tallas`
--

CREATE TABLE `adst_sesnines_articulo_color_tallas` (
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `id_color` smallint(6) UNSIGNED NOT NULL,
  `talla` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(89, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_existencias`
--

CREATE TABLE `adst_sesnines_articulo_existencias` (
  `id_existencia` mediumint(8) UNSIGNED NOT NULL,
  `id_articulo` smallint(6) UNSIGNED NOT NULL,
  `color_existencia` varchar(255) NOT NULL,
  `talla_existencia` varchar(26) NOT NULL,
  `cantidad_existencia` smallint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adst_sesnines_articulo_existencias`
--

INSERT INTO `adst_sesnines_articulo_existencias` (`id_existencia`, `id_articulo`, `color_existencia`, `talla_existencia`, `cantidad_existencia`) VALUES
(0, 89, 'asd', '38/M', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_articulo_imagenes`
--

CREATE TABLE `adst_sesnines_articulo_imagenes` (
  `id_imagen` smallint(7) NOT NULL,
  `id_articulo` smallint(6) NOT NULL,
  `ruta_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_articulo_imagenes`
--

INSERT INTO `adst_sesnines_articulo_imagenes` (`id_imagen`, `id_articulo`, `ruta_imagen`) VALUES
(1, 89, 'imgart/20181019-121008tinda.jpg'),
(2, 89, 'imgart/20181019-121018toggle.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_categorias`
--

CREATE TABLE `adst_sesnines_categorias` (
  `id_categoria` smallint(6) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_categorias`
--

INSERT INTO `adst_sesnines_categorias` (`id_categoria`, `nombre_categoria`, `visible`, `deleted`) VALUES
(1, 'CASUAL DEPORTIVA', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_colores`
--

CREATE TABLE `adst_sesnines_colores` (
  `id_color` smallint(6) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `color_img` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_config`
--

CREATE TABLE `adst_sesnines_config` (
  `estado_tienda` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_config`
--

INSERT INTO `adst_sesnines_config` (`estado_tienda`) VALUES
(1);

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
(39, 'Holgada', '', 'Estampados', '');

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
(37, 'PruebaEtiquetaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_looks`
--

CREATE TABLE `adst_sesnines_looks` (
  `id_look` smallint(6) UNSIGNED NOT NULL,
  `tipo_look` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `imagen_look` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_pedido_articulos`
--

CREATE TABLE `adst_sesnines_pedido_articulos` (
  `id_pedido` tinyint(6) UNSIGNED NOT NULL,
  `id_articulo` tinyint(6) UNSIGNED NOT NULL,
  `seleccionado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `adst_sesnines_pedido_articulos`
--
DELIMITER $$
CREATE TRIGGER `recuperarStock` BEFORE DELETE ON `adst_sesnines_pedido_articulos` FOR EACH ROW UPDATE adst_sesnines_articulos
	SET cantidad_articulo = cantidad_articulo+1
WHERE id_articulo = OLD.id_articulo
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restarStock` BEFORE INSERT ON `adst_sesnines_pedido_articulos` FOR EACH ROW UPDATE adst_sesnines_articulos
	SET cantidad_articulo = cantidad_articulo-1 
WHERE id_articulo = NEW.id_articulo
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_proveedores`
--

CREATE TABLE `adst_sesnines_proveedores` (
  `id_proveedor` smallint(6) UNSIGNED NOT NULL,
  `nombre_proveedor` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_proveedores`
--

INSERT INTO `adst_sesnines_proveedores` (`id_proveedor`, `nombre_proveedor`) VALUES
(41, 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_sliders`
--

CREATE TABLE `adst_sesnines_sliders` (
  `id_slider` smallint(6) NOT NULL,
  `img_slider` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `titulo_slider` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_slider` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_subcategorias`
--

CREATE TABLE `adst_sesnines_subcategorias` (
  `id_subcategoria` smallint(6) UNSIGNED NOT NULL,
  `nombre_subcategoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` smallint(6) UNSIGNED NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `tipologia` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 'sesnines', 'sergio.vegas@adstormcommunication.com', NULL, '123456', '654321', 'Administrador', '1234', 1, 'Administrador - SUPER ROOT', 0, 0, '2018-07-20', 0, NULL),
(20, 'test', 'test@test.com', NULL, '987654321', '123456798', 'Nombre test', '1234', 10, '', 0, 1, '0000-00-00', 0, NULL),
(39, 'dmartinezh97@gmail.com', 'dmartinezh97@gmail.com', NULL, '62222222', '82222222E', 'Dani Martinez', '1234', 10, '', 0, 0, '2018-04-02', 1, 'ninguna'),
(52, 'prueba@gmail.com', 'prueba@gmail.com', NULL, '62222222EE', 'E322322322', 'prueba', '1234', 10, '', 0, 0, '2018-10-01', 1, NULL),
(53, 'prueba1710@gmail.com', 'prueba1710@gmail.com', NULL, '62222222EE', 'E322322322', 'prueba1710', '1234', 10, '', 0, 0, '2018-10-01', 0, NULL),
(54, 'prueba1@gmail.com', 'prueba1@gmail.com', NULL, '62222222EE', 'E322322322', 'prueba', '1234', 10, '', 0, 0, '2018-10-01', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_asesorame`
--

CREATE TABLE `adst_sesnines_usuario_asesorame` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `look_asesoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `razon_ps` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_categorias`
--

CREATE TABLE `adst_sesnines_usuario_categorias` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `id_categoria` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_imgs`
--

CREATE TABLE `adst_sesnines_usuario_imgs` (
  `id_imagen` smallint(6) UNSIGNED NOT NULL,
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `nombre_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_looks`
--

CREATE TABLE `adst_sesnines_usuario_looks` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `id_look` smallint(6) UNSIGNED NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_miarmario`
--

CREATE TABLE `adst_sesnines_usuario_miarmario` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `tipo_prenda` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `prenda_renovar` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_pedidos`
--

CREATE TABLE `adst_sesnines_usuario_pedidos` (
  `id_pedido` int(6) NOT NULL,
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `estado_pedido` int(2) NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_lastmod_pedido` datetime NOT NULL,
  `observaciones_pedido` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_recogida_pedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adst_sesnines_usuario_sobremi`
--

CREATE TABLE `adst_sesnines_usuario_sobremi` (
  `id_usuario` smallint(6) UNSIGNED NOT NULL,
  `actividad_estilo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `profesion_estilo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tienes_hijos` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `adst_sesnines_usuario_sobremi`
--

INSERT INTO `adst_sesnines_usuario_sobremi` (`id_usuario`, `actividad_estilo`, `profesion_estilo`, `tienes_hijos`) VALUES
(39, 'prueba', 'prueba', 'Si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adst_sesnines_articulos`
--
ALTER TABLE `adst_sesnines_articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `adst_sesnines_articulo_colores`
--
ALTER TABLE `adst_sesnines_articulo_colores`
  ADD PRIMARY KEY (`id_articulo`,`id_color`),
  ADD KEY `adst_sesnines_articulo_colores_ibfk_2` (`id_color`);

--
-- Indices de la tabla `adst_sesnines_articulo_color_imgs`
--
ALTER TABLE `adst_sesnines_articulo_color_imgs`
  ADD PRIMARY KEY (`id_color`,`id_articulo`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `adst_sesnines_articulo_color_tallas`
--
ALTER TABLE `adst_sesnines_articulo_color_tallas`
  ADD KEY `adst_sesnines_articulo_color_ibfk_1` (`id_articulo`),
  ADD KEY `adst_sesnines_articulo_color_ibfk_2` (`id_color`);

--
-- Indices de la tabla `adst_sesnines_articulo_etiquetas`
--
ALTER TABLE `adst_sesnines_articulo_etiquetas`
  ADD PRIMARY KEY (`id_articulo`,`id_etiqueta`),
  ADD KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `adst_sesnines_articulo_imagenes`
--
ALTER TABLE `adst_sesnines_articulo_imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `adst_sesnines_categorias`
--
ALTER TABLE `adst_sesnines_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `adst_sesnines_colores`
--
ALTER TABLE `adst_sesnines_colores`
  ADD PRIMARY KEY (`id_color`);

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
-- Indices de la tabla `adst_sesnines_looks`
--
ALTER TABLE `adst_sesnines_looks`
  ADD PRIMARY KEY (`id_look`);

--
-- Indices de la tabla `adst_sesnines_pedido_articulos`
--
ALTER TABLE `adst_sesnines_pedido_articulos`
  ADD PRIMARY KEY (`id_pedido`,`id_articulo`);

--
-- Indices de la tabla `adst_sesnines_proveedores`
--
ALTER TABLE `adst_sesnines_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `adst_sesnines_sliders`
--
ALTER TABLE `adst_sesnines_sliders`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indices de la tabla `adst_sesnines_subcategorias`
--
ALTER TABLE `adst_sesnines_subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

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
-- Indices de la tabla `adst_sesnines_usuario_pedidos`
--
ALTER TABLE `adst_sesnines_usuario_pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_articulos`
--
ALTER TABLE `adst_sesnines_articulos`
  MODIFY `id_articulo` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_articulo_imagenes`
--
ALTER TABLE `adst_sesnines_articulo_imagenes`
  MODIFY `id_imagen` smallint(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_categorias`
--
ALTER TABLE `adst_sesnines_categorias`
  MODIFY `id_categoria` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_colores`
--
ALTER TABLE `adst_sesnines_colores`
  MODIFY `id_color` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_etiquetas`
--
ALTER TABLE `adst_sesnines_etiquetas`
  MODIFY `id_etiqueta` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_looks`
--
ALTER TABLE `adst_sesnines_looks`
  MODIFY `id_look` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_proveedores`
--
ALTER TABLE `adst_sesnines_proveedores`
  MODIFY `id_proveedor` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_sliders`
--
ALTER TABLE `adst_sesnines_sliders`
  MODIFY `id_slider` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_subcategorias`
--
ALTER TABLE `adst_sesnines_subcategorias`
  MODIFY `id_subcategoria` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_usuarios`
--
ALTER TABLE `adst_sesnines_usuarios`
  MODIFY `id_usuario` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_usuario_imgs`
--
ALTER TABLE `adst_sesnines_usuario_imgs`
  MODIFY `id_imagen` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adst_sesnines_usuario_pedidos`
--
ALTER TABLE `adst_sesnines_usuario_pedidos`
  MODIFY `id_pedido` int(6) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adst_sesnines_articulo_colores`
--
ALTER TABLE `adst_sesnines_articulo_colores`
  ADD CONSTRAINT `adst_sesnines_articulo_colores_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `adst_sesnines_articulos` (`id_articulo`) ON DELETE CASCADE,
  ADD CONSTRAINT `adst_sesnines_articulo_colores_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `adst_sesnines_colores` (`id_color`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adst_sesnines_articulo_color_imgs`
--
ALTER TABLE `adst_sesnines_articulo_color_imgs`
  ADD CONSTRAINT `adst_sesnines_articulo_color_imgs_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `adst_sesnines_articulos` (`id_articulo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adst_sesnines_articulo_color_tallas`
--
ALTER TABLE `adst_sesnines_articulo_color_tallas`
  ADD CONSTRAINT `adst_sesnines_articulo_color_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `adst_sesnines_articulos` (`id_articulo`) ON DELETE CASCADE,
  ADD CONSTRAINT `adst_sesnines_articulo_color_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `adst_sesnines_colores` (`id_color`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adst_sesnines_articulo_etiquetas`
--
ALTER TABLE `adst_sesnines_articulo_etiquetas`
  ADD CONSTRAINT `adst_sesnines_articulo_etiquetas_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `adst_sesnines_articulos` (`id_articulo`) ON DELETE CASCADE,
  ADD CONSTRAINT `adst_sesnines_articulo_etiquetas_ibfk_2` FOREIGN KEY (`id_etiqueta`) REFERENCES `adst_sesnines_etiquetas` (`id_etiqueta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adst_sesnines_subcategorias`
--
ALTER TABLE `adst_sesnines_subcategorias`
  ADD CONSTRAINT `adst_sesnines_subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `adst_sesnines_categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

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
