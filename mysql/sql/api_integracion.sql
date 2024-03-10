-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 01:21:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api_integracion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayuntamientos`
--
CREATE DATABASE `api_integracion`;
USE `api_integracion`;
CREATE TABLE `ayuntamientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_token` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ayuntamientos`
--

INSERT INTO `ayuntamientos` (`id`, `id_token`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2024-03-10 00:19:27', '2024-03-10 00:19:27'),
(2, 3, 3, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(3, 4, 4, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(4, 5, 5, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(5, 6, 6, '2024-03-10 00:19:28', '2024-03-10 00:19:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Eventos', 'Eventos', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(2, 'Promociones', 'Promociones', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(3, 'Descuentos', 'Descuentos', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(4, 'Gastronomía', 'Gastronomia', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(5, 'Anime', 'Anime', '2024-03-10 00:19:22', '2024-03-10 00:19:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercios`
--

CREATE TABLE `comercios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_categoria` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comercios`
--

INSERT INTO `comercios` (`id`, `descripcion`, `id_usuario`, `id_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Comercio#12', 12, 2, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(2, 'Comercio#13', 13, 2, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(3, 'Comercio#14', 14, 3, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(4, 'Comercio#15', 15, 2, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(5, 'Comercio#16', 16, 3, '2024-03-10 00:19:29', '2024-03-10 00:19:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Diseño', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(2, 'Videos', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(3, 'News', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(4, 'Programación', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(5, 'Anime', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(6, 'Eventos', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(7, 'Cercano', '2024-03-10 00:19:22', '2024-03-10 00:19:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas_comercios`
--

CREATE TABLE `etiquetas_comercios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_etiqueta` bigint(20) UNSIGNED NOT NULL,
  `id_comercio` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas_publicaciones`
--

CREATE TABLE `etiquetas_publicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_etiqueta` bigint(20) UNSIGNED NOT NULL,
  `id_publicacion` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `etiquetas_publicaciones`
--

INSERT INTO `etiquetas_publicaciones` (`id`, `id_etiqueta`, `id_publicacion`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(2, 5, 3, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(3, 1, 3, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(4, 3, 2, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(5, 4, 5, '2024-03-10 00:19:31', '2024-03-10 00:19:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_municipios_table', 1),
(2, '2014_10_12_000001_create_users_table', 1),
(3, '2014_10_12_000002_create_password_resets_table', 1),
(4, '2014_10_12_000003_create_failed_jobs_table', 1),
(5, '2014_10_12_000005_create_particulares_table', 1),
(6, '2014_10_12_000006_create_categorias_table', 1),
(7, '2014_10_12_000007_create_comercios_table', 1),
(8, '2014_10_12_000008_create_publican_table', 1),
(9, '2014_10_12_000008_create_tokens_table', 1),
(10, '2014_10_12_000009_create_ayuntamientos_table', 1),
(11, '2014_10_12_000010_create_seguidos_table', 1),
(12, '2014_10_12_000010_create_tipo_publicaciones_table', 1),
(13, '2014_10_12_000011_create_publicaciones_table', 1),
(14, '2014_10_12_150751_create_etiquetas_table', 1),
(15, '2014_10_12_151401_create_etiquetas_comercios_table', 1),
(16, '2014_10_12_152359_create_etiquetas_publicaciones_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2024_02_26_110617_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Los Llanos', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(2, 'Santa Cruz', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(3, 'Breña Alta', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(4, 'Breña Baja', '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(5, 'Mazo', '2024-03-10 00:19:21', '2024-03-10 00:19:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `particulares`
--

CREATE TABLE `particulares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `sexo` char(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `particulares`
--

INSERT INTO `particulares` (`id`, `apellidos`, `sexo`, `edad`, `fecha_nacimiento`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'apellido1_apellido2_de_7', 'Masculino', 71, '2001-10-03', 7, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(2, 'apellido1_apellido2_de_8', 'Femenino', 34, '1954-12-25', 8, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(3, 'apellido1_apellido2_de_9', 'Femenino', 23, '2005-12-26', 9, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(4, 'apellido1_apellido2_de_10', 'Femenino', 36, '1946-01-02', 10, '2024-03-10 00:19:28', '2024-03-10 00:19:28'),
(5, 'apellido1_apellido2_de_11', 'Masculino', 58, '1963-04-25', 11, '2024-03-10 00:19:28', '2024-03-10 00:19:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ver_usuario', 'web', '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(2, 'crear_usuario', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(3, 'consultar_usuario', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(4, 'modificar_usuario', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(5, 'borrar_usuario', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(6, 'ver_ayuntamiento', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(7, 'crear_ayuntamiento', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(8, 'consultar_ayuntamiento', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(9, 'modificar_ayuntamiento', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(10, 'borrar_ayuntamiento', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(11, 'ver_comercio', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(12, 'crear_comercio', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(13, 'consultar_comercio', 'web', '2024-03-10 00:19:32', '2024-03-10 00:19:32'),
(14, 'modificar_comercio', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(15, 'borrar_comercio', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(16, 'ver_particular', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(17, 'crear_particular', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(18, 'consultar_particular', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(19, 'modificar_particular', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(20, 'borrar_particular', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(21, 'ver_publica', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(22, 'crear_publica', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(23, 'consultar_publica', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(24, 'modificar_publica', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(25, 'borrar_publica', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(26, 'ver_publicacion', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(27, 'crear_publicacion', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(28, 'consultar_publicacion', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(29, 'modificar_publicacion', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(30, 'borrar_publicacion', 'web', '2024-03-10 00:19:33', '2024-03-10 00:19:33'),
(31, 'ver_seguido', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(32, 'crear_seguido', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(33, 'consultar_seguido', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(34, 'modificar_seguido', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(35, 'borrar_seguido', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(36, 'ver_tipo_publicacion', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(37, 'crear_tipo_publicacion', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(38, 'consultar_tipo_publicacion', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(39, 'modificar_tipo_publicacion', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(40, 'borrar_tipo_publicacion', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(41, 'ver_categoria', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(42, 'crear_categoria', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(43, 'consultar_categoria', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(44, 'modificar_categoria', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(45, 'borrar_categoria', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(46, 'ver_token', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(47, 'crear_token', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(48, 'consultar_token', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(49, 'modificar_token', 'web', '2024-03-10 00:19:34', '2024-03-10 00:19:34'),
(50, 'borrar_token', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(51, 'ver_etiquetas', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(52, 'crear_etiquetas', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(53, 'consultar_etiquetas', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(54, 'modificar_etiquetas', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(55, 'borrar_etiquetas', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(56, 'ver_municipio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(57, 'crear_municipio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(58, 'consultar_municipio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(59, 'modificar_municipio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(60, 'borrar_municipio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(61, 'ver_comercio_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(62, 'crear_comercio_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(63, 'consultar_comercio_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(64, 'modificar_comercio_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(65, 'borrar_comercio_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(66, 'ver_publicacion_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(67, 'crear_publicacion_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(68, 'consultar_publicacion_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(69, 'modificar_publicacion_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(70, 'borrar_publicacion_etiqueta', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(71, 'es_admin', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(72, 'es_ayuntamiento', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(73, 'es_comercio', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35'),
(74, 'es_particular', 'web', '2024-03-10 00:19:35', '2024-03-10 00:19:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `id_tipo` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `titulo`, `descripcion`, `imagen`, `fecha_publicacion`, `fecha_inicio`, `fecha_fin`, `activo`, `id_tipo`, `created_at`, `updated_at`) VALUES
(1, 'Titulo de Post#1', 'Descripcion  de la publicación número 1', 'imagen_1.png', '2019-06-25', '2024-03-01', '2024-02-06', 1, 1, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(2, 'Titulo de Post#2', 'Descripcion  de la publicación número 2', 'imagen_2.png', '2020-02-16', '2020-12-21', '2022-07-22', 1, 3, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(3, 'Titulo de Post#3', 'Descripcion  de la publicación número 3', 'imagen_3.png', '2023-08-11', '2023-03-01', '2023-06-05', 1, 1, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(4, 'Titulo de Post#4', 'Descripcion  de la publicación número 4', 'imagen_4.png', '2021-07-11', '2024-01-26', '2024-01-28', 1, 5, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(5, 'Titulo de Post#5', 'Descripcion  de la publicación número 5', 'imagen_5.png', '2021-12-25', '2022-09-09', '2024-03-03', 1, 3, '2024-03-10 00:19:30', '2024-03-10 00:19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publican`
--

CREATE TABLE `publican` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_publicacion` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publican`
--

INSERT INTO `publican` (`id`, `id_usuario`, `id_publicacion`, `created_at`, `updated_at`) VALUES
(1, 15, 5, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(2, 11, 5, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(3, 13, 4, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(4, 13, 5, '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(5, 14, 3, '2024-03-10 00:19:31', '2024-03-10 00:19:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(2, 'comercio', 'web', '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(3, 'ayuntamiento', 'web', '2024-03-10 00:19:31', '2024-03-10 00:19:31'),
(4, 'particular', 'web', '2024-03-10 00:19:31', '2024-03-10 00:19:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(9, 1),
(9, 3),
(10, 1),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(17, 1),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(26, 2),
(26, 3),
(26, 4),
(27, 1),
(28, 1),
(28, 2),
(28, 3),
(28, 4),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(32, 1),
(32, 2),
(32, 3),
(32, 4),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(34, 1),
(35, 1),
(36, 1),
(36, 2),
(36, 3),
(36, 4),
(37, 1),
(38, 1),
(38, 4),
(39, 1),
(40, 1),
(41, 1),
(41, 2),
(41, 3),
(41, 4),
(42, 1),
(43, 1),
(43, 4),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(51, 2),
(51, 3),
(51, 4),
(52, 1),
(53, 1),
(53, 2),
(53, 3),
(53, 4),
(54, 1),
(55, 1),
(56, 1),
(56, 2),
(56, 3),
(56, 4),
(57, 1),
(58, 1),
(58, 2),
(58, 3),
(58, 4),
(59, 1),
(60, 1),
(61, 1),
(61, 2),
(61, 3),
(61, 4),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(66, 2),
(66, 3),
(66, 4),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 3),
(73, 2),
(74, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidos`
--

CREATE TABLE `seguidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_seguidor` bigint(20) UNSIGNED NOT NULL,
  `id_seguido` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seguidos`
--

INSERT INTO `seguidos` (`id`, `id_seguidor`, `id_seguido`, `created_at`, `updated_at`) VALUES
(1, 10, 15, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(2, 7, 13, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(3, 7, 14, '2024-03-10 00:19:29', '2024-03-10 00:19:29'),
(4, 7, 14, '2024-03-10 00:19:30', '2024-03-10 00:19:30'),
(5, 6, 15, '2024-03-10 00:19:30', '2024-03-10 00:19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_publicaciones`
--

CREATE TABLE `tipo_publicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_publicaciones`
--

INSERT INTO `tipo_publicaciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Eventos', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(2, 'Promociones', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(3, 'Descuentos', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(4, 'Gastronomía', '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(5, 'Anime', '2024-03-10 00:19:22', '2024-03-10 00:19:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `valor` varchar(255) NOT NULL,
  `usado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `valor`, `usado`, `created_at`, `updated_at`) VALUES
(1, 'nBA2xXiCARK27DMA', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(2, 'pFX2so9r6HuL3O1Z', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(3, 'tvAKgqad4iUlmvSS', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(4, 'DAUe7ClSJuuoTo3R', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(5, 'ScK6C0oItoOTldeo', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(6, 'tX91nPoNHW6zJXxF', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(7, '4m0adlEON95HzITC', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(8, '0G6RNSdz2m6GWcDn', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(9, 'kmB6AZ6Lnve6VDMJ', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21'),
(10, '6rUnnus9G53uVlJV', 0, '2024-03-10 00:19:21', '2024-03-10 00:19:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `id_municipio` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `nombre`, `direccion`, `email`, `email_verified_at`, `telefono`, `avatar`, `remember_token`, `id_municipio`, `created_at`, `updated_at`) VALUES
(1, 'admin_1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin de Zona ', 'Santa Cruz', 'Santa Cruz@administradores.com', '2024-03-10 00:19:22', '92515064', 'admin_Santa Cruz.png', 'F2pk6m76uN', 1, '2024-03-10 00:19:22', '2024-03-10 00:19:22'),
(2, 'ayuntamiento_0', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayuntamiento de Los Llanos', 'Los Llanos', 'Los Llanos@ayuntamientos.com', '2024-03-10 00:19:23', '396122438', 'ayuntamientoLos Llanos.png', 'M3BeVRgIsO', 1, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(3, 'ayuntamiento_1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayuntamiento de Santa Cruz', 'Santa Cruz', 'Santa Cruz@ayuntamientos.com', '2024-03-10 00:19:23', '459796542', 'ayuntamientoSanta Cruz.png', 'muUgtkPjy2', 2, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(4, 'ayuntamiento_2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayuntamiento de Breña Alta', 'Breña Alta', 'Breña Alta@ayuntamientos.com', '2024-03-10 00:19:23', '691458970', 'ayuntamientoBreña Alta.png', 'OiUbThTDdw', 3, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(5, 'ayuntamiento_3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayuntamiento de Breña Baja', 'Breña Baja', 'Breña Baja@ayuntamientos.com', '2024-03-10 00:19:23', '144641869', 'ayuntamientoBreña Baja.png', 'EZ4hgwdb71', 4, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(6, 'ayuntamiento_4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayuntamiento de Mazo', 'Mazo', 'Mazo@ayuntamientos.com', '2024-03-10 00:19:23', '582275663', 'ayuntamientoMazo.png', '6Pv9Nuayl0', 5, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(7, 'cliente_0', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nombre de cliente 0', 'Los Llanos', 'cliente_0@particulares.com', '2024-03-10 00:19:23', '133122336', 'cliente_0.png', 'BB8XNVtJIr', 1, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(8, 'cliente_1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nombre de cliente 1', 'Santa Cruz', 'cliente_1@particulares.com', '2024-03-10 00:19:23', '245692180', 'cliente_1.png', 'yUt9kUdB6M', 2, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(9, 'cliente_2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nombre de cliente 2', 'Breña Alta', 'cliente_2@particulares.com', '2024-03-10 00:19:23', '380558804', 'cliente_2.png', 'OgnwcoAZpE', 3, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(10, 'cliente_3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nombre de cliente 3', 'Breña Baja', 'cliente_3@particulares.com', '2024-03-10 00:19:23', '551427197', 'cliente_3.png', '2sPwtJ49Hi', 4, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(11, 'cliente_4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nombre de cliente 4', 'Mazo', 'cliente_4@particulares.com', '2024-03-10 00:19:23', '30198889', 'cliente_4.png', 'vWesCEl1tS', 5, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(12, 'comercio_0', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Comercio de Los Llanos', 'Los Llanos', 'comercio_Los Llanos@comercios.com', '2024-03-10 00:19:23', '849515873', 'comercioLos Llanos.png', 'yezGeAD31V', 1, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(13, 'comercio_1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Comercio de Santa Cruz', 'Santa Cruz', 'comercio_Santa Cruz@comercios.com', '2024-03-10 00:19:23', '562623670', 'comercioSanta Cruz.png', 'lH4dn4gOG9', 2, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(14, 'comercio_2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Comercio de Breña Alta', 'Breña Alta', 'comercio_Breña Alta@comercios.com', '2024-03-10 00:19:23', '709369266', 'comercioBreña Alta.png', 'cCUHgmeVkh', 3, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(15, 'comercio_3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Comercio de Breña Baja', 'Breña Baja', 'comercio_Breña Baja@comercios.com', '2024-03-10 00:19:23', '252980264', 'comercioBreña Baja.png', 'NPShqvDKWq', 4, '2024-03-10 00:19:23', '2024-03-10 00:19:23'),
(16, 'comercio_4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Comercio de Mazo', 'Mazo', 'comercio_Mazo@comercios.com', '2024-03-10 00:19:23', '221812282', 'comercioMazo.png', 'dI1vFR1u2q', 5, '2024-03-10 00:19:23', '2024-03-10 00:19:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ayuntamientos`
--
ALTER TABLE `ayuntamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ayuntamientos_id_token_foreign` (`id_token`),
  ADD KEY `ayuntamientos_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comercios`
--
ALTER TABLE `comercios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comercios_id_usuario_foreign` (`id_usuario`),
  ADD KEY `comercios_id_categoria_foreign` (`id_categoria`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiquetas_comercios`
--
ALTER TABLE `etiquetas_comercios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etiquetas_comercios_id_etiqueta_foreign` (`id_etiqueta`),
  ADD KEY `etiquetas_comercios_id_comercio_foreign` (`id_comercio`);

--
-- Indices de la tabla `etiquetas_publicaciones`
--
ALTER TABLE `etiquetas_publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etiquetas_publicaciones_id_etiqueta_foreign` (`id_etiqueta`),
  ADD KEY `etiquetas_publicaciones_id_publicacion_foreign` (`id_publicacion`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `particulares`
--
ALTER TABLE `particulares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `particulares_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publicaciones_id_tipo_foreign` (`id_tipo`);

--
-- Indices de la tabla `publican`
--
ALTER TABLE `publican`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publican_id_usuario_foreign` (`id_usuario`),
  ADD KEY `publican_id_publicacion_foreign` (`id_publicacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `seguidos`
--
ALTER TABLE `seguidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seguidos_id_seguidor_foreign` (`id_seguidor`),
  ADD KEY `seguidos_id_seguido_foreign` (`id_seguido`);

--
-- Indices de la tabla `tipo_publicaciones`
--
ALTER TABLE `tipo_publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_municipio_foreign` (`id_municipio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ayuntamientos`
--
ALTER TABLE `ayuntamientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comercios`
--
ALTER TABLE `comercios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `etiquetas_comercios`
--
ALTER TABLE `etiquetas_comercios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiquetas_publicaciones`
--
ALTER TABLE `etiquetas_publicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `particulares`
--
ALTER TABLE `particulares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `publican`
--
ALTER TABLE `publican`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seguidos`
--
ALTER TABLE `seguidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_publicaciones`
--
ALTER TABLE `tipo_publicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ayuntamientos`
--
ALTER TABLE `ayuntamientos`
  ADD CONSTRAINT `ayuntamientos_id_token_foreign` FOREIGN KEY (`id_token`) REFERENCES `tokens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayuntamientos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comercios`
--
ALTER TABLE `comercios`
  ADD CONSTRAINT `comercios_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comercios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `etiquetas_comercios`
--
ALTER TABLE `etiquetas_comercios`
  ADD CONSTRAINT `etiquetas_comercios_id_comercio_foreign` FOREIGN KEY (`id_comercio`) REFERENCES `comercios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etiquetas_comercios_id_etiqueta_foreign` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `etiquetas_publicaciones`
--
ALTER TABLE `etiquetas_publicaciones`
  ADD CONSTRAINT `etiquetas_publicaciones_id_etiqueta_foreign` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etiquetas_publicaciones_id_publicacion_foreign` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `particulares`
--
ALTER TABLE `particulares`
  ADD CONSTRAINT `particulares_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_publicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publican`
--
ALTER TABLE `publican`
  ADD CONSTRAINT `publican_id_publicacion_foreign` FOREIGN KEY (`id_publicacion`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publican_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seguidos`
--
ALTER TABLE `seguidos`
  ADD CONSTRAINT `seguidos_id_seguido_foreign` FOREIGN KEY (`id_seguido`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguidos_id_seguidor_foreign` FOREIGN KEY (`id_seguidor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
