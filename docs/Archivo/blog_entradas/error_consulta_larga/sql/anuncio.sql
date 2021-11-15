-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-09-2021 a las 01:57:02
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testveiculos`
--

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT IGNORE INTO `anuncio` (`idanuncio`, `nombre`, `pagado`, `direccion`, `telefono`, `email`, `idcategoria`, `idmarca`, `idmodelo`, `year`, `idclasificacion`, `idcondicion`, `idtransmission`, `licencia`, `multas`, `millage`, `descripcion`, `imagen`, `full_lablel`, `idpueblo`, `precio`, `mejoroferta`) VALUES
(95, 'Carlos Aleman', 'si', NULL, '123123425', 'mail@mial.com', 2, 1, 2, 2023, 1, 4, 1, 'si', 'si', 20000, 'DEscripcioo0n ', NULL, 'si', 2, '30000.00', 'si');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
