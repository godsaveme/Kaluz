-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-07-2015 a las 10:32:12
-- Versión del servidor: 5.5.40-MariaDB-1~saucy-log
-- Versión de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `salesfly`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccFiscal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruc` int(11) DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'codigo de barras, puede ser con letras..',
  `fechaNac` datetime DEFAULT NULL,
  `genero` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fijo` int(11) DEFAULT NULL,
  `movil` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8_unicode_ci,
  `direccContac` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departamento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notas` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `nombres`, `apellidos`, `empresa`, `direccFiscal`, `ruc`, `codigo`, `fechaNac`, `genero`, `fijo`, `movil`, `email`, `website`, `direccContac`, `distrito`, `provincia`, `departamento`, `pais`, `notas`, `created_at`, `updated_at`) VALUES
(1, 'customer name', 'customer lastname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 20:10:05', '2015-07-11 20:10:05'),
(2, 'x2', 'x2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 20:11:59', '2015-07-11 20:11:59'),
(3, 'dsd2', 'dasd2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 20:18:38', '2015-07-11 20:21:51'),
(4, 'f1', 'f2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:30:34', '2015-07-11 21:30:34'),
(5, 'f3', 'f4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:31:21', '2015-07-11 21:31:21'),
(6, '1', '2', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:34:32', '2015-07-11 21:34:32'),
(7, '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:35:06', '2015-07-11 21:35:06'),
(8, 'v1', 'v2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:46:46', '2015-07-11 21:46:46'),
(10, 'm7', 'm7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:49:49', '2015-07-11 21:49:49'),
(11, '1', '1', NULL, NULL, NULL, NULL, '2015-07-22 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:52:31', '2015-07-11 21:52:31'),
(13, 'er', 'ert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 21:57:51', '2015-07-11 21:57:51'),
(14, 'col', 'col', NULL, NULL, NULL, NULL, '1986-12-24 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 22:00:46', '2015-07-11 22:00:46'),
(22, 'Raul', 'Morales', 'porvenir', 'los amarantos', 82348234, '000001', '2005-03-15 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 22:42:51', '2015-07-11 22:42:52'),
(23, 'Pedro', 'Perez', 'zapateria el milagro', 'los kiqupis', 2147483647, '000002', '1980-12-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-11 22:44:03', '2015-07-11 22:44:03'),
(27, 'd', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 01:52:18', '2015-07-12 01:52:18'),
(28, 'h', 'h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 01:52:47', '2015-07-12 01:52:47'),
(29, '89', '89', NULL, NULL, NULL, NULL, '2026-02-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 01:56:04', '2015-07-12 01:56:04'),
(30, 'fecha incorrecta', 'sii', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:16:59', '2015-07-12 02:16:59'),
(31, 'fecha incorrecta', 'sii', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:20:38', '2015-07-12 02:20:39'),
(32, 'fecha correcta', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:31:01', '2015-07-12 02:31:01'),
(33, 'oko', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:31:46', '2015-07-12 02:31:46'),
(34, 'fecha ok', 'fecha ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:35:13', '2015-07-12 02:35:13'),
(35, 'ok', 'ok', NULL, NULL, NULL, NULL, '2000-01-01 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:36:18', '2015-07-12 02:36:18'),
(36, 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:36:50', '2015-07-12 02:36:50'),
(37, 'ok', 'ok', NULL, NULL, NULL, NULL, '2015-01-01 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:37:08', '2015-07-12 02:37:08'),
(38, 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:37:32', '2015-07-12 02:37:32'),
(39, 'ok', 'ok', NULL, NULL, NULL, NULL, '2015-12-01 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:40:08', '2015-07-12 02:40:08'),
(40, 'ok', 'ok', NULL, NULL, NULL, NULL, '2010-12-01 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:40:32', '2015-07-12 02:40:32'),
(41, 'ok', 'ok', NULL, NULL, NULL, NULL, '2010-12-01 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:40:55', '2015-07-12 02:40:55'),
(42, 'ok1', 'ok1', NULL, NULL, NULL, NULL, '2010-12-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:44:27', '2015-07-12 02:44:27'),
(43, 'fecha inc', 'fecha inc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:45:18', '2015-07-12 02:45:18'),
(44, 'fecha inc', 'fecha inc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:46:02', '2015-07-12 02:46:02'),
(45, 'fecha corr', 'fecha corre', NULL, NULL, NULL, NULL, '2000-02-29 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 02:46:25', '2015-07-12 02:46:25'),
(49, 'c', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 03:40:57', '2015-07-12 03:40:57'),
(51, 'x', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 03:53:10', '2015-07-12 03:53:10'),
(52, 'c', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 03:57:51', '2015-07-12 03:57:51'),
(55, 'c', 'c', NULL, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 04:08:53', '2015-07-12 04:08:53'),
(56, 'c', 'c', NULL, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 04:09:40', '2015-07-12 04:09:40'),
(57, 'd', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:42:16', '2015-07-12 06:42:16'),
(58, 'name', 'app', 'empre', 'dire fis', 0, '001', '2000-12-10 05:00:00', 'M', 123, 456, 'jalvarez@honeysoft.pe', 'lospollos.com', NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:43:07', '2015-07-12 18:54:03'),
(59, 'c', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'chicl', 'lamba', 'peru', 'holaaaa', '2015-07-12 06:43:57', '2015-07-12 06:43:57'),
(60, 'd', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'chi', 'lamb', 'peru', NULL, '2015-07-12 06:46:50', '2015-07-12 06:46:50'),
(61, 'asd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:54:19', '2015-07-12 06:54:19'),
(62, 'c2', 'c2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:56:44', '2015-07-12 06:56:44'),
(63, '456', '456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:58:23', '2015-07-12 06:58:24'),
(64, 'g', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:58:40', '2015-07-12 06:58:40'),
(65, 'asd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:59:14', '2015-07-12 06:59:14'),
(66, 'gtg1', 'gtg1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 06:59:26', '2015-07-12 06:59:43'),
(67, 'dddddd', 'ddddd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 07:00:09', '2015-07-12 07:00:09'),
(68, 'javier', 'alvarez', 'honeysoft', 'arbulu', 2147483647, '00001', '2008-01-25 10:00:00', '', 613511, 948535127, 'jalvarez@honeysoft.pe', 'honeysoft.pe', 'arbuñu', 'chi', 'chi', 'lam', 'per', 'notas', '2015-07-12 07:01:24', '2015-07-12 19:06:01'),
(69, '45', '456456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 07:03:43', '2015-07-12 07:03:43'),
(70, 'asd', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 07:04:10', '2015-07-12 07:04:10'),
(71, 'v34', 'v234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'los amapoles', NULL, NULL, NULL, NULL, NULL, '2015-07-12 07:11:36', '2015-07-12 07:11:36'),
(72, 'vv5', 'v5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:33:47', '2015-07-12 17:33:47'),
(73, 'gh', 'gh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:41:48', '2015-07-12 17:41:48'),
(74, 'bt', 'bt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:41:59', '2015-07-12 17:41:59'),
(75, 'v4', 'v4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:43:58', '2015-07-12 17:43:58'),
(76, 'v5', 'v5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:44:39', '2015-07-12 17:44:40'),
(77, 'v5', 'v5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:45:14', '2015-07-12 17:45:14'),
(78, 'rty', 'rtyrty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:45:51', '2015-07-12 17:45:51'),
(79, 'yyt', 'tyutyu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:47:24', '2015-07-12 17:47:24'),
(80, 'gg', 'gg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:48:04', '2015-07-12 17:48:04'),
(81, 'sfsdfsdf', 'sdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:49:24', '2015-07-12 17:49:24'),
(82, 'asd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:49:43', '2015-07-12 17:49:43'),
(83, 'asdasd', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:50:04', '2015-07-12 17:50:04'),
(84, 'asasdasd', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 17:53:01', '2015-07-12 17:53:01'),
(86, 'v5', 'v5', NULL, NULL, NULL, NULL, '1980-06-11 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-12 19:08:24', '2015-07-12 19:09:14'),
(87, 'Laura Virginia', 'Montenegro Chimpen', 'renaware', 'direc fiscal', 1016632450, '100', '1946-04-23 00:00:00', 'F', 613511, 97462536, 'laurachim@hotmail.com', 'laura.com', 'arbulu neyra 133', 'chi', 'chi', 'lamb', 'peru', 'notas de laura', '2015-07-12 19:22:48', '2015-07-12 19:26:20'),
(88, 'abelardo', 'alvarez zamora', 'tienda sac', 'direcc fiscal', 1045635421, '1001', '1944-05-25 00:00:00', 'M', 613511, 96467362, 'abelardo@hot.com', 'abe.com', 'arbulu neyra 133', 'chi', 'chi', 'lamb', 'peru', 'notas de abe', '2015-07-12 19:27:59', '2015-07-12 19:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `name`, `lastname`) VALUES
(1, 'Felipe Luis', 'Castro Ulloa'),
(2, 'Manuel', 'Vasquez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `shortname`, `descripcion`) VALUES
(1, 'Administrador', 'admin', 'Administrador General del Sistema.'),
(2, 'Cajero', 'ca', 'Cajero del Sistema.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTienda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razonSocial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ruc` int(11) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `distrito` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'display name',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `store_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`),
  KEY `role_id_2` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `image`, `store_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Javier Jesús Alvarez Montenegro', 'jalvarez@honeysoft.pe', '$2y$10$H2IMMhqYJZJGCOhLVfpUkOzQwl1UDdEGLyP2KEMp0FcybBFoL/3ve', 'Mb0MmnM74Azqq6baibFGUHxcOHzjgZsLC3RPcdG5ZP0CyW1SQkLLGqyM4qxz', NULL, 1, 1, '0000-00-00 00:00:00', '2015-07-16 16:41:30');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
