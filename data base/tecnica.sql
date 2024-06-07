-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2024 a las 20:53:24
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnica`
--
CREATE DATABASE IF NOT EXISTS `tecnica` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tecnica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_p`
--

CREATE TABLE `asistencia_p` (
  `id_ap` int(11) NOT NULL,
  `nro_pp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dependencia_p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ctd_equipos` int(255) NOT NULL,
  `act_ejecutadas` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_rp` date NOT NULL,
  `fecha_cp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_s`
--

CREATE TABLE `asistencia_s` (
  `id_as` int(11) NOT NULL,
  `falla` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_r` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

CREATE TABLE `informe` (
  `id_if` int(11) NOT NULL,
  `motivo` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_c` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id_items` int(11) NOT NULL,
  `nro_p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dependencia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostico_act` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `obs_sugerencias` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `id_as` int(255) NOT NULL,
  `id_if` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia_p`
--
ALTER TABLE `asistencia_p`
  ADD PRIMARY KEY (`id_ap`);

--
-- Indices de la tabla `asistencia_s`
--
ALTER TABLE `asistencia_s`
  ADD PRIMARY KEY (`id_as`);

--
-- Indices de la tabla `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`id_if`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_items`),
  ADD KEY `id_if` (`id_if`),
  ADD KEY `id_as` (`id_as`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia_p`
--
ALTER TABLE `asistencia_p`
  MODIFY `id_ap` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asistencia_s`
--
ALTER TABLE `asistencia_s`
  MODIFY `id_as` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `informe`
--
ALTER TABLE `informe`
  MODIFY `id_if` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
