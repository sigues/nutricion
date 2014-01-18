-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2014 at 06:26 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nutricion`
--
CREATE DATABASE `nutricion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nutricion`;

-- --------------------------------------------------------

--
-- Table structure for table `alimento`
--

CREATE TABLE IF NOT EXISTS `alimento` (
  `idalimento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `grupo_idgrupo` int(11) NOT NULL,
  `medida_idmedida` int(11) NOT NULL,
  `cantidad` float DEFAULT NULL,
  PRIMARY KEY (`idalimento`,`grupo_idgrupo`,`medida_idmedida`),
  KEY `fk_alimento_grupo1_idx` (`grupo_idgrupo`),
  KEY `fk_alimento_medida1_idx` (`medida_idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alimento`
--


-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='vegetariano, pastas, pollo, carnes, etc' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categoria`
--


-- --------------------------------------------------------

--
-- Table structure for table `cita`
--

CREATE TABLE IF NOT EXISTS `cita` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `nutriologo` int(11) DEFAULT NULL,
  `estado` enum('pendiente','realizada','cancelada','pospuesta') DEFAULT 'pendiente' COMMENT '0 pendiente, 1 en proceso, 2 terminada, 3 cancelada, 4 inasisitida',
  `usuario_idusuario` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estadoFinanciero` enum('pendiente','en proceso','pagado') DEFAULT 'pendiente',
  PRIMARY KEY (`idcita`,`usuario_idusuario`),
  KEY `fk_cita_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cita`
--

INSERT INTO `cita` (`idcita`, `horaInicio`, `horaFin`, `nutriologo`, `estado`, `usuario_idusuario`, `costo`, `comentario`, `fecha`, `estadoFinanciero`) VALUES
(1, '09:30:00', '09:59:00', 1, 'pendiente', 1, 300, 'mis huevos', '2013-12-17', 'pendiente'),
(2, '10:30:00', '10:59:00', 1, 'pendiente', 1, 300, '', '2013-12-17', 'pendiente');

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `estado_idestado` int(11) NOT NULL,
  PRIMARY KEY (`idciudad`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_ciudad_estado1_idx` (`estado_idestado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ciudad`
--


-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE IF NOT EXISTS `consulta` (
  `idconsulta` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` datetime DEFAULT NULL,
  `horaFin` datetime DEFAULT NULL,
  `comentarios` text,
  `cita_idcita` int(11) NOT NULL,
  `cita_usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idconsulta`,`cita_idcita`,`cita_usuario_idusuario`),
  KEY `fk_consulta_cita1_idx` (`cita_idcita`,`cita_usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `consulta`
--


-- --------------------------------------------------------

--
-- Table structure for table `consulta_has_diagnostico`
--

CREATE TABLE IF NOT EXISTS `consulta_has_diagnostico` (
  `consulta_idconsulta` int(11) NOT NULL,
  `diagnostico_iddiagnostico` int(11) NOT NULL,
  PRIMARY KEY (`consulta_idconsulta`,`diagnostico_iddiagnostico`),
  KEY `fk_consulta_has_diagnostico_diagnostico1_idx` (`diagnostico_iddiagnostico`),
  KEY `fk_consulta_has_diagnostico_consulta1_idx` (`consulta_idconsulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consulta_has_diagnostico`
--


-- --------------------------------------------------------

--
-- Table structure for table `cuestionario`
--

CREATE TABLE IF NOT EXISTS `cuestionario` (
  `idcuestionario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idcuestionario`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cuestionario`
--

INSERT INTO `cuestionario` (`idcuestionario`, `nombre`, `codigo`) VALUES
(1, 'Historial Alimenticio', 'historial');

-- --------------------------------------------------------

--
-- Table structure for table `datosconsulta`
--

CREATE TABLE IF NOT EXISTS `datosconsulta` (
  `iddatosConsulta` int(11) NOT NULL AUTO_INCREMENT,
  `peso` float DEFAULT NULL,
  `talla` float DEFAULT NULL,
  `peso_deseado` float DEFAULT NULL,
  `cintura` float DEFAULT NULL,
  `consulta_idconsulta` int(11) NOT NULL,
  PRIMARY KEY (`iddatosConsulta`),
  KEY `fk_datosConsulta_consulta1_idx` (`consulta_idconsulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `datosconsulta`
--


-- --------------------------------------------------------

--
-- Table structure for table `diagnostico`
--

CREATE TABLE IF NOT EXISTS `diagnostico` (
  `iddiagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`iddiagnostico`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='obesidad, hipertension, etc.' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diagnostico`
--


-- --------------------------------------------------------

--
-- Table structure for table `diagnostico_has_dieta`
--

CREATE TABLE IF NOT EXISTS `diagnostico_has_dieta` (
  `diagnostico_iddiagnostico` int(11) NOT NULL,
  `valor` tinyint(1) DEFAULT NULL,
  `dieta_iddieta` int(11) NOT NULL,
  PRIMARY KEY (`diagnostico_iddiagnostico`,`dieta_iddieta`),
  KEY `fk_diagnostico_has_dieta_diagnostico1_idx` (`diagnostico_iddiagnostico`),
  KEY `fk_diagnostico_has_dieta_dieta1_idx` (`dieta_iddieta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostico_has_dieta`
--


-- --------------------------------------------------------

--
-- Table structure for table `dieta`
--

CREATE TABLE IF NOT EXISTS `dieta` (
  `iddieta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddieta`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dieta`
--


-- --------------------------------------------------------

--
-- Table structure for table `dieta_has_grupo`
--

CREATE TABLE IF NOT EXISTS `dieta_has_grupo` (
  `dieta_iddieta` int(11) NOT NULL,
  `grupo_idgrupo` int(11) NOT NULL,
  `horario_idhorario` int(11) NOT NULL,
  `porciones` float DEFAULT NULL,
  PRIMARY KEY (`dieta_iddieta`,`grupo_idgrupo`,`horario_idhorario`),
  KEY `fk_dieta_has_grupo_grupo1_idx` (`grupo_idgrupo`),
  KEY `fk_dieta_has_grupo_dieta1_idx` (`dieta_iddieta`),
  KEY `fk_dieta_has_grupo_horario1_idx` (`horario_idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dieta_has_grupo`
--


-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `pais_idpais` int(11) NOT NULL,
  PRIMARY KEY (`idestado`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_estado_pais1_idx` (`pais_idpais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `estado`
--


-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idgrupo`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grupo`
--


-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `horario`
--


-- --------------------------------------------------------

--
-- Table structure for table `medida`
--

CREATE TABLE IF NOT EXISTS `medida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `abreviatura` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `medida`
--


-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `referencia` int(11) DEFAULT NULL,
  `cita_idcita` int(11) NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_pago_cita1_idx` (`cita_idcita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pago`
--


-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpais`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pais`
--


-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idperfil`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pediátrica, adolescentes, adultos, geriátrico, embarazo y la' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `perfil`
--


-- --------------------------------------------------------

--
-- Table structure for table `perfil_has_dieta`
--

CREATE TABLE IF NOT EXISTS `perfil_has_dieta` (
  `perfil_idperfil` int(11) NOT NULL,
  `dieta_iddieta` int(11) NOT NULL,
  `default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`perfil_idperfil`,`dieta_iddieta`),
  KEY `fk_perfil_has_dieta_dieta1_idx` (`dieta_iddieta`),
  KEY `fk_perfil_has_dieta_perfil1_idx` (`perfil_idperfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perfil_has_dieta`
--


-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `idpregunta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `cuestionario_idcuestionario` int(11) NOT NULL,
  `tipo` enum('radio','checkbox','text','int') DEFAULT NULL,
  `obligatoria` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpregunta`),
  KEY `fk_pregunta_cuestionario1_idx` (`cuestionario_idcuestionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`idpregunta`, `nombre`, `cuestionario_idcuestionario`, `tipo`, `obligatoria`) VALUES
(1, 'padeces indigestion?', 1, 'radio', 1),
(2, 'con que alimentos?', 1, 'checkbox', 1);

-- --------------------------------------------------------

--
-- Table structure for table `propiedad`
--

CREATE TABLE IF NOT EXISTS `propiedad` (
  `idpropiedad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idpropiedad`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Colesterol\nHDL\nLDL\nTGL\nTensión arterial\netc.		' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `propiedad`
--


-- --------------------------------------------------------

--
-- Table structure for table `propiedad_usuario`
--

CREATE TABLE IF NOT EXISTS `propiedad_usuario` (
  `idpropiedad_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo` enum('int','varchar') DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `limiteMinimo` int(11) DEFAULT NULL,
  `limiteMaximo` int(11) DEFAULT NULL,
  `cuestionario` varchar(45) DEFAULT NULL,
  `historico` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpropiedad_usuario`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='El catálogo de propiedad_usuario es donde van a ir los datos' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `propiedad_usuario`
--

INSERT INTO `propiedad_usuario` (`idpropiedad_usuario`, `nombre`, `descripcion`, `tipo`, `codigo`, `limiteMinimo`, `limiteMaximo`, `cuestionario`, `historico`) VALUES
(1, 'Peso', 'Peso en kilogramos', 'int', 'peso', 10, 500, 'registro', NULL),
(2, 'Talla', 'Altura en centímetros', 'int', 'talla', 20, 300, 'registro', NULL),
(3, 'Sexo', 'sexo', 'varchar', 'sexo', NULL, NULL, 'registro', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `archivo` varchar(45) DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idpublicacion`),
  KEY `fk_publicacion_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `publicacion`
--


-- --------------------------------------------------------

--
-- Table structure for table `receta`
--

CREATE TABLE IF NOT EXISTS `receta` (
  `idreceta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idreceta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `receta`
--


-- --------------------------------------------------------

--
-- Table structure for table `receta_has_alimento`
--

CREATE TABLE IF NOT EXISTS `receta_has_alimento` (
  `receta_idreceta` int(11) NOT NULL,
  `alimento_idalimento` int(11) NOT NULL,
  `porcion` float DEFAULT NULL,
  PRIMARY KEY (`receta_idreceta`,`alimento_idalimento`),
  KEY `fk_receta_has_alimento_alimento1_idx` (`alimento_idalimento`),
  KEY `fk_receta_has_alimento_receta1_idx` (`receta_idreceta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receta_has_alimento`
--


-- --------------------------------------------------------

--
-- Table structure for table `receta_has_categoria`
--

CREATE TABLE IF NOT EXISTS `receta_has_categoria` (
  `receta_idreceta` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`receta_idreceta`,`categoria_idcategoria`),
  KEY `fk_receta_has_categoria_categoria1_idx` (`categoria_idcategoria`),
  KEY `fk_receta_has_categoria_receta1_idx` (`receta_idreceta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receta_has_categoria`
--


-- --------------------------------------------------------

--
-- Table structure for table `respuesta`
--

CREATE TABLE IF NOT EXISTS `respuesta` (
  `idrespuesta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `pregunta_idpregunta` int(11) NOT NULL,
  PRIMARY KEY (`idrespuesta`),
  KEY `fk_respuesta_pregunta1_idx` (`pregunta_idpregunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `respuesta`
--

INSERT INTO `respuesta` (`idrespuesta`, `nombre`, `pregunta_idpregunta`) VALUES
(1, 'si', 1),
(2, 'no', 1),
(3, 'ocasionalmente', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT COMMENT '				',
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `sexo` enum('masculino','femenino') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL COMMENT '"0 usuario 1 nutriologo 2 admin"',
  `ciudad_idciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  KEY `fk_usuario_ciudad1_idx` (`ciudad_idciudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `correo`, `contrasena`, `nombre`, `apellido`, `sexo`, `fechaNacimiento`, `perfil`, `ciudad_idciudad`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', NULL, NULL, 2, NULL),
(2, 'salvador@nutricion.com', 'e99a18c428cb38d5f260853678922e03', 'salvador', 'villegas', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_categoria`
--

CREATE TABLE IF NOT EXISTS `usuario_has_categoria` (
  `usuario_idusuario` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_idusuario`,`categoria_idcategoria`),
  KEY `fk_usuario_has_categoria_categoria1_idx` (`categoria_idcategoria`),
  KEY `fk_usuario_has_categoria_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario_has_categoria`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_dieta`
--

CREATE TABLE IF NOT EXISTS `usuario_has_dieta` (
  `usuario_idusuario` int(11) NOT NULL,
  `dieta_iddieta` int(11) NOT NULL,
  PRIMARY KEY (`usuario_idusuario`,`dieta_iddieta`),
  KEY `fk_usuario_has_dieta_dieta1_idx` (`dieta_iddieta`),
  KEY `fk_usuario_has_dieta_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario_has_dieta`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_perfil`
--

CREATE TABLE IF NOT EXISTS `usuario_has_perfil` (
  `usuario_idusuario` int(11) NOT NULL,
  `perfil_idperfil` int(11) NOT NULL,
  PRIMARY KEY (`usuario_idusuario`,`perfil_idperfil`),
  KEY `fk_usuario_has_perfil_perfil1_idx` (`perfil_idperfil`),
  KEY `fk_usuario_has_perfil_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario_has_perfil`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_propiedad`
--

CREATE TABLE IF NOT EXISTS `usuario_has_propiedad` (
  `usuario_idusuario` int(11) NOT NULL,
  `propiedad_idpropiedad` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`usuario_idusuario`,`propiedad_idpropiedad`),
  KEY `fk_usuario_has_propiedad_propiedad1_idx` (`propiedad_idpropiedad`),
  KEY `fk_usuario_has_propiedad_usuario1_idx` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario_has_propiedad`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_propiedad_usuario`
--

CREATE TABLE IF NOT EXISTS `usuario_has_propiedad_usuario` (
  `usuario_idusuario` int(11) NOT NULL,
  `propiedad_usuario_idpropiedad_usuario` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `idusuario_has_propiedad_usuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idusuario_has_propiedad_usuario`),
  KEY `fk_usuario_has_propiedad_usuario_propiedad_usuario1_idx` (`propiedad_usuario_idpropiedad_usuario`),
  KEY `fk_usuario_has_propiedad_usuario_usuario_idx` (`usuario_idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usuario_has_propiedad_usuario`
--

INSERT INTO `usuario_has_propiedad_usuario` (`usuario_idusuario`, `propiedad_usuario_idpropiedad_usuario`, `valor`, `fecha`, `idusuario_has_propiedad_usuario`) VALUES
(1, 1, '70', NULL, 1),
(1, 2, '170', NULL, 2),
(1, 3, 'h', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_has_respuesta`
--

CREATE TABLE IF NOT EXISTS `usuario_has_respuesta` (
  `idusuario_has_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` int(11) NOT NULL,
  `respuesta_idrespuesta` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `pregunta_idpregunta` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario_has_respuesta`,`pregunta_idpregunta`),
  KEY `fk_usuario_has_respuesta_respuesta1_idx` (`respuesta_idrespuesta`),
  KEY `fk_usuario_has_respuesta_usuario1_idx` (`usuario_idusuario`),
  KEY `fk_usuario_has_respuesta_pregunta1_idx` (`pregunta_idpregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usuario_has_respuesta`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `alimento`
--
ALTER TABLE `alimento`
  ADD CONSTRAINT `fk_alimento_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alimento_medida1` FOREIGN KEY (`medida_idmedida`) REFERENCES `medida` (`idmedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_estado1` FOREIGN KEY (`estado_idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `fk_consulta_cita1` FOREIGN KEY (`cita_idcita`, `cita_usuario_idusuario`) REFERENCES `cita` (`idcita`, `usuario_idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `consulta_has_diagnostico`
--
ALTER TABLE `consulta_has_diagnostico`
  ADD CONSTRAINT `fk_consulta_has_diagnostico_consulta1` FOREIGN KEY (`consulta_idconsulta`) REFERENCES `consulta` (`idconsulta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_consulta_has_diagnostico_diagnostico1` FOREIGN KEY (`diagnostico_iddiagnostico`) REFERENCES `diagnostico` (`iddiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `datosconsulta`
--
ALTER TABLE `datosconsulta`
  ADD CONSTRAINT `fk_datosConsulta_consulta1` FOREIGN KEY (`consulta_idconsulta`) REFERENCES `consulta` (`idconsulta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `diagnostico_has_dieta`
--
ALTER TABLE `diagnostico_has_dieta`
  ADD CONSTRAINT `fk_diagnostico_has_dieta_diagnostico1` FOREIGN KEY (`diagnostico_iddiagnostico`) REFERENCES `diagnostico` (`iddiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diagnostico_has_dieta_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dieta_has_grupo`
--
ALTER TABLE `dieta_has_grupo`
  ADD CONSTRAINT `fk_dieta_has_grupo_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dieta_has_grupo_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dieta_has_grupo_horario1` FOREIGN KEY (`horario_idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `fk_estado_pais1` FOREIGN KEY (`pais_idpais`) REFERENCES `pais` (`idpais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_cita1` FOREIGN KEY (`cita_idcita`) REFERENCES `cita` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `perfil_has_dieta`
--
ALTER TABLE `perfil_has_dieta`
  ADD CONSTRAINT `fk_perfil_has_dieta_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfil_has_dieta_perfil1` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `fk_pregunta_cuestionario1` FOREIGN KEY (`cuestionario_idcuestionario`) REFERENCES `cuestionario` (`idcuestionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `fk_publicacion_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receta_has_alimento`
--
ALTER TABLE `receta_has_alimento`
  ADD CONSTRAINT `fk_receta_has_alimento_alimento1` FOREIGN KEY (`alimento_idalimento`) REFERENCES `alimento` (`idalimento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receta_has_alimento_receta1` FOREIGN KEY (`receta_idreceta`) REFERENCES `receta` (`idreceta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receta_has_categoria`
--
ALTER TABLE `receta_has_categoria`
  ADD CONSTRAINT `fk_receta_has_categoria_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receta_has_categoria_receta1` FOREIGN KEY (`receta_idreceta`) REFERENCES `receta` (`idreceta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_respuesta_pregunta1` FOREIGN KEY (`pregunta_idpregunta`) REFERENCES `pregunta` (`idpregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_ciudad1` FOREIGN KEY (`ciudad_idciudad`) REFERENCES `ciudad` (`idciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_categoria`
--
ALTER TABLE `usuario_has_categoria`
  ADD CONSTRAINT `fk_usuario_has_categoria_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_categoria_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_dieta`
--
ALTER TABLE `usuario_has_dieta`
  ADD CONSTRAINT `fk_usuario_has_dieta_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_dieta_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_perfil`
--
ALTER TABLE `usuario_has_perfil`
  ADD CONSTRAINT `fk_usuario_has_perfil_perfil1` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_perfil_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_propiedad`
--
ALTER TABLE `usuario_has_propiedad`
  ADD CONSTRAINT `fk_usuario_has_propiedad_propiedad1` FOREIGN KEY (`propiedad_idpropiedad`) REFERENCES `propiedad` (`idpropiedad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_propiedad_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_propiedad_usuario`
--
ALTER TABLE `usuario_has_propiedad_usuario`
  ADD CONSTRAINT `fk_usuario_has_propiedad_usuario_propiedad_usuario1` FOREIGN KEY (`propiedad_usuario_idpropiedad_usuario`) REFERENCES `propiedad_usuario` (`idpropiedad_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_propiedad_usuario_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_has_respuesta`
--
ALTER TABLE `usuario_has_respuesta`
  ADD CONSTRAINT `fk_usuario_has_respuesta_pregunta1` FOREIGN KEY (`pregunta_idpregunta`) REFERENCES `pregunta` (`idpregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_respuesta_respuesta1` FOREIGN KEY (`respuesta_idrespuesta`) REFERENCES `respuesta` (`idrespuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_respuesta_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
