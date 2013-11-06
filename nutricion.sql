SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `nutricion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `nutricion`;

CREATE  TABLE IF NOT EXISTS `nutricion`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT COMMENT '				' ,
  `correo` VARCHAR(100) NULL DEFAULT NULL ,
  `contrasena` VARCHAR(45) NULL DEFAULT NULL ,
  `nombre` VARCHAR(100) NULL DEFAULT NULL ,
  `apellido` VARCHAR(45) NULL DEFAULT NULL ,
  `sexo` ENUM('masculino','femenino') NULL DEFAULT NULL ,
  `fechaNacimiento` DATE NULL DEFAULT NULL ,
  `perfil` INT(11) NULL DEFAULT NULL COMMENT '\\\"0 usuario 1 nutriologo 2 admin\\\"' ,
  PRIMARY KEY (`idusuario`) ,
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`propiedad_usuario` (
  `idpropiedad_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `tipo` ENUM('int','varchar') NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  `limiteMinimo` INT(11) NULL DEFAULT NULL ,
  `limiteMaximo` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idpropiedad_usuario`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'El catálogo de propiedad_usuario es donde van a ir los datos de los usuarios, por ejemplo: Colesterol, peso, medidas, etc.';

CREATE  TABLE IF NOT EXISTS `nutricion`.`usuario_has_propiedad_usuario` (
  `usuario_idusuario` INT(11) NOT NULL ,
  `propiedad_usuario_idpropiedad_usuario` INT(11) NOT NULL ,
  `valor` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`usuario_idusuario`, `propiedad_usuario_idpropiedad_usuario`) ,
  INDEX `fk_usuario_has_propiedad_usuario_propiedad_usuario1_idx` (`propiedad_usuario_idpropiedad_usuario` ASC) ,
  INDEX `fk_usuario_has_propiedad_usuario_usuario_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_usuario_has_propiedad_usuario_usuario`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_propiedad_usuario_propiedad_usuario1`
    FOREIGN KEY (`propiedad_usuario_idpropiedad_usuario` )
    REFERENCES `nutricion`.`propiedad_usuario` (`idpropiedad_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`perfil` (
  `idperfil` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idperfil`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'pediátrica, adolescentes, adultos, geriátrico, embarazo y lactancia, deportiva y manejo de peso';

CREATE  TABLE IF NOT EXISTS `nutricion`.`usuario_has_perfil` (
  `usuario_idusuario` INT(11) NOT NULL ,
  `perfil_idperfil` INT(11) NOT NULL ,
  PRIMARY KEY (`usuario_idusuario`, `perfil_idperfil`) ,
  INDEX `fk_usuario_has_perfil_perfil1_idx` (`perfil_idperfil` ASC) ,
  INDEX `fk_usuario_has_perfil_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_usuario_has_perfil_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_perfil_perfil1`
    FOREIGN KEY (`perfil_idperfil` )
    REFERENCES `nutricion`.`perfil` (`idperfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`propiedad` (
  `idpropiedad` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idpropiedad`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Colesterol\nHDL\nLDL\nTGL\nTensión arterial\netc.		';

CREATE  TABLE IF NOT EXISTS `nutricion`.`perfil_has_propiedad` (
  `perfil_idperfil` INT(11) NOT NULL ,
  `propiedad_idpropiedad` INT(11) NOT NULL ,
  PRIMARY KEY (`perfil_idperfil`, `propiedad_idpropiedad`) ,
  INDEX `fk_perfil_has_propiedad_propiedad1_idx` (`propiedad_idpropiedad` ASC) ,
  INDEX `fk_perfil_has_propiedad_perfil1_idx` (`perfil_idperfil` ASC) ,
  CONSTRAINT `fk_perfil_has_propiedad_perfil1`
    FOREIGN KEY (`perfil_idperfil` )
    REFERENCES `nutricion`.`perfil` (`idperfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_has_propiedad_propiedad1`
    FOREIGN KEY (`propiedad_idpropiedad` )
    REFERENCES `nutricion`.`propiedad` (`idpropiedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`dieta` (
  `iddieta` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  `archivo` VARCHAR(45) NULL DEFAULT NULL ,
  `tipo` INT(11) NULL DEFAULT NULL ,
  `privado` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`iddieta`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`dieta_has_propiedad` (
  `dieta_iddieta` INT(11) NOT NULL ,
  `propiedad_idpropiedad` INT(11) NOT NULL ,
  PRIMARY KEY (`dieta_iddieta`, `propiedad_idpropiedad`) ,
  INDEX `fk_dieta_has_propiedad_propiedad1_idx` (`propiedad_idpropiedad` ASC) ,
  INDEX `fk_dieta_has_propiedad_dieta1_idx` (`dieta_iddieta` ASC) ,
  CONSTRAINT `fk_dieta_has_propiedad_dieta1`
    FOREIGN KEY (`dieta_iddieta` )
    REFERENCES `nutricion`.`dieta` (`iddieta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dieta_has_propiedad_propiedad1`
    FOREIGN KEY (`propiedad_idpropiedad` )
    REFERENCES `nutricion`.`propiedad` (`idpropiedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`usuario_has_dieta` (
  `usuario_idusuario` INT(11) NOT NULL ,
  `dieta_iddieta` INT(11) NOT NULL ,
  `voto` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`dieta_iddieta`, `usuario_idusuario`) ,
  INDEX `fk_usuario_has_dieta_dieta1_idx` (`dieta_iddieta` ASC) ,
  INDEX `fk_usuario_has_dieta_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_usuario_has_dieta_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_dieta_dieta1`
    FOREIGN KEY (`dieta_iddieta` )
    REFERENCES `nutricion`.`dieta` (`iddieta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`dieta_has_perfil` (
  `dieta_iddieta` INT(11) NOT NULL ,
  `perfil_idperfil` INT(11) NOT NULL ,
  PRIMARY KEY (`dieta_iddieta`, `perfil_idperfil`) ,
  INDEX `fk_dieta_has_perfil_perfil1_idx` (`perfil_idperfil` ASC) ,
  INDEX `fk_dieta_has_perfil_dieta1_idx` (`dieta_iddieta` ASC) ,
  CONSTRAINT `fk_dieta_has_perfil_dieta1`
    FOREIGN KEY (`dieta_iddieta` )
    REFERENCES `nutricion`.`dieta` (`iddieta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dieta_has_perfil_perfil1`
    FOREIGN KEY (`perfil_idperfil` )
    REFERENCES `nutricion`.`perfil` (`idperfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`publicacion` (
  `idpublicacion` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `archivo` VARCHAR(45) NULL DEFAULT NULL ,
  `usuario_idusuario` INT(11) NOT NULL ,
  `fecha` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`idpublicacion`) ,
  INDEX `fk_publicacion_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_publicacion_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`categoria` (
  `idcategoria` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcategoria`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'vegetariano, pastas, pollo, carnes, etc';

CREATE  TABLE IF NOT EXISTS `nutricion`.`dieta_has_categoria` (
  `dieta_iddieta` INT(11) NOT NULL ,
  `categoria_idcategoria` INT(11) NOT NULL ,
  PRIMARY KEY (`dieta_iddieta`, `categoria_idcategoria`) ,
  INDEX `fk_dieta_has_categoria_categoria1_idx` (`categoria_idcategoria` ASC) ,
  INDEX `fk_dieta_has_categoria_dieta1_idx` (`dieta_iddieta` ASC) ,
  CONSTRAINT `fk_dieta_has_categoria_dieta1`
    FOREIGN KEY (`dieta_iddieta` )
    REFERENCES `nutricion`.`dieta` (`iddieta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dieta_has_categoria_categoria1`
    FOREIGN KEY (`categoria_idcategoria` )
    REFERENCES `nutricion`.`categoria` (`idcategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`usuario_has_categoria` (
  `usuario_idusuario` INT(11) NOT NULL ,
  `categoria_idcategoria` INT(11) NOT NULL ,
  `valor` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`usuario_idusuario`, `categoria_idcategoria`) ,
  INDEX `fk_usuario_has_categoria_categoria1_idx` (`categoria_idcategoria` ASC) ,
  INDEX `fk_usuario_has_categoria_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_usuario_has_categoria_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_categoria_categoria1`
    FOREIGN KEY (`categoria_idcategoria` )
    REFERENCES `nutricion`.`categoria` (`idcategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`cita` (
  `idcita` INT(11) NOT NULL AUTO_INCREMENT ,
  `horaInicio` DATETIME NULL DEFAULT NULL ,
  `horaFin` DATETIME NULL DEFAULT NULL ,
  `nutriologo` VARCHAR(45) NULL DEFAULT NULL ,
  `estado` INT(11) NULL DEFAULT NULL COMMENT '0 pendiente, 1 en proceso, 2 terminada, 3 cancelada, 4 inasisitida' ,
  `usuario_idusuario` INT(11) NOT NULL ,
  PRIMARY KEY (`idcita`, `usuario_idusuario`) ,
  INDEX `fk_cita_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_cita_usuario1`
    FOREIGN KEY (`usuario_idusuario` )
    REFERENCES `nutricion`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`consulta` (
  `idconsulta` INT(11) NOT NULL AUTO_INCREMENT ,
  `horaInicio` DATETIME NULL DEFAULT NULL ,
  `horaFin` DATETIME NULL DEFAULT NULL ,
  `comentarios` TEXT NULL DEFAULT NULL ,
  `cita_idcita` INT(11) NOT NULL ,
  `cita_usuario_idusuario` INT(11) NOT NULL ,
  PRIMARY KEY (`idconsulta`, `cita_idcita`, `cita_usuario_idusuario`) ,
  INDEX `fk_consulta_cita1_idx` (`cita_idcita` ASC, `cita_usuario_idusuario` ASC) ,
  CONSTRAINT `fk_consulta_cita1`
    FOREIGN KEY (`cita_idcita` , `cita_usuario_idusuario` )
    REFERENCES `nutricion`.`cita` (`idcita` , `usuario_idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`diagnostico` (
  `iddiagnostico` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`iddiagnostico`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'obesidad, hipertension, etc.';

CREATE  TABLE IF NOT EXISTS `nutricion`.`consulta_has_diagnostico` (
  `consulta_idconsulta` INT(11) NOT NULL ,
  `diagnostico_iddiagnostico` INT(11) NOT NULL ,
  PRIMARY KEY (`consulta_idconsulta`, `diagnostico_iddiagnostico`) ,
  INDEX `fk_consulta_has_diagnostico_diagnostico1_idx` (`diagnostico_iddiagnostico` ASC) ,
  INDEX `fk_consulta_has_diagnostico_consulta1_idx` (`consulta_idconsulta` ASC) ,
  CONSTRAINT `fk_consulta_has_diagnostico_consulta1`
    FOREIGN KEY (`consulta_idconsulta` )
    REFERENCES `nutricion`.`consulta` (`idconsulta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_consulta_has_diagnostico_diagnostico1`
    FOREIGN KEY (`diagnostico_iddiagnostico` )
    REFERENCES `nutricion`.`diagnostico` (`iddiagnostico` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `nutricion`.`diagnostico_has_dieta` (
  `diagnostico_iddiagnostico` INT(11) NOT NULL ,
  `dieta_iddieta` INT(11) NOT NULL ,
  `valor` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`diagnostico_iddiagnostico`, `dieta_iddieta`) ,
  INDEX `fk_diagnostico_has_dieta_dieta1_idx` (`dieta_iddieta` ASC) ,
  INDEX `fk_diagnostico_has_dieta_diagnostico1_idx` (`diagnostico_iddiagnostico` ASC) ,
  CONSTRAINT `fk_diagnostico_has_dieta_diagnostico1`
    FOREIGN KEY (`diagnostico_iddiagnostico` )
    REFERENCES `nutricion`.`diagnostico` (`iddiagnostico` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_diagnostico_has_dieta_dieta1`
    FOREIGN KEY (`dieta_iddieta` )
    REFERENCES `nutricion`.`dieta` (`iddieta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
