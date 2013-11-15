-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: nutricion
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alimento`
--

DROP TABLE IF EXISTS `alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimento` (
  `idalimento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idalimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimento`
--

LOCK TABLES `alimento` WRITE;
/*!40000 ALTER TABLE `alimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `alimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='vegetariano, pastas, pollo, carnes, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` datetime DEFAULT NULL,
  `horaFin` datetime DEFAULT NULL,
  `nutriologo` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '0 pendiente, 1 en proceso, 2 terminada, 3 cancelada, 4 inasisitida',
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcita`,`usuario_idusuario`),
  KEY `fk_cita_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_cita_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `estado_idestado` int(11) NOT NULL,
  PRIMARY KEY (`idciudad`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_ciudad_estado1_idx` (`estado_idestado`),
  CONSTRAINT `fk_ciudad_estado1` FOREIGN KEY (`estado_idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` datetime DEFAULT NULL,
  `horaFin` datetime DEFAULT NULL,
  `comentarios` text,
  `cita_idcita` int(11) NOT NULL,
  `cita_usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idconsulta`,`cita_idcita`,`cita_usuario_idusuario`),
  KEY `fk_consulta_cita1_idx` (`cita_idcita`,`cita_usuario_idusuario`),
  CONSTRAINT `fk_consulta_cita1` FOREIGN KEY (`cita_idcita`, `cita_usuario_idusuario`) REFERENCES `cita` (`idcita`, `usuario_idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta`
--

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulta_has_diagnostico`
--

DROP TABLE IF EXISTS `consulta_has_diagnostico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consulta_has_diagnostico` (
  `consulta_idconsulta` int(11) NOT NULL,
  `diagnostico_iddiagnostico` int(11) NOT NULL,
  PRIMARY KEY (`consulta_idconsulta`,`diagnostico_iddiagnostico`),
  KEY `fk_consulta_has_diagnostico_diagnostico1_idx` (`diagnostico_iddiagnostico`),
  KEY `fk_consulta_has_diagnostico_consulta1_idx` (`consulta_idconsulta`),
  CONSTRAINT `fk_consulta_has_diagnostico_consulta1` FOREIGN KEY (`consulta_idconsulta`) REFERENCES `consulta` (`idconsulta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consulta_has_diagnostico_diagnostico1` FOREIGN KEY (`diagnostico_iddiagnostico`) REFERENCES `diagnostico` (`iddiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta_has_diagnostico`
--

LOCK TABLES `consulta_has_diagnostico` WRITE;
/*!40000 ALTER TABLE `consulta_has_diagnostico` DISABLE KEYS */;
/*!40000 ALTER TABLE `consulta_has_diagnostico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnostico`
--

DROP TABLE IF EXISTS `diagnostico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnostico` (
  `iddiagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`iddiagnostico`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='obesidad, hipertension, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnostico`
--

LOCK TABLES `diagnostico` WRITE;
/*!40000 ALTER TABLE `diagnostico` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnostico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnostico_has_dieta`
--

DROP TABLE IF EXISTS `diagnostico_has_dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnostico_has_dieta` (
  `diagnostico_iddiagnostico` int(11) NOT NULL,
  `valor` tinyint(1) DEFAULT NULL,
  `dieta_iddieta` int(11) NOT NULL,
  PRIMARY KEY (`diagnostico_iddiagnostico`,`dieta_iddieta`),
  KEY `fk_diagnostico_has_dieta_diagnostico1_idx` (`diagnostico_iddiagnostico`),
  KEY `fk_diagnostico_has_dieta_dieta1_idx` (`dieta_iddieta`),
  CONSTRAINT `fk_diagnostico_has_dieta_diagnostico1` FOREIGN KEY (`diagnostico_iddiagnostico`) REFERENCES `diagnostico` (`iddiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_diagnostico_has_dieta_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnostico_has_dieta`
--

LOCK TABLES `diagnostico_has_dieta` WRITE;
/*!40000 ALTER TABLE `diagnostico_has_dieta` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnostico_has_dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dieta`
--

DROP TABLE IF EXISTS `dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dieta` (
  `iddieta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddieta`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dieta`
--

LOCK TABLES `dieta` WRITE;
/*!40000 ALTER TABLE `dieta` DISABLE KEYS */;
/*!40000 ALTER TABLE `dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dieta_has_grupo`
--

DROP TABLE IF EXISTS `dieta_has_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dieta_has_grupo` (
  `dieta_iddieta` int(11) NOT NULL,
  `grupo_idgrupo` int(11) NOT NULL,
  `horario_idhorario` int(11) NOT NULL,
  `porciones` float DEFAULT NULL,
  PRIMARY KEY (`dieta_iddieta`,`grupo_idgrupo`,`horario_idhorario`),
  KEY `fk_dieta_has_grupo_grupo1_idx` (`grupo_idgrupo`),
  KEY `fk_dieta_has_grupo_dieta1_idx` (`dieta_iddieta`),
  KEY `fk_dieta_has_grupo_horario1_idx` (`horario_idhorario`),
  CONSTRAINT `fk_dieta_has_grupo_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dieta_has_grupo_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dieta_has_grupo_horario1` FOREIGN KEY (`horario_idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dieta_has_grupo`
--

LOCK TABLES `dieta_has_grupo` WRITE;
/*!40000 ALTER TABLE `dieta_has_grupo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dieta_has_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `pais_idpais` int(11) NOT NULL,
  PRIMARY KEY (`idestado`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_estado_pais1_idx` (`pais_idpais`),
  CONSTRAINT `fk_estado_pais1` FOREIGN KEY (`pais_idpais`) REFERENCES `pais` (`idpais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idgrupo`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,'Cereales y tubérculos','CYT','Cereales como tales y tales'),(2,'Cereales con grasa','CER','Cereales con grasa como este y el otro'),(3,'Frutas','FRU','Frutas como fresas, mango, etc.'),(4,'Verduras','VER','Verduras'),(5,'Carnes y Quesos','CYQ','Carnes y quesos');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_has_alimento`
--

DROP TABLE IF EXISTS `grupo_has_alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_has_alimento` (
  `grupo_idgrupo` int(11) NOT NULL,
  `alimento_idalimento` int(11) NOT NULL,
  `cantidad` float DEFAULT NULL,
  `medida_idmedida` int(11) NOT NULL,
  PRIMARY KEY (`grupo_idgrupo`,`alimento_idalimento`,`medida_idmedida`),
  KEY `fk_grupo_has_alimento_alimento1_idx` (`alimento_idalimento`),
  KEY `fk_grupo_has_alimento_grupo1_idx` (`grupo_idgrupo`),
  KEY `fk_grupo_has_alimento_medida1_idx` (`medida_idmedida`),
  CONSTRAINT `fk_grupo_has_alimento_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_has_alimento_alimento1` FOREIGN KEY (`alimento_idalimento`) REFERENCES `alimento` (`idalimento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_has_alimento_medida1` FOREIGN KEY (`medida_idmedida`) REFERENCES `medida` (`idmedida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_has_alimento`
--

LOCK TABLES `grupo_has_alimento` WRITE;
/*!40000 ALTER TABLE `grupo_has_alimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_has_alimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,'Desayuno',NULL),(2,'Colacion',NULL),(3,'Comida',NULL),(4,'Colacion',NULL),(5,'Cena',NULL);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medida`
--

DROP TABLE IF EXISTS `medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpais`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idperfil`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='pediátrica, adolescentes, adultos, geriátrico, embarazo y lactancia, deportiva y manejo de peso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Geriatrico','personas de la 3era edad','GER',NULL),(2,'Adultos','Personas de 18 a 60 años','ADU',NULL),(3,'Niños','Niños de 1 a 12 años','NIN',NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propiedad`
--

DROP TABLE IF EXISTS `propiedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propiedad` (
  `idpropiedad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idpropiedad`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Colesterol\nHDL\nLDL\nTGL\nTensión arterial\netc.		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedad`
--

LOCK TABLES `propiedad` WRITE;
/*!40000 ALTER TABLE `propiedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `propiedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propiedad_usuario`
--

DROP TABLE IF EXISTS `propiedad_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propiedad_usuario` (
  `idpropiedad_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo` enum('int','varchar') DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `limiteMinimo` int(11) DEFAULT NULL,
  `limiteMaximo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpropiedad_usuario`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='El catálogo de propiedad_usuario es donde van a ir los datos de los usuarios, por ejemplo: Colesterol, peso, medidas, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedad_usuario`
--

LOCK TABLES `propiedad_usuario` WRITE;
/*!40000 ALTER TABLE `propiedad_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `propiedad_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacion` (
  `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `archivo` varchar(45) DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idpublicacion`),
  KEY `fk_publicacion_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_publicacion_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta`
--

DROP TABLE IF EXISTS `receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receta` (
  `idreceta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idreceta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta`
--

LOCK TABLES `receta` WRITE;
/*!40000 ALTER TABLE `receta` DISABLE KEYS */;
/*!40000 ALTER TABLE `receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta_has_alimento`
--

DROP TABLE IF EXISTS `receta_has_alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receta_has_alimento` (
  `receta_idreceta` int(11) NOT NULL,
  `alimento_idalimento` int(11) NOT NULL,
  `porcion` float DEFAULT NULL,
  PRIMARY KEY (`receta_idreceta`,`alimento_idalimento`),
  KEY `fk_receta_has_alimento_alimento1_idx` (`alimento_idalimento`),
  KEY `fk_receta_has_alimento_receta1_idx` (`receta_idreceta`),
  CONSTRAINT `fk_receta_has_alimento_receta1` FOREIGN KEY (`receta_idreceta`) REFERENCES `receta` (`idreceta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_receta_has_alimento_alimento1` FOREIGN KEY (`alimento_idalimento`) REFERENCES `alimento` (`idalimento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta_has_alimento`
--

LOCK TABLES `receta_has_alimento` WRITE;
/*!40000 ALTER TABLE `receta_has_alimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `receta_has_alimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta_has_categoria`
--

DROP TABLE IF EXISTS `receta_has_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receta_has_categoria` (
  `receta_idreceta` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`receta_idreceta`,`categoria_idcategoria`),
  KEY `fk_receta_has_categoria_categoria1_idx` (`categoria_idcategoria`),
  KEY `fk_receta_has_categoria_receta1_idx` (`receta_idreceta`),
  CONSTRAINT `fk_receta_has_categoria_receta1` FOREIGN KEY (`receta_idreceta`) REFERENCES `receta` (`idreceta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_receta_has_categoria_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta_has_categoria`
--

LOCK TABLES `receta_has_categoria` WRITE;
/*!40000 ALTER TABLE `receta_has_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `receta_has_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
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
  KEY `fk_usuario_ciudad1_idx` (`ciudad_idciudad`),
  CONSTRAINT `fk_usuario_ciudad1` FOREIGN KEY (`ciudad_idciudad`) REFERENCES `ciudad` (`idciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin@admin.com','21232f297a57a5a743894a0e4a801fc3','admin','admin',NULL,NULL,2,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_categoria`
--

DROP TABLE IF EXISTS `usuario_has_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_categoria` (
  `usuario_idusuario` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_idusuario`,`categoria_idcategoria`),
  KEY `fk_usuario_has_categoria_categoria1_idx` (`categoria_idcategoria`),
  KEY `fk_usuario_has_categoria_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuario_has_categoria_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_categoria_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_categoria`
--

LOCK TABLES `usuario_has_categoria` WRITE;
/*!40000 ALTER TABLE `usuario_has_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_dieta`
--

DROP TABLE IF EXISTS `usuario_has_dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_dieta` (
  `usuario_idusuario` int(11) NOT NULL,
  `dieta_iddieta` int(11) NOT NULL,
  PRIMARY KEY (`usuario_idusuario`,`dieta_iddieta`),
  KEY `fk_usuario_has_dieta_dieta1_idx` (`dieta_iddieta`),
  KEY `fk_usuario_has_dieta_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuario_has_dieta_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_dieta_dieta1` FOREIGN KEY (`dieta_iddieta`) REFERENCES `dieta` (`iddieta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_dieta`
--

LOCK TABLES `usuario_has_dieta` WRITE;
/*!40000 ALTER TABLE `usuario_has_dieta` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_perfil`
--

DROP TABLE IF EXISTS `usuario_has_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_perfil` (
  `usuario_idusuario` int(11) NOT NULL,
  `perfil_idperfil` int(11) NOT NULL,
  PRIMARY KEY (`usuario_idusuario`,`perfil_idperfil`),
  KEY `fk_usuario_has_perfil_perfil1_idx` (`perfil_idperfil`),
  KEY `fk_usuario_has_perfil_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuario_has_perfil_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_perfil_perfil1` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_perfil`
--

LOCK TABLES `usuario_has_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_has_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_propiedad`
--

DROP TABLE IF EXISTS `usuario_has_propiedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_propiedad` (
  `usuario_idusuario` int(11) NOT NULL,
  `propiedad_idpropiedad` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`usuario_idusuario`,`propiedad_idpropiedad`),
  KEY `fk_usuario_has_propiedad_propiedad1_idx` (`propiedad_idpropiedad`),
  KEY `fk_usuario_has_propiedad_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuario_has_propiedad_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_propiedad_propiedad1` FOREIGN KEY (`propiedad_idpropiedad`) REFERENCES `propiedad` (`idpropiedad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_propiedad`
--

LOCK TABLES `usuario_has_propiedad` WRITE;
/*!40000 ALTER TABLE `usuario_has_propiedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_propiedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_propiedad_usuario`
--

DROP TABLE IF EXISTS `usuario_has_propiedad_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_propiedad_usuario` (
  `usuario_idusuario` int(11) NOT NULL,
  `propiedad_usuario_idpropiedad_usuario` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usuario_idusuario`,`propiedad_usuario_idpropiedad_usuario`),
  KEY `fk_usuario_has_propiedad_usuario_propiedad_usuario1_idx` (`propiedad_usuario_idpropiedad_usuario`),
  KEY `fk_usuario_has_propiedad_usuario_usuario_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuario_has_propiedad_usuario_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_propiedad_usuario_propiedad_usuario1` FOREIGN KEY (`propiedad_usuario_idpropiedad_usuario`) REFERENCES `propiedad_usuario` (`idpropiedad_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_propiedad_usuario`
--

LOCK TABLES `usuario_has_propiedad_usuario` WRITE;
/*!40000 ALTER TABLE `usuario_has_propiedad_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_propiedad_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-15  0:27:26
