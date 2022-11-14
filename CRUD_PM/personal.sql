-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-12-2016 a las 17:13:23
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `personal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado_civil` varchar(30) NOT NULL,
  `hijos` int(11) NOT NULL,
  `intereses` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `correo`, `telefono`, `estado_civil`, `hijos`, `intereses`) VALUES
(1, 'MARKO', 'marko@mail.com', '55123654789', 'SOLTERO', 0, 'BICICLETA'),
(2, 'asdfadsf', 'asdfasd', 'asdfasdf', 'sadfasdf', 1, 'asdfsdf'),
(3, 'asdasd', 'email', '135151351', 'CASADO', 1, 'Libros Musica'),
(4, 'Marko Robles', 'marko@mail.com', '5532165498', 'SOLTERO', 0, 'Libros,Musica,'),
(5, 'Ejemplo', 'email', '55654987', 'OTRO', 1, 'Deportes,Otros'),
(8, '1', '1@1.com', '1', 'SOLTERO', 1, '"Libros","Musica","Deportes","Otros"'),
(9, 'asdf', 'sdaf@sadf.com', '51351351', 'SOLTERO', 0, ''),
(10, 'asdf', 'sdaf@sadf.com', '51351351', 'SOLTERO', 0, '');
