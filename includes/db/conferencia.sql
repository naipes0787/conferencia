-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2019 at 07:45 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conferencia`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria_evento`
--

CREATE TABLE `categoria_evento` (
  `id` tinyint(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `icono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria_evento`
--

INSERT INTO `categoria_evento` (`id`, `descripcion`, `icono`) VALUES
(1, 'Seminario', 'fa-university'),
(2, 'Conferencias', 'fa-comment'),
(3, 'Talleres', 'fa-code');

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` tinyint(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_categoria_evento` tinyint(10) NOT NULL,
  `id_invitado` tinyint(4) NOT NULL,
  `clave` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `fecha`, `hora`, `id_categoria_evento`, `id_invitado`, `clave`) VALUES
(1, 'Responsive Web Design', '2018-12-09', '10:00:00', 3, 1, 'taller_01'),
(2, 'Flexbox', '2018-12-09', '12:00:00', 3, 2, 'taller_02'),
(3, 'HTML5 y CSS3', '2018-12-09', '14:00:00', 3, 3, 'taller_03'),
(4, 'Drupal', '2018-12-09', '17:00:00', 3, 4, 'taller_04'),
(5, 'WordPress', '2018-12-09', '19:00:00', 3, 5, 'taller_05'),
(6, 'Como ser freelancer', '2018-12-09', '10:00:00', 2, 6, 'conf_01'),
(7, 'Tecnologías del Futuro', '2018-12-09', '17:00:00', 2, 1, 'conf_02'),
(8, 'Seguridad en la Web', '2018-12-09', '19:00:00', 2, 2, 'conf_03'),
(9, 'Diseño UI y UX para móviles', '2018-12-09', '10:00:00', 1, 6, 'sem_01'),
(10, 'AngularJS', '2018-12-10', '10:00:00', 3, 1, 'taller_06'),
(11, 'PHP y MySQL', '2018-12-10', '12:00:00', 3, 2, 'taller_07'),
(12, 'JavaScript Avanzado', '2018-12-10', '14:00:00', 3, 3, 'taller_08'),
(13, 'SEO en Google', '2018-12-10', '17:00:00', 3, 4, 'taller_09'),
(14, 'De Photoshop a HTML5 y CSS3', '2018-12-10', '19:00:00', 3, 5, 'taller_10'),
(15, 'PHP Intermedio y Avanzado', '2018-12-10', '21:00:00', 3, 6, 'taller_11'),
(16, 'Como crear una tienda online que venda millones en pocos día', '2018-12-10', '10:00:00', 2, 6, 'conf_04'),
(17, 'Los mejores lugares para encontrar trabajo', '2018-12-10', '17:00:00', 2, 1, 'conf_05'),
(18, 'Pasos para crear un negocio rentable ', '2018-12-10', '19:00:00', 2, 2, 'conf_06'),
(19, 'Aprende a Programar en una mañana', '2018-12-10', '10:00:00', 1, 3, 'sem_02'),
(20, 'Diseño UI y UX para móviles', '2018-12-10', '17:00:00', 1, 5, 'sem_03'),
(21, 'Laravel', '2018-12-11', '10:00:00', 3, 1, 'taller_12'),
(22, 'Crea tu propia API', '2018-12-11', '12:00:00', 3, 2, 'taller_13'),
(23, 'JavaScript y jQuery', '2018-12-11', '14:00:00', 3, 3, 'taller_14'),
(24, 'Creando Plantillas para WordPress', '2018-12-11', '17:00:00', 3, 4, 'taller_15'),
(25, 'Tiendas Virtuales en Magento', '2018-12-11', '19:00:00', 3, 5, 'taller_16'),
(26, 'Como hacer Marketing en línea', '2018-12-11', '10:00:00', 2, 6, 'conf_07'),
(27, '¿Con que lenguaje debo empezar?', '2018-12-11', '17:00:00', 2, 2, 'conf_08'),
(28, 'Frameworks y librerias Open Source', '2018-12-11', '19:00:00', 2, 3, 'conf_09'),
(29, 'Creando una App en Android en una mañana', '2018-12-11', '10:00:00', 1, 4, 'sem_04'),
(30, 'Creando una App en iOS en una tarde', '2018-12-11', '17:00:00', 1, 1, 'sem_05');

-- --------------------------------------------------------

--
-- Table structure for table `invitados`
--

CREATE TABLE `invitados` (
  `id` tinyint(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `url_imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invitados`
--

INSERT INTO `invitados` (`id`, `nombre`, `apellido`, `descripcion`, `url_imagen`) VALUES
(1, 'Rafael', 'Bautista', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado1.jpg'),
(2, 'Shari', 'Herrera', 'Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado2.jpg'),
(3, 'Gregorio', 'Sanchez', 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado3.jpg'),
(4, 'Susana', 'Rivera', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado4.jpg'),
(5, 'Harold', 'Garcia', 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado5.jpg'),
(6, 'Susan', 'Sanchez', 'Ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'invitado6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `regalos`
--

CREATE TABLE `regalos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regalos`
--

INSERT INTO `regalos` (`id`, `descripcion`) VALUES
(1, 'Pulsera'),
(2, 'Etiquetas'),
(3, 'Plumas');

-- --------------------------------------------------------

--
-- Table structure for table `registrados`
--

CREATE TABLE `registrados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `pases_articulos` longtext NOT NULL,
  `talleres_registrados` longtext NOT NULL,
  `regalo_id` int(11) NOT NULL,
  `total_pagado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_evento`
--
ALTER TABLE `categoria_evento`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_evento` (`id_categoria_evento`),
  ADD KEY `id_invitado` (`id_invitado`);

--
-- Indexes for table `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrados`
--
ALTER TABLE `registrados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regalo_id` (`regalo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria_evento`
--
ALTER TABLE `categoria_evento`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `invitados`
--
ALTER TABLE `invitados`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regalos`
--
ALTER TABLE `regalos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrados`
--
ALTER TABLE `registrados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_categoria_evento`) REFERENCES `categoria_evento` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_invitado`) REFERENCES `invitados` (`id`);

--
-- Constraints for table `registrados`
--
ALTER TABLE `registrados`
  ADD CONSTRAINT `registrados_ibfk_1` FOREIGN KEY (`regalo_id`) REFERENCES `regalos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
