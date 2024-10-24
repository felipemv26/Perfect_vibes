-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 20:24:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perfect_vides`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `producto_id`, `cantidad`) VALUES
(1, 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagada','cancelada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_carrito`
--

CREATE TABLE `factura_carrito` (
  `factura_id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `usuario_id`, `categoria`) VALUES
(10, 'Corrector Facial', 'Corrector facial, para guardar tus inperfeccioe', 35000.00, 'CorrectorFacial.webp', NULL, NULL),
(11, 'Labial MAC', 'Labial Larga Duración MAC 2 g', 15900.00, 'labialrosa.avif', NULL, NULL),
(12, 'LA ROCHE POSAY', 'Protector Solar La Roche Posay Anthelios Age Correct Spf50 Con Color 50ml', 132000.00, 'protectorsolar.avif', NULL, NULL),
(13, 'Brillo DIOR', 'Brillo labial Addict Lip Maximizer Dior 5 ml', 241900.00, 'BRILLODIOR.avif', NULL, NULL),
(14, 'Nail Polish Base Coat', 'Obtén uñas icónicas y brillantes con nuestra colección única de esmaltes.', 12000.00, 'nail-polish-base-coat.webp', NULL, NULL),
(15, 'Nail Polish Seashell', 'Obtén uñas icónicas y brillantes con nuestra colección única de esmaltes.', 12000.00, 'nail-polish-seashell.webp', NULL, NULL),
(16, 'Nail Polish One Heckle Of A Color', 'Obtén uñas icónicas y brillantes con nuestra colección única de esmaltes.', 12000.00, 'nail-polish-one-heckle-of-a-color.jpg', NULL, NULL),
(17, 'Combo Lampara De Uñas Led Uv 48Watts + Kit Pulidor Eléctrico New Future', 'Lampara led uv para uñas de 48 watts\r\nPara gel acrílico semi permanente\r\nY kit pulidor de uñas\r\n', 59980.00, 'combo-lampara-de-unas-led-uv-48watts-kit-pulidor-electrico-new-future.webp', NULL, NULL),
(19, 'Lampara Secador De Uñas Lampara Uv Led 48W Temporizador', 'Características:\r\n- use la luz LED para secar las uñas de gel más rápido\r\n- comienza a funcionar automáticamente al detectar la mano en la máquina\r\n- La máquina tiene un diseño curvo y medio cerrado, lo que protegerá los ojos de los reflejos duros.\r\n- Ajuste el temporizador a 10s, 30s, 60s o 99s para curar las uñas de gel', 91900.00, 'lampara-secador-de-unas-lampara-uv-led-48w-temporizador.jpg', NULL, NULL),
(20, 'Esmalte Semipermanente Gematic B479', 'Descubre la magia del esmalte en gel de textura suave, el aliado perfecto para lograr unas uñas impecables y duraderas. Este esmalte en gel se destaca por su secado uniforme y su excelente pigmentación, brindándote resultados profesionales en cada aplicación.\r\n', 25900.00, 'esmalte-semipermanente-gematic-b479.webp', NULL, NULL),
(21, 'Cortaunas Jumbo ZAFHIRS 1 und', 'producto:\r\nCortaúñas metálico grande, ideal para las uñas de los pies.\r\n', 9300.00, 'cortaunas-jumbo-corte-recto-602220_a.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_contraseña`
--

CREATE TABLE `recuperacion_contraseña` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacion_contraseña`
--

INSERT INTO `recuperacion_contraseña` (`id`, `correo`, `token`, `expiracion`, `usuario_id`, `cliente_id`) VALUES
(1, 'felipemuhalo2@gmail.com', 'bc06877e8db2b1e0ccb2ed150ec5a83fc9814804b43b77059ce518f4f88fcfe380d4b31c0b22df5b17c1d492c04a8b0722d9', '2024-10-01 18:58:18', NULL, NULL),
(2, 'felipemuhalo2@gmail.com', '60f34dc12a9ffb061b320cc7d8bca2b56ea899454df7316838e1f2a2a3694d67c61308e11e887e43b86342b8036b54a9e988', '2024-10-01 19:09:03', NULL, NULL),
(3, 'felipemuhalo2@gmail.com', '0a922a066dca89d75af48c14ae8234f837c996ca084ced1cc51f41c38bab5ffcb8eb29639b24fab5422f5b002378568151f8', '2024-10-01 19:29:54', NULL, NULL),
(4, 'felipemuhalo2@gmail.com', '7f7e2b4a72545c71af7c4748b887f90e83a5bf22e280b9c02144dfbed90e77387ed17b70c5e26f44b82e4684e7c1d4bf7c6b', '2024-10-01 19:31:48', NULL, NULL),
(5, 'felipemuhalo2@gmail.com', 'd9d6fbe78a6f1f4045d92c4895846b97d5c44e38693c56d0b2aab3a2fc669de30065252c8e5c1614ad2756eb976bc93acba8', '2024-10-01 19:34:37', NULL, NULL),
(6, 'felipemuhalo2@gmail.com', 'ac5bdb6df0f1a08cc5413e7bb6216e91e6c9e0a29bd4cd5dbd59a909e28366a300f96227812e0d9896244b8578090e9f3bf9', '2024-10-01 19:42:48', NULL, NULL),
(7, 'felipemuhalo2@gmail.com', 'f4c56dc71ce8763c207d74a0a41291b7dc93cf32ae2f865c98c248f367b05bc6292929e7a4da0e5bff955cdac74e28e21fa3', '2024-10-01 19:58:06', NULL, NULL),
(8, 'felipemuhalo2@gmail.com', '1d5ebd8592b61f7957f80a8a3917881cc64f4f3e10c73159058571f909480321bf1d4f8e6a6f5ca25733c6c144b890462cd2', '2024-10-01 19:58:38', NULL, NULL),
(9, 'felipemuhalo2@gmail.com', '0d2ed972a66f00de21abf8e738bf693dd53db7e0f1865d421c005d3bdf62b5269ab29fc1b100f84794cc901b0856f3221971', '2024-10-01 20:02:17', NULL, NULL),
(10, 'felipemuhalo2@gmail.com', 'ce31436968485edc2f465951247bf00b69eca354264336c05f3d23d6afb89817e897f36df00706e0cd87165029bf73850f58', '2024-10-01 20:05:09', NULL, NULL),
(11, 'felipemuhalo2@gmail.com', '04ce7fb23529df9bc617150d86b66925c86eef1c5bbf8b884b198e5278a3e0e9e78b9afd33579a7fbdb284c721e83f35159f', '2024-10-01 20:11:44', NULL, NULL),
(12, 'felipemuhalo2@gmail.com', '0488aa0d20b5d849202bcfc4faa1275f3d9cccd3238d8daddd66f3c59715dcf066ed6434c2253e7ad922d9a65216e789e96b', '2024-10-01 20:16:53', NULL, NULL),
(14, 'felipemuhalo@gmail.com', 'ad6c73251ce6170e73f242fb6c62bea546e029d174b7397d3aac3e442204c64a7dd9bf3b808bfe8e520c9a276199e1a25433', '2024-10-01 21:48:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `video`, `usuario_id`, `whatsapp`) VALUES
(11, 'Pedicure tradicional', 'La mejor definición de pedicura es: tratamiento cosmético superficial de las uñas de los pies', 13000.00, 'pedicuretradicional.jpg', NULL, NULL, 'https://wa.me/573209864428'),
(12, 'Manicure tradicional', 'En el caso de la técnica tradicional, se utiliza esmalte de uñas regular que no se cura con ningún dispositivo.', 13000.00, 'manicuretradicional.webp', NULL, NULL, 'https://wa.me/573209864428'),
(13, 'Masajes corporales', 'El masaje es un tipo de medicina integral en la que un masajista frota y presiona firmemente la piel, los músculos, los tendones y los ligamentos.', 61000.00, 'masajes.jpeg', NULL, NULL, 'https://wa.me/573209864428'),
(14, 'Pedicure semipermanente', 'La manicura semipermanente es un esmaltado de secado inmediato y de larga duración que mantiene un resultado reluciente.', 50000.00, 'semipermanente.jpg', NULL, NULL, 'https://wa.me/573209864428'),
(15, 'Manicure en acrílico ', 'Las uñas acrílicas o artificiales son extensiones que se ponen sobre la uña natural con distintas técnicas o bien materiales', 150000.00, 'acrilicouñas.jpg', NULL, NULL, 'https://wa.me/573209864428'),
(18, 'Maquillaje', 'A pesar de que en un primer nivel de análisis el maquillaje pudiera parecer una técnica decorativa un tanto frívola, nada más lejos de la realidad.', 30000.00, 'Maquillaje.jfif', NULL, NULL, 'https://api.whatsapp.com/send/?phone=573209864428&text=%C2%A1Hola%21+Estoy+interesado+en+el+servicio+de+Manicure+tradicional.&type=phone_number&app_absent=0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `telefono`, `contraseña`, `fecha_registro`, `role`) VALUES
(6, 'Admin Felipe', 'felipemuhalo@gmail.com', '3138556776', '$2y$10$xqhPwO03nvIwryygwbN9zOvhX527bjIi031yCqA0.jhC5ScNfwm16', '2024-10-16 02:15:07', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `factura_carrito`
--
ALTER TABLE `factura_carrito`
  ADD PRIMARY KEY (`factura_id`,`carrito_id`),
  ADD KEY `fk_factura_carrito_carrito` (`carrito_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensajes_usuarios` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_usuarios` (`usuario_id`);

--
-- Indices de la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recuperacion_usuarios` (`usuario_id`),
  ADD KEY `fk_recuperacion_clientes` (`cliente_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicios_usuarios` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_carrito`
--
ALTER TABLE `factura_carrito`
  ADD CONSTRAINT `factura_carrito_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `factura_carrito_ibfk_2` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_factura_carrito_carrito` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_factura_carrito_factura` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `recuperacion_contraseña`
--
ALTER TABLE `recuperacion_contraseña`
  ADD CONSTRAINT `fk_recuperacion_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recuperacion_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_servicios_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
